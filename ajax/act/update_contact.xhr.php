<?php
if(isset($_POST["ecfn"]) && isset($_POST["ecad"]) && isset($_POST["ecrg"]) && isset($_POST["ecph"]) && isset($_POST["ecph2"]) && isset($_POST["cid"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$error = []; $data = [];
	
	// validating and sanitizing fullname
	$nam = $_POST['ecfn'];
	if(empty($nam)){$error['ecfne'] = "* fullname cannot be empty";}else{$fullname = strtolower(test_input($nam));}
	
	// validating and sanitizing address
	$add = $_POST['ecad'];
	if(empty($add)){$error['ecade'] = "* address cannot be empty";}else{$address = test_input($add);}
	
	// validating and sanitizing region
	$reg = $_POST['ecrg'];
	if(empty($reg)){$error['ecrge'] = "* region cannot be empty";}else{$region = test_input($reg);}
	
	// validating and phnumber1
	$ph = $_POST['ecph'];
	if(empty($ph)){$error['ecphe'] = "* phonenumber cannot be empty";}elseif(!regex('phonenumber',$ph)){$error['ecphe'] = "* invalid phonumber";}else{$phnumber1 = test_input($ph);}
	
	// validating and phnumber2
	$ph2 = $_POST['ecph2'];
	if(empty($ph2)){$phnumber2 = NULL;}elseif(!regex('phonenumber',$ph2)){$error['ecph2e'] = "* invalid phonumber";}else{$phnumber2 = test_input($ph2);}
	
	$id = ($_POST['cid']);
	if(empty($id)){$error[] = "empty";}else{$cid = test_input(removenum($id));}
	
	if(empty($error)){
		$user = new user('admin');
		$user->uc_id = $cid;
		$user->uc_fullname = $fullname;
		$user->uc_address = $address;
		$user->uc_region = $region;
		$user->uc_phnumber1 = $phnumber1;
		$user->uc_phnumber2 = $phnumber2;
		$update = $user->update_user_contact();
		if($update === true){
			$data["status"] = 'success';$data["message"] = file_location('home_url','contact/');
		}elseif($update === false){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occur while saving contact, try again later";
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>