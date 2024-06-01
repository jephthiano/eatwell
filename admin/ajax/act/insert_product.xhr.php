<?php
if(isset($_POST)){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
	$error = []; $missing = []; $data = [];
	// validating and sanitizing name
	$nam = ($_POST['nm']);
	if(empty($nam)){$missing['nme'] = "* name cannot be empty";}else{$name = test_input($nam);}
	
	// validating and sanitizing brand
	$brd = ($_POST['bd']);
	if(empty($brd)){$missing['bde'] = "* brand cannot be empty";}else{$brand = strtolower(test_input($brd));}
	
	// validating and sanitizing category
	$cat = ($_POST['ct']);
	if(empty($cat)){$missing['cte'] = "* category cannot be empty";}else{$category = strtolower(test_input($cat));}
	
	// validating and sanitizing max order
	$max = ($_POST['mo']);
	if(empty($max) || !is_numeric($max)){$missing['moe'] = "* max order cannot be empty and must be a number";}else{$max_order = test_input($max);}
	
	// validating and sanitizing original_price
	$ori = ($_POST['op']);
	if(empty($ori) || !is_numeric($ori)){$missing['ope'] = "* original price cannot be empty and must a money value";}else{$original_price = test_input($ori);}
	
	// validating and sanitizing discounted_price
	$dis = ($_POST['dp']);
	if(empty($dis) || !is_numeric($dis)){$missing['dpe'] = "* discounted price cannot be empty and must a money value";}else{$discounted_price = test_input($dis);}
	
	// validating and sanitizing color
	$cl = ($_POST['cl']);$cl_json = '{'.$cl.'}';
	if(empty($cl)){$missing['cle'] = "* color cannot be empty";}elseif(is_json($cl_json) === false){$missing['cle'] = "* incorrect format, review the data";}else{$color = strtolower(test_input($cl_json));}
	
	// validating and sanitizing content
	$cont = ($_POST['cp']);
	if(empty($cont)){$missing['cpe'] = "* contents cannot be empty";}else{$content = test_input($cont);}
	
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
		$location = 'product';$size = 50000000;$file_mode = ["image/png","image/jpeg"];$file_type = 'image';$upload_type = 'multiple';
		require_once(file_location('inc_path','image_upload.inc.php'));
		if(empty($missing) && empty($error)){
			if($file2 === "larger"){ // if file is larger tha expected echo error
				$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Image is larger than expected';
			}elseif($file2 === "normal" || $file2 === "no file"){
				$product = new product('admin');
				$product->name = $name;
				$product->brand = $brand;
				$product->category = $category;
				$product->max_order = $max_order;
				$product->original_price = $original_price;
				$product->discounted_price = $discounted_price;
				$product->color = $color;
				$product->content = $content;
				$product->details = $details;
				$product->weight = $weight;
				$product->type = $file2;
				if($file2 === "normal"){
					$product->file_length = $file_length;
					$product->arr_file_name = $arr_file_name;
					$product->arr_extension = $arr_extension;
				}
				$insert = $product->insert_product();
				if($insert == true && is_numeric($insert)){
					$data["status"] = 'success';$data["message"] = file_location('admin_url','product/preview_product/'.addnum($insert));
					//INSERT LOG
					$log = new log('admin');
					$log->brief = 'new product was registered';
					$log->details = "registered new product (<b>{$name}</b>)";
					$log->insert_log();
				}elseif($insert === false){
					$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while uploading product data';
				}elseif($insert === 'exists'){
					$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Product data with the same name already exists, please try and verify before adding product';
				}
			}else{
				$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while uploading product data, try again later';
			}// end of else if $file = "" // end of else if $file = ""
		}
	}else{
		$data["status"] = 'error';$data["errors"] = $missing;
	}
	echo json_encode($data);
}//end of if isset
?>