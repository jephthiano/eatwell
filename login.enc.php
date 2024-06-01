<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
//for meta
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "LOGIN | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$page_url = file_location('home_url','login');
$keywords = get_json_data('keywords','about_us')."|".$page_name;
$description = $page_name;
?>
<!DOCTYPE html >
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name;?></title></head>
<body style='font-family:Roboto,sans-serif;width:100%;'>
	<center>
		<br><br>
		<div class="j-round j-panel j-border j-border-color5"style="width:100%;max-width:400px;height:auto;">
			<br><br>
			<span class="j-text-color1 j-large"style='line-height:50px'>
				<a href='<?=file_location('home_url','')?>'>
				<img src="<?=file_location('media_url','home/logo.png')?>"class=''alt="<?=get_xml_data('company_name')?> LOGO IMAGE"style="width:200px;height:40px;">
				</a>
				<br><b class='j-bolder j-text-color5'>LOGIN</b>
			</span><br>
			<form id='lgfrm'onsubmit="event.preventDefault();">
				<br>
				<input type="text"class="j-input j-medium j-border-2 j-border-color5 j-round"minlength="3"maxlength="70"placeholder="Email"
				name="uemail"id="uemail"value=""style="width:100%;max-width:400px;outline:none;"/><br>
				
				<input type="password"class="j-input j-medium j-border-2 j-border-color5 j-round"maxlength="40"minlength="7"
				placeholder="Password"name="pd"id="pd"value=""style="width:100%;max-width:400px;outline:none;"/><br>			
				
				<input type="hidden"name="re"value="<?=isset($_GET['re'])?($_GET['re']):file_location('home_url','');?>">
				<a class="j-right j-text-color3 j-bolder"href="<?=file_location('home_url','forgot_password/');?>">Forget Your Password?</a><br class='j-clearfix'><br>
				<button type='submit'id='lgbtn'class="j-btn j-medium j-color1 j-round j-bolder"style='width:100%;'>Log In</button>
				<br><br>
				<a class="j-text-color5 j-center j-bolder"href="<?= file_location('home_url','signup?re='.@$_GET['re']);?>">Not a member? Sign Up</a><br><br>
			</form>
			<br>
		</div>
	</center>
	<span id='st'></span>
<?php require_once(file_location('inc_path','js.inc.php'));?>
</body>
</html>