<?php
if(isset($_POST["i"]) && isset($_POST["s"]) && isset($_POST["r"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$error = []; $data = [];
	//for id
	$id = ($_POST['i']);
	if(empty($id)){$error[] = "empty";}else{$or_id = test_input($id);$token = content_data('order_table','or_token',$or_id,'or_id');}
	//for status
	$status = ($_POST['s']);
	if(empty($status)){
		$error[] = "empty";
	}elseif($status !== 'cancelled'){
		$error[] = "empty";
	}else{$new_status = test_input($status);}
	if($status === 'cancelled' && content_data('order_table','or_status',$or_id,'or_id') !== 'confirmed'){
		$error[] = "wrong request";
	}
	if($status === 'cancelled'){$rea = ($_POST['r']);if(empty($rea)){$error[] = "no_reason";}else{$reason = test_input($rea);}}
	
	if(empty($error)){
		$order = new order('admin');
		$order->or_id = $or_id;
		$order->order_id = content_data('order_table','or_order_id',$or_id,'or_id');
		$order->new_status = $new_status;
		$order->n_title = notification_subject($new_status);
		$order->n_message = notification_message($new_status);
		$order->token = $token;
		$order->u_id = $u_id;
		if($new_status === 'cancelled'){$order->cancel_reason = $reason;}else{$order->cancel_reason = '';}
		$update = $order->change_order_status();
		if($update === true){
			$data["status"] = 'success';$data["message"] = "Success!!!<br>Request successfully ";
			if($new_status === 'cancelled'){
				// update user data counter
				$cur_counter = content_data('user_data_table','ud_cancel_counter',$u_id,'u_id');
				$user = new user('admin');
				$user->id = $u_id;
				$user->new_counter = ($cur_counter+1);
				$user->update_counter('cancel');
			}
		}else{
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while running request";
		}
	}else{
		if(in_array('no_reason',$error)){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Please select a valid reason";
		}elseif(in_array('wrong request',$error)){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>You cannot cancel this order";
		}else{
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while running request";
		}
	}
	echo json_encode($data);
}//end of if isset
?>