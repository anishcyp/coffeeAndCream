<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontController.php';

class MembershipPlanController extends FrontController 
{
    public function __construct()
    {
        parent::__construct();
        // $this->isUserLogin();
        $this->load->library('upload');
        $this->load->model('Crud', 'crud'); 
        $this->table = '';
    }

    public function Membershipplan_View()
    {

        $data = array();
        $UserId = $this->session->userdata('front_UserId');
        $user_role = $this->crud->get_column_value_by_id("tbl_customer","user_role","id = ".$UserId);
        $data['user_role']  = $user_role;
        if($user_role == 1 )
        {
            $plan = $this->crud->get_all_with_where('membership_plan','plan_nickname','desc',array('plan_nickname'=>'strippers' ,'status'=>'Y','isDelete'=>0));
            $data['plan']   = $plan;
        }
        else if ($user_role == 2)
        {
            $plan = $this->crud->get_all_with_where('membership_plan','plan_nickname','desc',array('plan_nickname'=>'escorts' ,'status'=>'Y','isDelete'=>0));
            $data['plan']   = $plan;
        }
        else if($user_role == 4)
        {
            $plan = $this->crud->get_all_with_where('membership_plan','plan_nickname','desc',array('plan_nickname'=>'agency' ,'status'=>'Y','isDelete'=>0));
            $data['plan']   = $plan;
        }
        else if($user_role == 5)
        {
            $plan = $this->crud->get_all_with_where('membership_plan','plan_nickname','desc',array('plan_nickname'=>'accommodation' ,'status'=>'Y','isDelete'=>0));
            $data['plan']   = $plan;
        }
        else
        {
            $this->session->set_flashdata('error',"You don't have permission to access this page.");
            redirect("profile-info");
        }

        $data['pageTitle'] = 'Membership Plan';        
        $this->load->view(FRONTEND."myaccount/membership",$data);
    }


    public function Plan_Create()
    {
        
        $post = $this->input->post();
        
        // echo "<pre>";
        // print_r($post);
        // exit();

        $this->form_validation->set_rules('member_id','Id ','trim|required');
        $this->form_validation->set_rules('card_number','card number ','trim|required');
        $this->form_validation->set_rules('mm','Mounth ','trim|required');
        $this->form_validation->set_rules('yy','Year ','trim|required');
        $this->form_validation->set_rules('cvv','CVC ','trim|required');
        $this->form_validation->set_rules('recurring','Recurring ','trim|required');

        $UserId = $this->session->userdata('front_UserId');
        $user_info = $this->crud->get_one_row("tbl_customer",array('id' => $UserId,'is_delete' => 'Y', 'status' => 'Y', 'is_verified' => 1));

        $plan_id  = $this->input->post('member_id');
        $result_d = $this->crud->get_one_row('membership_plan',array('id'=>$plan_id,'status'=>'Y','isDelete'=>0));
        // print_r( $result_d); exit;


        if($this->form_validation->run() == FALSE)
        {
            $data["msg"]        = validation_errors();
            echo json_encode($data);
            exit;
        }
        else
        {

            if($post['recurring'] == 'Yes')
            {
            require_once('application/libraries/new_stripe/init.php');

            $stripe = new \Stripe\StripeClient(
                STRIPE_SECRET_KEY
            );
            \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

                try 
                {
                    $card_token = $stripe->tokens->create([
                      'card' => [
                        'number' => $post['card_number'],
                        'exp_month' => $post['mm'],
                        'exp_year' => $post['yy'],
                        'cvc' => $post['cvv'],
                      ],
                    ]);

                    $card_token_id = $card_token->id;

                    $source = $stripe->customers->createSource(
                      $user_info['customer_id'],
                      ['source' => $card_token_id]
                    );
                    $source_id = $source->id;

                    $membership = $stripe->subscriptions->create([
                      'customer' => $user_info['customer_id'],
                      'items' => [
                        ['price' => $result_d['stripe_plan_id']],
                      ],
                    ]);

                $membership_id = $membership->id;

                $current_period_start =  date("Y-m-d H:i:s", $membership->current_period_start);
                $current_period_end =  date("Y-m-d H:i:s", $membership->current_period_end);

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
                        'uid'                   =>  $UserId,
                        'recurring'             =>  $post['recurring'],
                        'plan_nickname'         =>  $result_d['plan_nickname'],
                        'amount'                =>  $result_d['amount'],
                        'currency'              =>  "gbp",
                        'interval'              =>  $result_d['interval'],
                        'interval_count'        =>  $result_d['interval_count'],
                        'custom_interval'       =>  $result_d['custom_interval'],
                        'stripe_plan_id'        =>  $result_d['stripe_plan_id'],
                        'stripe_sub_id'         =>  $membership_id,
                        'stripe_tok_id'         =>  $card_token_id,
                        'post'                  =>  $result_d['post'],
                        'stripe_source_id'      =>  $source_id,
                        'customer_id'           =>  $user_info['customer_id'],
                        'no_plan_cities'        =>  $result_d['no_plan_cities'],
                        'created_at'            =>  $current_period_start,
                        'end_date'              =>  $current_period_end,
                        'status'                =>  1,
                    );
                    
                    $fieldupd = array(
                        'purchase_plan'                   =>  1,
                        'timer'                           => '',
                    );

                    $where_id = array('id' => $UserId );
                    $result2 = $this->crud->update('tbl_customer',$fieldupd,$where_id);
                    
                    $result = $this->crud->insert('purchase_plan',$fieldInfo);
                    // echo $result; exit;
                    if($result > 0 && $result2 > 0)
                    {
                        $general_setting            = $this->generalSetting(); 
                        $mail_data['site_name']     = $general_setting->site_name;
                        $mail_data['site_title']    = $general_setting->site_title;
                        $mail_data['site_email']    = $general_setting->email;
                        $mail_data['site_logo']     = base_url('public/front/images/logo/'.$general_setting->site_logo );
                        $mail_data['address']       = $general_setting->address;
                        $mail_data['fb_link']       = $general_setting->fb_link;
                        $mail_data['twitter_link']  = $general_setting->twitter_link;
                        $mail_data['instagram_link'] = $general_setting->instagram_link;
                        $mail_data['copyright_year'] = date("Y");
                        /* General setting common from all email end */

                        $mail_data['fname']             = $user_info['fname'].' '.$user_info['lname'];
                        $mail_data['email']             = $user_info['email'];
                        $mail_data['plan_times']        = $result_d['interval_count'].' '.$result_d['custom_interval'];
                        $mail_data['amount']            = $result_d['amount'];
                        $mail_data['start_date']        = $current_period_start;
                        $mail_data['end_date']          = $current_period_end;
                        $mail_data['plan_name']         = $result_d['plan_nickname'];

                        $message = $this->load->view('mail_template/purchase_mail_template', $mail_data, TRUE);

                        $admin_message = $this->load->view('mail_template/admin_purchase_mail_template', $mail_data, TRUE);
                        // echo $admin_message;die();

                        $admin_mailbody['ToEmail']    = $general_setting->site_from_admin_email;
                        $admin_mailbody['FromName']   = $general_setting->site_name;
                        $admin_mailbody['FromEmail']  = $general_setting->site_from_email;
                        $admin_mailbody['Subject']    = $general_setting->site_name." - New Membership Plan User";
                        $admin_mailbody['Message']    = $admin_message;

                        $mailbody['ToEmail']    = $user_info['email'];
                        $mailbody['FromName']   = $general_setting->site_name;
                        $mailbody['FromEmail']  = $general_setting->site_from_email;
                        $mailbody['Subject']    = $general_setting->site_name." Membership Plan Purchase Successfully ";
                        $mailbody['Message']    = $message;

                        $admin_result = $this->EmailSend($admin_mailbody);
                        $mail_result = $this->EmailSend($mailbody);

                        if($mail_result || $admin_result)
                        {

                            $response['user_id']    = $UserId;
                            $response['error']      = 0;
                            $response["msg"]   = 'Please check your email Membership plan purchase successfully';
                        }
                        else
                        {
                            $response['error'] = 1;
                            $response['msg'] = 'Some error occured while send mail. Please try again.';
                        } 
                    }
                    else
                    {
                        $response["msg"]   = 'Something went wrong';
                    }
                }
                else
                {
                    $response['error'] = 1;
                    $response['msg'] = $result;
                }
            }
            else if($post['recurring'] == 'No')
            {
               
                $amt = ($result_d['amount']* 100);

                require_once('application/libraries/stripe/init.php');
                \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
                $card_no        = $post['card_number'];
                $card_exp_month = $post['mm'];
                $card_exp_year  = $post['yy'];
                $card_cvv       = $post['cvv'];

                try 
                {
                    $token = \Stripe\Token::create(array(
                        "card"      => array(
                        "number"    =>  $card_no,
                        "exp_month" =>  $card_exp_month,
                        "exp_year"  =>  $card_exp_year,
                        "cvc"       =>  $card_cvv
                      )
                    ));
                
                    $charge = \Stripe\Charge::create(array(
                        "amount"        =>  $amt,
                        "currency"      =>  "gbp",
                        "source"        =>  $token,
                        "description"   =>  $result_d['plan_nickname'].' plan '.$result_d['interval_count'].' '.$result_d['custom_interval'],
                        "receipt_email" =>  $user_info['email'],
                        "metadata"      => array(
                                  "First name"  => $user_info['fname'],
                                  "Last name"   => $user_info['lname'],
                                  "Email"       => $user_info['email'],
                                  "service"     => $result_d['plan_nickname'],
                                  "uid"         => $UserId,
                                ),
                        )
                    );

                    /*print_r($charge);
                    exit();*/
                    $charge_id  = $charge->id; 
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
                    $end_date = date('Y-m-d H:i:s', strtotime('+'.$result_d['interval_count'].' '.$result_d['custom_interval']));

                    $fieldInfo = array(
                        'uid'                   =>  $UserId,
                        'recurring'             =>  $post['recurring'],
                        'plan_nickname'         =>  $result_d['plan_nickname'],
                        'amount'                =>  $result_d['amount'],
                        'currency'              =>  "gbp",
                        'interval'              =>  $result_d['interval'],
                        'interval_count'        =>  $result_d['interval_count'],
                        'custom_interval'       =>  $result_d['custom_interval'],
                        'charge_id'             =>  $charge_id,
                        'customer_id'           =>  $user_info['customer_id'],
                        'no_plan_cities'        =>  $result_d['no_plan_cities'],
                        'created_at'            =>  date('Y-m-d H:i:s'),
                        'post'                  =>  $result_d['post'],
                        'end_date'              =>  $end_date,
                        'status'                =>  1,
                    );


                    $fieldupd = array(
                        'purchase_plan'          =>  1,
                    );

                    $where_id = array('id' => $UserId );
                    $result2 = $this->crud->update('tbl_customer',$fieldupd,$where_id);
                    
                    $result = $this->crud->insert('purchase_plan',$fieldInfo);

                    if($result > 0 && $result2 > 0)
                    {
                        $general_setting            = $this->generalSetting(); 
                        $mail_data['site_name']     = $general_setting->site_name;
                        $mail_data['site_title']    = $general_setting->site_title;
                        $mail_data['site_email']    = $general_setting->email;
                        $mail_data['site_logo']     = base_url('public/front/images/logo/'.$general_setting->site_logo );
                        $mail_data['address']       = $general_setting->address;
                        $mail_data['fb_link']       = $general_setting->fb_link;
                        $mail_data['twitter_link']  = $general_setting->twitter_link;
                        $mail_data['instagram_link'] = $general_setting->instagram_link;
                        $mail_data['copyright_year'] = date("Y");
                        /* General setting common from all email end */

                        $mail_data['fname']             = $user_info['fname'].' '.$user_info['lname'];
                        $mail_data['email']             = $user_info['email'];
                        $mail_data['plan_times']        = $result_d['interval_count'].' '.$result_d['custom_interval'];
                        $mail_data['amount']            = $result_d['amount'];
                        $mail_data['start_date']        = date('Y-m-d H:i:s');
                        $mail_data['end_date']          = $end_date;
                        $mail_data['plan_name']                 = $result_d['plan_nickname'];

                        $message = $this->load->view('mail_template/purchase_mail_template', $mail_data, TRUE);

                        $admin_message = $this->load->view('mail_template/admin_purchase_mail_template', $mail_data, TRUE);
                        // echo $admin_message;die();

                        $admin_mailbody['ToEmail']    = $general_setting->site_from_admin_email;
                        $admin_mailbody['FromName']   = $general_setting->site_name;
                        $admin_mailbody['FromEmail']  = $general_setting->site_from_email;
                        $admin_mailbody['Subject']    = $general_setting->site_name." - New Membership Plan User";
                        $admin_mailbody['Message']    = $admin_message;

                        $mailbody['ToEmail']    = $user_info['email'];
                        $mailbody['FromName']   = $general_setting->site_name;
                        $mailbody['FromEmail']  = $general_setting->site_from_email;
                        $mailbody['Subject']    = $general_setting->site_name." Membership Plan Purchase Successfully ";
                        $mailbody['Message']    = $message;

                        // echo $admin_message;die();
                        $admin_result = $this->EmailSend($admin_mailbody);
                        $mail_result = $this->EmailSend($mailbody);

                        if($mail_result || $admin_result)
                        {

                            $response['user_id']    = $UserId;
                            $response['error']      = 0;
                            $response["msg"]   = 'Please check your email Membership plan purchase successfully';
                        }
                        else
                        {
                            $response['error'] = 1;
                            $response['msg'] = 'Some error occured while send mail. Please try again.';
                        } 

                    }
                    else
                    {
                        $response["msg"]   = 'Something went wrong';
                    }

                }
                else
                {
                    $response['error'] = 1;
                    $response['msg'] = $result;
                }

            }

        echo json_encode($response);
        exit;
        }
    }

    public function membership_details()
    {
        $data = array();
        
        $data['pageTitle'] = 'Membership Plan Details';        
        $this->load->view(FRONTEND."myaccount/membership_details",$data);
    }


    public function ajaxPaginationDatamembership_details()
    {
        $user_id = $this->session->userdata('front_UserId'); 
        $login_user_role = $this->loginUserRole();
        
        $where = array("d.uid"=>$user_id);
        

        $config['select'] = 'd.*';
        $config['table'] = 'purchase_plan d';
        

        $config['column_order'] = array('d.status');
        $config['column_search'] = array('d.plan_nickname','d.stripe_sub_id');         
        $config['order'] = array('status' => 'asc');
        $config['custom_where'] =  $where;
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();

        // echo $this->db->last_query();
        foreach ($records as $record) 
        {
            $action = '';
            $status = '';
            $action .= '
                <a href="'.URL.'plan-history/'.md5($record->id).'" class="action-btn btn-edit"> <i class="fa fa-eye"></i></a>'; 
            
            if($record->status == 1)
            {
                $status .='Active';
            }
            else if($record->status == 2)
            {
                $status .='Plan Expired';
            }
            else
            {
                $status .='Aeactivate';
            }

            $ischecked = $record->status == '1' ? 'checked="checked"' : '';
            $status = $record->status == '2' ? '2' : '1';

            $row = array();
            $row[] = str_replace("_", " ", $record->plan_nickname);
            if($record->status == 1)
            {
                $row[] = '<span id="ct6" style="background-color: #FFFF00"></span>';    
            }
            else
            {
                $row[] = '<span></span>';
            }
            
            $row[] = date("Y-m-d h:i A",strtotime($record->end_date));
            // $row[] = '<input class="changeStatusMe" data-id="'.$record->id.'" data-status="'.$status.'" data-td="purchase_plan" data-i="" type="checkbox"  '.$ischecked.' id="switch'.$record->id.'" switch="bool"/><label for="switch'.$record->id.'" data-on-label="Yes" data-off-label="No"></label>';
            // $row[]  = '<label class="switch"><input class="changeStatusMe" data-id="'.$record->id.'" data-status="'.$status.'" data-td="purchase_plan" data-i="" type="checkbox"  '.$ischecked.' id="switch'.$record->id.'" switch="bool"/><label for="switch'.$record->id.'" data-on-label="Yes" data-off-label="No"></label><span class="slider round"></span></label>';
            if($record->status == 1)
            {
                $row[] = 'Plan Active';
            }
            else if($record->status == 2)
            {
                $row[] = 'Plan Expired';
            }

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


    public function details_view($id)
    {
        $data = array();
        $user_id = $this->session->userdata('front_UserId'); 

        $detail = $this->crud->get_one_row("purchase_plan",array("md5(id)"=>$id));   

        $data['details']        = $detail;
        $data['pageTitle']      = 'Membership Plan History';

        $this->load->view(FRONTEND."myaccount/plan_history",$data);
    }


    public function thank_you()
    {
        $data = array();

        // $user_id = $this->session->userdata('front_UserId'); 

        // $detail = $this->crud->get_one_row("purchase_plan",array("md5(id)"=>$id));  

        $data['pageTitle']      = 'Thank you';
        $this->load->view(FRONTEND."myaccount/thank_you",$data);
    }

    public function viewParchesPlan($plan_name)
    {
        $data = array();
        // echo $plan_name; exit();
        if($plan_name == 'strippers')
        {
          $plan = $this->crud->get_all_with_where('membership_plan','plan_nickname','desc',array('plan_nickname'=>'strippers' ,'status'=>'Y','isDelete'=>0));

          $data['plan']   = $plan;
        }
        else if($plan_name == 'escorts')
        {
            $plan = $this->crud->get_all_with_where('membership_plan','plan_nickname','desc',array('plan_nickname'=>'escorts' ,'status'=>'Y','isDelete'=>0));
            $data['plan']   = $plan;
            
        }
        else
        {
           $this->session->set_flashdata('error','Something when wrong.');
            redirect("profile-info"); 
        }
        
        $data['detail'] = $plan_name;
        $data['pageTitle']      = $plan_name;
        $this->load->view(FRONTEND."myaccount/plan_details",$data);
    }

    public function plan_expired()
    {

        $data = array();

        $data['pageTitle']      = 'Purchase Plan';
        $this->load->view(FRONTEND."myaccount/plan_purchase",$data);
    }

    //Cron membership oneday mail 

    public function planRangeOrderNotify()
    {
        $oneday = date('Y-m-d', strtotime("+1 days"));

        $sql = 'SELECT * FROM `purchase_plan` WHERE DATE_FORMAT(end_date, "%Y-%m-%d") = "'.$oneday.'" AND `status` = "1"  AND `recurring`="Yes" AND `isDelete` = 0 ORDER BY `plan_nickname` DESC';

        // echo $sql; exit;

        $plans = $this->crud->getFromSQL($sql);

        if(!empty($plans))
        {
            foreach ($plans as $value) 
            {

                $where = array('id' =>  $value->uid,'purchase_plan'=>1,'is_delete'=>0,'is_verified'=>1);
                $details = $this->crud->get_one_row("tbl_customer",$where );

                if($details != '')
                {
                    $general_setting            = $this->generalSetting(); 
                    $mail_data['site_name']     = $general_setting->site_name;
                    $mail_data['site_title']    = $general_setting->site_title;
                    $mail_data['site_email']    = $general_setting->email;
                    $mail_data['site_logo']     = base_url('public/front/images/logo/'.$general_setting->site_logo );
                    $mail_data['address']       = $general_setting->address;
                    $mail_data['fb_link']       = $general_setting->fb_link;
                    $mail_data['twitter_link']  = $general_setting->twitter_link;
                    $mail_data['instagram_link'] = $general_setting->instagram_link;
                    $mail_data['copyright_year'] = date("Y");
                    /* General setting common from all email end */
                    
                    $mail_data['fname']             = $details['fname'].' '.$details['lname'];
                    $mail_data['email']             = $details['email'];
                    $mail_data['plan_times']        = $value->interval_count.' '.$value->custom_interval;
                    $mail_data['amount']            = $value->amount;
                    $mail_data['end_date']          = $value->end_date;
                    $mail_data['plan_name']         = $value->plan_nickname;
                    $mail_data['url']               = base_url('membership-details');

                    $message = $this->load->view('mail_template/plan_one_date_mail_template', $mail_data, TRUE);
                    // print_r($message); die();

                    $mailbody['ToEmail']    = $details['email'];
                    $mailbody['FromName']   = $general_setting->site_name;
                    $mailbody['FromEmail']  = $general_setting->site_from_email;
                    $mailbody['Subject']    = $general_setting->site_name."Membership confirmation";
                    $mailbody['Message']    = $message;

                    $mail_result = $this->EmailSend($mailbody);

                }
            }
        }
    }


    //Cron set expire plan

    public function expired_mail()
    {
        $oneday = date("Y-m-d");
        // $oneday = date('Y-m-d', strtotime("+1 days"));

        $sql = 'SELECT * FROM `purchase_plan` WHERE DATE_FORMAT(end_date, "%Y-%m-%d") = "'.$oneday.'" AND `status` = "1"  AND `recurring`="No" AND `isDelete` = 0 ORDER BY `plan_nickname` DESC';
        // echo $sql; exit;
        $plans = $this->crud->getFromSQL($sql);

        if(!empty($plans))
        {
            foreach ($plans as $value) 
            {
                if($value->recurring == 'No')
                {
                    $fieldupd = array(
                        'status'      =>  2,
                    );

                    $where_id = array('id' => $value->id);
                    $result2 = $this->crud->update('purchase_plan',$fieldupd,$where_id);

                    $fieldupd1 = array(
                        'purchase_plan'      =>  2,
                    );

                    $where_id1 = array('id' => $value->uid);
                    $result2 = $this->crud->update('tbl_customer',$fieldupd1,$where_id1);
                }
                $where = array('id' =>  $value->uid,'is_delete'=>0,'is_verified'=>1);
                $result_d = $this->crud->get_one_row("tbl_customer",$where );

                $general_setting            = $this->generalSetting(); 
                $mail_data['site_name']     = $general_setting->site_name;
                $mail_data['site_title']    = $general_setting->site_title;
                $mail_data['site_email']    = $general_setting->email;
                $mail_data['site_logo']     = base_url('public/front/images/logo/'.$general_setting->site_logo );
                $mail_data['address']       = $general_setting->address;
                $mail_data['fb_link']       = $general_setting->fb_link;
                $mail_data['twitter_link']  = $general_setting->twitter_link;
                $mail_data['instagram_link'] = $general_setting->instagram_link;
                $mail_data['copyright_year'] = date("Y");
                /* General setting common from all email end */

                $mail_data['fname']             = $result_d['fname'].' '.$result_d['lname'];
                $mail_data['email']             = $result_d['email'];
                $mail_data['plan_times']        = $value->interval_count.' '.$value->custom_interval;
                $mail_data['amount']            = $value->amount;
                $mail_data['end_date']          = $value->end_date;
                $mail_data['start_date']        = $value->created_at;
                $mail_data['plan_name']         = $value->plan_nickname;
                $mail_data['url']               = base_url('membership-plan');

                $message = $this->load->view('mail_template/plan_expired_mail_template', $mail_data, TRUE);
                // echo $message; exit;
                $admin_message = $this->load->view('mail_template/admin_expired_plan_mail_template', $mail_data, TRUE);

                $admin_mailbody['ToEmail']    = $general_setting->site_from_admin_email;
                $admin_mailbody['FromName']   = $general_setting->site_name;
                $admin_mailbody['FromEmail']  = $general_setting->site_from_email;
                $admin_mailbody['Subject']    = $general_setting->site_name." -User Plan Expired";
                $admin_mailbody['Message']    = $admin_message;

                $mailbody['ToEmail']    = $result_d['email'];
                $mailbody['FromName']   = $general_setting->site_name;
                $mailbody['FromEmail']  = $general_setting->site_from_email;
                $mailbody['Subject']    = $general_setting->site_name." Membership plan has expired";
                $mailbody['Message']    = $message;

                $admin_result = $this->EmailSend($admin_mailbody);
                $mail_result = $this->EmailSend($mailbody);
               
            }
        }
    }

    //Cron welcome kit

    function Timer()
    {

        $today_date = date("Y-m-d"); 
        
        $sql = 'SELECT * FROM `tbl_customer` WHERE DATE_FORMAT(timer, "%Y-%m-%d") = "'.$today_date.'" AND `is_delete` = 0 ORDER BY `email` DESC';
        // echo $sql; exit();
        $timers = $this->crud->getFromSQL($sql);

        if(!empty($timers))
        {
            foreach ($timers as $value) 
            {
                $where = array('id' =>  $value->id,'is_delete'=>0,'is_verified'=>1);
                $details = $this->crud->get_one_row("tbl_customer",$where );

                $fieldupd1 = array(
                    'purchase_plan'      =>  '0',
                );

                $where_id1 = array('id' => $value->id);
                $result2 = $this->crud->update('tbl_customer',$fieldupd1,$where_id1);

                // $general_setting            = $this->generalSetting(); 
                // $mail_data['site_name']     = $general_setting->site_name;
                // $mail_data['site_title']    = $general_setting->site_title;
                // $mail_data['site_email']    = $general_setting->email;
                // $mail_data['site_logo']     = base_url('public/front/images/logo/'.$general_setting->site_logo );
                // $mail_data['address']       = $general_setting->address;
                // $mail_data['fb_link']       = $general_setting->fb_link;
                // $mail_data['twitter_link']  = $general_setting->twitter_link;
                // $mail_data['instagram_link'] = $general_setting->instagram_link;
                // $mail_data['copyright_year'] = date("Y");
                // /* General setting common from all email end */
                
                // $mail_data['fname']             = $details['fname'].' '.$details['lname'];
                // $mail_data['email']             = $details['email'];
                // $mail_data['url']               = base_url('membership-plan');

                // $message = $this->load->view('mail_template/welcome_kit_mail_template', $mail_data, TRUE);
                // // print_r($message); die();

                // $mailbody['ToEmail']    = $details['email'];
                // $mailbody['FromName']   = $general_setting->site_name;
                // $mailbody['FromEmail']  = $general_setting->site_from_email;
                // $mailbody['Subject']    = $general_setting->site_name."Membership confirmation";
                // $mailbody['Message']    = $message;

                // $mail_result = $this->EmailSend($mailbody);               
            }
        }
          
    }

    // Auto mailing system
    public function auto_mail()
    {
        $sql = "SELECT * FROM `tbl_customer` WHERE `is_delete` = 0 AND user_role!=4 AND status='Y' AND is_verified=1 ORDER BY `email` DESC";

        // echo $sql; exit;
        
        $automail = $this->crud->getFromSQL($sql);

        $general_setting            = $this->generalSetting(); 

        if(!empty($automail))
        {
            $temp_mail = array();

            foreach ($automail as $value) 
            {
                $where = array('id' =>  $value->id,'is_delete'=>0,'is_verified'=>1,'status'=>'Y');
                $details = $this->crud->get_one_row("tbl_customer",$where );
               
                // Stripper mail template
                $mail_data['site_name']     = $general_setting->site_name;
                $mail_data['site_title']    = $general_setting->site_title;
                $mail_data['site_email']    = $general_setting->email;
                $mail_data['site_logo']     = base_url('public/front/images/logo/'.$general_setting->site_logo );
                $mail_data['address']       = $general_setting->address;
                $mail_data['fb_link']       = $general_setting->fb_link;
                $mail_data['twitter_link']  = $general_setting->twitter_link;
                $mail_data['instagram_link'] = $general_setting->instagram_link;
                $mail_data['copyright_year'] = date("Y");
                /* General setting common from all email end */
                
                $mail_data['fname']             = $details['fname'].' '.$details['lname'];
                $mail_data['email']             = $details['email'];
                $temp_mail[]= $details['email'];
                $mail_data['link']               = "https://".$_SERVER['HTTP_HOST'];

                $message = $this->load->view('mail_template/auto_mail_template', $mail_data, TRUE);

                $mailbody['ToEmail']    = $details['email'];
                $mailbody['FromName']   = $general_setting->site_name;
                $mailbody['FromEmail']  = $general_setting->site_from_email;
                $mailbody['Subject']    = $general_setting->site_name." - Do you love freedom???";
                $mailbody['Message']    = $message;
                // print_r($mailbody); exit;
                $mail_result = $this->EmailSend($mailbody);

                // Escort mail template
                $escort_message = $this->load->view('mail_template/auto_escorts_mail_template', $mail_data, TRUE);

                $mailbody['Subject']    = $general_setting->site_name." - Have you registered to be part be part of coffee n Cream?";
                $mailbody['Message']    = $escort_message; 
                // print_r($escort_message); exit;
                $mail_result1 = $this->EmailSend($mailbody);

            }

                //Admin mail report's send 

                /* General setting common from all email start */
                $mail_data['site_name']     = $general_setting->site_name;
                $mail_data['site_title']    = $general_setting->site_title;
                $mail_data['site_email']    = $general_setting->email;
                $mail_data['site_logo']     = base_url('public/front/images/logo/'.$general_setting->site_logo );
                $mail_data['address']       = $general_setting->address;
                $mail_data['fb_link']       = $general_setting->fb_link;
                $mail_data['twitter_link']  = $general_setting->twitter_link;
                $mail_data['instagram_link'] = $general_setting->instagram_link;
                $mail_data['copyright_year'] = date("Y");
                /* General setting common from all email end */

                $mail_data['email']         = $temp_mail;

                $admin_message = $this->load->view('mail_template/admin_mail_reports_template', $mail_data, TRUE);

                // print_r($admin_message); die();

                $admin_mailbody['ToEmail']    = $general_setting->site_from_admin_email;
                $admin_mailbody['FromName']   = $general_setting->site_name;
                $admin_mailbody['FromEmail']  = $general_setting->site_from_email;
                $admin_mailbody['Subject']    = $general_setting->site_name." - Auto mail reports ";
                $admin_mailbody['Message']    = $admin_message;
                // print_r($admin_mailbody); exit;
                $admin_mailbody = $this->EmailSend($admin_mailbody); 
        }

    }


    public function replan()
    {
        require_once('application/libraries/new_stripe/init.php');

        $stripe = new \Stripe\StripeClient(
            STRIPE_SECRET_KEY
        );

        $sql = "SELECT * FROM `purchase_plan` WHERE `isDelete` = 0 AND `recurring`='Yes' AND status=1 ORDER BY `plan_nickname` DESC";
        
        $retrieve = $this->crud->getFromSQL($sql);
        $general_setting            = $this->generalSetting();

        if(!empty($retrieve))
        {
            foreach($retrieve as $value)
            {
                $where = array('id' =>  $value->uid,'is_delete'=>0,'is_verified'=>1,'status'=>'Y');
                $details = $this->crud->get_one_row("tbl_customer",$where );

                $rec = $stripe->subscriptions->retrieve(
                    $value->stripe_sub_id,
                    []
                );
                $subc_status = $rec->status;
               
                if(trim($subc_status) == 'incomplete_expired' || trim($subc_status) == 'past_due' || trim($subc_status) == 'incomplete' || trim($subc_status) == 'unpaid' || trim($subc_status) == 'canceled')
                {
                    //Plan tables
                    $fieldupd1 = array(
                        'status'      =>  '3',
                    );
                    $where_id = array('id' => $value->id,'recurring'=>'Yes');
                    $result2 = $this->crud->update('purchase_plan',$fieldupd1,$where_id);

                    //tbl customer
                    $fieldupd = array(
                        'purchase_plan'      =>  '0',
                    );
                    $where_id1 = array('id' => $value->uid);
                    $result = $this->crud->update('tbl_customer',$fieldupd,$where_id1);

                    // Stripper mail template
                    $mail_data['site_name']     = $general_setting->site_name;
                    $mail_data['site_title']    = $general_setting->site_title;
                    $mail_data['site_email']    = $general_setting->email;
                    $mail_data['site_logo']     = base_url('public/front/images/logo/'.$general_setting->site_logo );
                    $mail_data['address']       = $general_setting->address;
                    $mail_data['fb_link']       = $general_setting->fb_link;
                    $mail_data['twitter_link']  = $general_setting->twitter_link;
                    $mail_data['instagram_link'] = $general_setting->instagram_link;
                    $mail_data['copyright_year'] = date("Y");
                    /* General setting common from all email end */

                    $mail_data['fname']             = $details['fname'].' '.$details['lname'];
                    $mail_data['email']             = $details['email'];
                    $mail_data['link']               = "https://".$_SERVER['HTTP_HOST'];
                    $message = $this->load->view('mail_template/cancel_mail_template', $mail_data, TRUE);
                    // echo $message; exit;
                    $mailbody['ToEmail']    = $details['email'];
                    $mailbody['FromName']   = $general_setting->site_name;
                    $mailbody['FromEmail']  = $general_setting->site_from_email;
                    $mailbody['Subject']    = $general_setting->site_name." - Plan has been canceled";
                    $mailbody['Message']    = $message;
                    // print_r($mailbody); exit;
                    $mail_result = $this->EmailSend($mailbody);
                   
                }
                else
                {
                    $current_period_start =  date("Y-m-d H:i:s", $rec->current_period_start);
                    $current_period_end =  date("Y-m-d H:i:s", $rec->current_period_end);

                    $fieldupd1 = array(
                        'created_at'        =>  $current_period_start,
                        'end_date'          =>  $current_period_end,
                    );
                    
                    $where_id = array('id' => $value->id);
                    $result2 = $this->crud->update('purchase_plan',$fieldupd1,$where_id);
                    
                }
            }
        }
    }


    public function stories_remove()
    {
        $oneday = date('Y-m-d H:i:s', strtotime("+1 days"));
        
        $sql = 'SELECT * FROM `stories_child` WHERE `status` = "Y" AND `isDelete` = 0 ORDER BY `user_id` DESC';
        $stories = $this->crud->getFromSQL($sql);
        
        foreach($stories as $story)
        {
            $date = $this->crud->time_elapsed_string('@'.$story->time);
            if($date == '1 day ago')
            { 
                $fieldupd = array( 
                    'status'      =>  'N',
                    'isDelete'    =>  1,
                );
                $where_id = array('id' => $story->id);
                $result2 = $this->crud->update('stories_child',$fieldupd,$where_id);

                $fieldupd = array( 
                    'status'      =>  'N',
                    'isDelete'    =>  1,
                );
                $where_id = array('id' => $story->story_id);
                $result2 = $this->crud->update('stories',$fieldupd,$where_id);
            }
            
        }
        
    }


}