<?php
if(isset($_POST)){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
	$error = []; $missing = []; $data = [];
	
	// validating and sanitizing category
	$cat = ($_POST['ct']);
	if(empty($cat)){$missing['cte'] = "* category cannot be empty";}else{$cate = strtolower(test_input($cat));}
	
	// validating and sanitizing icon
	$ico = ($_POST['ic']);
	if(empty($ico)){$missing['ice'] = "* Icon cannot be empty";}else{$icon = strtolower(test_input($ico));}
	
	if(empty($error) and empty($missing)){
		//FORM IMAGE UPLOAD
		$location = 'category';$size = 50000000;$file_mode = ["image/png","image/jpeg"];$file_type = 'image';
		require_once(file_location('inc_path','image_upload.inc.php'));
		
		if(empty($missing) && empty($error)){
			if($file2 === "larger"){ // if file is larger tha expected echo error
				$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Image is larger than expected';
			}elseif($file2 === "normal" || $file2 === "no file"){
				$category = new category('admin');
				$category->category = $cate;
				$category->icon = $icon;
				$category->type = $file2;
				if($file2 === "normal"){$category->file_name = $correct['filename'];$category->extension = $correct['extension'];}
				$insert = $category->insert_category();
				if($insert == true && is_numeric($insert)){
					$data["status"] = 'success';$data["message"] = file_location('admin_url','category/preview_category/'.addnum($insert));
					//INSERT LOG
					$log = new log('admin');
					$log->brief = 'new category was registered';
					$log->details = "registered new category (<b>{$cate}</b>)";
					$log->insert_log();
				}elseif($insert === false){
					$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while uploading category data';
				}elseif($insert === 'exists'){
					$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Category data with the same name already exists, please try and verify before adding category';
				}
			}else{
				$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while uploading category data, try again later';
			}// end of else if $file = "" // end of else if $file = ""
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $missing;
	}
	echo json_encode($data);
}//end of if isset
?>