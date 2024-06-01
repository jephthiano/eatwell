<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','review/product_review/'.$_GET['val']);
require_once(file_location('inc_path','session_check_nologout.inc.php'));
if(isset($_GET['val'])){
	$raw_val = test_input(removenum($_GET['val']));
	if(!empty($raw_val)){$id = content_data('food_table','f_id',$raw_val,'f_id');}else{trigger_error_manual(404);}
}else{
	trigger_error_manual(404);
}
if(isset($_GET['level'])){
	$sta = ($_GET['level']);
	if($sta == 'all' || $sta == 1 || $sta == 2 || $sta == 3|| $sta == 4 || $sta == 5 ){$level = $sta;}else{$level = 'all';}
}else{
$level = 'all';	
}
//for meta
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "CUSTOMER REVIEW & RATING | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
insert_page_visit('customer review');
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class="j-color6"style="font-family:Roboto,sans-serif;">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page load?>
	<div class='j-hide-small j-hide-medium'><?php require(file_location('inc_path','navigation.inc.php')); //navigation?></div>
	<?php
	if($id === false || content_data('review_table','f_id',$id,'f_id') === false){
		trigger_error_manual(404);
	}else{
		?>
		<div class='j-row j-home-padding j-color4'style='padding-top:5px;'>
		<?php get_header('CUSTOMER REVIEW',"food/".addnum($id))?>
			<div class='j-col l4 xl3 j-padding-flexible'>
					<?php get_rating($id,'rating');?>
			</div>
			<div class='j-col l8 xl9 j-padding-flexible'>
				<?php // start buttons?>
				<div class='j-large j-vertical-scroll'style='overflow-y:hidden;'>
					<div class=""style="padding:10px 0px;display:inline">
						<a href='<?=file_location('home_url','review/product_review/'.addnum($id).'/all/')?>'>
						<span class="j-padding j-clickable j-btn j-round-large j-small <?=$level == 'all'?'j-color1':'j-color5';?>">All (<?=get_numrow('review_table','f_id',$id,"return",'round')?>)</span>
						</a>
					</div>
					<?php
					for($i=1;$i<=5;$i++){
						?>
						<div class=""style="padding:10px 0px;display:inline">
							<a href='<?=file_location('home_url','review/product_review/'.addnum($id)."/{$i}/")?>'>
							<span class="j-padding j-clickable j-btn j-round-large j-small <?=$level == $i?'j-color1':'j-color5';?>">
								<?php for($x=0;$x<$i;$x++){?><i class='<?=icon('star','far')?>'></i><?php }?> (<?=get_numrow('review_table','f_id',$id,"return",'round',"AND r_rating = {$i}")?>)
							</span>
							</a>
						</div>
						<?php
					}
					?>
				</div>
				<?php //customer rating?>
				<div class='j-color4 j-padding'>
					<?php require_once(file_location('inc_path','product_pagination.inc.php')); //product review pagination?>
				</div>
				<br>
			</div>
			<br><br><br>
		</div>
		<?php
	}
	?>
	<div><?php require_once(file_location('inc_path','recommended.inc.php')); //recommended?></div>
	<div><?php require_once(file_location('inc_path','wishlist.inc.php')); //wishlist?></div>
	<div><?php require_once(file_location('inc_path','recently_viewed.inc.php')); //recently viewed?></div>
	<div><?php require_once(file_location('inc_path','footer.inc.php')); //footer?></div>
	<span id='st'></span>
	<?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>