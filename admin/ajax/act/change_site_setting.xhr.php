<?php
if(isset($_POST["s"]) && isset($_POST["k"]) && isset($_POST["v"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	$error = []; $data = [];
	
	// validating and sanitizing section
	$sect = ($_POST['s']);
	if(empty($sect)){$error[] = "empty";}else{$section = test_input($sect);}
	
	// validating and sanitizing key
	$ky = ($_POST['k']);
	if(empty($ky)){$error[] = "empty";}else{$key = test_input($ky);}
	
	// validating and sanitizing value
	$val = ($_POST['v']);
	if(empty($val)){if($val == '0'){$value = '0';}else{$error[] = "empty";}}else{$value = test_input($val);}
	
	$old_value = get_json_data($key,$section);
	if(empty($error)){
		if(write_json_data($section,$key,$value) === true){
			$data["status"] = 'success';$data["message"] = 'Success!!!<br>Setting successfully saved';
			//INSERT LOG
			if($old_value == 0){
				$old_value = 'disable'; $value = 'enable';
			}elseif($old_value == 1){
				$old_value = 'enable'; $value = 'disable';
			}
			$log = new log('admin');
			$log->brief = "{$key} setting was changed";
			$log->details = "changed <b>{$key}</b> setting from <b>{$old_value}</b> to <b>{$value}</b>";
			$log->insert_log();
		}else{
			$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while saving setting, try again';
		}
	}else{
		$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while saving setting, try again'.$value;
	}
}else{
	$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while saving setting, try again';
}//end of if isset
echo json_encode($data);
?>