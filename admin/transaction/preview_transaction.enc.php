<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','transaction/preview_transaction/'.$_GET['page']);
$page = "TRANSACTION DATA";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
if(isset($_GET['page']) AND is_numeric($_GET['page'])){ //getting the value of the get 
	$cid = test_input(($_GET['page']));
	if(!empty($cid)){	
		$id = content_data('order_table','or_order_id',$cid,'or_order_id');
		if(content_data('order_table','or_payment_received',$id,'or_order_id') === 'no'){
			trigger_error_manual(404);
		}
	}else{
		trigger_error_manual(404);
	}
}else{
	trigger_error_manual(404);
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(file_location('inc_path','meta.inc.php'));?>
<title><?=$page_name?></title>
</head>
<body class="j-color6"style="font-family:Roboto,sans-serif;width:100%;"onload="">
<?php require_once(file_location('inc_path','page_load.inc.php')); //page load?>
<!-- BODY STARTS-->
<div class="j-row">
	<div class="j-col s12 l2 j-hide-small j-hide-medium">
		<?php require_once(file_location('admin_inc_path','first_column.inc.php'));?>
	</div>
	<div class="j-col s12 l10"id='mainbody'>
		<?php require(file_location('admin_inc_path','navigation.inc.php'));?>
		<div class='j-padding'>
			<h2 class='j-text-color1 j-padding j-color4'><b>PREVIEW TRANSACTION DATA</b></h2>
		</div>
		<div class='j-row'>
			<?php
			if($id === false){
				page_not_available('short');
			}else{
				// creating connection
				require_once(file_location('inc_path','connection.inc.php'));
				@$conn = dbconnect('admin','PDO');
				$sql = "SELECT or_id,or_amount,or_delivery_fee,or_order_id,or_payment_method,or_pmt_regdatetime,or_token,or_quantity,or_status,f_id,user_id FROM order_table
				WHERE or_order_id = :order_id ORDER BY or_pmt_regdatetime DESC LIMIT 1";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':order_id',$id,PDO::PARAM_INT);
				$stmt->bindColumn('or_id',$or_id);
				$stmt->bindColumn('or_amount',$amount);
				$stmt->bindColumn('or_delivery_fee',$delivery_fee);
				$stmt->bindColumn('or_order_id',$order_id);
				$stmt->bindColumn('or_payment_method',$payment_method);
				$stmt->bindColumn('or_pmt_regdatetime',$datetime);
				$stmt->bindColumn('or_token',$token);
				$stmt->bindColumn('or_status',$status);
				$stmt->bindColumn('or_quantity',$quantity);
				$stmt->bindColumn('f_id',$f_id);
				$stmt->bindColumn('user_id',$user_id);
				$stmt->execute();
				$numRow = $stmt->rowCount();
				if($numRow > 0){// if a record is found
					while($stmt->fetch()){
						?>
						<div id=""class='j-col m7 j-padding'>
						<div class='j-color5'><div class='j-padding j-large'><b>Transaction Details</b></div></div>
							<div class="j-container j-color4 j-padding">
								<div style='line-height:30px;'>
									<div class='j-row'style='margin-bottom:15px;'>
										<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Order ID:</span><br>
										<span class='j-text-color3'><?=$id?></span>
									</div>
									<div class='j-row'style='margin-bottom:15px;'>
										<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Total Amount:</span><br>
										<span class='j-text-color3'><?=get_json_data('currency_symbol','about_us').' '.add_total($amount,$delivery_fee)?></span>
									</div>
									<div class='j-row'style='margin-bottom:15px;'>
										<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Item Amount:</span><br>
										<span class='j-text-color3'><?=get_json_data('currency_symbol','about_us').' '.$amount?></span>
									</div>
									<div class='j-row'style='margin-bottom:15px;'>
										<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Delivery Amount:</span><br>
										<span class='j-text-color3'><?=get_json_data('currency_symbol','about_us').' '.$delivery_fee?></span>
									</div>
									<div class='j-row'style='margin-bottom:15px;'>
										<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Payment Method:</span><br>
										<span class='j-text-color3'><?=$payment_method?></span>
									</div>
									<div class='j-row'style='margin-bottom:15px;'>
										<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Date:</span><br>
										<span class='j-text-color3'><?=showdate($datetime,'')?></span>
									</div>
								</div>
								<br>
							</div>
							<br>

							<div class='j-color7'><div class='j-padding j-large'><b>Order Sumammry</b></div></div>
							<div class='j-padding j-color4'>
								<a href="<?=file_location('admin_url','order/preview_order/'.$order_id.'/')?>" class='j-bolder j-text-color7 j-btn j-color1 j-round j-small'>
								Click to see order details
								</a>
								<div class=''style='line-height: 40px;'>
									<div>
										<span class='j-bolder j-text-color7'>Item Name:</span>
										<span class='j-text-color7'><?=ucwords(content_data('food_table','f_name',$f_id,'f_id','','null'))?></span>
									</div>
									<div>
										<span class='j-bolder j-text-color7'>Ordered Quantity:</span>
										<span class='j-text-color7'><?=$quantity?></span>
									</div>
									<div>
										<span class='j-bolder j-text-color7'>Order Status:</span>
										<span class='j-text-color7'><?=$status?></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class='j-col m5 j-padding'>
						<div class='j-color2'><div class='j-padding j-large'><b>Transaction Misc</b></div></div>
							<div class='j-padding j-color4'>
								<div class=''style=''>
									<div style='margin-bottom:10px;'>
										<span class='j-bolder j-text-color7'>Ref_id:</span><br>
										<span class='j-text-color5'><?=ucwords(content_data('transaction_table','t_ref_id',$token,'or_token','','null'))?></span>
									</div>
									<div style='margin-bottom:10px;'>
										<span class='j-bolder j-text-color7'>Status:</span><br>
										<span class='j-text-color5'><?=ucwords(content_data('transaction_table','t_status',$token,'or_token','','null'))?></span>
									</div>
									<div style='margin-bottom:10px;'>
										<span class='j-bolder j-text-color7'>Amount:</span><br>
										<span class='j-text-color5'><?=get_json_data('currency_symbol','about_us').' '.ucwords(content_data('transaction_table','t_amount',$token,'or_token','','null'))?></span>
									</div>
									<div style='margin-bottom:10px;'>
										<span class='j-bolder j-text-color7'>Currency:</span><br>
										<span class='j-text-color5'><?=ucwords(content_data('transaction_table','t_currency',$token,'or_token','','null'))?></span>
									</div>
									<div style='margin-bottom:10px;'>
										<span class='j-bolder j-text-color7'>Payment Method:</span><br>
										<span class='j-text-color5'><?=ucwords(content_data('transaction_table','t_payment_method',$token,'or_token','','null'))?></span>
									</div>
									<div style='margin-bottom:10px;'>
										<span class='j-bolder j-text-color7'>Bank:</span><br>
										<span class='j-text-color5'><?=ucwords(content_data('transaction_table','t_bank',$token,'or_token','','null'))?></span>
									</div>
									<div style='margin-bottom:10px;'>
										<span class='j-bolder j-text-color7'>Brand:</span><br>
										<span class='j-text-color5'><?=ucwords(content_data('transaction_table','t_brand',$token,'or_token','','null'))?></span>
									</div>
									<div style='margin-bottom:10px;'>
										<span class='j-bolder j-text-color7'>Account Name:</span><br>
										<span class='j-text-color5'><?=ucwords(content_data('transaction_table','t_account_name',$token,'or_token','','null'))?></span>
									</div>
									<div style='margin-bottom:10px;'>
										<span class='j-bolder j-text-color7'>Account Number:</span><br>
										<span class='j-text-color5'><?=ucwords(content_data('transaction_table','t_account_number',$token,'or_token','','null'))?></span>
									</div>
									<div style='margin-bottom:10px;'>
										<span class='j-bolder j-text-color7'>IP Address:</span><br>
										<span class='j-text-color5'><?=ucwords(content_data('transaction_table','t_ipaddress',$token,'or_token','','null'))?></span>
									</div>
								</div>
							</div><br>

							<div class='j-color5'><div class='j-padding j-large'><b>Customer Details</b></div></div>
							<div class='j-padding j-color4'>
								<a href="<?=file_location('admin_url','user/preview_user/'.addnum($user_id).'/')?>" class='j-bolder j-text-color7 j-button j-color1 j-round j-small'>
								Click to see customer details
								</a>
								<a href="<?=file_location('admin_url','message/send_email/'.addnum($user_id).'/')?>" class='j-right j-bolder j-text-color7 j-btn j-color1 j-round j-small'>
								Mail customer
								</a>
								<div class=''style='line-height: 40px;'>
									<div>
										<span class='j-bolder j-text-color7'>Name:</span>
										<span class='j-text-color7'><?=ucwords(content_data('user_table','u_fullname',$user_id,'u_id','','null'))?></span>
									</div>
									<div>
										<span class='j-bolder j-text-color7'>Email:</span>
										<span class='j-text-color7'><?=content_data('user_table','u_email',$user_id,'u_id','','null')?></span>
									</div>
									<div>
										<span class='j-bolder j-text-color7'>Gender:</span>
										<span class='j-text-color7'><?=ucwords(content_data('user_table','u_gender',$user_id,'u_id','','null'))?></span>
									</div>
								</div>
							</div><br>
						</div>
						<?php
					}
				}
				?>
				<?php
			}
			?>
			<span id="st"></span>
		</div>
	</div>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>