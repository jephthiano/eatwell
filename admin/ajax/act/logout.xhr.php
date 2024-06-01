<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));

$admin = new admin();
$log_out = $admin->log_out();
if($log_out === true){
	$data["status"] = true;$data["message"] = file_location('admin_url','login/');
	//INSERT LOG
	$log = new log('admin');
	$log->admin_id = $adid;
	$log->admin_username =  content_data('admin_table','ad_username',$adid,'ad_id');
	$log->brief = 'Signed out';
	$log->details = "logged out";
	$log->insert_log('logout');
}elseif($log_out === false){
	$data["status"] = false;$data["message"] = "Error occur while running request";
}
echo json_encode($data);
?>