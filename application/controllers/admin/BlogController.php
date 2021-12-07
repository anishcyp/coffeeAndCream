<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class BlogController extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();  
        $this->load->model('Crud', 'crud'); 
        $this->table = 'blog';
    }

    function index()
    {   
        
        $result = $this->SiteSetting_model->getSiteSetting();
        $data["siteSetting"] = $result[0];

        $this->global['pageTitle'] = ' : Blog List';
        $this->loadViews(ADMIN."blog_manage", $this->global, $data, NULL);
       
    }
    
    function ajax_datatable()
    {
        $tablename = base64_encode($this->table);
        $tableId = base64_encode('blog_id');

        $config['select'] = 'b.*';
        $config['table'] = 'blog b';

        $config['column_order'] = array('b.title');
        $config['column_search'] = array('b.title');         
        $config['order'] = array('b.blog_id' => 'desc');
        $config['custom_where'] = array('b.isDelete'=>0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();

        foreach ($records as $record) {
          
            $details['blog_cate']  = $this->crud->get_row_by_id('blog_category',array("id"=>$record->blog_cate));

            $action = '';
            $action .= '
                <a href="'.ADMIN_LINK.'manage-blog/edit/'.$record->blog_id.'" class="btn btn-icon waves-effect btn-success"> <i class="fa fa-edit"></i></a>

                <a href="'.ADMIN_LINK.'manage-blog/view/'.$record->blog_id.' " class="btn btn-icon waves-effect btn-warning rowEdit" data-id="'.$record->blog_id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-eye"></i> </a> 

                <a onclick="return isConfirm()" href="'.ADMIN_LINK.'manage-blog/delete/'.$record->blog_id.'" class="btn btn-icon waves-effect btn-danger"> <i class="fa fa-trash"></i></a>';

            
            
            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';
            

            $row = array();
            if(file_exists(UPLOAD_DIR.BLOG_IMG.$record->blog_image) && $record->blog_image!='')  
            {
                $row[] = '<img width="130" height="150" src="'.base_url(UPLOAD_DIR.BLOG_IMG.$record->blog_image).'">';
            }
            else
            {
                $row[] = '<img width="125" src="'.base_url(UPLOAD_DIR.'default.png').'">';
            }
            $row[] = $details['blog_cate']['name'];
            $row[] = $record->title;
            $row[] = "<p style='word-break:break-all;'>".$this->crud->limit_character(strip_tags($record->content),100)."</p>";


            

            $row[] = '<input class="changeStatus" data-id="'.$record->blog_id.'" data-status="'.$status.'" data-td="'.$tablename.'" data-i="'.$tableId.'" type="checkbox"  '.$ischecked.' id="switch'.$record->blog_id.'" switch="bool"/><label for="switch'.$record->blog_id.'" data-on-label="Yes" data-off-label="No"></label>';
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

    function delete($id) 
    {
        $data = array( "isDelete" => 1);
        $result = $this->crud->update($this->table,$data,array("blog_id"=>$id));
        if($result) 
        {
            $update_data =  array(
                "isDelete"  => '1',
            );
            $wh_data= array("blog_id"=>$id);
            $this->crud->update("blog_comment",$update_data,$wh_data);

            $this->session->set_flashdata('success', 'Data Deteted successfully');
        } 
        else 
        {
            $this->session->set_flashdata('error', 'Something Was Wrong.');            
        }      
        redirect(ADMIN.'manage-blog');
    }

    function getDetail($id)
    {
        $result = $this->crud->get_row_by_id($this->table,' blog_id = "'.$id.'"  ');
        $this->global['pageTitle'] = ' : Blog Details';
        $data['detail'] = $result;
        $this->loadViews(ADMIN."blog_detail", $this->global, $data, NULL);
    }

    function ajax_datatable_comment()
    {
        $blog_id = $this->input->post('blog_id');
        $tablename = base64_encode('blog_comment');
        $tableId = base64_encode('id');

        $config['select'] = 'bc.*,cus.fname as fname';
        $config['table'] = 'blog_comment bc';
        
        $config['joins'][] = array(
            'join_table' => 'tbl_customer cus', 
            'join_by' => 'cus.id = bc.uid ', 
            'join_type' => 'inner');

        
        $config['column_order'] = array('bc.id');
        $config['column_search'] = array('bc.id','bc.msg','cus.fname');         
        $config['order'] = array('bc.id' => 'desc');
        $config['custom_where'] = array('bc.isDelete'=>0,'bc.blog_id'=>$blog_id);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();

        $data = array();
        foreach ($records as $record) {
            
            $action = '';
            $action .= '
                
                <a onclick="return isConfirm()" href="'.ADMIN_LINK.'BlogController/delete_comment/'.$record->id.'" class="btn btn-icon waves-effect btn-danger"> <i class="fa fa-trash"></i></a>';
            
            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';
            

            $row = array();
            $row[] = $record->fname;
            $row[] = $record->msg;
            $row[] = '<input class="changeStatusMe" data-id="'.$record->id.'" data-status="'.$status.'" data-td="'.$tablename.'" data-i="'.$tableId.'" type="checkbox"  '.$ischecked.' id="switch'.$record->id.'" switch="bool"/><label for="switch'.$record->id.'" data-on-label="Yes" data-off-label="No"></label>';
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


    function delete_comment($id) {
        $data = array( "isDelete" => 1);
        $result = $this->crud->update('blog_comment',$data,array("id"=>$id));
        if($result) {
            $this->session->set_flashdata('success', 'Data Deteted successfully');
        } else {
            $this->session->set_flashdata('error', 'Something Was Wrong.');            
        }      
        redirect(ADMIN.'manage-blog');
    }


    function showform($id="")
    {
        $this->global['pageTitle']  = ' : Blog - Add ';
        $data['type_title']         = "Blog";
        $blogcate_lists = $this->crud->get_all_with_where('blog_category','name','desc',array('status'=>'Y','isDelete'=>0));
        $data["blogcate_lists"]      = $blogcate_lists;

        if(isset($id) && $id!="") 
        {
            $data['editid']      = $id;
            $data["type"]        = "edit";
            $data['edit']        = $this->crud->get_row_by_id($this->table,array("blog_id"=>$id));

        } else {
            $data["type"]        = "add";
        }

        $this->loadViews(ADMIN."add_blog", $this->global, $data, NULL);
    }

    function StoreBlogs()
    {
        $this->load->library("upload");
        $post = $this->input->post();
        
        $this->form_validation->set_rules('blog_cate','Category *','trim|required');
        $this->form_validation->set_rules('title','Title *','trim|required');
        $this->form_validation->set_rules('content','Message *','trim|required');
        $this->form_validation->set_rules('service','Service type *','trim|required');
        $this->form_validation->set_rules('blog_date','Blog Date *','trim|required');
        $this->form_validation->set_rules('author','Author *','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->showform();
        }
        else
        {
            $type       = $this->input->post('type'); 
            $editid     = $this->input->post('editid');
            $isActive   = ( isset($post['isActive']) && $post['isActive'] == 'on' ? 'Y' : 'N');
            $user_id    = $this->session->userdata('userId');
            $added_by  = "1";
            $title_slug = $this->slug->create_slug($post['title']);
            
            if($type == "add")
            {
                $is_duplicate = $this->crud->check_duplicate($this->table,array("title_slug"=>$title_slug,"isDelete"=>"0"));
                if($is_duplicate)
                {
                    $this->session->set_flashdata('error', 'Record already exists. Please try another.');
                    redirect(ADMIN.'manage-blog');
                }
            }

            if($type == "edit")
            {
                $edit_id = $this->input->post('editid'); 
                $is_duplicate = $this->crud->check_duplicate($this->table,array("blog_id!="=>$editid,"title_slug"=>$title_slug,"isDelete"=>"0"));
                if($is_duplicate)
                {
                    $this->session->set_flashdata('error', 'Record already exists. Please try another.');
                    redirect(ADMIN.'manage-blog');
                }
            }

            $filename = "";
            if($_FILES['blog_image']['error'] == 0)
            {
                $allowed_types = "jpg|png|jpeg";
                $filename = $this->crud->upload_file('blog_image', UPLOAD_DIR.BLOG_IMG,$allowed_types); 

                if($filename=="")
                {
                  $filename = "";
                } 
            }

            if($type == "edit")
            {
                //if admin edit user record so we need to get user id
                $edit_id = $this->input->post('editid'); 
                $data['edit']  = $this->crud->get_row_by_id($this->table,array("blog_id"=>$edit_id));

                $user_id    = $data['edit']['user_id'];
                $added_by   = $data['edit']['added_by'];

                if($filename=="")
                {
                    $filename = $post["old_blog_image"];
                }
                else
                {
                    if($post["old_blog_image"]!="" && file_exists(UPLOAD_DIR.BLOG_IMG.$post["old_blog_image"]))
                    {
                        @unlink(UPLOAD_DIR.BLOG_IMG.$post["old_blog_image"]);
                    }
                } 
            }

            $fieldInfo = array(
                'user_id'                   =>  $user_id,
                'added_by'                  =>  $added_by,
                'blog_cate'                 =>  $post['blog_cate'],
                'service_type'              =>  $post['service'],
                'title'                     =>  $post['title'],
                'title_slug'                =>  $title_slug,
                'content'                   =>  $post['content'],
                'blog_image'                =>  $filename,
                'blog_date'                 =>  date("Y-m-d",strtotime($post['blog_date'])),
                'author'                    =>  $post['author'],
                'meta_des'                  =>  $post['meta_des'],
                'status'                    =>  $isActive,
            );

            if($type == "add")
            {
                $insert_result = $this->crud->insert($this->table,$fieldInfo);
                // if($isActive == 'Y')
                // {
                //     $updatefieldInfo = array(
                //         'is_mail_sent' =>  '1',
                //     );
                    
                //     $where_array = array('blog_id'=>$insert_result);
                //     $update_result = $this->crud->update($this->table,$updatefieldInfo,$where_array);
                    
                //     $customers = $this->crud->get_all_with_where('tbl_customer','id','desc',array('status'=>'Y','is_delete' => 0));
                //     foreach($customers as $customer)
                //     {
                //         $mailEmail = $customer->email;

                //         $blog_link = base_url("blog/details/".$title_slug);

                //         /* General setting common from all email start */
                //         $general_setting            =  $this->generalSetting(); 
                //         $mail_data['site_name']     = $general_setting->site_name;
                //         $mail_data['site_title']    = $general_setting->site_title;
                //         $mail_data['address']       = $general_setting->address;
                //         $mail_data['copyright_year'] = date("Y");                   
                //         /* General setting common from all email end */

                //         $mail_data['fname']         = $customer->fname;
                //         $mail_data['link']          = $blog_link;

                //         $message = $this->load->view('mail_template/blog_mail_template', $mail_data, TRUE);
                //         $mailbody['ToEmail']    = $mailEmail;
                //         $mailbody['FromName']   = $general_setting->site_name;
                //         $mailbody['FromEmail']  = $general_setting->site_from_email;
                //         $mailbody['Subject']    = "New Blog";
                //         $mailbody['Message']    = $message;
            
                //         $mail_result = $this->EmailSend($mailbody);
                //     }
                // }
                
            }
            if($type == "edit")
            {
                $editid = $this->input->post('editid'); 
                $where_array = array('blog_id'=>$editid);
                $update_result = $this->crud->update($this->table,$fieldInfo,$where_array);
            }

            if($insert_result > 0)
            {
                $this->session->set_flashdata('success', 'Details inserted successfully');
            }
            else if($update_result > 0)
            {
                $this->session->set_flashdata('success', 'Details updated successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }
            
           redirect(ADMIN.'manage-blog');

        }
       
    }

    function blog_category()
    {
        $this->global['pageTitle'] = '  : Blog Category';
        $this->loadViews(ADMIN."blog_category", $this->global, NULL, NULL);
    }

    function ajax_datatable_blog_category()
    {
        $tblId      = "id";
        $tblName    = "blog_category";
        $tablename  = base64_encode($tblName);
        $tableId    = base64_encode($tblId);

        $config['select'] = $tblName.'.*';
        $config['table'] = $tblName;
        $config['column_order'] = array($tblName.'.name');
        $config['column_search'] = array($tblName.'.name');         
        $config['order'] = array($tblId => 'desc');
        $config['custom_where'] = array('isDelete'=>0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        
        foreach ($records as $record) {
          
            $action = '';
            $action .= '<button class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->$tblId.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </button> ';

            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->$tblId.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';
            
            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';
            

            $row = array();
            $row[] = $record->name;
            $row[] = '<input class="changeStatus" data-id="'.$record->$tblId.'" data-status="'.$status.'" data-td="'.$tablename.'" data-i="'.$tableId.'" type="checkbox"  '.$ischecked.' id="switch'.$record->$tblId.'" switch="bool"/><label for="switch'.$record->$tblId.'" data-on-label="Yes" data-off-label="No"></label>';
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

    public function getBlogList()
    {
        $keyword = $this->input->post('keyword');
        
        if($keyword != "")
        {

            print_r($keyword); exit;

            // $tb_customer = $this->crud->get_all_with_where("blog","title_slug","asc",array("isDelete" => 0,"service_type"=>'1',"status"=>'Y',"title like" => '%'.$keyword.'%'));

            // echo "<pre>";
            // print_r($tb_customer);
            // exit;

        }
    }

    public function get_sugg(){
        echo "hello wordsd";
         exit();
    }
}