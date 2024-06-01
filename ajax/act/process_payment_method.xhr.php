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
		
		//if one of order delivery method is not set
		if($or !==  false){
			foreach($or AS $id){
				$del = content_data('order_table','or_delivery_method',$id,'or_id');
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
		
		//PROCESS PAYMENT DETAILS
		//payment type 
		if(empty($_POST['pmt']) || !isset($_POST['pmt'])){
			$missing['pmte'] = "* Select a payment method";
		}else{
			$pay = ($_POST['pmt']);
			if($pay === 'cp'){
				if(get_json_data('online_payment','act') == 0 || get_json_data('all','act') == 0){
					$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Card Payment is not available at the moment';
					$error[] = 'error';$payment_method = '';
				}elseif(get_json_data('online_payment','act') == 1 && get_json_data('all','act') == 1){
					$payment_method = 'card payment';
				}else{
					$missing['pmte'] = "* Select a payment method";
					$payment_method = '';
				}
			}elseif($pay === 'pod'){
				if((get_json_data('cash_on_delivery','act') == 0 || get_json_data('all','act') == 0) || content_data('user_table','u_pod',$u_id,'u_id') === 'disabled'){
					$error[] = 'error';$payment_method = '';
					$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Payment on delivery is not available at the moment';
				}elseif(get_json_data('cash_on_delivery','act') == 1 && get_json_data('all','act') == 1){
					$payment_method = 'payment on delivery';
				}else{
					$missing['pmte'] = "* Select a payment method";
					$payment_method = '';
				}
			}else{
				$missing['pmte'] = "* Select a payment method";
				$payment_method = '';
			}
		}
		//if payment is payment on delivery and delivery method is door delivery trigger error
		$delivery_method = content_data('order_table,food_table','or_delivery_method',$token,'or_token',$add);
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
					//UPDATE DELIVERY_FEE AND DELIVERY_METHOD AND PAYMENT METHOD
					$order->update_delivery_fee();
					$order->update_delivery_method();
					$order->update_payment_method();
					// commit the transation
					if($order->dbconn->commit()){
						$data["status"] = 'success';$data["message"] = file_location('home_url','checkout/summary/');
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