<?php
if(isset($_POST["i"]) && isset($_POST["s"])){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
	$error = []; $data = [];
	//for id
	$id = ($_POST['i']);
	if(empty($id)){$error[] = "empty";}else{$or_id = test_input($id);$token = content_data('order_table','or_token',$or_id,'or_id');}
	//for status
	$status = ($_POST['s']);
	if(empty($status)){
		$new_status = '';
		$error[] = "no_status";
	}elseif($status !== 'cancelled' && $status !== 'confirmed' && $status !== 'packaging' && $status !== 'in-transit' && $status !== 'ready-for-pickup'
			&& $status !== 'delivered' && $status !== 'failed delivery' && $status !== 'returned'){
		$error[] = "empty";
	}else{$new_status = test_input($status);}
	
	$f_id = content_data('order_table','f_id',$or_id,'or_id');
	$cur_status = content_data('order_table','or_status',$or_id,'or_id');
	$quantity = content_data('order_table','or_quantity',$or_id,'or_id');
	$total_available = content_data('food_table','f_total_available',$f_id,'f_id');
	$food_status = content_data('food_table','f_status',$f_id,'f_id');
	$order_id = content_data('order_table','or_order_id',$or_id,'or_id');
	$u_id = content_data('order_table','user_id',$or_id,'or_id');
	//if $cur_status ===  cancelled
	if($cur_status === 'cancelled'){$error[] = "cancelled";}
	//if amount of available products is not up to request order
	if($new_status === 'confirmed' && ($food_status === 'unavailable' || $food_status === 'deleted' ||$quantity > $total_available)){$error[] = "low availability";}
	
	if(empty($error)){
		$order = new order('admin');
		$order->or_id = $or_id;
		$order->order_id = $order_id;
		$order->status = $cur_status;
		$order->new_status = $new_status;
		$order->n_title = notification_subject($new_status);
		$order->n_message = notification_message($new_status);
		$order->token = $token;
		$order->u_id = content_data('orderer_table','u_id',$token,'or_token');
		if($new_status === 'cancelled'){$order->cancel_reason = "Admin cancelled it";}else{$order->cancel_reason = '';}
		$update = $order->change_order_status();
		if($update === true){
			$data["status"] = 'success';$data["message"] = "Success!!!<br>Request successfully";
			if($status === 'failed delivery' || $status === 'delivered'){
				// update user data counter (either cancel or delivered)
				if($status === 'failed delivery'){$counter = 'cancel';}else{$counter = 'delivery';}
				if($counter === 'delivery'){
					$cur_counter = content_data('user_data_table','ud_delivery_counter',$u_id,'u_id');
				}else{
					$cur_counter = content_data('user_data_table','ud_cancel_counter',$u_id,'u_id');
				}
				$user = new user('admin');
				$user->id = $u_id;
				$user->new_counter = ($cur_counter+1);
				$user->update_counter($counter);
			}
			//INSERT LOG
			$log = new log('admin');
			$log->brief = "{$order_id} status was changed";
			$log->details = "changed order <b>{$order_id}</b> from <b>{$cur_status}</b> to <b>{$new_status}</b>";
			$log->insert_log();
		}else{
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while running request";
		}
	}else{
		if(in_array('no_status',$error)){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Please select a valid status";
		}elseif(in_array('low availability',$error)){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Total available food is lower than order quantity
			or the food is not available. If more food is available, update total available food and try again later or cancel the order";
		}elseif(in_array('cancelled',$error)){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>The order has been cancelled";
		}else{
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while running request";
		}
	}
	echo json_encode($data);
}//end of if isset
?>