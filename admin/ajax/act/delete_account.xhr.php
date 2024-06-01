<?php
if(isset($_POST["d"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
	$error = []; $data = [];
	$pass = ($_POST['d']);
	if(empty($pass)){
		$error['pse'] = "* password cannot be empty";
	}elseif(!password_verify($pass,content_data('admin_table','ad_password',$adid,'ad_id'))){
		$error['pse'] = "* Incorrect Password";
	}else{
		$password = test_input($pass);
	}
	
	if(empty($error)){
		$username = content_data('admin_table','ad_username',$adid,'ad_id');
		$admin = new admin('admin');
		$admin->id = $adid;
		$delete = $admin->delete_admin();
		if($delete === true){
			$data["status"] = 'success';$data["message"] = "Success!!!<br>Account successfully deleted";
			//INSERT LOG
			$log = new log('admin');
			$log->brief = 'account deleted by owner';
			$log->details = "<b>".ucfirst($username)."</b> deleted his/her account";
			$log->insert_log();
		}elseif($delete === false){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while deleting account";
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>