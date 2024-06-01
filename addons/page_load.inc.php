<div  id="load_modal"class="j-modal-load"style='display:none'>
	<div class="j-modal-content j-display-container j-color4"style="width:100%;max-width:100%;height:100%;background-color:rgba(0,0,0,0.7);">
		<?php //navigation starts?>
		<?php if(!strstr($_SERVER['PHP_SELF'],'admin')){
			// SMALL SCREEN
			?>
			<?php //code for large screen ?>
			<div class="j-bar j-color4 j-text-color1 j-fixed-top j-card j-home-padding"style="margin:0px;font-size:12px;z-index:1;height:50px;width:100%;overflow-y:hidden">
				<a class="j-bar-item"style='padding:0px;'>
					<img src="<?=file_location('media_url','home/logo.png')?>"class=''alt="<?=strtoupper(get_xml_data('company_name'))?> LOGO IMAGE"style="width:150px;height:50px;">
				</a>
				<span class="j-bar-item j-padding-16 j-hide-large j-hide-xlarge j-hide-medium j-right">
					<i class="j-large <?=icon('search')?>"></i>
				</span>
				<?php // search for large and medium?>
				<div class="j-search-div j-bar-item j-hide-small"style='padding:7px 0px 5px 12px;position:relative;display:inline-block;'>
					<input type="search"class="j-input j-small j-border-2 j-border-color5 j-round j-search-width"placeholder="Search <?=ucwords(get_xml_data('company_name'))?>"
						style="display:inline;"/>
					<span class="j-large j-clickable j-padding j-round j-color1"style="padding:0px 0px;position:relative;top:2px;left:0px;"><i class="<?= icon('search');?>"></i></span>
				</div>
				<?php // for large?>
				<div class="j-right j-text-color3 j-large j-hide-small j-hide-medium"style='paddin:7px 5px 5px 0px;'>
					<a class="j-bar-item j-button j-padding-16 j-display-container">
						<i class="<?=icon('envelope');?>"style='margin-right:5px;'></i><b>Inbox</b>
					</a>
					<a class="j-bar-item j-button j-padding-16">
						<i class="<?=icon('list-ul');?>"style='margin-right:5px;'></i><b>Category</b>
					</a>
					<a class="j-bar-item j-button j-padding-16 j-display-container">
						<i class="<?=icon('shopping-cart');?>"style='margin-right:5px;'></i><b>Cart</b>
					</a>
					<span class="j-bar-item j-button j-padding-16">
						<i class="<?=icon('user');?>"></i><b>Account</b>
					</span>
				</div>
				<?php // for medium?>
				<div class="j-right j-text-color3 j-large j-hide-small j-hide-large j-hide-xlarge"style='padding:7px 5px 5px 0px;'>
					<a class="j-bar-item j-button j-display-container"><i class="j-xlarge <?=icon('envelope');?>"></i></a>
					<a class="j-bar-item j-button"><i class="j-xlarge <?=icon('list-ul');?>"></i></a>
					<a class="j-bar-item j-button j-display-container"><i class="j-xlarge <?=icon('shopping-cart');?>"></i></a>
					<span class="j-bar-item j-button dropdown-btn"><i class="<?=icon('user');?> j-xlarge"></i></span>
				</div>
			</div>
			<div class="j-hide-large j-hide-xlarge j-hide-medium j-card-4 j-color4 j-fixed-nav" style="margin:0px; font-size:12px;z-index:1">
				<div class="j-row-padding j-center" style="padding: 10px 0px">
					<div class="j-col s2">
						<a ><span class="j-small j-text-color7"><i class="j-large <?=icon('home');?>"style='display:block'></i>Home</span></a>
					</div>
					<div class="j-col s2">
						<a class='j-display-container'><span class="j-small j-text-color7"><i class="j-large <?=icon('envelope');?>"style='display:block'></i>Inbox</span></a>
					</div>
					<div class="j-col s3">
						<a ><span class="j-small j-text-color7"><i class="j-large <?=icon('list-ul');?>"style='display:block'></i>Category</span></a>
					</div>
					<div class="j-col s2">
						<a class='j-display-container'><span class="j-small j-text-color7"><i class="j-large <?=icon('shopping-cart');?>"style='display:block'></i>Cart</span>
						</a>
					</div>
					<div class="j-col s3 dropdown-btn">
							<span class="j-small j-text-color7"><i class="j-large <?=icon('user');?>"style='display:block'></i>Account</span>
					</div>
				</div>
			</div>
		<?php }?>
		<?php //loader icon and company name?>
		<div class="j-display-middle">
			<div class='j-text-color1 j-hide-small'>
				<span class='j-spinner-border j-spinner-border j-large'style='margin-right:5px;position:relative;top:3px;'></span>
				<span class='j-xlarge'><?=ucwords(get_xml_data('company_name'))?>...</span>
			</div>
			<div class='j-text-color1 j-hide-medium j-hide-large j-hide-xlarge'>
				<span class='j-spinner-border-sm j-spinner-border j-medium'style='margin-right:2px;'></span>
				<span class='j-small'><?=ucwords(get_xml_data('company_name'))?>...</span>
				</div>
		</div>
	</div>
</div>
<script>$('#load_modal').show();</script>