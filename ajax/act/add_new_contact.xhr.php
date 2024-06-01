<?php
if(isset($_POST["acfn"]) && isset($_POST["acad"]) && isset($_POST["acrg"]) && isset($_POST["acph"]) && isset($_POST["acph2"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$error = []; $data = [];
	
	// validating and sanitizing fullname
	$nam = $_POST['acfn'];
	if(empty($nam)){$error['acfne'] = "* fullname cannot be empty";}else{$fullname = strtolower(test_input($nam));}
	
	// validating and sanitizing address
	$add = $_POST['acad'];
	if(empty($add)){$error['acade'] = "* address cannot be empty";}else{$address = test_input($add);}
	
	// validating and sanitizing region
	$reg = $_POST['acrg'];
	if(empty($reg)){$error['acrge'] = "* region cannot be empty";}else{$region = test_input($reg);}
	
	// validating and phnumber1
	$ph = $_POST['acph'];
	if(empty($ph)){$error['acphe'] = "* phonenumber cannot be empty";}elseif(!regex('phonenumber',$ph)){$error['acphe'] = "* invalid phonumber";}else{$phnumber1 = test_input($ph);}
	
	// validating and phnumber2
	$ph2 = $_POST['acph2'];
	if(empty($ph2)){$phnumber2 = NULL;}elseif(!regex('phonenumber',$ph2)){$error['acph2e'] = "* invalid phonumber";}else{$phnumber2 = test_input($ph2);}
	
	// status
	if(content_data('user_contact_table','uc_id',$u_id,'u_id') === false){
		$uc_status = 'default';
	}else{
		if(isset($_POST['dflt']) && $_POST['dflt'] === 'dflt'){$uc_status = 'default';}else{$uc_status = 'none';}
	}
	
	if(empty($error)){
		$total = get_numrow('user_contact_table','u_id',$u_id,"return",'no round');
		if($total >= 5){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>You can only have 5 contact details at maximum, delete some contact details and try again later{$total}";
		}else{
			$user = new user('admin');
			$user->uc_fullname = $fullname;
			$user->uc_address = $address;
			$user->uc_region = $region;
			$user->uc_phnumber1 = $phnumber1;
			$user->uc_phnumber2 = $phnumber2;
			$user->uc_status = $uc_status;
			$insert = $user->insert_user_contact();
			if($insert == true && is_numeric($insert)){
				if($uc_status === 'default'){
					$user->uc_id = $insert;
					$delete = $user->set_contact_as_default();
				}
				$data["status"] = 'success';$data["message"] = file_location('home_url','contact/');
			}elseif($insert === false){
				$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occur while creating contact, try again later";
			}
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>