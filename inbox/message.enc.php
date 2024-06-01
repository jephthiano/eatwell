<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','inbox/message/'.$_GET['val'].'/');
require_once(file_location('inc_path','session_check.inc.php'));
if(isset($_GET['val'])){
	$raw_val = test_input(removenum($_GET['val']));
	if(!empty($raw_val)){$id = content_data('notification_table','or_id',$raw_val,'or_id');}else{trigger_error_manual(404);}
}else{
	trigger_error_manual(404);
}
//for meta
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "MESSAGE | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
insert_page_visit('message');
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
					<?php
					if($id === false || content_data('notification_table','u_id',$id,'or_id') !== $u_id){  
						trigger_error_manual(404);
					}else{
						//change all notification status to seen
						$notification = new order('admin');
						$notification->or_id = $id;
						$notification->change_status('change_read');
						
						$f_id = content_data('order_table','f_id',$id,'or_id','','null');
						$fm_id = content_data('food_media_table','fm_id',$f_id,'f_id','','null');
						$image_link = "<img class=''src='".file_location('media_url',get_media('food',$fm_id))."'style='width:40px;height:40px;margin-right:20px;'>";
						$header = $image_link.text_length(ucwords(content_data('food_table','f_name',$f_id,'f_id','','null')),15,'dots');
						?>
						<?php get_header($header,'inbox/')?>
						<div class='j-padding'>
							<?php
							$dat = multiple_content_data('notification_table','n_id',$u_id,'u_id',"AND or_id = {$id} ORDER BY n_id DESC",);
							if($dat !== false){
							foreach($dat AS $n_id){
								?>
								<div class='j-padding j-round j-color4'style='width:90%;max-width:400px;'>
									<div class='j-bolder'style='line-height: 30px;'>
										<span><?=ucwords(content_data('notification_table','n_title',$n_id,'n_id','','null'))?></span>
									</div>
									<div><?=ucfirst(content_data('notification_table','n_message',$n_id,'n_id','','null'))?></div>
									<div class='j-bolder j-text-color3 j-right j-small'>
										<?php $date = content_data('notification_table','n_regdatetime',$n_id,'n_id','','null');?>
										<?=show_date($date)?>
										<span style='margin-left:4px;'><?=show_time($date)?></span>
									</div>
									<br class='j-clearfix'>
								</div>
								<br>
								<?php
							}
							}
							?>
							<br>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	<div><?php require_once(file_location('inc_path','footer.inc.php')); //footer?></div>
	<span id='st'></span>
	<?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>