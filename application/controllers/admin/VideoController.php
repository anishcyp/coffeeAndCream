<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class VideoController extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();  
        $this->load->model('Crud', 'crud'); 
        $this->table = 'videos';
    }

    public function index()
    {
        $result = $this->SiteSetting_model->getSiteSetting();
        $data["siteSetting"] = $result[0];

        $this->global['pageTitle'] = ': Manage Videos';
        $this->loadViews(ADMIN."manage_videos", $this->global, $data, NULL);
    }

    function ajax_video_datatable(){
        
        $tablename = base64_encode('videos');
        $tableId = base64_encode('id');

        $config['select'] = 'videos.*';
        $config['table'] = 'videos';

        $config['column_order'] = array('videos.description');
        $config['column_search'] = array('videos.description');         
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
            if(file_exists(UPLOAD_DIR.VIDEO.$record->video_path) && $record->video_path!="")
            {
                $dis_image = '<video width="320" height="240" controls><source src="'.APP_URL.UPLOAD_DIR.VIDEO.$record->video_path.'" type="video/mp4"></video>';
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

    function insertRecordVideo()
    {
        $post = $this->input->post();
        // echo "<pre>";
        // print_r($post);
        // exit();
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
            $title           = $this->input->post('title'); 
            $description    = $this->input->post('description'); 
            $editid         = $this->input->post('editid');
            $isActive       = ( isset($post['isActive']) && $post['isActive'] == 'on' ? 'Y' : 'N');           
        
            // $filename = "";
                // if($_FILES['page_image']['error'] == 0)
                // {                    
                //     $filename = $this->crud->upload_file('page_image', UPLOAD_DIR.VIDEO);  
                // }

            $filename = "";
            if($_FILES['page_image']['error'] == 0)
            {
                $allowed_types = "pjpeg|jpg|tiff|webm|mkv|flv|mp4|gif||m4p|mp4";

                $filename = $this->crud->upload_file('page_image', UPLOAD_DIR.VIDEO,$allowed_types); 
                if($filename=="")
                {
                   
                    $data["msg"]        = 'Not Supported this file.';
                    
                } 
            }

            if($type == "edit")
            {
                if($filename=="")
                {
                    $filename = $post["old_page_image"];
                }
                else
                {
                    if(!empty($post["old_page_image"]) && file_exists(UPLOAD_DIR.VIDEO.$post["old_page_image"]))
                    {
                        @unlink(UPLOAD_DIR.VIDEO.$post["old_page_image"]);
                    }
                } 
            }

            unset($post["editid"]);
            unset($post["type"]);
            unset($post["isActive"]);
            unset($post["td"]);
            unset($post["i"]);

            $fieldInfo = array(
                'title'                     => $title,
                'description'               => $description,
                'video_path'                => $filename,
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

}