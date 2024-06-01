<?php
if(isset($_POST["em"]) && isset($_POST["fn"]) && isset($_POST["gr"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$error = []; $data = [];
	
	// validating and sanitizing fullname
	$full = ($_POST['fn']);
	if(empty($full)){$error['fne'] = "* fullname cannot be empty";}else{$fullname = strtolower(test_input($full));}
	
	// validating and sanitizing email
	$ema = ($_POST['em']);
	if(empty($ema)){
		$error['eme'] = "* email cannot be empty";
	}elseif(!regex('email',$ema)){
		$error['eme'] = "* invalid email";
	}elseif(content_data('user_table','u_id',$ema,'u_email') !== false
		&& content_data('user_table','u_id',$ema,'u_email') !== content_data('user_table','u_id',$u_id,'u_id')){
		$error['eme'] = "* email already taken";
	}else{$email = strtolower(test_input($ema));}
	
	// validating and sanitizing gender
	$gr = ($_POST['gr']);
	if(empty($gr)){$error['gre'] = "* gender cannot be empty";}else{$gender = test_input($gr);}
	
	if(empty($error) and empty($missing)){
		$user = new user('admin');
		$user->fullname = $fullname;
		$user->email = $email;
		$user->gender = $gender;
		$update = $user->update_profile();
		if($update === true){
			$data["status"] = 'success';$data["message"] = file_location('home_url','account/');
		}elseif($update === false){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while updating profile";
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>