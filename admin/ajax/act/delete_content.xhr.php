<?php
if(isset($_GET["t"]) && isset($_GET["i"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	$error = []; $data = [];
	// validating and sanitizing skill
	$ty = ($_GET['t']);
	if(empty($ty)){$error[] = "empty";}else{$type = test_input($ty);}
	
	// validating and sanitizing percentage
	$id = test_input(removenum($_GET['i']));
	if(empty($id) || !is_numeric($id)){$error[] = "number";}else{$c_id = test_input($id);}
	
	if(empty($error)){
		if($type ===  "admin"){
			$name = content_data('admin_table','ad_username',$c_id,'ad_id');
			$admin = new admin('admin');
			$admin->id = $c_id;
			$delete = $admin->delete_admin();
		}elseif($type ===  "social_handle"){
			$name = content_data('social_handle_table','s_name',$c_id,'s_id');
			$social_handle = new social_handle('admin');
			$social_handle->id = $c_id;
			$delete = $social_handle->delete_social_handle();
		}elseif($type ===  "category"){
			$name = content_data('category_table','c_category',$c_id,'c_id');
			$category = new category('admin');
			$category->id = $c_id;
			$delete = $category->delete_category();
		}elseif($type ===  "user"){
			$name = content_data('user_table','u_fullname',$c_id,'u_id');
			$user = new user('admin');
			$user->id = $c_id;
			$delete = $user->delete_user();
		}else{
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while deleting content";
		}
		if($delete === true){
			$data["status"] = 'success';$data["message"] = "Success!!!<br>Content successfully deleted";
			//INSERT LOG
			$log = new log('admin');
			$log->brief = $type.' was deleted';
			$log->details = "deleted the {$type} (<b>{$name}</b>)";
			$log->insert_log();
		}elseif($delete === false){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while deleting content";
		}
	}else{
		$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while deleting content";
	}
	echo json_encode($data);
}//end of if isset
?>