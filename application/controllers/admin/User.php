<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();   
        $this->load->model('Crud', 'crud');
        $this->load->model('admin/user_model');
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $data = array();
        $day30_ago_date = date('Y-m-d', strtotime('-30 days'));
        $month_to_date = date('Y-m');
        $today_date = date('Y-m-d');

        $admin_id = $this->session->userdata('userId');
        $admin_q  = $this->crud->get_one_row("tbl_users",array("isDeleted" =>0,"id"=>$admin_id));
        /*echo "<pre>";
        print_r($admin_q); exit();
        */$data['admin_d'] = $admin_q;

        $users_q  = $this->crud->get_data("tbl_customer",array("is_delete" =>0,"status" =>'Y',"is_verified" =>1));
        $this->global['users_q'] = count($users_q);

        $country_q  = $this->crud->get_data("country",array("isDelete" =>0,"status" =>'Y'));
        $this->global['country_q'] = count($country_q);

        $state_q    = $this->crud->get_data("state",array("isDelete" =>0,"status" =>'Y'));
        $this->global['state_q'] = count($state_q);

        $city_q     = $this->crud->get_data("city",array("isDelete" =>0,"status" =>'Y'));
        $this->global['city_q'] = count($city_q);
        
        $data['total_stores'] = 0;
        
        $this->global['pageTitle'] = ' : Dashboard';
        $this->loadViews(ADMIN."dashboard", $this->global, $data , NULL);
    }


     /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
        $this->global['pageTitle'] = ' : Change Password';
        
        $this->loadViews(ADMIN."changePassword", $this->global, NULL, NULL);
    }

     
    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        $post =  $this->input->post();

        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');

        
        if($this->form_validation->run() == FALSE)
        {
            $this->loadChangePass();
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);

            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password not correct');
                redirect(ADMIN.'loadChangePass');
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword),
                                'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) 
                { 
                    $this->session->set_flashdata('success', 'Password updation successful'); 
                }
                else 
                { 
                    $this->session->set_flashdata('error', 'Password updation failed'); 
                }
                
                redirect(ADMIN.'loadChangePass'); 
            }
        }
    }

    

}

?>