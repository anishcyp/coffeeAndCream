<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class ManageAgency extends BaseController
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
        $this->loadViews(ADMIN."Manageagency", $this->global, NULL, NULL);
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
        $config['column_search'] = array('cus.fname','cus.lname','cus.agency_name');         
        //$config['order'] = array('cus.id' => 'desc');
        $config['order'] = array($fieldname => $_REQUEST['order'][0]['dir']);
        $config['custom_where'] = array('is_delete'=>0,'user_role'=>4);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        $i = 0 ;
        foreach ($records as $record) {
          
            $action = '';
            $action .= '
                
            <a href="'.ADMIN_LINK.'manage-agency/view/'.$record->id.'" class="btn btn-icon waves-effect btn-success"> <i class="fa fa-eye"></i></a>

            <a onclick="return isConfirm()" href="'.ADMIN_LINK.'manage-agency/delete/'.$record->id.'" class="btn btn-icon waves-effect btn-danger"> <i class="fa fa-trash"></i></a>

            <a href="'.ADMIN_LINK.'manage-agency/gallery/'.$record->id.'" class="btn btn-icon waves-effect btn-info">Gallery</a>';

            $dis_image = "";
            if(file_exists(UPLOAD_DIR.USER_PROFILE_IMG.$record->profile_image) && $record->profile_image!="")
            {
                $dis_image = '<img class="media-object text-center" src="'.APP_URL.UPLOAD_DIR.USER_PROFILE_IMG.$record->profile_image.'" style="width: 175px; height: auto;">';
            }
            else
            {
                $dis_image = '<img class="media-object text-center" src="'.APP_URL.UPLOAD_DIR.'user_default.jpg" style="width: 175px; height: auto;">';
            }
            
            $ischecked = $record->agency_status == 'Y' ? 'checked="checked"' : '';
            $status = $record->agency_status == 'N' ? 'N' : 'Y';
            
            
            
            $row = array();
            $row[] = $record->id;
            $row[] = $dis_image;
            $row[] = $record->agency_name.'<br><br>'.$record->email.'<br><br>'.$record->agency_gender;
            $row[] = $record->user_role;
            $row[] = '<input class="changeStatus1" data-id="'.$record->id.'" data-status="'.$status.'" data-td="'.$tablename.'" data-i="'.$tableId.'" type="checkbox"  '.$ischecked.' id="switch'.$record->id.'" switch="bool"/><label for="switch'.$record->id.'" data-on-label="Yes" data-off-label="No"></label>';
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


    function getDetail($id)
    {
        $result = $this->crud->get_row_by_id($this->table,' id = "'.$id.'"');
        
        $location = $this->crud->get_all_with_where('location','id','ASC',array('user_id'=>$id,'isDelete'=>0));

        $diary = $this->crud->get_all_with_where('my_diary','id','ASC',array('user_id'=>$id,'isDelete'=>0));

        $call_rates = $this->crud->get_all_with_where('call_rates','decscription','desc',array('user_id'=>$id,'isDelete'=>0));

        $payment = $this->crud->get_all_with_where('payment','card_no','desc',array('user_id'=>$id));

        $deposit = $this->crud->get_all_with_where('deposit','payment_type','desc',array('uid'=>$id ,'isDelete'=>0));

        $plan = $this->crud->get_all_with_where('purchase_plan','plan_nickname','desc',array('uid'=>$id));

        $job = $this->crud->get_all_with_where('agency_req','request_str','desc',array('agency_id'=>$id));
        // echo "<pre>";
        // print_r($job);
        // exit();
        $data['jobs']               = $job;
        $data['plan']               = $plan;
        $data['deposit']            = $deposit;
        $data['diary']              = $diary;
        $data["location"]           = $location;
        $data["payment"]            = $payment;
        $data['call_rates']         = $call_rates;
        $data['edit']               = $result;
        $this->global['pageTitle']  = ' : User Details';
        
        $this->loadViews(ADMIN."agency_detail", $this->global, $data, NULL);
         
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
        redirect(ADMIN.'manage-agency');
    }

    
    function gallery_details($id)
    {
        $where = array('id' => $this->session->userdata('front_UserId') );
        
        $gallery = $this->crud->get_row_by_id('gallery',' user_id = "'.$id.'"');

        $data['info'] = $this->crud->get_one_row('tbl_customer',array('id' => $id));
        
        $data['id'] = $id;
        
        $data['gallery'] = $gallery;
        $this->global['pageTitle']  = ' : Gallery Details';
        $this->loadViews(ADMIN."agency_gallery_detail", $this->global, $data, NULL);
    }

    function ajax_gallery_datatable(){
        $ids_user = $_POST['id']; 
        $tablename = base64_encode('gallery');
        $tableId = base64_encode('id');

        $config['select'] = 'gallery.*';
        $config['table'] = 'gallery';

        $config['column_order'] = array('gallery.status');
        $config['column_search'] = array('gallery.status');         
        $config['order'] = array('gallery.id' => 'desc');
        $config['custom_where'] = array('gallery.user_id'=>$ids_user,'isDelete'=>0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();

       
        $video= array("webm","mkv","flv","gif","m4p","mp4");

        $count=1;
        foreach ($records as $record) {
            $action = '';
            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

         
            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';
            

            $row = array();
            $row[] = $count++;



            if(file_exists(UPLOAD_DIR.GALLERY_IMG.$record->gallery_file) && $record->gallery_file!='')  {

            
                // $array = explode('.', $_FILES['image']['name']);

                $ext = pathinfo($record->gallery_file, PATHINFO_EXTENSION);
                if (in_array($ext, $video))
                  {
                     $row[] = '<video width="100" height="100" controls>
                    <source src="'.base_url(UPLOAD_DIR.GALLERY_IMG.$record->gallery_file).'">
                    </video>';
                  }
                else
                  {
                    $row[] = '<img width="100" src="'.base_url(UPLOAD_DIR.GALLERY_IMG.$record->gallery_file).'">';
                  }

            

            }
            else
            {
            $row[] = '<img width="100" src="'.base_url(UPLOAD_DIR.'default.png').'">';
            }

            $row[] = '<input class="changeStatusMe" data-id="'.$record->id.'" data-status="'.$status.'" data-td="'.$tablename.'" data-i="'.$tableId.'" type="checkbox"  '.$ischecked.' id="switch'.$record->id.'" switch="bool"/><label for="switch'.$record->id.'" data-on-label="Yes" data-off-label="No"></label>';
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

}