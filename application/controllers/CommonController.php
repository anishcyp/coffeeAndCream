  <?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class CommonController extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {

        parent::__construct();
        //$this->isLoggedIn();  
        $this->load->model('Crud', 'crud'); 
        $this->table = 'city';
    }

    function changeStatus()
    {   
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $table_name = base64_decode( $this->input->post('td') );
        $field = base64_decode( $this->input->post('i') );
        $data_array = array('status'=> $status);
        $where_array = array($field => $id);
        $result = $this->crud->update($table_name,$data_array,$where_array);

        if ($result > 0) {
            echo(json_encode(array('status'=>TRUE))); 
        }
        else { 
            echo(json_encode(array('status'=>FALSE))); 
        }
        
    }

    function changeStatusAgency()
    {   
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $table_name = base64_decode( $this->input->post('td') );
        $field = base64_decode( $this->input->post('i') );
        $data_array = array('agency_status'=> $status);
        $where_array = array($field => $id);
        $result = $this->crud->update($table_name,$data_array,$where_array);

        if ($result > 0) {
            echo(json_encode(array('status'=>TRUE))); 
        }
        else { 
            echo(json_encode(array('status'=>FALSE))); 
        }
        
    }


    public function active_deactive()
    {
        require_once('application/libraries/new_stripe/init.php');

        $stripe = new \Stripe\StripeClient(
            STRIPE_SECRET_KEY
        );

        $id = $this->input->post('id');
        $sub_id = $this->input->post('sub');
       
        
        $where_array = array('id' => $id);

        $data_delete = array('status' => '2');

        $result = $this->crud->update('purchase_plan',$data_delete,$where_array);

        $stripe->subscriptions->cancel(
          $sub_id,
          []
        );
        
        if ($result > 0) { 
            echo(json_encode(array('status'=>TRUE))); 
        }
        else { 
            echo(json_encode(array('status'=>FALSE))); 
        }
    }


    function plan_rotation()
    {
        // $user_id = $_SESSION[SESS_PRE.'_SESS_USER_ID'];
        $user_id = 6;
        $today_date = date("Y-m-d");  
        $package_expiration_date_get = '';
        // $today_date='2021-06-15 00:00:00';
        
        $row_a = $this->crud->get_all_with_where('purchase_plan','plan_nickname','desc',array('user_id'=>$user_id,'end_date != '=>'0000-00-00 00:00:00','status'=>'1'));

        $where = array('id' => $this->session->userdata('front_UserId'),'user_id'=>$user_id,'end_date != '=>'0000-00-00 00:00:00','status'=>'1' );

        $row_a = $this->crud->get_one_row("tbl_customer",$where );

       
         // echo "<pre>";    
        // print_r($row_a);
        // exit();

        if($today_date == $row_a['package_expiration_date'])
        {
            $rows   = array(
                "status" => 2,
            );
            $where =  "id = '".$row_a['id']."' AND isDelete=0";
            $update_date = $db->rpupdate("user_package", $rows, $where);

            $package_expiration_date_get = $row_a['package_expiration_date'];

            $where_b = "user_id = '".$user_id."' AND package_expiration_date != '0000-00-00 00:00:00' AND status=0 AND isDelete=0";
            $check_package_b = $db->rpgetData("user_package", "*", $where_b,'id ASC',1);
            $row_b = @mysqli_fetch_assoc($check_package_b);
            if($check_package_b)
            {
                $rows   = array(
                    "status" => 1,
                );
                $where =  "id = '".$row_b['id']."' AND isDelete=0";
                $update_date = $db->rpupdate("user_package", $rows, $where);
            }
            else
            {
                
            }
        }
    }

    function deleteData()
    {
            
        $id = $this->input->post('id');
        $table_name = base64_decode( $this->input->post('td') );
        $field = base64_decode( $this->input->post('i') );
        
        $where_array = array($field => $id);

        $data_delete = array('isDelete' => '1');

        $result = $this->crud->update($table_name,$data_delete,$where_array);
        //$result = $this->crud->delete($table_name,$where_array);
        
        if ($result > 0) { 
            echo(json_encode(array('status'=>TRUE))); 
        }
        else { 
            echo(json_encode(array('status'=>FALSE))); 
        }
    }

    
    function remove_packages()
    {
            
        $id = $this->input->post('id');
        
        $where_array = array("id" => $id);

        $data_delete = array('isDelete' => '1');

        $result = $this->crud->update('package_day',$data_delete,$where_array);
        //$result = $this->crud->delete($table_name,$where_array);
        
        if ($result > 0) { 
            echo(json_encode(array('status'=>TRUE))); 
        }
        else { 
            echo(json_encode(array('status'=>FALSE))); 
        }
    }

    function story_delete()
    {
        $post = $this->input->post();  
        $id = $this->input->post('id');
        $table_name = base64_decode( $this->input->post('td') );
        $field = base64_decode( $this->input->post('i') );
        // echo $post['user']; exit;
        $where = array('user_id' => $post['user']);
        $data = array('isDelete' => '1');
        $results = $this->crud->update('stories',$data,$where);

        $where_array = array($field => $id);
        $data_delete = array('isDelete' => '1');
        $result = $this->crud->update($table_name,$data_delete,$where_array);
       
        
        if ($result > 0) { 
            echo(json_encode(array('status'=>TRUE))); 
        }
        else { 
            echo(json_encode(array('status'=>FALSE))); 
        }
    }

    function deleteLoctionData()
    {
            
        $id = $this->input->post('id');
        $table_name = $this->input->post('td');
        
        $where_array = array('id' => $id);

        $data_delete = array('isDelete' => '1');

        $result = $this->crud->update($table_name,$data_delete,$where_array);
        //$result = $this->crud->delete($table_name,$where_array);
        
        if ($result > 0) { 
            echo(json_encode(array('status'=>TRUE))); 
        }
        else { 
            echo(json_encode(array('status'=>FALSE))); 
        }
    }

    function deleteDataPlan()
    {
        /*echo "<pre>";
        print_r($_REQUEST);
        exit();*/
        require_once('application/libraries/new_stripe/init.php');

        $stripe = new \Stripe\StripeClient(
            STRIPE_SECRET_KEY
        );
            
        $Plan_id = $this->input->post('id');
        $Product_id = $this->input->post('td');
        $field = 'stripe_product_id';
        
        $where_array = array($field => $Product_id);

        $Plan_res = $stripe->plans->delete(
          $Plan_id,
          []
        );

        $Product_res = $stripe->products->delete(
          $Product_id,
          []
        );

        $data_delete = array('isDelete' => '1');
        
        $result = $this->crud->update('membership_plan',$data_delete,$where_array);
        // echo $this->db->last_query(); die();
        //$result = $this->crud->delete($table_name,$where_array);
        
        if ($result > 0) { 
            echo(json_encode(array('status'=>TRUE))); 
        }
        else { 
            echo(json_encode(array('status'=>FALSE))); 
        }
    }

    

    function getEditRecord()
    {
        $field = base64_decode( $this->input->post('i') );
        $id = $this->input->post('id');
        $table_name = base64_decode( $this->input->post('td') );
        $result = $this->crud->get_row_by_id($table_name,' '.$field.' = '.$id.'  ');        
        echo json_encode($result);
    }

    function insertRecord()
    {
        $post = $this->input->post();
        /*echo "<pre>";
        print_r($post); exit();*/

        $this->load->library('form_validation');            
        $this->form_validation->set_rules('name','Name ','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $data["msg"]        = validation_errors();
            $data["msg_type"]   = 'error';
            echo json_encode($data);
            exit;
        }
        else
        {
            $table_name = base64_decode($this->input->post('td')); 
            $field      = base64_decode($this->input->post('i')); 
            $type       = $this->input->post('type'); 
            $editid     = $this->input->post('editid');
            $isActive   = ( isset($post['isActive']) && $post['isActive'] == 'on' ? 'Y' : 'N');
            $slug       = $this->slug->create_slug($post['name']);

            unset($post["editid"]);
            unset($post["type"]);
            unset($post["isActive"]);
            unset($post["td"]);
            unset($post["i"]);

            $post['slug']       = $slug;
            $post['created_at'] = date('Y-m-d H:i:s');
            $post['status']     = $isActive;

            if($type == "add")
            {
                $is_duplicate = $this->crud->check_duplicate($table_name,array("slug"=>$slug,"isDelete"=>"0"));
                if($is_duplicate)
                {
                    $data["msg"]        = 'Record already exists. Please try another.';
                }
                else
                {
                    $result = $this->crud->insert($table_name,$post);

                    if($result > 0)
                    {
                        $data["msg"]        = 'Record Added successfully';
                    }
                    else
                    {
                        $data["msg"]        = 'Something went wrong';
                    }
                }
            }

            if($type == "edit")
            {
                $editid = $this->input->post('editid'); 
                $is_duplicate = $this->crud->check_duplicate($table_name,array($field."!="=>$editid,"slug"=>$slug,"isDelete"=>"0"));
                if($is_duplicate)
                {
                    $data["msg"]        = 'Record already exists. Please try another.';
                }
                else
                {
                    $where_array = array($field=>$editid);
                    $result = $this->crud->update($table_name,$post,$where_array);

                    if($result > 0)
                    {
                        $data["msg"]        = 'Record Updated successfully';
                    }
                    else
                    {
                        $data["msg"]        = 'Something went wrong';
                    }
                }
            }
          
            echo json_encode($data);
            exit;
        }
    }


    function insertRecord1()
    {
        $post = $this->input->post();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('name','Name ','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $data["msg"]        = validation_errors();
            $data["msg_type"]   = 'error';
            echo json_encode($data);
            exit;
        }
        else
        {
            $table_name = base64_decode($this->input->post('td')); 
            $field      = base64_decode($this->input->post('i')); 
            $type       = $this->input->post('type'); 
            $editid     = $this->input->post('editid');
            $isActive   = ( isset($post['isActive']) && $post['isActive'] == 'on' ? 'Y' : 'N');
            $slug       = $this->slug->create_slug($post['name']);

            unset($post["editid"]);
            unset($post["type"]);
            unset($post["isActive"]);
            unset($post["td"]);
            unset($post["i"]);

            $post['slug']       = $slug;
            $post['service_type']   = $post['service'];
            $post['created_at'] = date('Y-m-d H:i:s');
            $post['status']     = $isActive;

            $fieldInfo = array(
                'name'              => $post['name'],
                'service_type'      => $post['service'],
                'slug'              => $slug,
                'status'            => $isActive,
            );

            if($type == "add")
            {
                $is_duplicate = $this->crud->check_duplicate($table_name,array("slug"=>$slug,"isDelete"=>"0"));
                if($is_duplicate)
                {
                    $data["msg"]        = 'Record already exists. Please try another.';
                }
                else
                {
                    $result = $this->crud->insert($table_name,$fieldInfo);

                    if($result > 0)
                    {
                        $data["msg"]        = 'Record '.$type.' successfully';
                    }
                    else
                    {
                        $data["msg"]        = 'Something went wrong';
                    }
                }
            }

            if($type == "edit")
            {
                $editid = $this->input->post('editid'); 
                $is_duplicate = $this->crud->check_duplicate($table_name,array($field."!="=>$editid,"slug"=>$slug,"isDelete"=>"0"));
                if($is_duplicate)
                {
                    $data["msg"]        = 'Record already exists. Please try another.';
                }
                else
                {
                    $where_array = array($field=>$editid);
                    $result = $this->crud->update($table_name,$fieldInfo,$where_array);

                    if($result > 0)
                    {
                        $data["msg"]        = 'Record '.$type.' successfully';
                    }
                    else
                    {
                        $data["msg"]        = 'Something went wrong';
                    }
                }
            }
          
            echo json_encode($data);
            exit;
        }
       
    }


    function DescriptionInsert()
    {
        
        $post = $this->input->post();

        $this->load->library('form_validation');            
        $this->form_validation->set_rules('description','Description ','trim|required');


        if($this->form_validation->run() == FALSE)
        {
            $data["msg"]        = validation_errors();
            $data["msg_type"]   = 'error';
            echo json_encode($data);
            exit;
        }
        else
        {
            $table_name     = base64_decode($this->input->post('td')); 
            $field          = base64_decode($this->input->post('i'));
            $editid         = $this->input->post('editidDes');
            $description    = $this->input->post('description');

            unset($post["editid"]);
            unset($post["td"]);
            unset($post["i"]);

            $fieldInfo = array(
                'description'              => $description,
                'created_at'                => date('Y-m-d H:i:s'),
            );
            $editid = $this->input->post('editidDes'); 
            $where_array = array($field=>$editid);
            $result = $this->crud->update($table_name,$fieldInfo,$where_array);
            
            if($result > 0)
            {
                $data["msg"]        = 'Description Updated successfully';
            }
            else
            {
                $data["msg"]        = 'Something went wrong';
            }

            echo json_encode($data);
            exit;
        }
    }
    
    
    function HenstagDescrInsert()
    {
        
        $post = $this->input->post();
        // print_r($post); exit;
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('stag_description','Hen stag descrp.. ','trim|required');


        if($this->form_validation->run() == FALSE)
        {
            $data["msg"]        = validation_errors();
            $data["msg_type"]   = 'error';
            echo json_encode($data);
            exit;
        }
        else
        {
            $table_name     = base64_decode($this->input->post('td')); 
            $field          = base64_decode($this->input->post('i'));
            $editid         = $this->input->post('editidDesHen');
            $description    = $this->input->post('stag_description');
            // echo $editid; exit;
            $fieldInfo = array(
                'hen_description'   => $description,
                'created_at'        => date('Y-m-d H:i:s'),
            );
            
            $where_array = array('id'=>$editid);
            $result = $this->crud->update('city',$fieldInfo,$where_array);
            // echo $this->db->last_query(); die();
            
            if($result > 0)
            {
                $data["msg"]        = 'Hen stag Description Updated successfully';
            }
            else
            {
                $data["msg"]        = 'Something went wrong';
            }

            echo json_encode($data);
            exit;
        }
    }

    
    function getStateByCountry()
    {

        $id = $this->input->post('id');
        $result = $this->crud->get_all_with_where('state','name','asc',array('status'=>'Y','country_id'=>$id));
        
        if(!empty($result)){
            echo json_encode($result);
        }else{
            echo json_encode('blank');            
        }
    }


    function storiesget()
    {
        $result = $this->crud->get_all_with_where('stories','user_id','asc',array('status'=>'Y','isDelete'=>0));

        if(!empty($result)){
            echo json_encode($result);
        }else{
            echo json_encode('blank');            
        }
    }


    function getCityByState()
    {
        $id = $this->input->post('id');
        // echo $id;exit();
        $result = $this->crud->get_all_with_where('city','name','asc',array('status'=>'Y','state_id'=>$id));

        if(!empty($result)){
            echo json_encode($result);
        }else{
            echo json_encode('blank');            
        }
    }
    

    function getEditStateDetails()
    {
        $country_id = $this->input->post('country_id');
        $state_id = $this->input->post('state_id');
        $result = $this->crud->get_all_with_where('state','name','asc',array('status'=>'Y','state_id'=>$id));
        if(!empty($result)){
            echo json_encode($result);
        }else{
            echo json_encode('blank');            
        }
    }
    
    function getCityAreaByCity()
    {
        $id = $this->input->post('id');
        $result = $this->crud->get_all_with_where('city_area','name','asc',array('status'=>'Y','city_id'=>$id))  ;
        if(!empty($result)){
            echo json_encode($result);
        }else{
            echo json_encode('blank');            
        }
       
    }

   function isTimeSet()
    {
        $times = $this->session->userdata('SetTime');

        // only if user is logged in do the checking
        if (isset($times)) {
          
          // change the time as per your convenience, it is in seconds
          if ((time() - $times) > 900) 
          {
            $this->session->set_flashdata('error', 'Your welcome kit is expired purchase membership plan.');
            redirect("membership-plan");
            exit;
          } 
          else 
          {
            $this->session->set_userdata('SetTime',time());
          }
        }
    }

    function isUserLogin() 
    {
        $user_id = $this->session->userdata('front_UserId');
        if(!isset($user_id) && $user_id == '') 
        {
            $this->session->set_flashdata('error', 'Please login to your account.');
            redirect("SignIn");
        }
        else
        {
            $valid_login = $this->crud->check_duplicate("tbl_customer",array("is_delete"=>0,"id"=>$user_id,"status"=>'Y',"is_verified"=>1));
            if($valid_login)
            { 
                $invalid_role = $this->crud->check_duplicate("tbl_customer",array("user_role"=>0,"id"=>$user_id));
                if($invalid_role)
                { 
                    $this->session->set_flashdata('error', 'Please select a role, inorder to use your account.');
                    redirect('user-role');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Please login to your account.');
                redirect('logout');
            }
        }
    }

    function store()
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('title','Title ','trim|required');
        $this->form_validation->set_rules('question','Question ','trim|required');
        $this->form_validation->set_rules('descr','Description ','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            redirect('admin/manage-faq');
        }
        else
        { 
            $type                   = $post['type']; 
            
            $status   = ( isset($post['isActive']) && $post['isActive'] == 'on' ? 'Y' : 'N');
            // echo $status;exit;
            $user_id = $this->session->userdata('userId');

            $dealInfo = array(
                'title'         =>  $post['title'],
                'question'      =>  $post['question'],
                'descr'         =>  $post['descr'],
                'status'        =>  $status,
            );

            if($type == "add")
            {
                $result = $this->crud->insert('faq',$dealInfo);
                if($result > 0)
                {
                    $data['msg']=  'Details Inserted successfully';
                }
                else
                {
                    $data['msg']= 'Something went wrong';
                }
            }

            if($type == "edit")
            {
                $editid = $this->input->post('editid'); 
                $result = $this->crud->update('faq',$dealInfo,array("id"=>$editid));

                if($result > 0)
                {
                    $data['msg']=  'Details Updated successfully';
                }
                else
                {
                    $data['msg']= 'Something went wrong';
                }
            }
            echo json_encode($data);
            exit;
        }

    }    

    function terms_store()
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('title','Title ','trim|required');
        $this->form_validation->set_rules('descr','Description ','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            redirect('admin/manage-terms');
        }
        else
        { 
            $type                   = $post['type']; 
            
            $status   = ( isset($post['isActive']) && $post['isActive'] == 'on' ? 'Y' : 'N');
            // echo $status;exit;
            $user_id = $this->session->userdata('userId');

            $dealInfo = array(
                'title'         =>  $post['title'],
                'descr'         =>  $post['descr'],
                'status'        =>  $status,
            );

            if($type == "add")
            {
                $result = $this->crud->insert('terms',$dealInfo);
                if($result > 0)
                {
                    $data['msg']=  'Details Inserted successfully';
                }
                else
                {
                    $data['msg']= 'Something went wrong';
                }
            }

            if($type == "edit")
            {
                $editid = $this->input->post('editid'); 
                $result = $this->crud->update('terms',$dealInfo,array("id"=>$editid));

                if($result > 0)
                {
                    $data['msg']=  'Details Updated successfully';
                }
                else
                {
                    $data['msg']= 'Something went wrong';
                }
            }
            echo json_encode($data);
            exit;
        }

    }  


    function watermark_image($target, $wtrmrk_file, $newcopy) {
        $watermark = imagecreatefrompng($wtrmrk_file);
        imagealphablending($watermark, false);
        imagesavealpha($watermark, true);
        $img = imagecreatefromjpeg($target);
        $img_w = imagesx($img);
        $img_h = imagesy($img);
        $wtrmrk_w = imagesx($watermark);
        $wtrmrk_h = imagesy($watermark);
        $dst_x = ($img_w / 2) - ($wtrmrk_w / 2); // For centering the watermark on any image
        $dst_y = ($img_h / 2) - ($wtrmrk_h / 2); // For centering the watermark on any image
        imagecopy($img, $watermark, $dst_x, $dst_y, 0, 0, $wtrmrk_w, $wtrmrk_h);
        imagejpeg($img, $newcopy, 100);
        imagedestroy($img);
        imagedestroy($watermark);
    }


    public function home_search()
    {
        $join['select'] = 'c.*';
        $join['table'] = 'tbl_customer c';
    
        $wh = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1);
    
        if(isset($_REQUEST['keywords']) && $_REQUEST['keywords']!="" && empty($_REQUEST['keyword_location']))
        {
            $join['joins'][] = array(
                'join_table' => 'service s', 
                'join_by' => 's.service_id = c.service_id ', 
                'join_type' => 'inner');
    
            $keywords = $_REQUEST['keywords'];
    
            $params['like'] = array("c.fname" => $keywords,"c.slug"=>$keywords,"c.lname" => $keywords,"c.email" => $keywords,"c.alias_name" => $keywords,"s.name" => $keywords);
        }
    
        if(isset($_REQUEST['keyword_location']) && $_REQUEST['keyword_location']!="" && empty($_REQUEST['keywords']))
        {
            $keyword_location = $_REQUEST['keyword_location'];
    
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
    
            $params['like'] = array("co.name" => $keyword_location,"sa.name" => $keyword_location,"ca.name" => $keyword_location);
        }
    
        $data['posts']        = $this->crud->get_join($join,$wh,$params);
        
        // echo "<pre>";
        // print_r($data['posts']); exit;
        //echo $this->db->last_query(); exit;
    
        $this->load->view(FRONTEND."ajax_home_service",$data);
    
    } 
    
    
    public function filter_view()
    {    
        $data = array();
        $post = $this->input->post();
       
        $formSubmit = $this->input->post('submit');
        $wh = array();
        if($formSubmit == 'search')
        { 
            $keyword_where = "";
            $where_location = "";
            $where = " AND `c`.`is_delete` = 0 AND `c`.`status` = 'Y' AND `c`.`purchase_plan` = 1 AND `c`.`is_verified` = 1";
            
            if(isset($post['keywords']) && $post['keywords'] != "" || isset($post['service_id']) && $post['service_id'] != ""){
                
                $keyword_where = " AND (";
                if(isset($post['keywords']) && $post['keywords'] != ""){
                    $keywords = $post['keywords'];
                    $keyword_where .= " c.fname LIKE '".$keywords."%' ESCAPE '!' OR c.lname LIKE '".$keywords."%' ESCAPE '!' OR c.email LIKE '".$keywords."%' ESCAPE '!' OR c.alias_name LIKE '".$keywords."%' ESCAPE '!' OR s.name LIKE '%".$keywords."%' ESCAPE '!'";
                }

                if(isset($post['service_id']) && $post['service_id'] != ""){
                    $service_id = $post['service_id'];
                    $keyword_where .= " c.fname LIKE '".$service_id."%' ESCAPE '!' OR c.lname LIKE '".$service_id."%' ESCAPE '!' OR c.email LIKE '".$service_id."%' ESCAPE '!' OR c.alias_name LIKE '".$service_id."%' ESCAPE '!' OR s.name LIKE '%".$service_id."%' ESCAPE '!'";
                }

                $keyword_where .= " )";
            }
                       
            if(isset($post['gender']) && $post['gender'] != ""){
                $gender = $post['gender'];
                $where .= " AND c.gender = '".$gender."'";
            }
            
            
            if(isset($post['city_id']) && $post['city_id'] != ""){
        
                $city_id =$this->crud->getFromSQL("SELECT name from city where id = ".$post['city_id']."");
                $keyword_location = $city_id[0]->name;
                $where_location .= "AND ( co.name LIKE '%".$keyword_location."%' ESCAPE '!' OR st.name LIKE '%".$keyword_location."%' ESCAPE '!' OR ci.name LIKE '%".$keyword_location."%' ESCAPE '!'";
        
                $where_location .= " or FIND_IN_SET(".$post['city_id'].", l.city_id))";
            }elseif(isset($post['state_id']) && $post['state_id'] != ""){
        
                $state_id =$this->crud->getFromSQL("SELECT name from state where state_id = ".$post['state_id']."");
                $keyword_location = $state_id[0]->name;
                $where_location .= "AND ( co.name LIKE '%".$keyword_location."%' ESCAPE '!' OR st.name LIKE '%".$keyword_location."%' ESCAPE '!' OR ci.name LIKE '%".$keyword_location."%' ESCAPE '!'";
        
                $where_location .= " or l.state_id = ".$post['state_id'].")";
            }elseif(isset($post['country_id']) && $post['country_id'] != ""){
                $country_id =$this->crud->getFromSQL("SELECT name from country where country_id = ".$post['country_id']."");
                $keyword_location = $country_id[0]->name;
                $where_location .= "AND ( co.name LIKE '%".$keyword_location."%' ESCAPE '!' OR st.name LIKE '%".$keyword_location."%' ESCAPE '!' OR ci.name LIKE '%".$keyword_location."%' ESCAPE '!'";
        
                $where_location .= " or l.country_id = ".$post['country_id'].")";
            }
            
            
            $sql = "SELECT `c`.* FROM `tbl_customer` `c` INNER JOIN `service` `s` ON FIND_IN_SET(s.service_id, c.service_id) INNER JOIN `country` `co` ON `co`.`country_id` = `c`.`country_id` INNER JOIN `state` `st` ON `st`.`state_id` = `c`.`state_id` INNER JOIN `city` `ci` ON `ci`.`id` = `c`.`city_id` left JOIN `location` `l` ON `l`.`user_id` = `c`.`id` WHERE 1 = 1 ".$keyword_where." ".$where_location." ".$where." GROUP by c.id";
            
            $sql = str_replace("%male","male",$sql);
            $sql = str_replace("%Male","Male",$sql);
            
            $datas  = $this->crud->getFromSQL($sql); 
            
            $data['posts'] = array();
            foreach($datas as $dat){
                
                $data['posts'][] = (array)$dat;    
            }
        
            $data['pageTitle']  = "Search list";
            //echo $this->db->last_query();
    
            $this->load->view(FRONTEND."search_filter",$data);
        }
        else
        {
            $this->session->set_flashdata('error', 'Something went wrong.');
            redirect(APP_URL);
        }
    }

    public function get_story()
    {
        
        $where = array("isDelete"=>0,"status"=>"Y");
        $list = $this->crud->get_all_with_where('stories','id','desc',$where);

        foreach ($list as $value) 
        {
            
            $db = "SELECT * FROM `stories_child` WHERE story_id=$value->id AND isDelete=0 AND status='Y' ";
            $plans = $this->crud->getFromSQL($db);
            $items = array();
            foreach($plans as $key => $details)
            {
                $image_path1     = $details->photo;
                $prd_exist1 = UPLOAD_DIR.STORIES.$image_path1;

                if(file_exists($prd_exist1) && $image_path1!="") 
                {
                    $prd_preview1 = base_url().UPLOAD_DIR.STORIES.$image_path1;
                } 
                else 
                {
                    $prd_preview1 = base_url().UPLOAD_DIR.'default.png';
                }
                
                $items[$key] = array(
                    "id" => $details->id,
                    "type"=> $details->type,
                    "length" => 10,
                    "src" => $prd_preview1,
                    "thumb" => $prd_preview1,
                    "preview" => "",
                    "description" => $details->description,
                    "time" => $details->time,
                    "seen" => false
                );
            }

            $where = array("id" => $value->user_id,"is_delete"=>0,"status"=>"Y","purchase_plan"=>1,"is_verified"=>1);
            $user_d = $this->crud->get_all_with_where('tbl_customer','fname','desc',$where);
            foreach($user_d as $users_i)
            {
                $str = strtolower($users_i->slug);
                $link  = base_url()."user/details/".$str."/";
                $image_path     = $users_i->profile_image;

                $prd_exist = UPLOAD_DIR.USER_PROFILE_IMG.$image_path;

                if(file_exists($prd_exist) && $image_path!="") 
                {
                    $prd_preview = base_url().UPLOAD_DIR.USER_PROFILE_IMG.$image_path;
                } 
                else 
                {
                    $prd_preview = base_url().UPLOAD_DIR.'default.png';
                }

                $cats = array('call' => $users_i->phone,
                                    'profile'  => $link  
                                );

                $data[] = array(
                    'id' => $value->lastUpdated,
                    'photo' => $prd_preview,
                    'link' => $link,
                    'fullName' => $users_i->fname.' '.$users_i->lname,
                    'name' => $users_i->fname,
                    'lastUpdated' => $value->lastUpdated,
                    'ctas' => $cats,
                    'items' => $items
                    
                );
            }
                   
        }   

        echo json_encode($data);
    }


    public function story()
    {
        $post = $this->input->post();
        
        $where = array("isDelete"=>0,"status"=>"Y","user_id"=>$post['user_id']);
        $list = $this->crud->get_all_with_where('stories','id','desc',$where);
        
        foreach ($list as $value) 
        {
            
            $db = "SELECT * FROM `stories_child` WHERE story_id=$value->id AND isDelete=0 AND status='Y' ";
            $plans = $this->crud->getFromSQL($db);
            $items = array();
            foreach($plans as $key => $details)
            {
                $image_path1     = $details->photo;
                $prd_exist1 = UPLOAD_DIR.STORIES.$image_path1;

                if(file_exists($prd_exist1) && $image_path1!="") 
                {
                    $prd_preview1 = base_url().UPLOAD_DIR.STORIES.$image_path1;
                } 
                else 
                {
                    $prd_preview1 = base_url().UPLOAD_DIR.'default.png';
                }
                
                $items[$key] = array(
                    "id" => $details->id,
                    "type"=> $details->type,
                    "length" => 10,
                    "src" => $prd_preview1,
                    "thumb" => $prd_preview1,
                    "preview" => "",
                    "description" => $details->description,
                    "time" => $details->time,
                    "seen" => false
                );
            }

            $where = array("id" => $value->user_id,"is_delete"=>0,"status"=>"Y","purchase_plan"=>1,"is_verified"=>1);
            $user_d = $this->crud->get_all_with_where('tbl_customer','fname','desc',$where);
            foreach($user_d as $users_i)
            {
                $str = strtolower($users_i->slug);
                $link  = base_url()."user/details/".$str."/";
                $image_path     = $users_i->profile_image;

                $prd_exist = UPLOAD_DIR.USER_PROFILE_IMG.$image_path;

                if(file_exists($prd_exist) && $image_path!="") 
                {
                    $prd_preview = base_url().UPLOAD_DIR.USER_PROFILE_IMG.$image_path;
                } 
                else 
                {
                    $prd_preview = base_url().UPLOAD_DIR.'default.png';
                }

                $cats = array('call' => $users_i->phone,
                                    'profile'  => $link  
                                );

                $data[] = array(
                    'id' => $value->lastUpdated,
                    'photo' => $prd_preview,
                    'link' => $link,
                    'fullName' => $users_i->fname.' '.$users_i->lname,
                    'name' => $users_i->fname,
                    'lastUpdated' => $value->lastUpdated,
                    'ctas' => $cats,
                    'items' => $items
                    
                );
            }
                   
        }   

        echo json_encode($data);
    }

    
    
    public function getServicesList()
    {

        $keyword = $this->input->post('keyword');
        
        if($keyword != "")
        {
            $tb_customer = $this->crud->get_all_with_where("tbl_customer","fname","asc",array("is_delete" => 0,"status"=>'Y',"alias_name like" => '%'.$keyword.'%'));
            
            $services = $this->crud->get_all_with_where("service","name","asc",array("status"=>'Y','isDelete'=>0,"name like" => '%'.$keyword.'%')); 

            $city = $this->crud->get_all_with_where("city","name","asc",array("isDelete" => 0,"status"=>'Y',"name like" => '%'.$keyword.'%'));

            $state = $this->crud->get_all_with_where("state","name","asc",array("isDelete" => 0,"status"=>'Y',"name like" => '%'.$keyword.'%'));

            $country = $this->crud->get_all_with_where("country","name","asc",array("isDelete" => 0,"status"=>'Y',"name like" => '%'.$keyword.'%'));

            $countryShort = $this->crud->get_all_with_where("country","name","asc",array("isDelete" => 0,"status"=>'Y',"country_code like" => '%'.$keyword.'%'));
            

            $array = [];
            $name = "";
           if(!empty($tb_customer) || !empty($services) || !empty($city) || !empty($state) || !empty($country))
           {
            ?>
                <ul id="agency-list">
                    
                    <!-- customer -->
                    <?php foreach($tb_customer as $data) { ?>
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

                    <!-- City location -->
                    <?php foreach($city as $data) { ?>
                        <li onClick="Select('<?= $data->name ?>');"><?= $data->name ?></li>
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
                                <li onClick="Select('<?= $data->name ?>');"><?= $data->name ?></li>
                            </ul>
                        </li>
                    <?php  } ?>

                    <!-- Country location -->
                    <?php foreach($country as $data) { ?>
                        <li class="search-list-inner-data">
                            <label><b>Country</b></label>
                            <ul>
                                <li onClick="Select('<?= $data->name ?>');"><?= $data->name ?></li>
                            </ul>
                    </li>    
                    <?php  } ?>

                    
                    
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