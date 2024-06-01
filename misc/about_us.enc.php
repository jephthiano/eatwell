<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$data = "about us";
require_once(file_location('inc_path','session_check_nologout.inc.php'));
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = strtoupper($data)." | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$page_url = file_location('home_url','misc/about_us/');
$keywords = get_json_data('keywords','about_us')."|".$page_name;
$description = $page_name;
insert_page_visit('about us');
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
			<div class='j-color j-padding'>	
				 <div>
					<p class="" style="padding-left: 5px">
						<?=ucfirst(get_xml_data('company_name'))?> is a division of Jobs Enterprise and it is a community where blog posts about places, people, culture, fashion,
						events and nature are ulploaded.
					</p>
					<p class="" style="padding-left: 5px">
						<?=ucfirst(get_xml_data('company_name'))?> is a division of Jobs Enterprise and it is a community where blog posts about places, people, culture, fashion,
						events and nature are ulploaded.
					</p>
					<p class="" style="padding-left: 5px">
						<?=ucfirst(get_xml_data('company_name'))?> is a division of Jobs Enterprise and it is a community where blog posts about places, people, culture, fashion,
						events and nature are ulploaded.
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