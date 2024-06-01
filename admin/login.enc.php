<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page = "LOGIN | CPANEL";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
// delete session if one has set
require_once(file_location('admin_inc_path','session_start.inc.php'));
if(isset($_SESSION['admin_id'])){require_once(file_location('admin_inc_path','session_destroy.inc.php'));}
$company_name = get_xml_data('company_name');
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body style='font-family:Roboto,sans-serif;width:100%;background-size:cover'>
<?php require_once(file_location('inc_path','page_load.inc.php')); //page load?>
	<center>
		<br><br>
		<div class="j-round j-panel j-border j-border-color5"style="width:100%;max-width:400px;height:auto;">
			<br><br>
			<span class="j-text-color1 j-large"style='line-height:50px'>
				<img src="<?=file_location('media_url','home/logo.png')?>"class=''alt="<?=get_xml_data('company_name')?> LOGO IMAGE"style="width:200px;height:40px;">
				<br><b class='j-bolder j-text-color5'>ADMIN LOGIN</b>
			</span><br>
			<form onsubmit="event.preventDefault();">
				<br>
				<span id='error' class='j-text-color4'></span>
				<input type="text" class="j-input j-medium j-border-2 j-border-color5 j-round" minlength="3" maxlength="30" placeholder="Username"
				name="uname" id="uname" value="" style="width:100%;max-width:400px;outline:none;"/><br>
				
				<input type="password"class="j-input j-medium j-border-2 j-border-color5 j-round"maxlength="40"minlength="7"
				placeholder="Password" name="pd"id="pd"value=""style="width:100%;max-width:400px;outline:none;"/><br>			
				
				<input type="hidden"name="re"id="re"value="<?=isset($_GET['re'])?($_GET['re']):file_location('admin_url','');?>">
				<button type='submit'id='sbtn'class="j-btn j-medium j-color1 j-round j-left j-bolder"style='width:100%;'>Log In As Admin</button>
				<br class='j-clearfix'><br>
			</form>
			<br>
		</div>
	</center>
	<span id='st'></span>
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>