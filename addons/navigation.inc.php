<div style='margin-bottom:50px;z-index:2;'>
	<?php	
	if(isset($navigation) && $navigation === 'payment'){
		?>
		<div id="nav"class="j-bar j-color4 j-text-color1 j-fixed-top j-home-padding"style="margin:0px;font-size:12px;z-index:1;height:50px;overflow:hidden;">
			<a href="<?= file_location('home_url','');?>"class="j-bar-item"style='padding:0px;'>
			<img src="<?=file_location('media_url','home/logo.png')?>"class=''alt="<?=strtoupper(get_xml_data('company_name'))?> LOGO IMAGE"style="width:150px;height:50px;">
			</a>
			<div class='j-right'>
				<div class='j-row-padding' style='display:inline-block'>
					<div class='j-col s4'><i class='j-xxlarge <?=icon('shield-alt')?>' style='padding-top:12px;'></i></div>
					<div class='j-tiny j-col s8 j-text-color3'style='position:relative;top:12px;left:-5px;'> <b>SECURE<br> CHECKOUT</b></div>
				</div>
				<div class='j-row-padding j-hide-small' style='display:inline-block'>
					<div class='j-col s4'><i class='j-xxlarge <?=icon('lock')?>' style='padding-top:12px;'></i></div>
					<div class='j-tiny j-col s8 j-text-color3'style='position:relative;top:12px;left:-5px;'> <b>EASY<br> PROCESS</b></div>
				</div>
			</div>
		</div>
		<?php
	}else{
		//code for large screen
		?>
		<div id="nav"class="j-bar j-color4 j-text-color1 j-fixed-top j-card j-home-padding"style="margin:0px;font-size:12px;z-index:1;height:50px;width:100%;overflow-y:hidden">
			<a href="<?= file_location('home_url','');?>"class="j-bar-item"style='padding:0px;'>
				<img src="<?=file_location('media_url','home/logo.png')?>"class=''alt="<?=strtoupper(get_xml_data('company_name'))?> LOGO IMAGE"style="width:150px;height:50px;">
			</a>
			<span id='srht'class="j-bar-item j-padding-16 j-hide-large j-hide-xlarge j-hide-medium j-right"onclick="n('nav',$('#nav'),$('#sp'))">
				<i class="j-large <?=icon('search')?>"></i>
			</span>
			<?php // search for large and medium?>
			<div class="j-search-div j-bar-item j-hide-small"style='padding:7px 0px 5px 12px;position:relative;display:inline-block;'>
				<input type="search"name="txtsearch"id="txtsearch"class="searchinput j-input j-small j-border-2 j-border-color5 j-round j-search-width"
					value='<?=$_SERVER['PHP_SELF'] === '/search.enc.php'?$searchtext:"";?>'placeholder="Search <?=ucwords(get_xml_data('company_name'))?>"
					style="display:inline;"onsearch="sb($('#txtsearch').val());"/>
				<span class="j-large j-clickable j-padding j-round j-color1"id="search"style="padding:0px 0px;position:relative;top:2px;left:0px;"
					onclick="sb($('#txtsearch').val());"><i class="<?= icon('search');?>"></i></span>
			</div>
			<?php // for large?>
			<div class="j-right j-text-color3 j-large j-hide-small j-hide-medium"style='paddin:7px 5px 5px 0px;'>
				<a href="<?= file_location('home_url','inbox/');?>"class="j-bar-item j-button j-padding-16 j-display-container">
					<i class="<?=icon('envelope');?>"style='margin-right:5px;'></i><b>Inbox</b>
					<?php
					if(isset($_SESSION['user_id'])){
						?><span class='ntf j-circle j-color1 j-small'style='width:20px;height:20px;position:absolute;top:5px;right:0px;'>0</span><?php
					}
					?>
				</a>
				<a href="<?= file_location('home_url','category/');?>"class="j-bar-item j-button j-padding-16">
					<i class="<?=icon('list-ul');?>"style='margin-right:5px;'></i><b>Category</b>
				</a>
				<a href="<?= file_location('home_url','cart/');?>"class="j-bar-item j-button j-padding-16 j-display-container">
					<i class="<?=icon('shopping-cart');?>"style='margin-right:5px;'></i><b>Cart</b>
					<span class='crt j-circle j-color1 j-small'style='width:20px;height:20px;position:absolute;top:5px;right:0px;'>0</span>
				</a>
				<span class="dropdown-btn j-bar-item j-button j-padding-16">
					<?php if(isset($u_id)){
						?><i class="<?=icon('user-check');?>"></i><?php
					}else{
						?><i class="<?=icon('user');?>"></i><?php
					}?>
					<b>Account</b>
				</span>
			</div>
			<?php // for medium?>
			<div class="j-right j-text-color3 j-large j-hide-small j-hide-large j-hide-xlarge"style='padding:7px 5px 5px 0px;'>
				<a href="<?= file_location('home_url','inbox/');?>"class="j-bar-item j-button j-display-container">
					<i class="j-xlarge <?=icon('envelope');?>"></i>
					<?php
					if(isset($_SESSION['user_id'])){
						?>
						<span class='ntf j-circle j-color1 j-small'style='width:20px;height:20px;position:absolute;top:5px;right:0px;'>0</span>
						<?php
					}
					?>
				</a>
				<a href="<?= file_location('home_url','category/');?>"class="j-bar-item j-button"><i class="j-xlarge <?=icon('list-ul');?>"></i></a>
				<a href="<?= file_location('home_url','cart/');?>"class="j-bar-item j-button j-display-container">
					<i class="j-xlarge <?=icon('shopping-cart');?>"></i>
					<span class='crt j-circle j-color1 j-small'style='width:20px;height:20px;position:absolute;top:5px;right:0px;'>0</span>
				</a>
				<span class="j-bar-item j-button dropdown-btn">
					<?php if(isset($u_id)){
						?><i class="j-large <?=icon('user-check');?>"></i><?php
					}else{
						?><i class="<?=icon('user');?> j-xlarge"></i><?php
					}?>
				</span>
			</div>
		</div>
		<?php // SMALL SCREEN ?>
		<?php // search for small ?>
		<div id='sp'class="j-card-4 j-color4 j-fixed-top j-hide-medium j-hide-large j-hide-xlarge"style="margin:0px;font-size:12px;z-index:1;height:50px;width:100%;display:none;">
			<input type="search"name="txtsearch2"id="txtsearch2"class="searchinput j-input j-small j-round j-border-0 j-color4 j-text-color3"
				onsearch="sb($('#txtsearch2').val());"onkeyup="sc($('#txtsearch2'),$('#search2'));"placeholder="Search <?=ucwords(get_xml_data('company_name'))?>"style="width:84%;height:inherit;display:inline;"/>
			<span id="search2"class="j-right"style="position:relative;top:3px;left:-15px;width:10%;height:inherit;padding-right:5px;">
				<span class='j-xlarge' onclick="n('sea',$('#nav'),$('#sp'))">&times</span>
			</span>
		</div>
		<?php // navigation?>
		<div class="j-hide-large j-hide-xlarge j-hide-medium j-card-4 j-color4 j-fixed-nav" style="margin:0px; font-size:12px;z-index:1">
			<div class="j-row-padding j-center" style="padding: 10px 0px">
				<div class="j-col s2">
					<a id='home2'href="<?= file_location('home_url','');?>" <?php if($_SERVER['PHP_SELF'] === "/index.php"){?>onclick="iauulr('home')";<?php }?>>
						<span class="j-small <?=$_SERVER['PHP_SELF'] === "/index.php"?'j-text-color1':'j-text-color7';?>"><i class="j-large <?=icon('home');?>"style='display:block'></i>Home</span>
					</a>
				</div>
				<div class="j-col s2">
					<a id=''href="<?= file_location('home_url','inbox/');?>"class='j-display-container'style='display:relative;'>
						<span class="j-small <?=$_SERVER['PHP_SELF'] === "/inbox/index.php"?'j-text-color1':'j-text-color7';?>">
							<i class="j-large <?=icon('envelope');?>"style='display:block'></i>Inbox
							<?php
							if(isset($_SESSION['user_id'])){
								?>
								<span class='ntf j-circle <?=$_SERVER['PHP_SELF'] === "/inbox/index.php"?'j-color3':'j-color1';?> j-small'style='width:20px;height:20px;position:absolute;top:-5px;right:-9px;'>0</span>
								<?php
							}
							?>
						</span>
					</a>
				</div>
				<div class="j-col s3">
					<a id=''href="<?= file_location('home_url','category/');?>">
						<span class="j-small <?=$_SERVER['PHP_SELF'] === "/category/index.php"?'j-text-color1':'j-text-color7';?>"><i class="j-large <?=icon('list-ul');?>"style='display:block'></i>Category</span>
					</a>
				</div>
				<div class="j-col s2"style='display:relative;'>
					<a id=''href="<?= file_location('home_url','cart/');?>"class='j-display-container'>
						<span class="j-small <?=$_SERVER['PHP_SELF'] === "/cart.enc.php"?'j-text-color1':'j-text-color7';?>">
							<i class="j-large <?=icon('shopping-cart');?>"style='display:block'></i>Cart
							<span class='crt j-circle <?=$_SERVER['PHP_SELF'] === "/cart.enc.php"?'j-color3':'j-color1';?> j-small'style='width:20px;height:20px;position:absolute;top:-5px;right:-9px;'>0</span>
						</span>
					</a>
				</div>
				<div class="j-col s3 dropdown-btn">
					<span class=''>
						<span class="j-small <?=$_SERVER['PHP_SELF'] === "/account/index.php"?'j-text-color1':'j-text-color7';?>">
							<?php if(isset($u_id)){
								?><i class="j-large <?=icon('user-check');?>"style='display:block'></i><?php
							}else{
								?><i class="j-large <?=icon('user');?>"style='display:block'></i><?php
							}?>
							Account
						</span>
					</span>
				</div>
			</div>
			<?php user_modal('account');?>
		</div>
		<?php
		$nav = 'nav';
	}
	user_modal('user_log_out');
	user_modal('login_signup',$page_url);
	?>
	<div class='j-hide-small'>
		<?php user_modal('account');?>
	</div>
</div>