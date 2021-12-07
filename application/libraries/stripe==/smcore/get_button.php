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
if($action=="login")
{
	$siteId_temp = $_POST['s'];
	
	$link = $db->mm_getSiteUrl($siteId_temp."/member/sign_in/");
	
	?>
	<div class="buttonfixed">
		<a onclick="window.location.href='<?php echo $link;?>'">LOG IN / SIGN UP</a>
	</div>
	<?php
}

if($action=="account")
{
	$siteId 	= $_POST['siteId'];
	$planId 	= $_POST['planId'];
	$memberId 	= $_POST['memberId'];
	
	$link = $db->mm_getSiteUrl($siteId_temp."sites/".$siteId."/account/".$memberId."/");
	
	?>
	<div class="buttonfixed">
		<a onclick="window.location.href='<?php echo $link;?>'">YOUR ACCOUNT</a>
	</div>
	<?php
}?>