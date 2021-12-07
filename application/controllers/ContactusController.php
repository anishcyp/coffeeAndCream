<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontController.php';

class ContactusController extends FrontController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud', 'crud'); 
        $this->table = 'contactform';
    }

    // ************************** Main Listing *************
    public function index() 
    {
        $data = array();
        $our_contact = $this->crud->get_all_with_where('our_contact','name','desc',array('status'=>'Y','isDelete'=>0));
        $data['our_contact'] = $our_contact;
       
        $result_d = $this->crud->get_one_row("description_contact_page",array('id' =>1 ) );
        $data['result'] = $result_d;
        $result_time = $this->crud->get_one_row("description_contact_page",array('id' =>2 ) );
        $data['result_time'] = $result_time;

        $data['pageTitle'] = 'Get in Touch with Us | Contact Us | Stripper Party Bus'; 
        $this->load->view(FRONTEND."contactus",$data);    
    }


    public function aboutus()
    {
        $result_d = $this->crud->get_one_row("aboutus",array('id' =>1 ) );
        $data['result'] = $result_d;

       $data['pageTitle'] = 'Stripper Agency | Entertainment Agency in UK | Stripper Party Bus'; 
        $this->load->view(FRONTEND."aboutus",$data);  
    }

    function contact_us()
    {
        $post = $this->input->post();
        // print_r($post);exit;
        $this->form_validation->set_rules('department','Department *','trim|required');
        $this->form_validation->set_rules('name','Name *','trim|required');
        $this->form_validation->set_rules('email','Email *','trim|valid_email|required');
        $this->form_validation->set_rules('phone','Phone *','trim|numeric|required');
        //$this->form_validation->set_rules('subject','Subject *','trim|required');
        $this->form_validation->set_rules('message','Message *','trim|required');

        if($this->form_validation->run() == FALSE)
        {
            redirect('contactus');
        }
        else
        {
            $fieldInfo = array(
                'department'             =>  $post['department'],
                'name'                   =>  $post['name'],
                'email'                  =>  $post['email'],
                'phone'                  =>  $post['phone'],
                //'subject'                =>  $post['subject'],
                'message'                =>  $post['message'],
                'status'                 =>  'Y',
                'created_at'             => date('Y-m-d H:i:s'),
            );

            $result = $this->crud->insert("contactform",$fieldInfo);
            // echo $this->db->last_query(); die();

            if($result > 0)
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
                $mail_data['copyright_year'] = date("Y");
                /* General setting common from all email end */

                if($post['department'] == 0)
                {
                    $dis_department = "General Support";
                }
                else
                {
                    $dis_department = "Moderators";
                }

                $mail_data['department']   = $dis_department;
                $mail_data['name']         = $post['name'];
                $mail_data['email']        = $post['email'];
                $mail_data['phone']        = $post['phone'];
                //$mail_data['subject']      = $post['subject'];
                $mail_data['message']      = $post['message'];
                $mail_data['created_at']   = date("Y-m-d h:i:s");

                $message = $this->load->view('mail_template/contact_inquiry_mail_template', $mail_data, TRUE);
                //echo $message;die();
                $mailbody['ToEmail']    = $general_setting->site_from_admin_email;
                $mailbody['FromName']   = $general_setting->site_name;
                $mailbody['FromEmail']  = $general_setting->site_from_email;
                $mailbody['Subject']    = $general_setting->site_name." - New Inquiry Received";
                $mailbody['Message']    = $message;
    
                $mail_result = $this->EmailSend($mailbody);

                $this->session->set_flashdata('success', 'Your request has been successfully received.');
            }
            else
            {
                $this->session->set_flashdata('error', 'Something went wrong');
            } 
        }

        redirect('contactus');
        die();
    }
}
