<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','refund/preview_refund/'.$_GET['page']);
$page = "REFUND DATA";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
if(isset($_GET['page']) AND is_numeric($_GET['page'])){ //getting the value of the get 
	$cid = test_input(($_GET['page']));
	if(!empty($cid)){	
		$id = content_data('refund_table','or_order_id',$cid,'or_order_id');
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
			<h2 class='j-text-color1 j-padding j-color4'><b>PREVIEW REFUND DATA</b></h2>
		</div>
		<center>
			<div class='j-padding'>
				<a href="<?=file_location('admin_url','refund/refund/')?>"class='j-bolder j-btn j-color1 j-right j-round j-card-4'>All Refund</a>
				<span class='j-clearfix'></span>
			</div>
			</center>
			<br class='j-clearfix'>
		<div class='j-row'>
			<?php
			if($id === false){
				page_not_available('short');
			}else{
				// creating connection
				require_once(file_location('inc_path','connection.inc.php'));
				@$conn = dbconnect('admin','PDO');
				$sql = "SELECT r_id,r_amount,or_order_id,r_regdatetime,user_id FROM refund_table
				WHERE or_order_id = :order_id ORDER BY r_regdatetime DESC LIMIT 1";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':order_id',$id,PDO::PARAM_INT);
				$stmt->bindColumn('r_id',$r_id);
				$stmt->bindColumn('r_amount',$amount);
				$stmt->bindColumn('or_order_id',$order_id);
				$stmt->bindColumn('r_regdatetime',$datetime);
				$stmt->bindColumn('user_id',$user_id);
				$stmt->execute();
				$numRow = $stmt->rowCount();
				if($numRow > 0){// if a record is found
					while($stmt->fetch()){
						?>
						<div id=""class='j-col m7 j-padding'>
							<div class='j-color5'><div class='j-padding j-large'><b>Refund Details</b></div></div>
							<div class="j-container j-color4 j-padding">
								<div style='line-height:30px;'>
									<div class='j-row'style='margin-bottom:15px;'>
										<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Order ID:</span><br>
										<span class='j-text-color3'><?=$id?></span>
									</div>
									<div class='j-row'style='margin-bottom:15px;'>
										<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Total Amount:</span><br>
										<span class='j-text-color3'><?=get_json_data('currency_symbol','about_us').' '.$amount?></span>
									</div>
									<div class='j-row'style='margin-bottom:15px;'>
										<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Date:</span><br>
										<span class='j-text-color3'><?=showdate($datetime,'')?></span>
									</div>
								</div>
								<br>
							</div>
							<br>

							<div class='j-color2'><div class='j-padding j-large'><b>Order Summary</b></div></div>
							<div class='j-padding j-color4'>
								<a href="<?=file_location('admin_url','order/preview_order/'.$order_id.'/')?>" class='j-bolder j-text-color7 j-btn j-color1 j-round j-small'>
								Click to see order details
								</a>
								<div class=''style='line-height: 40px;'>
									<?php
									$f_id = content_data('order_table','f_id',$order_id,'or_order_id');
									$amount = content_data('order_table','or_amount',$order_id,'or_order_id');
									$delivery_fee = content_data('order_table','or_delivery_fee',$order_id,'or_order_id');
									?>
									<div>
										<span class='j-bolder j-text-color7'>Item Name:</span>
										<span class='j-text-color7'><?=ucwords(content_data('food_table','f_name',$f_id,'f_id','','null'))?></span>
									</div>
									<div>
										<span class='j-bolder j-text-color7'>Ordered Quantity:</span>
										<span class='j-text-color7'><?=content_data('order_table','or_quantity',$order_id,'or_order_id','','null')?></span>
									</div>
									<div>
										<span class='j-bolder j-text-color7'>Order Status:</span>
										<span class='j-text-color7'><?=content_data('order_table','or_status',$order_id,'or_order_id','','null')?></span>
									</div>
									<div>
										<span class='j-bolder j-text-color7'>Total Amount:</span>
										<span class='j-text-color7'><?=get_json_data('currency_symbol','about_us').' '.add_total($amount,$delivery_fee)?></span>
									</div>
									<div>
										<span class='j-bolder j-text-color7'>Item amount:</span>
										<span class='j-text-color7'><?=$amount?></span>
									</div>
									<div>
										<span class='j-bolder j-text-color7'>Delivery Amount:</span>
										<span class='j-text-color7'><?=$delivery_fee?></span>
									</div>
								</div><hr>
							</div>
						</div>
						
						<div class='j-col m5 j-padding'>
						<div class='j-color7'><div class='j-padding j-large'><b>Customer Details</b></div></div>
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
								</div><hr>
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