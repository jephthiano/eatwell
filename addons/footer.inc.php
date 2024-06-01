<div id="footer"title='footer'class="j-color3 j-text-color4 j-home-padding"style="padding-bottom:8px;padding-top:8px">
	<div class='j-center'><h4 style="font-size:20px"><?=ucwords(get_xml_data('company_name'))?></h4></div>
	<div>
		<div class='j-row j-text-color4'>
			<div class='j-col m3 j-padding'>
				<div class='j-bolder'>STAY CONNECTED</div>
				<div class=""><?php get_all_social_handle('j-color4','j-text-color7')?></div>
			</div>
			<div class='j-col m2 j-padding'>
				<div class='j-bolder'>SUPPROT</div>
				<div class='j-text-color6'>
					<a href="<?=file_location('home_url','misc/about_us/');?>"class="j-round-large"title="ABOUT">About us</a><br>
					<a href="<?=file_location('home_url','misc/contact_us/');?>"class="j-round-large"title="CONTACT US">Contact us</a><br>
					<a href="<?=file_location('home_url','misc/faq/');?>"class="j-round-large"title="FAQ">FAQ</a><br>
					</div>
			</div>
			<div class='j-col m2 j-padding'>
				<div class='j-bolder'>LEGAL</div>
				<div class='j-text-color6'>
					<a href="<?=file_location('home_url','misc/terms_of_service/');?>"class="j-round-large"title="TERMS OF SERVICES">Terms of Service</a><br>
					<a href="<?=file_location('home_url','misc/privacy_policy/');?>"class="j-round-large"title="PRIVACY POLICY">Privacy Policy</a><br>
				</div>
			</div>
			<div class='j-col m2 j-padding'>
				<div class='j-bolder'>PAYMENT METHOD</div>
				<div class='j-text-color5'>
					<div>Paystack</div>
					<div>Stripes</div>
					<div>Cash</div>
				</div>
			</div>
			<div class='j-col m3 j-padding'>
				<div class='j-bolder'>DELIVERY PARTNERS</div>
				<div class='j-text-color6'>
					<div>DHL</div>
					<div>EMS</div>
				</div>
			</div>
		</div>
	</div>
    <p class="j-tiny j-center"style="margin:0px;padding:5px;font-family:Open Sans">Copyright &copy <?= date("Y")?> <?=ucwords(get_xml_data('company_name'))?>. All rights reserved.</p>
	<center><a class='j-text-color4 j-underline'target="_blank"href="https://jephthiano.000webhostapp.com">Designed and Developed by Oladejo Jephthah</a></center>
</div>
<?php
if(isset($nav)){
	?><br class='j-hide-large j-hide-xlarge j-hide-medium'><br class='j-hide-large j-hide-xlarge j-hide-medium'><br class='j-hide-large j-hide-xlarge j-hide-medium'><?php
}
?>