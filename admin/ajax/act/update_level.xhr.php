<?php
if(isset($_GET["l"]) && isset($_GET["i"] )){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	$error = []; $data = [];
	// validating and sanitizing percentage
	$lid = ($_GET['l']);
	if(empty($lid) || !is_numeric($lid)){$error[] = "number";}else{$level = test_input($lid);}
	
	// validating and sanitizing id
	$id = test_input($_GET['i']);
	if(empty($id) || !is_numeric($id)){$error[] = "number";}else{$c_id = test_input($id);}
	
	if(empty($error)){
		$name = content_data('admin_table','ad_username',$c_id,'ad_id');
		$cur_level = content_data('admin_table','ad_level',$c_id,'ad_id');
		$admin = new admin('admin');
		$admin->id = $c_id;
		$admin->level = $level;
		$update = $admin->update_level();
		if($update === true){
			$data["status"] = 'success';$data["message"] = "Success!!!<br>Level Successfully Updated";
			//INSERT LOG
			$log = new log('admin');
			$log->brief = 'level was updated';
			$log->details = "updated the admin level of ({$name}) from '<b>".check_level($cur_level)."</b>' to '<b>".check_level($level)."</b>'";
			$log->insert_log();
		}elseif($update === false){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while updating level";
		}
	}else{
		$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while updating level";
	}
	echo json_encode($data);
}//end of if isset
?>