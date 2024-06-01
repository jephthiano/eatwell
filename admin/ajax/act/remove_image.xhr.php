<?php
if(isset($_GET['t']) && isset($_GET['i'])){
	require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
	$error = [];
	//validating and sanitising content type
	$ty = ($_GET['t']);
	if(empty($ty)){$error[] = "t";}else{$type = test_input($ty);}
	
	// validating and sanitizing percentage
	$id = test_input(removenum($_GET['i']));
	if(empty($id) || !is_numeric($id)){$error[] = "number";}else{$c_id = test_input($id);}
	
	if(empty($error)){
		//DELETE IMAGE AND DELETE IF FROM THE DB
		if($type === 'admin'){
			$message = "removed his/her profile pics";
			$admin = new admin('admin');
			$admin->id = $c_id;
			$remove = $admin->remove_image();
		}elseif($type === 'food'){
			$s_id = content_data('food_media_table','f_id',$c_id,'fm_id');
			$message = "removed food (<b>".content_data('food_table','f_name',$s_id,'f_id')."</b>) image";
			$food = new food('admin');
			$food->fm_id = $c_id;
			$remove = $food->remove_image();
		}elseif($type === 'category'){
			$message = "removed category (<b>".content_data('category_table','c_category',$c_id,'c_id')."</b>) image";
			$category = new category('admin');
			$category->id = $c_id;
			$remove = $category->remove_image();
		}else{
			$error[] = "no type";
		}
		if(empty($error)){
			if($remove === true){
				$data["status"] = 'success';$data["message"] = "Success!!!<br>Image successfully removed";
				//INSERT LOG
				$log = new log('admin');
				$log->brief = $type.' image was removed';
				$log->details = $message;
				$log->insert_log();
			}else{
				$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while removing image";
			}
		}else{
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while removing image";
		}
	}else{
		$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while removing image";
	}
	//end of if empty
	echo json_encode($data);
}//end of if isset
?>