<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class AboutusController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();  
        $this->load->model('Crud', 'crud'); 
        $this->table = 'about';
    }

    function index()
    {
       $data = array();
        $where = array('id' =>1 );
        $result_d = $this->crud->get_one_row("aboutUs",$where );
        
        $data['result']= $result_d;
        $this->global['pageTitle'] = 'About Us';
        $this->loadViews(ADMIN."about_us", $this->global, $data , NULL);
        
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
                'offer_title' =>$this->input->post('offer_title'),
                'offer_descr' =>$this->input->post('offer_descr'),
                'our_title' =>$this->input->post('our_title'),
                'our_descr' =>$this->input->post('our_descr'),
                'updated_date'=>date('Y-m-d H:i:s')
            );
            $wh = array("id"=>$this->input->post('id'));

            $result = $this->crud->update('aboutUs',$dataInfo,$wh); 
                    
            $this->session->set_flashdata('success', 'Details Updated successfully');
            
            redirect(ADMIN.'about-us');
        }
    } 


}