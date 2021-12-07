<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontController.php';

class ServicesController extends FrontController 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud', 'crud'); 
        //$this->isUserLogin(); 
        $this->table = 'service';
    }

    public function serviceList($slug,$country_slug="",$state_slug="",$city_slug="")
    {
        $response = $this->crud->get_row_by_id($this->table,array('slug'=>$slug,'status'=>'Y','isDelete'=>0));
        if ($response) 
        {
            $data   = array();
            $params = array();
            $params1 = array();

            if($country_slug!="")
            {
                $country_res = $this->crud->get_row_by_id("country",array('slug'=>$country_slug,'status'=>'Y','isDelete'=>0));
                if($country_res)
                {
                    if($state_slug!="")
                    {
                        $state_res = $this->crud->get_row_by_id("state",array('slug'=>$state_slug,'status'=>'Y','isDelete'=>0));
                        if($state_res)
                        {
                            if($city_slug!='')
                            {
                                $city_res = $this->crud->get_row_by_id("city",array('slug'=>$city_slug,'status'=>'Y','isDelete'=>0));
                                if($city_res)
                                {

                                    $totalRec = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where FIND_IN_SET(".$response['service_id'].",service_id) and purchase_plan=1 and is_delete=0 and id IN (select user_id from location where country_id='".$country_res['country_id']."' AND state_id='".$state_res['state_id']."' AND find_in_set(".$city_res['id'].", city_id))");
                                    
                                    $data['total_record'] = $totalRec[0]->total_user;

                                    if($data['total_record'] == 0)
                                    {
                                        $data['total_record2'] = "";
                                    }
                                    else
                                    {
                                        $data['total_record2'] = "There are ".$data['total_record']." profiles in ".$state_res['name']." that match your search.";
                                    }

                                    $total = $data['total_record'] - 28;
                                    $data['total'] = $total;

                                    $data['btnname']                       =  $city_res['name'];
                                    
                                    if($data['total_record'] == 0)
                                    {
                                        $data['description_profiles'] = "";
                                    }
                                    else
                                    {
                                      $data['description_profiles'] = "There are more profiles located near you. Take a look at them.";  
                                    }

                                    $data['location_total_record']   = "no_more";

                                }
                                else
                                {
                                    $this->session->set_flashdata('error', 'Selected city details not found.');
                                    redirect(APP_URL."service/".$slug);
                                }
                            }
                            else
                            {
                               $totalRec = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where FIND_IN_SET(".$response['service_id'].",service_id) and purchase_plan=1 and is_delete=0 and id IN (select user_id from location where country_id='".$country_res['country_id']."' AND state_id='".$state_res['state_id']."')");

                                $data['total_record'] = $totalRec[0]->total_user;

                                $total = $data['total_record'] - 28;
                                $data['total'] = $total;
   


                                if($data['total_record'] == 0)
                                {
                                    $data['description_profiles'] = "";
                                }
                                else
                                {
                                  $data['description_profiles'] = "There are more profiles located near you. Take a look at them.";  
                                }

                                if($data['total_record'] == 0)
                                {
                                    $data['total_record2'] = "";
                                }
                                else
                                {
                                    $data['total_record2'] = "There are ".$data['total_record']." profiles in ".$state_res['name']." that match your search.";
                                }

                                $join2['select'] = 'count(tc.id) as countdata';
                                $join2['table'] = 'tbl_customer tc';

                                $join2['joins'][] = array(
                                   'join_table' => 'location l', 
                                   'join_by' => 'tc.id = l.user_id ', 
                                   'join_type' => 'inner');

                                $wh2 = array("tc.is_delete"=>0,"tc.status"=>"Y","tc.purchase_plan"=>1,"tc.is_verified"=>1,"l.country_id"=>$country_res['country_id']);

                                $params2['find_in_set_field']       = "tc.service_id";
                                $params2['find_in_set_value']       = $response['service_id'];

                                $totalRec2 = $this->crud->get_join($join2,$wh2,$params2)[0]['countdata'];

                               

                                $join1['select'] = 'count(c.id) as countdata';
                                $join1['table'] = 'city c';

                                $join1['joins'][] = array(
                               'join_table' => 'location l', 
                               'join_by' => 'c.id = l.city_id ', 
                               'join_type' => 'inner');

                                $join1['joins'][] = array(
                               'join_table' => 'tbl_customer tc', 
                               'join_by' => 'tc.id = l.user_id ', 
                               'join_type' => 'inner');

                                $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.purchase_plan"=>1,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0,"l.state_id"=>$state_res['state_id'],"l.country_id"=>$country_res['country_id']);

                                $params1['find_in_set_field']       = "tc.service_id";
                                $params1['find_in_set_value']       = $response['service_id'];
                                $params1['GroupBy']                 = "l.state_id";
                                
                                $data['btnname']                       =  $state_res['name'];
                                

                                $location_total_record           = $this->crud->get_join($join1,$wh1,$params1);
                                // echo $this->db->last _query();
                                $data['location_total_record']   = count($location_total_record);
                            }
                        }
                        else
                        {

                            $this->session->set_flashdata('error', 'Selected state details not found.');
                            redirect(APP_URL."service/".$slug);
                        }
                    }
                    else
                    {

                       $totalRec3 = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where FIND_IN_SET(".$response['service_id'].",service_id) and purchase_plan=1 and is_delete=0 and id IN (select user_id from location where country_id='".$country_res['country_id']."')");

                        $data['total_record'] = $totalRec3[0]->total_user;

                        $total = $data['total_record'] - 28;
                        $data['total'] = $total;

                        $data['total_record2'] = "There are ".$totalRec3[0]->total_user." profiles in ".$country_res['name']." that match your search.";

                        if($data['total_record'] == 0)
                        {
                            $data['description_profiles'] = "";
                        }
                        else
                        {
                          $data['description_profiles'] = "There are more profiles located near you. Take a look at them.";  
                        }

                        $join1['select'] = 'count(c.state_id) as countdata';
                        $join1['table'] = 'state c';

                        $join1['joins'][] = array(
                       'join_table' => 'location l', 
                       'join_by' => 'c.state_id = l.state_id ', 
                       'join_type' => 'inner');

                        $join1['joins'][] = array(
                       'join_table' => 'tbl_customer tc', 
                       'join_by' => 'tc.id = l.user_id ', 
                       'join_type' => 'inner');

                        $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.purchase_plan"=>1,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0,"l.country_id"=>$country_res['country_id']);

                        $params1['find_in_set_field']       = "tc.service_id";
                        $params1['find_in_set_value']       = $response['service_id'];
                        $params1['GroupBy']                 = "l.state_id";

                        $data['btnname']                    =  $country_res['name'];

                        $location_total_record           = $this->crud->get_join($join1,$wh1,$params1);
                        //echo $this->db->last_query();
                        $data['location_total_record']   = count($location_total_record);
                    }
                }
                else
                {
                    $this->session->set_flashdata('error', 'Selected county details not found.');
                    redirect(APP_URL."service/".$slug);
                }
            }
            else
            {
                $join['select'] = 'count(c.id) as countdata';
                $join['table'] = 'tbl_customer c';

                $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1);

                $params['find_in_set_field']       = "c.service_id";
                $params['find_in_set_value']       = $response['service_id'];

                $totalRec = $this->crud->get_join($join,$wh,$params)[0]['countdata'];
                // echo $this->db->last_query(); die();
                $data['total_record'] = $totalRec;

                $total = $totalRec - 28;
                $data['total'] = $total;
               
                // echo $this->db->last_query(); die();
                if($data['total_record'] == 0)
                {
                    $data['description_profiles'] = "";
                }
                else
                {
                  $data['description_profiles'] = "There are more profiles located near you. Take a look at them.";  
                }
                

                $data['total_record2'] = "";

                $join1['select'] = 'count(c.country_id) as countdata';
                $join1['table'] = 'country c';

                $join1['joins'][] = array(
               'join_table' => 'location l', 
               'join_by' => 'c.country_id = l.country_id ', 
               'join_type' => 'inner');

                $join1['joins'][] = array(
               'join_table' => 'tbl_customer tc', 
               'join_by' => 'tc.id = l.user_id ', 
               'join_type' => 'inner');

                $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.purchase_plan"=>1,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0);

                $params1['find_in_set_field']       = "tc.service_id";
                $params1['find_in_set_value']       = $response['service_id'];
                $params1['GroupBy']                 = "l.country_id";

                $data['btnname']                       = strtolower($response['name']);
                $location_total_record           = $this->crud->get_join($join1,$wh1,$params1);
                $data['location_total_record']   = count($location_total_record);
            }

            if($country_slug!="")
            {

                $data['country_id']             = $country_res['country_id'];
                $data['curr_location_name']     = $country_res['name'];
                $data['coutry_n']               = $country_res['name'];
                $data['curr_location_desc']     = $country_res['description'];
            }
            else
            {
                $data['country_id']       = "";
            }

            if($state_slug!="")
            {
                $data['state_id']               = $state_res['state_id'];
                $data['curr_location_name']     = $state_res['name'];
                $data['state_n']               = $state_res['name'];
                $data['curr_location_desc']     = $state_res['description'];
            }
            else
            {
                $data['state_id']       = "";
            }

            if($city_slug!="")
            {
                $data['city_id']                = $city_res['id'];
                $data['curr_location_name']     = $city_res['name'];
                $data['city_n']               = $city_res['name'];
                $data['curr_location_desc']     = $city_res['description'];

            }
            else
            {
                $data['city_id']       = "";
            }
            
         
            $data['service_id']             = $response['service_id'];
            $data['slug']                   = $response['slug'];
            // $data['title']               = $response['service_meta_title'];
            $data['description']            = $response['service_meta_description'];
            $data['pageTitle']              = ucfirst($response['service_meta_title']);
            $data['pageTitle1']             = strtolower($response['name']);

            // echo $this->db->last_query(); die();
            $this->load->view(FRONTEND."service/service_lists",$data);
        }
        else
        {
            $this->session->set_flashdata('error', 'Something went wrong.');
            redirect(APP_URL);
        }
    }

    public function serviceListajaxPaginationData()
    {
        //$UserId = $this->session->userdata('front_UserId');

        $params = array();
        $service_id = $this->input->post('service_id');
        $country_id = $this->input->post('country_id');
        $city_id    = $this->input->post('city_id');
        $state_id   = $this->input->post('state_id');
        $page       = $this->input->post('page');
        
        if($country_id!="" && $country_id!=0)
        {  
            if($state_id!="" && $state_id!=0)
            {
                if($city_id!="" && $city_id!=0)
                {
                    $join['select'] = 'c.*';
                    $join['table'] = 'tbl_customer c';

                        if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
                        {
                            $keywords = $_REQUEST['keywords'];
                        
                            $whrs = array('name'=>$keywords);
                            $citys_id = $this->crud->get_one_value("city",$whrs,"id");
                            $states_id = $this->crud->get_one_value("state",$whrs,"state_id");
                            $coutrys_id = $this->crud->get_one_value("country",$whrs,"country_id");
                            
                            if(isset($keywords) && $keywords!="")
                            {
                                if($citys_id)
                                {
                                    $join['joins'][] = array(
                                        'join_table' => 'location l', 
                                        'join_by' => 'l.user_id = c.id ', 
                                        'join_type' => 'inner');
            
                                    $join['joins'][] = array(
                                        'join_table' => 'city ca', 
                                        'join_by' => 'ca.id = c.city_id ', 
                                        'join_type' => 'inner');
            
                                    $params['find_in_set_field']       = "l.city_id";
                                    $params['find_in_set_value']       = $citys_id;
                                }
                                else
                                {
                                    if($coutrys_id != '' || $states_id != '')
                                    {
                                        
                                        
                                        $join['joins'][] = array(
                                            'join_table' => 'country co', 
                                            'join_by' => 'co.country_id = c.country_id ', 
                                            'join_type' => 'inner');
                                
                                        $join['joins'][] = array(
                                            'join_table' => 'state sa', 
                                            'join_by' => 'sa.state_id = c.state_id ', 
                                            'join_type' => 'inner');
                                
            
                                        $params['like'] = array("co.name" => $keywords,"co.country_code" => $keywords,"sa.name" => $keywords);
                                    }
                                    else
                                    {
                                        $params['like'] = array("c.fname" => $keywords,"c.slug"=>$keywords,"c.lname" => $keywords,"c.alias_name" => $keywords);
                                    }
                                }
                                
                            }
                        }
                        else
                        {
                            $join['joins'][] = array(
                                'join_table' => 'location l', 
                                'join_by' => 'c.id = l.user_id ', 
                                'join_type' => 'inner');
    
                            $join['joins'][] = array(
                                'join_table' => 'state s', 
                                'join_by' => 's.state_id = l.state_id ', 
                                'join_type' => 'inner');
        
                            $join['joins'][] = array(
                                'join_table' => 'city cy', 
                                'join_by' => 'cy.id = l.city_id', 
                                'join_type' => 'inner');
                        }

                    $onpage_record = 28;
                    $offset = $onpage_record * $page;
                    $limit = $onpage_record;

                    $params['start']      = $offset;
                    $params['Limit']      = $limit;

                    if($citys_id=='' && $coutrys_id =='' && $states_id  =='')
                    {
                        $params['find_in_set_field']       = "l.city_id";
                        $params['find_in_set_value']       = $city_id;

                        $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1,"l.country_id"=>$country_id,"l.state_id"=>$state_id);

                        $params['GroupBy']    = "l.user_id";
                        $params['ShortBy']    = "c.id desc";
                    }
                    else
                    {
                        $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1);
                    }
                    
                    $params['ShortOrder'] = "";
                    $data['service_ids'] = $service_id;

                    $data['posts']        = $this->crud->get_join($join,$wh,$params);
                    // echo $this->db->last_query();die();

                }
                else
                {
                    $join['select'] = 'c.*';
                    $join['table'] = 'tbl_customer c';

                    if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
                    {
                        $keywords = $_REQUEST['keywords'];
                    
                        $whrs = array('name'=>$keywords);
                        $citys_id = $this->crud->get_one_value("city",$whrs,"id");
                        $states_id = $this->crud->get_one_value("state",$whrs,"state_id");
                        $coutrys_id = $this->crud->get_one_value("country",$whrs,"country_id");
                        
                        if(isset($keywords) && $keywords!="")
                        {
                            if($citys_id)
                            {
                                $join['joins'][] = array(
                                    'join_table' => 'location l', 
                                    'join_by' => 'l.user_id = c.id ', 
                                    'join_type' => 'inner');
        
                                $join['joins'][] = array(
                                    'join_table' => 'city ca', 
                                    'join_by' => 'ca.id = c.city_id ', 
                                    'join_type' => 'inner');
        
                                $params['find_in_set_field']       = "l.city_id";
                                $params['find_in_set_value']       = $citys_id;
                            }
                            else
                            {
                                if($coutrys_id != '' || $states_id != '')
                                {
                                    
                                    
                                    $join['joins'][] = array(
                                        'join_table' => 'country co', 
                                        'join_by' => 'co.country_id = c.country_id ', 
                                        'join_type' => 'inner');
                            
                                    $join['joins'][] = array(
                                        'join_table' => 'state sa', 
                                        'join_by' => 'sa.state_id = c.state_id ', 
                                        'join_type' => 'inner');
                            
        
                                    $params['like'] = array("co.name" => $keywords,"co.country_code" => $keywords,"sa.name" => $keywords);
                                }
                                else
                                {
                                    $params['like'] = array("c.fname" => $keywords,"c.slug"=>$keywords,"c.lname" => $keywords,"c.alias_name" => $keywords);
                                }
                            }
                            
                        }
        
                    }
                    else
                    {
                        $join['joins'][] = array(
                            'join_table' => 'location l', 
                            'join_by' => 'c.id = l.user_id ', 
                            'join_type' => 'inner');
 
                        $join['joins'][] = array(
                                'join_table' => 'state s', 
                                'join_by' => 's.state_id = l.state_id ', 
                                'join_type' => 'inner');
    
                        $join['joins'][] = array(
                                'join_table' => 'country co', 
                                'join_by' => 'co.country_id = l.country_id ', 
                                'join_type' => 'inner');
                    }

                    $onpage_record = 28;
                    $offset = $onpage_record * $page;
                    $limit = $onpage_record;

                    $params['start']      = $offset;
                    $params['Limit']      = $limit;
                    
                    if($citys_id=='' && $coutrys_id =='' && $states_id  =='')
                    {
                        $params['find_in_set_field']       = "c.service_id";
                        $params['find_in_set_value']       = $service_id;
                        
                        $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1,"l.country_id"=>$country_id,"l.state_id"=>$state_id);

                        $params['GroupBy']    = "l.user_id";
                        $params['ShortBy']    = "c.id desc";
                    }
                    else
                    {
                        $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1);
                    }

                    
                    $params['ShortOrder'] = "";
                    $data['service_ids'] = $service_id;

                    $data['posts']        = $this->crud->get_join($join,$wh,$params);
                    // echo $this->db->last_query();die();
                    /*echo '<pre>';
                    print_r($data['posts']);
                    exit();*/
                }
            }
            else
            {
                $join['select'] = 'c.*';
                $join['table'] = 'tbl_customer c';

                $join['joins'][] = array(
                       'join_table' => 'location l', 
                       'join_by' => 'c.id = l.user_id ', 
                       'join_type' => 'inner');

                $join['joins'][] = array(
                       'join_table' => 'country co', 
                       'join_by' => 'co.country_id = c.country_id ', 
                       'join_type' => 'inner');

                if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
                {
                    $keywords = $_REQUEST['keywords'];
                
                    $whrs = array('name'=>$keywords);
                    $citys_id = $this->crud->get_one_value("city",$whrs,"id");
                    
                    if(isset($keywords) && $keywords!="")
                    {
                        $join['joins'][] = array(
                            'join_table' => 'service s', 
                            'join_by' => 's.service_id = c.service_id ', 
                            'join_type' => 'inner');
                
                        $join['joins'][] = array(
                            'join_table' => 'state sa', 
                            'join_by' => 'sa.state_id = c.state_id ', 
                            'join_type' => 'inner');
                
                        $join['joins'][] = array(
                            'join_table' => 'city ca', 
                            'join_by' => 'ca.id = c.city_id ', 
                            'join_type' => 'inner');
    
                
                        if($citys_id)
                        {
                            $params['find_in_set_field']       = "l.city_id";
                            $params['find_in_set_value']       = $citys_id;
                        }
                        else
                        {
                            $params['like'] = array("c.fname" => $keywords,"c.slug"=>$keywords,"c.lname" => $keywords,"c.email" => $keywords,"c.alias_name" => $keywords,"s.name" => $keywords,"co.name" => $keywords,"co.country_code" => $keywords,"sa.name" => $keywords,"ca.name" => $keywords);
                        }
                        
                    }
    
                }

                $onpage_record = 28;
                $offset = $onpage_record * $page;
                $limit = $onpage_record;

                $params['start']      = $offset;
                $params['Limit']      = $limit;
                if($citys_id=='')
                {
                    $params['find_in_set_field']       = "c.service_id";
                    $params['find_in_set_value']       = $service_id;
                }
                
                $params['GroupBy']                 = "l.user_id";
                $params['ShortBy']    = "c.id desc";
                $params['ShortOrder'] = "";
                 $data['service_ids'] = $service_id;

                $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1,"l.country_id"=>$country_id);
                $data['posts']        = $this->crud->get_join($join,$wh,$params);
                // echo $this->db->last_query();die();
            }
        }
        else
        {
            $join['select'] = 'c.*';
            $join['table'] = 'tbl_customer c';

            $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1,'c.agency_status'=>'N','agency_user'=>0,'accommodation_user'=>1);

            if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
            {
                $keywords = $_REQUEST['keywords'];
            
                $whrs = array('name'=>$keywords);
                $citys_id = $this->crud->get_one_value("city",$whrs,"id");
                $states_id = $this->crud->get_one_value("state",$whrs,"state_id");
                $coutrys_id = $this->crud->get_one_value("country",$whrs,"country_id");
                
                if(isset($keywords) && $keywords!="")
                {
            
                    if($citys_id)
                    {
                        $join['joins'][] = array(
                            'join_table' => 'location l', 
                            'join_by' => 'l.user_id = c.id ', 
                            'join_type' => 'inner');

                        $join['joins'][] = array(
                            'join_table' => 'city ca', 
                            'join_by' => 'ca.id = c.city_id ', 
                            'join_type' => 'inner');

                        $params['find_in_set_field']       = "l.city_id";
                        $params['find_in_set_value']       = $citys_id;
                    }
                    else
                    {
                        if($coutrys_id != '' || $states_id != '')
                        {
                            
                            
                            $join['joins'][] = array(
                                'join_table' => 'country co', 
                                'join_by' => 'co.country_id = c.country_id ', 
                                'join_type' => 'inner');
                    
                            $join['joins'][] = array(
                                'join_table' => 'state sa', 
                                'join_by' => 'sa.state_id = c.state_id ', 
                                'join_type' => 'inner');
                    

                            $params['like'] = array("co.name" => $keywords,"co.country_code" => $keywords,"sa.name" => $keywords);
                        }
                        else
                        {
                            $params['like'] = array("c.fname" => $keywords,"c.slug"=>$keywords,"c.lname" => $keywords,"c.alias_name" => $keywords);
                        }
                    }
                    
                }

            }

            $onpage_record = 28;
            $offset = $onpage_record * $page;
            $limit = $onpage_record;

            $params['start']      = $offset;
            $params['Limit']      = $limit;

            
            if($citys_id=='' && $coutrys_id =='' && $states_id  =='')
            {
                $params['find_in_set_field']       = "c.service_id";
                $params['find_in_set_value']       = $service_id;
            }
            
            $params['ShortBy']    = "c.id desc";
            $params['ShortOrder'] = "";
            $data['service_ids'] = $service_id;
            $data['posts']        = $this->crud->get_join($join,$wh,$params);
       

        }
        // echo $this->db->last_query();die();

        $this->load->view(FRONTEND."service/service_lists_ajax_data",$data);
    }

    public function serviceListajaxPaginationData1()
    {
        //$UserId = $this->session->userdata('front_UserId');

        $params = array();
        $service_id = $this->input->post('service_id');
        $country_id = $this->input->post('country_id');
        $city_id    = $this->input->post('city_id');
        $state_id   = $this->input->post('state_id');
        $page       = $this->input->post('page');
        
        if($country_id!="" && $country_id!=0)
        {  
            if($state_id!="" && $state_id!=0)
            {
                if($city_id!="" && $city_id!=0)
                {
                    $join['select'] = 'c.*';
                    $join['table'] = 'tbl_customer c';

                    $wh = array("c.is_delete"=>0,"c.user_role"=>1,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1);

                    if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
                    {
                        $keywords = $_REQUEST['keywords'];

                        $params['like'] = array("c.fname" => $keywords,"c.lname" => $keywords,"c.email" => $keywords,"c.alias_name" => $keywords);
                    }

                    if(isset($_REQUEST['keyword_location'])  && ($_REQUEST['keyword_location']!=""))
                    {
                        $keyword_location = $_REQUEST['keyword_location'];

                        $join['joins'][] = array(
                           'join_table' => 'country co', 
                           'join_by' => 'co.country_id = c.country_id ', 
                           'join_type' => 'inner');

                        $params['like'] = array("co.name" => $keyword_location);
                    }

                    $params['ShortBy']    = "c.id desc";
                    $params['ShortOrder'] = "";
                    $data['posts1']        = $this->crud->get_join($join,$wh,$params);
                    $this->load->view(FRONTEND."service/service_lists_ajax_data1",$data);
                    // echo $this->db->last_query();die();
              
                    
                }
                else
                {
                    

                $join['select'] = 'c.*';
                $join['table'] = 'tbl_customer c';

                $join['joins'][] = array(
                       'join_table' => 'location l', 
                       'join_by' => 'c.id = l.user_id ', 
                       'join_type' => 'inner');

                $join['joins'][] = array(
                       'join_table' => 'country co', 
                       'join_by' => 'co.country_id = c.country_id ', 
                       'join_type' => 'inner');

                if(isset($_REQUEST['keyword_location'])  && ($_REQUEST['keyword_location']!=""))
                {
                    $keyword_location = $_REQUEST['keyword_location'];

                    $params['like'] = array("co.name" => $keyword_location);
                    
                }

                if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
                {
                    $keywords = $_REQUEST['keywords'];

                    $params['like'] = array("c.fname" => $keywords,"c.lname" => $keywords,"c.email" => $keywords,"c.alias_name" => $keywords);

                }

               
                $params['GroupBy']                 = "l.user_id";
                $params['ShortBy']    = "c.id desc";
                $params['ShortOrder'] = "";

               

                $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.user_role"=>1,"c.purchase_plan"=>1,"c.is_verified"=>1,"l.country_id"=>$country_id);
                $data['posts1']        = $this->crud->get_join($join,$wh,$params);
                // echo $this->db->last_query();die();
                $this->load->view(FRONTEND."service/service_lists_ajax_data1",$data);
                }
            }
            else
            {
                $join['select'] = 'c.*';
                $join['table'] = 'tbl_customer c';

                $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.user_role"=>1,"c.is_verified"=>1);

                if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
                {
                    $keywords = $_REQUEST['keywords'];

                    $params['like'] = array("c.fname" => $keywords,"c.lname" => $keywords,"c.email" => $keywords,"c.alias_name" => $keywords);
                }

                if(isset($_REQUEST['keyword_location'])  && ($_REQUEST['keyword_location']!=""))
                {
                    $keyword_location = $_REQUEST['keyword_location'];

                    $join['joins'][] = array(
                       'join_table' => 'country co', 
                       'join_by' => 'co.country_id = c.country_id ', 
                       'join_type' => 'inner');

                    $params['like'] = array("co.name" => $keyword_location);
                }

                $params['ShortBy']    = "c.id asc";
                $params['ShortOrder'] = "";
                $data['posts1']        = $this->crud->get_join($join,$wh,$params);
                $this->load->view(FRONTEND."service/service_lists_ajax_data1",$data);
            }
        }
        else
        {
            $join['select'] = 'c.*';
            $join['table'] = 'tbl_customer c';

            $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.user_role"=>1,"c.is_verified"=>1);

            if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
            {
                $keywords = $_REQUEST['keywords'];

                $params['like'] = array("c.fname" => $keywords,"c.lname" => $keywords,"c.email" => $keywords,"c.alias_name" => $keywords);
            }

            if(isset($_REQUEST['keyword_location'])  && ($_REQUEST['keyword_location']!=""))
            {
                $keyword_location = $_REQUEST['keyword_location'];

                $join['joins'][] = array(
                   'join_table' => 'country co', 
                   'join_by' => 'co.country_id = c.country_id ', 
                   'join_type' => 'inner');

                $params['like'] = array("co.name" => $keyword_location);
            }

            $params['ShortBy']    = "c.id desc";
            $params['ShortOrder'] = "";
            $data['posts1']        = $this->crud->get_join($join,$wh,$params);
            $this->load->view(FRONTEND."service/service_lists_ajax_data1",$data);
        }

        // echo $this->db->last_query(); die();
        
    }

    public function home_search()
    {
        $join['select'] = 'c.*';
        $join['table'] = 'tbl_customer c';

        $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1);

        if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
        {
            $keywords = $_REQUEST['keywords'];

            $params['like'] = array("c.fname" => $keywords,"c.lname" => $keywords,"c.email" => $keywords,"c.alias_name" => $keywords);
        }

        if(isset($_REQUEST['keyword_location'])  && ($_REQUEST['keyword_location']!=""))
        {
            $keyword_location = $_REQUEST['keyword_location'];

            $join['joins'][] = array(
               'join_table' => 'country co', 
               'join_by' => 'co.country_id = c.country_id ', 
               'join_type' => 'inner');

            $params['like'] = array("co.name" => $keyword_location);
        }

        $data['posts']        = $this->crud->get_join($join,$wh,$params);
        // echo $this->db->last_query(); die();

        $this->load->view(FRONTEND."ajax_home_service",$data);

    }

    public function serviceDetails($names)
    {

        // $post = $this->input->post();
        // $id =$this->input->post('ids');
        // echo $id; exit();
        if($names != ""){
            $id = $this->crud->get_column_value_by_id("tbl_customer","id","slug = '".$names."'");
            $is_valid_request = $this->crud->check_duplicate("tbl_customer",array("id"=>$id,"is_delete"=>"0","status"=>'Y',"is_verified"=>1));
                
            if($is_valid_request)
            {
                $data   = array();
                $params = array();
                
                $data['user_d'] = $this->crud->get_one_row("tbl_customer",array("id"=>$id,"is_delete"=>"0","status"=>'Y',"is_verified"=>1));
                $data['pageTitle'] = strtolower($data['user_d']['fname']." ".$data['user_d']['lname']); 

                $gallerylists = $this->crud->get_all_with_where('gallery','id','desc',array('status'=>'Y','isDelete'=>0,'user_id'=>$id));
                $data["gallerylists"]       = $gallerylists;
                $data['status_pic'] = $this->crud->get_one_row("gallery",array("isDelete"=>"0","status"=>'Y'));
                
                $call_rateslists = $this->crud->get_all_with_where('call_rates','id','desc',array('isDelete'=>0,'user_id'=>$id));
                $data["call_rateslists"]       = $call_rateslists;

                $location = $this->crud->get_all_with_where('location','id','ASC',array('user_id'=>$id,'isDelete'=>0));
                $data["location"]   = $location;

                $site_settings = $this->crud->get_one_row("site_settings");
                $data["site_settings"]   = $site_settings;

                $diary = $this->crud->get_all_with_where('my_diary','id','ASC',array('user_id'=>$id,'isDelete'=>0));
                $data['diary']              = $diary;

                $review = $this->crud->get_all_with_where('review','id','ASC',array('user_id'=>$id,'isDelete'=>0));
                $data['review']              = $review;

                $this->load->view(FRONTEND."service/service_lists_details",$data);
            }
            else
            {
                $this->session->set_flashdata('error', 'Something went wrong.');
                redirect('gallery/male');
            }
        }else{
            $this->session->set_flashdata('error', 'Something went wrong.');
            redirect('gallery/male');
        }
        
    }

    public function locationListajaxPaginationData()
    {
        //$UserId = $this->session->userdata('front_UserId');
        $params1 = array();
        $service_id = $this->input->post('service_id');
        $country_id = $this->input->post('country_id');
        $state_id   = $this->input->post('state_id');
        $city_id    = $this->input->post('city_id');
        $page       = $this->input->post('page');
        // echo $city_id; exit();
        if($city_id!="" && $city_id!=0)
        {

        }
        else if($state_id!="" && $state_id!=0)
        {


           //  $join1['select']    = 'c1.id,c1.name,c1.slug';
           //  $join1['table']     = 'city c1';

           //  $join1['joins'][] = array(
           //  'join_table'     => 'state c', 
           //  'join_by'        => 'c.state_id = c1.state_id ', 
           //  'join_type'      => 'inner');

           //  $join1['joins'][] = array(
           // 'join_table'     => 'location l', 
           // 'join_by'        => 'l.city_id = c1.id ',
           // 'join_type'      => 'inner');

           //  $join1['joins'][] = array(
           // 'join_table'     => 'tbl_customer tc', 
           // 'join_by'        => 'tc.id = l.user_id ', 
           // 'join_type'      => 'inner');

           //  $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.is_verified"=>1,"tc.purchase_plan"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0,"l.country_id"=>$country_id,"l.state_id"=>$state_id);

           //  $onpage_record                      = 8;
           //  $offset                             = $onpage_record * $page;
           //  $limit                              = $onpage_record;

           //  $params1['start']                   = $offset;
           //  $params1['Limit']                   = $limit;
           //  $params1['find_in_set_field']       = "tc.service_id";
           //  $params1['find_in_set_value']       = $service_id;
           //  //$params1['GroupBy']                 = "l.state_id";
           //  $params1['ShortBy']                 = "c.state_id ASC";
           //  $params1['ShortOrder']              = "";
           //  $data['posts']                      = $this->crud->get_join($join1,$wh1,$params1);

           //  echo "<pre>";
           //  print_r($data['posts']); exit;

            $join1['select']    = 'l.city_id';
            $join1['table']     = 'state c';

            $join1['joins'][] = array(
           'join_table'     => 'location l', 
           'join_by'        => 'c.state_id = l.state_id ', 
           'join_type'      => 'inner');

            $join1['joins'][] = array(
           'join_table'     => 'tbl_customer tc', 
           'join_by'        => 'tc.id = l.user_id ', 
           'join_type'      => 'inner');

            $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.purchase_plan"=>1,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0,"l.country_id"=>$country_id,"l.state_id"=>$state_id);

            $onpage_record                      = 8;
            $offset                             = $onpage_record * $page;
            $limit                              = $onpage_record;

            $params1['start']                   = $offset;
            $params1['Limit']                   = $limit;
            $params1['find_in_set_field']       = "tc.service_id";
            $params1['find_in_set_value']       = $service_id;
            //$params1['GroupBy']                 = "l.state_id";
            $params1['ShortBy']                 = "c.state_id ASC";
            $params1['ShortOrder']              = "";
            $c_ids                              = $this->crud->get_join($join1,$wh1,$params1);

            $temp = array();
            foreach ($c_ids as $c_id) {

                $city_datas = $this->crud->getFromSQL('SELECT *FROM `city` where id in ('.$c_id['city_id'].')');  

                foreach ($city_datas as $c) {

                    if (!array_key_exists($c->id,$temp))
                    {
                        $temp[$c->id]['id'] = $c->id;
                        $temp[$c->id]['name'] = $c->name;
                        $temp[$c->id]['slug'] = $c->slug;
                    }
                    
                }
                
            }
            $data['posts'] = $temp;
            // echo "<pre>";
            // print_r($temp); exit;
            //echo $this->db->last_query(); exit;

        }
        else if($country_id!="" && $country_id!=0)
        {
            $join1['select']    = 'c.state_id,c.name,c.slug';
            $join1['table']     = 'state c';

            $join1['joins'][] = array(
           'join_table'     => 'location l', 
           'join_by'        => 'c.state_id = l.state_id ', 
           'join_type'      => 'inner');

            $join1['joins'][] = array(
           'join_table'     => 'tbl_customer tc', 
           'join_by'        => 'tc.id = l.user_id ', 
           'join_type'      => 'inner');

            $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.purchase_plan"=>1,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0,"l.country_id"=>$country_id);

            $onpage_record                      = 8;
            $offset                             = $onpage_record * $page;
            $limit                              = $onpage_record;

            $params1['start']                   = $offset;
            $params1['Limit']                   = $limit;
            $params1['find_in_set_field']       = "tc.service_id";
            $params1['find_in_set_value']       = $service_id;
            $params1['GroupBy']                 = "l.state_id";
            $params1['ShortBy']                 = "c.state_id ASC";
            $params1['ShortOrder']              = "";
            $data['posts']                      = $this->crud->get_join($join1,$wh1,$params1);
           // echo $this->db->last_query();

        }
        else
        {
            $join1['select'] = 'c.country_id,c.name,c.slug';
            $join1['table'] = 'country c';

            $join1['joins'][] = array(
           'join_table' => 'location l', 
           'join_by' => 'c.country_id = l.country_id ', 
           'join_type' => 'inner');

            $join1['joins'][] = array(
           'join_table' => 'tbl_customer tc', 
           'join_by' => 'tc.id = l.user_id ', 
           'join_type' => 'inner');

            $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.purchase_plan"=>1,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0);

            $onpage_record                      = 8;
            $offset                             = $onpage_record * $page;
            $limit                              = $onpage_record;

            $params1['start']                   = $offset;
            $params1['Limit']                   = $limit;
            $params1['find_in_set_field']       = "tc.service_id";
            $params1['find_in_set_value']       = $service_id;
            $params1['GroupBy']                 = "l.country_id";
            $params1['ShortBy']                 = "c.country_id ASC";
            $params1['ShortOrder']              = "";
            $data['posts']                      = $this->crud->get_join($join1,$wh1,$params1);

            
        }

        
        $data['service_id']      = $service_id;
        $data['country_id']      = $country_id;
        $data['state_id']      = $state_id;

        $this->load->view(FRONTEND."service/location_lists_ajax_data",$data);
    }


    public function serviceLocation($country_slug="",$state_slug="",$city_slug="")
    {
        
        $data   = array();
        $params = array();
        $params1 = array();
        $state_res = $this->crud->get_row_by_id("state",array('slug'=>$state_slug,'status'=>'Y','isDelete'=>0));
        $country_res = $this->crud->get_row_by_id("country",array('slug'=>$country_slug,'status'=>'Y','isDelete'=>0));

       if($city_slug!='')
        {
            $city_res = $this->crud->get_row_by_id("city",array('slug'=>$city_slug,'status'=>'Y','isDelete'=>0));
            if($city_res)
            {

                $join['select'] = 'count(tc.id) as countdata';
                $join['table'] = 'tbl_customer tc';

                $join['joins'][] = array(
                   'join_table' => 'location l', 
                   'join_by' => 'tc.id = l.user_id ', 
                   'join_type' => 'inner');

                $wh = array("tc.is_delete"=>0,"tc.status"=>"Y","tc.purchase_plan"=>1,"tc.is_verified"=>1,"l.state_id"=>$state_res['state_id'],"l.country_id"=>$country_res['country_id']);


                $data['location_total_record']  =  "no_more";

                $data['total_record2'] = "There are  profiles in ".$city_res['name']." that match your search.";

                // print_r($params); exit();

                $totalRec = $this->crud->get_join($join,$wh,$params)[0]['countdata'];
                // echo $this->db->last_query(); die();
                $data['total_record'] = $totalRec;
                 $data['total_record2'] = "There are profiles in ".$city_res['name']." that match your search.";
                $total = $totalRec - 10;
                $data['total'] = $total;
                $data['btnname']                       =  $city_res['name'];
                $data['description_profiles'] = "There are more profiles located near you. Take a look at them.";

            }
            else
            {
                $this->session->set_flashdata('error', 'Selected city details not found.');
                redirect(APP_URL."service/".$slug);
            }
        }

        if($country_slug!="")
        {

            $data['country_id']             = $country_res['country_id'];
            $data['curr_location_name']     = $country_res['name'];
            $data['coutry_n']               = $country_res['name'];
            $data['curr_location_desc']     = $country_res['description'];
        }
        else
        {
            $data['country_id']       = "";
        }

        if($state_slug!="")
        {
            $data['state_id']               = $state_res['state_id'];
            $data['curr_location_name']     = $state_res['name'];
            $data['state_n']               = $state_res['name'];
            $data['curr_location_desc']     = $state_res['description'];
        }
        else
        {
            $data['state_id']       = "";
        }

        if($city_slug!="")
        {
            $data['city_id']                = $city_res['id'];
            $data['curr_location_name']     = $city_res['name'];
            $data['city_n']               = $city_res['name'];
            $data['curr_location_desc']     = $city_res['description'];

        }
        else
        {
            $data['city_id']       = "";
        }
        
     
        $data['pageTitle']              = "Location List";
        $this->load->view(FRONTEND."service/service_details_location_list",$data);
    }


    public function serviceListajaxLocationData()
    {
        $params = array();
        $country_id = $this->input->post('country_id');
        $state_id   = $this->input->post('state_id');
        $city_id    = $this->input->post('city_id');
        $page       = $this->input->post('page');

       
        if($city_id!="" && $city_id!=0)
        {
            $join['select'] = 'c.*';
            $join['table'] = 'tbl_customer c';

            $join['joins'][] = array(
                   'join_table' => 'location l', 
                   'join_by' => 'c.id = l.user_id ', 
                   'join_type' => 'inner');

            $join['joins'][] = array(
                   'join_table' => 'state s', 
                   'join_by' => 's.state_id = l.state_id ', 
                   'join_type' => 'inner');

            $join['joins'][] = array(
                   'join_table' => 'city cy', 
                   'join_by' => 'cy.id = l.city_id', 
                   'join_type' => 'inner');


            if(isset($_REQUEST['keyword_location'])  && ($_REQUEST['keyword_location']!=""))
            {
                $keyword_location = $_REQUEST['keyword_location'];

                $params['like'] = array("co.name" => $keyword_location,"s.name" => $keyword_location,"cy.name" => $keyword_location);
            }


            if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
            {
                $keywords = $_REQUEST['keywords'];

                $params['like'] = array("c.fname" => $keywords,"c.lname" => $keywords,"c.email" => $keywords,"c.alias_name" => $keywords);
            }

            $onpage_record = 10;
            $offset = $onpage_record * $page;
            $limit = $onpage_record;

            $params['start']      = $offset;
            $params['Limit']      = $limit;
            $params['find_in_set_field']       = "l.city_id";
            $params['find_in_set_value']       = $city_id;
            $params['GroupBy']                 = "l.user_id";
            $params['ShortBy']    = "c.id desc";
            $params['ShortOrder'] = "";

            $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1,"l.country_id"=>$country_id,"l.state_id"=>$state_id);

            $data['posts']        = $this->crud->get_join($join,$wh,$params);
            // echo $this->db->last_query();die();

        }

        // echo $this->db->last_query(); die();
        $this->load->view(FRONTEND."service/service_lists_ajax_Location",$data);
    }

    public function language_view($l_slug)
    {
        $where = array('slug' =>  $l_slug, 'isDelete'=>0, 'status'=>'Y' );
        $data['language'] = $this->crud->get_one_row("language",$where );

        $data['pageTitle']              = "Language";
        $this->load->view(FRONTEND."language_info",$data);

        
    }

    public function favorite_view($l_slug)
    {
        $where = array('slug' =>  $l_slug, 'isDelete'=>0, 'status'=>'Y' );
        $data['language'] = $this->crud->get_one_row("language",$where );

        $data['pageTitle']              = "Favorite";
        $this->load->view(FRONTEND."favorite_info",$data);

        
    }

    public function getreview(){
        $post = $this->input->post();
        $count = $post['count'];
        $UserId = $post['user_id'];
        $totla_review = $this->crud->get_num_rows_with_where('review',array('user_id'=>$UserId,'isDelete'=>0));

        $review = $this->crud->get_record_with_where_limit('review',array('user_id'=>$UserId,'isDelete'=>0),$count);
        $html = "";
        $aco_i=0; 
        foreach($review as $reviews){ 

            $reviews = (object) $reviews;
        
            $html .= '<div class="accordion-item">
                <div class="row reviews-detail" role="tab" id="heading'.$aco_i.'">
                    <div class="col-md-11 col-sm-11 reviews-detail-items">
                        <div class="row visible-lg text-gray">
                            <div class="col-lg-3 col-md-3 col-sm-6 half-width ">';
                                
                                $fname = $this->crud->get_column_value_by_id("tbl_customer","fname","id = '".$reviews->reviewer_user_id."'");
        
                                $lname = $this->crud->get_column_value_by_id("tbl_customer","lname","id = '".$reviews->reviewer_user_id."'");
                                
                                $html .= '<h6 class="reviews-user-name">
                                <a class="" rel="nofollow" href="javascript:void(0)">'.$fname.' '.$lname.'<em></em></a>
                                </h6>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-6 half-width">
                                <div class="resume-review-location">';
                                
                                $city_name = $this->crud->get_column_value_by_id("city","name","id = '".$reviews->city_id."'");
                        
                                    $html .= '<a href="#" rel="nofollow">'.$city_name.'</a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-6 half-width">
                                <div class="review-time">'.date('F Y', strtotime($reviews->create_at)).'</div>
                            </div>
                            <div class="col-lg-1 icons mob-none">
                            </div>';
                            $total_avg = "SELECT (AVG(`accuracy_of_photos`)+AVG(`location`)+AVG(`physical_appearance`)+AVG(`services_received`)+AVG(`value_for_money`)+AVG(`overall_experience`))/6 AS abc FROM review where `isDelete`='0' AND `user_id` = '".$UserId."'";
        
                            $total_avg = $this->crud->getFromSQL($total_avg);
        
                            $total_avg = ceil($total_avg['0']->abc);
                            
                            $html .= '<div class="col-lg-2 col-md-3 col-sm-6 half-width">
                                <div class="rating" title="Average rating:  5.0 ">';
             
                                    for($i=1; $i <= 5 ; $i++) {
                                      if($i>$total_avg){
                                        $html .= '<i class="far fa-star" aria-hidden="true"></i>';
                                      } else{
                                        $html .= '<i class="rating_count fa fa-star"></i>';
                                      } 
                                  } 
                                  $html .= '</div>
                            </div>
                            <div class="col-lg-1 mob-none">
                            </div>
                        </div>
                    </div>
                    <button data-toggle="collapse" data-parent="#accordion" href="#collapse'.$aco_i.'" aria-expanded="true" aria-controls="collapse'.$aco_i.'">
                        <i class="far fa-angle-right"></i>
                    </button>
                </div>
                <div id="collapse'.$aco_i.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading'.$aco_i.'">
                    <div class="accordion-body">
                        <div class="col-md-12 review-progressbar-main innerbox">';
                        //accuracy of photos avg
                        $accuracy_of_photos = "SELECT avg(accuracy_of_photos) AS accuracy_of_photos FROM review WHERE `isDelete`='0' AND user_id='".$reviews->user_id."'";
                        $accuracy_of_photos = $this->crud->getFromSQL($accuracy_of_photos);
                        $accuracy_of_photos= ceil($accuracy_of_photos['0']->accuracy_of_photos);
        
        
                        //location avg
                        $location = "SELECT avg(location) AS location FROM review WHERE `isDelete`='0' AND user_id='".$reviews->user_id."'";
                        $location = $this->crud->getFromSQL($location);
                        $location= ceil($location['0']->location);
        
        
                        //physical appearance avg
                        $physical_appearance = "SELECT avg(physical_appearance) AS physical_appearance FROM review WHERE `isDelete`='0' AND user_id='".$reviews->user_id."'";
                        $physical_appearance_avarge = $this->crud->getFromSQL($physical_appearance);
                        $physical_appearance_avarge= ceil($physical_appearance_avarge['0']->physical_appearance);
        
        
                        //services receive avg
                        $received_avarge = "SELECT avg(services_received) AS services_received FROM review WHERE user_id='".$reviews->user_id."'";
                        $services_received_avarge = $this->crud->getFromSQL($received_avarge);
                        $services_received_avarge= ceil($services_received_avarge['0']->services_received);
        
                        //value for money avg
                        $value_for_money = "SELECT avg(value_for_money) AS value_for_money FROM review WHERE `isDelete`='0' AND user_id='".$reviews->user_id."'";
                        $value_for_money = $this->crud->getFromSQL($value_for_money);
                        $value_for_money= ceil($value_for_money['0']->value_for_money);
        
        
                        //overall experience avg
                        $overall_experience = "SELECT avg(overall_experience) AS overall_experience FROM review WHERE `isDelete`='0' AND user_id='".$reviews->user_id."'";
                        $overall_experience = $this->crud->getFromSQL($overall_experience);
                        $overall_experience= ceil($overall_experience['0']->overall_experience);
                    
                        $html .= '<div class="row">
                                <div class="col-lg-8 left-sidecontent">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 profiles-star-count">
                                            <div class="profile-count-box">
                                                <h5>Accuracy Of Photos</h5>
                                                <p>';
                                                    for($i=1; $i <= 5 ; $i++) {
                                                      if($i>$accuracy_of_photos){
                                                      
                                                        $html .= '<i class="far fa-star" aria-hidden="true"></i>';
                                                      } else{
                                                        $html .= '<i class="rating_count fa fa-star"></i>';
                                                        } 
                                                  } 
                                                  $html .= '</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 profiles-star-count">
                                            <div class="profile-count-box">
                                                <h5>LOCATION</h5>
                                                <p>';
                                                    
                                                    for($i=1; $i <= 5 ; $i++) {
                                                      if($i>$location){
                                                        $html .= '<i class="far fa-star" aria-hidden="true"></i>';
                                                      } else{       
                                                        $html .= '<i class="rating_count fa fa-star"></i>';
                                                      } 
                                                  }
                                                  $html .= '</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 profiles-star-count">
                                            <div class="profile-count-box">
                                                <h5>PHYSICAL APPEARANCE</h5>
                                                <p>';
                                                    for($i=1; $i <= 5 ; $i++) {
                                                      if($i>$physical_appearance_avarge){
                                                        $html .= '<i class="far fa-star" aria-hidden="true"></i>';
                                                      } else{
                                                        $html .= '<i class="rating_count fa fa-star"></i>';
                                                      } 
                                                  }
                                                  $html .= '</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 profiles-star-count">
                                            <div class="profile-count-box">
                                                <h5>SATISFACTION</h5>
                                                <p>';
                                                    for($i=1; $i <= 5 ; $i++) {
                                                      if($i>$services_received_avarge){
                                                        $html .= '<i class="far fa-star" aria-hidden="true"></i>';
                                                      } else{
                                                        $html .= '<i class="rating_count fa fa-star"></i>';
                                                            } 
                                                  } 
                                                  $html .= '</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 profiles-star-count">
                                            <div class="profile-count-box">
                                                <h5>VALUE FOR MONEY</h5>
                                                <p>';
                                                    for($i=1; $i <= 5 ; $i++) {
                                                      if($i>$value_for_money){
                                                        $html .= '<i class="far fa-star" aria-hidden="true"></i>';
                                                      } else{
                                                        $html .= '<i class="rating_count fa fa-star"></i>';
                                                        } 
                                                  }
                                                  $html .= '</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 profiles-star-count">
                                            <div class="profile-count-box">
                                                <h5>OVERALL EXPERIENCE</h5>
                                                <p>';
                                                    for($i=1; $i <= 5 ; $i++) {
                                                      if($i>$overall_experience){
                                                        $html .= '<i class="far fa-star" aria-hidden="true"></i>';
                                                      } else{   
                                                        $html .= '<i class="rating_count fa fa-star"></i>';
                                                    } 
                                                  }
                                                  $html .= '</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-md-12 countbox-text">
                                            <h5>Outcome:'.$reviews->outcome.'
                                            </h5>
                                            <p>'.$reviews->experience.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row review-infobox">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 half-width">';
                                        $time = $reviews->time/60;                                            $html .= '<span><i class="far fa-calendar"></i>'.$reviews->date .' at '.$time.'</span>
                                        </div>
                                        <div class="col-md-4 col-sm-6 half-width">
                                            <span><i class="far fa-coin"></i>'.$reviews->price.'</span>
                                        </div>
                                        <div class="col-md-4 col-sm-6 half-width">
                                            <span><i class="far fa-clock"></i>'.$reviews->hour.' hour</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        $aco_i++; } 

     $html1 = "";                                             
     if($totla_review > $count){
        $count += 10;
         $html1 = '<a class="button button-lg button-shadow-2 button-primary button-zakaria mt-5 margin-auto-custom" href="javascript:void(0);" onclick="getReview('.$count.')">View More</a>';
     }

     $return = array(
         "html" => $html,
         "load_button" => $html1
     );
     echo json_encode($return);
    }   
    
    
    public function getServicesList()
    {
       
        $keyword = $this->input->post('keyword');
        $service_id = $this->input->post('service_id'); 
        
        if($keyword != "")
        {

            $customer_sql = $this->crud->getFromSQL("SELECT * FROM `tbl_customer` WHERE `is_delete` = 0 AND `status` = 'Y' AND FIND_IN_SET(".$service_id.", service_id) AND alias_name like '%".$keyword."%' ORDER BY `fname` ASC");

            $services = $this->crud->get_all_with_where("service","name","asc",array("status"=>'Y','isDelete'=>0,"name like" => '%'.$keyword.'%'));

            $array = [];
            $name = "";
           if(!empty($customer_sql) || !empty($services))
           {
            ?>
                <ul id="agency-list">
                    
                    <!-- customer -->
                    <?php foreach($customer_sql as $data) { ?>
                        <li onClick="Select('<?= $data->alias_name ?>');"><?= $data->alias_name ?></li>
                    <?php }  ?>

                    <!-- service -->
                    <?php foreach($services as $data) { ?>
                        <li class="search-list-inner-data">
                            <label><b>Services</b></label>
                            <ul>
                                <?php if($data->service_type == 1) {?>
                                    <li><a href="<?=base_url();?>service/<?=$data->slug;?>"><?= $data->name ?></a></li>
                                <?php } else { ?>
                                    <li><a href="https://www.stripperpartybus.ie/service/<?=$data->slug;?>"><?= $data->name ?></a></li> 
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    
                </ul>
            <?php 
            }
           
        }
    } 


    public function getServicesLocation()
    {
        $keyword = $this->input->post('keywordLocation');

        if($keyword != "")
        {

            $city = $this->crud->get_all_with_where("city","name","asc",array("isDelete" => 0,"status"=>'Y',"name like" => '%'.$keyword.'%'));

            $state = $this->crud->get_all_with_where("state","name","asc",array("isDelete" => 0,"status"=>'Y',"name like" => '%'.$keyword.'%'));

            $country = $this->crud->get_all_with_where("country","name","asc",array("isDelete" => 0,"status"=>'Y',"name like" => '%'.$keyword.'%'));
            
            if(!empty($city) || !empty($state) || !empty($country)) {  ?>
                <ul id="agency-list">
                    <!-- City location -->
                    <?php foreach($city as $data) { ?>
                        <li onClick="selectAgencys('<?= $data->name ?>');"><?= $data->name ?></li>
                    <?php  } ?>

                    <!-- State location -->
                    <?php foreach($state as $data) { 
                        if($data->country_id == 250)
                        {
                            $state = "Country";
                        }
                        else
                        {
                            $state = "State";
                        }
                        ?>
                        <li class="search-list-inner-data">
                            
                            <label><b><?= $state ?></b></label>
                            <ul>
                                <li onClick="selectAgencys('<?= $data->name ?>');"><?= $data->name ?></li>
                            </ul>
                        </li>
                    <?php  } ?>

                    <!-- Country location -->
                    <?php foreach($country as $data) { ?>
                        <li class="search-list-inner-data">
                            <label><b>Country</b></label>
                            <ul>
                                <li onClick="selectAgencys('<?= $data->name ?>');"><?= $data->name ?></li>
                            </ul>
                    </li>    
                    <?php  } ?>

                </ul>
            <?php 
            }
        }
    }
}
