<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class ServiceController extends BaseController {

    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();  
        $this->load->model('Crud', 'crud'); 
        $this->table = 'service';
    }

    public function service()
    {
        $this->global['pageTitle'] = 'Manage Service';
        $this->loadViews(ADMIN."manage_service", $this->global, NULL , NULL);
    }

    function ajax_service_datatable(){
        
        $tablename = base64_encode('service');
        $tableId = base64_encode('service_id');

        $config['select'] = 'service.*';
        $config['table'] = 'service';

        $config['column_order'] = array('service.name');
        $config['column_search'] = array('service.name');         
        $config['custom_where'] = array('isDelete' => 0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        

        foreach ($records as $record) {
          
            $action = '';
            $action .= '<button class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->service_id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </button> ';
            
            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->service_id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';
            
            $dis_image = "";
            if(file_exists(UPLOAD_DIR.SERVICE_ICON.$record->service_icon) && $record->service_icon!="")
            {
                $dis_image = '<img class="media-object text-center" src="'.APP_URL.UPLOAD_DIR.SERVICE_ICON.$record->service_icon.'" style="width: 150px; height: auto;">';
            }

            $row = array();
            $row[] = $record->service_id;
            $row[] = $record->name;
            $row[] = $dis_image;
            $row[] = '<input class="changeStatus" data-id="'.$record->service_id.'" data-status="'.$status.'" data-td="'.$tablename.'" data-i="'.$tableId.'" type="checkbox"  '.$ischecked.' id="switch'.$record->service_id.'" switch="bool"/><label for="switch'.$record->service_id.'" data-on-label="Yes" data-off-label="No"></label>';
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

    function insertRecord()
    {
        $this->load->library("upload");
        $post = $this->input->post();
        // echo "<pre>";
        // print_r($post);
        // exit();
        
        $table_name = base64_decode($this->input->post('td')); 
            $field      = base64_decode($this->input->post('i')); 
            $type       = $this->input->post('type'); 
            $editid     = $this->input->post('editid');
            $name       = $this->input->post('name');
            $service    = $this->input->post('service');
            $add_menu   = $this->input->post('add_menu');
            $isActive   = ( isset($post['isActive']) && $post['isActive'] == 'on' ? 'Y' : 'N');
            $slug       = $this->slug->create_slug($post['name']);
            $metaTitle   = $this->input->post('service_meta_title');
            $metaDescription = $this->input->post('service_meta_description');

        $this->load->library('form_validation');            
        $this->form_validation->set_rules('name','Name ','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $data["msg"]        = validation_errors();
            $data["msg_type"]   = 'error';
            echo json_encode($data);
            exit;
        }
        else
        {
            $filename = "";
                if($_FILES['page_image']['error'] == 0)
                {                    
                    $filename = $this->crud->upload_file('page_image', UPLOAD_DIR.SERVICE_ICON);  
                }

            if($type == "edit")
            {
                if($filename=="")
                {
                    $filename = $post["old_page_image"];
                }
                else
                {
                    if(!empty($post["old_page_image"]) && file_exists(UPLOAD_DIR.SERVICE_ICON.$post["old_page_image"]))
                    {
                        @unlink(UPLOAD_DIR.SERVICE_ICON.$post["old_page_image"]);
                    }
                } 
            }

            unset($post["editid"]);
            unset($post["type"]);
            unset($post["isActive"]);
            unset($post["td"]);
            unset($post["i"]);

            $fieldInfo = array(
                'service_type'              => $service,
                'is_dis_on_menu'            => $add_menu,
                'name'                      => $name,
                'slug'                      => $slug,
                'service_icon'              => $filename,
                'service_meta_title'        => $metaTitle,
                'service_meta_description'  => $metaDescription,
                'created_at'                => date('Y-m-d H:i:s'),
                'status'                    => $isActive,
            );

            if($type == "add")
            {
                $is_duplicate = $this->crud->check_duplicate($table_name,array("slug"=>$slug,"isDelete"=>"0"));
                if($is_duplicate)
                {
                    $data["msg"]        = 'Record already exists. Please try another.';
                }
                else
                {
                    $result = $this->crud->insert($table_name,$fieldInfo);

                    if($result > 0)
                    {
                        $data["msg"]        = 'Record Added successfully';
                    }
                    else
                    {
                        $data["msg"]        = 'Something went wrong';
                    }
                }
            }

            if($type == "edit")
            {
                $editid = $this->input->post('editid'); 
                $is_duplicate = $this->crud->check_duplicate($table_name,array($field."!="=>$editid,"slug"=>$slug,"isDelete"=>"0"));
                if($is_duplicate)
                {
                    $data["msg"]        = 'Record already exists. Please try another.';
                }
                else
                {
                    $where_array = array($field=>$editid);
                    $result = $this->crud->update($table_name,$fieldInfo,$where_array);

                    if($result > 0)
                    {
                        $data["msg"]        = 'Record Updated successfully';
                    }
                    else
                    {
                        $data["msg"]        = 'Something went wrong';
                    }
                }
            }
          
            echo json_encode($data);
            exit;
        }
       
    }

    
    
}
