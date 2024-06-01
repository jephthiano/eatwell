<?php
if(isset($_GET['t'])){
    require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
    require_once(file_location('inc_path','session_check_nologout.inc.php'));
	$error = []; $data = [];
    $token = get_order_token();
    $ty = test_input($_GET['t']);
    if(empty($ty)){$error[] = "empty";}else{$type = test_input($ty);}
    if(empty($error)){
        $order = new order('admin');
		$order->token = $token;
        $order->payment_method = $type;
        $update = $order->update_payment_method('single');
        if($update){$data["status"] = 'success';}else{$data["status"] = 'fail';}
    }else{
        $data["status"] = 'fail';
    }
}else{
    $data["status"] = 'fail';
}
echo json_encode($data);
?>