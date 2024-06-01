<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','account/contact/');
require_once(file_location('inc_path','session_check.inc.php'));
//for meta
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png');
$page = "CONTACT | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
insert_page_visit('contact');
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
				<?php $total_contact = get_numrow('user_contact_table','u_id',$u_id,"return",'round');?>
				<?php get_header("CONTACTS ($total_contact)",'account')?>
				<div class='j-large j-bolder j-padding'>
					<div onclick="ccm(<?=$total_contact?>);"class='j-btn j-round j-bolder j-right j-medium 
					<?=$total_contact<5?'j-color1':'j-color5';?>'><i class='<?=icon('plus')?>'></i></div>
					<br class='j-clearfix'>
				</div><hr>
				<?php
				user_modal('contact_modal','','add_contact_modal');
				$or = multiple_content_data('user_contact_table','uc_id',$u_id,'u_id',"ORDER BY uc_status DESC");
				if($or !== false){
					?>
					<div class='j-row-padding'>
						<?php foreach($or AS $id){ ?>
						<div class='j-col m6 j-section'><div class='j-border-2 j-border-color5 j-padding j-round'><?php get_contact_detail($id,'contact');?></div></div>
						<?php
						user_modal('contact_modal',$id,'edit_contact_modal');
						user_modal('contact_modal',$id,'delete_contact');
						}
						?>
					</div>
					<?php
				}else{
					?><center>You have no default delivery address<br><a href='<?=file_location('home_url','contact/add_contact/')?>'class='j-btn j-color1 j-round j-bolder'>Add New Contact</a></center><?php
				}
				
				?>
				<br>
			</div>
		</div>
	</div>
	<div><?php require_once(file_location('inc_path','recommended.inc.php')); //recommended?></div>
	<div><?php require_once(file_location('inc_path','wishlist.inc.php')); //wishlist?></div>
	<div><?php require_once(file_location('inc_path','recently_viewed.inc.php')); //recently viewed?></div>
	<div><?php require_once(file_location('inc_path','footer.inc.php')); //footer?></div>
	<span id='st'></span>
	<?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>