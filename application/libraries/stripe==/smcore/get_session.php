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

if($action == "session")
{
	print_r($_POST);
}
else
	echo "none";
?>