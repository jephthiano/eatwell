<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url',''.@$_GET['type'].'/');
if(strstr(file_location('home_url',''),'000webhostapp')){$server = 'live';}
require_once(file_location('inc_path','session_check_nologout.inc.php'));
//for
if(isset($_GET['type']) && !empty($_GET['type'])){
	$sta = ($_GET['type']);
	if(content_data('category_table','c_category',$sta,'c_category') !== false || $sta === 'others'){
		$type = $sta;
	}else{
		$type = content_data('category_table','c_category','','',' ORDER BY c_id');
	}
}else{
	$type = content_data('category_table','c_category','','',' ORDER BY c_id');
}
//for meta
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "HOME | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$page_url = file_location('home_url','');
$keywords = get_json_data('keywords','about_us')."|".$page_name;
$description = $page_name;
insert_page_visit('homepage');
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class="j-color6"style="font-family:Roboto,sans-serif;"onload="sD(1)">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page load?>
	<div><?php require(file_location('inc_path','navigation.inc.php')); //navigation?></div>
	<div><?php require_once(file_location('inc_path','slideshow.inc.php')); //slideshow?></div>
	<div><?php require_once(file_location('inc_path','home_data.inc.php')); //food?></div>
	<div><?php if(isset($server) && $server === 'live'){require_once(file_location('inc_path','notice_modal.inc.php')); } //notice ?></div>
	<div><?php require_once(file_location('inc_path','footer.inc.php')); //footer?></div>
	<span id='st'></span>
	<?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>