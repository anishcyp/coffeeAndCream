<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

date_default_timezone_set('Asia/Kolkata');
include("../connect.php");

$action = isset($_POST["action"]) ? $_POST["action"] : "";

if($action=="contentpage")
{
	$siteId_temp 	= 	$_POST['s'];
	$planId 		= 	$db->clean($_POST['planId']);
	$memberId 		= 	$db->clean($_POST['memberId']);
	$container_arr 	= 	$db->clean($_POST['container']);
	
	$my_content = '';
	
	if($siteId_temp != "" && $planId!='' && $memberId!='' && $container_arr!='')
	{
		//code for view container
		$exp_content = explode(",",$container_arr);
		
		$data = array();
		$response = array();
		for($i=0; $i<count($exp_content); $i++)
		{
			
			$content_r= $db->rpgetData("content_container",'*',"site_id = '".$siteId_temp."' AND `id` = '".$exp_content[$i]."' AND isDelete=0");
			if(mysql_num_rows($content_r) > 0)
			{ 
				$content_d =  mysql_fetch_array($content_r);
				
				$enduser_plan_r = $db->rpgetData("member_user_payment",'*',"site_id='".$siteId_temp."' AND member_id = '".$memberId."' AND plan_id = '".$planId."' AND isDelete=0");
				$enduser_plan_c = mysql_num_rows($enduser_plan_r);
			
				$count_day_visible 	= 	0;
				$count_visible		= 	0;
				$wait_day_visible 	= 	0;
				
				if($enduser_plan_c > 0)
				{	
					while($enduser_plan_d =  mysql_fetch_array($enduser_plan_r))
					{
						$exp_plans = explode(",",$content_d['plans']);
						foreach($exp_plans as $exp_plan)
						{
							
							if($exp_plan==$enduser_plan_d['plan_id'])
							{
								if($content_d['days_until_drip']!='')
								{
									$purchase_date = date("Y-m-d",strtotime($enduser_plan_d['created_at']));
									$generate_date = strtotime("+".$content_d['days_until_drip']." days", strtotime($purchase_date));
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
					$my_content.='<div class="rowmain">';
					
						if(!empty($content_d['document_id']))
						{
							$exp_docid = explode(",",$content_d['document_id']);
								
								for($d=0; $d<count($exp_docid); $d++)
								{
								
									$doc_r= $db->rpgetData("content_documents",'*',"site_id = '".$siteId_temp."' AND user_id = '".$content_d['user_id']."' AND id='".$exp_docid[$d]."' AND isDelete=0");
									$doc_d =  mysql_fetch_array($doc_r);

									$folder_file = EMBEDS_FILE."{$doc_d['user_id']}/{$doc_d['site_id']}/";
									$folder_cover = EMBEDS_COVER_IMG."{$doc_d['user_id']}/{$doc_d['site_id']}/";
								
									if(!empty($doc_d['cover_image']))
									{
										$dis_link = SITEURL.$folder_cover.$doc_d['cover_image'];
									}else{
										$dis_link = SITEURL.$folder_file.$doc_d['file_name'];
									}
									
									$my_content.='<div class="colsm'.$content_d['content_per_row'].'">';
									
										$my_content.='<img src="'.$dis_link.'">';
									
									if($content_d['show_titles']==1)
									{
										$my_content.='<h4>'.$doc_d['title'].'</h4>';
									}
									
									if($content_d['show_descriptions']==1)
									{
										$my_content.='<p>'.$doc_d['description'].'</p>';
									} 
									
									$my_content.='</div>';
								}
						}
						
					$my_content.='</div>';
					
					$response['c_id'] = $exp_content[$i];
					$response['msg'] = $my_content;
				} 
				else if($count_day_visible > 0)
				{
					
					$my_content.='<div class="rowmain">';
					
						if(!empty($content_d['document_id']))
						{
							$exp_docid = explode(",",$content_d['document_id']);
								
								for($d=0; $d<count($exp_docid); $d++)
								{
								
									$doc_r= $db->rpgetData("content_documents",'*',"site_id = '".$siteId_temp."' AND user_id = '".$content_d['user_id']."' AND id='".$exp_docid[$d]."' AND isDelete=0");
									$doc_d =  mysql_fetch_array($doc_r);

									$folder_file = EMBEDS_FILE."{$doc_d['user_id']}/{$doc_d['site_id']}/";
									$folder_cover = EMBEDS_COVER_IMG."{$doc_d['user_id']}/{$doc_d['site_id']}/";
								
									if(!empty($doc_d['cover_image']))
									{
										$dis_link = SITEURL.$folder_cover.$doc_d['cover_image'];
									}else{
										$dis_link = SITEURL.$folder_file.$doc_d['file_name'];
									}
									
									$my_content.='<div class="colsm'.$content_d['content_per_row'].'">';
									
										$my_content.='<img src="'.$dis_link.'">';
									
									if($content_d['show_titles']==1)
									{
										$my_content.='<h4>'.$doc_d['title'].'</h4>';
									}
									
									if($content_d['show_descriptions']==1)
									{
										$my_content.='<p>'.$doc_d['description'].'</p>';
									} 
									
									$my_content.='</div>';
								}
						}
						
					$my_content.='</div>';
					
					$response['c_id'] = $exp_content[$i];
					$response['msg'] = $my_content;
				}
				else if($wait_day_visible > 0)
				{
					$response['c_id'] = $exp_content[$i];
					$response['msg'] = "<div class='alerts alerts-danger'><strong>You can visible this content document after ".$days." days</strong></div>";
				}
				else  
				{
					$response['c_id'] = $exp_content[$i];
					$response['msg'] = "<div class='alerts alerts-danger'><strong>You don't have permission to access</strong></div>";
				}
			}
			else
			{
				$response['c_id'] = $exp_content[$i];
				$response['msg'] = "<div class='alerts alerts-danger'><strong>You don't have permission to access</strong></div>";
			}
			
			$data[] = $response;
		}
		 
	}
	else
	{
		$response['c_id'] = '';
		$response['msg'] = '';
	}
	
	echo json_encode($data);
}
?>