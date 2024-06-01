<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','/product/insert_product/');
$page = "INSERT PRODUCT";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
if($adlevel < 2){trigger_error_manual(404);}
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
			<h2 class='j-text-color1 j-padding j-color4'><b>INSERT NEW PRODUCT</b></h2>
		</div>
		<div class='j-padding'>
			<a href="<?=file_location('admin_url','product/available/')?>" class="j-btn j-color1 j-right j-round j-card-4 j-bolder">Show Available Product</a>
			<br class='j-clearfix'>
		</div>
		<div id=""class='j-color4'style='padding-top: 9px;'>
			<div id='preview'class='j-border-color7 j-border-2 j-round j-color5 j-vertical-center-container j-clickable j-margin'style='width:100px;height:100px;'
				 onclick='ti($("#image"))'>
				<span class='j-text-color4 j-bold j-vertical-center-element'style='font-size:40px;'>+</span>
			</div>
			<div id='multi_preview'class='j-margin'></div>
			<form onsubmit="event.preventDefault();"id='insfd'enctype="multipart/form-data">
				<input type="file"name="image[]"id="image" multiple class="j-round j-hide"onchange="pi(this,document.getElementById('multi_preview'),'multi');">
				<div class='j-row'>
					<div class='j-col m6 j-padding'>
						<label class="j-large j-text-color7"><b>Name:</b> <span class='j-text-color1 mg'id="nme">*</span></label>
						<input type="text"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Name" maxlength='255'
							name="nm"id="nm"value=""style="width:100%;"/>
					</div>
					<div class='j-col m6 j-padding'>
						<label class="j-large j-text-color7"><b>Brand:</b> <span class='j-text-color1 mg'id="bde">*</span></label>
						<input type="text"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Brand" maxlength='255'
							name="bd"id="bd"value=""style="width:100%;"/>
					</div>
				</div>
				<div class='j-row'>
					<div class='j-col m6 j-padding'>
						<label class="j-large j-text-color7"><b>Category:</b> <span class='j-text-color1 mg'id="cte">*</span></label>
						<select name='ct'class='j-select j-color4 j-round j-border-2 j-border-color5'style="width:100%;">
							<option value=''>Select category</option><?php get_category()?><option value='others'>Others</option>
							</select>
					</div>
					<div class='j-col m6 j-padding'>
						<label class="j-large j-text-color7"><b>Weight:</b> <span class='j-text-color1 mg'id="wte">*</span></label>
						<input type="number"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Weight"maxlength='10'
							name="wt"id="wt"value=""style="width:100%;"/>
						<span class='j-small j-text-color5'>(Weight in gram)</span>
					</div>
				</div>
				<div class='j-row'>
					<div class='j-col m6 j-padding'>
						<label class="j-large j-text-color7"><b>Max Order:</b> <span class='j-text-color1 mg'id="moe">*</span></label>
						<input type="number"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Max Order"maxlength='5'
							name="mo"id="mo"value=""style="width:100%;"/>
						<span class='j-small j-text-color5'>(Maximum quantity that can be order at a time)</span>
					</div>
					<div class='j-col m6 j-padding'>
						<label class="j-large j-text-color7"><b>Original Price:</b> <span class='j-text-color1 mg'id="ope">*</span></label>
						<input type="text"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Original Price"maxlength='55'
							name="op"id="op"value=""style="width:100%;"/>
						<span class='j-small j-text-color5'>(Price without discount)</span>
					</div>
				</div>
				<div class='j-row'>
					<div class='j-col m6 j-padding'>
						<label class="j-large j-text-color7"><b>Discounted Price:</b> <span class='j-text-color1 mg'id="dpe">*</span></label>
						<input type="text"class="j-input j-medium j-border-2 j-border-color5 j-round"placeholder="Original Price"maxlength='55'
							name="dp"id="dp"value=""style="width:100%;"/>
						<span class='j-small j-text-color5'>(Price after discount has been removed)</span>
					</div>
				</div>
				<div class='j-row'>
					<div class='j-col m6 j-padding'>
						<label class="j-large j-text-color7"><b>Color & Quantity: </b> <span class='j-text-color1 mg'id='cle'>*</span></label>
						<textarea placeholder="Color and Quantity"id='cl'name="cl"style="width:100%;"rows="4"class="j-input j-medium j-border-2 j-border-color5 j-color4 j-round-large"maxlength='255'></textarea>
						<span class='j-small j-text-color5'>
							(color and quantity available per color, they should be input in format similar to this <i><b>"red":"3","green":2</b></i>. The color or quantity should be in double quote <b>""</b>,
							also the color & quantity should be seperated with <b>:</b> while both color and quantity are seperated with comma <b>,</b>. please note that the last color & quantity will not be seperated by comma)
						</span>
					</div>
					<div class='j-col m6 j-padding'>
						<label class="j-large j-text-color7"><b>Content in the Package: </b> <span class='j-text-color1 mg'id='cpe'>*</span></label>
						<textarea placeholder="Cotent in the Package"id='cp'name="cp"style="width:100%;"rows="4"class="j-input j-medium j-border-2 j-border-color5 j-color4 j-round-large"maxlength='255'></textarea>
					</div>
				</div>
				<div class='j-row'>
					<div class='j-col m6 j-padding'>
						<label class="j-large j-text-color7"><b>Full Detail: </b> <span class='j-text-color1 mg'id='dte'>*</span></label>
						<textarea placeholder="Full Detail"id='dt'name="dt"style="width:100%;"rows="4"class="j-input j-medium j-border-2 j-border-color5 j-color4 j-round-large"></textarea>
					</div>
				</div>
				<div class='j-margin'>
					<button type='submit'id='sbtn'class="j-btn j-medium j-color1 j-round j-bolder">Insert Product</button>
				</div>
			</form>
			<span id="st"></span>
			<br><br>
		</div>
	</div>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>