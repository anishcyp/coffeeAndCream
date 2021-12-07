<?php
class Cms_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_page($page) {
      $this->db->select("*");
      $this->db->from("cms_page");
      $wh = array("page"=>$page);
      $this->db->where($wh);
      $query = $this->db->get();
      $result = $query->result_array();
      return $result[0];
    }

    public function get_desc_contact() {
      $this->db->select("*");
      $this->db->from("description_contact_page");
      $query = $this->db->get();
      $result = $query->result_array();
      return $result;
    }
}

/* End of file blog_model.php */
/* Location: ./tumbleupon/models/blog_model.php */ 
?> 