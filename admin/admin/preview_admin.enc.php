<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','admin/preview_admin/'.$_GET['page']);
$page = "PREVIEW ADMIN";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
if($adlevel != 3){trigger_error_manual(404);}
if(isset($_GET['page']) AND is_numeric($_GET['page'])){ //getting the value of the get 
	$cid = test_input(removenum($_GET['page']));
	if(!empty($cid)){	
		$id = content_data('admin_table','ad_id',$cid,'ad_id');
	}else{
		trigger_error_manual(404);
	}
}else{
	trigger_error_manual(404);
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
		<div id="maincol"class='j-main-col'>
			<div class=''style='margin-bottom:;'>
				<h2 class='j-text-color1 j-padding j-color4'><b>ADMIN DATA</b></h2>
			</div>
			<center>
				<div class='j-padding'>
					<a href="<?=file_location('admin_url','admin/all/')?>" class="j-btn j-color1 j-left j-round j-card-4 j-bolder">Show All Admins</a>
					<a href="<?=file_location('admin_url','admin/insert_admin/')?>"class='j-btn j-color1 j-right j-round j-card-4 j-bolder'>Insert New Admin</a>
				</div>
				</center>
				<br class='j-clearfix'><br>
				<div class="j-container j-color4 j-padding">
					<?php
					if($id === false){
						page_not_available('short');
					}else{
						$username = content_data('admin_table','ad_username',$id,'ad_id','','null');
						$status = content_data('admin_table','ad_status',$id,'ad_id','','null');
						if($adid === 1){
							preview_modal('admin',$id)
							?>
							<div class='j-right'>
								<span class='j-clickable j-color1 j-btn j-round j-bolder'style="margin:3px;"onclick="$('#update_admin<?=$id?>').fadeIn('slow');">
									<i class='<?=icon('sort-amount-up');?>'style='padding-right:5px;'></i>
									Update <?=ucwords($username)?> Level
								</span>
								<span class='j-clickable j-color1 j-btn j-round j-bolder'style="margin:3px;"onclick="$('#admin<?=$id?>status').fadeIn('slow');">
									<i class='<?=icon('ban');?>'style='padding-right:5px;'></i>
									<?= $status === 'active'?'Suspend':'Re-activate';?> <?=ucwords($username)?>
								</span>
								<span class='j-clickable j-color1 j-btn j-round j-bolder'style="margin:3px;"onclick="$('#delete_admin<?=$id?>').fadeIn('slow');">
									<i class='<?=icon('trash');?>'style='padding-right:5px;'></i>
									Delete Account
								</span>
							</div>
							<br class='j-clearfix'><br>
							<?php
						}
						?>
						<center>
							<div>
								<img src='<?=file_location('media_url',get_media('admin',$id))?>'alt=''class='j-circle j-card-4'style='width:150px;height:150px;border:solid 2px white'>
								<br><br>
							</div>
						</center>
						<div class="j-row-padding j-padding">
							<div class='j-col s4 j-text-color1'><b>EMAIL:</b></div>
							<div class='j-col s8'><b><?=(content_data('admin_table','ad_email',$id,'ad_id','','null'))?></b></div>
						</div>
						<div class="j-row-padding j-padding">
							<div class='j-col s4 j-text-color1'><b>USERNAME:</b></div>
							<div class='j-col s8'><b><?=($username)?></b></div>
						</div>
						<div class="j-row-padding j-padding">
							<div class='j-col s4 j-text-color1'><b>FULLNAME:</b></div>
							<div class='j-col s8'><b><?=ucwords(content_data('admin_table','ad_fullname',$id,'ad_id','','null'))?></b></div>
						</div>
						<div class="j-row-padding j-padding">
							<div class='j-col s4 j-text-color1'><b>LEVEL:</b></div>
							<div class='j-col s8'><b><?=ucwords(check_level(content_data('admin_table','ad_level',$id,'ad_id','','null')))?></b></div>
						</div>
						<div class="j-row-padding j-padding">
							<div class='j-col s4 j-text-color1'><b>STATUS:</b></div>
							<div class='j-col s8'><b><?=ucwords($status)?></b></div>
						</div>
						
						<div class="j-row-padding j-padding">
							<div class='j-col s4 j-text-color1'><b>REGISTERED BY:</b></div>
							<div class='j-col s8'><b><?=content_data('admin_table','ad_username',content_data('admin_table','ad_registered_by',$id,'ad_id','','null'),'ad_id','','null');?>
							</b></div>
						</div>
						<br><br>
						<?php
					}
					?>
				</div>
				<span id="st"></span>
		</div>
	</div>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>