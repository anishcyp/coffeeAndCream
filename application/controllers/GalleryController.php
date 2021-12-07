<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontController.php';

class GalleryController extends FrontController 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud', 'crud'); 
        $this->load->library('Ajax_pagination.php');
        // $this->isUserLogin(); 
        $this->table = 'gallery';
    }

    public function galleryList($type,$country_slug="",$state_slug="",$city_slug="")
    {
        if($type == "male" || $type == "female") 
        {
            $data       = array();
            $params     = array();
            $params1    = array();

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
                                   
                                    // $totalRec = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where gender = '".$type."' and id IN (select user_id from location where country_id='".$country_res['country_id']."' AND state_id='".$state_res['state_id']."' AND find_in_set(".$city_res['id'].", city_id))");

                                    $totalRec = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where gender = '".$type."' and purchase_plan=1 and accommodation_user=0 and is_delete=0 and id IN (select user_id from location where country_id='".$country_res['country_id']."' AND state_id='".$state_res['state_id']."' AND find_in_set(".$city_res['id'].", city_id))");
                                    
                                    $data['total_record'] = $totalRec[0]->total_user;

                                    $data['total_record2'] = "There are ".$data['total_record']." profiles in ".$city_res['name']." that match your search.";

                                    $total = $data['total_record'] - 16;
                                    $data['total'] = $total;

                                    $data['btnname']                       =  $city_res['name'];
                                    $data['description_profiles'] = "There are more profiles located near you. Take a look at them.";

                                    $data['location_total_record']   = "no_more";
                                }
                                else
                                {

                                }
                            }
                            else
                            {
                                
                                // $totalRec = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where gender = '".$type."' and id IN (select user_id from location where country_id='".$country_res['country_id']."' AND state_id='".$state_res['state_id']."')");

                                $totalRec = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where gender = '".$type."' and purchase_plan=1 and accommodation_user=0 and is_delete=0 and is_verified=1 and status='Y' and id IN (select user_id from location where country_id='".$country_res['country_id']."' AND state_id='".$state_res['state_id']."')");

                                ;
                                $data['total_record'] = $totalRec[0]->total_user;

                                $total = $data['total_record'] - 16;
                                $data['total'] = $total;
                                
                                $data['total_record2'] = "There are ".$data['total_record']." profiles in ".$state_res['name']." that match your search.";

                                
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

                                $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.purchase_plan"=>1,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.accommodation_user"=>0,"tc.gender"=>$type,"tc.status"=>"Y","l.isDelete" =>0,"l.country_id"=>$country_res['country_id'],"l.state_id"=>$state_res['state_id']);

                               
                               
                                
                                //$params1['GroupBy']                 = "l.state_id";
                                $params1['ShortBy']                 = "c.state_id ASC";
                                $params1['ShortOrder']              = "";
                                $c_ids                      = $this->crud->get_join($join1,$wh1,$params1);

                                $temp = array();
                                foreach ($c_ids as $c_id) 
                                {

                                    $city_datas = $this->crud->getFromSQL('SELECT *FROM `city` where id in ('.$c_id['city_id'].')');  
                                }
                               
                                $data['location_total_record']   = count($city_datas);

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
                        
                        $totalRec = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where gender = '".$type."' and purchase_plan=1 and is_verified=1 and accommodation_user=0 and is_delete=0 and id IN (select user_id from location where country_id='".$country_res['country_id']."')");


                        $data['total_record'] = $totalRec[0]->total_user;


                        $data['total_record2'] = "There are ".$data['total_record']." profiles in ".$country_res['name']." that match your search.";

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

                        $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.accommodation_user"=>0,"tc.purchase_plan"=>1,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0,"l.country_id"=>$country_res['country_id'],"tc.gender"=>$type);

                        $params1['GroupBy']                 = "l.state_id";
                        $data['btnname']                       =  $country_res['name'];
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

                $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.accommodation_user"=>0,"c.purchase_plan"=>1,"c.is_verified"=>1,"c.gender"=>$type);

                $totalRec = $this->crud->get_join($join,$wh,$params)[0]['countdata'];
                //echo $this->db->last_query(); die();
                $data['total_record']   = $totalRec;
               
                $total = $totalRec - 16;
                $data['total'] = $total;
                // echo $this->db->last_query(); die();

                // $data['description_profiles'] = "";

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

                $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.accommodation_user"=>0,"tc.purchase_plan"=>1,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0,"tc.gender"=>$type);

                $params1['GroupBy']             = "l.country_id";
                $data['btnname']                =   ucwords($type)." Gallery";
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
                $data['country_id']            = "";
                
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
                $data['state_id']              = "";
                
            }

            if($city_slug!="")
            {
                $data['city_id']                = $city_res['id'];
                $data['curr_location_name']     = $city_res['name'];
                $data['city_n']                 = $city_res['name'];
                $data['curr_location_desc']     = $city_res['description'];

            }
            else
            {
                $data['city_id']       = "";
            }

            $data['type']           = $type;
            $data['pageTitle']      = ucwords( $type) ." Entertainer Party Gallery ";
            $data['pageTitle1']      = ucwords( $type);
            $this->load->view(FRONTEND."gallery/gallery_lists",$data);
        }
        else
        {
            $this->session->set_flashdata('error', 'Something went wrong.');
            redirect(APP_URL."gallery/male");
        }
    }

    public function galleryListajaxPaginationData()
    {
        //$UserId = $this->session->userdata('front_UserId');

        $params     = array();
        $type       = $this->input->post('type');
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

                    $onpage_record = 16;
                    $offset = $onpage_record * $page;
                    $limit = $onpage_record;

                    $params['start']      = $offset;
                    $params['Limit']      = $limit;
                    $params['find_in_set_field']       = "l.city_id";
                    $params['find_in_set_value']       = $city_id;
                    $params['GroupBy']                 = "l.user_id";
                    $params['ShortBy']    = "c.id desc";
                    $params['ShortOrder'] = "";

                    $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.accommodation_user"=>0,"c.purchase_plan"=>1,"c.is_verified"=>1,"l.country_id"=>$country_id,"l.state_id"=>$state_id);

                    $data['posts']        = $this->crud->get_join($join,$wh,$params);

                    // echo $this->db->last_query();
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
                           'join_by' => 's.state_id = c.state_id ', 
                           'join_type' => 'inner');

                    $join['joins'][] = array(
                           'join_table' => 'country co', 
                           'join_by' => 'co.country_id = c.country_id ', 
                           'join_type' => 'inner');

                    if(isset($_REQUEST['keyword_location'])  && ($_REQUEST['keyword_location']!=""))
                    {
                        $keyword_location = $_REQUEST['keyword_location'];

                        $params['like'] = array("co.name" => $keyword_location,"s.name" => $keyword_location);
                    }


                    if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
                    {
                        $keywords = $_REQUEST['keywords'];

                        $params['like'] = array("c.fname" => $keywords,"c.lname" => $keywords,"c.email" => $keywords,"c.alias_name" => $keywords);
                    }

                    $onpage_record = 16;
                    $offset = $onpage_record * $page;
                    $limit = $onpage_record;

                    $params['start']      = $offset;
                    $params['Limit']      = $limit;
                    $params['GroupBy']    = "l.user_id";
                    $params['ShortBy']    = "c.id desc";
                    $params['ShortOrder'] = "";

                    $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.accommodation_user"=>0,"c.purchase_plan"=>1,"c.is_verified"=>1,"l.country_id"=>$country_id,"l.state_id"=>$state_id,"c.gender"=>$type);
                    
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

                    $params['like'] = array("co.name" => $keyword_location);
                }

                if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
                {
                    $keywords = $_REQUEST['keywords'];

                    $params['like'] = array("c.fname" => $keywords,"c.lname" => $keywords,"c.email" => $keywords,"c.alias_name" => $keywords);
                }

                $onpage_record = 16;
                $offset = $onpage_record * $page;
                $limit = $onpage_record;

                $params['start']      = $offset;
                $params['Limit']      = $limit;
                $params['GroupBy']    = "l.user_id";
                $params['ShortBy']    = "c.id desc";
                $params['ShortOrder'] = "";

                $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.accommodation_user"=>0,"c.purchase_plan"=>1,"c.is_verified"=>1,"l.country_id"=>$country_id,"c.gender"=>$type);
                $data['posts']        = $this->crud->get_join($join,$wh,$params);
                // echo $this->db->last_query();die();
            }
        }
        else
        {
            $join['select'] = 'c.*';
            $join['table'] = 'tbl_customer c';

            $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.accommodation_user"=>0,"c.purchase_plan"=>1,"c.is_verified"=>1,"c.gender"=>$type);

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

            $onpage_record = 16;
            $offset = $onpage_record * $page;
            $limit = $onpage_record;

            // echo $offset; exit;

            $params['start']      = $offset;
            $params['Limit']      = $limit;

            $params['ShortBy']    = "c.id desc";
            $params['ShortOrder'] = "";
            $data['posts']        = $this->crud->get_join($join,$wh,$params);
            // print_r($data['posts']); exit();
        }

        // echo $this->db->last_query(); die();
        $data['type'] = $type;
        $this->load->view(FRONTEND."gallery/gallery_lists_ajax_data",$data);
    }


    public function galleryListajaxPaginationData1()
    {
        //$UserId = $this->session->userdata('front_UserId');

        $params     = array();
        $type       = $this->input->post('type');
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

                    $join['joins'][] = array(
                           'join_table' => 'location l', 
                           'join_by' => 'c.id = l.user_id ', 
                           'join_type' => 'inner');

                    $join['joins'][] = array(
                           'join_table' => 'state s', 
                           'join_by' => 's.state_id = c.state_id ', 
                           'join_type' => 'inner');

                    $join['joins'][] = array(
                           'join_table' => 'country co', 
                           'join_by' => 'co.country_id = c.country_id ', 
                           'join_type' => 'inner');

                    if(isset($_REQUEST['keyword_location'])  && ($_REQUEST['keyword_location']!=""))
                    {
                        $keyword_location = $_REQUEST['keyword_location'];

                        $params['like'] = array("co.name" => $keyword_location,"s.name" => $keyword_location);
                    }


                    if(isset($_REQUEST['keywords']) && ($_REQUEST['keywords']!=""))
                    {
                        $keywords = $_REQUEST['keywords'];

                        $params['like'] = array("c.fname" => $keywords,"c.lname" => $keywords,"c.email" => $keywords,"c.alias_name" => $keywords);
                    }

                   
                    $params['GroupBy']    = "l.user_id";
                    $params['ShortBy']    = "c.id desc";
                    $params['ShortOrder'] = "";

                    $wh = array("c.is_delete"=>0,"c.accommodation_user"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1,"l.country_id"=>$country_id,"l.state_id"=>$state_id,"c.gender"=>$type);
                    
                    $data['posts1']        = $this->crud->get_join($join,$wh,$params); 

                    $data['type'] = $type;
                    $this->load->view(FRONTEND."gallery/gallery_lists_ajax_data1",$data);

                    // echo $this->db->last_query();
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

               
                $params['GroupBy']    = "l.user_id";
                $params['ShortBy']    = "c.id desc";
                $params['ShortOrder'] = "";

                $wh = array("c.is_delete"=>0,"c.accommodation_user"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1,"l.country_id"=>$country_id,"c.gender"=>$type);
                $data['posts1']        = $this->crud->get_join($join,$wh,$params);
                $data['type'] = $type;
                $this->load->view(FRONTEND."gallery/gallery_lists_ajax_data1",$data);
                }
                
            }
            else
            {
                
                // echo $this->db->last_query();die();
            }
        }
        else
        {
            
        }

        // echo $this->db->last_query(); die();
        
    }


    public function galleryDetails($id)
    {
        $is_valid_request = $this->crud->check_duplicate("tbl_customer",array("md5(id)"=>$id,"is_delete"=>"0","status"=>'Y',"purchase_plan"=>1,"is_verified"=>1));
        if($is_valid_request)
        {
            $data   = array();
            $params = array();

            $data['user_d'] = $this->crud->get_one_row("tbl_customer",array("md5(id)"=>$id,"is_delete"=>"0","status"=>'Y',"purchase_plan"=>1,"is_verified"=>1));
            $data['pageTitle'] = ucwords($data['user_d']['fname']." ".$data['user_d']['lname']); 

            $gallerylists = $this->crud->get_all_with_where('gallery','id','desc',array('status'=>'Y','isDelete'=>0,'md5(user_id)'=>$id));
            $data["gallerylists"]       = $gallerylists;

            $call_rateslists = $this->crud->get_all_with_where('call_rates','id','desc',array('isDelete'=>0,'md5(user_id)'=>$id));
            $data["call_rateslists"]       = $call_rateslists;

            $location = $this->crud->get_all_with_where('location','id','ASC',array('md5(user_id)'=>$id,'isDelete'=>0));
            $data["location"]   = $location;

            $site_settings = $this->crud->get_one_row("site_settings");
            $data["site_settings"]   = $site_settings;

            $diary = $this->crud->get_all_with_where('my_diary','id','ASC',array('md5(user_id)'=>$id,'isDelete'=>0));
            $data['diary']              = $diary;

            $review = $this->crud->get_all_with_where('review','id','ASC',array('md5(user_id)'=>$id,'isDelete'=>0));
            $data['review']              = $review;
            
            $this->load->view(FRONTEND."service/service_lists_details",$data);
        }
        else
        {
            $this->session->set_flashdata('error', 'Something went wrong.');
            redirect(APP_URL);
        }
    }

    public function locationListajaxPaginationData()
    {
        //$UserId = $this->session->userdata('front_UserId');

        $params1 = array();
        $type       = $this->input->post('type');
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

            $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.purchase_plan"=>1,"tc.accommodation_user"=>0,"tc.gender"=>$type,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0,"l.country_id"=>$country_id,"l.state_id"=>$state_id);

            $onpage_record                      = 8;
            $offset                             = $onpage_record * $page;
            $limit                              = $onpage_record;

            $params1['start']                   = $offset;
            $params1['Limit']                   = $limit;
            
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

            $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.accommodation_user"=>0,"tc.purchase_plan"=>1,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0,"l.country_id"=>$country_id,"tc.gender"=>$type);

            $onpage_record                      = 8;
            $offset                             = $onpage_record * $page;
            $limit                              = $onpage_record;

            $params1['start']                   = $offset;
            $params1['Limit']                   = $limit;

            $params1['GroupBy']                 = "l.state_id";
            $params1['ShortBy']                 = "c.state_id ASC";
            $params1['ShortOrder']              = "";
            $data['posts']                      = $this->crud->get_join($join1,$wh1,$params1);
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

            $wh1 = array("c.isDelete"=>0,"c.status"=>"Y","tc.accommodation_user"=>0,"tc.purchase_plan"=>1,"tc.is_verified"=>1,"tc.is_delete"=>0,"tc.status"=>"Y","l.isDelete" =>0,"tc.gender"=>$type);

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
       // echo $this->db->last_query(); die();

        $data['type'] = $type;
        $data['country_id']      = $country_id;
        $data['state_id']      = $state_id;
        $this->load->view(FRONTEND."gallery/location_lists_ajax_data",$data);
    }


    public function ajaxPaginationDataGallery()
    {
        $tablename = base64_encode('gallery');
        $tableId = base64_encode('id');
        $user_id = $this->session->userdata('front_UserId'); 
        $config['select'] = 'gallery.*';
        $config['table'] = 'gallery';

        $config['column_order'] = array('gallery.gallery_file');
        $config['column_search'] = array('gallery.gallery_file');         
        $config['custom_where'] = array('isDelete' => 0,'user_id'=>$user_id);
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();
        
        foreach ($records as $record) {

            $action = '';
            $status = '';

            $action .= '<button class="btn btn-icon waves-effect btn-danger rowDelete" data-id="'.$record->id.'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';
            if($record->status == 'Y')
            {
               $status = '<td style="width: 60%;"><span class="label label-success">Approve</span></td>';
            }
            else if($record->status == 'N')
            {
                $status = '<td style="width: 60%;"><span class="label label-warning">Pending</span></td>';
            }

             $dis_image = "";
            if(file_exists(UPLOAD_DIR.GALLERY_IMG.$record->gallery_file) && $record->gallery_file!="")
            {
               
                $ext = pathinfo(base_url().UPLOAD_DIR.GALLERY_IMG.$record->gallery_file, PATHINFO_EXTENSION);
                $video= array("webm","mkv","flv","gif","m4p","mp4");

                if (in_array($ext, $video))
                {
                
                $dis_image = '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="'.APP_URL.UPLOAD_DIR.GALLERY_IMG.$record->gallery_file.'" sandbox  allowfullscreen></iframe></div>';
                }
                else
                {
               
                $dis_image = '<a href="'.APP_URL.UPLOAD_DIR.GALLERY_IMG.$record->gallery_file.'" target="_blank"><img style="width: 119px;height: auto;" src="'.APP_URL.UPLOAD_DIR.GALLERY_IMG.$record->gallery_file.'" alt=""></a>';
                }
            }
            else
            {
                $dis_image = '<img style="width: 119px;height: auto;" src="'.base_url(UPLOAD_DIR.'default.png').'">';
            }

            $row = array();
            $row[] = $dis_image;
            $row[] = $status;
            $row[] = $action;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->count_all(),
            "recordsFiltered" => $this->datatable->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }


    public function getUsersList(){
        $keywords = $_REQUEST['keyword']; 
        $type = $_REQUEST['type'];
        if($keywords){

            $customer_sql = $this->crud->get_all_with_where("tbl_customer","fname","asc",array("is_delete" => 0,"purchase_plan" => 1,"gender"=>$type, "alias_name like" => '%'.$keywords.'%'));

            $services = $this->crud->get_all_with_where("service","name","asc",array("status"=>'Y','isDelete'=>0,"name like" => '%'.$keywords.'%'));

            if(!empty($customer_sql) || !empty($services)){
            ?>
                <ul id="agency-list">
                    
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
        
}
