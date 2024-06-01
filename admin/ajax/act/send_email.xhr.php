<?php
if(isset($_POST)){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
	$error = []; $missing = []; $data = [];
	
	// validating and sanitizing email
	$emai = $_POST['em'];
	if(empty($emai)){$error['eme'] = "* Email cannot be empty";}elseif(!regex('email',$emai)){$error['eme'] = "* Invalid email";}else{$email = test_input($emai);}
	
	// validating and sanitizing subject
	$sub = $_POST['sb'];
	if(empty($sub)){$error['sbe'] = "* Subject cannot be empty";}else{$subject = test_input($sub);}
	
	// validating and sanitizing message
	$mess = $_POST['ms'];
	if(empty($mess)){$error['mse'] = "* Message cannot be empty";}else{$user_message = test_input($mess);}
	
	if(empty($error)){
		$company_email = get_json_data('support_email','about_us');
        $company_name = ucwords(get_xml_data('company_name'));
		//send email
		$mail = new mail();
		$mail->p_receiver = $email;
		$mail->p_subject = $subject;
		$mail->p_message = $user_message;
		$mail->p_header = implode("\r\n",[
								"From:".$company_name." <".$company_email.">",
								"MIME-Version: 1.0",
								"Content-Type: text/html; charset=UTF-8"
							]);
		$mailsent = $mail->send_mail();
		if($mailsent){
			$data["status"] = 'success';$data["message"] = 'Success!!!<br>Email successfully sent';
			//INSERT LOG
			$log = new log('admin');
			$log->brief = 'email was sent';
			$log->details = "email was sent to (<i>{$email}</i>)";
			$log->insert_log();
		}else{
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occur while sending email, try again later";
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>