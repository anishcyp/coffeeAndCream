<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontController.php';

class Auth extends FrontController {

    public $now_time = null;
    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->now_time = date('Y-m-d H:i:s');
        $this->table = 'tbl_customer';
    }

    function view_login()
    {
        if ($this->session->userdata('customer_is_logged_in')) 
        {
            redirect(APP_URL);
        } 
        else 
        {
            $data = array();
            $data['pageTitle'] = "Login";
            $this->load->view(FRONTEND."login_page",$data);
        }
    }

    function view_register($name,$id)
    {
        if($id == 1 && $name== 'entertainment')
        {
            if ($this->session->userdata('customer_is_logged_in')) 
            {
                redirect(APP_URL);
            } 
            else 
            {
                $data = array();
                $data['service_name']   = $name;
                $data['user_role']      = $id;
                $data['pageTitle']      = "SignUp";
                $this->load->view(FRONTEND."signup_page",$data);
            }
        }
        else if($id == 2 && $name == 'escorts')
        {
            if ($this->session->userdata('customer_is_logged_in')) 
            {
                redirect(APP_URL);
            } 
            else 
            {
                $data = array();
                $data['service_name']   = $name;
                $data['user_role'] = $id;
                $data['pageTitle'] = "SignUp";
                $this->load->view(FRONTEND."signup_page",$data);
            }
        }
        else if($id == 4 && $name == 'agency')
        {
            if ($this->session->userdata('customer_is_logged_in')) 
            {
                redirect(APP_URL);
            } 
            else 
            {
                $data = array();
                $data['service_name']   = $name;
                $data['user_role'] = $id;
                $data['pageTitle'] = "SignUp";
                $this->load->view(FRONTEND."signup_page",$data);
            }
        }
        else if($id == 5 && $name == 'accommodation')
        {
            if ($this->session->userdata('customer_is_logged_in')) 
            {
                redirect(APP_URL);
            } 
            else 
            {
                $data = array();
                $data['service_name']   = $name;
                $data['user_role'] = $id;
                $data['pageTitle'] = "SignUp";
                $this->load->view(FRONTEND."signup_page",$data);
            }
        }
        else
        {
            $this->session->set_flashdata('error',"You don't have permission to access.");
            redirect("choose-user/");
        }
    }

    function view_choose_user()
    {
        if ($this->session->userdata('customer_is_logged_in')) 
        {
            redirect(APP_URL);
        } 
        else 
        {
            $data = array();
            $data['pageTitle'] = "Bunny Girls | Hot Strippers | Male kissogram | Stripper Party Bus";
            $this->load->view(FRONTEND."choose_user",$data);
        }
    }

    function view_registers()
    {
        $this->session->set_flashdata('error',"You don't have permission to access select service.");
        redirect("choose-user/");
    }

    function fblogin()
    {
        $post           = $this->input->post();
        $email          = $post['email'];
        $name           = $post['name'];
        $exp_name       = explode(" ", $name);
        $fname          = $exp_name[0];
        $lname          = $exp_name[1];
        $facebook_id    = $post['id'];


        if($email!="")
        {
            $cus_details = $this->crud->get_row_by_id($this->table,array('email'=>$email,'facebook_id!='=>'','is_delete'=>0));
            if($cus_details)
            {
                /****************Do Login****************/
                $cus_id  = $cus_details['id'];
                
                if($cus_details['status']=="N")
                {
                    echo "Acc_Suspended";
                    exit;
                }
                else
                {
                    $cusInfo = array(
                        'username'                  =>  $name,
                        'fname'                     =>  $fname,
                        'lname'                     =>  $lname,
                        'facebook_id'               =>  $facebook_id,
                        'is_verified'               =>  "1",
                        'verification_code'         =>  "",
                        'last_login'                =>  $this->now_time,
                    );

                    $result = $this->crud->update($this->table,$cusInfo,array("id"=>$cus_id));

                    if($result > 0)
                    {
                        $this->session->set_userdata('customer_is_logged_in',$cus_details);
                        $this->session->set_userdata('front_UserId',$cus_details['id']);
                        echo "Success_Login";
                        exit;
                    }
                    else
                    {
                        echo "Something_Wrong";
                        exit;
                    }
                }
                /****************Do Login****************/
            }
            else
            {

                $check_duplicate = $this->crud->check_duplicate($this->table,array('email'=>$email,'is_delete'=>0));
                if($check_duplicate)
                {
                    $this->session->set_flashdata('error', 'Your email id is already registered with us.');
                    redirect(APP_URL.'home');
                }
                else
                {
                    require_once('application/libraries/new_stripe/init.php');

                    $stripe = new \Stripe\StripeClient(
                        STRIPE_SECRET_KEY
                    );


                    $cus = $stripe->customers->create([
                        'email'         => $email,
                    ]);

                    $customer_id = $cus->id;

                    /****************Do Signup****************/
                    $signupInfo = array(
                        'customer_id'               =>  $customer_id,
                        'username'                  =>  $name,
                        'fname'                     =>  $fname,
                        'lname'                     =>  $lname,
                        'facebook_id'               =>  $facebook_id,
                        'email'                     =>  $email,
                        'is_verified'               =>  "1",
                        'verification_code'         =>  "",
                        'last_login'                =>  $this->now_time,
                        'status'                    =>  'Y',
                        'agency_status'             =>  'N',
                        'accommodation_user'        =>  0,
                    );

                    $result = $this->crud->insert($this->table,$signupInfo);

                    if($result > 0)
                    {
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
                        $mail_data['copyright_year'] = date("Y");
                        /* General setting common from all email end */

                        $mail_data['fname']         = "";
                        $mail_data['email']         = $email;
                        $mail_data['password']      = $password;
                        $mail_data['url']           = base_url('VerifyEmail/'.md5($result).'/'.$verification_code);

                        $message = $this->load->view('mail_template/loginwith_user_mail_template', $mail_data, TRUE);
                        //echo $message;die();
                        $admin_message = $this->load->view('mail_template/admin_register_mail_template', $mail_data, TRUE);
                        $admin_mailbody['ToEmail']    = $general_setting->site_from_admin_email;
                        $admin_mailbody['FromName']   = $general_setting->site_name;
                        $admin_mailbody['FromEmail']  = $general_setting->site_from_email;
                        $admin_mailbody['Subject']    = $general_setting->site_name." - New User Register";
                        $admin_mailbody['Message']    = $admin_message;
                       

                        $mailbody['ToEmail']    = $email;
                        $mailbody['FromName']   = $general_setting->site_name;
                        $mailbody['FromEmail']  = $general_setting->site_from_email;
                        $mailbody['Subject']    = $general_setting->site_name." - Registration Confirmation";
                        $mailbody['Message']    = $message;

                        $admin_result = $this->EmailSend($admin_mailbody);
                        $mail_result = $this->EmailSend($mailbody);

                        $cus_details = $this->crud->get_row_by_id($this->table,array('id'=>$result));
                        $this->session->set_userdata('customer_is_logged_in',$cus_details);
                        $this->session->set_userdata('front_UserId',$cus_details['id']);

                        echo "Success_Signup";
                        exit;
                    }
                    else
                    {
                        echo "Something_Wrong";
                        exit;
                    }
                }
            }
        }
        else
        {
            echo "Something_Wrong";
            exit;
        }
    }
    
    function googlelogin()
    {
        $post           = $this->input->post();
        $email          = $post['email'];
        $name           = $post['name'];
        $exp_name       = explode(" ", $name);
        $fname          = $exp_name[0];
        $lname          = $exp_name[1];
        $google_id    = $post['id'];


        if($email!="")
        {
            $cus_details = $this->crud->get_row_by_id($this->table,array('email'=>$email,'google_id!='=>'','is_delete'=>0));
            if($cus_details)
            {
                /****************Do Login****************/
                $cus_id  = $cus_details['id'];
                
                if($cus_details['status']=="N")
                {
                    echo "Acc_Suspended";
                    exit;
                }
                else
                {
                    $cusInfo = array(
                        'username'                  =>  $name,
                        'fname'                     =>  $fname,
                        'lname'                     =>  $lname,
                        'google_id'                 =>  $google_id,
                        'is_verified'               =>  "1",
                        'verification_code'         =>  "",
                        'last_login'                =>  $this->now_time,
                    );

                    $result = $this->crud->update($this->table,$cusInfo,array("id"=>$cus_id));

                    if($result > 0)
                    {
                        $this->session->set_userdata('customer_is_logged_in',$cus_details);
                        $this->session->set_userdata('front_UserId',$cus_details['id']);
                        echo "Success_Login";
                        exit;
                    }
                    else
                    {
                        echo "Something_Wrong";
                        exit;
                    }
                }
                /****************Do Login****************/
            }
            else
            {

                $check_duplicate = $this->crud->check_duplicate($this->table,array('email'=>$email,'is_delete'=>0));
                if($check_duplicate)
                {
                    $this->session->set_flashdata('error', 'Your email id is already registered with us.');
                    redirect(APP_URL.'home');
                }
                else
                {
                    require_once('application/libraries/new_stripe/init.php');

                    $stripe = new \Stripe\StripeClient(
                        STRIPE_SECRET_KEY
                    );


                    $cus = $stripe->customers->create([
                        'email'         => $email,
                    ]);

                    $customer_id = $cus->id;

                    /****************Do Signup****************/
                    $signupInfo = array(
                        'customer_id'               =>  $customer_id,
                        'username'                  =>  $name,
                        'fname'                     =>  $fname,
                        'lname'                     =>  $lname,
                        'google_id'                 =>  $google_id,
                        'email'                     =>  $email,
                        'is_verified'               =>  "1",
                        'verification_code'         =>  "",
                        'last_login'                =>  $this->now_time,
                        'status'                    =>  'Y',
                        'agency_status'             =>  'N',
                        'accommodation_user'        =>  0,
                    );

                    $result = $this->crud->insert($this->table,$signupInfo);

                    if($result > 0)
                    {
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
                        $mail_data['copyright_year'] = date("Y");
                        /* General setting common from all email end */

                        $mail_data['fname']         = "";
                        $mail_data['email']         = $email;
                        $mail_data['password']      = $password;
                        $mail_data['url']           = base_url('VerifyEmail/'.md5($result).'/'.$verification_code);

                        $message = $this->load->view('mail_template/loginwith_user_mail_template', $mail_data, TRUE);
                        //echo $message;die();

                        $admin_message = $this->load->view('mail_template/admin_register_mail_template', $mail_data, TRUE);
                        // print_r($general_setting->site_from_admin_email); exit;
                        // echo $message;die();

                        $admin_mailbody['ToEmail']    = $general_setting->site_from_admin_email;
                        $admin_mailbody['FromName']   = $general_setting->site_name;
                        $admin_mailbody['FromEmail']  = $general_setting->site_from_email;
                        $admin_mailbody['Subject']    = $general_setting->site_name." - New User Register";
                        $admin_mailbody['Message']    = $admin_message;
                       

                        $mailbody['ToEmail']    = $email;
                        $mailbody['FromName']   = $general_setting->site_name;
                        $mailbody['FromEmail']  = $general_setting->site_from_email;
                        $mailbody['Subject']    = $general_setting->site_name." - Registration Confirmation";
                        $mailbody['Message']    = $message;

                        $admin_result = $this->EmailSend($admin_mailbody);
                        $mail_result = $this->EmailSend($mailbody);

                        $cus_details = $this->crud->get_row_by_id($this->table,array('id'=>$result));
                        $this->session->set_userdata('customer_is_logged_in',$cus_details);
                        $this->session->set_userdata('front_UserId',$cus_details['id']);

                        echo "Success_Signup";
                        exit;
                    }
                    else
                    {
                        echo "Something_Wrong";
                        exit;
                    }
                }
            }
        }
        else
        {
            echo "Something_Wrong";
            exit;
        }
    }

    function login()
    {
        if ($this->session->userdata('customer_is_logged_in')) 
        {
            redirect(APP_URL);
        } 
        else 
        {
            $post = $this->input->post();
            $this->form_validation->set_rules('lemail','email', 'trim|required|valid_email');
            $this->form_validation->set_rules('lpassword', 'password', 'trim|required');

            $email      = $post['lemail'];
            $password   = $post['lpassword'];

            if ($this->form_validation->run() == FALSE) 
            {
                redirect(APP_URL.'SignIn');
            } 
            else 
            {
                $response = $this->crud->get_row_by_id($this->table,array('email'=>$email,'password'=>md5($password),'is_delete'=>0));
                if ($response) 
                {
                    if($response['is_verified']==0)
                    {
                        $this->session->set_flashdata('error', 'Sorry! your account is not verified. Please verify your account in order to login.');
                        redirect(APP_URL.'SignIn');
                    }
                    else
                    {
                        if($response['status']=="N")
                        {
                            $general_setting            = $this->generalSetting();
                            
                            $this->session->set_flashdata('error', 'This account has been temporarily suspended. Contact customer service at '.$general_setting->email.' for more information.');
                            redirect(APP_URL.'SignIn');
                        }
                        else 
                        {
                            $fieldInfo = array(
                                'last_login'  =>  $this->now_time,
                            );

                            $result = $this->crud->update($this->table,$fieldInfo,array("id"=>$response['id']));

                            if($result > 0)
                            {
                                $this->session->set_userdata('customer_is_logged_in',$response);
                                $this->session->set_userdata('front_UserId',$response['id']);
                                
                                $this->session->set_flashdata('success', 'You have successfully logged in.');
                            }
                            else
                            {
                                $this->session->set_flashdata('error', 'Something went wrong');
                            }
                        }
                    }

                    $redirectUrl = isset($this->session->last_page) && !empty($this->session->last_page) 
                        ? $this->session->last_page :  APP_URL.'profile-info';
                    redirect($redirectUrl);
                } 
                else 
                {
                    $this->session->set_flashdata('error', 'Invalid email and password.');
                    redirect(APP_URL.'SignIn');
                }
            }
        }
    }

    /**
     *
     */
    function logout()
    {
        $logged_in = $this->session->userdata("customer_is_logged_in");
        $this->session->unset_userdata('customer_is_logged_in');
        session_destroy();
        redirect(APP_URL.'SignIn');
    }

    /**
     *
     */
    function register() 
    {
        if ($this->session->userdata('customer_is_logged_in')) 
        { 
            redirect(APP_URL);
        } 
        else 
        {
            $post = $this->input->post();  
            // echo "<pre>";
            // print_r($post);
            // exit();
           
            require_once('application/libraries/new_stripe/init.php');

            $stripe = new \Stripe\StripeClient(
                STRIPE_SECRET_KEY
            );

            $this->form_validation->set_rules('user_role','Role', 'trim|required');
            $this->form_validation->set_rules('email','email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'trim|required');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
            
            $user_role              = $post['user_role'];
            $email                  = $post['email'];
            $password               = $post['password'];
            $verification_code      = $this->crud->generateRandomString(10);


            if ($this->form_validation->run() == FALSE) 
            {
                $this->session->set_flashdata('error', 'Something went wrong');
                redirect(APP_URL.'SignIn');
            } 
            else 
            {
                $check_duplicate = $this->crud->check_duplicate($this->table,array('email'=>$email,'is_delete'=>0));

                if($check_duplicate)
                {
                    $this->session->set_flashdata('error', 'Your email id is already registered with us.');
                    redirect(APP_URL.'SignIn');
                }
                else
                {

                    $cus = $stripe->customers->create([
                        'email'         => $email,
                    ]);

                    $customer_id = $cus->id;

                    if($post['user_role'] == '4')
                    {
                        $timer = '';
                        $purchase_plan = 0;
                        $agency_u = 1;
                        $accommodation = 0;
                      
                    }
                    else if($post['user_role'] == '5')
                    {
                        $timer = '';
                        $purchase_plan = 0;
                        $accommodation = 1;
                        $agency_u = 0;
                    }
                    else
                    {
                        $general_setting            = $this->generalSetting(); 
                        $timer = date('Y-m-d H:i:s', strtotime('+'.$general_setting->welcome_kit.' days'));
                        $purchase_plan = 1;
                        $agency_u = 0;
                        $accommodation = 0;
                        
                    }
                    
                    // echo $timer;
                    // exit();

                    $fieldInfo = array(
                        'customer_id'               => $customer_id,
                        'user_role'                 =>  $user_role,
                        'email'                     =>  $email,
                        'password'                  =>  md5($password),
                        'is_verified'               =>  '0',
                        'verification_code'         =>  $verification_code,
                        'last_login'                =>  $this->now_time,
                        'status'                    =>  'Y',
                        'purchase_plan'             =>  $purchase_plan,
                        'timer'                     =>  $timer,
                        'agency_user'               =>  $agency_u,
                        'agency_status'             => 'N',
                        'accommodation_user'        => $accommodation,
                    );
                   
                    $result = $this->crud->insert($this->table,$fieldInfo);



                    if($result > 0)
                    {
                       
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
                        $mail_data['copyright_year'] = date("Y");
                        /* General setting common from all email end */

                        $mail_data['fname']         = "";
                        $mail_data['email']         = $email;
                        $mail_data['password']      = $password;
                        $mail_data['url']           = base_url('VerifyEmail/'.md5($result).'/'.$verification_code);

                        $message = $this->load->view('mail_template/registration_mail_template', $mail_data, TRUE);
                        //echo $message;die();
                        $admin_message = $this->load->view('mail_template/admin_register_mail_template', $mail_data, TRUE);
                        $admin_mailbody['ToEmail']    = 'celog44773@activesniper.com';
                        $admin_mailbody['FromName']   = $general_setting->site_name;
                        $admin_mailbody['FromEmail']  = $general_setting->site_from_email;
                        $admin_mailbody['Subject']    = $general_setting->site_name." - New User Register";
                        $admin_mailbody['Message']    = $admin_message;
                       

                        $mailbody['ToEmail']    = $email;
                        $mailbody['FromName']   = $general_setting->site_name;
                        $mailbody['FromEmail']  = $general_setting->site_from_email;
                        $mailbody['Subject']    = $general_setting->site_name." - Registration Confirmation";
                        $mailbody['Message']    = $message;

                        $admin_result = $this->EmailSend($admin_mailbody);
                            
                        $mail_result = $this->EmailSend($mailbody);

                        if($mail_result || $admin_result)
                        {
                            $this->session->set_flashdata('success', 'You have successfully registered to '.$general_setting->site_name.', Please check your email for confirmation');
                        }
                        else
                        {
                            $this->session->set_flashdata('error','Some error occured while send mail. Please try again.');
                        }
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'Something went wrong');
                    }
                    
                    redirect(APP_URL.'SignIn');
                }
            }

        }
    }

    public function verifyemail($uid,$vcode)
    {
        $check_duplicate = $this->crud->check_duplicate($this->table,array('md5(id)'=>$uid, 'verification_code' =>$vcode, 'is_verified' => 0));
        if($check_duplicate)
        {

            $fieldInfo = array(
                'is_verified'        =>  "1",
                'verification_code'  =>  "",
            );

            $result = $this->crud->update($this->table,$fieldInfo,array("md5(id)"=>$uid));

            $this->session->set_flashdata('success', 'Your account has been successfully verified. Please login to continue.');
            redirect(APP_URL.'SignIn');
        }
        else
        {
            $this->session->set_flashdata('error', 'This link has already been used or expired.');
            redirect(APP_URL.'SignIn');
        }
    }

    public function forgotpassword() 
    {
        if ($this->session->userdata('customer_is_logged_in')) 
        {
            redirect(APP_URL);
        } 
        else 
        {
            $data = array();
            $data['pageTitle'] = "Forgot Password";
            $this->load->view(FRONTEND."myaccount/forgot_password",$data);
        }
    }

    function forgot_password() 
    {
        $data = array();
        if(!empty($_POST))
        {
            $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');

            if ($this->form_validation->run()) 
            {
                $email = $_POST['email'];

                $check_duplicate = $this->crud->check_duplicate($this->table,array('email'=>$email,'is_delete'=>0));
               /* echo $this->db->last_query();
                die();*/
                if($check_duplicate)
                {
                    $token                      = $this->crud->generateRandomString(15);
                    $post_data['token']         = $token;
                    $post_data['updated_at']    = $this->now_time;
                    $where_array['email']       = $email;
                    $result = $this->crud->update($this->table, $post_data, $where_array);

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
                    $mail_data['copyright_year'] = date("Y");
                    /* General setting common from all email end */

                    $mail_data['url']           = base_url('reset-password/'.$token);

                    $message = $this->load->view('mail_template/frontend_forgot_password_mail_template', $mail_data, TRUE);
                    //echo $message;die();


                    $mailbody['ToEmail']    = $email;
                    $mailbody['FromName']   = $general_setting->site_name;
                    $mailbody['FromEmail']  = $general_setting->site_from_email;
                    $mailbody['Subject']    = $general_setting->site_name." - Reset Password";
                    $mailbody['Message']    = $message;
                    // print_r($mailbody);
                    // exit();
                    $mail_result = $this->EmailSend($mailbody);

                    if($mail_result)
                    {
                        $this->session->set_flashdata('success','Please check your email for reset password.');
                        redirect(APP_URL.'forgot-password');
                    }
                    else
                    {
                        $this->session->set_flashdata('error','Some error occured while send forgot password mail. Please try again.');
                        redirect(APP_URL.'forgot-password');
                    }
                }
                else
                {
                    $this->session->set_flashdata('error','You are not register with us.');
                    redirect(APP_URL.'forgot-password');
                }
            } 
            else 
            {
                redirect(APP_URL.'forgot-password');
            }

        }
        else
        {            
            $this->session->set_flashdata('error','Something went wrong. Please try again.');
            redirect(APP_URL.'forgot-password');
        }
    }


    public function reset_password($str) 
    {
        if ($this->session->userdata('customer_is_logged_in')) 
        {
            redirect(APP_URL);
        } 
        else 
        {
            $response = $this->crud->get_row_by_id($this->table,array('token'=>$str,'is_delete'=>0));
            if($response)
            {
                $data['pageTitle']  = "Set New Password";
                $data['user_id']    = $response['id'];
                $data['token']      = $str;
                $this->load->view(FRONTEND."myaccount/set_new_password",$data);
            }
            else
            {
                $this->session->set_flashdata('error','This link has already been used or expired.');
                redirect(APP_URL.'forgot-password');         
            }
        }
    }

    public function reset($token) 
    {
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        if ($this->form_validation->run()) 
        {
            $post_data  = $this->input->post();
           
            $user_id    = $post_data['user_id'];
            $password   = md5($post_data['password']);

            $update = array('password'=>$password,'token' => NULL);            
            $reset = $this->crud->update($this->table, $update, array('id'=>$user_id,'is_delete'=>0));

            if($reset) 
            {
                $this->session->set_flashdata('success','Password reset successfully.');
                redirect(APP_URL.'SignIn');
            }
            else 
            {
                $this->session->set_flashdata('error','Something went wrong. Please try again.');
                redirect(APP_URL.'reset-password'.$token);
            }
        }
        else 
        {
            redirect(APP_URL.'reset-password'.$token);
        }

    }
}