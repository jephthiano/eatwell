<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','order/track/'.$_GET['val']);
require_once(file_location('inc_path','session_check.inc.php'));
if(isset($_GET['val'])){
	$raw_val = test_input($_GET['val']);
	if(!empty($raw_val)){$order_id = content_data('order_table','or_order_id',$raw_val,'or_order_id');}else{trigger_error_manual(404);}
}else{
	trigger_error_manual(404);
}
//for meta
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "TRACKS | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
insert_page_visit('tracking');
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
				$order_token = content_data('order_table','or_token',$order_id,'or_order_id');
				if($order_id === false || content_data('orderer_table','u_id',$order_token,'or_token') !== $u_id){
					trigger_error_manual(404);
				}else{
					?>
					<?php get_header('TRACK ITEM','order/order_details/'.$order_token,25)?>
					<div class='j-padding'>
						<div class='j-padding'><?php track_item($order_id);?></div>
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