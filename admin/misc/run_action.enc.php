<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','misc/run_action/');
require_once(file_location('admin_inc_path','session_check.inc.php'));
$page = "RUN ACTIONS";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
if($adlevel != 3){trigger_error_manual(404);}
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
		<div id="maincol">
			<div class='j-padding'>
				<h2 class='j-text-color1 j-padding j-color4'><b>RUN ACTIONS</b></h2>
			</div>
			<div class="j-container">
				<div class='j-text-color4 j-right j-color1 j-btn j-round j-bolder j-itallic j-large'onClick="$('#run_action').fadeIn('slow');">
					<i class='<?=icon('hourglass-start')?>'></i> Run Actions
				</div>
				<?php preview_modal('run_action',1);?>
				<br class='j-clearfix'><br>
				<div class='j-padding j-color4'>
					<div class='j-large j-text-color1'><b>The following activities will be carried out if you confirm Run Action :</b></div>
					<div class='j-padding j-text-color3 j-bolder'>
						<div><span class='j-large'style='padding-right: 5px;'>⨀</span> <span>Clear items in cart more than 60 days</span></div>
						<div><span class='j-large'style='padding-right: 5px;'>⨀</span> <span>Clear expired user session data on database</span></div>
						<div><span class='j-large'style='padding-right: 5px;'>⨀</span> <span>Clear recent view more than 30 days</span></div>
						<div><span class='j-large'style='padding-right: 5px;'>⨀</span> <span>Clear expired customer email code in database</span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<span id='st'></span>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>