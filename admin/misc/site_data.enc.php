<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','misc/site_data/');
$page = "WEBSITE DATA";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(file_location('inc_path','meta.inc.php'));?>
<title><?=$page_name?></title>
</head>
<body class="j-color6" style="font-family:Roboto,sans-serif;width:100%;"onload="">
<?php require_once(file_location('inc_path','page_load.inc.php')); //page load?>
<!-- BODY STARTS-->
<div class="j-row">
	<div class="j-col s12 l2 j-hide-small j-hide-medium">
		<?php require_once(file_location('admin_inc_path','first_column.inc.php'));?>
	</div>
	<div class="j-col s12 l10"id='mainbody'>
		<?php require(file_location('admin_inc_path','navigation.inc.php'));?>
		<div id="maincol">
			<div class='j-container'>
				<?php if($adlevel == 3){ ?>
				<a href="<?=file_location('admin_url','misc/settings/')?>"class='j-text-color4 j-right j-color1 j-btn j-round j-bolder j-itallic'>Site Settings</a>
				<?php }?>
			</div>
			<div class='j-padding'>
				<h2 class='j-text-color1 j-padding j-color4'><b>WEBSITE DATA</b></h2>
			</div>
			<div class="j-padding">
				<div class=''style='margin:15px 0px;'>
					<div class='j-color4'>
						<div class='j-color5'><div class='j-padding j-large'><b>Color</b></div></div>
						<div class='j-padding'>
							<div class='j-row'>
								<div class='j-col m6'>
									<span class='j-bolder j-text-color7'style='margin-right:20px;'>Primary Color: </span>
									<span class='j-padding j-text-color4'style="background-color:<?=get_json_data('primary_color','color')?>;height:30px;width:30px;"></span>
								</div>
								<div class='j-col m6'>
									<span class='j-bolder j-text-color7'style='margin-right:20px;'>Secondary Color: </span>
									<span class='j-padding j-text-color4'style="background-color:<?=get_json_data('secondary_color','color')?>;height:30px;width:30px;"></span>
								</div>
							</div>
						</div>
					</div>
				</div><br>
				
				<div class=''style='margin:15px 0px;'>
					<div class='j-color4'>
						<div class='j-color5'><div class='j-padding j-large'><b>Activities Setting</b></div></div>
						<div class='j-padding '>
							<div class='j-row'>
								<div class='j-col m6'>
									<span class='j-bolder j-text-color7'>All Activities:</span>
									<span><?php if(get_json_data('all','act') == 1){echo 'Enabled';}else{echo 'Disabled';}?></span>
								</div>
								<div class='j-col m6'>
									<span class='j-bolder j-text-color7'>Website Surfing:</span>
									<span><?php if(get_json_data('surfing','act') == 1){echo 'Enabled';}else{echo 'Disabled';}?></span>
								</div>
							</div>
							<br>
							<div class='j-row'>
								<div class='j-col m6'>
									<span class='j-bolder j-text-color7'>Login:</span>
									<span><?php if(get_json_data('login','act') == 1){echo 'Enabled';}else{echo 'Disabled';}?></span>
								</div>
								<div class='j-col m6'>
									<span class='j-bolder j-text-color7'>Registration</span>
									<span><?php if(get_json_data('registration','act') == 1){echo 'Enabled';}else{echo 'Disabled';}?></span>
								</div>
							</div>
							<br>
							<div class='j-row'>
								<div class='j-col m6'>
									<span class='j-bolder j-text-color7'>Cart</span>
									<span><?php if(get_json_data('cart','act') == 1){echo 'Enabled';}else{echo 'Disabled';}?></span>
								</div>
								
								<div class='j-col m6'>
									<span class='j-bolder j-text-color7'>Checkout</span>
									<span><?php if(get_json_data('checkout','act') == 1){echo 'Enabled';}else{echo 'Disabled';}?></span>
								</div>
							</div>
							<br>
							<div class='j-row'>
								<div class='j-col m6'>
									<span class='j-bolder j-text-color7'>Door Delivery</span>
									<span><?php if(get_json_data('door_delivery','act') == 1){echo 'Enabled';}else{echo 'Disabled';}?></span>
								</div>
								<div class='j-col m6'>
									<span class='j-bolder j-text-color7'>Pickup</span>
									<span><?php if(get_json_data('pickup','act') == 1){echo 'Enabled';}else{echo 'Disabled';}?></span>
								</div>
							</div>
							<br>
							<div class='j-row'>
								<div class='j-col m6'>
									<span class='j-bolder j-text-color7'>Online Payment</span>
									<span><?php if(get_json_data('online_payment','act') == 1){echo 'Enabled';}else{echo 'Disabled';}?></span>
								</div>
								<div class='j-col m6'>
									<span class='j-bolder j-text-color7'>Payment on Delivery</span>
									<span><?php if(get_json_data('cash_on_delivery','act') == 1){echo 'Enabled';}else{echo 'Disabled';}?></span>
								</div>
							</div>
							<br>
						</div>
					</div>
				</div><br>
				
				<div class=''style='margin:15px 0px;'>
					<div class='j-color4'>
						<div class='j-color5'><div class='j-padding j-large'><b>Miscellaneous</b></div></div>
						<div class='j-padding '>
							<div class='j-row'>
								<div class='j-col m6'>
									<div class='j-bolder j-text-color7'>Keywords:</div>
									<div><?=ucwords(get_json_data('keywords','about_us'))?></div>
								</div>
								<div class='j-col m6'>
									<div class='j-bolder j-text-color7'>Regular Email:</div>
									<div><?=ucwords(get_json_data('regular_email','about_us'))?></div>
								</div>
							</div><br>
							<div class='j-row'>
								<div class='j-col m6'>
									<div class='j-bolder j-text-color7'>Support Email:</div>
									<div><?=ucwords(get_json_data('support_email','about_us'))?></div>
								</div>
								<div class='j-col m6'>
									<div class='j-bolder j-text-color7'>Company Phonenumber:</div>
									<div><?=ucwords(get_json_data('phonenumber','about_us'))?></div>
								</div>
							</div><br>
							<div class='j-row'>
								<div class='j-col m6'>
									<div class='j-bolder j-text-color7'>Delivery Locality:</div>
									<div><?=ucwords(get_json_data('locality','about_us'))?></div>
								</div>
								<div class='j-col m6'>
									<div class='j-bolder j-text-color7'>Company Address:</div>
									<div><?=ucwords(get_json_data('address','about_us'))?></div>
								</div>
							</div><br>
							<div class='j-row'>
								<div class='j-col m6'>
									<div class='j-bolder j-text-color7'>Currency Name:</div>
									<div><?=ucwords(get_json_data('currency_name','about_us'))?></div>
								</div>
								<div class='j-col m6'>
									<div class='j-bolder j-text-color7'>Currency Symbol:</div>
									<div><?=ucwords(get_json_data('currency_symbol','about_us'))?></div>
								</div>
							</div><br>
							<div class='j-row'>
								<div class='j-col m6'>
									<div class='j-bolder j-text-color7'>Delivery Fee:</div>
									<div><?=ucwords(get_json_data('delivery_fee','about_us'))?></div>
								</div>
								<div class='j-col m6'>
									<div class='j-bolder j-text-color7'>Pickup Fee:</div>
									<div><?=ucwords(get_json_data('pickup_fee','about_us'))?></div>
								</div>
							</div><br>
							<div class='j-row'>
								<div class='j-col m6'>
									<div class='j-bolder j-text-color7'>Delivery Region:</div>
									<div><?=ucwords(get_json_data('region','about_us'))?></div>
								</div>
								<div class='j-col m6'>
								</div>
							</div>
						</div><br>
					</div>
				</div>
			</div><br>
			
		</div>
	</div>
</div>
<span id='st'></span>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>