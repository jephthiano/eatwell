<?php
if(isset($_POST["rt"]) && isset($_POST["nm"])&& isset($_POST["tt"]) && isset($_POST["fb"]) && isset($_POST["cid"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$error = []; $data = [];
	
	// validating rating
	$rt = $_POST['rt'];
	if(empty($rt)){$error['rte'] = "* select star to rate product";}elseif(!is_numeric($rt)){$error['rte'] = "* invalid rating";}else{$rating = test_input($rt);}
	
	// validating and sanitizing fullname
	$nam = $_POST['nm'];
	if(empty($nam)){$error['nme'] = "* name cannot be empty";}else{$name = test_input($nam);}
	
	// validating and sanitizing title
	$tt = $_POST['tt'];
	if(empty($tt)){$error['tte'] = "* title cannot be empty";}else{$title = test_input($tt);}
	
	// validating and sanitizing feedback
	$det = $_POST['fb'];
	if(empty($det)){$error['fbe'] = "* feedback cannot be empty";}else{$feedback = test_input($det);}
	
	$id = ($_POST['cid']);
	if(empty($id)){$error[] = "empty";}else{$cid = test_input(removenum($id));}
	if(empty($error)){
		$order = new order('admin');
		$order->r_rating = $rating;
		$order->r_name = $name;
		$order->r_title = $title;
		$order->r_feedback = $feedback;
		$order->id = $cid;
		$order->f_id = content_data('order_table','f_id',$cid,'or_id');
		$order->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		try{
			//begin transaction
			$order->dbconn->beginTransaction();
			$order->insert_review(); //insert into review
			$order->update_review_status(); //update review status
			// commit the transation
			if($order->dbconn->commit()){
				$data["status"] = 'success';$data["message"] = file_location('home_url','review/');
			}//if commit
		}catch(PDOException $e){
			//rollback
			if($order->dbconn->rollback()){
				$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occur while submitting review, try again later222";
			}//if rollback
		}// end of try and catch
	}else{
		$data["status"] = 'error';$data["errors"] = $error;
	}
	echo json_encode($data);
}//end of if isset
?>