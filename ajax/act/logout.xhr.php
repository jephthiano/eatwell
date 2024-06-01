<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
$user = new user();
$log_out = $user->log_out();
if($log_out === true){
	$data["status"] = true;$data["message"] = file_location('home_url','');
}elseif($log_out === false){
	$data["status"] = false;$data["message"] = "Error occur while running request";
}
echo json_encode($data);
?>