<div id="nav"class="j-bar j-animate-left j-color4 j-admin-nav-width"style="z-index:1;position:fixed;top:0;right:0px;">
	<?php //code for large screen ?>
	<a href="<?= file_location('admin_url','');?>"class="j-bar-item j-hide-large j-hide-xlarge"style='padding:0px;'>
		<img src="<?=file_location('media_url','home/admin_logo.png')?>"class=''alt="<?=get_xml_data('company_name')?> LOGO IMAGE"style="width:170px;height:60px;">
	</a>
	<a  id="mo" href="javascript:void(0)" class="j-bar-item j-button j-right j-xlarge j-hide-large j-hide-xlarge j-hide-medium"onclick="ad()">&#9776;</a>
	<div class="j-right j-text-color1 j-large j-hide-small">
		<span  class="j-bar-item j-button j-padding-16"onclick="$('#log_out_modal').fadeIn('slow');"><i class="j-xlarge <?=icon('power-off')?>"></i></span>
		<a href="<?= file_location('admin_url','admin/profile/');?>"style="display:inline">
			<img class='j-circle j-bar-item j-button j-right j-padding-16'src='<?=file_location('media_url',get_media('admin',$adid))?>'style="height: 60px; width: 60px">
		</a>
	</div>
	<?// code for small screen ?>
	<div class="j-hide-large j-hide-xlarge j-hide-medium"style='margin-top:60px;'>
	<div id="a" class="j-bar-block j-sidebar j-collapse j-animate-top j-bolder j-text-color4 j-clickable"
	     style="max-height:100px;right:0;background-color:rgba(0,0,0,0.5);display:none">
		<a href="<?= file_location('admin_url','admin/profile/');?>" class="j-bar-item j-button j-padding-16">Profile</a>
		<span class="j-bar-item j-button j-padding-16"onclick="$('#log_out_modal').fadeIn('slow');">Logout</span>
	</div>
	</div>
</div>
<br><br><br>
<?php admin_modal('admin_log_out');?>