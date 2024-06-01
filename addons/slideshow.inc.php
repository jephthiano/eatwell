<div class='j-row-padding j-home-padding'style='padding-top: 4px;'>
	<div class='j-col l2 xl2 j-hide-medium j-hide-small j-small'>
		<div class='j-card-2 j-round j-color4 j-text-color7 j-slideshow-height j-padding'style='margin-top:8px;line-height:35px;overflow-y:hidden;'>
			<a href='<?=file_location('home_url','category/')?>'>
			<div class='j-row'>
				<div class='j-col s2'><i class="<?=icon('list-ul')?>"style='padding-right:8px;'></i></div>
				<div class='j-col s10'><b>All Categories</b></div>
			</div>
			</a>
			<?php get_category('','slideshow')?>
			<a href='<?=file_location('home_url','category/food/others/')?>'>
			<div class='j-row'>
				<div class='j-col s2'><i class="<?=icon('receipt')?>"style='padding-right:8px;'></i></div>
				<div class='j-col s10'><b>Others</b></div>
			</div>
			</a>
		</div>
	</div>
	<div class='j-col l7 xl7'>
		<div id='slideshow'title='slideshow'class=""style='padding-top:8px;justify-content:j-padding-bottom:8px;'>
			<div class='j-display-container'>
				<img class='s j-round j-slideshow-height'src='<?=file_location("media_url","slideshow/image_1.jpg")?>'alt='Food Image1'style='width:100%;'/>
				<?php for($i = 2; $i <= 6; $i++){ ?>
				<img class='s j-round j-slideshow-height'src='<?=file_location("media_url","slideshow/image_{$i}.jpg")?>'alt='Food Image<?=$i?>'style='width:100%;display:none;'/>
				<?php } ?>
				<span class="j-display-left j-btn j-text-color4 j-xlarge j-bolder"id='prev'onclick="pD(-1)"style='background-color:rgba(0,0,0,0.5);'>&#10094;</span>
				<span class="j-display-right j-btn j-text-color4 j-xlarge j-bolder"id='next'onclick="pD(1)"style='background-color:rgba(0,0,0,0.5);'>&#10095</span>
			</div>
		</div>
	</div>
	<div class='j-col l3 xl3 j-hide-small j-hide-medium'style='margin-top:4px;'>
		<div class='j-center'>
			<div class=''>
				<div class='j-color5 j-padding-small j-card j-round j-display-container'style='height:180px;overflow-x: hidden;'>
					<div class='j-text-color4 j-large j-display-middle'>Home delivery and pickup available</div>
				</div>
			</div>
			<div class=''style='margin-top:10px;'>
				<div class='j-color1 j-padding-small j-card j-round j-display-container'style='height:180px;overflow-x: hidden;'>
					<div class='j-text-color4 j-large j-display-middle'>Yummy and Tasty meals from our top notch restaurant</div>
				</div>
			</div>
		</div>
	</div>
</div>