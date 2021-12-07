<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class SubscriberController extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();  
        $this->load->model('Crud', 'crud'); 
        $this->table = 'newslettersubscriber';
    }


    public function index()
    {
        $this->global['pageTitle'] = 'Subscriber';
        $this->loadViews(ADMIN."subscriber", $this->global, null , NULL);
    }

    function headerindexordercityArray() 
    {
        $headerindexordercityArray = array(
            "0"=>"id",
            "1"=>'email',
            "2"=>'created_at',
        );
        return $headerindexordercityArray;
    }
    
    function ajax_subscriber_datatable()
    {
        
        $tablename = base64_encode('newslettersubscriber');
        $tableId = base64_encode('id');

        $config['select'] = 'r.*';
        $config['table'] = 'newslettersubscriber r';
        

        $headerindexordercityArray = $this->headerindexordercityArray();

        $fieldname_c = $headerindexordercityArray[$_REQUEST['order'][0]['column']];

        $config['column_order'] = array('email','created_at');
        $config['column_search'] = array('email','created_at');
        //$config['order'] = array('id' => 'desc');
        $config['order'] = array($fieldname_c => $_REQUEST['order'][0]['dir']);
        $config['custom_where'] = array(/*'r.isDelete'=>0*/);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
       
        $data = array();
        foreach ($records as $record) {
          
          /*  $action = '';
            $action .= '<button class="btn btn-icon waves-effect btn-primary rowview" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-eye"></i> View Message</button> ';*/
            

            $row = array();
            // $row[] = $record->id;
            $row[] = $record->email;
            $row[] = date("d-m-Y H:i:s A",strtotime($record->created_at));
            // $row[] = $action;
            
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