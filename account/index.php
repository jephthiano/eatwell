<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','account/');
require_once(file_location('inc_path','session_check.inc.php'));
//for meta
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png');
$page = strtoupper(content_data('user_table','u_fullname',$u_id,'u_id'))." ACCOUNT | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
insert_page_visit('account');
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class="j-color6"style="font-family:Roboto,sans-serif;">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page load?>
	<div><?php require(file_location('inc_path','navigation.inc.php')); //navigation?></div>
	<div class='j-row j-home-padding'style='padding-top:0px;'>
		<div class='j-col l4 xl3'><?php require_once(file_location('inc_path','account_first_column.inc.php')); //account first column?></div>
		<div class='j-col l8 xl9 j-padding-flexible'>
			<div class='j-color4 j-account-height'>
				<?php $addttion = "<a href='".file_location('home_url','')."'><span class='j-right j-hide-small j-hide-large j-hide-xlarge j-xlarge'><i class='".icon('home')."'></i></span></a>"?>
				<?php get_header('ACCOUNT INFORMATION'.$addttion,'settings',-30)?>
				<div class='j-row-padding'><br>
					<div class='j-col m6'>
						<div class='j-border j-border-color5'>
							<div class='j-large j-bolder j-padding'>
								Account Details
								<a href='<?=file_location('home_url','/account/edit_profile/')?>'><i class="j-right j-text-color1 <?=icon('edit')?>"></i></a>
							</div><hr>
							<div class='j-padding' style='line-height:38px;'>
								<div><b>Fullname: </b><?=ucwords(content_data('user_table','u_fullname',$u_id,'u_id'))?></div>
								<div><b>Email: </b><?=content_data('user_table','u_email',$u_id,'u_id')?></div>
								<div><b>Gender: </b><?=ucfirst(content_data('user_table','u_gender',$u_id,'u_id'))?></div>
							</div>
						</div>
						<br>
					</div>
					<div class='j-col m6'>
						<div class='j-border j-border-color5'>
							<div class='j-large j-bolder j-padding'>
								Delivery Contact Detail
								<a href='<?=file_location('home_url','account/contact/')?>'><i class="j-right j-text-color1 <?=icon('edit')?>"></i></a>
							</div><hr>
							<div class='j-padding'>
								<div class="j-text-color1 j-bolder">Your Default Address</div>
								<div>
									<?php
									$default_address = content_data('user_contact_table','uc_id',$u_id,'u_id',"AND uc_status = 'default'");
									if($default_address !== false){
										get_contact_detail($default_address);
									}else{
										?>
										<center>
											You have no default delivery address<br>
											<a href='<?=file_location('home_url','account/contact/')?>'class='j-btn j-color1 j-round j-bolder'>Add New Contact</a>
										</center>
										<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='j-margin'>
					<a href="<?=file_location('home_url','account/change_password/')?>"class='j-bolder j-btn j-color1 j-round'>Change Password</a>
				</div>
				<br>
			</div>
		</div>
	</div>
	<?php user_modal('settings');?>
	<div><?php require_once(file_location('inc_path','recommended.inc.php')); //recommended?></div>
	<div><?php require_once(file_location('inc_path','wishlist.inc.php')); //wishlist?></div>
	<div><?php require_once(file_location('inc_path','recently_viewed.inc.php')); //recently viewed?></div>
	<div><?php require_once(file_location('inc_path','footer.inc.php')); //footer?></div>
	<span id='st'></span>
	<?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>