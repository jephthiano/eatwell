<?php
// creating connection
require_once(file_location('inc_path','connection.inc.php'));
@$conn = dbconnect('admin','PDO');
if(empty($searchtext)){// if the search text is not empty
  //PAGINATION CODE START HERE
  $display = 20; // number of records to show per page
  //calculate the number of pages
  if($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_admin_result.xhr.php'){ //for admin
    $total_records = get_numrow('admin_table','ad_id',1,"return",'no round',"AND {$add}",'not');
  }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_social_handle_result.xhr.php'){ //for social_handle
    $total_records = get_numrow('social_handle_table','','',"return",'no round');
  }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_message_result.xhr.php'){ //for message
    $total_records = get_numrow('message_table','','',"return",'no round',"WHERE {$add}");
  }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_category_result.xhr.php'){ //for category
    $total_records = get_numrow('category_table','','',"return",'no round');
  }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_food_result.xhr.php'){ //for food
    $total_records = get_numrow('food_table','f_status',$status2,"return",'no round');
  }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_user_result.xhr.php'){ //for user
    $total_records = get_numrow('user_table','u_id','NULL',"return",'no round',"{$add}",'not');
  }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_order_result.xhr.php'){ //for order
    $total_records = get_numrow('order_table','or_id','NULL',"return",'no round',"{$add}",'not');
  }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/transaction/get_transaction_result.xhr.php'){ //for all transaction
    $total_records = get_numrow('order_table','','',"return",'no round',"WHERE {$add}");
  }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/transaction/get_annual_transaction_result.xhr.php'){ //for annual transaction
    if($status2 === 'all'){$id = 'or_pmt_year';}else{$id = 'or_pmt_month';}
    $total_records = distinct_numrow('order_table',$id,'','','return','no round',$add);
  }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/transaction/get_monthly_transaction_result.xhr.php'){ //for monthly transaction
    if($status2 === 'all'){$id = 'or_pmt_month';}else{$id = 'or_pmt_date';}
    $total_records = distinct_numrow('order_table',$id,'','','return','no round',$add);
  }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/transaction/get_daily_transaction_result.xhr.php'){ //for daily transaction
    if($status2 === 'all'){$id = 'or_pmt_date';}else{$id = 'or_id';}
    $total_records = distinct_numrow('order_table',$id,'','','return','no round',$add);
  }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_refund_result.xhr.php'){ //for refund
    if($status2 === 'pending refund'){
      $total_records = get_numrow('order_table','or_payment_received','yes',"return",'no round',$add);
    }else{
      $total_records = get_numrow('refund_table','','',"return",'no round');
    }
  }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_log_result.xhr.php'){ //for log
    $total_records = get_numrow('log_table','','',"return",'no round');
  }
  
  if($total_records > $display){ // if the number of record is more than the displayed num(10)
    $total_pages = ceil($total_records / $display);
  }else{ // if the number of record is not more than the displayed num(10)
    $total_pages = 1;
  }
  
  // getting the current page and where to start
  if(isset($cur_page) && is_numeric($cur_page) && $cur_page > 0){ // for other pages other than first page
    $current_page =  $cur_page; //  get the current page from the url if it is  not the first page
    $start = ($current_page * $display) - $display;            // use the current page to determine the $start in the LIMIT
    if($cur_page > $total_pages){trigger_error_manual(404);;}// what to echo if the user enter more than maximum page
  }else{ // if $_GET IS empty
    $current_page = 1;  $start = 0;// for the first page
  }
}
?>