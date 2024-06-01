<?php
if(isset($_POST["nm"]) && isset($_POST["em"]) && isset($_POST["sb"]) && isset($_POST["ms"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	$error = []; $data = [];
	
	// validating and sanitizing name
	$nam = $_POST['nm'];
	if(empty($nam)){$error['nme'] = "* Name cannot be empty";}else{$name = strtolower(test_input($nam));}
	
	// validating and sanitizing email
	$emai = $_POST['em'];
	if(empty($emai)){$error['eme'] = "* Email cannot be empty";}elseif(!regex('email',$emai)){$error['eme'] = "* Invalid email";}else{$email = strtolower(test_input($emai));}
	
	// validating and sanitizing subject
	$sub = $_POST['sb'];
	if(empty($sub)){$error['sbe'] = "* Subject cannot be empty";}else{$subject = strtolower(test_input($sub));}
	
	// validating and sanitizing message
	$mess = $_POST['ms'];
	if(empty($mess)){$error['mse'] = "* Message cannot be empty";}else{$user_message = test_input($mess);}
	
	
	if(empty($error)){
		$message = new message('admin');
		$message->name = $name;
		$message->email = $email;
		$message->subject = $subject;
		$message->message = $user_message;
		$insert = $message->insert_message();
		if($insert == true && is_numeric($insert)){
			$data["status"] = 'success';$data["message"] = 'Thanks!!!<br>Message successfully sent';
		}elseif($insert === false){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occur while sending message, try again later";
		}
		//SEND MAIL
		$mail = new mail();
		$mail->p_receiver = get_json_data('support_email','about_us');
		$mail->p_subject = $subject;
		$mail->p_message = $user_message;
		$mail->p_header = implode("\r\n",[
				"From:".$name." <".$email.">",
				"MIME-Version: 1.0",
				"Content-Type: text/html; charset=UTF-8"
				]);
		$mailsent = $mail->send_mail();
	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>