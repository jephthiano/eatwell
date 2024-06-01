<?php
if(isset($_POST["s"]) && isset($_POST["i"] )){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	$error = []; $data = [];
	
	// validating and sanitizing id
	$id = test_input(removenum($_POST['i']));
	if(empty($id) || !is_numeric($id)){$error[] = "number";}else{$c_id = test_input($id);}
	
	// validating and sanitizing amount
	$amount = content_data('order_table','or_amount',$c_id,'or_id');
	$delivery_fee = content_data('order_table','or_delivery_fee',$c_id,'or_id');
	$total = add_total($amount,$delivery_fee);
	$amt = ($_POST['s']);
	if(empty($amt) || !is_numeric($amt)){
		$error[] = "empty";
	}elseif($amt > $total){
		$error[] = "greater";
	}else{
		$amount = test_input($amt);
	}
	
	//checking if refund has exists
	$order_id = content_data('order_table','or_order_id',$c_id,'or_id');
	if(content_data('refund_table','r_id',$order_id,'or_order_id') !== false){$error[] = "exists";}
	
	if(empty($error)){
		$order = new order('admin');
		$order->id = $c_id;
		$order->amount = $amount;
		$order->order_id = $order_id;
		$order->user_id = content_data('order_table','user_id',$c_id,'or_id');
		$refund = $order->refund_customer();
		$refund = true;
		if($refund === true){
			$data["status"] = 'success';$data["message"] = "Success!!!<br>Refund sucessfully processed";
			//INSERT LOG
			$log = new log('admin');
			$log->brief = 'customer was refunded';
			$log->details = "refunded customer with the order id: <b>{$order_id}</b> with the amount <b>".get_json_data('currency_symbol','about_us')." {$amount}</b>";
			$log->insert_log();
		}else{
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while updating status";
		}
	}else{
		if(in_array('empty',$error)){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Amount cannot be empty and must be digit";
		}elseif(in_array('greater',$error)){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Amount to be refunded cannot be greater than {$amount}";
		}elseif(in_array('exists',$error)){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Refunded has already been carried out, please verify first.";
		}else{
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occurred while updating status";
		}
	}
	echo json_encode($data);
}//end of if isset
?>