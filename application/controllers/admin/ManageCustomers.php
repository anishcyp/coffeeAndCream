<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class ManageCustomers extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();  
        $this->load->model('Crud', 'crud'); 
        $this->table = 'tbl_customer';
    }

    function index()
    {
        $this->global['pageTitle'] = ' : Users Listing';
        $this->loadViews(ADMIN."ManageCustomers", $this->global, NULL, NULL);
    }
    
    function headerindexorderArray() 
    {
        $headerindexorderArray = array(
            "0"=>"cus.id",
            "1"=>"cus.fname",
            "2"=>"cus.email",
        );
        return $headerindexorderArray;
    }

    function ajax_datatable(){

        $job_type = $this->config->item('tbl_customer');
        $tablename = base64_encode($this->table);
        $tableId = base64_encode('id');

        $config['select'] = 'cus.*';
        $config['table'] = 'tbl_customer cus';
        
        $headerindexorderArray = $this->headerindexorderArray();
        $fieldname = $headerindexorderArray[$_REQUEST['order'][0]['column']];

        $config['column_order'] = array('cus.id');
        $config['column_search'] = array('cus.fname','cus.lname','cus.email');         
        //$config['order'] = array('cus.id' => 'desc');
        $config['order'] = array($fieldname => $_REQUEST['order'][0]['dir']);
        $config['custom_where'] = array('is_delete'=>0,'agency_user'=>0,'accommodation_user'=>0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
       
        foreach ($records as $record) {
          
            $action = '';
            $action .= '
                
            <a href="'.ADMIN_LINK.'manage-user/view/'.$record->id.'" class="btn btn-icon waves-effect btn-success"> <i class="fa fa-eye"></i></a>

            <a onclick="return isConfirm()" href="'.ADMIN_LINK.'manage-user/delete/'.$record->id.'" class="btn btn-icon waves-effect btn-danger"> <i class="fa fa-trash"></i></a>

            <a href="'.ADMIN_LINK.'manage-user/gallery/'.$record->id.'" class="btn btn-icon waves-effect btn-info">Gallery</a>';

            $dis_image = "";
            if(file_exists(UPLOAD_DIR.USER_PROFILE_IMG.$record->profile_image) && $record->profile_image!="")
            {
                $dis_image = '<img class="media-object text-center" src="'.APP_URL.UPLOAD_DIR.USER_PROFILE_IMG.$record->profile_image.'" style="width: 175px; height: auto;">';
            }
            else
            {
                $dis_image = '<img class="media-object text-center" src="'.APP_URL.UPLOAD_DIR.'user_default.jpg" style="width: 175px; height: auto;">';
            }
            
            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';
            
            
            
            $row = array();
            $row[] = $record->id;
            $row[] = $dis_image;
            $row[] = $record->fname." ".$record->lname.'<br><br>'.$record->email.'<br><br>'.$record->gender;
            $row[] = $record->user_role;
            $row[] = '<input class="changeStatus" data-id="'.$record->id.'" data-status="'.$status.'" data-td="'.$tablename.'" data-i="'.$tableId.'" type="checkbox"  '.$ischecked.' id="switch'.$record->id.'" switch="bool"/><label for="switch'.$record->id.'" data-on-label="Yes" data-off-label="No"></label>';
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
        $data = array( "is_delete" => 1);
        $result = $this->crud->update($this->table,$data,array("id"=>$id));

        if($result) 
        {
            $update_data_close =  array(
                "isDelete"  => '1',
                "status"    => 'N',
            );

            $wh_close = array("user_id"=>$id,"added_by"=>"0");  
           
            $this->session->set_flashdata('success', 'Data Deteted successfully');
        } 
        else 
        {
            $this->session->set_flashdata('error', 'Something Was Wrong.');            
        }      
        redirect(ADMIN.'manage-user');
    }

    function getDetail($id)
    {
        $result = $this->crud->get_row_by_id($this->table,' id = "'.$id.'"');
        
        $location = $this->crud->get_all_with_where('location','id','ASC',array('user_id'=>$id,'isDelete'=>0));

        $diary = $this->crud->get_all_with_where('my_diary','id','ASC',array('user_id'=>$id,'isDelete'=>0));

        $call_rates = $this->crud->get_all_with_where('call_rates','decscription','desc',array('user_id'=>$id,'isDelete'=>0));

        $payment = $this->crud->get_all_with_where('payment','card_no','desc',array('user_id'=>$id));

        $deposit = $this->crud->get_all_with_where('deposit','payment_type','desc',array('uid'=>$id ,'isDelete'=>0));

        $plan = $this->crud->get_all_with_where('purchase_plan','plan_nickname','desc',array('uid'=>$id));
        /*echo "<pre>";
        print_r($deposit);
        exit();*/
        $data['plan']               = $plan;
        $data['deposit']            = $deposit;
        $data['diary']              = $diary;
        $data["location"]           = $location;
        $data["payment"]            = $payment;
        $data['call_rates']         = $call_rates;
        $data['edit']               = $result;
        $this->global['pageTitle']  = ' : User Details';
        
        $this->loadViews(ADMIN."user_detail", $this->global, $data, NULL);
        
       
    }

    function gallery_details($id)
    {
        $where = array('id' => $this->session->userdata('front_UserId') );
        
        $gallery = $this->crud->get_row_by_id('gallery',' user_id = "'.$id.'"');

        $data['info'] = $this->crud->get_one_row('tbl_customer',array('id' => $id));
        
        $data['id'] = $id;

        
        $data['gallery'] = $gallery;
        $this->global['pageTitle']  = ' : Gallery Details';
        $this->loadViews(ADMIN."gallery_detail", $this->global, $data, NULL);
    }

    // function gallery_details1()
    // {

    //     $gallery = $this->crud->get_row_by_id('gallery',' id = "'.$_REQUEST['id'].'"');

    //     $target = base_url(UPLOAD_DIR.GALLERY_IMG.$gallery['gallery_file']);
    //     $target1 = UPLOAD_DIR.GALLERY_IMG.$gallery['gallery_file'];
    //     $wtrmrk_file = base_url('public/front/images/logo/waterMark.png');
    //     $watermarkImg = imagecreatefrompng($wtrmrk_file); 

    //     $fileType = pathinfo($target,PATHINFO_EXTENSION); 

    //     switch($fileType){ 
    //         case 'jpg': 
    //             $im = imagecreatefromjpeg($target); 
    //             break; 
    //         case 'jpeg': 
    //             $im = imagecreatefromjpeg($target); 
    //             break; 
    //         case 'png': 
    //             $im = imagecreatefrompng($target); 
    //             break; 
    //         default: 
    //             $im = imagecreatefromjpeg($target); 
    //     } 

    //     // Set the margins for the watermark 
    //     $marge_right = 30; 
    //     $marge_bottom = 50; 
            
    //     // Get the height/width of the watermark image 
    //     $sx = imagesx($watermarkImg); 
    //     $sy = imagesy($watermarkImg); 

    //     imagecopy($im, $watermarkImg, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($watermarkImg), imagesy($watermarkImg));
        
    //     // Save image and free memory 
    //     imagepng($im, $target1);       
    //     imagedestroy($im); 
    // }
    function gallery_details1()
    {

        $gallery = $this->crud->get_row_by_id('gallery',' id = "'.$_REQUEST['id'].'"');
        
        $ext = pathinfo($gallery['gallery_file'], PATHINFO_EXTENSION);
        $video= array("webm","mkv","flv","gif","m4p","mp4");
        
        if(in_array($ext, $video))
        {

        }
        else
        {
            $this->SetImageSize($gallery['gallery_file'],300,500);

            $this->SetImagefevicon($gallery['gallery_file']);
        }
        
        // $this->SetImageSize($gallery['gallery_file'],300,500);

        // $this->SetImagefevicon($gallery['gallery_file']);
        
    }

    function SetImageSize($filename,$width,$height){
        // File type
        $target = base_url(UPLOAD_DIR.GALLERY_IMG.$filename);
        $target1 = UPLOAD_DIR.GALLERY_IMG.$filename;
        // Get new dimensions
        list($width_orig, $height_orig) = getimagesize($target);

        // Resampling the image 
        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefromjpeg($target);
        //echo  $image; exit;
        header('Content-Type: image/jpg');   
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig); 
        // Save image and free memory  
        $fileType = pathinfo($image_p,PATHINFO_EXTENSION); 

        switch($fileType){ 
            case 'jpg': 
                imagejpeg($image_p, $target1); 
                break; 
            case 'jpeg': 
                imagejpeg($image_p, $target1);
                break; 
            case 'png': 
                imagepng($image_p, $target1);
                break; 
            default: 
                imagejpeg($image_p, $target1); 
        } 
    }

    function SetImagefevicon($filename){

        $target = base_url(UPLOAD_DIR.GALLERY_IMG.$filename);
        $target1 = UPLOAD_DIR.GALLERY_IMG.$filename;
        $wtrmrk_file = base_url('public/front/images/logo/waterMark.png');
        $watermarkImg = imagecreatefrompng($wtrmrk_file); 

        $fileType = pathinfo($target,PATHINFO_EXTENSION); 

        switch($fileType){ 
            case 'jpg': 
                $im = imagecreatefromjpeg($target); 
                break; 
            case 'jpeg': 
                $im = imagecreatefromjpeg($target); 
                break; 
            case 'png': 
                $im = imagecreatefrompng($target); 
                break; 
            default: 
                $im = imagecreatefromjpeg($target); 
        } 

        // Set the margins for the watermark 
        $marge_right = 20; 
        $marge_bottom = 20; 
            
        // Get the height/width of the watermark image 
        $sx = imagesx($watermarkImg); 
        $sy = imagesy($watermarkImg); 

        imagecopy($im, $watermarkImg, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($watermarkImg), imagesy($watermarkImg));
        
        // Save image and free memory  
        $fileType = pathinfo($im,PATHINFO_EXTENSION); 

        switch($fileType){ 
            case 'jpg': 
                imagejpeg($im, $target1); 
                break; 
            case 'jpeg': 
                imagejpeg($im, $target1);
                break; 
            case 'png': 
                imagepng($im, $target1);
                break; 
            default: 
                imagejpeg($im, $target1); 
        } 
        imagedestroy($im); 
    }

    public function Verifygallery()
    {
        $id = $this->input->post('id');
        $gallery_verify =  $this->input->post('gallery_verify');
        
        $where_array = array("id" => $id);

        $data_upd = array('Verifygallery' => $gallery_verify);

        $result = $this->crud->update('tbl_customer',$data_upd,$where_array);

        if ($result > 0) { 
            echo(json_encode(array('status'=>TRUE))); 
        }
        else { 
            echo(json_encode(array('status'=>FALSE))); 
        }
    }

    public function v_send_mail_list()
    {
        $this->global['pageTitle'] = ' : Sending Mail List';
        $this->loadViews(ADMIN."ManageSendMail", $this->global, NULL, NULL);
    }
    
    public function ajax_datatable_sendingMail(){


        $config['select'] = 'cus.*';
        $config['table'] = 'sending_mail cus';
        
        $headerindexorderArray = $this->headerindexorderArray();
        $fieldname = $headerindexorderArray[$_REQUEST['order'][0]['column']];

        $config['column_order'] = array('cus.id');
        $config['column_search'] = array('cus.subject','cus.email');         
        //$config['order'] = array('cus.id' => 'desc');
        $config['order'] = array($fieldname => $_REQUEST['order'][0]['dir']);
        $config['custom_where'] = array('isDelete'=>0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables(); 
        $data = array();
        foreach ($records as $record) {
          
            $action = '';
            $action .= '
                
            <a href="'.ADMIN_LINK.'send-mail/'.$record->id.'" class="btn btn-icon waves-effect btn-success"> <i class="fa fa-share-square-o"></i></a>';
         
            
            
            $row = array();
            $row[] = $record->id;
            $row[] = addslashes($record->email);
            $row[] = $record->subject;
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

    public function v_send_mail($id = 0)
    {   
        $data = $this->crud->get_row_by_id("sending_mail","id = ".$id.""); 
        if(empty($data)){
            $data = array();
        }
        // echo "<pre>";
        // print_r($data); exit;
        $this->global['pageTitle'] = ' : Send Mail';
        $this->loadViews(ADMIN."send_mail", $this->global, $data, NULL); 
    }

    public function mail_sending()
    {
        $post = $this->input->post();

        // $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('descr','Massage','trim|required');
        $this->form_validation->set_rules('subject','Massage','trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $this->showform();
        }
        else
        {

            $email = implode(",",$post['email']);
            $msg = $post['descr'];
            $subject = $post['subject'];
            $field_info = array(
                "email" => addslashes($email),
                "massage" => $msg,
                "subject" => $subject
            );
            $this->crud->insert("sending_mail",$field_info);


            $email = explode(",",$email);

            // print_r($email); exit;

            /* General setting common from all email start */
            $general_setting            =  $this->generalSetting(); 
            $mail_data['site_name']     = $general_setting->site_name;
            $mail_data['site_title']    = $general_setting->site_title;
            $mail_data['site_email']    = $general_setting->email;
            $mail_data['address']       = $general_setting->address;
            $mail_data['fb_link']       = $general_setting->fb_link;
            $mail_data['twitter_link']  = $general_setting->twitter_link;
            $mail_data['instagram_link'] = $general_setting->instagram_link;
            $mail_data['copyright_year'] = date("Y");
                   
            /* General setting common from all email end */

            $mail_data['data']         = $msg;

            $message = $this->load->view('mail_template/mail_sending_template', $mail_data, TRUE);
            $mailbody['ToEmail']    = $general_setting->site_from_email;;
            $mailbody['ToBcc']      = $email;
            $mailbody['FromName']   = $general_setting->site_name;;
            $mailbody['FromEmail']  = $general_setting->site_from_email;
            $mailbody['Subject']    = $subject;
            $mailbody['Message']    = $message;
            // print_r($mailbody); exit;
            $mail_result = $this->SendMultiEmail($mailbody);
            /*echo "<pre>";
            print_r($mail_result); exit;*/
            if($mail_result)
            {
                $this->session->set_flashdata('success', 'Mail Send successfully');
            
                redirect(ADMIN.'send-mail-list');
            }
            else
            {
                $this->session->set_flashdata('success', 'Mail Not Send');
            
                redirect(ADMIN.'send-mail-list');
            }

            
        }
        
    }

}