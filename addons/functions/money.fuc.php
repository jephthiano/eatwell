<?php
//MONEY FUNCTION STARTS

// money format starts
function money($num,$type='default'){if($type === 'default'){return number_format($num,2,'.',',');}else{return number_format($num,0);}}
// money format ends

//get sum starts
function get_sum($table,$column,$param,$crit,$add='',$type='money'){
// creating connection
		require_once(file_location('inc_path','connection.inc.php'));
  @$conn = dbconnect('admin','PDO');
  $sql = "SELECT SUM($column) AS total_amount FROM {$table}
  WHERE {$crit} = :param {$add}";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':param',$param,PDO::PARAM_STR);
		$stmt->bindColumn('total_amount',$total_sum);
		$stmt->execute();
		$numRow = $stmt->rowCount();
		if($numRow > 0){
			while($stmt->fetch()){
    if($type === 'normal'){
     return ($total_sum);
    }else{
     return money($total_sum);
    }
			}// end of while
  }else{
   return (int)0;
  }
 closeconnect('stmt',$stmt);
 closeconnect('db',$conn);  
}
// get sum ends

// calculate delivery fee starts
function cal_del_fee($quantity,$type='door delivery'){
 $pickup_fee = get_json_data('pickup_fee','about_us');
 $delivery_fee = get_json_data('delivery_fee','about_us');
 if($type === 'pickup'){
   if($pickup_fee > 0){
   if($quantity < 2){
    return $pickup_fee;
   }elseif($quantity > 1 && $quantity < 5){
    return (($pickup_fee-100)*$quantity);
   }elseif($quantity > 4){
    return (($pickup_fee-100)*5);
   }
  }else{
   return 0;
  }
 }else{
  if($quantity < 2){
   return $delivery_fee;
  }elseif($quantity > 1 && $quantity < 5){
   return (($delivery_fee-200)*$quantity);
  }elseif($quantity > 4){
   return (($delivery_fee-200)*5);
  }
 }
}
// calculate delivery fee ends

//delivery fee starts
function delivery_fee($token,$type='cart'){
 if($type === 'delivered'){
  $add = "AND or_status != 'cart'";
  $fee=  get_sum('order_table','or_delivery_fee',$token,'or_token',$add,'normal');
 }else{
  $add = "AND or_status = 'cart' AND order_table.f_id = food_table.f_id AND f_status = 'available'";
  $fee=  get_sum('order_table,food_table','or_delivery_fee',$token,'or_token',$add,'normal');
 }
 return $fee;
 }
//delivery fee ends

// total amount starts
function total_amount($token,$type='cart'){
 $add = "AND or_status = 'cart' AND order_table.f_id = food_table.f_id AND f_status = 'available' ORDER BY or_id DESC";;
 $fee = delivery_fee($token,$type);
 $sum = get_sum('order_table,food_table','or_amount',$token,'or_token',$add,'normal');
 return ($sum)+($fee);
}
// total amount ends

//function payment details starts
function payment_details($token){
  ?>
  <div>Items Total: <?=get_json_data('currency_symbol','about_us').' '.get_sum('order_table','or_amount',$token,'or_token')?></div>
  <?php $delivery_method = content_data('order_table','or_delivery_method',$token,'or_token');?>
  <div><?=ucwords($delivery_method)?> Fees: <?=get_json_data('currency_symbol','about_us').' '.delivery_fee($token,'delivered')?></div>
  <div>Total: <?=get_json_data('currency_symbol','about_us').' '.content_data('transaction_table','t_amount',$token,'or_token')?></div>
  <?php
}
//function payment details ends

// amount function starts
function amount_sum($column='',$param='',$add=''){
 // creating connection
 require_once(file_location('inc_path','connection.inc.php'));
 @$conn = dbconnect('admin','PDO');
 if(empty($column) && empty ($param)){
  $where = '';
 }else{
  $where = "WHERE {$column} = :param";
 }
 $sql = "SELECT SUM(t_amount) AS total_amount FROM transaction_table
 {$where} {$add}";
 $stmt = $conn->prepare($sql);
 if(!empty($column)){$stmt->bindParam(':param',$param,PDO::PARAM_STR);}
 $stmt->bindColumn('total_amount',$total_amount);
 $stmt->execute();
 $numRow = $stmt->rowCount();
 if($numRow > 0){
  while($stmt->fetch()){
   if($total_amount > 0){
    return $total_amount;
   }else{
    return 0;
   }
  }// end of while
 }else{
  return 0;
 }
 closeconnect('stmt',$stmt);
 closeconnect('db',$conn); 
}
//amount function ends

// payment sum function starts
function paid_sum($id='or_amount',$column='',$param='',$add=''){
 // creating connection
 require_once(file_location('inc_path','connection.inc.php'));
 @$conn = dbconnect('admin','PDO');
 if(empty($column) && empty ($param)){
  $where = '';
 }else{
  $where = "{$column} = :param AND";
 }
 $sql = "SELECT SUM({$id}) AS total_amount FROM order_table WHERE {$where} or_payment_received = 'yes' {$add}";
 $stmt = $conn->prepare($sql);
 if(!empty($column)){$stmt->bindParam(':param',$param,PDO::PARAM_STR);}
 $stmt->bindColumn('total_amount',$total_amount);
 $stmt->execute();
 $numRow = $stmt->rowCount();
 if($numRow > 0){
  while($stmt->fetch()){
   if($total_amount > 0){
    return $total_amount;
   }else{
    return 0;
   }
  }// end of while
 }else{
  return 0;
 }
 closeconnect('stmt',$stmt);
 closeconnect('db',$conn); 
}
//payment function ends

// refund sum function starts
function refund_sum($column='',$param='',$add=''){
 // creating connection
 require_once(file_location('inc_path','connection.inc.php'));
 @$conn = dbconnect('admin','PDO');
 if(empty($column) && empty($param)){
  $where = '';
 }else{
  $where = "WHERE {$column} = :param";
 }
 $sql = "SELECT SUM(r_amount) AS total_amount FROM refund_table {$where} {$add}";
 $stmt = $conn->prepare($sql);
 if(!empty($column)){$stmt->bindParam(':param',$param,PDO::PARAM_STR);}
 $stmt->bindColumn('total_amount',$total_amount);
 $stmt->execute();
 $numRow = $stmt->rowCount();
 if($numRow > 0){
  while($stmt->fetch()){
   if($total_amount > 0){
    return $total_amount;
   }else{
    return 0;
   }
  }// end of while
 }else{
  return 0;
 }
 closeconnect('stmt',$stmt);
 closeconnect('db',$conn); 
}
//refund function ends

// add total starts
function add_total($y=0,$x=0){
 if(is_numeric($y) && is_numeric($x)){
  return ($y+$x);
 }else{
  return 'Not Available';
 }

}
// add total ends

// get revenue starts
function get_revenue($y=0,$x=0){
 if(is_numeric($y) && is_numeric($x)){
  return ($y-$x);
 }else{
  return 'Not Available';
 }
}
// get revenue ends
//MONEY FUNCTION ENDS
?>