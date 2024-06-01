<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','order/preview_order/'.$_GET['page']);
$page = "ORDER DATA";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
if(isset($_GET['page']) AND is_numeric($_GET['page'])){ //getting the value of the get 
	$cid = test_input($_GET['page']);
	if(!empty($cid)){	
		$order_id = content_data('order_table','or_order_id',$cid,'or_order_id');
		$order_token = content_data('order_table','or_token',$order_id,'or_order_id');
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
			<h2 class='j-text-color1 j-padding j-color4'><b>PREVIEW ORDER DATA</b></h2>
		</div>
		<div class='j-row'>
			<div class='j-margin'>
				<div class=''>
					<a href="<?=file_location('admin_url','order/all/')?>"class="j-btn j-color1 j-left j-round j-card-4 j-bolder">All Orders</a>
				</div>
				<?php
				if($order_id !== false && get_numrow('order_table','or_token',$order_token,"return",'no round') > 1){ //if order is not false
					?>
					<div class=''>
						<a href="<?=file_location('admin_url',"order/preview_orders/$order_token")?>"class="j-btn j-color1 j-right j-round j-card-4 j-bolder">Back to current customer orders</a>
					</div>
					<?php
				}
				?>
			</div>
			<br class='j-clearfix'><br>
				<?php
				if($order_id === false){
					page_not_available('short');
				}else{
					$order_token = content_data('order_table','or_token',$order_id,'or_order_id','','null');
					$or_id = content_data('order_table','or_id',$order_id,'or_order_id','','null');
					$cur_status = content_data('order_table','or_status',$or_id,'or_id','','null');
					$item_fee = content_data('order_table','or_amount',$or_id,'or_id','','null');
					$delivery_fee = content_data('order_table','or_delivery_fee',$or_id,'or_id','','null');
					$total_fee = $item_fee + $delivery_fee;
					$f_id = content_data('order_table','f_id',$order_id,'or_order_id','','null');
					$f_status = content_data('food_table','f_status',$f_id,'f_id','','null');
					$fm_id = content_data('food_media_table','fm_id',$f_id,'f_id','','null');
					$placed_time = content_data('order_history_table','oh_regdatetime',$or_id,'or_id',"AND oh_status = 'order placed'",'null');
					$uc_id = content_data('orderer_table','uc_id',$order_token,'or_token','','null');
					$user_id = content_data('user_contact_table','u_id',$uc_id,'uc_id','','null');
					?>
					<div id=""class='j-col m7 j-padding'>
						<div class='j-color5'><div class='j-padding j-large'><b>Order Info</b></div></div>
						<div class="j-container j-color4 j-padding">
							<?php
							if($cur_status === 'packaging' || $cur_status === 'in-transit' || $cur_status === 'delivered'){
								?>
								<div onclick="print_page('print_receipt');"class='j-round j-clickable j-text-color4 j-color1 j-btn'>
									<span class=""><i class='<?=icon('print','fas');?>'></i></span>
									<span class="j-bolder">Print Invoice</span>
								</div>
								<?php
							}
							if($cur_status === 'order placed' || $cur_status === 'confirmed' || $cur_status === 'packaging' || $cur_status === 'in-transit' || $cur_status === 'ready-for-pickup' || $cur_status === 'delivered'){
								?>
								<div class='j-round j-right j-clickable j-text-color4 j-color1 j-btn'onclick="$('#update_order<?=$or_id?>').fadeIn('slow');">
									<span class=""><i class='<?=icon('sort-amount-up');?>'></i></span>
									<span class="j-bolder">Update Order Status</span>
								</div>
								<?php
							}
							?>
							<?php preview_modal('order',$or_id);?>
							<br>
							<div class='j-clearfix'style='padding-left:16px;'>
								<span class='j-bolder j-text-color7'>Order Status: </span>
								<span class='j-bolder j-text-color5'><?=ucwords($cur_status);?></span>
							</div>
							<div style='line-height:30px;'>
								<div class='j-padding'>
									<div>
										<div class='j-bolder'><span>Order token:</span> <span  class='j-text-color5'><?=$order_token?></span></div>
										<div class='j-bolder'><span>Order id:</span> <span  class='j-text-color5'><?=$order_id?></span></div>
										<div class='j-text-color7 j-bolder'>Placed on
										<?=showdate($placed_time,'short').'  '.show_time($placed_time)?>
										</div>
									</div>
									<hr>
								</div>
								<div class='j-padding'>
									<a href="<?=file_location('admin_url',"food/preview_food/".addnum($f_id))?>">
										<div class='j-row'>
										 <div class='j-col s4 m2 j-display-container'>
										  <img class='j-round'src="<?=file_location('media_url',get_media('food',$fm_id))?>"style='width:100%;height:80px;'>
										  <?=out_of_stock($f_status);?>
										 </div>
										 <div class='j-col s8 m10'style='padding:0px 9px;'>
										  <div class='j-large'style='font-size:16px;'><?=ucwords(content_data('food_table','f_name',$f_id,'f_id','','null'))?></div>
										  <div class=''><span class='j-text-color5'>Quantity:</span> <?=content_data('order_table','or_quantity',$or_id,'or_id','','null')?></div>
										 </div>
										</div>
										<div style='margin-bottom:9px;margin-top:5px'>
										 <div class='j-bolder'>
										   <span style='margin-right:8px;'>Item Total Fee: </span>
										   <span class='j-text-color5'><?=get_json_data('currency_symbol','about_us').' '.$item_fee?></span>
										  </div>
										  <div class='j-bolder'>
										   <span style='margin-right:8px;'><?=ucwords(content_data('order_table','or_delivery_method',$or_id,'or_id','','null'))?> Fee: </span>
										   <span class='j-text-color5'><?=get_json_data('currency_symbol','about_us').' '.$delivery_fee?></span>
										  </div>
										  <div class='j-bolder'>
										   <span style='margin-right:8px;'>Total Fee: </span>
										   <span class='j-text-color5'><?=get_json_data('currency_symbol','about_us').' '.$total_fee?></span>
										  </div>
										</div>
									   </a>
								</div>
								<div class='j-padding'>
									<div class='j-text-color1 j-bolder j-large'>Delivery Note</div>
									<div class='j-text-color5'><?=content_data('order_table','or_delivery_note',$or_id,'or_id','','null')?></div>
								</div>
							</div>
							<hr>
							<div class="j-container j-color4 j-padding">
								<div class='j-text-color1 j-bolder j-xlarge j-center'>Payment And Delivery Details</div>
								<div>
									<div class='j-row'>
										<div class='j-col m6 j-padding'>
											<div class='j-border-2 j-border-color5 j-round'>
												<div class='j-padding j-bolder'>PAYMENT INFORMATION</div>
												<hr>
												<div class='j-padding'>
													<div class='j-bolder'>Payment Method</div>
													<div class='j-text-color5'><?=content_data('transaction_table','t_payment_method',$order_token,'or_token','','null')?></div>
												</div>
												<div class='j-padding'>
													<div class='j-bolder'>Payment Details</div>
													<div class='j-text-color5'>
														<div class='j-bolder'>
															<span style='margin-right:8px;'>Item Total Fee: </span>
															<span class='j-text-color5'><?=get_json_data('currency_symbol','about_us').' '.$item_fee?></span>
														</div>
														<div class='j-bolder'>
															<span style='margin-right:8px;'><?=ucwords(content_data('order_table','or_delivery_method',$or_id,'or_id','','null'))?> Fee: </span>
															<span class='j-text-color5'><?=get_json_data('currency_symbol','about_us').' '.$delivery_fee?></span>
														</div>
														<div class='j-bolder'>
															<span style='margin-right:8px;'>Total Fee: </span>
															<span class='j-text-color5'><?=get_json_data('currency_symbol','about_us').' '.$total_fee?></span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class='j-col m6 j-padding'>
											<div class='j-border-2 j-border-color5 j-round'>
												<div class='j-padding j-bolder'>DELIVERY INFORMATION</div>
												<?php $delivery_method = content_data('order_table','or_delivery_method',$order_token,'or_token');?>
												<hr>
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
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class='j-col m5'>
					<div class='j-color5'><div class='j-padding j-large'><b>Payment</b></div></div>
						<div class='j-padding j-color4'>
							<div class='j-large j-bolder j-text-color1'>Payment Made</div>
							<div>
								<span class='j-bolder j-text-color7'>Status:</span>
								<span class='j-bolder j-text-color5'><?=content_data('order_table','or_payment_received',$order_id,'or_order_id','','null')?></span>
							</div>
						</div>
						<br>
						<?php
						$refund_status = content_data('order_table','or_refund',$order_id,'or_order_id');
						$payment_recieved = content_data('order_table','or_payment_received',$or_id,'or_id');
						if(($cur_status === 'cancelled' || $cur_status === 'failed delivery' || $cur_status === 'returned') && $payment_recieved === 'yes'){
							?>
							<div class='j-color5'><div class='j-padding j-large'><b>Refund</b></div></div>
							<div class='j-padding j-color4'>
								<?php
								if($refund_status === 'no'){
									?>
									<div class='j-round j-clickable j-text-color4 j-color1 j-btn'onclick="$('#update_refund<?=$or_id?>').fadeIn('slow');">
										<span class=""><i class='<?=icon('money-check','fas');?>'></i></span>
										<span class="">Refund Customer</span>
									</div>
									<?php
								}
								?>
								<div class=''style='line-height: 40px;'>
									<div>
										<span class='j-bolder j-text-color7'>Status:</span>
										<span class='j-bolder j-text-color5'><?=$refund_status === 'no'?'Not Yet Refunded':'Refunded'?></span>
									</div>
									<?php
									if($refund_status === 'yes'){
										?>
										<div>
											<span class='j-bolder j-text-color7'>Amount:</span>
											<span class='j-bolder j-text-color5'><?=get_json_data('currency_symbol','about_us').' '.content_data('refund_table','r_amount',$order_id,'or_order_id','','null');?></span>
										</div>
										<div>
											<span class='j-bolder j-text-color7'>Date:</span>
											<span class='j-bolder j-text-color5'><?=showdate(content_data('refund_table','r_regdatetime',$order_id,'or_order_id','','null'),'')?></span>
										</div>
										<?php
									}
									?>
								</div>
							</div>
							<br>
							<?php
						}
						?>
						<?php
						if($cur_status === 'cancelled'){
							?>
							<div class='j-color4'><div class='j-padding j-large'><b>Cancel Details</b></div></div>
							<div class='j-padding j-color4'>
								<div class='j-large j-bolder j-text-color1'>Reason For Order Cancel</div>
								<div class=''style='line-height: 40px;'>
									<span class='j-bolder j-text-color7'><?=content_data('order_table','or_cancel_reason',$order_id,'or_order_id','','null')?></span>
								</div><hr>
							</div>
							<br>
							<?php
						}
						?>
						<div class='j-color2'><div class='j-padding j-large'><b>Customer Summary</b></div></div>
						<div class='j-padding j-color4'>
							<a href="<?=file_location('admin_url','user/preview_user/'.addnum($user_id).'/')?>" class='j-bolder j-text-color7 j-btn j-color1 j-round j-small'>
							Click here to see customer details
							</a>
							<a href="<?=file_location('admin_url','message/send_email/'.addnum($user_id).'/')?>" class=' j-right j-bolder j-text-color7 j-btn j-color1 j-round j-small'>
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
						</div>
						<br>
						
						<div class='j-color2'><div class='j-padding j-large'><b>Order History</b></div></div>
						<div class='j-padding j-color4'>
							<div class='j-padding j-small'>
								<?php track_item($order_id,'admin');?>
							</div>
						</div>
						<br>

						<div class='j-color5'><div class='j-padding j-large'><b>Review and Rating</b></div></div>
						<div class='j-padding j-color4'>
							<?php
							$add="AND u_id = '{$user_id}' AND or_id = '{$or_id}'";
							$or = multiple_content_data('review_table','r_id',$f_id,'f_id',$add);
							if($or !== false){
								foreach($or AS $r_id){get_rating($r_id,'second_column_feedback');}
							}else{
								?><div class='j-text-color7'style='margin-top:8px;'>No rating is available at the moment</div><?php
							}
							?>
						</div>

						<br>
						<?php
						if(content_data('order_table','or_payment_received',$order_id,'or_order_id') === 'yes'){
							?>
							<div class='j-color3'><div class='j-padding j-large'><b>Transaction Summary</b></div></div>
							<div class='j-padding j-color4'>
								<?php $trans_id = content_data('transaction_table','t_id',$order_token,'or_token')?>
								<a href="<?=file_location('admin_url','transaction/preview_transaction/'.($order_id).'/')?>" class='j-bolder j-text-color7 j-btn j-color1 j-round j-small'>
								See Transation Details
								</a>
								<div class=''style='line-height:30px;'>
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
							<?php
						}
						?>
					</div>
					<?php
				}
				?>
			<span id="st"></span>
		</div>
	</div>
</div>
<? // sales invoice?>
<div  id="" class="j-hide">
     <div id='print_receipt'>
      <?php require_once(file_location('admin_inc_path','print_order.inc.php')); //sales invoice?>
     </div>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>