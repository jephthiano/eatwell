<?php
if(isset($_POST)){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
	$error = []; $error = []; $data = [];
	// validating and sanitizing name
	$nam = ($_POST['nm']);
	if(empty($nam)){$error['nme'] = "* name cannot be empty";}else{$name = test_input($nam);}
	
	// validating and sanitizing category
	$cat = ($_POST['ct']);
	if(empty($cat)){$error['cte'] = "* category cannot be empty";}else{$category = strtolower(test_input($cat));}
	
	// validating and sanitizing max order
	$max = ($_POST['mo']);
	if(empty($max) || !is_numeric($max)){$error['moe'] = "* max order cannot be empty and must be a number";}else{$max_order = test_input($max);}
	
	// validating and sanitizing total_available
	$tot = ($_POST['ta']);
	if(empty($tot) || !is_numeric($tot)){$error['tae'] = "* total available food cannot be empty and must be a number";}else{$total_available = test_input($tot);}
	
	// validating and sanitizing original_price
	$ori = ($_POST['op']);
	if(empty($ori) || !is_numeric($ori)){$error['ope'] = "* original price cannot be empty and must a money value";}else{$original_price = test_input($ori);}
	
	// validating and sanitizing discounted_price
	$dis = ($_POST['dp']);
	if(empty($dis) || !is_numeric($dis)){$error['dpe'] = "* discounted price cannot be empty and must money value";}else{$discounted_price = test_input($dis);}
	
	// validating and sanitizing short_desc
	$sht = ($_POST['sd']);
	if(empty($sht)){$error['sde'] = "* short description cannot be empty";}else{$short_desc = test_input($sht);}
	
	// validating and sanitizing details
	$det = ($_POST['dt']);
	if(empty($det)){$error['dte'] = "* details cannot be empty";}else{$details = test_input($det);}
	
	// validating and sanitizing weight
	$wgt = ($_POST['wt']);
	if(empty($wgt) || !is_numeric($wgt)){$error['wte'] = "* weight cannot be empty and must be a number";}else{$weight = test_input($wgt);}
	
	// validating and sanitizing id
	$id = test_input(removenum($_POST['tid']));
	if(empty($id) || !is_numeric($id)){$error[] = "number";}else{$c_id = test_input($id);}
	
	if(empty($error)){
		//$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>It works man';
		$food = new food('admin');
		$food->id = $c_id;
		$food->name = $name;
		$food->category = $category;
		$food->max_order = $max_order;
		$food->total_available = $total_available;
		$food->original_price = $original_price;
		$food->discounted_price = $discounted_price;
		$food->short_description = $short_desc;
		$food->details = $details;
		$food->weight = $weight;
		$update = $food->update_food();
		if($update === true){
			$data["status"] = 'success';$data["message"] = file_location('admin_url','food/preview_food/'.addnum($c_id));
			//INSERT LOG
			$log = new log('admin');
			$log->brief = 'food was updated';
			$log->details = "updated the food (<b>{$name}</b>)";
			$log->insert_log();
		}elseif($update === false){
			$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while updating food, try again later';
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>