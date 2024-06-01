<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
require_once(file_location('inc_path','session_check_nologout.inc.php'));
$data = "contact us";
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = strtoupper($data)." | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$page_url = file_location('home_url','misc/contact_us/');
$keywords = get_json_data('keywords','about_us')."|".$page_name;
$description = $page_name;
insert_page_visit('contact us');
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class="j-color6"style="font-family:Roboto,sans-serif;">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page load?>
	<?php require_once(file_location('inc_path','navigation.inc.php'));//navigation?>
	<div class='j-center j-misc-padding'style="margin-top:20px;">
		<div class='j-xxlarge j-text-color1 j-bolder'><?=ucwords(get_xml_data('company_name'))?></div>
		<div class='j-xlarge j-text-color3 j-bolder'><?=ucwords($data)?></div>
	</div>
	<br>
	<?php //visiting hours?>
	<div>
		<center>
			<div class='j-color1 j-padding j-card-4'style='width:100%;max-width:450px;'>
				<div class='j-color1 j-border-2 j-border-color4 j-padding'style='width:100%;'>
					<div class='j-color1 j-border j-border-color4 j-padding'style='width:100%;'>
						<center><div class='j-text-color4 j-xxlarge'>Opening Hours</div><br></center>
						<div><span class='j-left'>Monday - Friday</span><span class='j-right'>11:00 AM - 9:30 AM</span></div>
						<span class='j-clearfix'><br></span>
						<div><span class='j-left'>Saturday - Sunday</span><span class='j-right'>10:00 AM - 9:30 AM</span></div>
						<span class='j-clearfix'><br></span>
					</div>
				</div>
			</div>
		</center>
	</div>
	<br><br><br>
	<div class='j-misc-padding'>
			<div class='j-color j-padding'>
				<center><div class='j-text-color3 j-xxlarge'><b>Contact <?=ucwords(get_xml_data('company_name'))?></b></div><br></center>
				<div class='j-padding-contact j-row'>
					<div class='j-col m6 j-padding'>
						<div>
							<div class='j-bolder'style='font-family:sofia'><i class="<?=icon('marker-o')?>"></i>Address</div>
							<span class='j-itallic'><?=get_json_data('address','about_us')?></span>
							<br><br>
						</div>
						<div>
							<b style='font-family:sofia'>Email</b><a href="mailto:<?=get_json_data('support_email','about_us')?>"title='Oladejo Jephthah Email'class="j-button"><?=get_json_data('support_email','about_us')?></a>
							<br><br>
						</div>
						<div>
							<b style='font-family:sofia'>Call</b><a href="tel:<?=get_json_data('phonenumber','about_us')?> "class="j-button"title='Oladejo Jephthah Phonenumber'><i class="<?=icon('phone')?> fa-flip-horizontal"></i><?=get_json_data('phonenumber','about_us')?></a>
							<br><br>
						</div>
						<div>
							<div class='j-bolder'style='font-family:sofia'>Connect With Me</div>
							<div class="j-panel" style="margin:0px;padding:5px"><?php get_all_social_handle('j-color3','j-text-color6')?></div>
							<br><br>
						</div>
					</div>
					<div class='j-col m6 j-padding'>
						<div class='j-bolder'style='margin-bottom:20px;font-family:sofia'>Send Us a Message</div>
						<form class=''id='inmsfrm'>
							<span class='mg j-text-color1'id='nme'></span>
							<input type='text'id='nm'name='nm'class="ip j-input j-color4 j-round-large j-border-2 j-border-color5"placeholder='Name'maxlength='50'style="width:100%;max-width:400px;"/><br>
							<span class='mg j-text-color1'id='eme'></span>
							<input type='email'id='em'name='em'class="ip j-input j-color4 j-round-large j-border-2 j-border-color5"placeholder='Email'maxlength='50'style="width:100%;max-width:400px;"/><br>
							<span class='mg j-text-color1'id='sbe'></span>
							<input type='text'id='sb'name='sb'class="ip j-input j-color4 j-color4 j-round-large j-border-2 j-border-color5"placeholder='Subject'maxlength='70'value=''style="width:100%;max-width:400px;"/><br>
							<span class='mg j-text-color1'id='mse'></span>
							<textarea id='ms'name='ms'class='ip j-input j-medium j-color4 j-round-large j-border-2 j-border-color5'placeholder='Message'style="width:100%;max-width:400px;"></textarea><br>
							<button type='submit'id='sbtn'class="j-btn j-medium j-color3 j-round-large j-bolder">Send Message</button>
						</form>
					</div>
				</div>
			</div>
	</div>
	<br>
	<div><?php require_once(file_location('inc_path','footer.inc.php')); //footer?></div>
	<span id='st'></span>
	<?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>