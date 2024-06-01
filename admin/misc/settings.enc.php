<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','misc/settings/');
require_once(file_location('admin_inc_path','session_check.inc.php'));
$page = "WEBSITE SETTING";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
if($adlevel != 3){trigger_error_manual(404);}
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
		<div id="maincol">
			<div class='j-padding'>
				<h2 class='j-text-color1 j-padding j-color4'><b>WEBSITE SETTING</b></h2>
			</div>
			<div class="j-container">
				<div class='j-color4'>
					<div class='j-color5'><div class='j-padding j-large'><b>Color Settings</b></div></div>
					<div class='j-padding'>
						<div class='j-row'>
							<div class='j-col m6'>
								<div>
									<?php //primary color ?>
									<span class='j-bolder j-text-color7'style='margin-right:20px;'>PRIMARY COLOR:</span>
									<span class='j-padding j-text-color4'style="background-color:<?=get_json_data('primary_color','color')?>;height:30px;width:30px;"></span>
								</div><br>
								<div>
									<input type="text"class="j-left j-input j-medium j-border-2 j-border-color7 j-round"placeholder="Primary Color"\
										   name="pry_color"id="pry_color"value="<?=get_json_data('primary_color','color')?>"
										   style="width:60%;max-width:200px;margin-right:20px;"/>
										<button type='submit'id='sbtn'class="primary_color j-btn j-medium j-color1 j-round j-bolder"onclick="css('color','primary_color',$('#pry_color').val());">Save</button>
								</div>
							</div>
							<div class='j-col m6'>
								<div>
									<?php //secondary color ?>
									<span class='j-bolder j-text-color7'style='margin-right:20px;'>SECONDARY COLOR:</span>
									<span class='j-padding j-text-color4'style="background-color:<?=get_json_data('secondary_color','color')?>;height:30px;width:30px;"></span>
								</div><br>
								<div>
									<input type="text"class="j-left j-input j-medium j-border-2 j-border-color7 j-round"placeholder="Secondary Color"
										   name="sec_color"id="sec_color"value="<?=get_json_data('secondary_color','color')?>"
										   style="width:60%;max-width:200px;margin-right:20px;"/>
										   <button type='submit'id='sbtn'class="secondary_color j-btn j-medium j-color1 j-round j-bolder"onclick="css('color','secondary_color',$('#sec_color').val());">Save</button>
								</div>
							</div>
						</div>
					</div>
				</div><br>
				
				<div class=''style='margin:15px 0px;'>
					<div class='j-color4'>
						<div class='j-color5'><div class='j-padding j-large'><b>Activity Settings</b></div></div>
						<div class='j-padding '>
							<div class='j-row'>
								<div class='j-col m6'>
									<?php //keywords ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>ALL ACTIVITIES:</div>
									<div class='j-bolder'>
										<span style='margin-right:15px;'>
											<span>Status: </span>
											<span class='j-text-color5'><?php $status = get_json_data('all','act');?><?=$status == 1?"Enabled":"Disabled";?></span>
										</span>
										<span class='j-btn j-color1 j-round'onclick="css('act','all','<?=$status == 1?0:1;?>');">
											<?=$status == 1?"Disable":"Enable";?>
										</span>
									</div>
								</div>
								<div class='j-col m6'>
									<?php //site surfing ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>WEBSITE SURFING:</div>
									<div class='j-bolder'>
										<span style='margin-right:15px;'>
											<span>Status: </span>
											<span class='j-text-color5'><?php $status = get_json_data('surfing','act');?><?=$status == 1?"Enabled":"Disabled";?></span>
										</span>
										<span class='j-btn j-color1 j-round'onclick="css('act','surfing','<?=$status == 1?0:1;?>');">
											<?=$status == 1?"Disable":"Enable";?>
										</span>
									</div>
								</div>
							</div><br>
							<div class='j-row'>
								<div class='j-col m6'>
									<?php //login ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>LOGIN:</div>
									<div class='j-bolder'>
										<span style='margin-right:15px;'>
											<span>Status: </span>
											<span class='j-text-color5'><?php $status = get_json_data('login','act');?><?=$status == 1?"Enabled":"Disabled";?></span>
										</span>
										<span class='j-btn j-color1 j-round'onclick="css('act','login','<?=$status == 1?0:1;?>');">
											<?=$status == 1?"Disable":"Enable";?>
										</span>
									</div>
								</div>
								<div class='j-col m6'>
									<?php //registration ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>REGISTRATION:</div>
									<div class='j-bolder'>
										<span style='margin-right:15px;'>
											<span>Status: </span>
											<span class='j-text-color5'><?php $status = get_json_data('registration','act');?><?=$status == 1?"Enabled":"Disabled";?></span>
										</span>
										<span class='j-btn j-color1 j-round'onclick="css('act','registration','<?=$status == 1?0:1;?>');">
											<?=$status == 1?"Disable":"Enable";?>
										</span>
									</div>
								</div>
							</div><br>
							<div class='j-row'>
								<div class='j-col m6'>
									<?php //cart ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>CART:</div>
									<div class='j-bolder'>
										<span style='margin-right:15px;'>
											<span>Status: </span>
											<span class='j-text-color5'><?php $status = get_json_data('cart','act');?><?=$status == 1?"Enabled":"Disabled";?></span>
										</span>
										<span class='j-btn j-color1 j-round'onclick="css('act','cart','<?=$status == 1?0:1;?>');">
											<?=$status == 1?"Disable":"Enable";?>
										</span>
									</div>
								</div>
								<div class='j-col m6'>
									<?php //checkout ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>CHECKOUT:</div>
									<div class='j-bolder'>
										<span style='margin-right:15px;'>
											<span>Status: </span>
											<span class='j-text-color5'><?php $status = get_json_data('checkout','act');?><?=$status == 1?"Enabled":"Disabled";?></span>
										</span>
										<span class='j-btn j-color1 j-round'onclick="css('act','checkout','<?=$status == 1?0:1;?>');">
											<?=$status == 1?"Disable":"Enable";?>
										</span>
									</div>
								</div>
							</div><br>
							<div class='j-row'>
								<div class='j-col m6'>
									<?php //door delivery ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>DOOR DELIVERY:</div>
									<div class='j-bolder'>
										<span style='margin-right:15px;'>
											<span>Status: </span>
											<span class='j-text-color5'><?php $status = get_json_data('door_delivery','act');?><?=$status == 1?"Enabled":"Disabled";?></span>
										</span>
										<span class='j-btn j-color1 j-round'onclick="css('act','door_delivery','<?=$status == 1?0:1;?>');">
											<?=$status == 1?"Disable":"Enable";?>
										</span>
									</div>
								</div>
								<div class='j-col m6'>
									<?php //pickup ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>PICKUP:</div>
									<div class='j-bolder'>
										<span style='margin-right:15px;'>
											<span>Status: </span>
											<span class='j-text-color5'><?php $status = get_json_data('pickup','act');?><?=$status == 1?"Enabled":"Disabled";?></span>
										</span>
										<span class='j-btn j-color1 j-round'onclick="css('act','pickup','<?=$status == 1?0:1;?>');">
											<?=$status == 1?"Disable":"Enable";?>
										</span>
									</div>
								</div>
							</div><br>
							<div class='j-row'>
								<div class='j-col m6'>
									<?php //online payment ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>ONLINE PAYMENT:</div>
									<div class='j-bolder'>
										<span style='margin-right:15px;'>
											<span>Status: </span>
											<span class='j-text-color5'><?php $status = get_json_data('online_payment','act');?><?=$status == 1?"Enabled":"Disabled";?></span>
										</span>
										<span class='j-btn j-color1 j-round'onclick="css('act','online_payment','<?=$status == 1?0:1;?>');">
											<?=$status == 1?"Disable":"Enable";?>
										</span>
									</div>
								</div>
								<div class='j-col m6'>
									<?php //payment on delivery ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>PAYMENT ON DELIVERY:</div>
									<div class='j-bolder'>
										<span style='margin-right:15px;'>
											<span>Status: </span>
											<span class='j-text-color5'><?php $status = get_json_data('cash_on_delivery','act');?><?=$status == 1?"Enabled":"Disabled";?></span>
										</span>
										<span class='j-btn j-color1 j-round'onclick="css('act','cash_on_delivery','<?=$status == 1?0:1;?>');">
											<?=$status == 1?"Disable":"Enable";?>
											</span>
									</div>
								</div>
							</div><br>
						</div>
					</div>
				</div><br>
				
				<div class=''style='margin:15px 0px;'>
					<div class='j-color4'>
						<div class='j-color5'><div class='j-padding j-xlarge'><b>Miscellaneous</b></div></div>
						<div class='j-padding '>
							<div class='j-row'>
								<div class='j-col m6'>
									<?php //keywords ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>KEYWORDS:</div>
									<textarea placeholder="keywords"id='keywords'name="keywords"style="width:100%;max-width:400px;"rows="4"class="j-input j-medium j-border-2 j-border-color7 j-color4 j-round"
									><?=get_json_data('keywords','about_us')?></textarea><br>
									<button type='submit'id='sbtn'class="keywords j-btn j-medium j-color1 j-round j-bolder"onclick="css('about_us','keywords',$('#keywords').val());">Save</button>
								</div>
								<div class='j-col m6'>
									<?php //regular_email ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>REGULAR EMAIL:</div>
									<input type='email' placeholder="Regular Email"id='regular_email'name="regular_email"style="width:100%;max-width:400px;"rows="4"class="j-input j-medium j-border-2 j-border-color7 j-color4 j-round"
									value="<?=get_json_data('regular_email','about_us')?>"/><br>
									<button type='submit'id='sbtn'class="regular_email j-btn j-medium j-color1 j-round j-bolder"onclick="css('about_us','regular_email',$('#regular_email').val());">Save</button>
								</div>
							</div><br>
							<div class='j-row'>
								<div class='j-col m6'>
									<?php //support_email ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>SUPPORT EMAIL:</div>
									<input type='email' placeholder="Support Email"id='support_email'name="support_email"style="width:100%;max-width:400px;"rows="4"class="j-input j-medium j-border-2 j-border-color7 j-color4 j-round"
									value="<?=get_json_data('support_email','about_us')?>"/><br>
									<button type='submit'id='sbtn'class="support_email j-btn j-medium j-color1 j-round j-bolder"onclick="css('about_us','support_email',$('#support_email').val());">Save</button>
								</div>
								<div class='j-col m6'>
									<?php //phonenumber ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>COMPANY PHONENUMBER:</div>
									<input type='tel' placeholder="Company Phonenumber"id='phonenumber'name="phonenumber"style="width:100%;max-width:400px;"rows="4"class="j-input j-medium j-border-2 j-border-color7 j-color4 j-round"
									value="<?=get_json_data('phonenumber','about_us')?>"/><br>
									<button type='submit'id='sbtn'class="phonenumber j-btn j-medium j-color1 j-round j-bolder"onclick="css('about_us','phonenumber',$('#phonenumber').val());">Save</button>
								</div>
							</div><br>
							<div class='j-row'>
								<div class='j-col m6'>
									<?php //locality ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>DELIVERY LOCALITY:</div>
									<input type='text' placeholder="Delivery Locality"id='locality'name="locality"style="width:100%;max-width:400px;"rows="4"class="j-input j-medium j-border-2 j-border-color7 j-color4 j-round"
									value="<?=get_json_data('locality','about_us')?>"/><br>
									<button type='submit'id='sbtn'class="locality j-btn j-medium j-color1 j-round j-bolder"onclick="css('about_us','locality',$('#locality').val());">Save</button>
								</div>
								<div class='j-col m6'>
									<?php //address ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>COMPANY ADDRESS:</div>
									<textarea placeholder="address"id='address'name="address"style="width:100%;max-width:400px;"rows="4"class="j-input j-medium j-border-2 j-border-color7 j-color4 j-round"
									><?=get_json_data('address','about_us')?></textarea><br>
									<button type='submit'id='sbtn'class="address j-btn j-medium j-color1 j-round j-bolder"onclick="css('about_us','address',$('#address').val());">Save</button>
								</div>
							</div><br>
							<div class='j-row'>
								<div class='j-col m6'>
									<?php //currency_name ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>CURRENCY NAME:</div>
									<input type='text' placeholder="Currency Name"id='currency_name'name="currency_name"style="width:100%;max-width:400px;"rows="4"class="j-input j-medium j-border-2 j-border-color7 j-color4 j-round"
									value="<?=get_json_data('currency_name','about_us')?>"/><br>
									<button type='submit'id='sbtn'class="currency_name j-btn j-medium j-color1 j-round j-bolder"onclick="css('about_us','currency_name',$('#currency_name').val());">Save</button>
								</div>
								<div class='j-col m6'>
									<?php //currency_symbol ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>CURRENCY SYMBOL:</div>
									<input type='text' placeholder="Currency Symbol"id='currency_symbol'name="currency_symbol"style="width:100%;max-width:400px;"rows="4"class="j-input j-medium j-border-2 j-border-color7 j-color4 j-round"
									value="<?=get_json_data('currency_symbol','about_us')?>"/><br>
									<button type='submit'id='sbtn'class="currency_symbol j-btn j-medium j-color1 j-round j-bolder"onclick="css('about_us','currency_symbol',$('#currency_symbol').val());">Save</button									
								</div>
							</div><br>
							<div class='j-row'>
								<div class='j-col m6'>
									<?php //delivery_fee ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>DELIVERY FEE:</div>
									<input type='text' placeholder="Delivery Fee"id='delivery_fee'name="delivery_fee"style="width:100%;max-width:400px;"rows="4"class="j-input j-medium j-border-2 j-border-color7 j-color4 j-round"
									value="<?=get_json_data('delivery_fee','about_us')?>"/><br>
									<button type='submit'id='sbtn'class="delivery_fee j-btn j-medium j-color1 j-round j-bolder"onclick="css('about_us','delivery_fee',$('#delivery_fee').val());">Save</button>
								</div>
								<div class='j-col m6'>
									<?php //pickup_fee ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>PICKUP FEE:</div>
									<input type='text' placeholder="Pickup Fee"id='pickup_fee'name="pickup_fee"style="width:100%;max-width:400px;"rows="4"class="j-input j-medium j-border-2 j-border-color7 j-color4 j-round"
									value="<?=get_json_data('pickup_fee','about_us')?>"/><br>
									<button type='submit'id='sbtn'class="pickup_fee j-btn j-medium j-color1 j-round j-bolder"onclick="css('about_us','pickup_fee',$('#pickup_fee').val());">Save</button>
								</div>
							</div><br>
							<div class='j-row'>
								<div class='j-col m6'>
									<?php //region ?>
									<div class='j-bolder j-text-color7'style='margin-right:20px;'>DELIVERY REGION:</div>
									<textarea placeholder="region"id='region'name="region"style="width:100%;max-width:400px;"rows="4"class="j-input j-medium j-border-2 j-border-color7 j-color4 j-round"
									><?=get_json_data('region','about_us')?></textarea><br>
									<button type='submit'id='sbtn'class="region j-btn j-medium j-color1 j-round j-bolder"onclick="css('about_us','region',$('#region').val());">Save</button>
								</div>
								<div class='j-col m6'>
								</div>
							</div><br>
						</div>
					</div>
				</div><br>
			</div>
		</div>
	</div>
	<span id='st'></span>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>