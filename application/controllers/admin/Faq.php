<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class Faq extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();  
        $this->load->model('Crud', 'crud'); 
        $this->table = 'faq';
    }

    function index()
    {
        $this->global['pageTitle'] = ' : Faq List';
        $this->loadViews(ADMIN."faq_manage", $this->global, NULL, NULL);
        
    }

    function headerindexorderArray() 
    {
        $headerindexorderArray = array(
            "0"=>"faq.id",
            "1"=>"faq.title",
            "2"=>"faq.descr",
        );
        return $headerindexorderArray;
    }
    
   function ajax_datatable(){
        
        $tablename = base64_encode($this->table);
        $tableId = base64_encode('id');

        $config['select'] = 'faq.*';
        $config['table'] = 'faq';

        $headerindexorderArray = $this->headerindexorderArray();

        $fieldname = $headerindexorderArray[$_REQUEST['order'][0]['column']];

        $config['column_order'] = array('faq.id');
        $config['column_search'] = array('faq.title');         
        //$config['order'] = array('id' => 'desc');
        $config['order'] = array($fieldname => $_REQUEST['order'][0]['dir']);
        $config['custom_where'] = array('isDelete'=>0);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        

        foreach ($records as $record) {
           
            $action = '';
            $action .= '<a href="'.ADMIN_LINK.'manage-faq/edit/'.$record->id.'" class="btn btn-icon waves-effect btn-warning"> <i class="fa fa-pencil"></i></a>

                 <a onclick="return isConfirm()" href="'.ADMIN_LINK.'manage-faq/delete/'.$record->id.'" class="btn btn-icon waves-effect btn-danger"> <i class="fa fa-trash"></i></a>
                ';

            //$action .= '<button class="btn btn-icon waves-effect btn-success rowEdit" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-edit"></i> </button> ';
            
            $ischecked = $record->status == 'Y' ? 'checked="checked"' : '';
            $status = $record->status == 'Y' ? 'N' : 'Y';
            

            $row = array();
            $row[] = $record->id;
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

    function delete($id) {
        $data = array( "isDelete" => 1);
        $result = $this->crud->update($this->table,$data,array("id"=>$id));
        if($result) {
            $this->session->set_flashdata('success', 'Data Deteted successfully');
        } else {
            $this->session->set_flashdata('error', 'Something Was Wrong.');            
        }      
        redirect(ADMIN.'manage-faq');
    }

    function showform($id = "")
    {

        $data['type_title'] = 'FAQ';
        if(isset($id) && $id!="") 
        {
            $data['editid']         = $id;
            $data["type"]           = "edit";
            $data['edit']           = $this->crud->get_row_by_id('faq',array("id"=>$id));
        } 
        else 
        {
            $data["type"]           = "add";
        }

        $this->global["pageTitle"] = ' : Add Faq';
        $result = $this->SiteSetting_model->getSiteSetting();
        $data["siteSetting"] = $result[0];
        $this->loadViews(ADMIN."add_faq", $this->global, $data, NULL);
    }


    function store()
    {

        $post = $this->input->post();

       

        $this->form_validation->set_rules('title','Title ','trim|required');
        $this->form_validation->set_rules('descr','Description ','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->showform();
        }
        else
        { 
            $type                   = $post['type']; 
            $status = ($post['isActive']) ? 'Y' : 'N';
            $user_id = $this->session->userdata('userId');

            $dealInfo = array(
                'title'         =>  $post['title'],
                'descr'         =>  $post['descr'],
                'status'        =>  $status,
            );

            if($type == "add")
            {
                $result = $this->crud->insert('faq',$dealInfo);
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Details Inserted successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Something went wrong');
                }
            }

            if($type == "edit")
            {
                $editid = $this->input->post('editid'); 
                $result = $this->crud->update('faq',$dealInfo,array("id"=>$editid));

                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Details Updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Something went wrong');
                }
            }
            redirect(ADMIN.'manage-faq');
        }

    }    
}