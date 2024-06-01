<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$location = file_location('home_url','forgot_password/');
$location2 = file_location('home_url','forgot_password/enter_code/');
$page_url = file_location('home_url','forgot_password/');
//for meta
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
if(isset($_GET['page'])){
	$sta = ($_GET['page']);
	if($sta === 'enter_email' || $sta === 'enter_code' || $sta === 'enter_password'){$type = $sta;}else{$type = 'enter_email';}
}else{
$type = 'enter_email';	
}
$page = strtoupper($type)." | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
insert_page_visit('Forgot Password');
?>
<!DOCTYPE html >
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name;?></title></head>
<body style='font-family:Roboto,sans-serif;width:100%;'>
	<center>
		<br><br>
		<div class="j-round j-panel j-border j-border-color5" style="width:100%; max-width:400px; height:auto;">
			<br><br>
			<span class="j-text-color1 j-large "style='line-height:50px'>
				<a href='<?=file_location('home_url','')?>'>
				<img src="<?=file_location('media_url','home/logo.png')?>"class=''alt="<?=get_xml_data('company_name')?> LOGO IMAGE"style="width:200px;height:40px;">
				</a>
				<br><b class='j-bolder j-large j-text-color5'>FORGOT PASSWORD</b>
			</span><br>
			<?php
			if($type === 'enter_email'){
				?>
				<form id='eemfrm'>
					<label class='j-left'>
						<span class='j-bolder j-text-color5 j-large'>Enter your email: </span><span class='mg j-text-color1'id='emae'></span>
					</label>
					<input type="email"class="j-input j-medium j-border-2 j-border-color5 j-round"minlength="3"maxlength="70"placeholder="Email"
						   name="ema"id="ema"value=""style="width:100%;max-width:400px;outline:none;"/><br>
					
					<button type='submit'id='eembtn'class="j-btn j-medium j-color1 j-round j-bolder"style='width:100%;'>CONTINUE</button>
					<br><br>
					<a class="j-text-color3 j-center j-bolder"href="<?= file_location('home_url','login/');?>">Back to Login In</a><br><br>
				</form>
				<?php
			}elseif($type === 'enter_code'){
				$cookie_email = get_forgot_password_token('email');
				$cookie_code = get_forgot_password_token('code');
				$db_code = content_data('emailcode_table','c_code',$cookie_email,'c_email');
				//if cookie email and cookie code are empty or flase || if cookie code is not equal to db code
				if(empty($cookie_email) || $cookie_email === false || empty($cookie_code) || $cookie_code === false || $cookie_code !== $db_code){
					insert_delete_code('delete',$cookie_email);die(header("Location:$location"));
				}
				?>
				<form id='ecdfrm'>
					<div class='j-left j-text-color7'>Code has been sent to your email address, check your email and enter the code, code expires in 5 minutess</div>
					<br class='j-clearfix'><br>
					<label class='j-left'>
						<span class='j-bolder j-text-color5 j-large'>Enter code: </span><span class='mg j-text-color1'id='cdee'></span>
					</label>
					<input type="number"class="j-input j-medium j-border-2 j-border-color5 j-round"minlength="3"maxlength="30"placeholder="Code"
						   name="cde"id="cde"value=""style="width:100%;max-width:400px;outline:none;"/><br>
					
					<button type='submit'id='ecdbtn'class="j-btn j-medium j-color1 j-round j-bolder"style='width:100%;'>CONTINUE</button>
					<br><br>
					<a class="j-text-color3 j-center j-bolder"href="<?= file_location('home_url','login/');?>">Back to Login In</a><br><br>
				</form>
				<?php
			}elseif($type === 'enter_password'){
				$cookie_email = get_forgot_password_token('email');
				$cookie_code = get_forgot_password_token('code');
				$db_code = content_data('emailcode_table','c_code',$cookie_email,'c_email');
				$verify = content_data('emailcode_table','c_verify',$cookie_email,'c_email');
				//if cookie email and cookie code are empty or flase || if cookie code is not equal to db code
				if(empty($cookie_email) || $cookie_email === false || empty($cookie_code) || $cookie_code === false || $cookie_code !== $db_code){
					insert_delete_code('delete',$cookie_email);die(header("Location:$location"));
				}
				if($verify !== 'yes'){die(header("Location:$location2"));}
				?>
				<form id='epsfrm'>
					<label class='j-left'>
						<span class='j-bolder j-text-color5 j-large'>Enter new password: </span><span class='mg j-text-color1'id='pswe'></span>
					</label>
					<input type="password"class="j-input j-medium j-border-2 j-border-color5 j-round"minlength="3"maxlength="30"placeholder="Password"
						   name="psw"id="psw"value=""style="width:100%;max-width:400px;outline:none;"/><br>
					
					<button type='submit'id='epsbtn'class="j-btn j-medium j-color1 j-round j-bolder"style='width:100%;'>RESET PASSWORD</button>
					<br><br>
					<a class="j-text-color3 j-center j-bolder"href="<?= file_location('home_url','login/');?>">Back to Login In</a><br><br>
				</form>
				<?php
			}
			?>
			<br>
		</div>
	</center>
	<span id='st'></span>
<?php require_once(file_location('inc_path','js.inc.php'));?>
</body>
</html>