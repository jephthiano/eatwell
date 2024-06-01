<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
require_once(file_location('inc_path','session_check_nologout.inc.php'));
$error = []; $missing = []; $data = [];
if(isset($_POST)){
	if(get_json_data('checkout','act') == 0 || get_json_data('all','act') == 0){//if checkout and all act is disabled
		$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Checkout is not available at the moment';
	}else{
		$token = get_order_token();
		
		//CHECKING FOR BYPASSING
		$add = "AND or_status = 'cart' AND order_table.f_id = food_table.f_id AND f_status = 'available' ORDER BY or_id DESC";;
		$or = multiple_content_data('order_table,food_table','or_id',$token,'or_token',$add);
		$orderer = content_data('orderer_table','or_token',$token,'or_token');
		
		if($or !==  false){
			//if one of order payment_method is not set
			foreach($or AS $id){
				$pay = content_data('order_table','or_payment_method',$id,'or_id');
				$del = content_data('order_table','or_delivery_method',$id,'or_id');
				if($pay !== 'card payment' && $pay !== 'payment on delivery'){
					$error[] = 'error';
					$data["status"] = 'success';$data["message"] = file_location('home_url','checkout/payment_method/');
				}
				if($del !== 'pickup' && $del !== 'door delivery'){
					$error[] = 'error';
					$data["status"] = 'success';$data["message"] = file_location('home_url','checkout/');
				}
			}
		}
		
		//if there is no content in the cart  || if orderer has not been inserted
		if($or === false || $orderer === false){
			$error[] = 'error';
			$data["status"] = 'success';$data["message"] = file_location('home_url','checkout/');
		}
		
		//if payment is payment on delivery and delivery method is door delivery trigger error
		$delivery_method = content_data('order_table,food_table','or_delivery_method',$token,'or_token',$add);
		$payment_method = content_data('order_table,food_table','or_payment_method',$token,'or_token',$add);
		if($payment_method === 'payment on delivery' && $delivery_method === 'door delivery'){
			$error[] = 'error';
			$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Payment on delivery is not available for home delivery, please select another delivery method or payment method';
		}
		
		// if unavailable content is there
		if(unavailable_cart_data($token) !== false){
			$error[] = 'error';
			$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Some Items in your cart are not available, please modify cart and remove them.';
		}
		
		if(empty($error) and empty($missing)){
			if($token !== 'no_token'){
				$order = new order('admin');
				$order->payment_method = $payment_method;
				$order->delivery_method = $delivery_method;
				$order->token = $token;
				$order->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				try{
					//begin transaction
					$order->dbconn->beginTransaction();
					//UPDATE DELIVERY_FEE AND DELIVERY_METHOD AND DELIVERY_NOTE
					$order->update_delivery_fee();
					$order->update_delivery_method();
					$order->update_payment_method();
					// commit the transation
					if($order->dbconn->commit()){
						if($payment_method === 'payment on delivery'){
							$data["status"] = 'success';$data["message"] = file_location('home_url','checkout/order_status/');
						}elseif($payment_method === 'card payment'){
							$data["status"] = 'success';$data["message"] = file_location('home_url','checkout/initialize_payment/');
						}
					}//if commit
				}catch(PDOException $e){
					//rollback
					if($order->dbconn->rollback()){
						$data["status"] = 'fail';$data["message"] = 'Error occurred while processing data';
					}//if rollback
				}// end of try and catch
			}else{
				$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while processing checkout';
			}
		}else{
			if(!empty($missing)){$data["status"] = 'error';$data["errors"] = $missing;}
		}
	}//end of if check out is disbled
}else{
	$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while processing checkout';
}//end of if empty
echo json_encode($data);
?>