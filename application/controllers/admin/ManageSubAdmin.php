<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class ManageSubAdmin extends BaseController
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
        $this->global['pageTitle'] = ' : Manage Sub Admin';
        $this->loadViews(ADMIN."manage_sub_admin", $this->global, NULL, NULL);
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
        $config['custom_where'] = array('isDeleted'=>0,'roleId'=>2);

        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();

        foreach ($records as $record) 
        {
            $role_name = $this->crud->get_column_value_by_id("tbl_roles","role","id = '".$record->roleId."'");

            $action = '';

            $action .= '<button class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </button> ';
            
            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDeleted" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';       

            $row = array();
            $row[] = $record->id;
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


    function store() 
    {
        $post = $this->input->post();
        // echo "<pre>";
        // print_r($post);
        // exit();
        $type = $post['type'];

        $this->form_validation->set_rules('fname','fname', 'trim|required');
        $this->form_validation->set_rules('lname','lname', 'trim|required');
        $this->form_validation->set_rules('email','email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('mobile','phone', 'trim|required');

        if($type == "add")
        {
            $this->form_validation->set_rules('password','password', 'trim|required');
        }

        $admin_user_id          = $this->session->userdata('userId');
        $fname                  = $post['fname'];
        $lname                  = $post['lname'];
        $email                  = $post['email'];
        $mobile                 = $post['mobile'];
        $roleId                 = 2;

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
                $data["msg"] = 'This email id is already registered with us.';
            }
            else if($check_duplicate_mobile)
            {
                $data['msg']    = 'This mobile is already registered with us.';
            }
            else
            {
                if($type == "add")
                {
                    $fieldInfo = array(
                    'userId'                    =>  $admin_user_id,
                    'fname'                     =>  $fname,
                    'lname'                     =>  $lname,
                    'email'                     =>  $email,
                    'mobile'                    =>  $mobile,
                    'password'                  =>  getHashedPassword($post['password']),
                    'roleId'                    =>  2,
                    'video'                     =>  isset($post['video']) ? "1" : "0",
                    'sub_admin'                 =>  isset($post['sub_admin']) ? "1" : "0",
                    'blog'                      =>  isset($post['blog']) ? "1" : "0",
                    'manage_agency'             =>  isset($post['manage_agency']) ? "1" : "0",
                    'manage_hen_stag'           =>  isset($post['blog']) ? "1" : "0",
                    'send_mail'                 =>  isset($post['send_mail']) ? "1" : "0",
                    'about'                     =>  isset($post['about']) ? "1" : "0",
                    'user_list'                 =>  isset($post['user_list']) ? "1" : "0",
                    'advert_plan'               =>  isset($post['advert_plan']) ? "1" : "0",
                    'membership_Plan'           =>  isset($post['membership_Plan']) ? "1" : "0",
                    'service'                   =>  isset($post['service']) ? "1" : "0",
                    'favorite'                  =>  isset($post['favorite']) ? "1" : "0",
                    'language'                  =>  isset($post['language']) ? "1" : "0",
                    'location'                  =>  isset($post['location']) ? "1" : "0",
                    'contact'                   =>  isset($post['contact']) ? "1" : "0",
                    'home'                      =>  isset($post['home']) ? "1" : "0",
                    'subscriber'                =>  isset($post['subscriber']) ? "1" : "0",
                    'setting'                   =>  isset($post['setting']) ? "1" : "0",
                    );

                    $insert_result = $this->crud->insert('tbl_users',$fieldInfo);

                    if($insert_result > 0)
                    {
                        $data["msg"] = 'Details inserted successfully';
                    }
                    else
                    {
                        $data["msg"] = 'Something went wrong';
                    }
                }

                if($type == "edit")
                {
                    $fieldInfo = array(
                    'fname'                     =>  $fname,
                    'lname'                     =>  $lname,
                    'mobile'                    =>  $mobile,
                    'sub_admin'                 =>  isset($post['sub_admin']) ? "1" : "0",
                    'video'                     =>  isset($post['video']) ? "1" : "0",
                    'blog'                      =>  isset($post['blog']) ? "1" : "0",
                    'send_mail'                 =>  isset($post['send_mail']) ? "1" : "0",
                    'about'                     =>  isset($post['about']) ? "1" : "0",
                    'manage_agency'             =>  isset($post['manage_agency']) ? "1" : "0",
                    'manage_hen_stag'           =>  isset($post['blog']) ? "1" : "0",
                    'user_list'                 =>  isset($post['user_list']) ? "1" : "0",
                    'advert_plan'               =>  isset($post['advert_plan']) ? "1" : "0",
                    'membership_Plan'           =>  isset($post['membership_Plan']) ? "1" : "0",
                    'service'                   =>  isset($post['service']) ? "1" : "0",
                    'favorite'                  =>  isset($post['favorite']) ? "1" : "0",
                    'language'                  =>  isset($post['language']) ? "1" : "0",
                    'location'                  =>  isset($post['location']) ? "1" : "0",
                    'contact'                   =>  isset($post['contact']) ? "1" : "0",
                    'home'                      =>  isset($post['home']) ? "1" : "0",
                    'subscriber'                =>  isset($post['subscriber']) ? "1" : "0",
                    'setting'                   =>  isset($post['setting']) ? "1" : "0",
                    );

                    $editid = $this->input->post('editid'); 
                    $is_role_exist = $this->crud->get_column_value_by_id($this->table,"roleId","id = '".$editid."'");
                    
                    $where_array = array('id'=>$editid);
                    $update_result = $this->crud->update($this->table,$fieldInfo,$where_array);

                    if($update_result > 0)
                    {
                        $data["msg"] = 'Details updated successfully';
                    }
                    else
                    {
                        $data["msg"] = 'Something went wrong';
                    }

                }
            }
        }
        echo json_encode($data);
        exit;
    }



    public function AdminDeleted()
    {
        $id = $this->input->post('id');
        $table_name = base64_decode( $this->input->post('td') );
        $field = base64_decode( $this->input->post('i') );
        
        $where_array = array($field => $id);

        $data_delete = array('isDeleted' => '1');

        $result = $this->crud->update($table_name,$data_delete,$where_array);
        //$result = $this->crud->delete($table_name,$where_array);
        
        if ($result > 0) { 
            echo(json_encode(array('status'=>TRUE))); 
        }
        else { 
            echo(json_encode(array('status'=>FALSE))); 
        }
    }


}