<?php
if(isset($_GET['i'])){
	require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
	$error = []; $data = [];
	
	// validating and sanitizing percentage
	$id = test_input($_GET['i']);
	if(empty($id) || !is_numeric($id)){$error[] = "number";}else{$c_id = test_input($id);}
	$token = get_order_token();
	if($token === 'no_token'){$error[] = "token";}
	if(empty($error)){
		$order = new order('admin');
		$order->token = $token;
		$order->id = $c_id;
		$order->status = 'cart';
		$delete = $order->delete_cart();
		if($delete === true){
			$data["status"] = 'success';$data["message"] = 'Item removed from cart';
		}else{
			$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Error occur while removing item from cart';
		}
	}else{
		$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Error occur while removing item from cart';
	}//end of if empty
	echo json_encode($data);
}//end of if isset
?>