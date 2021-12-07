<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class MembershipPlanController extends BaseController {

	public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();  
        $this->load->model('Crud', 'crud'); 
        $this->table = 'membership_plan';
    }


    public function index()
    {
        $this->global['pageTitle'] = 'Membership Plan';
        $this->loadViews(ADMIN."membership_plan", $this->global, NULL , NULL);
    }

    function insertRecord()
    {
        require_once('application/libraries/stripe/init.php');
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
        $post = $this->input->post();

        $this->form_validation->set_rules('name','Plan name ','trim|required');
        $this->form_validation->set_rules('amount','Amount ','trim|required');
        $this->form_validation->set_rules('interval','Interval ','trim|required');
        //$this->form_validation->set_rules('interval_count','Interval count ','trim|required');
        $this->form_validation->set_rules('no_plan_cities','Number of cities','trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $data["msg"]        = validation_errors();
            echo json_encode($data);
            exit;
        }
        else
        {
            $table_name = base64_decode($this->input->post('td')); 
            $field      = base64_decode($this->input->post('i')); 
            $type       = $this->input->post('type'); 
            $editid     = $this->input->post('editid');
            $isActive   = ( isset($post['isActive']) && $post['isActive'] == 'on' ? 'Y' : 'N');
            
            unset($post["editid"]);
            unset($post["type"]);
            unset($post["isActive"]);
            unset($post["td"]);
            unset($post["i"]);

            if($type == "add")
            {
                try 
                {
                    $product = \Stripe\Product::create([
                        'name' => $post['name'],
                        'type' => 'service'
                    ]);

                    if($post['interval'] == "custom")
                    {
                        $dis_interval       = $post['custom_interval'];
                        $dis_interval_count = $post['interval_count'];
                    }
                    else if($post['interval'] == "quarter")
                    {
                        $dis_interval       = "month";
                        $dis_interval_count = 3;
                    }
                    else if($post['interval'] == "semiannual")
                    {
                        $dis_interval       = "month";
                        $dis_interval_count = 6;
                    }
                    else
                    {
                        $dis_interval       = $post['interval'];
                        $dis_interval_count = 1;
                    }

                    $plan = \Stripe\Plan::create([
                        'currency'          => 'gbp',
                        'interval'          => $dis_interval,
                        'interval_count'    => $dis_interval_count,
                        'product'           => $product->id,
                        'nickname'          => $post['plan_nickname'],
                        'amount'            => ($post['amount']*100),
                    ]);
                    /*echo "<pre>";
                    print_r($plan);
                    exit();*/

                    $plan_id    = $plan->id;
                    $product_id = $plan->product;

                    $result     =   "success";
                
                } catch(\Stripe\CardError $e) {  
                    $error = $e->getMessage();
                    $result = $error;

                } catch (\Stripe\InvalidRequestError $e) {
                    $error = $e->getMessage();
                    $result = $error;  
                } catch (\Stripe\AuthenticationError $e) {
                    $error = $e->getMessage();
                    $result = $error;
                } catch (\Stripe\ApiConnectionError $e) {
                    $error = $e->getMessage();
                    $result = $error;
                } catch (\Stripe\Error $e) {
                    $error = $e->getMessage();
                    $result = $error;
                } catch (Exception $e) {
                  
                    if ($e->getMessage() == "zip_check_invalid") {
                      $result = "declined1";
                    } else if ($e->getMessage() == "address_check_invalid") {
                      $result = "decline2d";
                    } else if ($e->getMessage() == "cvc_check_invalid") {
                      $result = "declined3";
                    } else {
                      $result = $e->getMessage();
                    }
                }

                if($result=="success") 
                {
                    $fieldInfo = array(
                        'name'                  =>  $post['name'],
                        'plan_nickname'         =>  $post['plan_nickname'],
                        'amount'                =>  $post['amount'],
                        'currency'              =>  "gbp",
                        'interval'              =>  $post['interval'],
                        'interval_count'        =>  $dis_interval_count,
                        'custom_interval'       =>  isset($post['custom_interval']) ? $post['custom_interval'] : "",
                        'stripe_plan_id'        =>  $plan_id,
                        'stripe_product_id'     =>  $product_id,
                        'no_plan_cities'        =>  $post['no_plan_cities'],
                        'descr'                 => $post['descr'],
                        'status'                =>  $isActive,
                        'created_at'            =>  date('Y-m-d H:i:s'),
                    );

                    $result = $this->crud->insert($table_name,$fieldInfo);

                    if($result > 0)
                    {
                        $data["msg"]   = 'Record Added successfully';
                    }
                    else
                    {
                        $data["msg"]   = 'Something went wrong';
                    }
                }
                else
                {
                    $data['msg'] = $result;
                }
            }

            if($type == "edit")
            {
                $editid = $this->input->post('editid');

                try 
                {
                    $product = \Stripe\Product::update(
                        $post["stripe_product_id"],
                        ['name' => $post['name']]
                    );

                    if($post['interval'] == "custom")
                    {
                        $dis_interval       = $post['custom_interval'];
                        $dis_interval_count = $post['interval_count'];
                    }
                    else if($post['interval'] == "quarter")
                    {
                        $dis_interval       = "month";
                        $dis_interval_count = 3;
                    }
                    else if($post['interval'] == "semiannual")
                    {
                        $dis_interval       = "month";
                        $dis_interval_count = 6;
                    }
                    else
                    {
                        $dis_interval       = $post['interval'];
                        $dis_interval_count = 1;
                    }


                    $plan = \Stripe\Plan::update(
                        $post["stripe_plan_id"],
                        ['nickname' => $post['plan_nickname']

                    ]

                    );

                    $plan_id    = $plan->id;
                    $product_id = $plan->product;

                    /*echo "<pre>";
                    print_r($plan);
                    exit();*/

                    $result     =   "success";
                
                } catch(\Stripe\CardError $e) {  
                    $error = $e->getMessage();
                    $result = $error;

                } catch (\Stripe\InvalidRequestError $e) {
                    $error = $e->getMessage();
                    $result = $error;  
                } catch (\Stripe\AuthenticationError $e) {
                    $error = $e->getMessage();
                    $result = $error;
                } catch (\Stripe\ApiConnectionError $e) {
                    $error = $e->getMessage();
                    $result = $error;
                } catch (\Stripe\Error $e) {
                    $error = $e->getMessage();
                    $result = $error;
                } catch (Exception $e) {
                  
                    if ($e->getMessage() == "zip_check_invalid") {
                      $result = "declined1";
                    } else if ($e->getMessage() == "address_check_invalid") {
                      $result = "decline2d";
                    } else if ($e->getMessage() == "cvc_check_invalid") {
                      $result = "declined3";
                    } else {
                      $result = $e->getMessage();
                    }
                }

                if($result=="success") 
                {
                    $fieldInfo = array(
                        'name'                  =>  $post['name'],
                        'plan_nickname'         =>  $post['plan_nickname'],
                        'amount'                =>  $post['amount'],
                        'currency'              =>  "gbp",
                        'interval'              =>  $post['interval'],
                        'interval_count'        =>  $dis_interval_count,
                        'custom_interval'       =>  isset($post['custom_interval']) ? $dis_interval : "",
                        'stripe_plan_id'        =>  $plan_id,
                        'stripe_product_id'     =>  $product_id,
                        'no_plan_cities'        =>  $post['no_plan_cities'],
                        'descr'                 => $post['descr'],
                        'status'                =>  $isActive,
                        'created_at'            =>  date('Y-m-d H:i:s'),
                    );

                    $where_array = array($field=>$editid);
                    $result = $this->crud->update($table_name,$fieldInfo,$where_array);

                    if($result > 0)
                    {
                        $data["msg"]   = 'Record Updated successfully';
                    }
                    else
                    {
                        $data["msg"]   = 'Something went wrong';
                    }
                }
                else
                {
                    $data['msg'] = $result;
                }
                
            }
          
            echo json_encode($data);
            exit;
        }
    }


    function ajax_advert_plan_datatable(){
        
        $tablename = base64_encode('membership_plan');
        $tableId = base64_encode('id');

        $config['select'] = 'membership_plan.*';
        $config['table'] = 'membership_plan';

        $config['column_order'] = array('membership_plan.name');
        $config['column_search'] = array('membership_plan.name');         
        $config['custom_where'] = array('isDelete' => 0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        

        foreach ($records as $record) {
          
            $action = '';
            // $action .= '<button class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </button> ';
            
            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDeletePlan" data-id="'.$record->stripe_plan_id.'" data-td="'.$record->stripe_product_id.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';

            $row = array();
            $row[] = $record->id;
            $row[] = $record->name;
            $row[] = $record->plan_nickname;
            $row[] = $record->amount;
            $row[] = $record->interval;
            $row[] = $record->no_plan_cities;
            $row[] = '<input class="changeStatus" data-id="'.$record->id.'" data-status="'.$status.'" data-td="'.$tablename.'" data-i="'.$tableId.'" type="checkbox"  '.$ischecked.' id="switch'.$record->id.'" switch="bool"/><label for="switch'.$record->id.'" data-on-label="Yes" data-off-label="No"></label>';
            $row[] = $action;
            
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->count_all(),
            "recordsFiltered" => $this->datatable->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}