<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class ManageLocation extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {

        parent::__construct();
        $this->isLoggedIn();  
        $this->load->model('Crud', 'crud'); 
        $this->table = 'city';
    }


    public function index()
    {
        $this->global['pageTitle'] = 'Manage City';
        $data = array();
        
        $countrylists = $this->crud->get_result_where_array('country',array('status'=>'Y','isDelete'=>0) );
        $data["countrylists"] = $countrylists;

        $this->loadViews(ADMIN."city_manage", $this->global, $data , NULL);
    }

    function headerindexordercityArray() 
    {
        $headerindexordercityArray = array(
            "0"=>"c.id",
            "1"=>"c.name",
            "2"=>"s.name",
        );
        return $headerindexordercityArray;
    }
    
    function ajax_city_datatable()
    {
        
        $tablename = base64_encode('city');
        $tableId = base64_encode('id');

        $config['select'] = 'c.*,s.name as statename,co.name as countryname';
        $config['table'] = 'city c';
        
        $config['joins'][] = array(
            'join_table' => 'state s', 
            'join_by' => 'c.state_id = s.state_id', 
            'join_type' => 'inner');

        $config['joins'][] = array(
            'join_table' => 'country co', 
            'join_by' => 'c.country_id = co.country_id', 
            'join_type' => 'inner');


        $headerindexordercityArray = $this->headerindexordercityArray();

        $fieldname_c = $headerindexordercityArray[$_REQUEST['order'][0]['column']];

        $config['column_order'] = array('c.name','s.name');
        $config['column_search'] = array('c.name','s.name');
        //$config['order'] = array('id' => 'desc');
        $config['order'] = array($fieldname_c => $_REQUEST['order'][0]['dir']);
        $config['custom_where'] = array('c.isDelete'=>0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
       
        $data = array();
        foreach ($records as $record) {
          
            $action = '';
            $descr_button = '';
            $hen_stag_button = '';
            $action .= '<button class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </button> ';

            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            $descr_button .='<button class="btn btn-success rowDes" data-id="'.$record->id.'" data-toggle="modal" data-td="'.$tablename.'" data-i="'.$tableId.'" data-target="#exampleModal">Description</button>';
            
            $hen_stag_button .='<button class="btn btn-success rowDesHen" data-id="'.$record->id.'" data-toggle="modal" data-td="'.$tablename.'" data-i="'.$tableId.'" data-target="#HenstagModal">Hen-stag Descr</button>';
            
            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';
            

            $row = array();
            $row[] = $record->id;
            $row[] = $record->countryname;
            $row[] = $record->statename;
            $row[] = $record->name;
            
            $row[] = $descr_button;
            $row[] = $hen_stag_button;
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

    public function cityarea()
    {
        $this->global['pageTitle'] = 'Manage City Area';

        $countrylists = $this->crud->get_result_where_array('country',array('status'=>'Y','isDelete'=>0) );
        $data["countrylists"] = $countrylists;

        $this->loadViews(ADMIN."city_area_manage", $this->global, $data , NULL);
    }

    function headerindexordercityareaArray() 
    {
        $headerindexordercityareaArray = array(
            "0"=>"ca.id",
            "1"=>"c.name",
            "2"=>"ca.name",
        );
        return $headerindexordercityareaArray;
    }

    function ajax_city_area_datatable()
    {
        
        $tablename = base64_encode('city_area');
        $tableId = base64_encode('id');

        $config['select'] = 'ca.*,c.name as cityname,s.name as statename,co.name as countryname';
        $config['table'] = 'city_area ca';
        
        $config['joins'][] = array(
            'join_table' => 'city c', 
            'join_by' => 'ca.city_id = c.id', 
            'join_type' => 'inner');
        
        $config['joins'][] = array(
            'join_table' => 'state s', 
            'join_by' => 'c.state_id = s.state_id', 
            'join_type' => 'inner');

        $config['joins'][] = array(
            'join_table' => 'country co', 
            'join_by' => 'c.country_id = co.country_id', 
            'join_type' => 'inner');

         $headerindexordercityareaArray = $this->headerindexordercityareaArray();

        $fieldname_ca = $headerindexordercityareaArray[$_REQUEST['order'][0]['column']];

        $config['column_order'] = array('ca.name','c.name');
        $config['column_search'] = array('ca.name','c.name');
        //$config['order'] = array('id' => 'desc');
        $config['order'] = array($fieldname_ca => $_REQUEST['order'][0]['dir']);
        $config['custom_where'] = array('ca.isDelete' => 0);

        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        foreach ($records as $record) {
          
            $action = '';
            $action .= '<button class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </button> ';

            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';
            
            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';
            

            $row = array();
            $row[] = $record->id;
            $row[] = $record->countryname;
            $row[] = $record->statename;
            $row[] = $record->cityname;
            $row[] = $record->name;
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

    public function state()
    {
        $this->global['pageTitle'] = 'Manage State';

        $countrylists = $this->crud->get_result_where_array('country',array('status'=>'Y','isDelete'=>0) );
        $data["countrylists"] = $countrylists;

        $this->loadViews(ADMIN."state_manage", $this->global, $data , NULL);
    }

    function headerindexorderstateArray() 
    {
        $headerindexorderstateArray = array(
            "0"=>"state.state_id",
            "1"=>"state.name",
        );
        return $headerindexorderstateArray;
    }

    
    function ajax_state_datatable(){
        
        $tablename = base64_encode('state');
        $tableId = base64_encode('state_id');

        $config['select'] = 'state.*';
        $config['table'] = 'state';

        $headerindexorderstateArray = $this->headerindexorderstateArray();

        $fieldname_state = $headerindexorderstateArray[$_REQUEST['order'][0]['column']];

        $config['column_order'] = array('state.name');
        $config['column_search'] = array('state.name');         
        //$config['order'] = array('state_id' => 'desc');
        $config['order'] = array($fieldname_state => $_REQUEST['order'][0]['dir']);
        $config['custom_where'] = array('isDelete' => 0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        

        foreach ($records as $record) {
            $country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$record->country_id."'");
            $action = '';
            $descr_button = '';
            $action .= '<button class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->state_id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </button> ';
            
            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->state_id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            $descr_button .='<button type="button"  class="btn btn-primary rowDes" data-id="'.$record->state_id.'" data-toggle="modal" data-td="'.$tablename.'" data-i="'.$tableId.'" data-target="#exampleModal">Description</button>';

            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';
            

            $row = array();
            $row[] = $record->state_id;
            $row[] = $country_name;
            $row[] = $record->name;
            $row[] = '<input class="changeStatus" data-id="'.$record->state_id.'" data-status="'.$status.'" data-td="'.$tablename.'" data-i="'.$tableId.'" type="checkbox"  '.$ischecked.' id="switch'.$record->state_id.'" switch="bool"/><label for="switch'.$record->state_id.'" data-on-label="Yes" data-off-label="No"></label>';
            $row[] = $action;
            $row[] = $descr_button;
            
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

    public function country()
    {
        $this->global['pageTitle'] = 'Manage Country';
        $this->loadViews(ADMIN."country_manage", $this->global, NULL , NULL);
    }


    public function favourite()
    {
        $this->global['pageTitle'] = 'Manage Favourite';
        $this->loadViews(ADMIN."manage_favourite", $this->global, NULL , NULL);
    }

        public function language()
    {
        $this->global['pageTitle'] = 'Manage Language';
        $this->loadViews(ADMIN."manage_language", $this->global, NULL , NULL);
    }

    function headerindexordercountryArray() 
    {
        $headerindexordercountryArray = array(
            "0"=>"country.country_id",
            "1"=>"country.name",
        );
        return $headerindexordercountryArray;
    }
    
    function ajax_country_datatable(){
        
        $tablename = base64_encode('country');
        $tableId = base64_encode('country_id');

        $config['select'] = 'country.*';
        $config['table'] = 'country';

        $headerindexordercountryArray = $this->headerindexordercountryArray();

        $fieldname_country = $headerindexordercountryArray[$_REQUEST['order'][0]['column']];

        $config['column_order'] = array('country.name');
        $config['column_search'] = array('country.name');         
        //$config['order'] = array('country_id' => 'desc');
        $config['order'] = array($fieldname_country => $_REQUEST['order'][0]['dir']);
        $config['custom_where'] = array('isDelete' => 0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        

        foreach ($records as $record) {
          
            $action = '';
            $descr_button = '';
            $action .= '<button class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->country_id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </button> ';
            
            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->country_id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            $descr_button .='<button type="button"  class="btn btn-primary rowDes" data-id="'.$record->country_id.'" data-toggle="modal" data-td="'.$tablename.'" data-i="'.$tableId.'" data-target="#exampleModal">Description</button>';

            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';
            

            $row = array();
            $row[] = $record->country_id;
            $row[] = $record->name;
            $row[] = '<input class="changeStatus" data-id="'.$record->country_id.'" data-status="'.$status.'" data-td="'.$tablename.'" data-i="'.$tableId.'" type="checkbox"  '.$ischecked.' id="switch'.$record->country_id.'" switch="bool"/><label for="switch'.$record->country_id.'" data-on-label="Yes" data-off-label="No"></label>';
            $row[] = $action;
            $row[] = $descr_button;
            
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

    function ajax_language_datatable(){
        
        $tablename = base64_encode('language');
        $tableId = base64_encode('language_id');

        $config['select'] = 'language.*';
        $config['table'] = 'language';

        $headerindexordercountryArray = $this->headerindexordercountryArray();

        $fieldname_country = $headerindexordercountryArray[$_REQUEST['order'][0]['column']];

        $config['column_order'] = array('language.name');
        $config['column_search'] = array('language.name');         
        //$config['order'] = array('country_id' => 'desc');
        $config['order'] = array($fieldname_country => $_REQUEST['order'][0]['dir']);
        $config['custom_where'] = array('isDelete' => 0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        

        foreach ($records as $record) {
          
            $action = '';
            $descr_button = '';
            $action .= '<button class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->language_id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </button> ';
            
            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->language_id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            $descr_button .='<button type="button"  class="btn btn-primary rowDes" data-id="'.$record->language_id.'" data-toggle="modal" data-td="'.$tablename.'" data-i="'.$tableId.'" data-target="#exampleModal">Description</button>';

            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';
            

            $row = array();
            $row[] = $record->language_id;
            $row[] = $record->name;
            $row[] = '<input class="changeStatus" data-id="'.$record->language_id.'" data-status="'.$status.'" data-td="'.$tablename.'" data-i="'.$tableId.'" type="checkbox"  '.$ischecked.' id="switch'.$record->language_id.'" switch="bool"/><label for="switch'.$record->language_id.'" data-on-label="Yes" data-off-label="No"></label>';
            $row[] = $action;
            $row[] = $descr_button;

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

    function ajax_favourite_datatable(){
        
        $tablename = base64_encode('favorite');
        $tableId = base64_encode('favorite_id');

        $config['select'] = 'favorite.*';
        $config['table'] = 'favorite';

        $headerindexordercountryArray = $this->headerindexordercountryArray();

        $fieldname_country = $headerindexordercountryArray[$_REQUEST['order'][0]['column']];

        $config['column_order'] = array('favorite.name');
        $config['column_search'] = array('favorite.name');         
        //$config['order'] = array('country_id' => 'desc');
        $config['order'] = array($fieldname_country => $_REQUEST['order'][0]['dir']);
        $config['custom_where'] = array('isDelete' => 0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        

        foreach ($records as $record) {
          
            $action = '';
            $descr_button = '';
            $action .= '<button class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->favorite_id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </button> ';
            
            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->favorite_id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            
            $descr_button .='<button type="button"  class="btn btn-primary rowDes" data-id="'.$record->favorite_id.'" data-toggle="modal" data-td="'.$tablename.'" data-i="'.$tableId.'" data-target="#exampleModal">Description</button>';

            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';
            

            $row = array();
            $row[] = $record->favorite_id;
            $row[] = $record->name;
            $row[] = '<input class="changeStatus" data-id="'.$record->favorite_id.'" data-status="'.$status.'" data-td="'.$tablename.'" data-i="'.$tableId.'" type="checkbox"  '.$ischecked.' id="switch'.$record->favorite_id.'" switch="bool"/><label for="switch'.$record->favorite_id.'" data-on-label="Yes" data-off-label="No"></label>';
            $row[] = $action;
            $row[] = $descr_button;
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
                     $row[] = '<video width="200" height="200" controls>
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



    function ajax_faq_datatable(){
        
        $tablename = base64_encode('faq');
        $tableId = base64_encode('id');

        $config['select'] = 'faq.*';
        $config['table'] = 'faq';

        $headerindexordercountryArray = $this->headerindexordercountryArray();

        $fieldname_faq = $headerindexordercountryArray[$_REQUEST['order'][0]['column']];

        $config['column_order'] = array('faq.descr');
        $config['column_search'] = array('faq.descr');         
        //$config['order'] = array('country_id' => 'desc');
        $config['order'] = array($fieldname_faq => $_REQUEST['order'][0]['dir']);
        $config['custom_where'] = array('isDelete' => 0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        
        $count=1;
        foreach ($records as $record) {
          
            $action = '';
            $action .= '<button class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </button> ';
            
            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';
            

            $row = array();
            $row[] = $count++;
            $row[] = $record->title; 
            $row[] = $record->question; 
            $row[] = $record->descr;
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


    function ajax_terms_datatable(){
        
        $tablename = base64_encode('terms');
        $tableId = base64_encode('id');

        $config['select'] = 'terms.*';
        $config['table'] = 'terms';

        $headerindexordercountryArray = $this->headerindexordercountryArray();

        $fieldname_terms = $headerindexordercountryArray[$_REQUEST['order'][0]['column']];

        $config['column_order'] = array('terms.descr');
        $config['column_search'] = array('terms.descr');         
        //$config['order'] = array('country_id' => 'desc');
        $config['order'] = array($fieldname_terms => $_REQUEST['order'][0]['dir']);
        $config['custom_where'] = array('isDelete' => 0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        
        $count=1;
        foreach ($records as $record) {
          
            $action = '';
            $action .= '<button class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </button> ';
            
            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';

            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'N' ? 'N' : 'Y';
            

            $row = array();
            $row[] = $count++;
            $row[] = $record->title; 
            $row[] = $record->descr;
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
    
}