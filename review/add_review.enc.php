<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
$page_url = file_location('home_url','review/add_review/'.$_GET['val']);
require_once(file_location('inc_path','session_check.inc.php'));
if(isset($_GET['val'])){
	$raw_val = test_input(removenum($_GET['val']));
	if(!empty($raw_val)){$id = content_data('order_table','or_id',$raw_val,'or_id');}else{trigger_error_manual(404);}
}else{
	trigger_error_manual(404);
}
//for meta
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = "ADD REVIEW | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
insert_page_visit('add review');
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
				$order_token = content_data('order_table','or_token',$id,'or_id');
				//if id is false || orderer is not user || review has been added
				if($id === false || content_data('order_table','user_id',$order_token,'or_token') !== $u_id || content_data('review_table','or_id',$id,'or_id') !== false){  
					trigger_error_manual(404);
				}else{
					$f_id = content_data('order_table','f_id',$id,'or_id');
					$fm_id = content_data('food_media_table','fm_id',$f_id,'f_id');
					?>
					<?php get_header('ADD RATING & REVIEW','review/')?>
						<div class='j-padding'>
							<form class=''id='adrvfrm'>
								<label><b>Ratings: </b><span class='mg j-text-color1'id='rte'></span></label><br>
								<div class='j-row'>
									<div class='j-col s3 m2'style='padding: 6px 9px 6px 0px;'>
										<img class='j-round-large'src="<?=file_location('media_url',get_media('food',$fm_id))?>"style='width:100%;height:70px;'/>
									</div>
									<div class='j-col s9 m10 j-large j-bolder j-text-color7'>
										<div style='margin-bottom:9px;'><?=ucwords(content_data('food_table','f_name',$f_id,'f_id','','null'));?></div>
										<div class=''id='rtg'>
											<?php for($i=0;$i<5;$i++){?><i class='j-xlarge j-text-color5 <?=icon('star')?>'style='margin-right:9px;'onclick='srs(<?=($i+1)?>);'></i><?php }?>
										</div>
									</div>
								</div>
								<input type='hidden'name='rt'id='rt'value=''/>
								
								<label><b>Your Name: </b><span class='mg j-text-color1'id='nme'></span></label><br>
								<input type='text'id='nm'name='nm'class="ip j-input j-color4 j-round j-border-2 j-border-color5"
								value=''placeholder='Your Name' maxlength='30'style="width:100%;max-width:400px;"/><br>
								
								<label><b>Title: </b><span class='mg j-text-color1'id='tte'></span></label><br>
								<input type='text'id='tt'name='tt'class="ip j-input j-color4 j-round j-border-2 j-border-color5"
								value=''placeholder='Title' maxlength='50'style="width:100%;max-width:400px;"/><br>
								
								<label><b>Feedback: </b><span class='mg j-text-color1'id='fbe'></span></label><br>
								<textarea name='fb'class='j-input j-medium j-color4 j-round j-border-2 j-border-color5'maxlength='250'placeholder='Feedback'
									style="width:100%;max-width:400px;"rows='5'></textarea><br>
								
								<input type='hidden'name='cid'value='<?=addnum($id)?>'/>
								
								<button type='submit'id='sbtn'class="j-btn j-medium j-color1 j-round j-bolder"style="width:100%;max-width:400px;">Submit Review</button>
							</form>
						</div>
						<br>
					<?php
				}
				?>				
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