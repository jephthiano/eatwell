<?php
if(isset($_GET)){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
	$error = []; $data = [];
	
	// validating and sanitizing action doer
	if($adlevel != 3){$error[] = "empty";}
	
	if(empty($error)){
		//CLEAR LOG
		$log = new log('admin');
		$clear = $log->clear_log();
		if($clear === true){
			$data["status"] = 'success';$data["message"] = "Success!!!<br>Logs successfully cleared";
			//INSERT LOG
			$log = new log('admin');
			$log->brief = 'logs was cleared';
			$log->details = "cleared all logs";
			$log->insert_log();
		}elseif($clear === false){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while clearing logs, refresh page and try again";
		}
	}else{
		$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>You cannot perform this action";
	}
	echo json_encode($data);
}//end of if isset
?>