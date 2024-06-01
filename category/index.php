<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
require_once(file_location('inc_path','session_check_nologout.inc.php'));
//for meta
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "FOOD CATEGORY | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$page_url = file_location('home_url','category/');;//url redirection current page
$keywords = get_json_data('keywords','about_us')."|".$page_name;
$description = $page_name;
insert_page_visit('category');
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class="j-color6"style="font-family:Roboto,sans-serif;">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page load?>
	<div><?php require(file_location('inc_path','navigation.inc.php')); //navigation?></div>
	<div class='j-home-padding j-large j-color4 j-text-color1'title='<?=ucfirst(get_xml_data('company_name'))?> Food Category'style='line-height:40px;padding-bottom:8px;padding-top:8px;'>
		<div class='j-row'>
			<? //for all?>
			<a href='<?=file_location('home_url','category/food/all/')?>'>
				<div class='j-col s6 m4 l3 xl3 j-padding j-section j-display-container j-clickable j-round'>
					<div class='j-color4 j-card-4 j-display-container j-text-color4 j-round'style="height:150px;background-image:url('<?=file_location('media_url','category/all.png')?>');background-size:cover;">
					<div class='j-display-bottommiddle j-round'style='width:100%;background-color:rgba(0,0,0,0.7);min-height:30px;'>
						<center><div class='j-medium'><b>All Foods</b></div></center>
					</div>
					</div>
				</div>
			</a>
			<? //for categories?>
			<?php get_category('','category_page'); ?>
			<? //for others?>
			<a href='<?=file_location('home_url','category/food/others/')?>'>
				<div class='j-col s6 m4 l3 xl3 j-padding j-section j-display-container j-clickable j-round'>
					<div class='j-color4 j-card-4 j-display-container j-text-color4 j-round'style="height:150px;background-image:url('<?=file_location('media_url','category/others.png')?>');background-size:cover;">
					<div class='j-display-bottommiddle j-round'style='width:100%;background-color:rgba(0,0,0,0.7);min-height:30px;'>
						<center><div class='j-medium'><b>Others</b></div></center>
					</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	<div><?php require_once(file_location('inc_path','recommended.inc.php')); //recommended?></div>
	<div><?php require_once(file_location('inc_path','footer.inc.php')); //footer?></div>
	<span id='st'></span>
	<?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>