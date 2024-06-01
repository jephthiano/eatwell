<?php
if(isset($_GET['t'])){
    require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
    require_once(file_location('inc_path','session_check_nologout.inc.php'));
    $token = get_order_token();
    $add = "AND or_status = 'cart' AND order_table.f_id = food_table.f_id AND f_status = 'available' ORDER BY or_id DESC";;
    $ty = test_input($_GET['t']);
    //CHANGE THE DELIVERY FEE
    ?>
    <div class=''style='width:100%'>
        <span class='j-text-color7'style='margin-right:50px;'>Items total:</span>
        <span class='j-bolder j-text-color5 j-right'>
            <?=get_json_data('currency_symbol','about_us').' '.get_sum('order_table,food_table','or_amount',$token,'or_token',$add)?>
        </span>
    </div>
    <div class=''style='width:100%'>
        <span class='j-text-color7'style='margin-right:50px;'><?=$ty==='pickup'?'Pickup':'Delivery';?> fee:</span>
        <span class='j-bolder j-text-color7 j-right'>
            <?=get_json_data('currency_symbol','about_us').' '.delivery_fee($token,$ty)?>
        </span>
    </div>
    <div class=''style='width:100%;margin:15px 0px;'>
        <span class=''style='margin-right:50px;'>Total:</span>
        <span id=''class='j-bolder j-text-color1 j-right'>
            <?=get_json_data('currency_symbol','about_us').' '.money(total_amount($token,$ty))?>
        </span>
    </div>
    <?php
}
?>