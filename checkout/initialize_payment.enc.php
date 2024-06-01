<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
require_once(file_location('inc_path','session_check.inc.php'));
$error = [];
$token = get_order_token();
$or = available_cart_data($token);
$orderer = content_data('orderer_table','or_token',$token,'or_token');
//if checkout and all act is disabled
if(get_json_data('checkout','act') == 0 || get_json_data('all','act') == 0){$error[] = 'true';die(transaction_result('error'));}
 
//token is empty || if there is no content in the cart  || if orderer has not been inserted
	if(($token === 'no_token') || $or === false || $orderer === false){$error[] = 'true';die(transaction_result('error'));}
  
if($or !==  false){
	//if one of order payment_method is NOT card
	foreach($or AS $id){
		$pay = content_data('order_table','or_payment_method',$id,'or_id');
		$del = content_data('order_table','or_delivery_method',$id,'or_id');
  if($del !== 'pickup' && $del !== 'door delivery'){$error[] = 'true';die(transaction_result('error'));}
		if($pay !== 'card payment'){$error[] = 'true';die(transaction_result('error'));}
	}
}

if(empty($error)){// if $error is empty
 //json data to be sent
 $fields = [];
 $fields['email'] = content_data('user_table','u_email',$u_id,'u_id');
 $fields['amount'] = total_amount($token) * 100;
 //$fields['currency'] = get_json_data('currency_name','about_us');
 $fields['callback_url'] = file_location('home_url','checkout/confirm_payment/');
 $fields['metadata'] = array("token" => $token);
 $fields_string = json_encode($fields);
 //INITIALIZE PAYSTACK
 $paystack = new paystack();
 $paystack->data = $fields_string;
 $result = $paystack->initialize_payment();
 if($result === false){
  die(transaction_result('error connecting','verification'));
 }else{ // if no curl error
  $info = json_decode($result,true);//DECODING THE RESPONSE
  if(!$info['status']){
   die(transaction_result('error connecting','verification'));
  }else{
   header("location:".$info['data']['authorization_url']);//redirect to payment gateway
  }
 }
}else{ // if $errror is not empty
 die(transaction_result('error'));
}
?>