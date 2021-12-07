<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class ContactController extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();  
        $this->load->model('Crud', 'crud'); 
        $this->load->model('Cms_model', 'cms');
        $this->table = 'contactform';
    }


    public function index()
    {
        $this->global['pageTitle'] = 'Contact';
        $this->loadViews(ADMIN."contact", $this->global, null , NULL);
    }

    function headerindexordercontactArray() 
    {
        $headerindexordercontactArray = array(
            "0"=>"id",
            "1"=>"name",
            "2"=>'email',
            // "3"=>'phone',
            "3"=>'created_at',
        );
        return $headerindexordercontactArray;
    }
    
    function ajax_contact_datatable()
    {
        
        $tablename = base64_encode('contactform');
        $tableId = base64_encode('id');

        $config['select'] = 'r.*';
        $config['table'] = 'contactform r';
        

        $headerindexordercontactArray = $this->headerindexordercontactArray();

        $fieldname_c = $headerindexordercontactArray[$_REQUEST['order'][0]['column']];

        $config['column_order'] = array("name",'email',/*'phone',*/'created_at');
        $config['column_search'] = array("name",'email',/*'phone',*/'created_at');
        //$config['order'] = array('id' => 'desc');
        $config['order'] = array($fieldname_c => $_REQUEST['order'][0]['dir']);
        $config['custom_where'] = array('r.isDelete'=>0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
       
        $data = array();
        foreach ($records as $record) {
            
            if($record->department == 0)
            {
                $dis_department = "General Support";
            }
            else
            {
                $dis_department = "Moderators";
            }

            $action = '';
            $action .= '<button class="btn btn-icon waves-effect btn-primary rowview" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-eye"></i> View Message</button> ';

            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';
            

            $row = array();
            // $row[] = $record->id;
            $row[] = $dis_department;
            $row[] = $record->name;
            $row[] = $record->email;
            $row[] = $record->phone;
            $row[] = date("d-m-Y H:i:s A",strtotime($record->created_at));
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

    public function our_contact()
    {
        $this->global['pageTitle'] = 'Our Contact';
        $this->loadViews(ADMIN."our_contact", $this->global, null , NULL);
    }


     function ajax_our_contact_datatable()
    {
        $tablename = base64_encode('our_contact');
        $tableId = base64_encode('id');

        $config['select'] = 'our_contact.*';
        $config['table'] = 'our_contact';

        // $headerindexordercountryArray = $this->headerindexordercountryArray();

        // $fieldname_country = $headerindexordercountryArray[$_REQUEST['order'][0]['column']];

        $config['column_order'] = array('our_contact.name');
        $config['column_search'] = array('our_contact.name');         
        //$config['order'] = array('country_id' => 'desc');
        //$config['order'] = array($fieldname_country => $_REQUEST['order'][0]['dir']);
        $config['custom_where'] = array('isDelete' => 0);
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
            $row[] = $record->name;
            $row[] = $record->number_1;
            $row[] = $record->number_2;
            $row[] = '<input class="changeStatus" data-id="'.$record->id.'" data-status="'.$status.'" data-td="'.$tablename.'" data-i="'.$tableId.'" type="checkbox"  '.$ischecked.' id="switch'.$record->id.'" switch="bool"/><label for="switch'.$record->id.'" data-on-label="Yes" data-off-label="No"></label>';
            $row[] = $action;
            
            $data[] = $row;
        }
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->count_all(),
            "recordsFiltered" => $this->datatable->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function insertRecord()
    {
        $post = $this->input->post();

        $this->load->library('form_validation');            
        $this->form_validation->set_rules('name','Title ','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $data["msg"]        = validation_errors();
            $data["msg_type"]   = 'error';
            echo json_encode($data);
            exit;
        }
        else
        {
            $table_name = base64_decode($this->input->post('td')); 
            $field      = base64_decode($this->input->post('i')); 
            $type       = $this->input->post('type'); 
            $editid     = $this->input->post('editid');
            $isActive   = ( isset($post['isActive']) && $post['isActive'] == 'on' ? 'Y' : 'N');
            $slug       = $this->slug->create_slug($post['name']);

            unset($post["editid"]);
            unset($post["type"]);
            unset($post["isActive"]);
            unset($post["td"]);
            unset($post["i"]);

            $post['slug']       = $slug;
            $post['created_at'] = date('Y-m-d H:i:s');
            $post['status']     = $isActive;

            if($type == "add")
            {
                $is_duplicate = $this->crud->check_duplicate($table_name,array("slug"=>$slug,"isDelete"=>"0"));
                if($is_duplicate)
                {
                    $data["msg"]        = 'Record already exists. Please try another.';
                }
                else
                {
                    $result = $this->crud->insert($table_name,$post);

                    if($result > 0)
                    {
                        $data["msg"]        = 'Record Added successfully';
                    }
                    else
                    {
                        $data["msg"]        = 'Something went wrong';
                    }
                }
            }

            if($type == "edit")
            {
                $editid = $this->input->post('editid'); 
                $is_duplicate = $this->crud->check_duplicate($table_name,array($field."!="=>$editid,"slug"=>$slug,"isDelete"=>"0"));
                if($is_duplicate)
                {
                    $data["msg"]        = 'Record already exists. Please try another.';
                }
                else
                {
                    $where_array = array($field=>$editid);
                    $result = $this->crud->update($table_name,$post,$where_array);

                    if($result > 0)
                    {
                        $data["msg"]        = 'Record Updated successfully';
                    }
                    else
                    {
                        $data["msg"]        = 'Something went wrong';
                    }
                }
            }
          
            echo json_encode($data);
            exit;
        }
       
    }

    public function manage_des_contact(){

        $data = array();
        $where = array('id' =>1 );
        $result_d = $this->crud->get_one_row("description_contact_page",$where );
        $where1 = array('id' =>2 );
        $result_times = $this->crud->get_one_row("description_contact_page",$where1 );

        $data['time']= $result_times;
        $data['result']= $result_d;
        $this->global['pageTitle'] = 'Mange Description Contact';
        $this->loadViews(ADMIN."description_contact", $this->global, $data , NULL);
    }


    function store()
    {          

        $this->load->library('form_validation');        
        $this->form_validation->set_rules('title','Title *','trim|required');
        $this->form_validation->set_rules('descr','description *','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->showform();
        }
        else
        { 
           
            $dataInfo = array(
                'title'=>$this->input->post('title'),
                'descr'=>$this->input->post('descr'),
                'updated_date'=>date('Y-m-d H:i:s')
            );
            $wh = array("id"=>$this->input->post('id'));

            $result = $this->crud->update('description_contact_page',$dataInfo,$wh); 
                    
            $this->session->set_flashdata('success', 'Details Updated successfully');
            
            redirect(ADMIN.'description-contact');
        }
    } 
    


}