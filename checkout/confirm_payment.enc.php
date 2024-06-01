<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$token = get_order_token();
$or = available_cart_data($token);
$trans_token = content_data('transaction_table','or_token',$token,'or_token');
$orderer_token = content_data('orderer_table','or_token',$token,'or_token');
$total_amount = total_amount($token);
//IF REFERENCE IS NOT SET || TOKEN IS EMPTY || NO CONTENT IS IN THE CART || NO CONTENT IN THE ORDERER TABLE
if(!isset($_GET['reference']) || ($token === 'no_token') || ($or === false) || ($orderer_token === false)){die(transaction_result('error'));}

$reference = ($_GET['reference']);
$trans_ref_id = content_data('transaction_table','t_ref_id',$reference,'t_ref_id');
//IF REFERENCE IS EMPTY DIE || IF REF_ID HAS BEEN USED BEFORE
if(empty($reference) || ($trans_ref_id !== false) || ($trans_token !== false)){die(transaction_result('error'));}

//CONNECT TO PAYSTACK
$paystack = new paystack();
$paystack->reference = $reference;
$result = $paystack->verify_payment();
$info = json_decode($result);

$order = new order('admin');
$order->token = $token;
$order->status = "cart";
$order->amount = $total_amount;
$order->currency = get_json_data('currency_name','about_us');
$order->ref_id = $reference;
$order->t_payment_method = "Card";
$order->ipaddress = get_ip_address();
$order->new_status = "failed";
$order->t_status = "failed";
$order->n_title = notification_subject($order->new_status);
$order->n_message = notification_message($order->new_status);

// IF CANNOT CONNECT OT PAYMENT GATEWAY
if($result === false){$order->run_trans();die(transaction_result('error connecting','verification'));}

//IF THE STATUS IS FALSE, SHOW ERROR AND RUN FAILED
if(!$info->status){$order->run_trans();die(transaction_result('unsuccessful payment'));}

//CHECK FOR TOKEN IF MATCH
if($token !== $info->data->metadata->token){$order->run_trans();die(transaction_result('error'));}

//CHECK FOR AMOUNT IF MATCH
if($total_amount !== $info->data->amount/100){$order->run_trans();die(transaction_result('error'));}

//DECALARING ALL THE VARIABLE FOR SUCCESS/FAILED
$order->amount = $info->data->amount/100;
$order->currency = $info->data->currency;
$order->ref_id = $reference;
$order->payment_method = $info->data->channel;
if($info->data->authorization->account_name == null){$order->account_name = "Unknown";}else{$order->account_name = $info->data->authorization->account_name;}
if(isset($info->data->plan->account_number)){$order->account_number = $info->data->authorization->account_number;}else{$order->account_number = "**********";}
$order->bank = $info->data->authorization->bank;
$order->brand = $info->data->authorization->brand;
$order->ipaddress = $info->data->ip_address;

// IF THE TRANSACTION FAILED
if($info->data->status !== "success"){$order->run_trans();die(transaction_result('fail'));}

//IF THE TRANSACTION IS SUCCESSFUL
$order->new_status = "order placed";
$order->t_status = "success";
$order->n_title = notification_subject($order->new_status);
$order->n_message = notification_message($order->new_status);
$run = $order->run_trans();
if($run === true){
 //SEND EMAIL
 transaction_result('success','payment');
}else{
 $order->run_trans();transaction_result('fail');
}
?>