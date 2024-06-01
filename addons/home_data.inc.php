<?//3tiers?>
<div class='j-home-padding'style='margin:15px 0px;'>
	<div class='j-row j-center'>
		<center>
			<div class='j-col s4 m3 j-padding-small'>
				<div class='j-color4 j-padding-small j-card j-round'style='height:80px;overflow-x: hidden;'>
					<div class='j-center j-text-color5 j-xlarge'><i class='<?=icon('truck')?>'></i></div>
					<div class='j-small'>Home Delivery</div>
				</div>
			</div>
			<div class='j-col s4 m3 j-padding-small'>
				<div class='j-color4 j-padding-small j-card j-round'style='height:80px;overflow-x: hidden;'>
					<div class='j-center j-text-color5 j-xlarge'><i class='<?=icon('shield-alt')?>'></i></div>
					<div class='j-small'>100% Secure Payment</div>
				</div>
			</div>
			<div class='j-col s4 m3 j-padding-small'>
				<div class='j-color4 j-padding-small j-card j-round'style='height:80px;overflow-x: hidden;'>
					<div class='j-center j-text-color5 j-xlarge'><i class='<?=icon('handshake')?>'></i></div>
					<div class='j-small'>24/7 Support</div>
				</div>
			</div>
			<div class='j-col s4 m3 j-padding-small j-hide-small'>
				<div class='j-color4 j-padding-small j-card j-round'style='height:80px;overflow-x: hidden;'>
					<div class='j-center j-text-color5 j-xlarge'><i class='<?=icon('credit-card')?>'></i></div>
					<div class='j-small'>Easy Checkout</div>
				</div>
			</div>
		</center>
	</div>
</div>
<? //for home food ?>
<div class='j-home-padding'style='margin-bottom:0px;'>
	<div class='j-color4'>
		<div class='j-vertical-scroll'id=''title='<?=ucfirst(get_xml_data('company_name'))?> Foods'style='margin:15px 0px;padding:5px 5px;'>
		<div class=""style="padding:10px 0px;">
			<?php get_category($type,'home_horn_click');?>
			<?php//for others ?>
			<a href='<?=file_location('home_url','others/')?>'>
			<span class="j-padding j-clickable j-btn j-round-large"
				  style="background-color:<?=$type === 'others'?get_json_data('primary_color','color'):''?>;color:<?='others' === $type?'white':''?>">
				  <b>Others</b>
			</span>
			</a>
		</div>
		<hr>
		</div>
		<div class=''>
			<? //for categories foods?>
			<?php
			$or = multiple_content_data('food_table','f_id',$type,'f_category',"AND f_status = 'available' ORDER BY f_id DESC LIMIT 0,6");
			$total = get_numrow('food_table','f_status','available',"return",'no round',"AND f_category = '{$type}'");
			if($or !== false){
				?><div class='j-row'><?php
				if($total > 8){?><a href="<?=file_location('home_url',"category/food/{$type}/")?>"class='j-right j-text-color1 j-padding'><span class=''><b>SEE ALL &#10095</b></span></a><span class='j-clearfix'></span><?php }
				foreach($or AS $id){show_food($id,'default');}
				?></div><br><?php
			}else{
				?><center><br><br><div class='j-text-color3'><b>No <?=$type?> available</b></div></center><br><br><?php
			}
			?>
        </div>
	</div>
</div>

<? //for flash sale?>
<div id='flash_sales'><center><br><br><span class='j-text-color1 j-spinner-border j-spinner-border j-large'></span> <br><br></center></div>
	