<?php
if(isset($_POST["nm"]) && isset($_POST["ic"]) && isset($_POST["lk"]) && isset($_POST["tid"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	$error = []; $data = [];
	// validating and sanitizing name
	$nam = ($_POST['nm']);
	if(empty($nam)){$error['nme'] = "* Name cannot be empty";}else{$name = strtolower(test_input($nam));}
	
	// validating and sanitizing icon
	$ico = ($_POST['ic']);
	if(empty($ico)){$error['ice'] = "* Icon cannot be empty";}else{$icon = strtolower(test_input($ico));}
	
	// validating and sanitizing link
	$lnk = ($_POST['lk']);
	if(empty($lnk)){$error['lke'] = "* Link cannot be empty";}else{$link = strtolower(test_input($lnk));}
	
	// validating and sanitizing id
	$id = test_input(removenum($_POST['tid']));
	if(empty($id) || !is_numeric($id)){$error[] = "number";}else{$c_id = test_input($id);}
	
	if(empty($error)){
		$social_handle = new social_handle('admin');
		$social_handle->id = $c_id;
		$social_handle->name = $name;
		$social_handle->icon = $icon;
		$social_handle->link = $link;
		$update = $social_handle->update_social_handle();
		if($update === true){
			$data["status"] = 'success';$data["message"] = file_location('admin_url','social_handle/preview_social_handle/'.addnum($c_id));
			//INSERT LOG
			$log = new log('admin');
			$log->brief = 'social handle was updated';
			$log->details = "updated the social handle (<b>{$name}</b>)";
			$log->insert_log();
		}elseif($update === false){
			$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while updating social handle, try again later';
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>