<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

date_default_timezone_set('Asia/Kolkata');
include("../connect.php");

// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";

if($action=="protectedpage")
{
	$siteId_temp 	= 	$_POST['s'];
	$curr_url 		= 	$db->clean($_POST['curr_url']);
	$planId 		= 	$db->clean($_POST['planId']);
	$memberId 		= 	$db->clean($_POST['memberId']);
	
	$response = array();
	if(!empty($siteId_temp && $curr_url) && empty($planId && $memberId))
	{
		$pages_r= $db->rpgetData("protected_page",'*',"site_id = '".$siteId_temp."' AND page_url = '".$curr_url."' AND isDelete=0");
		if(mysql_num_rows($pages_r) > 0)
		{ 
			$link = $db->mm_getSiteUrl($siteId_temp."/member/sign_in/");
			$response['mylink'] = $link;
			$response['msg'] = 'login';
		}
		else
		{
			$response['mylink'] = '';
			$response['msg'] = '';
		}
	}
	else if($siteId_temp != "" && $curr_url!='' && $planId!='' && $memberId!='')
	{
		//code for protected page
		$pages_r= $db->rpgetData("protected_page",'*',"site_id = '".$siteId_temp."' AND `page_url` = '".$curr_url."' AND isDelete=0");
		if(mysql_num_rows($pages_r) > 0)
		{ 
			$pages_d =  mysql_fetch_array($pages_r);
			
			$enduser_plan_r = $db->rpgetData("member_user_payment",'*',"site_id='".$siteId_temp."' AND member_id = '".$memberId."' AND plan_id = '".$planId."' AND isDelete=0");
			$enduser_plan_c = mysql_num_rows($enduser_plan_r);
		
			$count_day_visible = 0;
			$count_visible = 0;
			$wait_day_visible = 0;
			if($enduser_plan_c > 0)
			{	
				while($enduser_plan_d =  mysql_fetch_array($enduser_plan_r))
				{
					$exp_plans = explode(",",$pages_d['plans']);
					foreach($exp_plans as $exp_plan)
					{
						
						if($exp_plan==$enduser_plan_d['plan_id'])
						{
							if($pages_d['day_till_workes']!='')
							{
								$purchase_date = date("Y-m-d",strtotime($enduser_plan_d['created_at']));
								$generate_date = strtotime("+".$pages_d['day_till_workes']." days", strtotime($purchase_date));
								$visible_date = date("Y-m-d",$generate_date);
								
								$current_date = date("Y-m-d");
								
								if($current_date > $visible_date)
								{
									$count_day_visible++;
								}
								else
								{
									$diff = abs(strtotime($visible_date) - strtotime($current_date));
									
									$years = floor($diff / (365*60*60*24));
									$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
									$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
									$wait_day_visible++;
								}
							}
							else
							{
									$count_visible++;
							}
						}
					}
				}	
			}

			if($count_visible > 0)
			{
				
				$response['mylink'] = $curr_url;
				$response['msg'] = 'permission';
			}
			else if($count_day_visible > 0)
			{
				$response['mylink'] = $curr_url;
				$response['msg'] = 'permission';
			}
			else if($wait_day_visible > 0)
			{
				$plans_r= $db->rpgetData("sites_plan",'*',"id = '".$planId."' AND isDelete=0 AND site_id='".$siteId_temp."'");
				$plans_d =  mysql_fetch_array($plans_r);
				$plans_c =  mysql_num_rows($plans_r);
				
				if($plans_c > 0)
				{
					$get_url = $plans_d['login_url'];
				}
				else
				{
					$site_r= $db->rpgetData("sites",'*',"id = '".$siteId_temp."' AND isDelete=0");
					$site_d =  mysql_fetch_array($site_r);
					$get_url = $site_d['squarespace_url'];
				}
				
				$response['mylink'] 	= $get_url;
				$response['msg'] 		= 'day_till_permission';
				$response['custom_msg'] = 'You can visible this page after '.$days.' days';
			}
			else
			{
				
				$plans_r= $db->rpgetData("sites_plan",'*',"id = '".$planId."' AND isDelete=0 AND site_id='".$siteId_temp."'");
				$plans_d =  mysql_fetch_array($plans_r);
				$plans_c =  mysql_num_rows($plans_r);
				
				if($plans_c > 0)
				{
					$get_url = $plans_d['login_url'];
				}
				else
				{
					$site_r= $db->rpgetData("sites",'*',"id = '".$siteId_temp."' AND isDelete=0");
					$site_d =  mysql_fetch_array($site_r);
					$get_url = $site_d['squarespace_url'];
				}
				
				$response['mylink'] = $get_url;
				$response['msg'] = "nopermission";
			}
		}
		else
		{
			$response['mylink'] = '';
			$response['msg'] = '';
		}
		
	}
	else
	{
		$response['mylink'] = '';
		$response['msg'] = '';
	}
	
	echo json_encode($response);
}
?>