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
        $order->delivery_method = $type;
        try{
            //begin transaction
            $order->dbconn->beginTransaction();
            $update = $order->update_delivery_fee();
            $update = $order->update_delivery_method();
			if($order->dbconn->commit()){
                $data["status"] = 'success';
            }//if commit
        }catch(PDOException $e){
            //rollback
            if($order->dbconn->rollback()){
                $data["status"] = 'fail';
            }//if rollback
        }// end of try and catch
    }else{
        $data["status"] = 'fail';
    }
}else{
    $data["status"] = 'fail';
}
echo json_encode($data);
?>