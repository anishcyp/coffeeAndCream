<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontController.php';

class PaymentController extends FrontController {


	public function __construct()
    {
        parent::__construct();
        // $this->isUserLogin();
        $this->load->model('Crud', 'crud'); 
        $this->load->library('Ajax_pagination.php');
        $this->table = 'booking';
    }

    public function view_payment($names)
    {
        $uid = $this->crud->get_column_value_by_id("tbl_customer","id","slug = '".$names."'");

        $user_details = $this->crud->get_one_row("tbl_customer",array("id"=>$uid,"is_delete"=>"0","status"=>'Y',"is_verified"=>1));
        // echo "<pre>";
        // print_r($user_details);
        // exit;
        $data['uid']        = $uid;
        $data['user_d']     = $user_details;
        $data['pageTitle']  = "Deposit of ".ucwords($user_details['fname'])." ".ucwords($user_details['lname']);
        

        $this->load->view(FRONTEND."payment",$data);
        
    }

    public function payment_process()
    {
        $response = array();
        $post = $this->input->post();

        $this->form_validation->set_rules('fname','First Name ','trim|required');
        $this->form_validation->set_rules('lname','Last Name ','trim|required');
        $this->form_validation->set_rules('email','Email Address','trim|required|valid_email');
        $this->form_validation->set_rules('phone','Phone Number ','trim|required');

        $this->form_validation->set_rules('time_entertainer','Time You Want Entertainer','trim|required');
        $this->form_validation->set_rules('location_booking','Venue/Location of booking','trim|required');
        $this->form_validation->set_rules('celebration','What is the celebration?','trim|required');
        $this->form_validation->set_rules('agreed_enter_cust','Total cost agreed by entertainer and customer?','trim|required');
        $this->form_validation->set_rules('cash_balance','Balance to paid in cash after deposit ','trim|required');        

        if($post['pay_method'] == "credit_card")
        {
            $this->form_validation->set_rules('card_number','Card Number ','trim|required');
            $this->form_validation->set_rules('mm','Month ','trim|required');
            $this->form_validation->set_rules('yy','Year ','trim|required');
            $this->form_validation->set_rules('cvv','CVV Number ','trim|required');
        }

        if($this->form_validation->run() == FALSE) 
        {
            $error_messages = validation_errors();
            $response['error'] = 1;
            $response['msg'] = $error_messages;
        }
        else 
        {
            $LoginUserId    = $this->session->userdata('front_UserId');
            $fname          = $post['fname'];
            $lname          = $post['lname'];
            $email          = $post['email'];
            $phone          = $post['phone'];
            $amt            = ($post['deposit_amt'] * 100);
            
            $user_details = $this->crud->get_one_row("tbl_customer",array("id"=>$post['UserId'],"is_delete"=>"0","status"=>'Y',"is_verified"=>1));

            $service_name = $this->crud->get_column_value_by_id("service","name","service_id = '".$post['payment_service']."'");
            $UserId = $user_details['id'];

            $deposit = array(
                // "LoginUserId"       => $LoginUserId,
                "uid"               => $UserId,
                "payment_type"      => $post['pay_method'],
                "service_id"        => $post['payment_service'],
                "amount"            => $post['deposit_amt'],
                "time_entertainer"  => $post['time_entertainer'],
                "location_booking"  => $post['location_booking'],
                "celebration"       => $post['celebration'],
                "agreed_enter_cust" => $post['agreed_enter_cust'],
                "cash_balance"      => $post['cash_balance'],
                "currency"          => 'gbp',
                "fname"             => $fname,
                "lname"             => $lname,
                "email"             => $email,
                "phone"             => $phone,
                "isPaymentSuccess"  => 0,
                "created_at"        => date('Y-m-d H:i:s'),
            );

            $deposit_results = $this->crud->insert("deposit",$deposit);

            if($post['pay_method'] == "credit_card")
            {
                require_once('application/libraries/stripe/init.php');
                \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
                $card_no        = $post['card_number'];
                $card_exp_month = $post['mm'];
                $card_exp_year  = $post['yy'];
                $card_cvv       = $post['cvv'];

                try 
                {
                    $token = \Stripe\Token::create(array(
                        "card"      => array(
                        "number"    =>  $card_no,
                        "exp_month" =>  $card_exp_month,
                        "exp_year"  =>  $card_exp_year,
                        "cvc"       =>  $card_cvv
                      )
                    ));
                
                    $charge = \Stripe\Charge::create(array(
                        "amount"        =>  $amt,
                        "currency"      =>  "gbp",
                        "source"        =>  $token,
                        "description"   =>  "Deposit Of ".$user_details['fname'].' '.$user_details['lname'],
                        "receipt_email" =>  $email,
                        "metadata"      => array(
                                  "First name"  => $fname,
                                  "Last name"   => $lname,
                                  "Email"       => $email,
                                  "service_id"  => $post['payment_service'],
                                  "uid"         => $UserId,
                                  "LoginUserId" => $LoginUserId,
                                ),
                        )
                    );

                    /*print_r($charge);
                    exit();*/
                    $charge_id  = $charge->id; 
                    $result     =   "success";
                
                } catch(\Stripe\CardError $e) {  
                    $error = $e->getMessage();
                    $result = $error;

                } catch (\Stripe\InvalidRequestError $e) {
                    $error = $e->getMessage();
                    $result = $error;  
                } catch (\Stripe\AuthenticationError $e) {
                    $error = $e->getMessage();
                    $result = $error;
                } catch (\Stripe\ApiConnectionError $e) {
                    $error = $e->getMessage();
                    $result = $error;
                } catch (\Stripe\Error $e) {
                    $error = $e->getMessage();
                    $result = $error;
                } catch (Exception $e) {
                  
                    if ($e->getMessage() == "zip_check_invalid") {
                      $result = "declined1";
                    } else if ($e->getMessage() == "address_check_invalid") {
                      $result = "decline2d";
                    } else if ($e->getMessage() == "cvc_check_invalid") {
                      $result = "declined3";
                    } else {
                      $result = $e->getMessage();
                    }
                }

                if($result=="success") 
                {
                    $data = array(
                        'payment_date'          => date("Y-m-d H:i:s"),
                        'stripe_charge_id'      => $charge_id,
                        'isPaymentSuccess'      => 1,
                    );
                    $this->crud->update("deposit",$data,array("deposit_id"=>$deposit_results));

                    if($deposit_results > 0)
                    {
                        $response['user_id']    = $UserId;
                        $response['last_id']    = $deposit_results;
                        $response['pay_method'] = "credit_card";
                        $response['error']      = 0;
                        $response['msg']        = 'You have successfully payment, Please check your email';

                        $this->mailCommon($fname,$lname,$email,$post['UserId'],$post['deposit_amt'],$service_name,$charge_id,$deposit_results); 
                    }
                   
                }
                else
                {
                    $response['error'] = 1;
                    $response['msg'] = $result;
                }
            }
            else if($post['pay_method'] == "paypal")
            {
                if($deposit_results > 0)
                {
                    $response['pay_method'] = "paypal";
                    $response['error'] = 0;
                    $response['msg'] = "Data inserted successfully";
                    $response['last_id']    = $deposit_results;
                    $response['user_id']    = $UserId;
                }
                else
                {
                    $response['error'] = 1;
                    $response['msg'] = "Something went wrong. Please try again.";
                }
            }
        }

        echo json_encode($response);die();
    }

    public function payment_succcess()
    {
        $this->session->set_flashdata('success', 'Payment process successfully');
        redirect(APP_URL);
    }

    public function payment_cancel($user_id)
    {
        $this->session->set_flashdata('error', 'Payment Cancelled');
        redirect(APP_URL.'home');
    }

    public function payment_notify()
    {
        /*echo "notifiy responde";
        echo "<pre>";
        print_r($_POST);
        die();*/

        $data       = $_POST;
        $exp_custom = explode("##", $data['custom']);
        $id         = $exp_custom[0];
        $user_id    = $exp_custom[1];
        $txn_id     = $data['txn_id'];
        unset($data['custom']);
        
        $response = serialize($data);
        
        $data = array(
            'payment_date'      => date("Y-m-d H:i:s"),
            'isPaymentSuccess'  => '1',
            'response'          => $response,
            'txn_id'            => $txn_id,
        );
    
        $this->db->where('deposit_id', $id);
        $this->db->update('deposit', $data);
        
        $details = $this->crud->get_one_row("deposit",array("deposit_id"=>$id)); 

        $amount = $details['amount'];
        $lname = $details['lname'];
        $fname = $details['fname'];
        $user_id = $details['uid'];
        $email  = $details['email'];

        $service_name = $this->crud->get_column_value_by_id("service","name","service_id = '".$details['service_id']."'");

        $this->mailCommon($fname,$lname,$email,$user_id,$amount,$service_name,$txn_id);
    }

    public function mailCommon($fname,$lname,$email,$UserId,$amount,$service_name,$charge_id)
    {
        $user_details = $this->crud->get_one_row("tbl_customer",array("id"=>$UserId,"is_delete"=>"0","status"=>'Y',"is_verified"=>1));  

        /* General setting common from all email start */
        $general_setting            = $this->generalSetting(); 
        $mail_data['site_name']     = $general_setting->site_name;
        $mail_data['site_title']    = $general_setting->site_title;
        $mail_data['site_email']    = $general_setting->email;
        $mail_data['site_logo']     = base_url('public/front/images/logo/'.$general_setting->site_logo);
        $mail_data['address']       = $general_setting->address;
        $mail_data['fb_link']       = $general_setting->fb_link;
        $mail_data['twitter_link']  = $general_setting->twitter_link;
        $mail_data['instagram_link'] = $general_setting->instagram_link;
        $mail_data['copyright_year'] = date("Y");
        /* General setting common from all email end */

        $mail_data['fname']               = $fname;
        $mail_data['lname']               = $lname;
        $mail_data['email']               = $email;
        $mail_data['amount']              = $amount;
        $mail_data['service']             = $service_name;
        $mail_data['date']                = date('Y-m-d H:i:s');
        $mail_data['charge_id']           = $charge_id;
        $mail_data['payment_method']      = 'Credit Card';
       
        //info to user
        $mail_data['fname_to']      = $user_details['fname'];
        $mail_data['lname_to']      = $user_details['lname'];
        $mail_data['email_to']      = $user_details['email'];
        

        //== Admin mail === 
        $deposit_admin_msg = $this->load->view('mail_template/deposit_admin_mail_template', $mail_data, TRUE);
        $admin_mailbody['ToEmail']    = $general_setting->site_from_admin_email;
        $admin_mailbody['FromName']   = $general_setting->site_name;
        $admin_mailbody['FromEmail']  = $general_setting->site_from_email;
        $admin_mailbody['Subject']    = $general_setting->site_name." - New Payment Received";
        $admin_mailbody['Message']    = $deposit_admin_msg;
        
        // == User Mail ==
        $deposit_user_msg = $this->load->view('mail_template/deposit_user_mail_template', $mail_data, TRUE);
        $user_mailbody['ToEmail']    = $email;
        $user_mailbody['FromName']   = $general_setting->site_name;
        $user_mailbody['FromEmail']  = $general_setting->site_from_email;
        $user_mailbody['Subject']    = $general_setting->site_name." - Your payment has been successfully";
        $user_mailbody['Message']    = $deposit_user_msg;
        // echo $deposit_user_msg; die;
        // == to User mail
        $deposit_to_user_msg = $this->load->view('mail_template/deposit_user_to_mail_template', $mail_data, TRUE);
        $user_to_mailbody['ToEmail']    = $user_details['email'];
        $user_to_mailbody['FromName']   = $general_setting->site_name;
        $user_to_mailbody['FromEmail']  = $general_setting->site_from_email;
        $user_to_mailbody['Subject']    = $general_setting->site_name." - Your deposit received successfully";
        $user_to_mailbody['Message']    = $deposit_to_user_msg;
       

        $deposit_admin    = $this->EmailSend($admin_mailbody);
        $deposit_user     = $this->EmailSend($user_mailbody);
        $deposit_to_user  = $this->EmailSend($user_to_mailbody);
    }

    public function payment_history_show() 
    {
        $data       = array();
        $data['pageTitle'] = 'Payment History'; 
        $this->load->view(FRONTEND."payment_history/show",$data);    
    }

    public function ajaxPaginationDataPaymentHistory()
    {
        $user_id = $this->session->userdata('front_UserId'); 
        $login_user_role = $this->loginUserRole();
        
        $where = array("d.isDelete"=>"0","d.uid"=>$user_id);
        

        $config['select'] = 'd.*';
        $config['table'] = 'deposit d';
        
        /*$config['joins'][] = array(
            'join_table' => 'tbl_customer tc', 
            'join_by' => 'd.uid = tc.id', 
            'join_type' => 'inner');*/

        $config['column_order'] = array('d.deposit_id');
        $config['column_search'] = array('d.amount','d.txn_id');         
        $config['order'] = array('deposit_id' => 'desc');
        $config['custom_where'] =  $where;
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();

        // echo $this->db->last_query();
        foreach ($records as $record) 
        {
            $action = '';
            $action .= '
                <a href="'.URL.'payment-history/details/'.md5($record->deposit_id).'" class="action-btn btn-edit"> <i class="fa fa-eye"></i></a>'; 
            
        
            $dis_user_details = $record->fname." ".$record->lname."<br>".$record->email."<br>".$record->phone;

            $row = array();
            $row[] = str_replace("_", " ", $record->payment_type);
            $row[] = date("Y-m-d h:i A",strtotime($record->payment_date));
            $row[] = $dis_user_details;
            $row[] = strtoupper($record->currency)." ".$record->amount;

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

    public function payment_history_details($id) 
    {

        $data = array();
        $user_id = $this->session->userdata('front_UserId'); 
        $login_user_role = $this->loginUserRole();

        $where = array("isDelete"=>"0","uid"=>$user_id);
        
        $user_details = $this->crud->get_one_row("deposit",$where);

        $detail = $this->crud->get_one_row("deposit",array("isDelete"=>"0","uid"=>$user_id));
        

        $service = $this->crud->get_one_row("service",array("service_id"=>$user_details['service_id']));
        $data['user_details']   = $detail;
        $data['service']    = $service;
        $data['details']    = $user_details;
        $data['pageTitle']  = 'Payment Details';
        $this->load->view(FRONTEND."payment_history/details",$data);
        
    }

    public function payment_guidelines()
    {

        $data['pageTitle']  = "Payment Guidelines";
        $this->load->view(FRONTEND."payment_guidelines",$data);
    }
}