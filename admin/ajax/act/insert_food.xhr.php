<?php
if(isset($_POST)){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
	$error = []; $missing = []; $data = [];
	// validating and sanitizing name
	$nam = ($_POST['nm']);
	if(empty($nam)){$missing['nme'] = "* name cannot be empty";}else{$name = test_input($nam);}
	
	// validating and sanitizing category
	$cat = ($_POST['ct']);
	if(empty($cat)){$missing['cte'] = "* category cannot be empty";}else{$category = strtolower(test_input($cat));}
	
	// validating and sanitizing max order
	$max = ($_POST['mo']);
	if(empty($max) || !is_numeric($max)){$missing['moe'] = "* max order cannot be empty and must be a number";}else{$max_order = test_input($max);}
	
	// validating and sanitizing total_available
	$tot = ($_POST['ta']);
	if(empty($tot) || !is_numeric($tot)){$missing['tae'] = "* total available food cannot be empty and must be a number";}else{$total_available = test_input($tot);}
	
	// validating and sanitizing original_price
	$ori = ($_POST['op']);
	if(empty($ori) || !is_numeric($ori)){$missing['ope'] = "* original price cannot be empty and must a money value";}else{$original_price = test_input($ori);}
	
	// validating and sanitizing discounted_price
	$dis = ($_POST['dp']);
	if(empty($dis) || !is_numeric($dis)){$missing['dpe'] = "* discounted price cannot be empty and must a money value";}else{$discounted_price = test_input($dis);}
	
	// validating and sanitizing short_desc
	$sht = ($_POST['sd']);
	if(empty($sht)){$missing['sde'] = "* short description cannot be empty";}else{$short_desc = test_input($sht);}
	
	// validating and sanitizing details
	$det = ($_POST['dt']);
	if(empty($det)){$missing['dte'] = "* details cannot be empty";}else{$details = test_input($det);}
	
	// validating and sanitizing weight
	$wgt = ($_POST['wt']);
	if(empty($wgt) || !is_numeric($wgt)){$missing['wte'] = "* weight cannot be empty and must be a number";}else{$weight = test_input($wgt);}
	
	if(isset($original_price) && isset($discounted_price) && ($discounted_price > $original_price)){
		$missing['dpe'] = "* discounted price cannot be greater than original price";
	}
	
	if(empty($error) and empty($missing)){
		//FORM IMAGE UPLOAD
		$location = 'food';$size = 50000000;$file_mode = ["image/png","image/jpeg"];$file_type = 'image';$upload_type = 'multiple';
		require_once(file_location('inc_path','image_upload.inc.php'));
		if(empty($missing) && empty($error)){
			if($file2 === "larger"){ // if file is larger tha expected echo error
				$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Image is larger than expected';
			}elseif($file2 === "normal" || $file2 === "no file"){
				$food = new food('admin');
				$food->name = $name;
				$food->category = $category;
				$food->max_order = $max_order;
				$food->total_available = $total_available;
				$food->original_price = $original_price;
				$food->discounted_price = $discounted_price;
				$food->short_description = $short_desc;
				$food->details = $details;
				$food->weight = $weight;
				$food->type = $file2;
				if($file2 === "normal"){
					$food->file_length = $file_length;
					$food->arr_file_name = $arr_file_name;
					$food->arr_extension = $arr_extension;
				}
				$insert = $food->insert_food();
				if($insert == true && is_numeric($insert)){
					$data["status"] = 'success';$data["message"] = file_location('admin_url','food/preview_food/'.addnum($insert));
					//INSERT LOG
					$log = new log('admin');
					$log->brief = 'new food was registered';
					$log->details = "registered new food (<b>{$name}</b>)";
					$log->insert_log();
				}elseif($insert === false){
					$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while uploading food data';
				}elseif($insert === 'exists'){
					$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Food data with the same name already exists, please try and verify before adding food';
				}
			}else{
				$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while uploading food data, try again later';
			}// end of else if $file = "" // end of else if $file = ""
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $missing;
	}
	echo json_encode($data);
}//end of if isset
?>