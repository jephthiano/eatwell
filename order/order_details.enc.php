<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','order/order_details/'.$_GET['val']);
require_once(file_location('inc_path','session_check.inc.php'));
if(isset($_GET['val'])){
	$raw_val = test_input($_GET['val']);
	if(!empty($raw_val)){$order_token = content_data('order_table','or_token',$raw_val,'or_token',"AND or_status != 'cart'");}else{trigger_error_manual(404);}
}else{
	trigger_error_manual(404);
}
//for meta
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "ORDER DETAILS | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
insert_page_visit('order details');
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class="j-color6"style="font-family:Roboto,sans-serif;">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page load?>
	<div class='j-hide-small j-hide-medium'><?php require(file_location('inc_path','navigation.inc.php')); //navigation?></div>
	<div class='j-row j-home-padding'style='padding-top:0px;'>
		<div class='j-col l4 xl3 '><?php require_once(file_location('inc_path','account_first_column.inc.php')); //account first column?></div>
		<div class='j-col l8 xl9 j-padding-flexible'>
			<div class='j-color4 j-account-height'>
				<?php
				if($order_token === false || content_data('orderer_table','u_id',$order_token,'or_token') !== $u_id){
					trigger_error_manual(404);
				}else{
					$or_id = content_data('order_table','or_id',$order_token,'or_token','','null');
					$placed_time = content_data('order_history_table','oh_regdatetime',$or_id,'or_id',"AND oh_status = 'order placed'",'null');
					$total = get_numrow('order_table','or_token',$order_token,"return",'no round',"AND or_status != 'cart'");
					?>
					<?php get_header('ORDER DETAILS','order/order placed/')?>
						<div class='j-padding'>
							<div>
								<div class='j-bolder'><span>Order No:</span> <span  class='j-text-color5'><?=content_data('order_table','or_token',$order_token,'or_token','','null')?></span></div>
								<div><?=$total?> Item(s)</div>
								<div class='j-text-color7 j-bolder'>Placed on
									<?=showdate($placed_time,'short').'  '.show_time($placed_time)?>
								</div>
								<div><span class='j-bolder'>Total:</span> <span class='j-text-color5'><?=get_json_data('currency_symbol','about_us').' '.content_data('transaction_table','t_amount',$order_token,'or_token')?></span></div>
							</div>
							<hr>
						</div>
						<div class='j-padding'>
							<div class='j-bolder j-text-color5'>ITEM(S) IN YOUR ORDER</div>
						</div>
						<div class=''>
							<?php
							$or = multiple_content_data('order_table','or_id',$order_token,'or_token',"AND or_status != 'cart' ORDER BY or_id DESC");
							if($or !== false){
								foreach($or AS $or_id){
									$id = content_data('order_table','f_id',$or_id,'or_id');
									show_food($id,'order_details','',$or_id);
								}
							}
							?>
						</div>
						
						<div class=''>
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
												<div><?php payment_details($order_token)?></div>
											</div>
										</div>
									</div>
								</div>
								<div class='j-col m6 j-padding'>
									<div class='j-border-2 j-border-color5 j-round'>
										<div class='j-padding j-bolder'>DELIVERY INFORMATION</div>
										<?php $delivery_method = content_data('order_table','or_delivery_method',$order_token,'or_token','','null');?>
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
													<div><?php get_contact_detail(content_data('orderer_table','uc_id',$order_token,'or_token'))?></div>
												</div>
											</div>
											<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<div><?php require_once(file_location('inc_path','recommended.inc.php')); //recommended?></div>
	<div><?php require_once(file_location('inc_path','wishlist.inc.php')); //wishlist?></div>
	<div><?php require_once(file_location('inc_path','recently_viewed.inc.php')); //recently viewed?></div>
	<div><?php require_once(file_location('inc_path','footer.inc.php')); //footer?></div>
	<span id='st'></span>
	<?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>