<?php
if(isset($_POST["i"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$error = []; $data = [];
	$id = ($_POST['i']);
	if(empty($id)){$error[] = "empty";}else{$uc_id = test_input($id);}
	if(empty($error) && content_data('user_contact_table','u_id',$uc_id,'uc_id') === $u_id){
		$user = new user('admin');
		$user->uc_id = $uc_id;
		$delete = $user->set_contact_as_default();
		if($delete === true){
			$data["status"] = 'success';$data["message"] = "Success!!!<br>Contact successfully set as default";
		}elseif($delete === false){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while setting contact as default";
		}
	}else{
		$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while setting contact as default";
	}
	echo json_encode($data);
}//end of if isset
?>