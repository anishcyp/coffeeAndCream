<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontController.php';

class Newsletter_subscribe extends FrontController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud', 'crud'); 
        $this->table = 'newslettersubscriber';
    }

    // ************************** Main Listing *************
    public function index() 
    {
         // $this->load->library("upload");
        $post = $this->input->post();
        // print_r($post);exit;
        $this->form_validation->set_rules('email','Email *','trim|valid_email|required');

        if($this->form_validation->run() == FALSE)
        {
          echo 'Something went wrong';
          // $this->create();
        }
        else
        {

            $fieldInfo = array(
                'email'                  =>  $post['email'],
                'created_at'             => date('Y-m-d H:i:s'),
            );

            $check_duplicate = $this->crud->check_duplicate($this->table,array('email'=>$post['email']));
            if($check_duplicate)
            {
                $result = $this->crud->delete($this->table,array("email"=>$post['email']));
                echo "Unsubscribed Successfully";
                // $this->session->set_flashdata('error', 'Unsubscribed Successfully');
            }else{
                $result = $this->crud->insert($this->table,$fieldInfo);

                if($result > 0){
                    echo "1";
                }
                else{
                    echo 'Something went wrong';
                } 
            }



            // redirect('blog-listing');
            // die();
        }   
    }

}
