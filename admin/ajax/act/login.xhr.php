<?php
if(isset($_POST["uname"]) && isset($_POST["pd"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	$error = []; $data = [];
	// validating and sanitizing username
	$username = ($_POST["uname"]);
	if(empty($username)){$missing[] = "username";}else{$adusername = test_input($username);}
	
	// validating and sanitizing password
	$password = ($_POST["pd"]);
	if(empty($password) OR strlen($password) < 7){$missing[] = "password";}else{$adpassword = $password;}
	
	if(empty($error) and empty($missing)){
		$user = new admin('admin');
		$user->username = $adusername;
		$user->current_password = $adpassword;
		$authenticate = $user->authenticate_login();
		//validate login
		if($authenticate == true && is_numeric($authenticate)){
			require_once(file_location('admin_inc_path','session_start.inc.php'));
			//set session
			$_SESSION['admin_id'] = ssl_encrypt_input(test_input($authenticate));
			session_regenerate_id();
			$data["status"] = 'success';$data["message"] = ($_POST["re"]);
			//INSERT LOG
			$log = new log('admin');
			$log->brief = 'new login';
			$log->details = "logged in";
			$log->insert_log();
		}elseif($authenticate === 'suspended'){
			$data["status"] = 'error';$data["errors"] = "Sorry!!!<br> Account has been suspended, contact admin.<br>";
		}elseif($authenticate === false){
			$data["status"] = 'error';$data["errors"] = "Sorry!!!<br> Email/Username and Password not match<br>";
		}
	}else{
		$data["status"] = 'error';$data["errors"] = "Sorry!!!<br> All fields are required<br>";
	}
	echo json_encode($data);
}//end of if isset
?>