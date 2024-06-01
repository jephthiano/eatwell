<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','/category/insert_category/');
$page = "INSERT CATEGORY";
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
			<h2 class='j-text-color1 j-padding j-color4'><b>INSERT NEW CATEGORY</b></h2>
		</div>
		<div class='j-padding'>
			<a href="<?=file_location('admin_url','category/')?>" class="j-btn j-color1 j-right j-round j-card-4 j-bolder">Show All Category</a>
			<br class='j-clearfix'>
		</div>
		<div id=""class='j-color4'style='padding-top: 9px;'>
			<div id='preview'class='j-border-color7 j-border-2 j-round j-color5 j-vertical-center-container j-margin j-clickable'style='width:100px;height:100px;'
				 onclick='ti($("#image"))'>
				<span class='j-text-color4 j-bold j-vertical-center-element'style='font-size:40px;'>+</span>
			</div>
			<form onsubmit="event.preventDefault();"id='inscg'class=''>
				<input type="file"name="image"id="image"class="j-round j-hide"onchange="pi(this,document.getElementById('preview'));">
				<div class='j-row'>
					<div class='j-col m6 j-padding'>
						<label class="j-large j-text-color7"><b>Category:</b> <span class='j-text-color1 mg'id="cte">*</span></label>
						<input type="text"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Category"maxlength='50'
						name="ct"id="ct"value=""style="width:100%;"/><br>
						<label class="j-large j-text-color7"><b>Icon</b> <span class='j-text-color1 mg'id='ice'>*</span></label><br>
						<input type="text"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Icon"maxlength='50'
						name="ic"id="ic"value=""style="width:100%;"/><br>
					</div>					
				</div>
				<div class='j-margin'>
					<button type='submit'id='sbtn'class="j-btn j-medium j-color1 j-round j-bolder">Insert Category</button>
				</div>
			</form>
			<span id="st"></span>
			<br><br>
		</div>
	</div>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>