<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class TermController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();  
        $this->load->model('Crud', 'crud'); 
        $this->table = 'term';
    }

    function index()
    {
        $this->global['pageTitle'] = ' : Faq List';
        $this->loadViews(ADMIN."terms_manage", $this->global, NULL, NULL);
        
    }

}