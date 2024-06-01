<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','admin/change_password/');
$page = "CHANGE PASSWORD";
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
				<h2 class='j-text-color1 j-padding j-color4'><b>CHANGE PASSWORD</b></h2>
			</div>
				<div class="j-container j-padding j-color4">
					<form id='chpsw'onsubmit="event.preventDefault();"class=''>
						<span class='j-text-color1 mg'id='alle'></span>
						<label class=""><b>Old Password</b> <span class='j-text-color1 mg'id='pse'></span></label><br>		
						<input type="password"class="pss  j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Old password"
						  name="ps"id="ps"value=""style="width:100%;max-width:400px"/><br>
						  
						<label class=""><b>New Password</b> <span class='j-text-color1 mg'id='pse2'></span></label><br>		
						<input type="password"class="pss  j-input j-medium j-border-2 j-border-color5 j-round"placeholder="New Password"
						  name="ps2"id="ps2"value=""style="width:100%;max-width:400px"/><br>
						  
						<label class=""><b>Retype New Password</b> <span class='j-text-color1 mg'id='pse3'></span></label><br>		
						<input type="password"class="pss  j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Retype-password"
						  name="ps3"id="ps3"value=""style="width:100%;max-width:400px"/><br>
						  
						<button type='submit'id='sbtn'class="j-btn j-medium j-color1 j-round j-bolder">Change Password</button>
					</form>
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