<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
require_once(file_location('inc_path','session_check_nologout.inc.php'));
$error = []; $missing = []; $data = [];
if(isset($_POST) && isset($_POST['cde'])){
	$cookie_email = get_forgot_password_token('email');
	$cookie_code = get_forgot_password_token('code');
	$db_code = content_data('emailcode_table','c_code',$cookie_email,'c_email');
	//if cookie email and cookie code are empty or flase || if cookie code is not equal to db code
	if(empty($cookie_email) || $cookie_email === false || empty($cookie_code) || $cookie_code === false || $cookie_code !== $db_code){
		$error[] = 'error';
		insert_delete_code('delete',$cookie_email);
		$data["status"] = 'success';$data["message"] = file_location('home_url','forgot_password/');
	}
	
	//validate user input code
	$rawcode = ($_POST['cde']);
	if((empty($rawcode)) || (strlen($rawcode) !== 6) || (!is_numeric($rawcode))){
		$missing['cdee'] = "* invalid code";
	}elseif(time_validity(300,content_data('emailcode_table','c_regdatetime',$cookie_email,'c_email'))){
		$missing['cdee'] = "* code has expired";
	}elseif($rawcode !== $db_code){
		$missing['cdee'] = "* incorrect code";
	}else{
		$code = test_input($rawcode);
	}
	
	if(empty($error) and empty($missing)){
		//set cookie and db code to verified
		if(insert_delete_code('update',$cookie_email,$code)){
			$data["status"] = 'success';$data["message"] = file_location('home_url','forgot_password/enter_password/');
		}else{
			$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while processing code';
		}
	}else{
		if(!empty($missing)){$data["status"] = 'error';$data["errors"] = $missing;}
	}
}else{
	$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while processing email';
}//end of if empty
echo json_encode($data);
?>