<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','checkout/');//url redirection current page
require_once(file_location('inc_path','session_check.inc.php'));
//for meta
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "CHECKOUT | CONTACT DETAILS | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$navigation = 'payment';
$token = get_order_token();
if(empty($token)){$token='no_token';}
insert_page_visit('checkout');
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class="j-color6"style="font-family:Roboto,sans-serif;">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page load?>
	<div><?php require(file_location('inc_path','navigation.inc.php')); //navigation?></div>
	<div class=''>
		<?php
		$add = "AND or_status = 'cart' AND order_table.f_id = food_table.f_id AND f_status = 'available' ORDER BY or_id DESC";
		$or = multiple_content_data('order_table,food_table','or_id',$token,'or_token',$add);
		if($or !== false){
			user_modal('contact_modal','','add_contact_modal');
			user_modal('contact_modal','','change_contact_modal');
			$uc_ids = multiple_content_data('user_contact_table','uc_id',$u_id,'u_id',"ORDER BY uc_status DESC");
			if($uc_ids !== false){foreach($uc_ids AS $id){ user_modal('contact_modal',$id,'edit_contact_modal');}}
			?>
			<div class='j-row j-home-padding'>
				<div class='j-col s12 l9 j-padding-flexible'>
					<div class=''><?php checkout_page();?></div>
					<form method='post'id='chkfrm1'>
						<?php //address details ?>
						<div class='j-color4 j-round'style='margin-bottom:24px;'>
							<?php
							$ac_id = content_data('user_contact_table','uc_id',$u_id,'u_id',"AND uc_status = 'default'");							
							?>
							<div class='j-padding j-text-color4 j-color5'>
								<b><span style='margin-right: 9px;'>1. </span>ADDRESS DETAILS</b>
								<?php if($ac_id !== false){?><span onclick="$('#change_contact_modal').fadeIn('slow');"class='j-clickable j-text-color6 j-right j-round j-bolder'>EDIT</span><?php }?>
							</div>
								<?php
								$ac_id = content_data('user_contact_table','uc_id',$u_id,'u_id',"AND uc_status = 'default'");
								if($ac_id !== false){
									?><div class='j-padding'><?php get_contact_detail($ac_id,'account');?></div><?php
								}else{
									?>
									<br>
									<center>
										<div class='j-bolder'>No default contact details</div>
										<div onclick="$('#add_contact_modal').fadeIn('slow');"class='j-btn j-color1 j-round j-bolder'>Add contact details</div>
									</center>
									<br>
									<?php
								}
							?>
						</div>
						<?php //delivery note ?>
						<div class='j-color4 j-round'style='margin-bottom:24px;'>
							<div class='j-padding j-text-color4 j-color5'><b><span style='margin-right: 9px;'>2. </span>DELIVERY NOTE</b></div>
							<div class='j-padding'>
								<textarea name='delnot'class='j-input j-medium j-color4 j-round j-border-2 j-border-color5'placeholder='Delivery Note (Optional)'maxlength='500'
									style="width:100%;max-width:400px;"><?=ucfirst(content_data('order_table','or_delivery_note',$token,'or_token'))?></textarea>
									<span class='j-small'>(Add note about what you want us to do/know regarding your order)</span>
							</div>
						</div>
						<?php //delivery method ?>
						<div class='j-color4 j-round'style='margin-bottom:24px;'>
							<div class='j-padding j-text-color4 j-color5'><b><span style='margin-right: 9px;'>3. </span>DELIVERY METHOD</b></div>
							<div class='j-padding'>
								<span class='mg j-text-color1'id='dlye'></span>
								<div>
									<?php
									$del_med = content_data('order_table,food_table','or_delivery_method',$token,'or_token',$add);
									if(get_json_data('door_delivery','act') == 0 || get_json_data('all','act') == 0){
										?>
										<input type='radio'class='j-radio'id='dly1'name='dly'value="dd"disabled/> <span class='j-bolder'>Door Delivery</span><br>
										<div class='j-xxlarge'style='margin-left:20px;'><i class="<?=icon('truck')?>"></i></div>
										<span class='j-text-color5 j-padding'>(Unavailable)</span>
										<?php
									}else{
										?>
										<input type='radio'class='j-radio'id='dly1'name='dly'value="dd"onclick="sdfm('door delivery');"checked/> <span class='j-bolder'>Door Delivery</span>
										<div class='j-xxlarge'style='margin-left:20px;'><i class="<?=icon('truck')?>"></i></div>
										<div class='j-padding j-text-color5'>We will deliver your food to your food door step</b></div>
										<?php
									}
									?>
								</div>
								<br>
								<div>
									<?php
									if(get_json_data('pickup','act') == 0 || get_json_data('all','act') == 0){
										?>
										<input type='radio'class='j-radio'id='dly2'name='dly'value="pu"disabled/> <span class='j-bolder'>Pickup</span><br><span class='j-text-color5 j-padding'>(Unavailable)</span>
										<div class='j-xxlarge'style='margin-left:20px;'><i class="<?=icon('handshake')?>"></i></div>
										<?php
									}else{
										?>
										<input type='radio'class='j-radio'id='dly2'name='dly'value="pu"onclick="sdfm('pickup');"<?=$del_med === 'pickup'?'checked':'';?>/> <span class='j-bolder'>Pickup</span>
										<div class='j-xxlarge'style='margin-left:20px;'><i class="<?=icon('handshake')?>"></i></div>
										<div class='j-padding j-text-color5'>You'll pick up your food at our restaurant</div>
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
								<button type='submit'id='sbtn'class="j-round j-small j-color1 j-padding j-btn j-bolder"style='width:100%;'>PROCEED TO PAYMENT METHOD</button>
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
			<?php
			if($del_med === 'none'){$del_med = 'door delivery';}
		}else{
			$del_med = 'door';
			?>
			<div class='j-center j-xlarge j-padding j-text-color7'><br>No Item to Checkout<br></div>
			<center><a href="<?=file_location('home_url','')?>"class='j-btn j-color1 j-text-color4 j-card-4 j-round-large j-bolder'>CONTINUE SHOPPING</a></center><br>
			<div><?php require_once(file_location('inc_path','recommended.inc.php')); //recommended?></div>
			<div><?php require_once(file_location('inc_path','wishlist.inc.php')); //wishlist?></div>
			<div><?php require_once(file_location('inc_path','recently_viewed.inc.php')); //recently viewed?></div>
			<div><?php require_once(file_location('inc_path','footer.inc.php')); //footer?></div>
			<?php
		}
		?>
	</div>
	<span id='st'></span>
	<?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>