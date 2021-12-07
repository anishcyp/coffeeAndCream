<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontController.php';

class VideosController extends FrontController 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud', 'crud'); 
        //$this->isUserLogin(); 
        $this->table = 'videos';
    }

    public function index() 
    {
        $data = array();
        $videos = $this->crud->get_all_with_where('videos','title','desc',array('status'=>'Y','isDelete'=>0));
        $data['videos']     = $videos;
        $data['pageTitle'] = 'Party Video | Stripper Life | Hen & Stag do Video | Stripper Party Bus'; 
        $this->load->view(FRONTEND."Videos/videos",$data);    
    }
}