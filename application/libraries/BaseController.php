<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 
    
    
	class BaseController extends CI_Controller {

		protected $vendorId = '';
		protected $global = array ();
		
		
		public function response($data = NULL) {
			$this->output->set_status_header ( 200 )->set_content_type ( 'application/json', 'utf-8' )->set_output ( json_encode ( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) )->_display ();
			exit ();
		}
		
		
		
		function isLoggedIn() {
			$isLoggedIn = $this->session->userdata ( 'isLoggedIn' );

			if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE) {
				redirect ( ADMIN.'login' );
			} else {
				$this->vendorId = $this->session->userdata ( 'userId' );
				$this->global ['vendorId'] = $this->vendorId;
			}
		}
		
		/**
		 * This function is used to load the set of views
		 */
		function loadThis() 
		{
			$sitesetting = $this->SiteSetting_model->getSiteSetting();
			$headerInfo['site_name'] = $sitesetting[0]->site_name;
			$headerInfo['site_logo'] = $sitesetting[0]->site_logo;
			$headerInfo['site_favicon'] = $sitesetting[0]->site_favicon;
			$headerInfo['pageTitle'] = $sitesetting[0]->site_name .' : Access Denied';
		
			$layout_data['topbar'] = $this->load->view('admin/includes/topbar', $headerInfo, true);
			$layout_data['leftbar'] = $this->load->view('admin/includes/leftbar', $headerInfo, true);
			$layout_data['rightbar'] = $this->load->view('admin/includes/rightbar', $headerInfo, true);
			$layout_data['footer'] = $this->load->view('admin/includes/footer','',true);
			$layout_data['content_body'] = $this->load->view('admin/access', $headerInfo, true);
				
			$this->load->view('admin/layouts/main', $layout_data);
		}
		
		/**
		 * This function is used to logged out user from system
		 */
		function logout() 
		{
			$this->session->sess_destroy();
			
			redirect ( ADMIN.'login' );
		}

		
		function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){
			$sitesetting = $this->SiteSetting_model->getSiteSetting();
			$headerInfo['site_name'] = $sitesetting[0]->site_name;
			$headerInfo['site_logo'] = $sitesetting[0]->site_logo;
			$headerInfo['site_favicon'] = $sitesetting[0]->site_favicon;
			$headerInfo['pageTitle'] = $sitesetting[0]->site_name .' '. $headerInfo['pageTitle'];
			
			$layout_data['topbar'] = $this->load->view('admin/includes/topbar', $headerInfo, true);
			$layout_data['leftbar'] = $this->load->view('admin/includes/leftbar', $headerInfo, true);
			$layout_data['rightbar'] = $this->load->view('admin/includes/rightbar', $headerInfo, true);
			$layout_data['footer'] = $this->load->view('admin/includes/footer','',true);
			$layout_data['content_body'] = $this->load->view($viewName, $pageInfo, true);
				
			$this->load->view('admin/layouts/main', $layout_data);

		}
		
		
		function paginationCompress($link, $count, $perPage = 10, $segment = SEGMENT) {
			$this->load->library ( 'pagination' );

			$config ['base_url'] = base_url () . $link;
			$config ['total_rows'] = $count;
			$config ['uri_segment'] = $segment;
			$config ['per_page'] = $perPage;
			$config ['num_links'] = 5;
			$config ['full_tag_open'] = '<nav><ul class="pagination">';
			$config ['full_tag_close'] = '</ul></nav>';
			$config ['first_tag_open'] = '<li class="arrow">';
			$config ['first_link'] = 'First';
			$config ['first_tag_close'] = '</li>';
			$config ['prev_link'] = 'Previous';
			$config ['prev_tag_open'] = '<li class="arrow">';
			$config ['prev_tag_close'] = '</li>';
			$config ['next_link'] = 'Next';
			$config ['next_tag_open'] = '<li class="arrow">';
			$config ['next_tag_close'] = '</li>';
			$config ['cur_tag_open'] = '<li class="active"><a href="#">';
			$config ['cur_tag_close'] = '</a></li>';
			$config ['num_tag_open'] = '<li>';
			$config ['num_tag_close'] = '</li>';
			$config ['last_tag_open'] = '<li class="arrow">';
			$config ['last_link'] = 'Last';
			$config ['last_tag_close'] = '</li>';
		
			$this->pagination->initialize ( $config );
			$page = $config ['per_page'];
			$segment = $this->uri->segment ( $segment );
		
			return array (
					"page" => $page,
					"segment" => $segment
			);
		}

		function generalSetting()
		{
			$sitesetting = $this->SiteSetting_model->getSiteSetting();
			return $sitesetting[0];
		}


		public function send_mail_global($from_email,$to_email,$subject,$message) {
			$config = array();
			$config['smtp_port']= "465";
			$config['mailtype'] = 'html';
			$config['charset']  = "utf-8";
			$config['newline']  = "\r\n";
			$config['smtp_timeout']='30';
			$config['wordwrap'] = TRUE;
			// load Email Library 
			$this->load->library('email');

			$this->email->initialize($config);
			$this->email->from($from_email, SITE_NAME);
			$this->email->to($to_email);
			$this->email->subject($subject);
			$this->email->message($message);        

			//Send mail 
			if($this->email->send()) 
				return true;
			else
				return $this->email->print_debugger();
		}
		
		public function week_day_array()
		{
			$WEEK_DAY_ARRAY = array("1"=>"MONDAY","2"=>"TUESDAY","3"=>"WEDNESDAY","4"=>"THURSDAY","5"=>"FRIDAY","6"=>"SATURDAY","7"=>"SUNDAY");

			return $WEEK_DAY_ARRAY;
		}
		
		public function EmailSend($data = array())
        {
            include_once APPPATH.'third_party/class.phpmailer.php';
            
            $subject    = $data['Subject'];
            $to_email   = $data['ToEmail'];
            $from_mail  = $data['FromEmail'];
            $from_name  = $data['FromName'];
            $body       = $data['Message'];
    
            $mail       = new PHPMailer();
        
            $mail->SetFrom($from_mail,$from_name); // From email ID and from name
            if(is_array($to_email) && count($to_email) > 0){
                foreach ($to_email as $key => $email) {
                    if($email != '')
                        $mail->AddAddress(stripslashes(trim($email)));
                }
            } else {
                $mail->AddAddress(stripslashes(trim($to_email)));
            }
    
            if(isset($data['attach_file']))
            {
            	$mail->addAttachment($data['attach_file']);
            }
    
            $mail->Subject = $subject;
            $mail->MsgHTML($body);
            $result = $mail->Send();
            return $result;
        }
        
        public function SendMultiEmail($data = array())
		{
			include_once APPPATH.'third_party/class.phpmailer.php';
			
			$subject    = $data['Subject'];
			$to_email   = $data['ToEmail'];
			$from_mail  = $data['FromEmail'];
			$from_name  = $data['FromName'];
			$body       = $data['Message'];
			$ToBcc       = $data['ToBcc'];

			$mail       = new PHPMailer();
		
			$mail->SetFrom($from_mail,$from_name); // From email ID and from name
			if(is_array($to_email) && count($to_email) > 0){
				foreach ($to_email as $key => $email) {
					if($email != '')
						$mail->AddAddress(stripslashes(trim($email)));
				}
			} else {
				$mail->AddAddress(stripslashes(trim($to_email)));
			}
			if(isset($ToBcc)){
				if(is_array($ToBcc) && count($ToBcc) > 0){
					foreach ($ToBcc as $key => $email) {
						if($email != '')
							$mail->addBcc(stripslashes(trim($email)));
					}
				} else {
					$mail->addBcc(stripslashes(trim($ToBcc)));
				}
			}

			if(isset($data['attach_file']))
			{
				$mail->addAttachment($data['attach_file']);
			}

			$mail->Subject = $subject;
			$mail->MsgHTML($body);
			$result = $mail->Send();
			
			
			return $result;
		}

		
	}