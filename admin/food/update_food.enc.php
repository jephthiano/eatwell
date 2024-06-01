<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','food/update_food/'.$_GET['page']);
$page = "UPDATE FOOD";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
if($adlevel < 2){trigger_error_manual(404);}
if(isset($_GET['page']) AND is_numeric($_GET['page'])){ //getting the value of the get 
	$cid = test_input(removenum($_GET['page']));
	if(!empty($cid)){	
		$id = content_data('food_table','f_id',$cid,'f_id');
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
		<div class='j-padding'>
			<h2 class='j-text-color1 j-padding j-color4'><b>UPDATE FOOD</b></h2>
		</div>
		<div class='j-padding'>
			<a href="<?=file_location('admin_url','food/available/')?>" class="j-btn j-color1 j-left j-round j-card-4 j-bolder">Show Available Food</a>
			<a href="<?=file_location('admin_url','food/insert_food/')?>"class='j-btn j-color1 j-right j-round j-card-4 j-bolder'>Insert New Food</a>
			<br class='j-clearfix'>
		</div>
		<div id=""class='j-color4'style='padding-top: 9px;'>
			<?php
			if($id === false){
				page_not_available('short');
			}else{
				$product_image = 'seller_update'; require_once(file_location('inc_path','product_image.inc.php')); // product image
				?>
				<form onsubmit="event.preventDefault();"class=''id='upsfd'>
					<div class='j-row'>
						<div class='j-col m6 j-padding'>
							<label class="j-large j-text-color7"><b>Name:</b> <span class='j-text-color1 mg'id="nme">*</span></label>
							<input type="text"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Name"maxlength='255'
								name="nm"id="nm"value="<?=(content_data('food_table','f_name',$id,'f_id'))?>"style="width:100%;"/>
						</div>
						<div class='j-col m6 j-padding'>
							<label class="j-large j-text-color7"><b>Category:</b> <span class='j-text-color1 mg'id="cte">*</span></label>
							<select name='ct'class='j-select j-color4 j-round j-border-2 j-border-color5'style="width:100%;">
								<option value=''>Select category</option><?php get_category(content_data('food_table','f_category',$id,'f_id'))?>
								<option value='others' <?php if(content_data('food_table','f_category',$id,'f_id') === 'others'){echo 'selected';}?>>Others</option>
							</select>
						</div>
					</div>
					<div class='j-row'>
						<div class='j-col m6 j-padding'>
							<label class="j-large j-text-color7"><b>Max Order:</b> <span class='j-text-color1 mg'id="moe">*</span></label>
							<input type="number"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Max Order"maxlength='5'
								name="mo"id="mo"value="<?=(content_data('food_table','f_max_order',$id,'f_id'))?>"style="width:100%;"/>
							<span class='j-small j-text-color5'>(Maximum quantity that can be order at a time)</span>
						</div>
						<div class='j-col m6 j-padding'>
							<label class="j-large j-text-color7"><b>Total Available:</b> <span class='j-text-color1 mg'id="tae">*</span></label>
							<input type="number"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Total Available"maxlength='5'
								name="ta"id="ta"value="<?=(content_data('food_table','f_total_available',$id,'f_id'))?>"style="width:100%;"/>
							<span class='j-small j-text-color5'>(Total available food in store)</span>
						</div>
					</div>
					<div class='j-row'>
						<div class='j-col m6 j-padding'>
							<label class="j-large j-text-color7"><b>Original Price:</b> <span class='j-text-color1 mg'id="ope">*</span></label>
							<input type="text"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Original Price"maxlength='55'
								name="op"id="op"value="<?=(content_data('food_table','f_original_price',$id,'f_id'))?>"style="width:100%;"/>
							<span class='j-small j-text-color5'>(Price without discount)</span>
						</div>
						<div class='j-col m6 j-padding'>
							<label class="j-large j-text-color7"><b>Discounted Price:</b> <span class='j-text-color1 mg'id="dpe">*</span></label>
							<input type="text"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Original Price"maxlength='55'
								name="dp"id="dp"value="<?=(content_data('food_table','f_discounted_price',$id,'f_id'))?>"style="width:100%;"/>
							<span class='j-small j-text-color5'>(Price after discount has been removed)</span>
						</div>
					</div>
					<div class='j-row'>
						<div class='j-col m6 j-padding'>
							<label class="j-large j-text-color7"><b>Weight:</b> <span class='j-text-color1 mg'id="wte">*</span></label>
							<input type="number"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Weight"maxlength='10'
								name="wt"id="wt"value="<?=(content_data('food_table','f_weight',$id,'f_id'))?>"style="width:100%;"/>
							   <span class='j-small j-text-color5'>(Weight in gram)</span>
						</div>
					</div>
					<div class='j-row'>
						<div class='j-col m6 j-padding'>
							<label class="j-large j-text-color7"><b>Short Description: </b> <span class='j-text-color1 mg'id='sde'>*</span></label>
							<textarea placeholder="Short Description"id='sd'name="sd"style="width:100%;"rows="4"class="j-input j-medium j-border-2 j-border-color5 j-color4 j-round-large"maxlength='120'
							><?=(content_data('food_table','f_short_description',$id,'f_id'))?></textarea>
						</div>
						<div class='j-col m6 j-padding'>
							<label class="j-large j-text-color7"><b>Full Detail: </b> <span class='j-text-color1 mg'id='dte'>*</span></label>
							<textarea placeholder="Full Detail"id='dt'name="dt"style="width:100%;"rows="4"class="j-input j-medium j-border-2 j-border-color5 j-color4 j-round-large"
							><?=(content_data('food_table','f_details',$id,'f_id'))?></textarea>
						</div>
					</div>
					
					<input type='hidden'name='tid'value='<?=addnum($id)?>'/>
					
					<div class='j-margin'>
						<button type='submit'id='sbtn'class="j-btn j-medium j-color1 j-round j-bolder">Update Food</button>
					</div>
				</form>
				<?php
			}
			?>
		</div>
		<span id="st"></span>
		<br><br>
		</div>
	</div>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>