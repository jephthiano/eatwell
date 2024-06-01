<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
require_once(file_location('inc_path','session_check_nologout.inc.php'));
//if the referrer page is not summary
if($_SERVER['HTTP_REFERER'] != file_location('home_url','checkout/summary/')){die(transaction_result('error'));}
$token = get_order_token();
$add = "AND or_status = 'cart' AND order_table.f_id = food_table.f_id AND f_status = 'available' ORDER BY or_id DESC";
if(($token === 'no_token') || (content_data('order_table,food_table','or_token',$token,'or_token',$add) === false)|| (content_data('orderer_table','or_token',$token,'or_token') === false)){//if token is not empty or if token is not in order table or if token is not in orderer table
	transaction_result('error');
}else{
	$order = new order('admin');
	$order->token = $token;
	$order->status = "cart";
	$order->amount = total_amount($token);
	$order->currency = get_json_data('currency_name','about_us');
	$order->ref_id = 'POD-'.random_token(random_token());
	$order->t_payment_method = "Payment on Delivery/Pickup";
	$order->brand = 'pod';
	$order->ipaddress = get_ip_address();
   $order->new_status = "order placed";
	$order->t_status = "success";
	$order->n_title = notification_subject($order->new_status);
	$order->n_message = notification_message($order->new_status);
   $run = $order->run_trans();
   if($run === true){
		transaction_result('success');
   }else{
      $order->new_status = "failed";
		$order->t_status = "failed";
		$order->n_title = notification_subject($order->new_status);
		$order->n_message = notification_message($order->new_status);
      $order->run_trans();
		transaction_result('fail');
   }
}
?>
