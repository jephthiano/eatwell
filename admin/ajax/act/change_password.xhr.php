<?php
if(isset($_POST["ps"]) && isset($_POST["ps2"]) && isset($_POST["ps3"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
	$error = []; $data = [];
	// validating and sanitizing old_password
	$old_pass = ($_POST['ps']);
	if(empty($old_pass)){$error['pse'] = "* field cannot be empty";}else{$old_password = test_input($old_pass);}
	
	// validating and sanitizing new_password
	$new_pass = ($_POST['ps2']);
	if(empty($new_pass)){$error['pse2'] = "* field cannot be empty";}else{$new_password = test_input($new_pass);}
	
	// validating and sanitizing re_password
	$re_pass = ($_POST['ps3']);
	if(empty($re_pass)){$error['pse3'] = "* field cannot be empty";}else{$re_password = test_input($re_pass);}
	
	if((strlen($old_pass) < 7) || (strlen($new_pass) < 7) || (strlen($re_pass) < 7 )){
		$error['alle'] = "* Passwords must be more than 6 characters<br>";
	}elseif($new_pass !== $re_pass){ //if passwords do not match
		$error['alle'] = "* Passwords not match <br>";
	}elseif(!password_verify($old_pass,content_data('admin_table','ad_password',$adid,'ad_id'))){
		$error['alle'] = "* Incorrect Password <br>";
	}elseif($old_pass === $new_pass){
		$error['alle'] = "* Current password cannot be used as new password <br>";
	}else{
    	$newpass = hash_pass(test_input($new_pass));
  	}
	
	if(empty($error)){
		$admin = new admin('admin');
		$admin->id = $adid;
		$admin->new_password = $newpass;
		$change_password = $admin->change_password();
		if($change_password === true){
			$data["status"] = 'success';$data["message"] = "Success!!!<br>Password successfully changed";
			//INSERT LOG
			$log = new log('admin');
			$log->brief = "changed password";
			$log->details = "changed his/her password";
			$log->insert_log();
		}elseif($change_password === false){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occcur while changing password";
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>