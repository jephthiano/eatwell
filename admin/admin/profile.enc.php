<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','admin/profile/');
$page = "PROFILE";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
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
			<div class=''style='margin-bottom:20px;'>
				<h2 class='j-text-color1 j-padding j-color4'><b>PROFILE DATA</b></h2>
			</div>
			<center>
				<spa class='j-padding j-right'>
					<a href="<?=file_location('admin_url','admin/edit_profile')?>"class="j-btn j-color1 j-round j-bolder j-card-4 j-margin">Edit Profile</a>
					<a href="<?=file_location('admin_url','admin/change_password/')?>"class='j-btn j-color1 j-round j-bolder j-card-4'>Change Password</a>
					<?php if(content_data('admin_table','ad_id',$adid,'ad_id') != 1){ ?>
					<span class="j-btn j-color1 j-round j-bolder j-card-4" onclick="$('#delete_account_modal').fadeIn('slow');">Delete Account</span>
					<?php admin_modal('admin_delete_account')?>
					<?php }?>
				</spa>
			<br class='j-clearfix'>
				<div class="j-container j-color4 j-padding">
					<center>
						<div>
							<img src='<?=file_location('media_url',get_media('admin',$adid))?>'alt=''class='j-round j-card-4'style='width:150px;height:150px;border:solid 2px white'>
							<br><br>
						</div>
					</center>
						<div class="j-row-padding j-padding">
							<div class='j-col s4 j-text-color1'><b>EMAIL:</b></div>
							<div class='j-col s8'><b><?=(content_data('admin_table','ad_email',$adid,'ad_id','','null'))?></b></div>
						</div>
						<div class="j-row-padding j-padding">
							<div class='j-col s4 j-text-color1'><b>USERNAME:</b></div>
							<div class='j-col s8'><b><?=(content_data('admin_table','ad_username',$adid,'ad_id','','null'))?></b></div>
						</div>
						<div class="j-row-padding j-padding">
							<div class='j-col s4 j-text-color1'><b>FULLNAME:</b></div>
							<div class='j-col s8'><b><?=(content_data('admin_table','ad_fullname',$adid,'ad_id','','null'))?></b></div>
						</div>
						<div class="j-row-padding j-padding">
							<div class='j-col s4 j-text-color1'><b>LEVEL:</b></div>
							<div class='j-col s8'><b><?=ucwords(check_level(content_data('admin_table','ad_level',$adid,'ad_id','','null')))?></b></div>
						</div>
						<div class="j-row-padding j-padding">
							<div class='j-col s4 j-text-color1'><b>STATUS:</b></div>
							<div class='j-col s8'><b><?=ucwords((content_data('admin_table','ad_status',$adid,'ad_id','','null')))?></b></div>
						</div>
						<br><br>
				</div>
				<span id="st"></span>
			<?php  //preview_modal('admin',$adid); ?>
		</div>
	</div>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>