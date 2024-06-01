<?php
if($product_image === 'customer_preview'){
	$or = multiple_content_data('food_media_table','fm_id',$id,'f_id');
	if($or === false){$total = false;}else{$total = count($or);}
	if($total < 2 || $total === false){
		$fm_id = content_data('food_media_table','fm_id',$id,'f_id');
		?>
		<div style='width:100%;height:250px;'class='j-display-container'>
			<img class='s'src="<?=file_location('media_url',get_media('food',$fm_id))?>"style='width:100%;height:250px;'/>
			<?=get_discount(content_data('food_table','f_original_price',$id,'f_id'),content_data('food_table','f_discounted_price',$id,'f_id'))?>
			<div class='j-btn j-text-color4 j-display-bottomleft j-bolder j-small'style='background-color:rgba(0,0,0,0.5);'><?='1/'.$total?></div>
			<span class='dot j-hide'></span>
		</div>
		<?php
	}else{
		?>
		<div style='width:100%;'class='j-product-image-hieght'id='img_bx'>
			<div class='j-display-container'>
				<?=get_discount(content_data('food_table','f_original_price',$id,'f_id'),content_data('food_table','f_discounted_price',$id,'f_id'))?>
				<?php
				foreach($or AS $fm_id){
					?>
					<img class='s'src="<?=file_location('media_url',get_media('food',$fm_id))?>"style='width:100%;height:250px;display:none;'/>
					<div class='cnt j-btn j-text-color4 j-display-bottomleft j-bolder j-small'style='background-color:rgba(0,0,0,0.5);'>0 / 0</div>
					<?php
				}
				?>
				<div class='j-hide-large j-hide-xlarge'>
					<span class="j-display-left j-btn j-text-color4 j-bolder"id='prv'onclick="pD(-1)"style='background-color:rgba(0,0,0,0.5);'>&#10094;</span>
					<span class="j-display-right j-btn j-text-color4 j-bolder"id='nxt'onclick="pD(1)"style='background-color:rgba(0,0,0,0.5);'>&#10095</span>
				</div>
			</div>
			<div style='margin-top:5px;'class='j-hide-small j-hide-medium'>
			<?php
			foreach($or AS $fm_id){
				?>
				<div class='j-vertical-scroll'style='display:inline;margin-right:5px;'>
					<img class='dot'src="<?=file_location('media_url',get_media('food',$fm_id))?>"style='width:50px;height:50px;'onclick='cS(<?php s_n()?>)'/>
				</div>
				<?php
			}
			?>
			</div>
		</div>
		<?php
	}
}elseif($product_image === 'seller_update'){
	?>
	<div class='j-padding j-row'>
		<?php
		$or = multiple_content_data('food_media_table','fm_id',$id,'f_id');
		if($or !== false){
			$total = count($or);
			foreach($or AS $fm_id){
				?>
				<span id='preview'class='j-col j-border-color5 j-border j-circle j-color5 j-vertical-center-container j-clickable'style='width:100px;height:100px;display:inline-block;'
					onclick="$('#food<?=$fm_id?>_pics_modal').fadeIn('slow');">
					<img src='<?=file_location('media_url',get_media('food',$fm_id))?>'alt=''class='j-round j-card-4'style='width:100px;height:100px;border:solid 2px white'>
					<span class='j-text-color4 j-bold j-vertical-center-element'style='font-size:40px;'>+</span>
				</span>
				<?php
				image_modal('food',$fm_id,$id);
			}
		}else{
			$total = 0;
		}
		//for other empty image if image is not up to 4
		if($total < 4){
			$remain = (4-$total);
			for($i = 0;$i < $remain;$i++){
				$fm_id = -15000000000+$i;
				?>
				<div id='preview'class='j-col j-border-color5 j-border j-circle j-color5 j-vertical-center-container j-clickable'style='width:100px;height:100px;display:inline-block;'
					onclick="$('#food<?=$fm_id?>_pics_modal').fadeIn('slow');">
					<img src='<?=file_location('media_url',get_media('food',$fm_id))?>'alt=''class='j-round j-card-4'style='width:100px;height:100px;border:solid 2px white'>
					<span class='j-text-color4 j-bold j-vertical-center-element'style='font-size:40px;'>+</span>
				</div>
				<?php
				image_modal('food',$fm_id,$id);
			}
		}
		?>
	</div>
	<?php
}elseif($product_image === 'back_preview'){
	?>
	<div>
		<?php
		$or = multiple_content_data('food_media_table','fm_id',$id,'f_id');
		if($or !== false){
			foreach($or AS $fm_id){
				?><img class='j-border-color7 j-border-2 j-round'src="<?=file_location('media_url',get_media('food',$fm_id))?>"style='width:100px;height:100px;margin-right:9px;'/><?php
			}
		}else{
			?><img src="<?=file_location('media_url',get_media('food',0))?>"style='width:100px;height:100px;margin-right:9px;'/><?php
		}
		?>
	</div>
	<?php
}
?>