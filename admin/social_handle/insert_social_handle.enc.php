<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','social_handle/insert_social_handle/');
$page = "INSERT SOCIAL HANDLE";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
if($adlevel < 2){trigger_error_manual(404);}
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(file_location('inc_path','meta.inc.php'));?>		
<title><?=$page_name?></title>
</head>
<body class="j-color6" style="font-family:Roboto,sans-serif;width:100%;"onload="">
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
				<h2 class='j-text-color1 j-padding j-color4'><b>INSERT NEW SOCIAL HANDLE</b></h2>
			</div>
			<center>
				<a href="<?=file_location('admin_url','social_handle/')?>" class="j-btn j-color1 j-right j-bolder j-round j-card-4">Show All Social Handles</a>
				<br class='j-clearfix'>
			</center>
			<div class="j-container j-color4 j-padding">
				<form id='inssmh'onsubmit="event.preventDefault();"class=''>
					<label class=""><b>Name</b> <span class='j-text-color1 mg'id='nme'>*</span></label><br>
					<input type="text"class=" j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Name"maxlength='50'
						name="nm"id="nm"value=""style="width:100%;max-width:400px"/><br>
							   
					<label class=""><b>Icon</b> <span class='j-text-color1 mg'id='ice'>*</span></label><br>
					<input type="text"class=" j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Icon"maxlength='20'
						name="ic"id="ic"value=""style="width:100%;max-width:400px"/><br>
								
					<label class=""><b>Link</b> <span class='j-text-color1 mg'id='lke'>*</span></label><br>
					<input type="text"class=" j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Link"maxlength='50'
						name="lk"id="lk"value=""style="width:100%;max-width:400px"/><br>
					
					<button type='submit'id='sbtn'class="j-btn j-medium j-color1 j-round j-bolder">Insert New Social Handle</button>
				</form>
			</div>
			<br><br>
			<span id="st"></span>
		</div>
	</div>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>