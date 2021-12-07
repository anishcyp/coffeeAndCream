<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontController.php';
class Home extends FrontController {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud', 'crud'); 
    }

    public function index()
    {   
        $data = array();
        $data['pageTitle'] = 'Hire Strippers | Virtual Escorts | Kissogram | Stripper Party Bus';
        $descr = $this->crud->get_all_with_where('home_page_description','description','desc',array('status'=>'Y','isDelete'=>0));
        $data['descr'] = $descr;

        $image = $this->crud->get_all_with_where('home_service_images','description','desc',array('status'=>'Y','isDelete'=>0));
        $data['image'] = $image;

        $slider = $this->crud->get_all_with_where('home_page','title','desc',array('status'=>'Y','isDelete'=>0));
        $data['slider'] = $slider;


          $params = array();
          $page = $this->input->post('page');

          $onpage_record = 12;
          $offset = $onpage_record * $page;
          $limit = $onpage_record;

          $params['start']      = $offset;
          $params['Limit']      = $limit;
          $params['ShortBy']     = "id desc";
          $params['ShortOrder']  = "";
          $data['posts']        = $this->crud->get_data('tbl_customer',array('status'=>'Y','accommodation_user'=>0,'is_delete'=>0,'purchase_plan'=>1),$params);

    	$this->load->view(FRONTEND."home_page",$data);
    }

    public function user_role()
    {
        $user_id = $this->session->userdata('front_UserId');
        $user_role = $this->crud->get_column_value_by_id("tbl_customer","user_role","id = ".$user_id);
        
        if($user_role == 0)
        {
            $data = array();
            $data['pageTitle'] = 'Choose Service';        
            $this->load->view(FRONTEND."myaccount/user_role",$data);    
        }
        else
        {
            $this->session->set_flashdata('error',"Already select service don't have permission to access.");
            redirect("user-role");
        }
    }

    public function Updaterole($id)
    {
        // echo $id; exit;

        $UserId = array('id' => $this->session->userdata('front_UserId') );

        if($id == 1)
        {
            $general_setting            = $this->generalSetting(); 
            $timer = date('Y-m-d H:i:s', strtotime('+'.$general_setting->welcome_kit.' days'));

            $data = array(
                'user_role'    => $id,
                'timer'        => $timer,
                'purchase_plan'=> 1,
            );

            $result = $this->crud->update("tbl_customer",$data,$UserId);
           
            $this->session->set_flashdata('success','Role updated successfully.');
            redirect("profile-info");
        }
        else if($id == 2)
        {
            $general_setting            = $this->generalSetting(); 
            $timer = date('Y-m-d H:i:s', strtotime('+'.$general_setting->welcome_kit.' days'));

            $data = array(
                'user_role'    => $id,
                'timer'        => $timer,
                'purchase_plan'=> 1,

            );

            $this->crud->update("tbl_customer",$data,$UserId);
            $this->session->set_flashdata('success','Role updated successfully.');
            redirect("profile-info");
        }
        else if($id == 4)
        {
            $data = array(
                'user_role'         => $id,
                'timer'             => '',
                'purchase_plan'     => 0,
                'agency_user'       => 1,
                'agency_status'     => 'N',
            );

            $this->crud->update("tbl_customer",$data,$UserId);
            $this->session->set_flashdata('success','Role updated successfully.');
            redirect("profile-info");
        }
        else if($id == 5)
        {
            $data = array(
                'user_role'         => $id,
                'timer'             => '',
                'purchase_plan'     => 0,
                'agency_user'       => 0,
                'agency_status'     => 'N',
                'accommodation_user' => 1,
            );

            $this->crud->update("tbl_customer",$data,$UserId);
            $this->session->set_flashdata('success','Role updated successfully.');
            redirect("profile-info");
        }
        else
        {
            $this->session->set_flashdata('error',"You don't have permission to access.");
            redirect("user-role");
        }
        
    }
    
    public function view_privacy() 
    {
        $this->db->select("*");
		$this->db->from('cms_page');
		$this->db->where("page","privacy");
		$query = $this->db->get()->result_array();
		$data['result'] = $query[0];

        $data['pageTitle'] = "Read Our Privacy Policy Principles";
        $this->load->view(FRONTEND."cms/cms_privacy",$data);
    }

    public function view_terms() 
    {
        $result = $this->crud->get_all_with_where('terms','title','desc',array('status'=>'Y','isDelete'=>0));

		$data['result'] = $result;

        $data['pageTitle'] = "Terms and Conditions";
        $this->load->view(FRONTEND."cms/cms_terms",$data);
    }


    public function view_faq()
    {
        $this->db->select("*");
        $this->db->from('faq');
        $this->db->where(array("isDelete"=>"0","status"=>"Y"));
        $query = $this->db->get()->result_array();
        $data['result'] = $query;
        
        $data['pageTitle'] = "Stripper FAQ | Ask anything about Strippers | Stripper Party Bus";
        $this->load->view(FRONTEND."cms/cms_faq",$data);
    }
    
    public function home_search()
    {
        
        $serch_keywords = explode(',',$_REQUEST['keywords']);
        if(count($serch_keywords) > 1)
        {
            $serch_keywords = explode(',',$_REQUEST['keywords']);
            if(count($serch_keywords) > 1)
            {
                $keyword_location = $serch_keywords[1];
                $keywords = $serch_keywords[0];
            }
            else
            {
                $keywords = $serch_keywords[0];
            }
            
            $where = "( co.name LIKE '%".$keyword_location."%' ESCAPE '!' OR co.country_code LIKE '%".$keyword_location."%' ESCAPE '!' OR st.name LIKE '%".$keyword_location."%' ESCAPE '!' OR ci.name LIKE '%".$keyword_location."%' ESCAPE '!'";
            
            $city_id =$this->crud->getFromSQL("SELECT id from city where name like '%".$keyword_location."%'");
            if(!empty($city_id)){
                $city_id = $city_id[0]->id;
                $where .= " or FIND_IN_SET($city_id, l.city_id)";
            }
            
            $state_id =$this->crud->getFromSQL("SELECT state_id from state where name like '%".$keyword_location."%'");
            
            if(!empty($state_id)){
                $state_id = $state_id[0]->state_id;
                $where .= " or l.state_id = ".$state_id."";
            }
            
            $country_id =$this->crud->getFromSQL("SELECT country_id from country where name like '%".$keyword_location."%' OR country_code like '%".$keyword_location."%'");
            
            if(!empty($country_id)){
                $country_id = $country_id[0]->country_id;
                $where .= " or l.country_id = ".$country_id." ";
            }
            
            $where .= ")";
            
            $sql = "SELECT `c`.* FROM `tbl_customer` `c` INNER JOIN `service` `s` ON FIND_IN_SET(s.service_id, c.service_id) INNER JOIN `country` `co` ON `co`.`country_id` = `c`.`country_id` INNER JOIN `state` `st` ON `st`.`state_id` = `c`.`state_id` INNER JOIN `city` `ci` ON `ci`.`id` = `c`.`city_id` INNER JOIN `location` `l` ON `l`.`user_id` = `c`.`id`  WHERE ( c.fname LIKE '".$keywords."%' ESCAPE '!' OR c.lname LIKE '".$keywords."%' ESCAPE '!' OR c.email LIKE '".$keywords."%' ESCAPE '!' OR c.alias_name LIKE '".$keywords."%' ESCAPE '!' OR s.name LIKE '%".$keywords."%' ESCAPE '!' ) AND ".$where." AND `c`.`is_delete` = 0 AND `c`.`status` = 'Y' AND `c`.`purchase_plan` = 1 AND `c`.`is_verified` = 1 GROUP by c.id";
            
            $sql = str_replace("%male","male",$sql);
            $sql = str_replace("%Male","Male",$sql);
            
            
            $datas  = $this->crud->getFromSQL($sql); 

            $data['posts'] = array();
            foreach($datas as $dat){
                
                $data['posts'][] = (array)$dat;    
            }
            

        }
        else
        {
           $keywords = $serch_keywords[0];

            $whrs = array('name'=>$keywords);
            $city_id = $this->crud->get_one_value("city",$whrs,"id");

            $join['select'] = 'c.*';
            $join['table'] = 'tbl_customer c';
        
            $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1);
            
            if(isset($keywords) && $keywords!="")
            {
                // $join['joins'][] = array(
                //     'join_table' => 'service s', 
                //     'join_by' => 's.service_id = c.service_id ', 
                //     'join_type' => 'inner');
                

                $join['joins'][] = array(
                    'join_table' => 'country co', 
                    'join_by' => 'co.country_id = c.country_id ', 
                    'join_type' => 'inner');
        
                $join['joins'][] = array(
                    'join_table' => 'state sa', 
                    'join_by' => 'sa.state_id = c.state_id ', 
                    'join_type' => 'inner');
        
                $join['joins'][] = array(
                    'join_table' => 'city ca', 
                    'join_by' => 'ca.id = c.city_id ', 
                    'join_type' => 'inner');

        
                if($city_id)
                {
                    $join['joins'][] = array(
                        'join_table' => 'location l', 
                        'join_by' => 'l.user_id = c.id ', 
                        'join_type' => 'inner');
                   

                    $params['find_in_set_field']       = "l.city_id";
                    $params['find_in_set_value']       = $city_id;

                }
                else
                {
                    $params['like'] = array("c.fname" => $keywords,"c.slug"=>$keywords,"c.lname" => $keywords,"c.alias_name" => $keywords,"co.name" => $keywords,"co.country_code" => $keywords,"sa.name" => $keywords,"ca.name" => $keywords);
                }
                
            }
        
            $data['posts']        = $this->crud->get_join($join,$wh,$params);
            echo $this->db->last_query(); exit();
        }

        if(empty($data['posts']))
        {
            $service = $serch_keywords[0];
            $location = $serch_keywords[1];

            $data['service_name'] = $service;
            $data['location_name'] = $location;

            $service_id =$this->crud->get_column_value_by_id("service","service_id","name LIKE '".$service."%'");

            if($service_id)
            {
                $join['select'] = 'c.*';
                $join['table'] = 'tbl_customer c';

                $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1);
            
                $params['find_in_set_field']        = "c.service_id";
                $params['find_in_set_value']        = $service_id;

                $params['ShortBy']      = "c.id desc";
                $params['ShortOrder']   = "";
                $data['service_id']    = $service_id;
                $data['users']          = $this->crud->get_join($join,$wh,$params);
            }
            
            // echo $this->db->last_query(); exit();
        }
        
        $this->load->view(FRONTEND."ajax_home_service",$data);
    }



}
