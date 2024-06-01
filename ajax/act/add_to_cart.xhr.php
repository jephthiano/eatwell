<?php
if(isset($_GET['i']) && isset($_GET['t'])){
	require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
	$error = []; $data = [];
	
	if(get_json_data('cart','act') == 0 || get_json_data('all','act') == 0){//if checkout and all act is disabled
		$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Cart is not available at the moment';
	}else{
		// validating and sanitizing content id
		$id = ($_GET['i']);
		if(empty($id) || !is_numeric($id)){$error[] = "number";}else{$c_id = test_input($id);}
		
		// validating and sanitizing type
		$ty = ($_GET['t']);
		if(empty($ty)){$error[] = "type";}else{$type = test_input($ty);}
		
		$token = get_order_token('retry');
		if(empty($error)){
			$add = " AND f_id = $c_id AND or_status = 'cart'";
			$price = content_data('food_table','f_discounted_price',$c_id,'f_id');
			$quantity = content_data('order_table','or_quantity',$token,'or_token',$add);
			$max_order = content_data('food_table','f_max_order',$c_id,'f_id');
			if($quantity >= $max_order && $type === 'add'){
				$data["status"] = 'fail';$data["message"] = "Sorry!!!<br> The maximum quantity you can order is {$max_order}";
			}else{
				if($quantity === false){
					$order = new order('admin');
					$order->quantity = 1;
					$order->delivery_fee = cal_del_fee(1);
					$order->amount = $price;
					$order->order_id = time_token();
					$order->token = $token;
					$order->f_id = $c_id;
					$insert = $order->insert_cart();
					if($insert === true){
						$data["status"] = 'success';$data["message"] = 'Item added to cart';
					}else{
						$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Error occur while adding item to cart';
					}
				}elseif($quantity == 1 && $type === 'remove'){
					$or_id = content_data('order_table','or_id',$token,'or_token',$add);
					$order = new order('admin');
					$order->token = $token;
					$order->id = $or_id;
					$order->status = 'cart';
					$delete = $order->delete_cart();
					if($delete === true){
						$data["status"] = 'success';$data["message"] = 'Item removed from cart';
					}else{
						$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Error occur while removing item from cart';
					}
				}elseif($quantity > 0 && ($type === 'add' || $type === 'remove' || $type === 'buy')){
					$current_amount = content_data('order_table','or_amount',$token,'or_token',$add);
					if($type === 'add' || $type === 'buy'){
						$new_amount = $current_amount + $price;
						$new_quantity = $quantity + 1;
					}elseif($type === 'remove'){
						$new_amount = $current_amount - $price;
						$new_quantity = $quantity - 1;
					}
					$order = new order('admin');
					$order->quantity = $new_quantity;
					$order->delivery_fee = cal_del_fee($new_quantity);
					$order->amount = $new_amount;
					$order->token = $token;
					$order->f_id = $c_id;
					$update = $order->update_cart();
					if($update === true){
						$data["status"] = 'success';$data["message"] = 'Cart updated';
					}else{
						$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Error occur while updating cart';
					}
				}
			}
		}else{
			$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br> Error occur while adding item to cart';
		}//end of if empty
	}
	echo json_encode($data);
}//end of if isset
?>