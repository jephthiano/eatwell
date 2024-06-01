<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','food/'.@$_GET['val']);;//url redirection current page
require_once(file_location('inc_path','session_check_nologout.inc.php'));
if(isset($_GET['val'])){
	$raw_val = test_input(removenum($_GET['val']));
	if(!empty($raw_val)){$id = content_data('food_table','f_id',$raw_val,'f_id');$fm_id = content_data('food_media_table','fm_id',$id,'f_id');}else{trigger_error_manual(404);}
}else{
	trigger_error_manual(404);
}
//for meta
$follow_type = 'follow';
$image_link = file_location('media_url',get_media('food',$fm_id));
$image_type = substr($image_link,-3);
$page = ucwords(content_data('food_table','f_name',$id,'f_id','','null'))." | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$keywords = get_json_data('keywords','about_us')."|".$page_name;
$description = $page_name;
insert_page_visit('food details');
if(isset($_SESSION['user_id'])){insert_viewed($id);}
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$id===false?"404 Error Not Found":$page_name?></title></head>
<body id="body"class="j-color6"style="font-family:Roboto,sans-serif;">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page load?>
	<div><?php require(file_location('inc_path','navigation.inc.php')); //navigation?></div>
	<?php
	if($id === false){
		trigger_error_manual(404);
	}else{
		?>
		<div title='<?=ucwords(content_data('food_table','f_name',$id,'f_id','','null'))?>'class='j-home-padding'>
				<div class='j-row'>
					<div class='j-col l9 j-padding-flexible'>
						<?php show_food($id,'food_details')?>
					</div>
					<div class='j-col l3 j-padding-flexible'>
						<div class='j-color4 j-padding-small'style='line-height:30px;margin-bottom:9px;'>
							<div class='j-large'><b>Delivery Info</b></div>
							<div>
								<div>
								<div class='j-row'>
									<span class=''style='margin-right:5px;'><i class="<?=icon('truck')?> j-large"></i></span>
									<span class=''>Delivery can either be home delivery or pickup</span>
								</div><hr>
								<div class='j-row'>
									<span class=''style='margin-right:5px;'><i class="<?=icon('truck')?> j-large"></i></span>
									<span class=''>Delivery is only in <?=ucwords(get_json_data('locality','about_us'))?></span>
								</div><hr>
								<div class='j-row'>
									<span class=''style='margin-right:5px;'><i class="<?=icon('handshake')?> j-large"></i></span>
									<span class=''>Return policy is not available</span>
								</div><hr>
								<div class='j-row'>
									<span class=''style='margin-right:5px;'><i class="<?=icon('credit-card')?> j-large"></i></span>
									<span class=''>Pay online or on delivery/pickup</span>
								</div><hr>
							</div>
						</div>
						<div class='j-color4 j-padding-small'style='margin-bottom:9px;'>
							<div class='j-large'><b>Customers Review</b></div>
							<div class='j-color4'>
								<?php
								$add="ORDER BY r_id DESC LIMIT 3";
								$or = multiple_content_data('review_table','r_id',$id,'f_id',$add);
								if($or !== false){
									foreach($or AS $r_id){get_rating($r_id,'second_column_feedback');}
								}else{
									?><div class='j-text-color7'style='margin-top:8px;'>No rating is available at the moment</div><?php
								}
								?>
							</div>
							<?php if(get_numrow('review_table','f_id',$id,"return",'round') > 0){?>
							<a class='j-text-color1 j-bolder'href='<?=file_location('home_url','review/product_review/'.addnum($id).'/all/')?>'><div style='margin-top:16px;'>See All Reviews</a></div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div><?php require_once(file_location('inc_path','recommended.inc.php')); //recommended?></div>
		<?php
	}
	?>
	<div><?php require_once(file_location('inc_path','footer.inc.php')); //footer?></div>
	<span id='st'></span>
	<?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>