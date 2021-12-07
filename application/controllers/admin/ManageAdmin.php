<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class ManageAdmin extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();  
        $this->load->model('Crud', 'crud'); 
        $this->table = 'tbl_users';
    }

    function index()
    {
        $this->global['pageTitle'] = ' : Manage Admin';
        $this->loadViews(ADMIN."ManageAdmin", $this->global, NULL, NULL);
    }
    
    function ajax_datatable()
    {

        $job_type = $this->config->item('tbl_users');
        $tablename = base64_encode($this->table);
        $tableId = base64_encode('id');

        $config['select'] = 'us.*';
        $config['table'] = 'tbl_users us';
        
        $config['column_order'] = array('us.id');
        $config['column_search'] = array('us.fname','us.lname','us.email');         
        $config['order'] = array('us.id' => 'desc');
        $config['custom_where'] = array('isDeleted'=>0);

        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();

        foreach ($records as $record) 
        {
            $role_name = $this->crud->get_column_value_by_id("tbl_roles","role","id = '".$record->roleId."'");

            $action = '';

            $action .= '<div class="d-flex">
                            <a href="'.ADMIN_LINK.'manage-admin/edit/'.$record->id.'" class="mr-2"> <i class="far fa-edit"></i></a>

                            <a onclick="return isConfirm()" href="'.ADMIN_LINK.'manage-admin/delete/'.$record->id.'"> <i class="far fa-trash-alt"></i></a>
                        </div>';       

            $row = array();
            $row[] = $record->email;
            $row[] = $record->fname." ".$record->lname;
            $row[] = $record->mobile;
            $row[] = $role_name;
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

    function showform($id="")
    {
        $this->global['pageTitle']  = ' : Add Admin ';
        $data['type_title']         = "Admin";
        
        if(isset($id) && $id!="") 
        {
            $data['editid']      = $id;
            $data["type"]        = "edit";
            $data['edit']        = $this->crud->get_row_by_id($this->table,array("id"=>$id));

        } 
        else 
        {
            $data["type"]        = "add";
        }

        $role_lists = $this->crud->get_all_with_where('tbl_roles','id','asc',array('status'=>'Y','isDelete' => '0', 'id!=' => 1));
        $data["role_lists"]   = $role_lists;

        $this->loadViews(ADMIN."add_admin", $this->global, $data, NULL);
    }

    function store() 
    {
        $post = $this->input->post();
        $type = $post['type'];

        $this->form_validation->set_rules('fname','fname', 'trim|required');
        $this->form_validation->set_rules('lname','lname', 'trim|required');
        $this->form_validation->set_rules('email','email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('mobile','phone', 'trim|required');
        $this->form_validation->set_rules('roleId','Role', 'trim|required');

        if($type == "add")
        {
            $this->form_validation->set_rules('password','password', 'trim|required');
        }

        $admin_user_id          = $this->session->userdata('userId');
        $fname                  = $post['fname'];
        $lname                  = $post['lname'];
        $email                  = $post['email'];
        $mobile                 = $post['mobile'];
        $roleId                 = $post['roleId'];

        if ($this->form_validation->run() == FALSE) 
        {
            $this->showform();
        } 
        else 
        {
            if($type == "add")
            {
                $fieldInfo['added_by']    = "1";
                $fieldInfo['password']    = getHashedPassword($post['password']);

                $where_query = array('email'=>$email,"isDeleted"=>0);
                $mobile_where_query = array('mobile'=>$mobile,"isDeleted"=>0);
            }
            else
            {
                $where_query = array('email'=>$email,"isDeleted"=>0,"id!=" => $post['editid']);
                $mobile_where_query = array('mobile'=>$mobile,"isDeleted"=>0,"id!=" => $post['editid']);
            }

            $check_duplicate = $this->crud->check_duplicate($this->table,$where_query);
            $check_duplicate_mobile = $this->crud->check_duplicate($this->table,$mobile_where_query);
            if($check_duplicate)
            {
                $this->session->set_flashdata('error', 'This email id is already registered with us.');
                redirect(ADMIN.'manage-admin');
            }
            else if($check_duplicate_mobile)
            {
                $this->session->set_flashdata('error', 'This mobile is already registered with us.');
                redirect(ADMIN.'manage-admin');
            }
            else
            {
                $fieldInfo = array(
                    'userId'                 =>  $admin_user_id,
                    'fname'                  =>  $fname,
                    'lname'                  =>  $lname,
                    'email'                  =>  $email,
                    'mobile'                 =>  $mobile,
                    'roleId'                 =>  $roleId,
                );

                if($type == "add")
                {
                    $insert_result = $this->crud->insert($this->table,$fieldInfo);
                }

                if($type == "edit")
                {
                    $editid = $this->input->post('editid'); 
                    $is_role_exist = $this->crud->get_column_value_by_id($this->table,"roleId","id = '".$editid."'");
                    
                    $where_array = array('id'=>$editid);
                    $update_result = $this->crud->update($this->table,$fieldInfo,$where_array);

                    if($is_role_exist == 0 || $is_role_exist == "")
                    {
                        if($roleId!=0 || $roleId!="")
                        {
                            $admin_login_link = base_url(ADMIN."login");

                            /* General setting common from all email start */
                            $general_setting            = $this->generalSetting(); 
                            $mail_data['site_name']     = $general_setting->site_name;
                            $mail_data['site_title']    = $general_setting->site_title;
                            $mail_data['site_email']    = $general_setting->email;
                            $mail_data['site_logo']     = base_url('public/front/images/logo/'.$general_setting->site_logo );
                            $mail_data['address']       = $general_setting->address;
                            $mail_data['fb_link']       = $general_setting->fb_link;
                            $mail_data['twitter_link']  = $general_setting->twitter_link;
                            $mail_data['instagram_link'] = $general_setting->instagram_link;
                            /* General setting common from all email end */

                            $mail_data['fname']         = $fname;
                            $mail_data['url']           = $admin_login_link;

                            $message = $this->load->view('mail_template/role_assigned_mail_template', $mail_data, TRUE);

                            $mailbody['ToEmail']    = $email;
                            $mailbody['FromName']   = $general_setting->site_name;
                            $mailbody['FromEmail']  = $general_setting->site_from_email;
                            $mailbody['Subject']    = $general_setting->site_name." - Role assigned to your account";
                            $mailbody['Message']    = $message;
                
                            $mail_result = $this->EmailSend($mailbody);
                        }
                    }
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

                redirect(ADMIN.'manage-admin');
            }
        }
    }

    function delete($id) 
    {
        $data = array( "isDeleted" => 1);
        $result = $this->crud->update($this->table,$data,array("id"=>$id));
        if($result) 
        {
            $update_data1 =  array(
                "isDeleted"  => '1',
            );
            $wh_data1 = array("id"=>$id);
            $this->crud->update($this->table,$update_data1,$wh_data1);
            
            $this->session->set_flashdata('success', 'Record deleted successfully');
        } 
        else 
        {
            $this->session->set_flashdata('error', 'Something went wrong.');            
        }      
        redirect(ADMIN.'manage-admin');
    }
}