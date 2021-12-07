<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontController.php';

class AgencyControler extends FrontController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud', 'crud'); 
        //$this->isUserLogin(); 
        
    }

    // ************************** Main Listing *************
    public function agencylists($country_slug="",$state_slug="",$city_slug="") 
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

                                    $totalRec = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where user_role=4 and agency_status='Y' and agency_user=1 and purchase_plan=1 and is_delete=0 and id IN (select user_id from location where country_id='".$country_res['country_id']."' AND state_id='".$state_res['state_id']."' AND find_in_set(".$city_res['id'].", city_id))");
                                    
                                    $data['total_record'] = $totalRec[0]->total_user;

                                    $data['location_total_record'] = 'no_more';

                                    
                                }
                            }
                            else
                            {
                                //Records counts
                                $totalRec = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where purchase_plan=1 and user_role=4 and agency_status='Y' and agency_user=1 and is_delete=0 and id IN (select user_id from location where country_id='".$country_res['country_id']."' AND state_id='".$state_res['state_id']."')");

                                $data['total_record'] = $totalRec[0]->total_user;

                                // echo $this->db->last_query(); die();   

                                //Location count 
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

                                $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.purchase_plan"=>1,"tc.is_verified"=>1,"tc.user_role"=>4,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0,"l.state_id"=>$state_res['state_id'],"l.country_id"=>$country_res['country_id'],"tc.agency_status"=>'Y',"tc.agency_user"=>1);
                               
                                $params1['GroupBy']                 = "l.state_id";
                                                              
                                $location_total_record           = $this->crud->get_join($join1,$wh1,$params1);
                                // echo $this->db->last_query(); die(); 
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
                    //Records counts
                    $totalRec = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where purchase_plan=1 and user_role = 4 and agency_status='Y' and agency_user=1 and is_verified=1 and is_delete=0 and id IN (select user_id from location where country_id='".$country_res['country_id']."')");

                    // echo $this->db->last_query(); die();

                    $data['total_record'] = $totalRec[0]->total_user;

                   
                    //Location counts
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

                    $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.purchase_plan"=>1,"tc.user_role"=>4,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0,"l.country_id"=>$country_res['country_id'],"tc.agency_status"=>'Y',"tc.agency_user"=>1);

                    $params1['GroupBy']                 = "l.state_id";

                    $data['btnname']                    =  $country_res['name'];

                    $location_total_record           = $this->crud->get_join($join1,$wh1,$params1);
                    // echo $this->db->last_query(); die();
                    $data['location_total_record']   = count($location_total_record);
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Something want wrong');
                redirect(APP_URL."agencies");
            }
        }
        else
        {
            //records count

            $join['select'] = 'count(c.id) as countdata';
            $join['table'] = 'tbl_customer c';

            $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1,"c.user_role"=>4,"c.agency_status"=>'Y',"c.agency_user"=>1);

            $totalRec = $this->crud->get_join($join,$wh,$params)[0]['countdata'];
            // echo $this->db->last_query(); die();
            $data['total_record'] = $totalRec;


            //locations count 
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

            $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.purchase_plan"=>1,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0,'tc.user_role'=>4,'tc.agency_status'=>'Y',"tc.agency_user"=>1);

            $params1['GroupBy']                 = "l.country_id";

            $location_total_record           = $this->crud->get_join($join1,$wh1,$params1);
            $data['location_total_record']   = count($location_total_record);

            // echo $this->db->last_query(); die();
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
            $data['state_n']                = $state_res['name'];
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

        $data['pageTitle']  = 'Advertise with us ';

        $this->load->view(FRONTEND."agency/agency",$data);
         
    }



    public function agencyListajaxPaginationData()
    {
        //$UserId = $this->session->userdata('front_UserId');

        $params = array();
        $service_id = $this->input->post('service_id');
        $country_id = $this->input->post('country_id');
        $city_id    = $this->input->post('city_id');
        $state_id   = $this->input->post('state_id');
        $page       = $this->input->post('page');
        // echo $_REQUEST['keywords']; exit;
        
        if($country_id!="" && $country_id!=0)
        {  
            if($state_id!="" && $state_id!=0)
            {
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

                        // $join['joins'][] = array(
                        //     'join_table' => 'country co', 
                        //     'join_by' => 'co.country_id = c.country_id ', 
                        //     'join_type' => 'inner');
         
                        //  $join['joins'][] = array(
                        //      'join_table' => 'state s', 
                        //      'join_by' => 's.state_id = c.state_id ', 
                        //      'join_type' => 'inner');
                         
                        //  $join['joins'][] = array(
                        //      'join_table' => 'city cy', 
                        //      'join_by' => 'cy.id = c.city_id ', 
                        //      'join_type' => 'inner');
         
                         $params['like'] = array("co.name" => $keyword_location,"s.name" => $keyword_location,"cy.name" => $keyword_location);
                    }


                    if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
                    {
                        $keywords = $_REQUEST['keywords'];

                        $params['like'] = array("c.fname" => $keywords,"c.lname" => $keywords,"c.email" => $keywords,"c.agency_name" => $keywords,"c.contact_name" => $keywords,"c.agency_gender"=>$keywords);
                    }

                    $onpage_record = 8;
                    $offset = $onpage_record * $page;
                    $limit = $onpage_record;

                    $params['start']      = $offset;
                    $params['Limit']      = $limit;
                    $params['find_in_set_field']       = "l.city_id";
                    $params['find_in_set_value']       = $city_id;
                    $params['GroupBy']                 = "l.user_id";
                    $params['ShortBy']    = "c.id desc";
                    $params['ShortOrder'] = "";
                     $data['service_ids'] = $service_id;

                    $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.user_role"=>4,"c.purchase_plan"=>1,"c.is_verified"=>1,"l.country_id"=>$country_id,"l.state_id"=>$state_id,"c.agency_status"=>'Y',"c.agency_user"=>1);

                    $data['posts']        = $this->crud->get_join($join,$wh,$params);
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
                           'join_table' => 'state s', 
                           'join_by' => 's.state_id = l.state_id ', 
                           'join_type' => 'inner');

                    $join['joins'][] = array(
                           'join_table' => 'country co', 
                           'join_by' => 'co.country_id = l.country_id ', 
                           'join_type' => 'inner');

                    if(isset($_REQUEST['keyword_location'])  && ($_REQUEST['keyword_location']!=""))
                    {
                        $keyword_location = $_REQUEST['keyword_location'];

                        // $join['joins'][] = array(
                        //     'join_table' => 'country co', 
                        //     'join_by' => 'co.country_id = c.country_id ', 
                        //     'join_type' => 'inner');
         
                        //  $join['joins'][] = array(
                        //      'join_table' => 'state s', 
                        //      'join_by' => 's.state_id = c.state_id ', 
                        //      'join_type' => 'inner');
                         
                         $join['joins'][] = array(
                             'join_table' => 'city cy', 
                             'join_by' => 'cy.id = c.city_id ', 
                             'join_type' => 'inner');
         
                         $params['like'] = array("co.name" => $keyword_location,"s.name" => $keyword_location,"cy.name" => $keyword_location);
                    }


                    if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
                    {
                        $keywords = $_REQUEST['keywords'];

                        $params['like'] = array("c.fname" => $keywords,"c.lname" => $keywords,"c.email" => $keywords,"c.agency_name" => $keywords,"c.contact_name" => $keywords,"c.agency_gender"=>$keywords);
                    }

                    $onpage_record = 8;
                    $offset = $onpage_record * $page;
                    $limit = $onpage_record;

                    $params['start']      = $offset;
                    $params['Limit']      = $limit;
                    
                    $params['GroupBy']                 = "l.user_id";
                    $params['ShortBy']    = "c.id desc";
                    $params['ShortOrder'] = "";
                     $data['service_ids'] = $service_id;

                    $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.user_role"=>4,"c.purchase_plan"=>1,"c.is_verified"=>1,"l.country_id"=>$country_id,"l.state_id"=>$state_id,"c.agency_status"=>'Y',"c.agency_user"=>1);

                    $data['posts']        = $this->crud->get_join($join,$wh,$params);
                   
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

                if(isset($_REQUEST['keyword_location'])  && ($_REQUEST['keyword_location']!=""))
                {
                    $keyword_location = $_REQUEST['keyword_location'];

                    // $join['joins'][] = array(
                    //     'join_table' => 'country co', 
                    //     'join_by' => 'co.country_id = c.country_id ', 
                    //     'join_type' => 'inner');
     
                     $join['joins'][] = array(
                         'join_table' => 'state s', 
                         'join_by' => 's.state_id = c.state_id ', 
                         'join_type' => 'inner');
                     
                     $join['joins'][] = array(
                         'join_table' => 'city cy', 
                         'join_by' => 'cy.id = c.city_id ', 
                         'join_type' => 'inner');
     
                     $params['like'] = array("co.name" => $keyword_location,"s.name" => $keyword_location,"cy.name" => $keyword_location);
                }

                if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
                {
                    $keywords = $_REQUEST['keywords'];

                    $params['like'] = array("c.fname" => $keywords,"c.lname" => $keywords,"c.email" => $keywords,"c.agency_name" => $keywords,"c.contact_name" => $keywords,"c.agency_gender"=>$keywords);

                }

                $onpage_record = 8;
                $offset = $onpage_record * $page;
                $limit = $onpage_record;

                $params['start']      = $offset;
                $params['Limit']      = $limit;
                
                $params['GroupBy']                 = "l.user_id";
                $params['ShortBy']    = "c.id desc";
                $params['ShortOrder'] = "";

                // $wh = array("c.is_delete"=>0,"c.user_role"=>4,"c.status"=>"Y","c.purchase_plan"=>1,,"c.is_verified"=>1,"l.country_id"=>$country_id);

                $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1,"c.user_role"=>4,"l.country_id"=>$country_id,"c.agency_status"=>'Y',"c.agency_user"=>1);

                $data['posts']        = $this->crud->get_join($join,$wh,$params);
                // echo $this->db->last_query();die();
            }
        }
        else
        {
            $join['select'] = 'c.*';
            $join['table'] = 'tbl_customer c';

            $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1,"c.user_role"=>4,"c.agency_status"=>'Y',"c.agency_user"=>1);

            if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
            {
                $keywords = $_REQUEST['keywords'];

                $params['like'] = array("c.fname" => $keywords,"c.lname" => $keywords,"c.email" => $keywords,"c.agency_name" => $keywords,"c.contact_name" => $keywords,"c.agency_gender"=>$keywords);
                // print_r($params['like']); exit;
            }

            if(isset($_REQUEST['keyword_location'])  && ($_REQUEST['keyword_location']!=""))
            {
                $keyword_location = $_REQUEST['keyword_location'];

                $join['joins'][] = array(
                   'join_table' => 'country co', 
                   'join_by' => 'co.country_id = c.country_id ', 
                   'join_type' => 'inner');

                $join['joins'][] = array(
                    'join_table' => 'state s', 
                    'join_by' => 's.state_id = c.state_id ', 
                    'join_type' => 'inner');
                
                $join['joins'][] = array(
                    'join_table' => 'city cy', 
                    'join_by' => 'cy.id = c.city_id ', 
                    'join_type' => 'inner');

                $params['like'] = array("co.name" => $keyword_location,"s.name" => $keyword_location,"cy.name" => $keyword_location);
            }

            $onpage_record = 8;
            $offset = $onpage_record * $page;
            $limit = $onpage_record;

            $params['start']      = $offset;
            $params['Limit']      = $limit;
            

            $params['ShortBy']    = "c.id desc";
            $params['ShortOrder'] = "";
            $data['service_ids'] = $service_id;
            $data['posts']        = $this->crud->get_join($join,$wh,$params);
            
            // echo $this->db->last_query(); die();

        }

        // echo $this->db->last_query(); die();
        $this->load->view(FRONTEND."agency/agency_lists_ajax_data",$data);
    }


    public function locationListajaxPaginationData()
    {
        $params1 = array();
        $country_id = $this->input->post('country_id');
        $state_id   = $this->input->post('state_id');
        $city_id    = $this->input->post('city_id');
        $page       = $this->input->post('page');

        if($city_id!="" && $city_id!=0)
        {

        }
        else if($state_id!="" && $state_id!=0)
        {

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

            $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.user_role"=>4,"tc.purchase_plan"=>1,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0,"l.country_id"=>$country_id,"l.state_id"=>$state_id);

            $onpage_record                      = 8;
            $offset                             = $onpage_record * $page;
            $limit                              = $onpage_record;

            $params1['start']                   = $offset;
            $params1['Limit']                   = $limit;
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

            $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.purchase_plan"=>1,"tc.user_role"=>4,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0,"l.country_id"=>$country_id);

            $onpage_record                      = 8;
            $offset                             = $onpage_record * $page;
            $limit                              = $onpage_record;

            $params1['start']                   = $offset;
            $params1['Limit']                   = $limit;
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

            $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.purchase_plan"=>1,"tc.user_role"=>4,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0);

            $onpage_record                      = 8;
            $offset                             = $onpage_record * $page;
            $limit                              = $onpage_record;

            $params1['start']                   = $offset;
            $params1['Limit']                   = $limit;
            
            $params1['GroupBy']                 = "l.country_id";
            $params1['ShortBy']                 = "c.country_id ASC";
            $params1['ShortOrder']              = "";
            $data['posts']                      = $this->crud->get_join($join1,$wh1,$params1);

        }

        
        $data['country_id']      = $country_id;
        $data['state_id']      = $state_id;
        
        $this->load->view(FRONTEND."agency/location_lists_ajax_data",$data);

    }

    public function agencyDetails($names,  $task= "")
    {
        $id = $this->crud->get_column_value_by_id("tbl_customer","id","slug = '".$names."'");

        $is_valid_request = $this->crud->check_duplicate("tbl_customer",array("id"=>$id,"is_delete"=>"0","status"=>'Y',"is_verified"=>1));
            
        if($is_valid_request)
        {
            $data   = array();
            $params = array();

            $data['user_d'] = $this->crud->get_one_row("tbl_customer",array("id"=>$id,"is_delete"=>"0","status"=>'Y',"is_verified"=>1));

            $data['pageTitle'] = strtolower($data['user_d']['agency_name']); 

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
            $data['task'] = $task;

            $this->load->view(FRONTEND."agency/agency_lists_details",$data);
        }
        else
        {
            $this->session->set_flashdata('error', 'Something went wrong.');
            redirect('agencies');
        }

    }


    public function getAgencyList()
    {
        $keyword = $this->input->post('keyword');
        if($keyword != "")
        {
            $egency_data = $this->crud->get_all_with_where("tbl_customer","fname","asc",array("is_delete" => 0,"user_role" => 4, "agency_name like" => '%'.$keyword.'%'));
            if(!empty($egency_data)) 
            { ?>
                <ul id="agency-list">
                    <?php foreach($egency_data as $data) { ?>
                            <li onClick="selectAgency('<?= $data->agency_name ?>');"><?= $data->agency_name ?></li>
                    <?php } ?>
                </ul>
            <?php }  
        }
    } 
   
   public function apply_job()
   {
        $response = array();
        $post = $this->input->post();
        $where = array('id' => $this->session->userdata('front_UserId'),'status'=>1,'is_delete'=>0,'purchase_plan'=>1 );
        $timer_tbl = $this->crud->get_one_value("tbl_customer",$where,'purchase_plan' );
        
        if(!$this->session->userdata('customer_is_logged_in')) 
        {
            $response['error'] = '1';
            $response['msg'] = 'Please login to your account.';
            echo json_encode($response);
            exit;
        }

        
        if($timer_tbl != 1)
        {
            $response['error'] = '1';
            $response['msg'] = 'purchase plan after send request.';
            echo json_encode($response);
            exit;
        }

        
        $this->form_validation->set_rules('agency_id','Agency','trim|required');
        $this->form_validation->set_rules('req','Request  ','trim|required');

        if($this->form_validation->run() == FALSE)
        {
            // $response["msg"]        = "all fields are required"();
            // echo json_encode($response);
            // exit;
        }
        else
        {

            $agency_id      = $post['agency_id'];
            $user_id        = $this->session->userdata('front_UserId');
            $req_int        = $post['data'];
            $request_str    = $post['req'];

            $user_info = $this->crud->get_one_row("tbl_customer",array('id' => $user_id,'purchase_plan'=>1,'is_delete' => 'Y', 'status' => 'Y', 'is_verified' => 1));
            $agency_info = $this->crud->get_one_row("tbl_customer",array('id' => $agency_id,'purchase_plan'=>1,'is_delete' => 'Y', 'status' => 'Y','agency_user' => 1,'agency_status'=>'Y', 'is_verified' => 1));

            $job_check = $this->crud->check_duplicate("agency_req",array('user_id'=>$user_id,'isDelete'=>0,"agency_id="=>$agency_id));

            if($job_check)
            {
                $response['user_id']    = $user_id;
                $response['error']      = 0;
                $response["msg"]        = "Job application pending";
                echo json_encode($response);
                exit;
                
            }
            
            $fieldInfo = array(
                'user_id'                   =>  $user_id,
                'agency_id'                 =>  $agency_id,
                'request'                   =>  $req_int,
                'request_str'               =>  $request_str,
                'isDelete'                  =>  0,
            );

            $result = $this->crud->insert('agency_req',$fieldInfo);
            

            if($result > 0)
            {
                /* General setting common from all email start*/
                $general_setting            = $this->generalSetting(); 
                $mail_data['site_name']     = $general_setting->site_name;
                $mail_data['site_title']    = $general_setting->site_title;
                $mail_data['site_email']    = $general_setting->email;
                $mail_data['site_logo']     = base_url('public/front/images/logo/'.$general_setting->site_logo );
                $mail_data['address']       = $general_setting->address;
                $mail_data['fb_link']       = $general_setting->fb_link;
                $mail_data['twitter_link']  = $general_setting->twitter_link;
                $mail_data['instagram_link'] = $general_setting->instagram_link;
                $mail_data['copyright_year'] = date("Y");
                /* General setting common from all email end */

                $mail_data['fname']             = $user_info['fname'].' '.$user_info['lname'];
                $mail_data['email']             = $user_info['email'];
                $mail_data['phone']             = $user_info['phone'];
                $mail_data['agency_name']       = $agency_info['fname'].' '.$agency_info['lname'];
                

                $message = $this->load->view('mail_template/user_req_to_agency_mail_template', $mail_data, TRUE);

                // echo $message; die;

                $mailbody['ToEmail']    = $agency_info['email'];
                $mailbody['FromName']   = $general_setting->site_name;
                $mailbody['FromEmail']  = $general_setting->site_from_email;
                $mailbody['Subject']    = $general_setting->site_name." Request Jobs Application ";
                $mailbody['Message']    = $message;

                $mail_result = $this->EmailSend($mailbody);

                if($mail_result)
                {
                    $response['user_id']    = $user_id;
                    $response['error']      = 0;
                    $response["msg"]   = $agency_info['agency_name']. " job apply successfully";
                }
                else
                {
                    $response['error'] = 1;
                    $response['msg'] = 'Some error occured while send mail. Please try again.';
                }

            }

        }
        
        echo json_encode($response);
        exit;  
   }


   public function request_job()
   {
        $response = array();
        $post = $this->input->post();
        // echo "<pre>";
        // print_r($post);
        // exit;
        
        $reqid          = $post['reqid'];
        $req_int        = $post['data'];
        $request_str    = $post['req'];
        $agency_id      = $post['agency_id'];
        $user_id        = $post['user_id'];

        $user_info = $this->crud->get_one_row("tbl_customer",array('id' => $user_id,'purchase_plan'=>1,'is_delete' => 'Y', 'status' => 'Y', 'is_verified' => 1));

        $agency_info = $this->crud->get_one_row("tbl_customer",array('id' => $agency_id,'purchase_plan'=>1,'is_delete' => 'Y', 'status' => 'Y','agency_user' => 1,'agency_status'=>'Y', 'is_verified' => 1));
        
        
        $fieldInfo = array(
            'apply_req'                 =>  $request_str,
            'isDelete'                  =>  0,
        );

        $result = $this->crud->update("apply_job",$fieldInfo,array("id"=>$reqid));
        
        // echo $result; exit;
        if($result > 0)
        {
            /* General setting common from all email start*/
            $general_setting            = $this->generalSetting(); 
            $mail_data['site_name']     = $general_setting->site_name;
            $mail_data['site_title']    = $general_setting->site_title;
            $mail_data['site_email']    = $general_setting->email;
            $mail_data['site_logo']     = base_url('public/front/images/logo/'.$general_setting->site_logo );
            $mail_data['address']       = $general_setting->address;
            $mail_data['fb_link']       = $general_setting->fb_link;
            $mail_data['twitter_link']  = $general_setting->twitter_link;
            $mail_data['instagram_link'] = $general_setting->instagram_link;
            $mail_data['copyright_year'] = date("Y");
            /* General setting common from all email end */

            $mail_data['fname']             = $agency_info['fname'].' '.$agency_info['lname'];
            $mail_data['email']             = $agency_info['email'];
            $mail_data['phone']             = $agency_info['phone'];
            $mail_data['agency']            = $agency_info['agency_name'];
            $mail_data['agency_name']       = $user_info['fname'].' '.$user_info['lname'];
            

            $message = $this->load->view('mail_template/accept_req_agency_mail_template', $mail_data, TRUE);

            // echo $message; die;

            $mailbody['ToEmail']    = $user_info['email'];
            $mailbody['FromName']   = $general_setting->site_name;
            $mailbody['FromEmail']  = $general_setting->site_from_email;
            $mailbody['Subject']    = $general_setting->site_name." Job Application Approve";
            $mailbody['Message']    = $message;

            $mail_result = $this->EmailSend($mailbody);

            if($mail_result)
            {
                $response['user_id']    = $user_id;
                $response['error']      = 0;
                $response["msg"]   = $agency_info['fname'].' '.$agency_info['lname']. " job apply successfully";
            }
            else
            {
                $response['error'] = 1;
                $response['msg'] = 'Some error occured while send mail. Please try again.';
            }

            echo json_encode($response);
            exit;

        }
   }

   public function post_view()
   {
        $post = $this->crud->get_all_with_where('post','name','desc',array('isDelete'=>0,'status'=>'Y'));
        $join['select'] = 'count(p.id) as countdata';
        $join['table'] = 'post p';

        $join['joins'][] = array(
            'join_table' => 'tbl_customer c', 
            'join_by' => 'c.id = p.user_id ', 
            'join_type' => 'inner');

        $wh = array("p.isDelete"=>0,"p.status"=>"Y","c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1);
        $params = array();

        $totalRec = $this->crud->get_join($join,$wh,$params)[0]['countdata'];
        // echo $this->db->last_query(); die();
        $data['total_record'] = $totalRec;

        $services = $this->crud->get_all_with_where('service','name','desc',array('isDelete'=>0,'status'=>'Y','service_type'=>1));
        
        $data['posts'] = $post;
        $data['services'] = $services;
        $data['pageTitle'] = 'Advertise with us | Post an Ads | Advertisement | Stripper Party Bus';
        $this->load->view(FRONTEND."agency/post_and_ads",$data);
   }

   public function PostListajaxPaginationData()
   {
        $page   = $this->input->post('page');
        $params = array();
        $join['select'] = 'p.*';
        $join['table'] = 'post p';

        $join['joins'][] = array(
            'join_table' => 'tbl_customer c', 
            'join_by' => 'c.id = p.user_id ', 
            'join_type' => 'inner');

        if(isset($_REQUEST['keyword_location'])  && ($_REQUEST['keyword_location']!=""))
        {
            $keyword_location = $_REQUEST['keyword_location'];
            
            $join['joins'][] = array(
                'join_table' => 'country co', 
                'join_by' => 'co.country_id = p.country_id ', 
                'join_type' => 'inner');

            $join['joins'][] = array(
                    'join_table' => 'state s', 
                    'join_by' => 's.state_id = p.state_id ', 
                    'join_type' => 'inner');

            $params['like'] = array("co.name" => $keyword_location,"s.name"=>$keyword_location);
            
        }

        if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
        {
            $keywords = $_REQUEST['keywords'];

            $params['like'] = array("p.title" => $keywords,"p.slug" => $keywords,"p.service_id" => $keywords);

        }

        $onpage_record = 8;
        $offset = $onpage_record * $page;
        $limit = $onpage_record;

        $params['start']      = $offset;
        $params['Limit']      = $limit;
        $params['GroupBy']    = "p.id";
        $params['ShortBy']    = "p.id desc";
        $params['ShortOrder'] = "";
                    
        $wh = array("p.isDelete"=>0,"p.status"=>"Y","c.is_delete"=>0,"c.purchase_plan"=>1,"c.user_role"=>4);
        $data['posts']        = $this->crud->get_join($join,$wh,$params);
        // echo $this->db->last_query();die();
        $this->load->view(FRONTEND."agency/post_list",$data);
    }

   public function post_details($slug)
   {
       
        if($slug != "")
        {
            $id = $this->crud->get_column_value_by_id("post","id","slug = '".$slug."'");
            $is_valid_request = $this->crud->check_duplicate("post",array("id"=>$id,"isDelete"=>"0","status"=>'Y'));
            
            if($is_valid_request)
            {
                $data   = array();
                $data['user_d'] = $this->crud->get_one_row("post",array("id"=>$id,"isDelete"=>"0","status"=>'Y'));

                $data['pageTitle'] = strtolower($data['user_d']['title']); 
                $this->load->view(FRONTEND."agency/post_and_ads_lists_details",$data);
            }
            else
            {
                $this->session->set_flashdata('error', 'Something went wrong.');
                redirect('post-and-ads');
            }

        }
        else
        {
            $this->session->set_flashdata('error', 'Something went wrong.');
            redirect('post-and-ads');
        }
   }

   public function apply_jobs()
   {
        $response = array();
        $post = $this->input->post();
        $where = array('id' => $this->session->userdata('front_UserId'),'status'=>1,'is_delete'=>0,'purchase_plan'=>1 );
        $timer_tbl = $this->crud->get_one_value("tbl_customer",$where,'purchase_plan' );
        
        if(!$this->session->userdata('customer_is_logged_in')) 
        {
            $response['error'] = '1';
            $response['msg'] = 'Please login to your account.';
            echo json_encode($response);
            exit;
        }

        if($timer_tbl != 1)
        {
            $response['error'] = '1';
            $response['msg'] = 'purchase plan after send request.';
            echo json_encode($response);
            exit;
        }
        
        $this->form_validation->set_rules('full_name','Full name','trim|required');
        $this->form_validation->set_rules('email','Email  ','trim|required');
        $this->form_validation->set_rules('message','Message  ','trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $data["msg"]        = "all fields are required";
            echo json_encode($data);
            exit;
        }
        else
        {

            $post_id        = $post['post_id'];
            $user_id        = $this->session->userdata('front_UserId');
            $full_name      = $post['full_name'];
            $email          = $post['email'];
            $message        = $post['message'];

            $user_info = $this->crud->get_one_row("tbl_customer",array('id' => $user_id,'purchase_plan'=>1,'is_delete' => 0, 'status' => 'Y', 'is_verified' => 1));

            $post = $this->crud->get_one_row("post",array('id' => $post_id,'isDelete' => 0, 'status' => 'Y'));

            $agency_id =  $post['user_id'];

            $agency_info = $this->crud->get_one_row("tbl_customer",array('id' => $agency_id,'purchase_plan'=>1,'is_delete' => 0, 'status' => 'Y','agency_user' => 1,'agency_status'=>'Y', 'is_verified' => 1));

            $job_check = $this->crud->check_duplicate("apply_job",array('user_id'=>$user_id,'isDelete'=>0,"post_id="=>$post_id));

            if($job_check)
            {
                $response['user_id']    = $user_id;
                $response['error']      = 0;
                $response["msg"]        = "Already apply this job";
                echo json_encode($response);
                exit;
                
            }
            
            $fieldInfo = array(
                'post_id'                   => $post_id,
                'user_id'                   => $user_id,
                'agency_id'                 => $agency_id,
                'full_name'                 => $full_name,
                'email'                     => $email,
                'message'                   => $message,
                'apply_req'                 => 1,
                'status'                    => 'Y',
                'isDelete'                  => 0,
            );

            $result = $this->crud->insert('apply_job',$fieldInfo);
            

            if($result > 0)
            {
                /* General setting common from all email start*/
                $general_setting            = $this->generalSetting(); 
                $mail_data['site_name']     = $general_setting->site_name;
                $mail_data['site_title']    = $general_setting->site_title;
                $mail_data['site_email']    = $general_setting->email;
                $mail_data['site_logo']     = base_url('public/front/images/logo/'.$general_setting->site_logo );
                $mail_data['address']       = $general_setting->address;
                $mail_data['fb_link']       = $general_setting->fb_link;
                $mail_data['twitter_link']  = $general_setting->twitter_link;
                $mail_data['instagram_link'] = $general_setting->instagram_link;
                $mail_data['copyright_year'] = date("Y");
                /* General setting common from all email end */

                $mail_data['fname']             = $user_info['fname'].' '.$user_info['lname'];
                $mail_data['email']             = $user_info['email'];
                $mail_data['phone']             = $user_info['phone'];
                $mail_data['agency_name']       = $agency_info['fname'].' '.$agency_info['lname'];
                

                $message = $this->load->view('mail_template/user_req_to_agency_mail_template', $mail_data, TRUE);

                // echo $message; die;

                $mailbody['ToEmail']    = $agency_info['email'];
                $mailbody['FromName']   = $general_setting->site_name;
                $mailbody['FromEmail']  = $general_setting->site_from_email;
                $mailbody['Subject']    = $general_setting->site_name." Request Jobs Application ";
                $mailbody['Message']    = $message;

                $mail_result = $this->EmailSend($mailbody);

                if($mail_result)
                {
                    $response['user_id']    = $user_id;
                    $response['error']      = 0;
                    $response["msg"]   = $agency_info['agency_name']. " job apply successfully";
                }
                else
                {
                    $response['error'] = 1;
                    $response['msg'] = 'Some error occured while send mail. Please try again.';
                }

            }
            else
            {
                $response['error'] = 1;
                $response['msg'] = 'Something want wrong';  
            }

        }

        echo json_encode($response);
        exit;
   }

   public function category_view($name)
   {
        $data   = array();
       if($name != '')
       {
            $posts= $this->crud->get_all_with_where('post','title','asc',array('service_id'=>$name,'status'=>'Y','isDelete'=>0));
            $data['posts'] = $posts;
            $data['pageTitle'] = $name;
            $this->load->view(FRONTEND."agency/category_list",$data);
       }
       else
       {
            $this->session->set_flashdata('error', 'Something went wrong.');
            redirect('post-and-ads'); 
       }
   }


   public function getPostList(){

        $keyword = $this->input->post('keyword');

        if($keyword != "")
        {
            $tb_customer = $this->crud->get_all_with_where("post","slug","asc",array("isDelete" => 0,"status"=>'Y',"title like" => '%'.$keyword.'%'));

            if($tb_customer)
            {
                foreach($tb_customer as $data)
                {
                    ?>
                    <ul id="agency-list">
                        
                        <?php foreach($tb_customer as $data) { ?>
                            <li onClick="Select('<?= $data->title ?>');"><?= $data->title ?></li>
                        <?php }  ?>
                        
                    </ul>
                    <?php
                }
            }

        }
   }

  
}
