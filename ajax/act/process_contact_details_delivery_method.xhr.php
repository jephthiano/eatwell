<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
require_once(file_location('inc_path','session_check_nologout.inc.php'));
$error = []; $missing = []; $data = [];
if(isset($_POST)){
	if(get_json_data('checkout','act') == 0 || get_json_data('all','act') == 0){//if checkout and all act is disabled
		$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Checkout is not available at the moment';
	}else{
		$token = get_order_token();
		
		// process contact details
		$u_id = $u_id;
		$c_id = content_data('user_contact_table','uc_id',$u_id,'u_id',"AND uc_status = 'default'");
		if($c_id === false){
			$error[] = 'error';
			$data["status"] = 'fail';$data["message"] = 'Opps!!!<br> Your contact details is empty, add a new contact details';
		}else{
			$uc_id = $c_id;
		}
		
		//delivery type 
		if(empty($_POST['dly']) || !isset($_POST['dly'])){
			$missing['dlye'] = "* Select a delivery method";
		}else{
			$del = ($_POST['dly']);
			if($del === 'dd'){
				if(get_json_data('door_delivery','act') == 0 || get_json_data('all','act') == 0){
					$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Door Delivery is not available at the moment';
					$error[] = 'error';
				}elseif(get_json_data('door_delivery','act') == 1 && get_json_data('all','act') == 1){
					$delivery_method = 'door delivery';
				}else{
					$missing['dlye'] = "* Select a delivery method";
				}
			}elseif($del === 'pu'){
				if(get_json_data('pickup','act') == 0 || get_json_data('all','act') == 0){
					$error[] = 'error';
					$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Pickup is not available at the moment';
				}elseif(get_json_data('pickup','act') == 1 && get_json_data('all','act') == 1){
					$delivery_method = 'pickup';
				}else{
					$missing['dlye'] = "* Select a delivery method";
				}
			}else{
				$missing['dlye'] = "* Select a delivery method";
			}
		}
		
		//delivery note
		$del_not = $_POST['delnot'];
		if(empty($del_not)){$del_note = NULL;}else{$del_note = test_input($del_not);}
		
		// if unavailable content is there
		if(unavailable_cart_data($token) !== false){
			$error[] = 'error';
			$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Some Items in your cart are not available, please modify cart and remove them.';
		}
		
		if(empty($error) and empty($missing)){
			if($token !== 'no_token'){
				$order = new order('admin');
				$order->delivery_method = $delivery_method;
				$order->token = $token;
				$order->delivery_note = $del_note;
				$order->u_id = $u_id;
				$order->uc_id = $uc_id;
				$order->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				try{
					//begin transaction
					$order->dbconn->beginTransaction();
					//UPDATE USER ID
					$order->update_user_id();
					//INSERT/UPDATE INTO ORDERER TABLE
					$order->insert_update_orderer();
					//UPDATE DELIVERY_FEE AND DELIVERY_METHOD AND DELIVERY_NOTE
					$order->update_delivery_fee();
					$order->update_delivery_method();
					$order->update_delivery_note();
					// commit the transation
					if($order->dbconn->commit()){
						$data["status"] = 'success';$data["message"] = file_location('home_url','checkout/payment_method/');
					}//if commit
				}catch(PDOException $e){
					//rollback
					if($order->dbconn->rollback()){
						$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error occurred while processing data';
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