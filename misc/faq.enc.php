<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
require_once(file_location('inc_path','session_check_nologout.inc.php'));
$data = "frequently asked questions";
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = strtoupper($data)." | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$page_url = file_location('home_url','misc/faq/');
$keywords = get_json_data('keywords','about_us')."|".$page_name;
$description = $page_name;
insert_page_visit('faq');
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
	<div class='j-misc-padding'>
			<div class='j-color j-padding'>
				
				 <div>
					<h4 title='What is <?=ucwords(get_xml_data('company_name'))?>' id='what_is_<?=get_xml_data('company_name')?>'><b>What is <?=ucwords(get_xml_data('company_name'))?>?</b></h4>
					<p class="" style="padding-left: 30px">
						<?=ucwords(get_xml_data('company_name'))?> is a food ordering and delivery restaurant where you can order food and drinks and get it delivered to your doorstep.
					</p>
					<h4 title='Can I order food and get the food in few hours'id=''><b>Can I order food and get the food in few hours?</b></h4>
					<p class="" style="padding-left: 30px">
						Yes of course, All our food are packaged and delivered in few hours
					</p>
					<h4 title='Why POD (Payment On Delivery) is not available'id='why_pod_not_available'><b>Why POD (Payment On Delivery) is not available?</b></h4>
					<p class="" style="padding-left:30px;">
						Payment on delivery (POD) may not be available due to one of the following reasons<br>
						<span style='line-height:30px;'>
							• POD is not available at the moment<br>
							• You are not eligible for POD<br>
							• You have cancelled your order or failed to received yout three times.
						</span>
					</p>
				 </div>
			</div>
	</div>
	<br>
	<div><?php require_once(file_location('inc_path','footer.inc.php')); //footer?></div>
	<span id='st'></span>
	<?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>