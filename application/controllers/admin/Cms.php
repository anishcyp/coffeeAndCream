<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class Cms extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();  
        $this->load->model('Crud', 'crud'); 
        $this->table = 'cms_page';
        $this->load->model('Cms_model', 'cms');
    }

    function index($page)
    {   
        $data = array();
        $data['result'] = $this->cms->get_page($page);
        $result = $this->SiteSetting_model->getSiteSetting();
        $data["siteSetting"] = $result[0];
        $this->global['pageTitle'] = ' : Update List';
        $this->global['page'] = ucfirst($page);
        $this->loadViews(ADMIN."cms", $this->global, $data, NULL);
    
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
            $type = $this->input->post('type');
            $dataInfo = array(
                'title'=>$this->input->post('title'),
                'descr'=>$this->input->post('descr'),
                'updated_date'=>date('Y-m-d H:i:s')
            );
            $wh = array("id"=>$this->input->post('id'));

            $result = $this->crud->update('cms_page',$dataInfo,$wh); 
                    
            $this->session->set_flashdata('success', 'Details Updated successfully');
            
            redirect(ADMIN.'cms/'.$type."");
        }
    } 
}