<?php
if(isset($_GET['t'])){
    require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
    require_once(file_location('inc_path','session_check_nologout.inc.php'));
    $ty = test_input($_GET['t']);
    if($ty === 'cart'){
        $token = get_order_token();
        $add = "AND or_status = 'cart' AND order_table.f_id = food_table.f_id AND f_status = 'available' ORDER BY or_id DESC";;
        //$add = "AND or_status = 'cart'";
        $numrow = get_numrow('order_table,food_table','or_token',$token,"return",'no round',$add);
        echo $numrow > 9? "9+" : $numrow;
    }elseif($ty === 'noti'){
        $numrow = distinct_numrow('notification_table','or_id','u_id',$u_id,"return",'no round',"AND n_status = 'sent'");
        echo $numrow > 9? "9+" : $numrow;
    }
}
?>