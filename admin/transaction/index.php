<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','transaction/');
$page = "MANAGE TRANSACTIONS";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
if($adlevel < 3){trigger_error_manual(404);}
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(file_location('inc_path','meta.inc.php'));?>		
<title><?=$page?></title>
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
				<h2 class='j-text-color1 j-padding j-color4'><b>TRANSACTIONS HOME</b></h2>
			</div>
			<center>
				<div class="j-container">
					<a href="<?=file_location('admin_url','transaction/all/all/')?>"class='j-btn j-color1 j-text-color4 j-round j-container j-margin-cpanel'style="padding:20px 40px;">
						<b><span class='j-large'>All</span></b><br><b><span class='j-large'>Transactions</span></b>
					</a>
					<a href="<?=file_location('admin_url','transaction/daily/'.process_day().'/')?>"class='j-btn j-color1 j-text-color4 j-round j-container j-margin-cpanel'style="padding:20px 40px;">
						<b><span class='j-large'>Today</span></b><br><b><span class='j-large'>Transaction</span></b>
					</a>
					<a href="<?=file_location('admin_url','transaction/annual/all/')?>"class='j-btn j-color1 j-text-color4 j-round j-container j-margin-cpanel'style="padding:20px 40px;">
						<b><span class='j-large'>Annual</span></b><br><b><span class='j-large'>Transactions</span></b>
					</a>
					<a href="<?=file_location('admin_url','transaction/monthly/all/')?>"class='j-btn j-color1 j-text-color4 j-round j-container j-margin-cpanel'style="padding:20px 40px;">
						<b><span class='j-large'>Monthly</span></b><br><b><span class='j-large'>Transactions</span></b>
					</a>
					<a href="<?=file_location('admin_url','transaction/daily/all/')?>"class='j-btn j-color1 j-text-color4 j-round j-container j-margin-cpanel'style="padding:20px 40px;">
						<b><span class='j-large'>Daily</span></b><br><b><span class='j-large'>Transactions</span></b>
					</a>
					<a href="<?=file_location('admin_url','transaction/stats/')?>"class='j-btn j-color1 j-text-color4 j-round j-container j-margin-cpanel'style="padding:20px 40px;">
						<b><span class='j-large'>Transaction</span></b><br><b><span class='j-large'>Statistics</span></b>
					</a>
				</div>
			</center>
		</div>
	</div>
</div>
<span id='st'></span>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>