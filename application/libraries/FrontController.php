<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 


class FrontController extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
    }

    function isUserLogin() 
    {   
        $user_id = $this->session->userdata('front_UserId');
        if(!isset($user_id) && $user_id == '') 
        {
            $this->session->set_flashdata('error', 'Please login to your account.');
            redirect("SignIn");
        }
        else
        {
            $valid_login = $this->crud->check_duplicate("tbl_customer",array("is_delete"=>0,"id"=>$user_id,"status"=>'Y',"is_verified"=>1));
            if($valid_login)
            { 
                $invalid_role = $this->crud->check_duplicate("tbl_customer",array("user_role"=>0,"id"=>$user_id));
                if($invalid_role)
                { 
                    $this->session->set_flashdata('error', 'Please select a role, inorder to use your account.');
                    redirect('user-role');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Please login to your account.');
                redirect('logout');
            }
        }
    }


    // function plan_rotation()
    // {       
       
    //     $today_date = date("Y-m-d H:i:s"); 
    //     // $today_date = '2021-06-03 01:28:36';


    //     $where = array('uid' => $this->session->userdata('front_UserId'),'end_date != '=>'0000-00-00 00:00:00','status'=>'1','recurring'=>'No','isDelete'=>0 );

    //     $row_a = $this->crud->get_one_row("purchase_plan",$where );
        

    //     if(!empty($row_a))
    //     {
    //         if($row_a['recurring'] == 'No')
    //         {
    //             $where1 = array('id' => $row_a['uid']);
    //             $result_d = $this->crud->get_one_row("tbl_customer",$where1 );

    //             if($today_date > $row_a['end_date'] || $today_date == $row_a['end_date'])
    //             { 
    //               $rows   = array(
    //                     "status" => 2,
    //                 );

    //                 $where = array('uid' => $this->session->userdata('front_UserId'),'id'=>$row_a['id']);
    //                 $result = $this->crud->update('purchase_plan',$rows,$where);

    //                 $fieldupd = array(
    //                     'purchase_plan'      =>  2,
    //                 );

    //                 $where_id = array('id' => $this->session->userdata('front_UserId'));
    //                 $result2 = $this->crud->update('tbl_customer',$fieldupd,$where_id);

    //                 if($result > 0 && $result2 > 0)
    //                 {
    //                     $general_setting            = $this->generalSetting(); 
    //                     $mail_data['site_name']     = $general_setting->site_name;
    //                     $mail_data['site_title']    = $general_setting->site_title;
    //                     $mail_data['site_email']    = $general_setting->email;
    //                     $mail_data['site_logo']     = base_url('public/front/images/logo/'.$general_setting->site_logo );
    //                     $mail_data['address']       = $general_setting->address;
    //                     $mail_data['fb_link']       = $general_setting->fb_link;
    //                     $mail_data['twitter_link']  = $general_setting->twitter_link;
    //                     $mail_data['instagram_link'] = $general_setting->instagram_link;
    //                     $mail_data['copyright_year'] = date("Y");
    //                     /* General setting common from all email end */

    //                     $mail_data['fname']             = $result_d['fname'].' '.$result_d['lname'];
    //                     $mail_data['email']             = $result_d['email'];
    //                     $mail_data['plan_times']        = $row_a['interval_count'].' '.$row_a['custom_interval'];
    //                     $mail_data['amount']            = $row_a['amount'];
    //                     $mail_data['end_date']          = $row_a['end_date'];
    //                     $mail_data['start_date']          = $row_a['created_at'];
    //                     $mail_data['plan_name']         = $row_a['plan_nickname'];
    //                     $mail_data['url']               = base_url('membership-plan');

    //                     $message = $this->load->view('mail_template/plan_expired_mail_template', $mail_data, TRUE);

    //                     $admin_message = $this->load->view('mail_template/admin_expired_plan_mail_template', $mail_data, TRUE);

    //                     $admin_mailbody['ToEmail']    = $general_setting->site_from_admin_email;
    //                     $admin_mailbody['FromName']   = $general_setting->site_name;
    //                     $admin_mailbody['FromEmail']  = $general_setting->site_from_email;
    //                     $admin_mailbody['Subject']    = $general_setting->site_name." -User Plan Expired";
    //                     $admin_mailbody['Message']    = $admin_message;

    //                     $mailbody['ToEmail']    = $result_d['email'];
    //                     $mailbody['FromName']   = $general_setting->site_name;
    //                     $mailbody['FromEmail']  = $general_setting->site_from_email;
    //                     $mailbody['Subject']    = $general_setting->site_name." Membership plan has expired";
    //                     $mailbody['Message']    = $message;

    //                     $admin_result = $this->EmailSend($admin_mailbody);
    //                     $mail_result = $this->EmailSend($mailbody);

    //                     if($mail_result || $admin_result)
    //                     {

    //                        $this->session->set_flashdata('success', 'Your plan is expired purchase membership plan.');
    //                         redirect("plan-purchase");
    //                         exit;
    //                     }
    //                     else
    //                     {
    //                         $response['error'] = 1;
    //                         $this->session->set_flashdata('success', 'Some error occured while send mail. Please try again.');
    //                         redirect("plan-purchase");
    //                         exit;
    //                     }

    //                 }
    //                 else
    //                 {
    //                     $this->session->set_flashdata('error', 'Somthing want worng .');
    //                     // exit;
    //                 }  
                    
    //             }
    //         }
    //     }
    // }

    function Timer()
    {
        $where = array('id' => $this->session->userdata('front_UserId'),'status'=>1,'is_delete'=>0,'purchase_plan'=>1 );
        $timer_tbl = $this->crud->get_one_value("tbl_customer",$where,'purchase_plan' );

        $where = array('uid' => $this->session->userdata('front_UserId'),'status'=>1, );
        $Planchk = $this->crud->get_one_row("purchase_plan",$where );
        $welcome = $timer_tbl; 
        if($welcome == 1)
        {
            
        }
        else if($Planchk)
        {
            
        }
        else
        {
            $this->session->set_flashdata('error', 'Purchase membership plan using account.');
            redirect("plan-purchase");
            exit;
        }   
    }


    function loginUserRole()
    {
        $user_id = $this->session->userdata('front_UserId');
        $user_role = $this->crud->get_column_value_by_id("tbl_customer","user_role","id = ".$user_id);
        return $user_role;
    }

    function generalSetting()
    {
        $sitesetting = $this->SiteSetting_model->getSiteSetting();
        return $sitesetting[0];
    }

    public function EmailSend($data = array())
    {
        include_once APPPATH.'third_party/class.phpmailer.php';
        
        $subject    = $data['Subject'];
        $to_email   = $data['ToEmail'];
        $from_mail  = $data['FromEmail'];
        $from_name  = $data['FromName'];
        $body       = $data['Message'];
        $mail       = new PHPMailer();
    
        $mail->SetFrom($from_mail,$from_name); // From email ID and from name
        if(is_array($to_email) && count($to_email) > 0){
            foreach ($to_email as $key => $email) {
                if($email != '')
                    $mail->AddAddress(stripslashes(trim($email)));
            }
        } else {
            $mail->AddAddress(stripslashes(trim($to_email)));
        }
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        
        //$mail->SMTPDebug = 3;
        $result = $mail->Send();
        return $result;
    }

    public function send_mail_global($from_email,$to_email,$subject,$message) 
    {
        $config = array();
        $config['smtp_port']= "465";
        $config['mailtype'] = 'html';
        $config['charset']  = "utf-8";
        $config['newline']  = "\r\n";
        $config['smtp_timeout']='30';
        $config['wordwrap'] = TRUE;
        // load Email Library 
        $this->load->library('email');

        $this->email->initialize($config);
        $this->email->from($from_email, SITE_NAME);
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);    

        //Send mail 
        if($this->email->send()) 
            return true;
        else
            return $this->email->print_debugger();
    }

    function paginationCompress($link, $count, $perPage = 10, $segment = SEGMENT) 
    {
        $this->load->library ( 'pagination' );

        $config ['base_url'] = base_url () . $link;
        $config ['total_rows'] = $count;
        $config ['uri_segment'] = $segment;
        $config ['per_page'] = $perPage;
        $config ['num_links'] = 5;
        $config ['full_tag_open'] = '<nav><ul class="pagination">';
        $config ['full_tag_close'] = '</ul></nav>';
        $config ['first_tag_open'] = '<li class="arrow">';
        $config ['first_link'] = 'First';
        $config ['first_tag_close'] = '</li>';
        $config ['prev_link'] = 'Previous';
        $config ['prev_tag_open'] = '<li class="arrow">';
        $config ['prev_tag_close'] = '</li>';
        $config ['next_link'] = 'Next';
        $config ['next_tag_open'] = '<li class="arrow">';
        $config ['next_tag_close'] = '</li>';
        $config ['cur_tag_open'] = '<li class="active"><a href="#">';
        $config ['cur_tag_close'] = '</a></li>';
        $config ['num_tag_open'] = '<li>';
        $config ['num_tag_close'] = '</li>';
        $config ['last_tag_open'] = '<li class="arrow">';
        $config ['last_link'] = 'Last';
        $config ['last_tag_close'] = '</li>';
    
        $this->pagination->initialize ( $config );
        $page = $config ['per_page'];
        $segment = $this->uri->segment ( $segment );
    
        return array (
                "page" => $page,
                "segment" => $segment
        );
    }
    
    public function week_day_array()
    {
        $WEEK_DAY_ARRAY = array("1"=>"MONDAY","2"=>"TUESDAY","3"=>"WEDNESDAY","4"=>"THURSDAY","5"=>"FRIDAY","6"=>"SATURDAY","7"=>"SUNDAY");

        return $WEEK_DAY_ARRAY;
    }
}