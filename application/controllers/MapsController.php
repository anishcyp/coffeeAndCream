<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontController.php';

class MapsController extends FrontController {

    public function __construct()
    {
        parent::__construct();
        // $this->isUserLogin();
        $this->load->library('upload');
        $this->load->model('Crud', 'crud'); 
        $this->table = '';
    }

    public function view_maps()
    {
        $data = array();
        $data['pageTitle'] = 'Find Stripper | Porn Star Profile | Kissograms| Stripper Party Bus'; 
        $this->load->view(FRONTEND."maps/map",$data);
    }


    public function map_search()
    {

        if(isset($_REQUEST['keywords']) && $_REQUEST['keywords'] !='' && empty($_REQUEST['keyword_location']))
        {
            $keywords = $_REQUEST['keywords'];
                
            $sql = "SELECT `c`.* FROM `tbl_customer` `c` INNER JOIN `service` `s` ON FIND_IN_SET(s.service_id, c.service_id) WHERE ( c.fname LIKE '".$keywords."%' ESCAPE '!' OR c.contact_name LIKE '".$keywords."%' ESCAPE '!' OR c.agency_gender LIKE '".$keywords."%' ESCAPE '!' OR c.agency_name LIKE '".$keywords."%' ESCAPE '!' OR c.lname LIKE '".$keywords."%' ESCAPE '!' OR c.email LIKE '".$keywords."%' ESCAPE '!' OR c.alias_name LIKE '".$keywords."%' ESCAPE '!' OR s.name LIKE '%".$keywords."%' ESCAPE '!' ) AND `c`.`is_delete` = 0 AND `c`.`status` = 'Y' AND `c`.`purchase_plan` = 1 AND `c`.`is_verified` = 1 AND `c`.`slug` IS NOT NULL GROUP by c.id";
            
            $sql = str_replace("%male","male",$sql);
            $sql = str_replace("%Male","Male",$sql);
            
            $udatas  = $this->crud->getFromSQL($sql);

            $datas = array();
            if(!empty($udatas)){
                foreach($udatas as $data){
                    $datas[] = $data;
                }
            }
            
            $sql = "SELECT `c`.* FROM `tbl_customer` `c` WHERE ( c.fname LIKE '".$keywords."%' ESCAPE '!' OR c.contact_name LIKE '".$keywords."%' ESCAPE '!' OR c.agency_gender LIKE '".$keywords."%' ESCAPE '!' OR c.agency_name LIKE '".$keywords."%' ESCAPE '!' OR c.lname LIKE '".$keywords."%' ESCAPE '!' OR c.email LIKE '".$keywords."%' ESCAPE '!' OR c.alias_name LIKE '".$keywords."%' ESCAPE '!' ) AND `c`.`is_delete` = 0 AND `c`.`status` = 'Y' AND `c`.`purchase_plan` = 1 AND `c`.`user_role`= 4 AND `c`.`is_verified` = 1 AND `c`.`slug` IS NOT NULL GROUP by c.id";
            
            $sql = str_replace("%male","male",$sql);
            $sql = str_replace("%Male","Male",$sql);
            
            $a_datas  = $this->crud->getFromSQL($sql);
            //echo $this->db->last_query();
            if(!empty($a_datas)){
                foreach($a_datas as $a_data){
                    $datas[] = $a_data;
                }
            }
        }
        
        
        if(isset($_REQUEST['keyword_location']) && $_REQUEST['keyword_location'] !='' && empty($_REQUEST['keywords']))
        {
            $keyword_location = $_REQUEST['keyword_location'];
            
            $where = "( co.name LIKE '%".$keyword_location."%' ESCAPE '!' OR st.name LIKE '%".$keyword_location."%' ESCAPE '!' OR ci.name LIKE '%".$keyword_location."%' ESCAPE '!'";
            
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
            
            $country_id =$this->crud->getFromSQL("SELECT country_id from country where name like '%".$keyword_location."%'");
            
            if(!empty($country_id)){
                $country_id = $country_id[0]->country_id;
                $where .= " or l.country_id = ".$country_id."";
            }
            
            $where .= ")";

                
             $datas  = $this->crud->getFromSQL("SELECT `c`.* FROM `tbl_customer` `c` INNER JOIN `country` `co` ON `co`.`country_id` = `c`.`country_id` INNER JOIN `state` `st` ON `st`.`state_id` = `c`.`state_id` INNER JOIN `city` `ci` ON `ci`.`id` = `c`.`city_id` left JOIN `location` `l` ON `l`.`user_id` = `c`.`id`  WHERE ".$where." AND `c`.`is_delete` = 0 AND `c`.`status` = 'Y' AND `c`.`purchase_plan` = 1 AND `c`.`is_verified` = 1 AND `c`.`slug` IS NOT NULL GROUP by c.id");
        }
        
        
         if(isset($_REQUEST['keyword_location']) && $_REQUEST['keyword_location'] !='' && isset($_REQUEST['keywords']) && $_REQUEST['keywords'] != '')
        {
            $keyword_location = $_REQUEST['keyword_location'];
            $keywords = $_REQUEST['keywords'];
            
            $where = "( co.name LIKE '%".$keyword_location."%' ESCAPE '!' OR st.name LIKE '%".$keyword_location."%' ESCAPE '!' OR ci.name LIKE '%".$keyword_location."%' ESCAPE '!'";
            
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
            
            $country_id =$this->crud->getFromSQL("SELECT country_id from country where name like '%".$keyword_location."%'");
            
            if(!empty($country_id)){
                $country_id = $country_id[0]->country_id;
                $where .= " or l.country_id = ".$country_id."";
            }
            
            $where .= ")";
            
            $sql = "SELECT `c`.* FROM `tbl_customer` `c` INNER JOIN `service` `s` ON FIND_IN_SET(s.service_id, c.service_id) INNER JOIN `country` `co` ON `co`.`country_id` = `c`.`country_id` INNER JOIN `state` `st` ON `st`.`state_id` = `c`.`state_id` INNER JOIN `city` `ci` ON `ci`.`id` = `c`.`city_id` left JOIN `location` `l` ON `l`.`user_id` = `c`.`id`  WHERE ( c.fname LIKE '".$keywords."%' ESCAPE '!' OR  c.lname LIKE '".$keywords."%' ESCAPE '!' OR c.contact_name LIKE '".$keywords."%' ESCAPE '!' OR c.agency_gender LIKE '".$keywords."%' ESCAPE '!' OR c.agency_name LIKE '".$keywords."%' ESCAPE '!' OR c.email LIKE '".$keywords."%' ESCAPE '!' OR c.alias_name LIKE '".$keywords."%' ESCAPE '!' OR s.name LIKE '%".$keywords."%' ESCAPE '!' ) AND ".$where." AND `c`.`is_delete` = 0 AND `c`.`status` = 'Y' AND `c`.`purchase_plan` = 1 AND `c`.`is_verified` = 1 AND `c`.`slug` IS NOT NULL GROUP by c.id";
            
            $sql = str_replace("%male","male",$sql);
            $sql = str_replace("%Male","Male",$sql);
             $datas = array();
             $udatas  = $this->crud->getFromSQL($sql); 

             if(!empty($udatas)){
                foreach($udatas as $udata){
                    $datas[] = $udata;
                }
            }

             $sql = "SELECT `c`.* FROM `tbl_customer` `c`  INNER JOIN `country` `co` ON `co`.`country_id` = `c`.`country_id` INNER JOIN `state` `st` ON `st`.`state_id` = `c`.`state_id` INNER JOIN `city` `ci` ON `ci`.`id` = `c`.`city_id` left JOIN `location` `l` ON `l`.`user_id` = `c`.`id`  WHERE ( c.fname LIKE '".$keywords."%' ESCAPE '!' OR  c.lname LIKE '".$keywords."%' ESCAPE '!' OR c.contact_name LIKE '".$keywords."%' ESCAPE '!' OR c.agency_gender LIKE '".$keywords."%' ESCAPE '!' OR c.agency_name LIKE '".$keywords."%' ESCAPE '!' OR c.email LIKE '".$keywords."%' ESCAPE '!' OR c.alias_name LIKE '".$keywords."%' ESCAPE '!') AND ".$where." AND `c`.`is_delete` = 0 AND `c`.`status` = 'Y' AND `c`.`purchase_plan` = 1 AND `c`.`is_verified` = 1 AND `c`.`user_role`= 4 AND `c`.`slug` IS NOT NULL GROUP by c.id";
            
             $sql = str_replace("%male","male",$sql);
             $sql = str_replace("%Male","Male",$sql);
             
            $a_datas  = $this->crud->getFromSQL($sql); 

            if(!empty($a_datas)){
                foreach($a_datas as $a_data){
                    $datas[] = $a_data;
                }
            }
        }
        
        
        $map_array = array();
        $html = "";
        //echo $this->db->last_query();
        // echo "<pre>";
        // print_r($datas);
        // exit;
        foreach($datas as $data){
    
            $image_path     = $data->profile_image;

            $prd_exist = UPLOAD_DIR.USER_PROFILE_IMG.$image_path;
            
            if($data->user_role == 4)
            {
                $str = strtolower($data->slug);
                $urls = base_url()."agency/details/".$str."/";
                $title = $data->agency_name;
                
            }
            else
            {
                $str = strtolower($data->slug);
                $urls = base_url()."user/details/".$str."/";
                $title = $data->fname." ".$data->lname;
            }

            if(file_exists($prd_exist) && $image_path!="") 
            {
                $prd_preview = base_url().UPLOAD_DIR.USER_PROFILE_IMG.$image_path;
            } 
            else 
            {
                $prd_preview = base_url().UPLOAD_DIR.'default.png';
            }
        
            $country_name = $this->crud->get_column_value_by_id("country","name","country_id = ".$data->country_id);
            $state_name = $this->crud->get_column_value_by_id("state","name","state_id = ".$data->state_id);
            $city_name = $this->crud->get_column_value_by_id("city","name","id = ".$data->city_id);
            $address = $city_name." ".$state_name." ".$country_name;
            $latlog = $this->getLatLong($address);
            // echo $address; exit;


            // $title = $data->fname." ".$data->lname;
            $title1 = '<a href="'.$urls.'"><div class="map-inline-content"><img src="'.$prd_preview.'" alt="'.$title.'" /></a> <h5>'.$title.'</h5><h6>'.$state_name .','.$city_name.'</h6></div>';
            $array = [
                "type"=> "Feature",
                "geometry"=> [
                    "type"=> "Point",
                    "coordinates"=> [$latlog['longitude'], $latlog['latitude']]
                ],
                "properties"=> [
                    "title"=> $title1,
                    "icon"=> [
                        "iconUrl"=> FRONT_IMG."logo/map_marker.png",
                        "iconSize"=> [50, 50], // size of the icon
                        "iconAnchor"=> [25, 25], // point of the icon which will correspond to marker's location
                        "popupAnchor"=> [0, -25], // point from which the popup should open relative to the iconAnchor
                        "className"=> "dot titlenone"
                    ]
                ]
            ];
            array_push($map_array,$array);

            $html .= '<div class="col-lg-2 col-md-4 col-sm-3 boxprofile">
                            <p>'.$title.'</p>
                            <a href="'.$urls.'"><img src="'.$prd_preview.'" alt="image"></a>
                        </div>';
            
           // $locationlists = $this->crud->get_all_with_where('location','id','asc',array('isDelete'=>0,'user_id'=>$data->id));
            
            
            // if($data->id != 136 && $data->id != 143 && $data->id != 142){
            // foreach($locationlists as $location)
            // {
    
            //     $c_name = $this->crud->get_column_value_by_id("country","name","country_id = ".$location->country_id);
                
                

            //     $s_name = $this->crud->get_column_value_by_id("state","name","state_id = ".$location->state_id);

            //     $citylists = explode(",",$location->city_id);
                

            //     foreach($citylists as $citys)
            //     {
                   
            //         $city_name = $this->crud->get_column_value_by_id("city","name","id = ".$citys);
                    
            //         $address = $city_name." ".$s_name." ".$c_name;
                    
            //             $latlog = $this->getLatLong($address);
            //             // echo $address; exit;


            //             // $title = $data->fname." ".$data->lname;
            //             $title1 = '<a href="'.$urls.'"><div class="map-inline-content"><img src="'.$prd_preview.'" alt="'.$title.'" /></a> <h5>'.$title.'</h5><h6>'.$state_name .','.$city_name.'</h6></div>';
            //             $array = [
            //                 "type"=> "Feature",
            //                 "geometry"=> [
            //                     "type"=> "Point",
            //                     "coordinates"=> [$latlog['longitude'], $latlog['latitude']]
            //                 ],
            //                 "properties"=> [
            //                     "title"=> $title1,
            //                     "icon"=> [
            //                         "iconUrl"=> FRONT_IMG."logo/map_marker.png",
            //                         "iconSize"=> [50, 50], // size of the icon
            //                         "iconAnchor"=> [25, 25], // point of the icon which will correspond to marker's location
            //                         "popupAnchor"=> [0, -25], // point from which the popup should open relative to the iconAnchor
            //                         "className"=> "dot titlenone"
            //                     ]
            //                 ]
            //             ];
            //             array_push($map_array,$array);
            //     }

            // }
            // }
           


        // echo "<pre>";
        // print_r($map_array); exit;
        }

        $c_tatlog = $this->getcountryLatLong($state_name." ".$country_name);
        
       

        $return = array(
            "html" => $html,
            "map" => $map_array,
            "longitude" => $c_tatlog['longitude'],
            "latitude" => $c_tatlog['latitude']
        );
        echo json_encode($return);
        exit;

    } 


    function getLatLong($address){
        if(!empty($address)){
            //Formatted address
            $formattedAddr = str_replace(' ','+',$address);
            //Send request and receive json data by address
            $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false&key=AIzaSyBMfR2DDfCXkbn-5_vaSiyyrHY-jcWwszk');
            $output = json_decode($geocodeFromAddr);

            //Get latitude and longitute from json data
            $data['latitude']  = $output->results[0]->geometry->location->lat; 
            $data['longitude'] = $output->results[0]->geometry->location->lng;
            //Return latitude and longitude of the given address
            if(!empty($data)){
                return $data;
            }else{
                return false;
            }
        }else{
            return false;   
        }
    }


    function getcountryLatLong($address){
        if(!empty($address)){
            //Formatted address
            $formattedAddr = str_replace(' ','+',$address);
            //Send request and receive json data by address
            $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false&key=AIzaSyBMfR2DDfCXkbn-5_vaSiyyrHY-jcWwszk');
            $output = json_decode($geocodeFromAddr);

            //Get latitude and longitute from json data
            $data['latitude']  = $output->results[0]->geometry->location->lat; 
            $data['longitude'] = $output->results[0]->geometry->location->lng;
            //Return latitude and longitude of the given address
            if(!empty($data)){
                return $data;
            }else{
                return false;
            }
        }else{
            return false;   
        }
    }


    function getCountryName(){
        $post = $this->input->post();
        // echo "<pre>";
        // print_r($post); exit;

        $latitude = $post['latitude'];
        $longitude = $post['longitude'];


        $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latitude.','.$longitude.'&sensor=false&key=AIzaSyBMfR2DDfCXkbn-5_vaSiyyrHY-jcWwszk');

        // echo "<pre>";
        // print_r($geocode); exit;

        $output= json_decode($geocode);
        
        for($j=0;$j<count($output->results[0]->address_components);$j++){
        
            $cn=array($output->results[0]->address_components[$j]->types[0]);
        
            if(in_array("country", $cn)){
                $country= $output->results[0]->address_components[$j]->long_name;
            }
        }
        
        echo $country;

    }


}