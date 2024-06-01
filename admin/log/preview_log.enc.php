<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','log/preview_log/'.$_GET['page']);
$page = "PREVIEW LOG";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
if(isset($_GET['page']) AND is_numeric($_GET['page'])){ //getting the value of the get 
	$cid = test_input(removenum($_GET['page']));
	if(!empty($cid)){	
		$id = content_data('log_table','l_id',$cid,'l_id');
	}else{
		trigger_error_manual(404);
	}
}else{
	trigger_error_manual(404);
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
				<h2 class='j-text-color1 j-padding j-color4'><b>LOG DATA</b></h2>
			</div>
			<center>
				<div class='j-padding'>
					<a href="<?=file_location('admin_url','log/all/')?>" class="j-btn j-color1 j-left j-round j-card-4 j-bolder">Show All Logs</a>
				</div>
			</center>
				<br class='j-clearfix'><br>
				<div class="j-container">
					<?php
					if($id === false){
						page_not_available('short');
					}else{
						$admin = content_data('admin_table','ad_username',content_data('log_table','ad_id',$id,'l_id','','null'),'ad_id','','null');
						?>
						<div class='j-color5'><div class='j-padding j-large'><b>Log Details</b></div></div>
						<div class='j-color4 j-padding'>
							<div class="j-row-padding j-padding"><div class='j-col s4 j-text-color5'><b>ACTION DOER:</b></div>
								<div class='j-col s8'><?=ucfirst(content_data('log_table','ad_username',$id,'l_id','','null'))?></div>
							</div>
							<div class="j-row-padding j-padding">
								<div class='j-col s4 j-text-color5'><b>BRIEF</b></div>
								<div class='j-col s8'><?=ucfirst(content_data('log_table','l_brief',$id,'l_id','','null'))?></div>
							</div>
							<div class="j-row-padding j-padding">
								<div class='j-col s4 j-text-color5'><b>DETAILS:</b></div>
								<div class='j-col s8'><?=ucfirst($admin.' '. content_data('log_table','l_details',$id,'l_id','','null'))?></div>
							</div>
							<div class="j-row-padding j-padding">
								<div class='j-col s4 j-text-color5'><b>IP ADDRESS:</b></div>
								<div class='j-col s8'><?=content_data('log_table','l_ip_address',$id,'l_id','','null')?></div>
							</div>
							<div class="j-row-padding j-padding">
								<div class='j-col s4 j-text-color5'><b>DATE:</b></div>
								<div class='j-col s8'><?=showdate(content_data('log_table','l_regdatetime',$id,'l_id','','null'),'')?></div>
							</div>
							<div class="j-row-padding j-padding">
								<div class='j-col s4 j-text-color5'><b>CURRENT DOER USERNAME:</b></div>
								<div class='j-col s8'><?=ucfirst($admin)?></div>
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