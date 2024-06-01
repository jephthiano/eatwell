<?php
if(isset($_POST["d"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$error = []; $data = [];
	$pass = ($_POST['d']);
	if(empty($pass)){
		$error['pse'] = "* password cannot be empty";
	}elseif(!password_verify($pass,content_data('user_table','u_password',$u_id,'u_id'))){
		$error['pse'] = "* Incorrect Password";
	}else{
		$password = test_input($pass);
	}
	
	if(empty($error) and empty($missing)){
		$user = new user('admin');
		$user->id = $u_id;
		$delete = $user->delete_user();
		if($delete === true){
			$data["status"] = 'success';$data["message"] = "Success!!!<br>Account successfully deleted";
		}elseif($delete === false){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while deleting account";
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>