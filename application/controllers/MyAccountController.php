<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontController.php';

class MyAccountController extends FrontController 
{
	public function __construct()
    {
        parent::__construct();
        $this->isUserLogin();
        $this->Timer();
        // $this->plan_rotation();
        $this->load->library('upload');
        $this->load->model('Crud', 'crud'); 
        $this->table = 'tbl_customer';
    }


    public function personal_info()
    {
        $where_id = array('uid' => $this->session->userdata('front_UserId') );

        $data = array();
        $where = array('id' => $this->session->userdata('front_UserId') );
       
        $data['profile'] = $this->crud->get_one_row("tbl_customer",$where );

        $entertainment_service = $this->crud->get_all_with_where('service','name','desc',array('status'=>'Y','isDelete'=>0,'service_type' => 1));
        
        $escort_service = $this->crud->get_all_with_where('service','name','desc',array('status'=>'Y','isDelete'=>0,'service_type' => 2));

        $favorite = $this->crud->get_all_with_where('favorite','name','desc',array('status'=>'Y','isDelete'=>0));
        $language = $this->crud->get_all_with_where('language','name','asc',array('status'=>'Y','isDelete'=>0));
        $relationship_status= $this->crud->get_all_with_where('relationship_status','name','desc',array('status'=>'Y','isDelete'=>0));
        $drinker = $this->crud->get_all_with_where('drinker','name','asc',array('status'=>'Y','isDelete'=>0));
        $smoker = $this->crud->get_all_with_where('smoker','name','asc',array('status'=>'Y','isDelete'=>0));
        $statelists = $this->crud->get_all_with_where('state','name','asc',array('status'=>'Y','isDelete'=>0));
        $citylist = $this->crud->get_all_with_where('city','name','asc',array('status'=>'Y','isDelete'=>0));
        $countrylists = $this->crud->get_all_with_where('country','name','asc',array('status'=>'Y','isDelete'=>0));

        $data["relationship_status"]    = $relationship_status;
        $data['citylist']               = $citylist;
        $data['countrylists']           = $countrylists;
        $data['statelists']             = $statelists;
        $data["drinker"]                = $drinker;
        $data["smoker"]                 = $smoker;
        $data["entertainment_service"]  = $entertainment_service;
        $data["escort_service"]         = $escort_service;
        $data["favorite"]               = $favorite;
        $data["language"]               = $language;

        $data['pageTitle'] = 'Profile Info';        
        $this->load->view(FRONTEND."myaccount/personal_info_page",$data);
        
    }


    public function service_show(){

        $service_type = $this->input->post('value');

        if($service_type == '' )
        {
            $result = $this->crud->get_all_with_where('service','name','desc',array('status'=>'Y','isDelete'=>0));
        }
        else
        {
            $result = $this->crud->get_all_with_where('service','name','desc',array('service'=>$service_type ,'status'=>'Y','isDelete'=>0));
        }

        if(!empty($result))
        {
            echo json_encode($result);
        }
        else
        {
            echo json_encode('blank');            
        }
    }

    
    public function view_change_password()
    {
        $data = array();
        // $data = $this->count_all();
        $data['pageTitle'] = 'Change Password';        
        $this->load->view(FRONTEND."myaccount/change_password",$data);
    }
    
    
    public function update_profile() 
    {
        if(!$this->session->userdata('customer_is_logged_in')) 
        {
            redirect(APP_URL.'login');
        }

        $data = array();
        $UserId = $this->session->userdata('front_UserId');
        $formSubmit = $this->input->post('submit');
        if($formSubmit == 'formSave')
        {        
            $post = $this->input->post();
            // echo "<pre>";
            // print_r($post);
            // exit;
            
            $alias_name             = $post['alias_name'];
            $alias_slug = $this->slug->create_slug($post['alias_name']);
            $agency_slug = $this->slug->create_slug($post['agency_name']);
            
            $agency_name_slug = $this->slug->create_slug($post['agency_name']);
            $language_id = ($this->input->post('language') == true ? implode(",", $this->input->post('language')) : '' );
            $service_id = ($this->input->post('service') == true ? implode(",", $this->input->post('service')) : '' );
            $agency_service_id = ($this->input->post('service') == true ? implode(",", $this->input->post('service')) : '' );
            
            $favorite_id = ($this->input->post('favorite') == true ? implode(",", $this->input->post('favorite')) : '' );

            $filename = "";

            if($_FILES['profile_image']['error'] == 0)
            {
                $allowed_types = "jpg|png|jpeg";
                $filename = $this->crud->upload_file('profile_image', UPLOAD_DIR.USER_PROFILE_IMG,$allowed_types);  

            }

            if($filename=="")
            {
                $filename = $post["old_profile_image"];

            }
            else
            {
                if($post["old_profile_image"]!="" && file_exists(UPLOAD_DIR.USER_PROFILE_IMG.$post["old_profile_image"]))
                {
                @unlink(UPLOAD_DIR.USER_PROFILE_IMG.$post["old_profile_image"]);
                }
            } 


            $identification_pic = "";

            if($_FILES['identification_photo']['error'] == 0)
            {
                $allowed_types = "jpg|png|jpeg|pdf";
                $identification_pic = $this->crud->upload_file('identification_photo', UPLOAD_DIR.USER_PROFILE_IMG,$allowed_types);  

            }

            if($identification_pic=="")
            {
                $identification_pic = $post["old_identification_photo"];
            }
            else
            {
                if($post["old_identification_photo"]!="" && file_exists(UPLOAD_DIR.USER_PROFILE_IMG.$post["old_identification_photo"]))
                {
                @unlink(UPLOAD_DIR.USER_PROFILE_IMG.$post["old_identification_photo"]);
                }
            } 

            $user_id = $this->session->userdata('front_UserId');
            $user_role = $this->crud->get_column_value_by_id("tbl_customer","user_role","id = ".$user_id);
            // echo "hi"; exit;
            if($user_role == 5)
            {
                

                $data = array(
                    "fname"                  => $post['fname'],
                    "lname"                  => $post['lname'],
                    // "email"               => $post['email'],
                    "phone"                  => $post['phone_no'],
                    "whatsapp_number"        => $post['whatsapp_number'],
                    // "gender"                 => $post['gender'],
                    "profile_image"          => $filename,
                );

                $result = $this->crud->update("tbl_customer",$data,array("id"=>$UserId));
                
                $response = $this->crud->get_row_by_id('tbl_customer',array('id'=>$this->session->userdata('front_UserId')));
                $this->session->set_userdata('customer_is_logged_in',$response);
                $this->session->set_flashdata('success','Profile details updated successfully.');

                redirect("profile-info");
            }
            else if($user_role == 4)
            {   

                $hrs_monday = isset($post['hrs_monday']) ? "1" : "0";
                $hrs_tuesday = isset($post['hrs_tuesday']) ? "1" : "0";
                $hrs_wednesday = isset($post['hrs_wednesday']) ? "1" : "0";
                $hrs_thursday = isset($post['hrs_thursday']) ? "1" : "0";
                $hrs_friday = isset($post['hrs_friday']) ? "1" : "0";
                $hrs_saturday = isset($post['hrs_saturday']) ? "1" : "0";
                $hrs_sunday = isset($post['hrs_sunday']) ? "1" : "0";

                $hrs_mon = $hrs_monday == 1 ? $post['hrs_mon_value'] : "0";
                $hrs_tue = $hrs_tuesday == 1 ? $post['hrs_tue_value'] : "0";
                $hrs_wed = $hrs_wednesday == 1 ? $post['hrs_wed_value'] : "0";
                $hrs_thu = $hrs_thursday == 1 ? $post['hrs_thu_value'] : "0";
                $hrs_fri = $hrs_friday == 1 ? $post['hrs_fri_value'] : "0";
                $hrs_sat = $hrs_saturday == 1 ? $post['hrs_sat_value'] : "0";
                $hrs_sun = $hrs_sunday == 1 ? $post['hrs_sun_value'] : "0";

                $data = array(
                "agency_name"               => $post['agency_name'],
                "slug"                      => $agency_slug,
                "contact_name"              => $post['contact_name'],
                'agency_gender'             => $post['agency_gender'],
                'age'                       => $post['age'],
                "profile_image"             => $filename,
                'identification_photo'      => $identification_pic,
                "fname"                     => $post['fname'],
                "lname"                     => $post['lname'],
                'country_id'                => $post['country_id'],
                'state_id'                  => $post['state_id'],
                'city_id'                   => $post['city_id'],
                'summary'                   => $post['summary'],
                'introduction'              => $post['introduction'],
                'hrs_mon'                   => $hrs_mon,
                'hrs_tue'                   => $hrs_tue,
                'hrs_wed'                   => $hrs_wed,
                'hrs_thu'                   => $hrs_thu,
                'hrs_fri'                   => $hrs_fri,
                'hrs_sat'                   => $hrs_sat,
                'hrs_sun'                   => $hrs_sun,
                "agency_service_id"         => $agency_service_id,
                );

                $this->crud->update("tbl_customer",$data,array("id"=>$UserId));

                $response = $this->crud->get_row_by_id('tbl_customer',array('id'=>$this->session->userdata('front_UserId')));
                $this->session->set_userdata('customer_is_logged_in',$response);
                $this->session->set_flashdata('success','Profile details updated successfully.');

                redirect("profile-info");
            }
            else
            {

            $alias_name_check = $this->crud->check_duplicate("tbl_customer",array('slug'=>$alias_slug,'is_delete'=>0,"id!="=>$UserId));
            if($alias_name_check)
            {
                $this->session->set_flashdata('error', 'Alias name is already exits.');
                redirect("profile-info");
            }

            
            $data = array(
                'alias_name'                => $alias_name,
                'slug'                      => $alias_slug,
                "profile_image"             => $filename,
                "fname"                     => $post['fname'],
                "lname"                     => $post['lname'],
                //"email"                   => $post['email'],
                "phone"                     => $post['phone_no'],
                "whatsapp_number"           => $post['whatsapp_number'],
                "facilities"                => $post['facilities'],
                "friendly"                  => $post['friendly'],
                "showers_available"         => $post['showers_available'],
                "will_travel_to"            => $post['will_travel_to'],
                "call_type"                 => $post['call_type'],
                "withheld_numbers"          => $post['withheld_numbers'],
                "text_massage"              => $post['text_massage'],
                "out_of_hour_calls"         => $post['out_of_hour_calls'],
                "gender"                    => $post['gender'],
                "age"                       => $post['age'],
                "Introduction"              => $post['introduction'],
                "my_preferences"            => $post['my_preferences'],
                "country_id"                => $post['country_id'],
                "state_id"                  => $post['state_id'],
                "city_id"                   => $post['city_id'],
                "language_id"               => $language_id,
                "favorite_id"               => $favorite_id,
                "service_id"                => $service_id,

            );

            $this->crud->update("tbl_customer",$data,array("id"=>$UserId));

            $response = $this->crud->get_row_by_id('tbl_customer',array('id'=>$this->session->userdata('front_UserId')));
            $this->session->set_userdata('customer_is_logged_in',$response);
            $this->session->set_flashdata('success','Profile details updated successfully.');

            redirect("profile-info");
            }        
        }
    }

    public function checkAliasName()
    {
        $post = $this->input->post();
        if(isset($post['alias_name']))
        {   
            $UserId = $this->session->userdata('front_UserId');
            $alias_slug = $this->slug->create_slug($post['alias_name']);
            $check_duplicate = $this->crud->check_duplicate("tbl_customer",array('slug'=>$alias_slug,'is_delete'=>0,'id!='=>$UserId));
            if($check_duplicate)
            {
                echo json_encode('Alias name is already taken.');
            }else{
                echo json_encode(true);
            }
        }
    }

    public function view_call_rates()
    {
        $data = array();
        $UserId = $this->session->userdata('front_UserId');
        $user_role = $this->crud->get_column_value_by_id("tbl_customer","user_role","id = ".$UserId);
        if($user_role == 1 || $user_role == 2 || $user_role == 4)
        { 
            $rates = $this->crud->get_all_with_where('call_rates','rates','desc',array('user_id'=>$UserId,'isDelete'=>0));
            // $data = $this->count_all();
            $data["rates"]      = $rates;
            $data['pageTitle'] = 'Call Rates';        
            $this->load->view(FRONTEND."myaccount/call_rate",$data);
        }
        else
        {
            $this->session->set_flashdata('error',"You don't have permission to access this page.");
            redirect("profile-info");
        }
    }

    public function ajaxPaginationDataCallRates()
    {
        $tablename = base64_encode('call_rates');
        $tableId = base64_encode('id');
        $user_id = $this->session->userdata('front_UserId'); 
        $config['select'] = 'call_rates.*';
        $config['table'] = 'call_rates';

        $config['column_order'] = array('call_rates.decscription');
        $config['column_search'] = array('call_rates.decscription');         
        $config['custom_where'] = array('isDelete' => 0,'user_id'=>$user_id);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        
        foreach ($records as $record) {

            $action = '';
            $status = '';

            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';
        
            

            $row = array();
            $row[] = $record->decscription;
            $row[] = $record->rates;
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

    public function insert_call_rates()
    {
        if(!$this->session->userdata('customer_is_logged_in')) 
        {
            redirect(APP_URL.'login');
        }
        $data = array();
        $UserId = $this->session->userdata('front_UserId');
        $formSubmit = $this->input->post('submit');        

        $this->form_validation->set_rules('discription', 'Discription', 'trim|required');
        $this->form_validation->set_rules('rates', 'Call Rate', 'trim|required');

        if ($this->form_validation->run()) 
        {

            $CallRates = array(
                'user_id'                  => $UserId,
                'decscription'             => $this->input->post('discription'),
                'rates'                    => $this->input->post('rates'),
                'call_type'                => $this->input->post('call_type'),
            );

            $result = $this->crud->insert("call_rates",$CallRates);

            if($result == true)
            {
                $this->session->set_flashdata('success','Call rates details added successfully.');
               
                redirect("call-rates");
            }
            else 
            {
                if (validation_errors()) 
                {
                    $error_messages = $this->form_validation->error_array();
                    $this->session->set_flashdata('error',$error_messages);    
                }
                redirect("call-rates");
            }      
        } 
    }

    function change_password() 
    {
        if(!$this->session->userdata('customer_is_logged_in')) 
        {
            redirect(APP_URL.'login');
        }
        $data = array();
        $post = $this->input->post();
        $UserId = $this->session->userdata("front_UserId");
        if (!empty($this->input->post())) 
        {
            
            $this->form_validation->set_rules('currant_password', 'Currant Password', 'trim|required');
            $this->form_validation->set_rules('password', 'New Password', 'trim|required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
            if ($this->form_validation->run()) {

                $wh_pass = array('id'=>$UserId);
                $old_password = $this->crud->get_one_value("tbl_customer",$wh_pass,"password");
                if($old_password==md5($this->input->post('currant_password'))) {
                    $data_update = array(
                        "password"=>md5($post['password']),
                    );
                    $this->crud->update('tbl_customer',$data_update,array("id"=>$UserId));
                    $this->session->set_flashdata('success','You have successfully changed password!');
                }
                else
                {
                   $this->session->set_flashdata('error','Old password does not match.');
                }
                
                redirect('change-password');
            } 
            else 
            {
                if (validation_errors()) 
                {
                    $error_messages = $this->form_validation->error_array();
                    $this->session->set_flashdata('success',$error_messages);    
                }
                redirect('change-password');
            }
        } 
    }


    public function view_payment_info()
    {
        $data = array();
        $UserId = $this->session->userdata('front_UserId');
        $user_role = $this->crud->get_column_value_by_id("tbl_customer","user_role","id = ".$UserId);
        if($user_role == 1 || $user_role == 2 || $user_role == 4)
        {
            $payment = $this->crud->get_all_with_where('payment','card_no','desc',array('user_id'=>$UserId));
            $data["payment"]      = $payment;
            $data['pageTitle'] = 'Payment Info';        
            $this->load->view(FRONTEND."myaccount/payment_info",$data);
        }
        else
        {
            $this->session->set_flashdata('error',"You don't have permission to access this page.");
            redirect("profile-info");
        }
    }

    public function insert_payment()
    {
        if(!$this->session->userdata('customer_is_logged_in')) 
        {
            redirect(APP_URL.'login');
        }

        $data = array();
        $UserId = $this->session->userdata('front_UserId');
        $add = $this->input->post('type');
        $this->form_validation->set_rules('select_card', 'Select Payment', 'trim|required');

        $payment = array(
                'user_id'                  =>  $UserId,
                'card_name'                => $this->input->post('card_name'),
                'payment_type'             => $this->input->post('select_card'), 
                'card_no'                  => $this->input->post('card_no'),
                'expiry_month'             => $this->input->post('expiry_month'),
                'expiry_year'              => $this->input->post('expiry_year'),
                'paypal'                   => $this->input->post('paypal_id'),
            );
        if($this->form_validation->run()) 
        {
        
            if($add== 'add')
            {
                $check_duplicate = $this->crud->check_duplicate("payment",array('user_id'=>$UserId,'payment_type' => $this->input->post('select_card')));
                    
                if($check_duplicate){
                    $this->session->set_flashdata('error', 'Record already exists.');
                    redirect(APP_URL.'payment-info');
                }
                else
                {   
                    $result = $this->crud->insert("payment",$payment);
                    if($result > 0)
                    {
                        $this->session->set_flashdata('success','Payment details added successfully.');
                        redirect("payment-info");
                    }
                    else 
                    {   
                        $this->session->set_flashdata('error','Something went wrong');
                        redirect("payment-info");
                    }
                }   
            }
            else
            {    
                $result = $this->crud->update("payment",$payment,array("id"=>$this->input->post('editid'),));
                if($result > 0)
                {
                    $this->session->set_flashdata('success','Payment details updated successfully.');redirect("payment-info");
                }
                else
                {
                    $this->session->set_flashdata('error','Something went wrong');
                    redirect("payment-info");
                }    
            }
        }
    }

    public function view_location()
    {
        $data = array();
        $UserId = $this->session->userdata('front_UserId');
        $user_role = $this->crud->get_column_value_by_id("tbl_customer","user_role","id = ".$UserId);
        if($user_role == 1 || $user_role == 2 || $user_role == 4)
        { 
            $statelists = $this->crud->get_all_with_where('state','name','asc',array('status'=>'Y','isDelete'=>0));
            $countrylists = $this->crud->get_all_with_where('country','name','asc',array('status'=>'Y','isDelete'=>0));
            $locationlists = $this->crud->get_all_with_where('location','id','asc',array('isDelete'=>0,'user_id'=>$UserId));

            $data["countrylists"]       = $countrylists;
            $data["statelists"]         = $statelists;
            $data["locationlists"]      = $locationlists;

            $data['pageTitle'] = 'Location';        
            $this->load->view(FRONTEND."myaccount/location",$data);
        }
        else
        {
            $this->session->set_flashdata('error',"You don't have permission to access this page.");
            redirect("profile-info");
        }
    }

    public function store_location()
    {
        $post = $this->input->post();
        /*echo "<pre>";
        print_r($post);
        exit();*/

        $number_cites   = $post['number_cites']; 
        $country_id     = $post['country_id'];
        $state_id       = $post['state_id'];
        $city_id        = $post['city_id'];
        $user_id        = $this->session->userdata('front_UserId');
        $plan_d         = $this->crud->get_one_row("purchase_plan",array('uid'=>$user_id,'status'=>1,'isDelete'=>0));
        $cites_chk      = $plan_d['no_plan_cities'];

        if($plan_d != '')
        {
            if($cites_chk > $number_cites)
            {

                $delete_ids = $post['deleted_row_ids'];
                $delete_ids = explode(',', $delete_ids);
                foreach ($delete_ids as $key => $value) 
                {
                    $deleterowInfo = array(
                        'isDelete' =>  "1"
                    );
                    $record_delete = $this->crud->update('location',$deleterowInfo,array("id"=>$value));
                }

                $update_ids = isset($post['main_row_ids']) ? $post['main_row_ids'] : [];
                $update_cnt = count($update_ids);

                $counter = 0;
                foreach ($country_id as $key => $value) 
                {
                    if($counter < $update_cnt) 
                    {
                        foreach ($update_ids as $key1 => $value1) 
                        {
                            $edit_record_id = $value1;
                            $update_rows = array(
                                'user_id'               =>  $user_id,
                                'country_id'            =>  $country_id[$value1][0],
                                'state_id'              =>  $state_id[$value1][0],
                                'city_id'               =>  implode(",",$city_id[$value1]),
                            );

                            $result_updated = $this->crud->update('location',$update_rows,array("id"=>$edit_record_id));
                        }
                    }
                    else 
                    {   
                        $insert_rows = array(
                            'user_id'               =>  $user_id,
                            'country_id'            =>  $country_id[$key][0],
                            'state_id'              =>  $state_id[$key][0],
                            'city_id'               =>  implode(",",$city_id[$key]),
                        );

                        $result_inserted = $this->crud->insert('location',$insert_rows,1);
                    }
                    $counter++;
                }

                $this->session->set_flashdata('success', 'Location details inserted/updated successfully.');
                redirect(APP_URL.'location');
            }
            else
            {
                $this->session->set_flashdata('error', 'You have only '.$cites_chk.' cites select .');
                redirect(APP_URL.'location');
            }
        }
        else
        {
            $update_ids = isset($post['main_row_ids']) ? $post['main_row_ids'] : [];
            $update_cnt = count($update_ids);

            $counter = 0;
            foreach ($country_id as $key => $value) 
            {
                if($counter < $update_cnt) 
                {
                    foreach ($update_ids as $key1 => $value1) 
                    {
                        $edit_record_id = $value1;
                        $update_rows = array(
                            'user_id'               =>  $user_id,
                            'country_id'            =>  $country_id[$value1][0],
                            'state_id'              =>  $state_id[$value1][0],
                            'city_id'               =>  implode(",",$city_id[$value1]),
                        );

                        $result_updated = $this->crud->update('location',$update_rows,array("id"=>$edit_record_id));
                    }
                }
                else 
                {   
                    $insert_rows = array(
                        'user_id'               =>  $user_id,
                        'country_id'            =>  $country_id[$key][0],
                        'state_id'              =>  $state_id[$key][0],
                        'city_id'               =>  implode(",",$city_id[$key]),
                    );

                    $result_inserted = $this->crud->insert('location',$insert_rows,1);
                }
                $counter++;
            }

            $this->session->set_flashdata('success', 'Location details inserted/updated successfully.');
            redirect(APP_URL.'location');
        }
        
    }


    public function gallery()
    {
        $data = array();
        $UserId = $this->session->userdata('front_UserId');
        $user_role = $this->crud->get_column_value_by_id("tbl_customer","user_role","id = ".$UserId);
        if($user_role == 1 || $user_role == 2 || $user_role == 4 || $user_role == 5)
        {
            $gallery = $this->crud->get_all_with_where('gallery','gallery_file','asc',array('user_id'=>$UserId,'isDelete'=>0));
            $data['gallery']  = $gallery;
            $data['pageTitle'] = 'Gallery';        
            $this->load->view(FRONTEND."myaccount/gallery",$data);
        }
        else
        {
            $this->session->set_flashdata('error',"You don't have permission to access this page.");
            redirect("profile-info");
        }

    }

    public function store_gallery(){

        $this->load->library("upload");
        $UserId = $this->session->userdata('front_UserId');
        $post = $this->input->post();
        $type       = $this->input->post('type');
        if($type == "add")
        {
            $filename = "";
            if($_FILES['gallery_file']['error'] == 0)
            {
                $allowed_types = "jpg|png|jpeg|webp|svg|pjp|pjpeg|jpg|tiff|webm|mkv|flv|mp4|gif||m4p|mp4";

                $filename = $this->crud->upload_file('gallery_file', UPLOAD_DIR.GALLERY_IMG,$allowed_types); 
                if($filename=="")
                {
                    $this->session->set_flashdata('error', 'Not Supported this file.');
                    redirect(APP_URL.'gallery');
                } 
            }

            $fieldInfo = array(
                'user_id'                   =>  $UserId,
                'gallery_file'              =>  $filename,
                'status'                    =>  'N',
            );

            $check_duplicate = $this->crud->check_duplicate("gallery",array('user_id'=>$UserId,'gallery_file' => $filename));
            
            if($check_duplicate){

                $this->session->set_flashdata('error', 'Already file exists.');
                redirect(APP_URL.'my-gallery');
            }
            else
            {
                $result = $this->crud->insert("gallery",$fieldInfo);
                    if($result == true)
                    {
                        $this->session->set_flashdata('success','File successfully uploaded.');
                        redirect("my-gallery");
                    }
                    else 
                    {
                        if (validation_errors()) {
                            $error_messages = $this->form_validation->error_array();
                            $this->session->set_flashdata('success',$error_messages);
                            
                        }
                        redirect("my-gallery");
                    }
            }
        }
    }


    public function view_my_diary(){

        $data=array();
        $UserId = $this->session->userdata('front_UserId');
        $user_role = $this->crud->get_column_value_by_id("tbl_customer","user_role","id = ".$UserId);
        if($user_role == 1 || $user_role == 2 || $user_role == 4)
        { 
            $statelists = $this->crud->get_all_with_where('state','name','asc',array('status'=>'Y','isDelete'=>0));
            $countrylists = $this->crud->get_all_with_where('country','name','asc',array('status'=>'Y','isDelete'=>0));
            $locationlists = $this->crud->get_all_with_where('my_diary','id','asc',array('isDelete'=>0,'user_id'=>$UserId));
            $result = $this->crud->get_row_by_id('my_diary','user_id="'.$UserId.'"');
            $data['result'] = $result;

            $data["countrylists"]       = $countrylists;
            $data["statelists"]         = $statelists;
            $data["locationlists"]      = $locationlists;
            
            $data['pageTitle'] = 'My Diary';        
            $this->load->view(FRONTEND."myaccount/my_diary",$data);
        }
        else
        {
            $this->session->set_flashdata('error',"You don't have permission to access this page.");
            redirect("profile-info");
        }
    }


    public function store_diary()
    {
        $post = $this->input->post();
        
        $from_date      = $post['from_date'];
        $to_date        = $post['to_date'];
        $start_time     = $post['start_time'];
        $end_time       = $post['end_time'];
        $country_id     = $post['country_id'];
        $state_id       = $post['state_id'];
        $city_id        = $post['city_id'];
        $user_id        = $this->session->userdata('front_UserId');

        $delete_ids = $post['deleted_row_ids'];
        $delete_ids = explode(',', $delete_ids);
        foreach ($delete_ids as $key => $value) 
        {
            $deleterowInfo = array(
                'isDelete' =>  "1"
            );
            $record_delete = $this->crud->update('my_diary',$deleterowInfo,array("id"=>$value));
        }

        $update_ids = isset($post['main_row_ids']) ? $post['main_row_ids'] : [];
        $update_cnt = count($update_ids);

        $counter = 0;
        foreach ($country_id as $key => $value) 
        {
            if($counter < $update_cnt) 
            {
                foreach ($update_ids as $key1 => $value1) 
                {
                    $edit_record_id = $value1;
                    $update_rows = array(
                        'user_id'               =>  $user_id,
                        'country_id'            =>  $country_id[$value1][0],
                        'state_id'              =>  $state_id[$value1][0],
                        'city_id'               =>  implode(",",$city_id[$value1]),
                        'from_date'             =>  date("Y-m-d",strtotime($from_date[$value1][0])),
                        'to_date'               =>  date("Y-m-d",strtotime($to_date[$value1][0])),
                        'start_time'            =>  $start_time[$value1][0],
                        'end_time'              =>  $end_time[$value1][0],
                    );

                    $result_updated = $this->crud->update('my_diary',$update_rows,array("id"=>$edit_record_id));
                }
            }
            else 
            {   
                $insert_rows = array(
                    'user_id'               =>  $user_id,
                    'country_id'            =>  $country_id[$key][0],
                    'state_id'              =>  $state_id[$key][0],
                    'city_id'               =>  implode(",",$city_id[$key]),
                    'from_date'             =>  date("Y-m-d",strtotime($from_date[$key][0])),
                    'to_date'               =>  date("Y-m-d",strtotime($to_date[$key][0])),
                    'start_time'            =>  $start_time[$key][0],
                    'end_time'              =>  $end_time[$key][0],
                );

                $result_inserted = $this->crud->insert('my_diary',$insert_rows,1);
            }
            $counter++;
        }

        $this->session->set_flashdata('success', 'Diary details inserted/updated successfully.');
        redirect(APP_URL.'my-diary');
    }


    public function review()
    {
        $data = array();
        $UserId = $this->session->userdata('front_UserId');
        $user_role = $this->crud->get_column_value_by_id("tbl_customer","user_role","id = ".$UserId);
        if($user_role == 1 || $user_role == 2 || $user_role == 4)
        { 
            

            $data['pageTitle'] = 'Review';        
            $this->load->view(FRONTEND."myaccount/review",$data);
        }
        else
        {
            $this->session->set_flashdata('error',"You don't have permission to access this page.");
            redirect("profile-info");
        }
    }


    public function ajaxPaginationDataReview()
    {
        $tablename = base64_encode('review');
        $tableId = base64_encode('id');
        $user_id = $this->session->userdata('front_UserId'); 
        $config['select'] = 'review.*';
        $config['table'] = 'review';

        $config['column_order'] = array('review.experience');
        $config['column_search'] = array('review.experience');         
        $config['custom_where'] = array('isDelete' => 0,'user_id'=>$user_id);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        
        foreach ($records as $record) {

            $action = '';
            $status = '';

            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            $action .= '
                <a href="'.URL.'review-details/'.md5($record->id).'" class="action-btn btn-edit"> <i class="fa fa-eye"></i></a>'; 
        
            

            $row = array();
            $row[] = $record->date;
            $row[] = $record->time;
            $row[] = $record->hour;
            $row[] = $record->call_type;
            $row[] = $record->experience;
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



    public function review_details($id)
    {
        $data = array();
        $user_id = $this->session->userdata('front_UserId'); 

        $detail = $this->crud->get_one_row("review",array("md5(id)"=>$id,'isDelete'=>0));

        $data['details']        = $detail;

        $user_d = $this->crud->get_one_row("tbl_customer",array('id'=>$detail['reviewer_user_id'],'is_delete'=>0,'status'=>'Y'));

        $data['user_d']        = $user_d;
        
        $data['pageTitle']      = 'Reviews Details';

        $this->load->view(FRONTEND."myaccount/review_details",$data);
                
    }


    public function contact_methods()
    {
        $data = array();
        $user_id = $this->session->userdata('front_UserId'); 
        $user_id = $this->session->userdata('front_UserId');
        $user_role = $this->crud->get_column_value_by_id("tbl_customer","user_role","id = ".$user_id);
        if($user_role == "4")
        {
            $profile = $this->crud->get_one_row("tbl_customer",array('id'=>$user_id,'is_delete'=>0,'status'=>'Y','is_verified'=>1,'user_role'=>4));
        }
        else
        {
            $profile = $this->crud->get_one_row("tbl_customer",array('id'=>$user_id,'is_delete'=>0,'status'=>'Y','is_verified'=>1,'user_role'=>5));
        }
    
        
        $data['profile']        = $profile;
        
        $data['pageTitle']      = 'Contact Method';

        $this->load->view(FRONTEND."myaccount/contact_method",$data);
    }


    public function store_contact()
    {
        if(!$this->session->userdata('customer_is_logged_in'))  
        {
            redirect(APP_URL.'login');
        }

        $data = array();
        $UserId = $this->session->userdata('front_UserId');
        $formSubmit = $this->input->post('submit');
        if($formSubmit == 'formSave')
        {    
            $post = $this->input->post();
            // echo "<pre>";
            // print_r($post);
            // exit;

            if(!empty($post['website'])){
                $post['website'] = implode(",",array_filter($post['website']));
            }else{
                $post['website'] = "";
            }

            $this->form_validation->set_rules('phone_no', 'Phone no', 'trim|required');

            if($this->form_validation->run()) 
            {

                $user_id = $this->session->userdata('front_UserId');
                $user_role = $this->crud->get_column_value_by_id("tbl_customer","user_role","id = ".$user_id);
                if($user_role == "4")
                {
                    $data = array(
                    "phone"                     => $post['phone_no'],
                    "whatsapp_number"           => $post['whatsapp_number'],
                    // "email"                     => $post['email'],
                    "website"                   => $post['website'],
                    "facebook"                  => $post['facebook'],
                    "pinterest"                 => $post['pinterest'],
                    "twitter"                   => $post['twitter'],
                    "instagram"                 => $post['instagram'],
                    );
    
                    $this->crud->update("tbl_customer",$data,array("id"=>$UserId));
                    $this->session->set_flashdata('success','Contact methods updated successfully.');
                    redirect("contact-methods");
                }

            }
           
        }
        
    }

    public function job_application()
    {
        $agency_id = $this->session->userdata('front_UserId');

        $jobs = $this->crud->get_all_with_where('agency_req','user_id','desc',array('agency_id'=>$agency_id,'isDelete'=>0));
        

        $data['pageTitle'] = 'Job Application';        
        $this->load->view(FRONTEND."myaccount/job_application",$data);
    }


    public function ajaxPaginationDataJobApplication()
    {
        $tablename = base64_encode('apply_job');
        $tableId = base64_encode('id');
        $user_id = $this->session->userdata('front_UserId'); 
        $config['select'] = 'apply_job.*';
        $config['table'] = 'apply_job';

        $config['column_order'] = array('apply_job.full_name');
        $config['column_search'] = array('apply_job.full_name');         
        $config['custom_where'] = array('isDelete' => 0,'agency_id'=>$user_id);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        
        foreach ($records as $record) {

            $action = '';
            $status = '';

            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            $action .= '
                <a href="'.URL.'jobs-details/'.md5($record->id).'" class="action-btn btn-edit"> <i class="fa fa-eye"></i></a>'; 
        
            

            $row = array();
            $row[] = $record->full_name;
            $row[] = $record->email;
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


    public function jobs_details($id)
    {
        $data = array();
        $user_id = $this->session->userdata('front_UserId'); 

        $detail = $this->crud->get_one_row("apply_job",array("md5(id)"=>$id,'isDelete'=>0,'status'=>'Y'));

        $data['details']        = $detail;

        $user_d = $this->crud->get_one_row("tbl_customer",array('id'=>$detail['user_id'],'is_delete'=>0,'status'=>'Y'));

        $data['user_d']        = $user_d;
        
        $data['pageTitle']      = 'jobs Application Details';

        $this->load->view(FRONTEND."myaccount/jobs_details",$data);
                
    }


    public function view_post()
    {
        // $agency_id = $this->session->userdata('front_UserId');

        $entertainment = $this->crud->get_all_with_where('service','name','desc',array('service_type'=>1,'isDelete'=>0,'status'=>'Y'));
        

        $escorts = $this->crud->get_all_with_where('service','name','desc',array('service_type'=>2,'isDelete'=>0,'status'=>'Y'));

        $both = $this->crud->get_all_with_where('service','name','desc',array('isDelete'=>0,'status'=>'Y'));
        $countrylists = $this->crud->get_all_with_where('country','name','asc',array('status'=>'Y','isDelete'=>0));
        
        $data['entertainment'] = $entertainment;
        $data['escorts']       = $escorts;
        $data['both']          = $both;
        $data['pageTitle'] = 'Create Post';        
        $this->load->view(FRONTEND."myaccount/create_post",$data);
    }


    public function insertRecord()
    {
        $post = $this->input->post();
        // echo "<pre>";
        // print_r($post);
        // exit;

        if(!$this->session->userdata('customer_is_logged_in')) 
        {
            redirect(APP_URL.'login');
        }

        $data = array();
        $UserId = $this->session->userdata('front_UserId');
        $add = $this->input->post('type');
        $plan_d  = $this->crud->get_one_row("purchase_plan",array('uid'=>$UserId,'status'=>1,'isDelete'=>0));
        $post_count  = $this->crud->get_data("post",array("isDelete" =>0,"status" =>'Y','user_id'=>$UserId));
        $t_post = count($post_count);
        $post_c = $plan_d['post'];

        // echo $t_post; exit;

        $this->form_validation->set_rules('title', 'Title', 'trim|required');

        $slug = $this->slug->create_slug($post['title']);

        $filename = "";
        if($_FILES['profile_image']['error'] == 0)
        {
            $allowed_types = 'gif|jpg|png|jpeg|jfif|webp|doc|txt';

            $filename = $this->crud->upload_file('profile_image', UPLOAD_DIR.POST_IMG,$allowed_types); 
            // echo $filename; exit;
            if($filename=="")
            {
                $this->session->set_flashdata('error', 'Not Supported this file.');
                redirect(APP_URL.'post');
            }
        }

        if($filename=="")
        {
            $filename = $post["old_profile_image"];

        }
        else
        {
            if($post["old_profile_image"]!="" && file_exists(UPLOAD_DIR.POST_IMG.$post["old_profile_image"]))
            {
                @unlink(UPLOAD_DIR.POST_IMG.$post["old_profile_image"]);
            }
        } 


        $posts = array(
            'user_id'               =>  $UserId,
            'service_id'            => $post['service_id'],
            'title'                 => $post['title'],
            'slug'                  => $slug,
            'phone_no'              => $post['phone_no'],
            'country_id'            => $post['country_id'],
            'state_id'              => $post['state_id'],
            'work_system'           => $post['work_system'],
            'work_hours'            => $post['work_hours'],
            'earnings'              => $post['earnings'],
            'requirements'          => $post['requirements'],
            'possible_earnings'     => $post['possible_earnings'],
            'selection'             => $post['selection'],
            'contract'              => $post['contract'],
            'more_info'             => $post['more_info'],
            'when_can_i_start'      => $post['when_can_i_start'],
            'accommodation'         => $post['accommodation'],
            'transport'             => $post['transport'],
            'image'                 => $filename,
            'isDelete'              => 0,
            'status'                => 'Y',
            );

        if($this->form_validation->run()) 
        {
            if($add== 'add')
            {
                $check_duplicate = $this->crud->check_duplicate("post",array('user_id'=>$UserId,'title' => $post['title']));
                    
                if($check_duplicate)
                {
                    $this->session->set_flashdata('error', 'Record already exists.');
                    redirect(APP_URL.'post');
                }
                else
                {   if($post_c > $t_post){
                        
                    }
                    else
                    {
                        $this->session->set_flashdata('success','only  '.$post_c.' post create ! Big plan purchase');
                        redirect("post");
                    }
                    
                    $result = $this->crud->insert("post",$posts);


                    if($result > 0)
                    {
                        $this->session->set_flashdata('success','Post create successfully.');
                        redirect("post");
                    }
                    else 
                    {   
                        $this->session->set_flashdata('error','Something went wrong');
                        redirect("post");
                    }
                }   
            }
            else
            {    
                $result = $this->crud->update("post",$posts,array("id"=>$this->input->post('editid'),));
                if($result > 0)
                {
                    $this->session->set_flashdata('success','Post updated successfully.');
                    redirect("post");
                }
                else
                {
                    $this->session->set_flashdata('error','Something went wrong');
                    redirect("post");
                }    
            }
        }

    }

    public function ajaxPaginationDataGallery()
    {
        $tablename = base64_encode('post');
        $tableId = base64_encode('id');
        $user_id = $this->session->userdata('front_UserId'); 
        $config['select'] = 'post.*';
        $config['table'] = 'post';

        $config['column_order'] = array('post.title');
        $config['column_search'] = array('post.title');         
        $config['custom_where'] = array('isDelete' => 0,'status'=>'Y','user_id'=>$user_id);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        
        foreach ($records as $record) {

            $action = '';
            $status = '';

            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            $action .= '<a href="'.base_url('post-add').'/'.$record->id.'" class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </a>';

            $dis_image = "";
            if(file_exists(UPLOAD_DIR.POST_IMG.$record->image) && $record->image!="")
            {

                $dis_image = '<a href="'.APP_URL.UPLOAD_DIR.POST_IMG.$record->image.'" target="_blank"><img style="width: 119px;height: auto;" src="'.APP_URL.UPLOAD_DIR.POST_IMG.$record->image.'" alt=""></a>';
              
            }
            else
            {
                $dis_image = '<img style="width: 119px;height: auto;" src="'.base_url(UPLOAD_DIR.'default.png').'">';
            }

            $row = array();
            $row[] = $dis_image;
            $row[] = $record->service_id;
            $row[] = $record->title;
            $row[] = $record->phone_no;
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
    

    public function insert_form_post($id="")
    {
        $entertainment = $this->crud->get_all_with_where('service','name','desc',array('service_type'=>1,'isDelete'=>0,'status'=>'Y'));
        
        $countrylists = $this->crud->get_all_with_where('country','name','asc',array('status'=>'Y','isDelete'=>0));
        $data['countrylists']  = $countrylists;

        $where = array('id' => $id,'isDelete'=>0,'status'=>'Y');
       
        $data['profile'] = $this->crud->get_one_row("post",$where );

        $data['ids']            = $id;
        $data['entertainment'] = $entertainment;
        $data['escorts']       = $escorts;

        $data['pageTitle'] = 'Create Post';        
        $this->load->view(FRONTEND."myaccount/add_post",$data);
    }


    public function story_view()
    {
        $data['pageTitle'] = 'Stories';        
        $this->load->view(FRONTEND."story/add_story",$data);
    }

    public function store_stories()
    {
        $this->load->library("upload");
        $post = $this->input->post();
        $UserId = $this->session->userdata('front_UserId');
        if($this->input->post('submit'))
        {
            $check_duplicate=$this->crud->check_duplicate("stories",array('user_id'=>$UserId,'isDelete'=>0,'status'=>'Y'));   
            
            if($check_duplicate != 1)
            {
                $userData = array(
                    'user_id'   => $UserId,
                    'isDelete'  => 0,
                    'status'    => 'Y',
                    'lastUpdated' => time(),
                );
                
                $result = $this->crud->insert("stories",$userData);
            }
            else
            {
                $userData = array(
                    'lastUpdated' => time(),
                );
                
                $result = $this->crud->update("stories",$userData,array("user_id"=>$UserId));
            }
            
            $where = array('user_id' => $UserId,'isDelete'=>0,'status'=>'Y');
            $data = $this->crud->get_one_row("stories",$where );
           

            if(!empty($_FILES['picture']['name']))
            {
                $image = time().'-'.$_FILES['picture']['name'];
                $config['upload_path'] = UPLOAD_DIR.STORIES;
                $config['allowed_types'] = 'jpg|png|jpeg|webp|svg|pjp|pjpeg|jpg|tiff|webm|mkv|flv|mp4|gif||m4p';
                $config['file_name'] = $image;
                
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture'))
                {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }
                else
                {
                    $this->session->set_flashdata('error',$this->upload->display_errors());
                    redirect("add-stories");
                }
            }
            else
            {
                $this->session->set_flashdata('error','Some problems occured, please try again.');
                redirect("add-stories");
            }

            $ext = pathinfo($picture, PATHINFO_EXTENSION);
            $video= array("webm","mkv","flv","gif","m4p","mp4");

            if (in_array($ext, $video))
            {
                $type = "video";
            }
            else
            {
                $type = "photo";
            }

            $stories_data = array(
                'story_id'      => $data['id'],
                'user_id'       => $UserId,
                'photo'         => $picture,
                'description'   => $post['description'],
                'type'          => $type,
                'length'        => 10,
                'time'          => time(),
                'isDelete'      => 0,
                'status'        => 'Y',
            );
            
            $result = $this->crud->insert("stories_child",$stories_data);

            if($result > 0)
            {
                $this->session->set_flashdata('success','Create a stories successfully.');
                redirect("add-stories");
            }
            else 
            {   
                $this->session->set_flashdata('error','Something went wrong');
                redirect("add-stories");
            }
            
        }
        else
        {
            $this->session->set_flashdata('error','Somthing want wrong');
            redirect("add-stories");
        }  
    }


    public function ajaxPaginationDataStory()
    {
        $tablename = base64_encode('stories_child');
        $tableId = base64_encode('id');
        $user_id = $this->session->userdata('front_UserId'); 
        $config['select'] = 'stories_child.*';
        $config['table'] = 'stories_child';

        $config['column_order'] = array('stories_child.photo');
        $config['column_search'] = array('stories_child.photo');         
        $config['custom_where'] = array('isDelete' => 0,'user_id'=>$user_id);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        
        foreach ($records as $record) {

            $dis_image = "";
            $action = "";
            if(file_exists(UPLOAD_DIR.STORIES.$record->photo) && $record->photo!="")
            {
               
                $ext = pathinfo(base_url().UPLOAD_DIR.STORIES.$record->photo, PATHINFO_EXTENSION);
                $video= array("webm","mkv","flv","gif","m4p","mp4");

                if (in_array($ext, $video))
                {
                
                $dis_image = '<div><iframe class="embed-responsive-item" src="'.APP_URL.UPLOAD_DIR.STORIES.$record->photo.'" sandbox  allowfullscreen></iframe></div>';
                }
                else
                {
               
                $dis_image = '<a href="'.APP_URL.UPLOAD_DIR.STORIES.$record->photo.'" target="_blank"><img style="width: 119px;height: auto;" src="'.APP_URL.UPLOAD_DIR.STORIES.$record->photo.'" alt=""></a>';
                }
            }
            else
            {
                $dis_image = '<img style="width: 119px;height: auto;" src="'.base_url(UPLOAD_DIR.'default.png').'">';
            }
            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->id.'" data-td="'.$tablename.'" data-user="'.$record->user_id.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            $row = array();
            $row[] = $dis_image;
            $row[] = $record->create_at;
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



    public function view_blog()
    {
        $data['pageTitle'] = 'Ads blog';        
        $this->load->view(FRONTEND."myaccount/ads_blog",$data);
    }


    public function add_blog($id="")
    {
      

        $where = array('id' => $id,'isDelete'=>0,'status'=>'Y');
       
        $data['profile'] = $this->crud->get_one_row("ads_blog",$where );

        $data['pageTitle'] = 'Create Blog';        
        $this->load->view(FRONTEND."myaccount/add_blog",$data);
    }

    public function store_blog()
    {
        $post = $this->input->post();
        // echo "<pre>";
        // print_r($post);
        // exit;

        if(!$this->session->userdata('customer_is_logged_in')) 
        {
            redirect(APP_URL.'login');
        }

        $slug = $this->slug->create_slug($post['title']);
        $UserId = $this->session->userdata('front_UserId');
        $add = $this->input->post('type');

        $filename = "";
        if($_FILES['profile_image']['error'] == 0)
        {
            $allowed_types = 'gif|jpg|png|jpeg|jfif|webp|doc|txt';

            $filename = $this->crud->upload_file('profile_image', UPLOAD_DIR.BLOG_IMG,$allowed_types); 
            
            if($filename=="")
            {
                $this->session->set_flashdata('error', 'Not Supported this file.');
                redirect(APP_URL.'post');
            }
        }

        if($filename=="")
        {
            $filename = $post["old_profile_image"];

        }
        else
        {
            if($post["old_profile_image"]!="" && file_exists(UPLOAD_DIR.BLOG_IMG.$post["old_profile_image"]))
            {
                @unlink(UPLOAD_DIR.BLOG_IMG.$post["old_profile_image"]);
            }
        } 


        $posts = array(
            'user_id'               =>  $UserId,
            'title'                 => $post['title'],
            'slug'                  => $slug,
            'description'           => $post['description'],
            'image'                 => $filename,
            'date'                  => $post['date'],
            'name'                  => $post['name'],
            'isDelete'              => 0,
            'status'                => 'Y',
        );

       
        if($add== 'add')
        {
            $check_duplicate = $this->crud->check_duplicate("ads_blog",array('user_id'=>$UserId,'title' => $post['title']));
                
            if($check_duplicate)
            {
                $this->session->set_flashdata('error', 'Record already exists.');
                redirect(APP_URL.'adver-blog');
            }
            else
            {   
                
                $result = $this->crud->insert("ads_blog",$posts);

                if($result > 0)
                {
                    $this->session->set_flashdata('success','Blog create successfully.');
                    redirect("adver-blog");
                }
                else 
                {   
                    $this->session->set_flashdata('error','Something went wrong');
                    redirect("adver-blog");
                }
            }   
        }
        else
        {    
            $result = $this->crud->update("ads_blog",$posts,array("id"=>$this->input->post('editid'),));
            if($result > 0)
            {
                $this->session->set_flashdata('success','Blog updated successfully.');
                redirect("adver-blog");
            }
            else
            {
                $this->session->set_flashdata('error','Something went wrong');
                redirect("adver-blog");
            }    
        }
    }

    public function ajaxPaginationDataBlog()
    {
        $tablename = base64_encode('ads_blog');
        $tableId = base64_encode('id');
        $user_id = $this->session->userdata('front_UserId'); 
        $config['select'] = 'ads_blog.*';
        $config['table'] = 'ads_blog';

        $config['column_order'] = array('ads_blog.name');
        $config['column_search'] = array('ads_blog.name');         
        $config['custom_where'] = array('isDelete' => 0,'user_id'=>$user_id);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        
        foreach ($records as $record) {

            $action = '';
            $status = '';

            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            $action .= '<a href="'.base_url('add-blog').'/'.$record->id.'" class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </a>';     

            $row = array();
            $row[] = $record->title;
            $row[] = $record->name;
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

    public function hen_stag_accommodation()
    {
        $statelists = $this->crud->get_all_with_where('state','name','asc',array('status'=>'Y','isDelete'=>0));
        $citylist = $this->crud->get_all_with_where('city','name','asc',array('status'=>'Y','isDelete'=>0));
        $countrylists = $this->crud->get_all_with_where('country','name','asc',array('status'=>'Y','isDelete'=>0));

        $data["relationship_status"]    = $relationship_status;
        $data['citylist']               = $citylist;
        $data['countrylists']           = $countrylists;
        $data['statelists']             = $statelists;
        
        $data['pageTitle'] = 'Hen Stag Accommodation';        
        $this->load->view(FRONTEND."myaccount/create_packages",$data);
    }

    public function hen_stag_accommodation_add($id="")
    {
        $statelists = $this->crud->get_all_with_where('state','name','asc',array('status'=>'Y','isDelete'=>0));
        $citylist = $this->crud->get_all_with_where('city','name','asc',array('status'=>'Y','isDelete'=>0));
        $countrylists = $this->crud->get_all_with_where('country','name','asc',array('status'=>'Y','isDelete'=>0));

        $where = array('id' => $id,'isDelete'=>0,'status'=>'Y');
       
        $data['profile'] = $this->crud->get_one_row("create_package",$where );

        $data['ids']            = $id;
        $data['citylist']               = $citylist;
        $data['countrylists']           = $countrylists;
        $data['statelists']             = $statelists;
        
        $data['pageTitle'] = 'Hen Stag Accommodation';        
        $this->load->view(FRONTEND."myaccount/add_packages",$data);
    }

    public function packages_store()
    {
        $post = $this->input->post();
        $UserId = $this->session->userdata('front_UserId');
        $hen_stag = $this->slug->create_slug($post['compnay_name']);
        $add = $this->input->post('type');
        // echo "<pre>";
        // print_r($post);
        // exit;
        $this->form_validation->set_rules('compnay_name', 'Compnay name', 'trim|required');
        $this->form_validation->set_rules('city_id', 'City', 'trim|required');

        $filename = "";

        if($_FILES['profile_image']['error'] == 0)
        {
            $allowed_types = "jpg|png|jpeg";
            $filename = $this->crud->upload_file('profile_image', UPLOAD_DIR.USER_PROFILE_IMG,$allowed_types);  

        }

        if($filename=="")
        {
            $filename = $post["old_profile_image"];

        }
        else
        {
            if($post["old_profile_image"]!="" && file_exists(UPLOAD_DIR.USER_PROFILE_IMG.$post["old_profile_image"]))
            {
            @unlink(UPLOAD_DIR.USER_PROFILE_IMG.$post["old_profile_image"]);
            }
        } 

        $posts = array(
            "user_id"                   => $UserId,
            "compnay_name"              => $post['compnay_name'],
            "slug"                      => $hen_stag,
            "category"                  => $post['category'],
            'age'                       => $post['age'],
            "profile_image"             => $filename,
            "review"                    => $post['review'],       
            "charge"                    => $post['charge'],
            "minimum_p"                 => $post['minimum_p'],
            "maximum_p"                 => $post['maximum_p'],
            "id_required"               => $post['id_required'],
            "start_time"                => $post['start_time'],
            "runs"                      => $post['runs'],
            "includes"                  => $post['includes'],
            'country_id'                => $post['country_id'],
            'state_id'                  => $post['state_id'],
            'city_id'                   => $post['city_id'],
            'introduction'              => $post['introduction'],
            'use_info'                  => $post['use_info'],
            'extra_details'             => $post['extra_details'],
        );

       
        if($add== 'add')
        {
            $check_duplicate = $this->crud->check_duplicate("create_package",array('user_id'=>$UserId,'compnay_name' => $post['compnay_name']));
                
            if($check_duplicate)
            {
                $this->session->set_flashdata('error', 'Record already exists.');
                redirect(APP_URL.'packages');
            }
            else
            {   
                $result = $this->crud->insert("create_package",$posts);

                if($result > 0)
                {
                    $this->session->set_flashdata('success','packages create successfully.');
                    redirect("packages");
                }
                else 
                {   
                    $this->session->set_flashdata('error','Something went wrong');
                    redirect("packages");
                }
            }   
        }
        else
        {    
            $result = $this->crud->update("create_package",$posts,array("id"=>$this->input->post('editid'),));
            if($result > 0)
            {
                $this->session->set_flashdata('success','packages updated successfully.');
                redirect("packages");
            }
            else
            {
                $this->session->set_flashdata('error','Something went wrong');
                redirect("packages");
            }    
        }
        
    }

    public function ajaxPaginationDataPackages()
    {
        $tablename = base64_encode('create_package');
        $tableId = base64_encode('id');
        $user_id = $this->session->userdata('front_UserId'); 
        $config['select'] = 'create_package.*';
        $config['table'] = 'create_package';

        $config['column_order'] = array('create_package.compnay_name');
        $config['column_search'] = array('create_package.compnay_name');         
        $config['custom_where'] = array('isDelete' => 0,'user_id'=>$user_id);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        
        foreach ($records as $record) {

            $action = '';
            $status = '';

            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            $action .= '<a href="'.base_url('packages/store').'/'.$record->id.'" class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </a>';
            
            $row = array();
            $row[] = $record->compnay_name;
            $row[] = $record->category;
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

    public function card_view ()
    {
        $data = array();
        $this->load->view(FRONTEND."myaccount/payment_method_card",$data);
    }
    
}
