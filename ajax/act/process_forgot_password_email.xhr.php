<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
require_once(file_location('inc_path','session_check_nologout.inc.php'));
$error = []; $missing = []; $data = [];
if(isset($_POST) && isset($_POST['ema'])){
	$ema = ($_POST['ema']);
	if(empty($ema)){
		$missing['emae'] = "* email cannot be empty";
	}elseif(!regex('email',$ema)){
		$missing['emae'] = "* invalid email";
	}elseif(content_data('user_table','u_email',$ema,'u_email') === false){
		$missing['emae'] = "* email does not exists";
	}else{
		$email = test_input($ema);
	}
	
	if(empty($error) and empty($missing)){
		//DELETE ANY CODE IN DATABASE AND TOKEN
		insert_delete_code('delete',$email);
		
		//SET CODE INTO DATABASE AND SET TOKEN
		$code = generate_code();
		set_forgot_password_token($email,$code);
		if(insert_delete_code('insert',$email,$code) === true){
			$company_email = get_json_data('support_email','about_us');
			$company_name = ucwords(get_xml_data('company_name'));
			//SEND CODE TO EMAIL
			$mail = new mail();
			$mail->p_receiver = $email;
			$mail->p_subject = "Forgot Password Pass Code";
			$mail->p_message = email_code_message($code);
			$mail->p_header = implode("\r\n",[
							"From:".$company_name." <".$company_email.">",
							"MIME-Version: 1.0",
							"Content-Type: text/html; charset=UTF-8"
							]);
			$mailsent = $mail->send_mail();
			if($mailsent){
				$data["status"] = 'success';$data["message"] = file_location('home_url','forgot_password/enter_code/');
			}else{
				//DELETE ANY CODE IN DATABASE AND TOKEN
				insert_delete_code('delete',$email);
				$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while sending email';
			}
		}else{
			//DELETE ANY CODE IN DATABASE AND TOKEN
			insert_delete_code('delete',$email);
			$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while processing email';
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $missing;
	}
}else{
	$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while processing email';
}//end of if empty
echo json_encode($data);
?>