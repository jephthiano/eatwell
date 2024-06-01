<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','account/edit_profile/');
require_once(file_location('inc_path','session_check.inc.php'));
//for meta
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png');
$page = "EDIT PROFILE | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
insert_page_visit('edit profile');
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class="j-color6"style="font-family:Roboto,sans-serif;">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page load?>
	<div class='j-hide-small j-hide-medium'><?php require(file_location('inc_path','navigation.inc.php')); //navigation?></div>
	<div class='j-row j-home-padding'style='padding-top:0px;'>
		<div class='j-col l4 xl3 '><?php require_once(file_location('inc_path','account_first_column.inc.php')); //account first column?></div>
		<div class='j-col l8 xl9 j-padding-flexible'>
			<div class='j-color4 j-account-height'>
				<?php get_header('EDIT PROFILE','account/')?>
				<div class='j-padding'>
					<form class=''id='etprfrm'>
						<label><b>Fullname: </b><span class='mg j-text-color1'id='fne'></span></label><br>
						<input type='text'id='fn'name='fn'class="ip j-input j-color4 j-round j-border-2 j-border-color5"
						value='<?=ucwords(content_data('user_table','u_fullname',$u_id,'u_id'))?>'placeholder='Fullame'maxlength='50'style="width:100%;max-width:400px;"/><br>
						
						<label><b>Email: </b><span class='mg j-text-color1'id='eme'></span></label><br>
						<input type='email'id='em'name='em'class="ip j-input j-color4 j-round j-border-2 j-border-color5"
						value='<?=content_data('user_table','u_email',$u_id,'u_id')?>'placeholder='Email'maxlength='50'style="width:100%;max-width:400px;"/><br>
								
						<label><b>Gender: </b><span class='mg j-text-color1'id='gre'></span></label><br>
						<select name='gr'class='j-select j-color4 j-round j-border-2 j-border-color5'style="width:100%;max-width:400px;">
							<option value='Male'<?php if(content_data('user_table','u_gender',$u_id,'u_id') === 'male'){echo 'selected';}?>>Male</option>
							<option value='Female'<?php if(content_data('user_table','u_gender',$u_id,'u_id') === 'female'){echo 'selected';}?>>Female</option>
							<option value='prefer not to say'<?php if(content_data('user_table','u_gender',$u_id,'u_id') === 'prefer not to say'){echo 'selected';}?>>Prefer not to say</option>
						</select><br><br>
						<button type='submit'id='sbtn'class="j-btn j-medium j-color1 j-round j-bolder"style="width:100%;max-width:400px;">Save</button>
					</form>
				</div>
				<br>
			</div>
		</div>
	</div>
	<div><?php require_once(file_location('inc_path','footer.inc.php')); //footer?></div>
	<span id='st'></span>
	<?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>