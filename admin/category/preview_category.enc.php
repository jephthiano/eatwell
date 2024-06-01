<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','category/preview_category/'.$_GET['page']);
$page = "CATEGORY DATA";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
if(isset($_GET['page']) AND is_numeric($_GET['page'])){ //getting the value of the get 
	$cid = test_input(removenum($_GET['page']));
	if(!empty($cid)){	
		$id = content_data('category_table','c_id',$cid,'c_id');
	}else{
		trigger_error_manual(404);
	}
}else{
	//trigger_error_manual(404);
}
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
		<div class='j-padding'>
			<h2 class='j-text-color1 j-padding j-color4'><b>PREVIEW CATEGORY DATA</b></h2>
		</div>
		<div class='j-row'>
			<div class='j-margin'>
				<div class=''>
					<a href="<?=file_location('admin_url','category/insert_category/')?>"class='j-btn j-color1 j-right j-round j-card-4 j-bolder'>Insert New Category</a>
				</div>
			</div>
			<br class='j-clearfix'><br>
			<?php
			if($id === false){
				page_not_available('short');
			}else{
				$category = content_data('category_table','c_category',$id,'c_id','','null');
				$icon = content_data('category_table','c_icon',$id,'c_id','','null');
				?>
				<div id=""class='j-col m7 j-padding'>
					<div class='j-color5'><div class='j-padding j-large'><b>Category Data</b></div></div>
					<div class="j-container j-color4 j-padding">
						<?php
						if($adlevel > 1){
							preview_modal('category',$id);
							?>
							<div class='j-right'>
								<a href='<?= file_location("admin_url","category/update_category/".addnum($id)."/");?>'style="margin:3px;"class='j-clickable j-color1 j-btn j-round j-bolder'>
									<i class='<?=icon('edit');?>'style='padding-right:5px;'></i>
									Update Category
								</a>
								<span class='j-clickable j-color1 j-btn j-round j-bolder'style="margin:3px;"onclick="$('#delete_category<?=$id?>').fadeIn('slow');">
									<i class='<?=icon('trash');?>'style='padding-right:5px;'></i>
									Delete Category
								</span>
							</div>
							<span class='j-clearfix'></span>
							<?php
						}
						?>
						<div style='line-height:30px;'>
							<div>
								<div class='j-text-color7 j-bolder j-large'>Images</div>
								<div>
									<img src="<?=file_location('media_url',get_media('category',$id))?>"style='width:100px;height:100px;margin-right:9px;'/>
								</div>
							</div><br>
							<div class='j-row'style='margin-bottom:15px;'>
								<span class='j-text-color7 j-bolder j-large' style='margin-right:9px;'>Category:</span><br>
								<span class='j-text-color3 j-large'><?=ucwords($category);?></span>
							</div>
							<div class='j-row'style='margin-bottom:15px;'>
								<span class='j-text-color7 j-bolder j-large' style='margin-right:9px;'>Category:</span><br>
								<span class='j-text-color3 j-large <?=icon($icon);?>'></span>
							</div>
							<br>
						</div>
						<br<br><br>
					</div>
				</div>
				
				<div id=""class='j-col m5 j-padding'>
					<div class='j-color7'><div class='j-padding j-large'><b>Product Data</b></div></div>
					<div class="j-container j-color4 j-padding"style='line-height:35px;'>
						<div class='j-large'>
							<span class='j-bolder j-text-color1'>Total Product(s) in this Category: </span>
							<span><?=get_numrow('food_table','f_category',$category,"return",'round')?></span>
							<div class='j-bolder j-text-color1'>Total <?=ucwords($category)?> In: </div>
							<div class='j-medium'>
								<?php
								$order_statuses = ['cart','failed','order placed','cancelled','confirmed','packaging','in-transit','delivered','failed delivery'];
								foreach($order_statuses AS $order_status){
									?>
									<div>
										<i class='<?=icon('thumb-up-right')?>'style='margin-right:5px'></i>
										<span class='j-bolder j-text-color5'><?=ucwords($order_status)?>: </span>
										<span><?=get_numrow('order_table,food_table','or_status',$order_status,"return",'round',"AND order_table.f_id = food_table.f_id AND f_category = '{$category}'")?></span>
									</div>
									<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<?php 
			}
			?>
			<span id="st"></span>
		</div>
	</div>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>