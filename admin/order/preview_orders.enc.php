<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','order/preview_orders/'.$_GET['page']);
$page = "ORDERS DATA";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
if(isset($_GET['page']) AND is_numeric($_GET['page'])){ //getting the value of the get 
	$cid = test_input($_GET['page']);
	if(!empty($cid)){	
		$order_token = content_data('order_table','or_token',$cid,'or_token');
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
			<h2 class='j-text-color1 j-padding j-color4'><b>PREVIEW ORDERS DATA</b></h2>
		</div>
		<div class='j-margin'>
			<div class=''>
				<a href="<?=file_location('admin_url','order/all/')?>"class="j-btn j-color1 j-left j-round j-card-4 j-bolder">All Orders</a>
			</div>
		</div>
		<br class='j-clearfix'>
		<div class='j-row'>
			<?php
			if($order_token === false){
				page_not_available('short');
			}else{
				$or_id = content_data('order_table','or_id',$order_token,'or_token','','null');
				$placed_time = content_data('order_history_table','oh_regdatetime',$or_id,'or_id',"AND oh_status = 'order placed'",'null');
				$total = get_numrow('order_table','or_token',$order_token,"return",'no round',"AND or_status != 'cart'",'null');
				$uc_id = content_data('orderer_table','uc_id',$order_token,'or_token','','null');
				$user_id = content_data('user_contact_table','u_id',$uc_id,'uc_id','','null');
				if($user_id === false){$user_id = 0;}
				?>
				<div id=""class='j-col m7 j-padding'>
				<div class='j-color7'><div class='j-padding j-large'><b>Order(s) Info</b></div></div>
					<div class="j-container j-color4 j-padding">
						<div style='line-height:30px;'>
							<div class='j-padding'>
								<div>
									<div class='j-bolder'><span>Order No:</span> <span  class='j-text-color5'><?=content_data('order_table','or_token',$order_token,'or_token','','null')?></span></div>
									<div><?=$total?> Item(s)</div>
									<div class='j-text-color7 j-bolder'>Placed on
									<?=showdate($placed_time,'short').'  '.show_time($placed_time)?>
									</div>
									<div><span class='j-bolder'>Total:</span> <span class='j-text-color5'><?=get_json_data('currency_symbol','about_us').' '.content_data('transaction_table','t_amount',$order_token,'or_token','','null')?></span></div>
								</div>
								<hr>
							</div>
							<div class='j-padding'>
								<div class='j-bolder j-text-color5'>ITEMS IN ORDER</div>
							</div>
							<div class=''>
								<?php
								$or = multiple_content_data('order_table','or_id',$order_token,'or_token',"AND or_status != 'cart' ORDER BY or_id DESC");
								if($or !== false){
									foreach($or AS $or_id){
										$id = content_data('order_table','f_id',$or_id,'or_id','','null');
										show_food($id,'order_details','admin',$or_id);
									}
								}
								?>
							</div>
						</div>
						<br<br><br>
					</div>
				</div>
				<br>
				
				<div id=""class='j-col m5'>
				<div class='j-color3'><div class='j-padding j-large'><b>Customer Summary</b></div></div>
					<div class='j-padding j-color4'>
						<a href="<?=file_location('admin_url','user/preview_user/'.addnum($user_id).'/')?>" class='j-bolder j-text-color7 j-btn j-color1 j-round j-small'>
						Click to see customer details
						</a>
						<a href="<?=file_location('admin_url','message/send_email/'.addnum($user_id).'/')?>" class=' j-right j-bolder j-text-color7 j-btn j-color1 j-round j-small'>
						Mail customer
						</a>
						<div class='j-medium'style='line-height: 40px;'>
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
					</div>
					<br>
					
					<div class='j-color5'><div class='j-padding j-large'><b>Payment Infomation</b></div></div>
					<div class='j-padding j-color4'>
						<div class='j-border-2 j-border-color5 j-round j-medium'>
							<div class='j-padding'>
								<div class='j-bolder'>Payment Method</div>
								<div class='j-text-color5'><?=content_data('transaction_table','t_payment_method',$order_token,'or_token','','null')?></div>
							</div>
							<div class='j-padding'>
								<div class='j-bolder'>Payment Details</div>
								<div class='j-text-color5'>
									<div><?php payment_details($order_token)?></div>
								</div>
							</div>
						</div>
					</div>
					<br>
					
					<div class='j-color2'><div class='j-padding j-large'><b>Delivery Information</b></div></div>
					<div class='j-padding j-color4'>
						<div class='j-border-2 j-border-color5 j-round'>
							<?php $delivery_method = content_data('order_table','or_delivery_method',$order_token,'or_token','','null');?>
							<div class='j-padding'>
								<div class='j-bolder'>Delivery Method</div>
								<div class='j-text-color5'><?=ucwords($delivery_method)?></div>
							</div>
							<?php
							if($delivery_method === 'door delivery'){
								?>
								<div class='j-padding'>
									<div class='j-bolder'>Contact Details</div>
									<div class='j-text-color5'>
										<div><?php get_contact_detail($uc_id)?></div>
									</div>
								</div>
								<?php
							}
							?>
							</div>
					</div>
					<br>
					
					<div class='j-color7'><div class='j-padding j-large'><b>Transaction Summary</b></div></div>
					<div class='j-padding j-color4'>
							<?php $trans_id = content_data('transaction_table','t_id',$order_token,'or_token','','null')?>
							<div class='j-medium'style='line-height:30px;'>
								<div>
									<span class='j-bolder j-text-color7'>Status:</span>
									<span class='j-text-color7'><?=ucwords(content_data('transaction_table','t_status',$trans_id,'t_id','','null'))?></span>
								</div>
								<div>
									<span class='j-bolder j-text-color7'>Amount:</span>
									<span class='j-text-color7'><?=content_data('transaction_table','t_currency',$trans_id,'t_id','','null').' '.ucwords(content_data('transaction_table','t_amount',$trans_id,'t_id','','null'))?></span>
								</div>
								<div>
									<span class='j-bolder j-text-color7'>Payment Method:</span>
									<span class='j-text-color7'><?=ucwords(content_data('transaction_table','t_payment_method',$trans_id,'t_id','','null'))?></span>
								</div>
							</div>
						</div>
						<br>
				</div>
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