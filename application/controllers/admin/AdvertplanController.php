<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class AdvertplanController extends BaseController {

    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();  
        $this->load->model('Crud', 'crud'); 
        $this->table = 'advert_plan';
    }

    public function index()
    {
        $this->global['pageTitle'] = 'Advert Plan';
        $this->loadViews(ADMIN."advert_plan", $this->global, NULL , NULL);
    }


    function insertRecord()
    {
        $post = $this->input->post();

        $this->load->library('form_validation');            
        $this->form_validation->set_rules('plan_name','Plan Name ','trim|required');
        $this->form_validation->set_rules('service_type','Service Type ','trim|required');
        $this->form_validation->set_rules('interval','Interval ','trim|required');
        $this->form_validation->set_rules('interval_type','Interval Type ','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $data["msg"]        = validation_errors();
            $data["msg_type"]   = 'error';
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
            $slug       = $this->slug->create_slug($post['plan_name']);

            unset($post["editid"]);
            unset($post["type"]);
            unset($post["isActive"]);
            unset($post["td"]);
            unset($post["i"]);

            $post['slug']       = $slug;
            $post['created_at'] = date('Y-m-d H:i:s');
            $post['status']     = $isActive;

            if($type == "add")
            {
              
                    $result = $this->crud->insert($table_name,$post);

                    if($result > 0)
                    {
                        $data["msg"]        = 'Record Added successfully';
                    }
                    else
                    {
                        $data["msg"]        = 'Something went wrong';
                    }
                
            }

            if($type == "edit")
            {
                $editid = $this->input->post('editid'); 
               
                    $where_array = array($field=>$editid);
                    $result = $this->crud->update($table_name,$post,$where_array);

                    if($result > 0)
                    {
                        $data["msg"]        = 'Record Updated successfully';
                    }
                    else
                    {
                        $data["msg"]        = 'Something went wrong';
                    }
                
            }
          
            echo json_encode($data);
            exit;
        }
       
    }



    function ajax_advert_plan_datatable(){
        
        $tablename = base64_encode('advert_plan');
        $tableId = base64_encode('id');

        $config['select'] = 'advert_plan.*';
        $config['table'] = 'advert_plan';

        $config['column_order'] = array('advert_plan.plan_name');
        $config['column_search'] = array('advert_plan.plan_name');         
        $config['custom_where'] = array('isDelete' => 0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        

        foreach ($records as $record) {
          
            $action = '';
            $action .= '<button class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </button> ';
            
            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';
            $service_type = '';
            if($record->service_type == '1'){
                $service_type .= 'Entertainment Services';
            }
            else
            {
                $service_type .= 'Escort service';
            }
            $interval_type = '';
            if($record->interval_type == '1')
            {
                $interval_type .='Day';
            }
            else if($record->interval_type == '2')
            {
                $interval_type .='Week';
            }
            else if($record->interval_type == '3')
            {
                $interval_type .='Month';
            }
            else
            {
                $interval_type .='Year';
            }
            

            $row = array();
            $row[] = $record->id;
            $row[] = $record->plan_name;
            $row[] = $service_type;
            $row[] = $record->interval;
            $row[] = $interval_type;
            $row[] = $record->amount;
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
