<?php
if(isset($_POST["uemail"]) && isset($_POST["pd"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	$error = []; $data = [];
	if(get_json_data('login','act') == 0 || get_json_data('all','act') == 0){//if checkout and all act is disabled
		$data["status"] = 'error';$data["errors"] = 'Sorry!!!<br> Login is not available at the moment';
	}else{
		// validating and sanitizing email
		$email = ($_POST["uemail"]);
		if(empty($email)){$missing[] = "email";}else{$ademail = test_input($email);}
		
		// validating and sanitizing password
		$password = ($_POST["pd"]);
		if(empty($password) OR strlen($password) < 7){$missing[] = "password";}else{$adpassword = $password;}
		
		if(empty($error) and empty($missing)){
			$user = new user('admin');
			$user->email = $ademail;
			$user->current_password = $adpassword;
			$user_id = $user->authenticate_login();
			//validate login
			if($user_id == true && is_numeric($user_id)){
				require_once(file_location('inc_path','session_set.inc.php'));//setting session
				$data["status"] = 'success';$data["message"] = ($_POST["re"]);
			}elseif($user_id === 'suspended'){
				$data["status"] = 'error';$data["errors"] = "Sorry!!!<br>Account has been suspended, contact admin.<br>";
			}elseif($user_id === false){
				$data["status"] = 'error';$data["errors"] = "Sorry!!!<br>Email/Username and Password not match<br>";
			}
		}else{
			$data["status"] = 'error';$data["errors"] = "Sorry!!!<br>All fields are required<br>";
		}
	}
	echo json_encode($data);
}//end of if isset
?>