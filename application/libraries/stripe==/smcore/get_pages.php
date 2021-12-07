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
$response = "";
if($action=="page")
{
	$siteId_temp = $_POST['s'];
	$path 		= $db->clean($_POST['path']);
	$siteId 	= $db->clean($_POST['siteId']);
	$planId 	= $db->clean($_POST['planId']);
	$memberId 	= $db->clean($_POST['memberId']);
	
	$link = $db->mm_getSiteUrl($siteId_temp."/member/sign_in/");

	if($memberId != "")
	{

	}
	else
	{
		$db->rplocation($link);
	}
}
