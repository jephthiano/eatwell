<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','admin/insert_admin/');
$page = "INSERT ADMIN";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
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
		<div class='j-padding'>
			<h2 class='j-text-color1 j-padding j-color4'><b>INSERT NEW ADMIN</b></h2>
		</div>
		<div class='j-padding'>
			<a href="<?=file_location('admin_url','admin/all/')?>" class="j-btn j-color1 j-right j-bolder j-round j-card-4">Show All Admins</a>
			<br class='j-clearfix'>
		</div>
		<div id=""class='j-color4'style='padding-top:9px;'>
			<div id='preview'class='j-border-color7 j-border-2 j-round j-color5 j-vertical-center-container j-margin'style='width:100px;height:100px;'
				 onclick='ti($("#image"))'>
				<span class='j-text-color4 j-bold j-vertical-center-element'style='font-size:40px;'>+</span>
			</div>
			<form onsubmit="event.preventDefault();"class=''id='insad'>
				<input type="file"name="image"id="image"class="j-round j-hide"onchange="pi(this,document.getElementById('preview'));">
				<div class='j-row'>
					<div class='j-col m6 j-padding'>
						<label class="j-large j-text-color7"><b>Email:</b> <span class='j-text-color1 mg'id='eme'>*</span></label>
						<input type="email"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Email"maxlength='50'
							name="em"id="em"value=""style="width:100%;"/>
					</div>
					<div class='j-col m6 j-padding'>
						<label class="j-large j-text-color7"><b>Username:</b> <span class='j-text-color1 mg'id='une'>*</span></label>
						<input type="text"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Username"maxlength='50'
							name="un"id="un"value=""style="width:100%;"/>
					</div>
				</div>
				<div class='j-row'>
					<div class='j-col m6 j-padding'>
						<label class="j-large j-text-color7"><b>Fullname:</b> <span class='j-text-color1 mg'id="fne">*</span></label>
						<input type="text"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Fullname"maxlength='50'
							   name="fn"id="fn"value=""style="width:100%;"/>
					</div>
					<div class='j-col m6 j-padding'>
						<label class="j-large j-text-color7"><b>Password:</b> <span class='j-text-color1 mg'id='pse'>*</span></label>
						<input type="password"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Password"maxlength='100'
							name="ps"id="ps"value=""style="width:100%;"/>
					</div>
				</div>
				<div class='j-row'>
					<div class='j-col m6 j-padding'>
						<label class="j-large j-text-color7"><b>Level:</b> <span class='j-text-color1 mg'id="lve">*</span></label>
						<select name='lv'class='j-select j-color4 j-round j-border-2 j-border-color5'style="width:100%;">
							<?php get_level(3)?>
						</select>
					</div>
				</div>
				<div class='j-margin'>
					<button type='submit'id='sbtn'class="j-btn j-medium j-color1 j-round j-bolder">Insert New Admin</button>
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