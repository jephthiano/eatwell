<?php
if(isset($_POST["nam"]) && isset($_POST["ema"]) && isset($_POST["pd"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	$error = []; $data = [];
	if(get_json_data('registration','act') == 0 || get_json_data('all','act') == 0){//if checkout and all act is disabled
		$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Sign Up is not available at the moment';
	}else{
		// validating and sanitizing name
		$nam = ($_POST['nam']);
		if(empty($nam)){$error['name'] = "* Name cannot be empty";}else{$name = strtolower(test_input($nam));}
		
		// validating and sanitizing email
		$emai = ($_POST['ema']);
		if(empty($emai)){
			$error['emae'] = "* Email cannot be empty";
		}elseif(!regex('email',$emai)){
			$error['emae'] = "* Invalid email";
		}elseif(content_data('user_table','u_email',$emai,'u_email') !== false){
			$error['emae'] = "* Email has been registered ";
		}else{$email = strtolower(test_input($emai));}
		
		// validating and sanitize password
		$pass = ($_POST['pd']);
		if(empty($pass)){$error['pde'] = "* Password cannot be empty";}else{$password = test_input($pass);}
		
		if(empty($error) and empty($missing)){
			$user = new user('admin');
			$user->fullname = $name;
			$user->email = $email;
			$user->password = hash_pass($password);
			$user_id = $user->sign_up();
			//validate login
			if($user_id == true && is_numeric($user_id)){
				//SEND MAIL
				$company_email = get_json_data('support_email','about_us');
				$company_name = ucwords(get_xml_data('company_name'));
				$mail = new mail();
				$mail->p_receiver = $email;
				$mail->p_subject = "Welcome To {$company_name}";
				$mail->p_message = welcome_message($name);
				$mail->p_header = implode("\r\n",[
                                    "From:".$company_name." <".$company_email.">",
                                    "MIME-Version: 1.0",
                                    "Content-Type: text/html; charset=UTF-8"
                                ]);
				$mailsent = $mail->send_mail();
				require_once(file_location('inc_path','session_set.inc.php'));//setting session
				$data["status"] = 'success';$data["message"] = ($_POST["re"]);
			}elseif($user_id === false){
				$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while creating account, please try again later.<br>";
			}
		}else{
			$data["status"] = 'error';$data["errors"] = $error;
		}
	}
	echo json_encode($data);
}//end of if isset
?>