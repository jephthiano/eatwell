<?php
if(isset($_POST["em"]) && isset($_POST["un"]) && isset($_POST["fn"]) && isset($_POST["ps"]) && isset($_POST["lv"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
	$error = []; $missing = []; $data = [];
	// validating and sanitizing email
	$ema = ($_POST['em']);
	if(empty($ema)){
		$missing['eme'] = "* email cannot be empty";
	}elseif(!regex('email',$ema)){
		$missing['eme'] = "* invalid email";
	}elseif(content_data('admin_table','ad_id',$ema,'ad_email') !== false){
		$missing['eme'] = "* email already taken";
	}else{$email = strtolower(test_input($ema));}
	
	// validating and sanitizing username
	$usr = ($_POST['un']);
	if(empty($usr)){
		$missing['une'] = "* username cannot be empty";
	}elseif(content_data('admin_table','ad_id',$usr,'ad_username') !== false){
		$missing['une'] = "* username already taken";
	}else{$username = strtolower(test_input($usr));}
	
	// validating and sanitizing fullname
	$full = ($_POST['fn']);
	if(empty($full)){$missing['fne'] = "* fullname cannot be empty";}else{$fullname = strtolower(test_input($full));}
	
	// validating and sanitizing password
	$pass = ($_POST['ps']);
	if(empty($pass)){$missing['pse'] = "* password cannot be empty";}elseif(strlen($pass) < 7){$missing['pse'] = "* password must be more than 6 characters";}else{$password = test_input($pass);}
	
	// validating and sanitizing level
	$lev = ($_POST['lv']);
	if(empty($lev) || !is_numeric($lev)){$missing['lve'] = "* level cannot be empty";}else{$level = test_input($lev);}
	
	if(empty($error) and empty($missing)){
		//FORM IMAGE UPLOAD
		$location = 'admin';$size = 50000000;$file_mode = ["image/png","image/jpeg"];$file_type = 'image';
		require_once(file_location('inc_path','image_upload.inc.php'));
		
		if(empty($missing) && empty($error)){
			if($file2 === "larger"){ // if file is larger tha expected echo error
				$data["status"] = 'fail';$data["message"] = 'Image is larger than expected';
			}elseif($file2 === "normal" || $file2 === "no file"){
				$admin = new admin('admin');
				$admin->email = $email;
				$admin->username = $username;
				$admin->fullname = $fullname;
				$admin->password = hash_pass($password);
				$admin->level = $level;
				$admin->registered_by = $adid;
				$admin->type = $file2;
				if($file2 === "normal"){$admin->file_name = $correct['filename'];$admin->extension = $correct['extension'];}
				$insert = $admin->insert_admin();
				if($insert == true && is_numeric($insert)){
					$data["status"] = 'success';$data["message"] = file_location('admin_url','admin/preview_admin/'.addnum($insert));
					//INSERT LOG
					$log = new log('admin');
					$log->brief = 'new admin was registered';
					$log->details = "registered new admin (<b>{$username}</b>)";
					$log->insert_log();
				}elseif($insert === false){
					$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error uploading admin data';
				}
			}else{
				$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred, try again later';
			}// end of else if $file = "" // end of else if $file = ""
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $missing;
	}
	echo json_encode($data);
}//end of if isset
?>