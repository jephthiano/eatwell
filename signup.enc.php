<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
//for meta
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "SIGN UP | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$page_url = file_location('home_url','signup/');
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
				<br><b class='j-bolder j-xlarge j-text-color5'>SIGN UP</b>
			</span><br>
			<form id='sufrm'onsubmit="event.preventDefault();">
				<br>
				<span class='mg j-text-color1 j-left'id='emae'></span>
				<input type="text"class="j-input j-medium j-border-2 j-border-color5 j-round"minlength="3"maxlength="70"placeholder="Email"maxlength='50'
				name="ema"id="ema"value=""style="width:100%;max-width:400px;outline:none;"/><br>
				
				<span class='mg j-text-color1 j-left'id='name'></span>
				<input type="text"class="j-input j-medium j-border-2 j-border-color5 j-round"minlength="3"maxlength="50"placeholder="Fullname"maxlength='50'
				name="nam"id="nam"value=""style="width:100%;max-width:400px;outline:none;"/><br>
				
				<span class='mg j-text-color1 j-left'id='pde'></span>
				<input type="password"class="j-input j-medium j-border-2 j-border-color5 j-round"maxlength="40"minlength="7"placeholder="Password"maxlength='100'
				name="pd"id="pd"value=""style="width:100%;max-width:400px;outline:none;"/><br>
				
				<input type="hidden"name="re"value="<?=isset($_GET['re'])?($_GET['re']):file_location('home_url','');?>">
				
				<button type='submit'id='subtn'class="j-btn j-medium j-color1 j-round-large j-bolder"style='width:100%;'>Sign Up</button>
				<br><br>
				<a class="j-text-color3 j-center j-bolder"href="<?= file_location('home_url','login?re='.@$_GET['re']);?>">Already a member? Login In</a><br><br>
			</form>
			<br>
		</div>
	</center>
	<span id='st'></span>
<?php require_once(file_location('inc_path','js.inc.php'));?>
</body>
</html>