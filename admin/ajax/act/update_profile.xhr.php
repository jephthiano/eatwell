<?php
if(isset($_POST["em"]) && isset($_POST["un"]) && isset($_POST["fn"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
	$error = []; $data = [];
	// validating and sanitizing email
	$ema = ($_POST['em']);
	if(empty($ema)){
		$error['eme'] = "* email cannot be empty";
	}elseif(!regex('email',$ema)){
		$error['eme'] = "* invalid email";
	}elseif(content_data('admin_table','ad_id',$ema,'ad_email') !== false
			&& content_data('admin_table','ad_id',$ema,'ad_email') !== content_data('admin_table','ad_id',$adid,'ad_id')){
		$error['eme'] = "* email already taken";
	}else{$email = strtolower(test_input($ema));}
	
	// validating and sanitizing username
	$usr = ($_POST['un']);
	if(empty($usr)){
		$error['une'] = "* username cannot be empty";
	}elseif(content_data('admin_table','ad_id',$usr,'ad_username') !== false
			&& content_data('admin_table','ad_id',$usr,'ad_username') !== content_data('admin_table','ad_id',$adid,'ad_id')){
		$error['une'] = "* username already taken";
	}else{$username = strtolower(test_input($usr));}
	
	// validating and sanitizing fullname
	$full = ($_POST['fn']);
	if(empty($full)){$error['fne'] = "* fullname cannot be empty";}else{$fullname = strtolower(test_input($full));}
	
	if(empty($error) and empty($missing)){
		$admin = new admin('admin');
		$admin->id = $adid;
		$admin->email = $email;
		$admin->username = $username;
		$admin->fullname = $fullname;
		$update = $admin->update_profile();
		if($update === true){
			$data["status"] = 'success';$data["message"] = file_location('admin_url','admin/profile/');
			//INSERT LOG
			$log = new log('admin');
			$log->brief = 'profile updated';
			$log->details = "updated his/her profile";
			$log->insert_log();
		}elseif($update === false){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while updating profile";;
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>