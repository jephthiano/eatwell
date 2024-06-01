<?php
if(isset($_POST)){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
	$error = []; $error = []; $data = [];
	
	// validating and sanitizing category
	$cat = ($_POST['ct']);
	if(empty($cat)){$error['cte'] = "* category cannot be empty";}else{$cate = strtolower(test_input($cat));}
	
	// validating and sanitizing icon
	$ico = ($_POST['ic']);
	if(empty($ico)){$error['ice'] = "* Icon cannot be empty";}else{$icon = strtolower(test_input($ico));}
	
	// validating and sanitizing id
	$id = test_input(removenum($_POST['tid']));
	if(empty($id) || !is_numeric($id)){$error[] = "number";}else{$c_id = test_input($id);}
	
	if(empty($error)){
		//$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>It works man';
		$category = new category('admin');
		$category->id = $c_id;
		$category->category = $cate;
		$category->icon = $icon;
		$update = $category->update_category();
		if($update === true){
			$data["status"] = 'success';$data["message"] = file_location('admin_url','category/preview_category/'.addnum($c_id));
			//INSERT LOG
			$log = new log('admin');
			$log->brief = 'category was updated';
			$log->details = "updated the category (<b>{$cate}</b>)";
			$log->insert_log();
		}elseif($update === false){
			$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while updating category, try again later';
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>