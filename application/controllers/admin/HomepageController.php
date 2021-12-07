<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class HomepageController extends BaseController {


	public function home_page_view(){

        $this->global['pageTitle'] = 'Home Page Banner';
        $this->loadViews(ADMIN."manage_home_page", $this->global, NULL , NULL);

    }


	 function ajax_home_page_datatable(){
        
        $tablename = base64_encode('home_page');
        $tableId = base64_encode('id');

        $config['select'] = 'home_page.*';
        $config['table'] = 'home_page';

        $config['column_order'] = array('home_page.title');
        $config['column_search'] = array('home_page.title');         
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
            
            $dis_image = "";
            if(file_exists(UPLOAD_DIR.SLIDER_IMG.$record->slider_image) && $record->slider_image!="")
            {
                $dis_image = '<img class="media-object text-center" src="'.APP_URL.UPLOAD_DIR.SLIDER_IMG.$record->slider_image.'" style="width: 150px; height: auto;">';
            }

            $row = array();
            $row[] = $record->id;
            $row[] = $dis_image;
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

    function insertRecord()
    {
        $this->load->library("upload");
        $post = $this->input->post();
        
        $table_name = base64_decode($this->input->post('td')); 
            $field      	= base64_decode($this->input->post('i')); 
            $type       	= $this->input->post('type'); 
            $editid     	= $this->input->post('editid');
            $isActive   	= ( isset($post['isActive']) && $post['isActive'] == 'on' ? 'Y' : 'N');
            
            $this->load->library('form_validation');            
        
            $filename = "";
                if($_FILES['page_image']['error'] == 0)
                {                    
                    $filename = $this->crud->upload_file('page_image', UPLOAD_DIR.SLIDER_IMG);  
                }

            if($type == "edit")
            {
                if($filename=="")
                {
                    $filename = $post["old_page_image"];
                }
                else
                {
                    if(!empty($post["old_page_image"]) && file_exists(UPLOAD_DIR.SLIDER_IMG.$post["old_page_image"]))
                    {
                        @unlink(UPLOAD_DIR.SLIDER_IMG.$post["old_page_image"]);
                    }
                } 
            }

            unset($post["editid"]);
            unset($post["type"]);
            unset($post["isActive"]);
            unset($post["td"]);
            unset($post["i"]);

            $fieldInfo = array(
                'slider_image'              => $filename,
                'created_at'                => date('Y-m-d H:i:s'),
                'status'                    => $isActive,
            );

            if($type == "add")
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

            if($type == "edit")
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
            echo json_encode($data);
            exit;
    }

    public function homePage_Des()
    {
        $this->global['pageTitle'] = 'Manage Testimonial';
        $this->loadViews(ADMIN."manage_testimonial", $this->global, NULL , NULL);
    }


    function ajax_home_des_datatable(){
        
        $tablename = base64_encode('home_page_description');
        $tableId = base64_encode('id');

        $config['select'] = 'home_page_description.*';
        $config['table'] = 'home_page_description';

        $config['column_order'] = array('home_page_description.designation');
        $config['column_search'] = array('home_page_description.designation');         
        $config['custom_where'] = array('isDelete' => 0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
                        //echo $this->db->last_query(); exit;
        $data = array();
        

        foreach ($records as $record) {
          
            $action = '';
            $action .= '<button class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </button> ';
            
            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';
            

            $row = array();
            $row[] = $record->id;
            $row[] = $record->designation;
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


    function insertRecordDes()
    {
        $post = $this->input->post();
        
        $this->load->library("upload");
       
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('designation','Designation ','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $data["msg"]        = validation_errors();
            $data["msg_type"]   = 'error';
            echo json_encode($data);
            exit;
        }
        else
        {
            $table_name     = base64_decode($this->input->post('td')); 
            $field          = base64_decode($this->input->post('i')); 
            $type           = $this->input->post('type'); 
            $name           = $this->input->post('name'); 
            $designation    = $this->input->post('designation'); 
            $description    = $this->input->post('description'); 
            $editid         = $this->input->post('editid');
            $isActive       = ( isset($post['isActive']) && $post['isActive'] == 'on' ? 'Y' : 'N');           
        
            $filename = "";
                if($_FILES['page_image']['error'] == 0)
                {                    
                    $filename = $this->crud->upload_file('page_image', UPLOAD_DIR.SLIDER_IMG);  
                }

            if($type == "edit")
            {
                if($filename=="")
                {
                    $filename = $post["old_page_image"];
                }
                else
                {
                    if(!empty($post["old_page_image"]) && file_exists(UPLOAD_DIR.SLIDER_IMG.$post["old_page_image"]))
                    {
                        @unlink(UPLOAD_DIR.SLIDER_IMG.$post["old_page_image"]);
                    }
                } 
            }

            unset($post["editid"]);
            unset($post["type"]);
            unset($post["isActive"]);
            unset($post["td"]);
            unset($post["i"]);

            $fieldInfo = array(
                'name'                      => $name,
                'designation'               => $designation,
                'description'               => $description,
                'page_image'                => $filename,
                'created_at'                => date('Y-m-d H:i:s'),
                'status'                    => $isActive,
            );

            if($type == "add")
            {   
                //echo $table_name;
                //print_r($fieldInfo);
                $result = $this->crud->insert($table_name,$fieldInfo);
                //print_r($result );

                if($result > 0)
                {
                    $data["msg"]        = 'Record Added successfully';
                }
                else
                {
                    $data["msg"]        = 'Something went wrong..';
                }
            }

            if($type == "edit")
            {

                $where_array = array($field=>$editid);
                $result = $this->crud->update($table_name,$fieldInfo,$where_array);

                if($result > 0)
                {
                    $data["msg"]        = 'Record Updated successfully';
                }
                else
                {
                    $data["msg"]        = 'Something went wrong.';
                }
            }
          
            echo json_encode($data);
            exit;
        }
       
    }

    public function img_view()
    {
        $data = array();

        $this->global['pageTitle'] = 'Manage Service Image';
        $this->loadViews(ADMIN."manage_service_image", $this->global, NULL , NULL);
    }



    function insertRecordImage()
    {
        $post = $this->input->post();
        $this->load->library("upload");
       
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('description','Description ','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $data["msg"]        = validation_errors();
            $data["msg_type"]   = 'error';
            echo json_encode($data);
            exit;
        }
        else
        {
            $table_name     = base64_decode($this->input->post('td')); 
            $field          = base64_decode($this->input->post('i')); 
            $type           = $this->input->post('type'); 
            $description    = $this->input->post('description'); 
            $editid         = $this->input->post('editid');
            $isActive       = ( isset($post['isActive']) && $post['isActive'] == 'on' ? 'Y' : 'N');           
        
            $filename = "";
                if($_FILES['page_image']['error'] == 0)
                {                    
                    $filename = $this->crud->upload_file('page_image', UPLOAD_DIR.HOME_SER_IMG);  
                }

            if($type == "edit")
            {
                if($filename=="")
                {
                    $filename = $post["old_page_image"];
                }
                else
                {
                    if(!empty($post["old_page_image"]) && file_exists(UPLOAD_DIR.HOME_SER_IMG.$post["old_page_image"]))
                    {
                        @unlink(UPLOAD_DIR.HOME_SER_IMG.$post["old_page_image"]);
                    }
                } 
            }

            unset($post["editid"]);
            unset($post["type"]);
            unset($post["isActive"]);
            unset($post["td"]);
            unset($post["i"]);

            $fieldInfo = array(
                'description'               => $description,
                'page_image'                => $filename,
                'created_at'                => date('Y-m-d H:i:s'),
                'status'                    => $isActive,
            );

            if($type == "add")
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

            if($type == "edit")
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
          
            echo json_encode($data);
            exit;
        }
       
    }


    function ajax_home_image_datatable(){
        
        $tablename = base64_encode('home_service_images');
        $tableId = base64_encode('id');

        $config['select'] = 'home_service_images.*';
        $config['table'] = 'home_service_images';

        $config['column_order'] = array('home_service_images.description');
        $config['column_search'] = array('home_service_images.description');         
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
            
             $dis_image = "";
            if(file_exists(UPLOAD_DIR.HOME_SER_IMG.$record->page_image) && $record->page_image!="")
            {
                $dis_image = '<img class="media-object text-center" src="'.APP_URL.UPLOAD_DIR.HOME_SER_IMG.$record->page_image.'" style="width: 150px; height: auto;">';
            }

            $row = array();
            $row[] = $record->id;
            $row[] = $dis_image;
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

    public function view_service_content()
    {
        $data = array();

        $this->global['pageTitle'] = 'Home Page Service Content';
        $this->loadViews(ADMIN."manage_service_content", $this->global, NULL , NULL);
    }

    function ajax_service_content_datatable(){
        
        $tablename = base64_encode('home_service_content');
        $tableId = base64_encode('id');

        $config['select'] = 'home_service_content.*';
        $config['table'] = 'home_service_content';

        $config['column_order'] = array('home_service_content.description');
        $config['column_search'] = array('home_service_content.description');         
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
            
          
            $row = array();
            $row[] = $record->id;
            $row[] = $record->name;
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

    function insertRecordContent()
    {
        $post = $this->input->post();
        $this->load->library("upload");
       
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
            $table_name     = base64_decode($this->input->post('td')); 
            $field          = base64_decode($this->input->post('i')); 
            $type           = $this->input->post('type'); 
            $name           = $this->input->post('name'); 
            $description    = $this->input->post('description'); 
            $editid         = $this->input->post('editid');
            $isActive       = ( isset($post['isActive']) && $post['isActive'] == 'on' ? 'Y' : 'N');           
        

            unset($post["editid"]);
            unset($post["type"]);
            unset($post["isActive"]);
            unset($post["td"]);
            unset($post["i"]);

            $fieldInfo = array(
                'name'                      => $name,
                'description'               => $description,
                'created_at'                => date('Y-m-d H:i:s'),
                'status'                    => $isActive,
            );

            if($type == "add")
            {

                $result = $this->crud->insert('home_service_content',$fieldInfo);

                // echo $this->db->last_query(); die();


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

                $where_array = array($field=>$editid);
                $result = $this->crud->update('home_service_content',$fieldInfo,$where_array);

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

}           