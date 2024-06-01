<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','checkout/payment_method');//url redirection current page
require_once(file_location('inc_path','session_check.inc.php'));
$location = file_location('home_url','checkout/');
$token = get_order_token();
if(empty($token)){die(header("Location:$location"));}
//if there is no content in the cart && orderer has not been inserted
$add = "AND or_status = 'cart' AND order_table.f_id = food_table.f_id AND f_status = 'available' ORDER BY or_id DESC";;
$or = multiple_content_data('order_table,food_table','or_id',$token,'or_token',$add);
$orderer = content_data('orderer_table','or_token',$token,'or_token');
if($or === false || $orderer === false){die(header("Location:$location"));}
//if one of order delivery method is not set
foreach($or AS $id){
	$del = content_data('order_table','or_delivery_method',$id,'or_id');
	if($del !== 'pickup' && $del !== 'door delivery'){die(header("Location:$location"));}
}
//for meta
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "CHECKOUT | PAYMENT METHOD | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
insert_page_visit('checkout | payment method');
$navigation = 'payment';
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class="j-color6"style="font-family:Roboto,sans-serif;">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page load?>
	<div><?php require(file_location('inc_path','navigation.inc.php')); //navigation?></div>
	<div class='j-home-padding'>
		<div class='j-row'>
				<div class='j-col s12 l9 j-padding-flexible'>
					<div class=''><?php checkout_page('payment');?></div>
					<form method='post'id='chkfrm2'>
						<?php //address details ?>
						<div class='j-color4 j-round'style='margin-bottom:24px;'>
							<div class='j-padding j-text-color4 j-color5'>
								<b><span style='margin-right: 9px;'>1. </span>ADDRESS DETAILS</b>
								<a href='<?=$location?>'><span class='j-clickable j-text-color6 j-right j-round j-bolder'>EDIT</span></a>
							</div>
							<?php $ac_id = content_data('user_contact_table','uc_id',$u_id,'u_id',"AND uc_status = 'default'");?>
							<div class='j-padding'><?php get_contact_detail($ac_id,'account');?></div>
						</div>
						<?php //delivery note ?>
						<div class='j-color4 j-round'style='margin-bottom:24px;'>
							<div class='j-padding j-text-color4 j-color5'>
								<b><span style='margin-right: 9px;'>2. </span>DELIVERY NOTE</b>
								<a href='<?=$location?>'><span class='j-clickable j-text-color6 j-right j-round j-bolder'>EDIT</span></a>
							</div>
							<div class='j-padding'>
								<?=content_data('order_table,food_table','or_delivery_note',$token,'or_token',$add)?>
							</div>
						</div>
						<?php //delivery method ?>
						<div class='j-color4 j-round'style='margin-bottom:24px;'>
							<div class='j-padding j-text-color4 j-color5'>
								<b><span style='margin-right: 9px;'>3. </span>DELIVERY METHOD</b>
								<a href='<?=$location?>'><span class='j-clickable j-text-color6 j-right j-round j-bolder'>EDIT</span></a>
							</div>
							<div class='j-padding'>
								<?php
								$del_med = content_data('order_table,food_table','or_delivery_method',$token,'or_token',$add);
								if($del_med === 'door delivery'){
									?>
									<div class='j-bolder'>Door Delivery</div>
									<div class='j-text-color5'>
										To be delivered within the next 2-5 hours for
										<span class='j-text-color1'><?=get_json_data('currency_symbol','about_us').' '.delivery_fee($token)?></span>
									</div>
									<?php
								}elseif($del_med === 'pickup'){
									?>
									<div class='j-bolder'>Pick up</div>
									<div class='j-text-color5'>
										Will be available for pick up within the next 2-5 hours 
									</div>
									<?php
								}
								?>
							</div>
						</div>
						<?php //payment method ?>
						<div class='j-color4 j-round'style='margin-bottom:24px;'>
							<div class='j-padding j-text-color4 j-color5'><b><span style='margin-right: 9px;'>4. </span>PAYMENT METHOD</b></div>
							<div class='j-padding'>
								<span class='mg j-text-color1'id='pmte'></span>
								<div>
									<?php
									$pay_med = content_data('order_table,food_table','or_payment_method',$token,'or_token',$add);
									//if delivery and act has been disabled
									if(get_json_data('online_payment','act') == 0 || get_json_data('all','act') == 0){
										?>
										<input type='radio'class='j-radio'id='pmt1'name='pmt'value=""disabled/> <span class='j-bolder'>Card Payment</span><br><span class='j-text-color5 j-padding'>(Unavailable)</span>
										<div class='j-xxlarge'style='margin-left:20px;'><i class="<?=icon('cc-visa','fab')?>"></i> <i class="<?=icon('cc-mastercard','fab')?>"></i> <i class="<?=icon('credit-card')?>"></i></div>
										<?php
									}else{
										?>
										<input type='radio'class='j-radio'id='pmt1'name='pmt'value="cp"onclick="spm('card payment');"checked/> <span class='j-bolder'>Card Payment</span>
										<div class='j-xxlarge'style='margin-left:20px;'><i class="<?=icon('cc-visa','fab')?>"></i> <i class="<?=icon('cc-mastercard','fab')?>"></i> <i class="<?=icon('credit-card')?>"></i></div>
										<?php
									}
									?>
								</div>
								<br>
								<div>
									<?php
									//if delivery and act has been disabled ||  if user pod has been disabled || if door delivery is choosed
									if(get_json_data('cash_on_delivery','act') == 0 || get_json_data('all','act') == 0 || content_data('user_table','u_pod',$u_id,'u_id')=== 'disabled' || $del_med === 'door delivery'){
										?>
										<input type='radio'class='j-radio'id='pmt2'name='pmt'value=""disabled/> <span class='j-bolder'>Payment On Delivery/Pickup</span><br><span class='j-text-color5 j-padding'>(Unavailable)</span>
										<div class='j-xxlarge'style='margin-left:20px;'><i class="<?=icon('money-bill-alt')?>"></i></div>
										<a href='<?=file_location('home_url','misc/faq/#why_pod_not_available')?>'target='_blank'>
											<div style='margin-left:20px;'class='j-text-color1'>Why is POD not available ?</div>
										</a>
										<?php
									}else{
										?>
										<input type='radio'class='j-radio'id='pmt2'name='pmt'value="pod"onclick="spm('payment on delivery');"<?=$pay_med === 'payment on delivery'?'checked':'';?>/> <span class='j-bolder'>Payment On Delivery/Pickup</span>
										<div class='j-xxlarge'style='margin-left:20px;'><i class="<?=icon('money-bill-alt')?>"></i></div>
										<?php
									}
									?>
								</div>
							</div>
						</div>
						<?php //item and button?>
						<div class='j-color4 j-round'style='margin-bottom:24px;'>
							<div class='j-padding j-text-color4 j-color5'><b><span style='margin-right:10px;'></span>ITEMS</b></div>
							<div class='j-padding'>
								<div class=''><?php $checkout = 'main';require(file_location('inc_path','cart_order_summary.inc.php')); //order details?></div>
								<?php// modify and continue button?>
								<a href="<?=file_location('home_url','cart/')?>"style='width:100%;margin-bottom:9px;'class='j-hide-xlarge j-hide-large j-border j-border-color1 j-round j-small j-color4 j-text-color1 j-btn'>
								<b>MODIFY CART</b>
								</a>
								<button type='submit'id='sbtn'class="j-round j-small j-color1 j-padding j-btn j-bolder"style='width:100%;'>PROCEED TO CONFIRM ORDER</button>
							</div>
						</div>
					</form>
				</div>
				
				<?php //order summary for large screen?>
				<div class='j-col l3 j-hide-small j-hide-medium'>
					<div class='j-large'><b>ORDER SUMMARY</b></div>
					<div class='j-color4  j-round'>
						<div class='j-padding-small'><?php $checkout = 'side';require(file_location('inc_path','cart_order_summary.inc.php')); //order details?></div>
					</div>
				</div>
			</div>
	</div>
	<span id='st'></span>
	<?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>