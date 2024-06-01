<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
require_once(file_location('inc_path','session_check_nologout.inc.php'));
if(isset($_GET['val'])){
	$raw_val = ($_GET['val']);
	if(empty($raw_val)){$val = 'all';}else{$val = urldecode($raw_val);}
}else{
	$val = 'all';
}
//for meta
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = strtoupper($val)." FOODS | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$page_url = file_location('home_url','category/food/'.$val);//url redirection current page
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
	<div title='<?=ucfirst(get_xml_data('company_name'))?> Foods'class=''>
		<?php
		if($val === 'all'){
			//each category
			get_category('','food_page');
			
			//for others
			$or = multiple_content_data('food_table','f_id','others','f_category',"AND f_status = 'available' ORDER BY f_id DESC LIMIT 6");
			if($or !== false){
				?>
				<br>
				<div class='j-home-padding'style='margin:0px;margin-bottom:9px;'>
				 <div class='j-color6'>
				  <div class='j-large j-color5 j-text-color4 j-padding'>
				   <b style='font-size:21px;'>Others</b>
				   <a href="<?=file_location('home_url',"category/food/others/")?>"class='j-medium j-right j-text-color1 j-padding'><span class=''><b>SEE ALL &#10095</b></span></a><span class='j-clearfix'></span>
				  </div>
				  <div id='food_page_others'><center><br><br><span class='j-text-color1 j-spinner-border j-spinner-border j-large'></span> <br><br></center></div>
				 </div>
				</div>
				<script>$(document).ready(function(){$.ajax({type:'GET',url:dar+'get/gfpd/'+'others'+'/',cache:false}).done(function(s){$("#food_page_others").html(s);})})</script>
				<?php
			}
			//if no food id availables
			if(get_numrow('food_table') < 1){
				?><center><br><br><div class='j-text-color3'><b>No food available at the moment</b></div></center><br><br><?php
			}
		}else{
			?>
			<div class='j-color4 j-home-padding'title='<?=ucfirst(get_xml_data('company_name')).ucwords($val)?>'>
				<div class='j-xlarge j-padding'><b><?=ucwords($val)?></b><hr></div>
				<?php require_once(file_location('inc_path','product_pagination.inc.php')); //search pagination?>
			</div>
			<div><?php require_once(file_location('inc_path','recommended.inc.php')); //recommended?></div>
			<?php 
		}
		?>
	</div>
	<div><?php require_once(file_location('inc_path','footer.inc.php')); //footer?></div>
	<span id='st'></span>
	<?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>