<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','message/preview_message/'.$_GET['page']);
$page = "PREVIEW MESSAGE";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
if(isset($_GET['page']) AND is_numeric($_GET['page'])){ //getting the value of the get 
	$cid = test_input(removenum($_GET['page']));
	if(!empty($cid)){	
		$id = content_data('message_table','m_id',$cid,'m_id');
	}else{
		trigger_error_manual(404);
	}
}else{
	trigger_error_manual(404);
}
if((content_data('message_table','m_status',$cid,'m_id') === 'new') && $id !== false){
	$message = new message('admin');
	$message->id = $id;
	$message->update_status();
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
		<div id="maincol"class='j-main-col'>
			<div class=''style='margin-bottom:20px;'>
				<h2 class='j-text-color1 j-padding j-color4'><b>MESSAGE DATA</b></h2>
			</div>
			<center>
				<div class='j-padding'>
					<a href="<?=file_location('admin_url','message/all/')?>" class="j-btn j-color1 j-left j-round j-card-4 j-bolder">Show All Messages</a>
					<a href="<?=file_location('admin_url','message/new/')?>" class="j-btn j-color1 j-center j-round j-card-4 j-bolder">Show New Messages</a>
					<a href="<?=file_location('admin_url','message/seen/')?>"class='j-btn j-color1 j-right j-round j-card-4 j-bolder'>Show Seen Message</a>
				</div>
			</center>
				<br class='j-clearfix'><br>
				<div class="j-container">
					<?php
					if($id === false){
						page_not_available('short');
					}else{
						$email = content_data('message_table','m_email',$id,'m_id','','null');
						?>
						<div class='j-color5'><div class='j-padding j-large'><b>Log Details</b></div></div>
						<div class='j-color4 j-padding'>
							<div class='j-clearfix j-right'>
								<a href="<?=file_location('admin_url',"message/send_email/{$email}/")?>"class='j-btn j-color1 j-right j-round j-card-4 j-bolder j-medium'>Reply</a>
							</div>
							<div class="j-row-padding j-padding"><div class='j-col s4 j-text-color1'><b>NAME:</b></div>
								<div class='j-col s8'><?=ucwords(content_data('message_table','m_name',$id,'m_id','','null'))?></div>
							</div>
							<div class="j-row-padding j-padding">
								<div class='j-col s4 j-text-color1'><b>EMAIL:</b></div>
								<div class='j-col s8'><?=$email?></div>
							</div>
							<div class="j-row-padding j-padding">
								<div class='j-col s4 j-text-color1'><b>STATUS:</b></div>
								<div class='j-col s8'><?=content_data('message_table','m_status',$id,'m_id','','null')?></div>
							</div>
							<div class="j-row-padding j-padding">
								<div class='j-col s4 j-text-color1'><b>DATE:</b></div>
								<div class='j-col s8'><?=showdate(content_data('message_table','m_datetime',$id,'m_id','','null'),'')?></div>
							</div>
							<div class="j-row-padding j-padding">
								<div class='j-col s4 j-text-color1'><b>SUBJECT:</b></div>
								<div class='j-col s8'><?=ucwords(content_data('message_table','m_subject',$id,'m_id','','null'))?></div>
							</div>
							<div class="j-row-padding j-padding">
								<div class='j-col s4 j-text-color1'><b>MESSAGE:</b></div>
								<div class='j-col s8'><?=ucwords((content_data('message_table','m_message',$id,'m_id','','null')))?></div>
							</div>
						</div>
						<?php
					}
					?>
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