<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','admin/edit_profile/');
require_once(file_location('admin_inc_path','session_check.inc.php'));
$page = "EDIT PROFILE";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
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
				<h2 class='j-text-color1 j-padding j-color4'><b>EDIT PROFILE</b></h2>
			</div>
				<div class="j-container j-padding j-color4">
					<br>
					<div>
						<div id='preview'class='j-border-color5 j-border-2 j-round j-color5 j-clickable j-vertical-center-container'style='width:100px;height:100px;'
							 onclick="$('#admin<?=$adid?>_pics_modal').fadeIn('slow');">
							<img src='<?=file_location('media_url',get_media('admin',$adid))?>'alt=''class='j-round j-card-4'style='width:100px;height:100px;border:solid 2px white'>
							<span class='j-text-color4 j-bold j-vertical-center-element'style='font-size:40px;'>+</span>
						</div>
						<br><br>
						<?php image_modal('admin',$adid)?>
					</div>
					<?php
					if($adid !== 1){ ?>
					<form id='edpro'onsubmit="event.preventDefault();"class=''>
						<label class=""><b>Email</b> <span class='j-text-color1 mg'id='eme'>*</span></label><br>		
						<input type="email"class=" j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Email"maxlength='50'
						  name="em"id="em"value="<?=(content_data('admin_table','ad_email',$adid,'ad_id'))?>"style="width:100%;max-width:400px"/><br>
						  
						<label class=""><b>Username</b> <span class='j-text-color1 mg'id='une'>*</span></label><br>		
						<input type="text"class=" j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Username"maxlength='50'
						  name="un"id="un"value="<?=(content_data('admin_table','ad_username',$adid,'ad_id'))?>"style="width:100%;max-width:400px"/><br>
						
						<label class=""><b>Fullname</b> <span class='j-text-color1 mg'id='fne'>*</span></label><br>		
						<input type="text"class=" j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Fullname"maxlength='50'
						  name="fn"id="fn"value="<?=(content_data('admin_table','ad_fullname',$adid,'ad_id'))?>"style="width:100%;max-width:400px"/><br>
						<button type='submit'id='sbtn'class="j-btn j-medium j-color1 j-round j-bolder">Update Profile</button>
					</form>
					<?php } ?>
				</div>
				<span id="st"></span>
				<br><br>
		</div>
	</div>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>