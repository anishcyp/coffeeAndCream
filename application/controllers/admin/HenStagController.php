<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class HenStagController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();  
        $this->load->model('Crud', 'crud'); 
        $this->table = 'manage_henstag';
    }

    function index()
    {
        $data = array();
        $where = array('id' =>1 );
        $result_d = $this->crud->get_one_row("manage_henstag",$where );
        
        $data['result']= $result_d;
        $this->global['pageTitle'] = 'Manage Hen Stag Accommodation';
        $this->loadViews(ADMIN."manage_hen_stag", $this->global, $data , NULL);
        
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
                'header_descr'=> $this->input->post('header_descr'),
                'second_title'=> $this->input->post('second_title'),
                'second_descr'=> $this->input->post('second_descr'),
                'third_title'=> $this->input->post('third_title'),
                'third_descr'=> $this->input->post('third_descr'),
                'footer_title'=> $this->input->post('footer_title'),
                'footer_descr'=> $this->input->post('footer_descr'),
                'updated_date'=>date('Y-m-d H:i:s')
            );
            $wh = array("id"=>$this->input->post('id'));

            $result = $this->crud->update('manage_henstag',$dataInfo,$wh); 
                    
            $this->session->set_flashdata('success', 'Hen Stag Accommodation Details Updated successfully');
            
            redirect(ADMIN.'manage-hen-stag');
        }
    } 

}