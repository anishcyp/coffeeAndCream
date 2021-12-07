<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontController.php';

class BlogController extends FrontController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud', 'crud'); 
        $this->table = 'blog';
        // $this->isUserLogin();
        $this->load->library('Ajax_pagination.php');
    }

    // ************************** Main Listing *************
    public function index() 
    {
        $data = array();
        $data['pageTitle'] = 'Latest Stripper, Kissograms, Hen Party Blogs at Coffee & Cream'; 
        $this->load->view(FRONTEND."blog/show",$data);    
    }

    public function category($cate_slug)
    {
      $data = array();
      $data['cate_slug'] = $cate_slug; 
      $data['pageTitle'] = 'Latest Stripper & Kissograms Blog '; 
      $this->load->view(FRONTEND."blog/show",$data);
    }

    public function search($search_keyword)
    {
      $data = array();
      $data['search_keyword'] = $search_keyword; 
      $data['pageTitle'] = 'Blog'; 
      $this->load->view(FRONTEND."blog/show",$data);
    }

    public function ajaxPaginationData()
    {
      $params = array();
      $page = $this->input->post('page');
      
      if(!$page) { $offset = 0; } else { $offset = $page; }
    
      $perpage = $this->input->post('perpage');
      $this->perPage = $perpage;

      $join['select'] = 'b.*';
      $join['table'] = 'blog b';
      
      $cate_slug    = $_REQUEST['cate_slug'];
      if(!empty($cate_slug))
      {
        $cate_id = $this->crud->get_column_value_by_id("blog_category","id","slug='".$cate_slug."'");
        $wh = array("b.isDelete" => 0, "b.status" => 'Y', "b.blog_cate" => $cate_id,"b.service_type" => 1); 
      }
      else
      {
        $wh = array("b.isDelete" => 0, "b.status" => 'Y',"b.service_type" => 1); 
      }

      $keywords    = $_REQUEST['keywords'];
      if(!empty($keywords))
      {
        $params['like'] = array('b.title' => $keywords,"b.content" => $keywords);
      }
      $totalRec = count($this->crud->get_join($join,$wh,$params));

      $config['target']      = '#resultList';
      $config['base_url']    = base_url().'BlogController/ajaxPaginationData';
      $config['total_rows']  = $totalRec;
      $config['per_page']    = $this->perPage;
      $config['link_func']   = "searchFilter";
      
      $this->ajax_pagination->initialize($config);
            
      $params['ShortBy']     = "b.blog_id";
      $params['ShortOrder']  = "desc";
      $params['start']       = $offset;
      $params['Limit']       = $this->perPage;
      $data['posts']         = $this->crud->get_join($join,$wh,$params);
    
      $this->load->view(FRONTEND."blog/ajax_data",$data);
    }

    public function details($id) 
    {
      $is_valid_request = $this->crud->check_duplicate("blog",array("title_slug"=>$id,"isDelete"=>"0","status"=>'Y',"service_type" => 1));
      if($is_valid_request)
      {
          $data   = array();
          $params = array();

          $data['blog_details'] = $this->crud->get_one_row("blog",array("title_slug"=>$id,"isDelete"=>"0","status"=>'Y',"service_type" => 1));

          $data['pageTitle'] = $data['blog_details']['title']; 

          $this->load->view(FRONTEND."blog/details",$data);
      }
      else
      {
          $this->session->set_flashdata('error', 'Something went wrong.');
          redirect('blog');
      }
    }

    public function saveComment()
    {
        $user_id = $this->session->userdata('front_UserId');
        
        if(is_null($user_id)){
          $this->session->set_flashdata('error', 'Please login to your account.');
          $response['msg'] = "login";
          echo json_encode($response);exit();
        }
        $response = array();
        $post = $this->input->post();
        $this->form_validation->set_rules('message','Message ','trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $response['msg'] = "invalid_data";
        }
        else
        { 
            $user_id  = $this->session->userdata('front_UserId'); 
            $blog_id  = $post['blog_id'];
            $message  = $post['message'];
            $type     = $post['type'];

            $DataInfo = array(
                'blog_id'       =>  $blog_id,
                'uid'           =>  $user_id,
                'msg'           =>  $message,                
                'type'          =>  '0',                
                'status'        =>  'N',
            );

            if($type == "add")
            {
                $result = $this->crud->insert('blog_comment',$DataInfo);
                // echo $this->db->last_query(); die();

                if($result > 0)
                {
                  $response['msg'] = "success_insert";
                }
                else
                {
                  $response['msg'] = "something_wrong";
                }
            }
        }

        echo json_encode($response);
        die();
    }
    
    public function viewComment()
    {
      $user_id    = $this->session->userdata('front_UserId');
      $post       = $this->input->post();
      $response   = array();
      $data       = array();
      $params     = array();

      $blog_id    = $post['blog_id'];
      $page       = $post['page'];

      $offset     = 10*$page;
      $limit      = 10;
      
      $params['Limit']        = $limit;   
      $params['start']        = $offset;
      $params['ShortOrder']   = array("blog_id","desc");   
      $comment_r  = $this->crud->get_data("blog_comment",array("isDelete"=>'0',"type"=>'0',"status"=>'Y',"blog_id"=>$blog_id),$params);

      if(count($comment_r) > 0)
      {
        foreach($comment_r as $comment_d)
        {
          $msg        = $comment_d['msg'];
          $timestamp  = $comment_d['created_at'];
          
          if($user_id == $comment_d['uid'])
          {
            $user_data = $this->crud->get_one_row("tbl_customer",array("id"=>$comment_d['uid']));
            $company_data = $this->crud->get_one_row("tbl_customer",array("id"=>$user_data['id']));
            $full_name = "You";
            $user_img = base_url(UPLOAD_DIR.USER_PROFILE_IMG.$company_data['profile_image']);
            if($company_data['user_role'] == 4)
            {
              $str = strtolower($company_data['slug']);
              $details_url  = base_url()."agencies/".$str."/";
            }
            else
            {
              $str = strtolower($company_data['slug']);
              $details_url  = base_url()."user/details/".$str."/";
            }
           
            // echo $user_img; exit();
          }
          else
          {
            $user_data = $this->crud->get_one_row("tbl_customer",array("id"=>$comment_d['uid']));
            $company_data = $this->crud->get_one_row("tbl_customer",array("id"=>$user_data['id']));
            $full_name = ucfirst($company_data['fname'].''.$company_data['lname']);
            $user_img = base_url(UPLOAD_DIR.USER_PROFILE_IMG.$company_data['profile_image']);
            if($company_data['user_role'] == 4)
            {
              $str = strtolower($company_data['slug']);
              $details_url  = base_url()."agencies/".$str."/";
            }
            else
            {
              $str = strtolower($company_data['slug']);
              $details_url  = base_url()."user/details/".$str."/";
            }
            // echo $user_img; exit();
          }
          
          if($comment_d['type']==0)
          {
            $response['type']     = $comment_d['type'];
            $response['nm']       = $full_name;
            $response['user_img'] = $user_img;
            $response['user_url'] = $details_url;
            $response['dt']       = date("M d, Y",strtotime($timestamp));
            $response['uid']      = ($comment_d['uid']!="")? $comment_d['uid'] : "";
            $response['msg']      = ($msg!="")? $msg : "";
          }

          if(!empty($response))
          {
            $tot_blog = $this->crud->get_data("blog_comment",array("isDelete"=>'0',"type"=>'0',"status"=>'Y',"blog_id"=>$blog_id));

            $response['tot_count'] = count($tot_blog);
            $data[] = $response;
          }
        }
      }
      else
      {
        $data['msg'] = "Something_Wrong";
      }
      
      header("Content-Type: application/json", true);
      echo json_encode($data);
      exit; 
    }
    
    public function load_blogs()
    {
      $UserId = $this->session->userdata('front_UserId');
      // echo $UserId;
      /*$login_user_company = $this->crud->get_one_value("company",array("user_id" => $UserId),"company_id");*/

      $params = array();
      $page = $this->input->post('page');

      $join['select'] = 'b.*';
      $join['table'] = 'blog b';

       /*$join['joins'][] = array(
        'join_table' => 'tbl_customer c', 
        'join_by' => 'c.id = r.user_id', 
        'join_type' => 'inner');*/
      
      $wh = array("b.isDelete"=>0,"b.status"=>"Y","b.service_type"=>1);

      $onpage_record = 4;
      $offset = $onpage_record * $page;
      $limit = $onpage_record;

      $params['start']      = $offset;
      $params['Limit']      = $limit;
      $params['ShortBy']     = "b.blog_id desc";
      $params['ShortOrder']  = "";
      $data['posts']        = $this->crud->get_join($join,$wh,$params);
      // echo $this->db->last_query(); die();
      $this->load->view(FRONTEND."blog/loaddata",$data);
    }
}
