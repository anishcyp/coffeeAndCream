<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontController.php';

class ReviewController extends FrontController 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud', 'crud'); 
        //$this->isUserLogin(); 
        $this->table = 'review';
    }


    public function store()
    {
        if(!$this->session->userdata('customer_is_logged_in')) 
        {
            $this->session->set_flashdata('error', 'Please login to your account.');
            redirect("SignIn");
        }

        $data = array();
        $UserId = $this->session->userdata('front_UserId');
        $formSubmit = $this->input->post('submit');
        
        $post = $this->input->post();
        $slug = $this->crud->get_column_value_by_id("tbl_customer","slug","id = '".$post['user_id']."'");
        $this->form_validation->set_rules('outcome', 'outcome', 'trim|required');
        $this->form_validation->set_rules('date', 'date', 'trim|required');
        $this->form_validation->set_rules('hour', 'hour', 'trim|required');
        $this->form_validation->set_rules('time', 'time', 'trim|required');
        $this->form_validation->set_rules('call_type', 'call_type', 'trim|required');
        $this->form_validation->set_rules('review_cost', 'review_cost', 'trim|required');
        $this->form_validation->set_rules('introduction', 'introduction', 'trim|required');

        if($this->form_validation->run()) 
        {

            $alias_name_check = $this->crud->check_duplicate("review",array('user_id'=>$post['user_id'],'isDelete'=>0));
            if($alias_name_check)
            {
                $this->session->set_flashdata('error', 'Review is already exits.');
                redirect("user/details/".$slug."/");
                exit();
            }

            

            $data = array(
                'user_id'                   => $post['user_id'],
                'reviewer_user_id'          => $UserId,
                "outcome"                   => $post['outcome'],
                "date"                      => $post['date'],
                "time"                      => $post['time'],
                "hour"                      => $post['hour'],
                "city_id"                   => $post['city_id'],
                // "show_location"             => $post['location_visibility'],
                "call_type"                 => $post['call_type'],
                "currency"                  => $post['currency'],
                "price"                     => $post['review_cost'],
                "experience"                => $post['introduction'],
                "accuracy_of_photos"        => $post['review_accuracy'],
                "location"                  => $post['review_loaction'],
                "physical_appearance"       => $post['review_physical'],
                "services_received"         => $post['review_servicerec'],
                "value_for_money"           => $post['review_valuemoney'],
                "overall_experience"        => $post['review_overallexp'],
                
                );

            $result = $this->crud->insert('review',$data);
            // echo $this->db->last_query(); exit;


            if($result)
            {

                $this->session->set_flashdata('success','Review added successfully.');
                
                redirect("user/details/".$slug."/");

                
            }
            else
            {
                $this->session->set_flashdata('error', 'Review not added');
                redirect("user/details/".$slug."/");

            }

        }
        else
        {
            if (validation_errors()) 
            {
                $this->session->set_flashdata('error', 'All fields is required');
                redirect("user/details/".$slug."/");

            }
                 
        }

    }


}