<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','message/send_email/'.$_GET['page']);
$page = "SEND EMAIL";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
if(!empty($_GET['page']) && is_numeric($_GET['page'])){ //if receiver is numeric
	$cid = test_input(removenum($_GET['page']));
	$receiver = content_data('user_table','u_email',$cid,'u_id');
	if($receiver === false){$receiver = '';}
}else{ //if receiver is email
	if(!empty($_GET['page'])){
		$receiver = test_input($_GET['page']);
	}else{ //if receiver is empty
		$receiver = '';
	}
}
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
		<div id="maincol"class=''>
			<div class=''style='margin-bottom:20px;'>
				<h2 class='j-text-color1 j-padding j-color4'><b>SEND EMAIL</b></h2>
			</div>
			<div id=""class='j-color4'style='padding-top: 9px;'>
				<form onsubmit="event.preventDefault();"id='sndem'class=''>
					<div class='j-row'>
						<div class='j-col m6 j-padding'>
							<label class="j-large j-text-color7"><b>Receiver Email:</b> <span class='j-text-color1 mg'id='eme'>*</span></label>
							<input type="email"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Email"maxlength='50'
							name="em"id="em"value="<?=$receiver?>"style="width:100%;"/><br>
							<label class="j-large j-text-color7"><b>Subject</b> <span class='j-text-color1 mg'id='sbe'>*</span></label><br>
							<input type="text"class="ip j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Subject"maxlength='50'
							name="sb"id="sb"value=""style="width:100%;"/><br>
							<label class="ip j-large j-text-color7"><b>Message</b> <span class='j-text-color1 mg'id='mse'>*</span></label><br>
							<textarea placeholder="Message"id='ms'name="ms"style="width:100%;"rows="4"class="j-input j-medium j-border-2 j-border-color5 j-color4 j-round-large"></textarea>
						</div>					
					</div>
					<div class='j-margin'>
						<button type='submit'id='sbtn'class="j-btn j-medium j-color1 j-round j-bolder">Send Email</button>
					</div>
				</form>
				<span id="st"></span>
				<br><br>
			</div>
		</div>
	</div>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>