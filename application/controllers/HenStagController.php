<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontController.php';

class HenStagController extends FrontController 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud', 'crud'); 
    }

    public function hen_stag_show()
    {
        $day = $this->crud->get_all_with_where('create_package','compnay_name','desc',array('isDelete'=>0,'status'=>'Y','category'=>'day'));

        $where = array('id' => 1 );
       
        $data['profile'] = $this->crud->get_one_row("manage_henstag",$where );
       
        $evening = $this->crud->get_all_with_where('create_package','compnay_name','desc',array('isDelete'=>0,'status'=>'Y','category'=>'evening'));

        $accommodation = $this->crud->get_all_with_where('create_package','compnay_name','desc',array('isDelete'=>0,'status'=>'Y','category'=>'accommodation'));

        $transfer = $this->crud->get_all_with_where('create_package','compnay_name','desc',array('isDelete'=>0,'status'=>'Y','category'=>'transfer'));
        
        $statelists_united = $this->crud->get_all_with_where('state','name','asc',array('status'=>'Y','isDelete'=>0,'country_id'=>229));
        $data['statelists_united'] = $statelists_united;
       
        $statelists_europe = $this->crud->get_all_with_where('state','name','asc',array('status'=>'Y','isDelete'=>0,'country_id'=>249));
        $data['statelists_europe'] = $statelists_europe;

        $worldwide = $this->crud->get_all_with_where('state','name','asc',array('status'=>'Y','isDelete'=>0,'country_id'=>250));
        $data['worldwide'] = $worldwide;

        $data["day"]    = $day;
        $data["evening"]    = $evening;
        $data["accommodation"]    = $accommodation;
        $data["transfer"]    = $transfer;
        
        $data['pageTitle'] = 'Hen stag accommodation';        
        $this->load->view(FRONTEND."hen_stag_accommodation",$data);
    }

    public function details($city_slug,$slug)
    {
        $id = $this->crud->get_column_value_by_id("create_package","id","slug = '".$slug."'");
        $city_name = $this->crud->get_column_value_by_id("city","name","slug = '".$city_slug."'");
        $Uid = $this->crud->get_column_value_by_id("create_package","user_id","id = '".$id."'");
        $is_valid_request = $this->crud->check_duplicate("create_package",array("id"=>$id,"isDelete"=>"0","status"=>'Y'));
      
        if($is_valid_request)
        {
            $data   = array();
            $params = array();

            $data['user_d'] = $this->crud->get_one_row("create_package",array("id"=>$id,"isDelete"=>"0","status"=>'Y'));
            
            $gallerylists = $this->crud->get_all_with_where('gallery','id','desc',array('status'=>'Y','isDelete'=>0,'user_id'=>$Uid));
            $data["gallerylists"]       = $gallerylists;
            $data['city_name']          = $city_name;
            $data['city_slug']          = $city_slug;
            $data['pageTitle'] = $data['user_d']['compnay_name'];        
            $this->load->view(FRONTEND."hen_stag_details",$data);
        }
        else
        {
            $this->session->set_flashdata('error', 'Something went wrong.');
            redirect('hen-stag-accommodation');
        }
    }

    public function view_stag($location_slug,$name)
    {
        $city_id = $this->crud->get_column_value_by_id("city","id","slug = '".$location_slug."'");
        $city_name = $this->crud->get_column_value_by_id("city","name","slug = '".$location_slug."'");
        
        $stag = $this->crud->get_all_with_where('create_package','compnay_name','desc',array('isDelete'=>0,'status'=>'Y','category'=>$name,"city_id"=>$city_id));

        $data['stag']       = $stag;
        $data['name']       = $name;
        $data['city_name']  = $city_name;
        $data['location_slug']  = $location_slug;
        $data['pageTitle']  = ucfirst($location_slug);        
        $this->load->view(FRONTEND."hen_stag_category",$data);
    }

    public function add_hen_stag($location_slug,$slug)
    {
        $UserId = $this->session->userdata('front_UserId');
        
        if($UserId)
        {
            
            $package_id = $this->crud->get_column_value_by_id("create_package","id","slug = '".$slug."'");

            $check_dup = $this->crud->check_duplicate("package_day",array('package_id'=>$package_id,'isDelete'=>0,"location="=>$location_slug,"user_id"=>$UserId));
            if($check_dup)
            {

            }
            else
            {
                
                if($package_id)
                {
                    $posts = array(
                        "user_id"       => $UserId,
                        "package_id"    => $package_id,
                        // "day"           => 1,
                        "location"      => $location_slug,
                    );

                    $result = $this->crud->insert("package_day",$posts);

                }
                else
                {
                    $this->session->set_flashdata('error','Something want wrong');
                    redirect("hen-stag-accommodation/details/".$location_slug."/".$slug."/");
                }
            }
            
            
            $data['city_slug'] = $location_slug;
            $data['package_id'] = $package_id;
            $data['UserId'] = $UserId;
            $data['slug']   = $slug;
            $data['pageTitle']  = "Add Hen Stag";        
            $this->load->view(FRONTEND."add_hen_stag",$data);
        }
        else
        {
            $this->session->set_flashdata('error','Please login to your account, in order to use your packages oders.');
            redirect("hen-stag-accommodation/details/".$location_slug."/".$slug."/");
        }
        
    }

    public function location_hen_stag_view($slug)
    {
        $id = $this->crud->get_column_value_by_id("city","id","slug = '".$slug."'");
        $name = $this->crud->get_column_value_by_id("city","name","slug = '".$slug."'");
        // echo $id; exit;
        $is_valid_request = $this->crud->check_duplicate("city",array("id"=>$id,"isDelete"=>"0","status"=>'Y'));
        if($is_valid_request)
        {
            $data   = array();
            $params = array();
            
            $descr_city = $this->crud->get_column_value_by_id("city","hen_description","slug = '".$slug."'");

            $statelists_united = $this->crud->get_all_with_where('state','name','asc',array('status'=>'Y','isDelete'=>0,'country_id'=>229));
            $data['statelists_united'] = $statelists_united;
        
            $statelists_europe = $this->crud->get_all_with_where('state','name','asc',array('status'=>'Y','isDelete'=>0,'country_id'=>249));
            $data['statelists_europe'] = $statelists_europe;

            $worldwide = $this->crud->get_all_with_where('state','name','asc',array('status'=>'Y','isDelete'=>0,'country_id'=>250));
            $data['worldwide'] = $worldwide;

            // $day = $this->crud->get_all_with_where('create_package','compnay_name','desc',array('isDelete'=>0,'status'=>'Y','category'=>'day','city_id'=>$id));

            $sql_day = 'SELECT * FROM `create_package` WHERE `isDelete` = 0 AND `status` = "Y" AND `category` = "day" AND `city_id` = "'.$id.'" ORDER BY `compnay_name` ASC LIMIT 6';

            $day = $this->crud->getFromSQL($sql_day);

            // echo $this->db->last_query(); die();

            // $evening = $this->crud->get_all_with_where('create_package','compnay_name','desc',array('isDelete'=>0,'status'=>'Y','category'=>'evening','city_id'=>$id));

            $sql_evening = 'SELECT * FROM `create_package` WHERE `isDelete` = 0 AND `status` = "Y" AND `category` = "evening" AND `city_id` = "'.$id.'" ORDER BY `compnay_name` ASC LIMIT 6';
            $evening = $this->crud->getFromSQL($sql_evening);

            // $accommodation = $this->crud->get_all_with_where('create_package','compnay_name','desc',array('isDelete'=>0,'status'=>'Y','category'=>'accommodation','city_id'=>$id));

            $sql_accommodation = 'SELECT * FROM `create_package` WHERE `isDelete` = 0 AND `status` = "Y" AND `category` = "accommodation" AND `city_id` = "'.$id.'" ORDER BY `compnay_name` ASC LIMIT 6';
            $accommodation = $this->crud->getFromSQL($sql_accommodation);

            // $transfer = $this->crud->get_all_with_where('create_package','compnay_name','desc',array('isDelete'=>0,'status'=>'Y','category'=>'transfer','city_id'=>$id));

            $sql_transfer = 'SELECT * FROM `create_package` WHERE `isDelete` = 0 AND `status` = "Y" AND `category` = "transfer" AND `city_id` = "'.$id.'" ORDER BY `compnay_name` ASC LIMIT 6';
            $transfer = $this->crud->getFromSQL($sql_transfer);

            $review = $this->crud->get_all_with_where('create_package','compnay_name','desc',array('isDelete'=>0,'status'=>'Y','city_id'=>$id));

            $data['review']             = $review;
            $data["day"]                = $day;
            // echo "<pre>";
            // print_r($day);
            // exit;
            $data["evening"]            = $evening;
            $data["accommodation"]      = $accommodation;
            $data["transfer"]           = $transfer;
            $data['l_name']             = $name;
            $data['location_slug']       = $slug;
            $data['descr_city']         = $descr_city;

            $data['pageTitle'] = $name .' stag do';        
            $this->load->view(FRONTEND."accommodation_location",$data);
        }
        else
        {
            $this->session->set_flashdata('error', 'Something went wrong.');
            redirect('hen-stag-accommodation');
        }
    }

    

    public function enquiry()
    {
        $where = array('id' => $this->session->userdata('front_UserId') );
        $profile = $this->crud->get_one_row("tbl_customer",$where );
        
        $post = $this->input->post();
        $package_id = $post['package_id'];
        $email  = $post['email'];
        $size_group = $post['size_group'];
        $date = $post['date'];
        $night = $post['night'];
        $budget = $post['budget'];
        $status = $post['status'];
        $remember = $post['remember'];
        
        $where = array('id' => $package_id,'status'=>'Y','isDelete'=>0);
        $package = $this->crud->get_one_row("create_package",$where );

        $whre_accommodation = array('id' => $package['user_id'] );
        $accommodation = $this->crud->get_one_row("tbl_customer",$whre_accommodation );
        
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
        $mail_data['fname']         = $package['compnay_name'];

        $mail_data['user_fname']    = $profile['fname'].' '.$profile['lname'];
        $mail_data['email']         = $email;
        $mail_data['phone_no']       = $accommodation['phone'];
        $mail_data['size_group']     = $size_group;
        $mail_data['date']           = $date;
        $mail_data['night']          = $night;
        $mail_data['budget']         = $budget;
        $mail_data['status']         = $status;

        //Company email's
        $message = $this->load->view('mail_template/enqury_template', $mail_data, TRUE);

        $mailbody['ToEmail']    = $accommodation['email'];
        $mailbody['FromName']   = $profile['fname'].' '.$profile['lname'];
        $mailbody['FromEmail']  = $profile['email'];
        $mailbody['Subject']    = $general_setting->site_name." - New Enquiry";
        $mailbody['Message']    = $message;

        //Admin email's
        $admin_message = $this->load->view('mail_template/admin_enquiry_mail_template', $mail_data, TRUE);
        // echo $admin_message; exit;
        $admin_mailbody['ToEmail']    = $general_setting->site_from_admin_email;
        $admin_mailbody['FromName']   = $general_setting->site_name;
        $admin_mailbody['FromEmail']  = $general_setting->site_from_email;
        $admin_mailbody['Subject']    = $general_setting->site_name." - New Enquiry";
        $admin_mailbody['Message']    = $admin_message;
        
        $mail_result = $this->EmailSend($mailbody);
        $admin_result = $this->EmailSend($admin_mailbody);

        if($mail_result || $admin_result)
        {
            $this->session->set_flashdata('success','Enquiry send successfully.');
            redirect("hen-stag-accommodation");
        }
        else
        {
            $this->session->set_flashdata('error','Something want wrong.');
            redirect("hen-stag-accommodation");
        }
    }

    public function Updatetime()
    {
        $post = $this->input->post();
       
        $location = $post['location'];
       
        $time = $post['time'];
        $id= $post['id'];
        $user_id = $post['user_id'];
        $package_id = $post['package_id'];
        $time = $post['time'];
        $slug = $this->crud->get_column_value_by_id("create_package","slug","id = '".$package_id."'");

        $data = array(
            'time'          => $time,
        );
        
        
        $result = $this->crud->update("package_day",$data,array("id"=>$id));

        if($result)
        {
            redirect("adds-package/".$location."/".$slug."/");
            
        }
        else
        {
            $this->session->set_flashdata('error','Something want wrong.');
            redirect("adds-package/".$location."/".$slug."/");
        }
        
    }

    public function Updatepeople()
    {
        $post = $this->input->post();
       
        $location = $post['location'];
        
        $id= $post['id'];
        $user_id = $post['user_id'];
        $package_id = $post['package_id'];
        $people = $post['people'];
        $slug = $this->crud->get_column_value_by_id("create_package","slug","id = '".$package_id."'");

        $data = array(
            'people'          => $people,
        );

        $result = $this->crud->update("package_day",$data,array("id"=>$id));

        if($result)
        {
            redirect("adds-package/".$location."/".$slug."/");
            
        }
        else
        {
            $this->session->set_flashdata('error','Something want wrong.');
            redirect("adds-package/".$location."/".$slug."/");
        }

    }

}