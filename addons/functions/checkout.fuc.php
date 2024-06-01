<?php
//CHECKOUT FUNCTION STARTS
function checkout_page($page='delivery'){
 if($page === 'payment'){$bottom = "57px";}else{$bottom = "65px";}
 $check = "<i style='padding:3px 3px;'class='j-small ".icon('check')."'></i>";
 ?>
 <div style='position:relative;'>
  <?php // the line?>
   <div class='<?=$page==='summary'?'j-color1':'j-color5'?>'style='height:4px;width:42%;position:absolute;left:68px;bottom:<?=$bottom?>;'></div>
   <div class='j-color5'style='height:4px;width:39.5%;position:absolute;right:70px;bottom:<?=$bottom?>;'></div>
  <?php // the number?>
  <div class='j-padding-small'style='position:relative;margin-bottom:35px;'>
   <div class='<?=$page==='payment' || $page==='summary'?'j-color1':'j-color5'?> j-btn j-circle'style='position:absolute;left:30px;z-index:0;'>
    <?=$page==='payment' || $page==='summary'?$check:"<span class='j-bolder'style='padding:5px 5px;'>1</span>"?>
   </div>
   <div class='<?=$page==='summary'?'j-color1':'j-color5'?> j-btn j-circle'style='position:absolute;right:47.5%;z-index:0;'>
    <?=$page==='summary'?$check:"<span class='j-bolder'style='padding:5px 5px;'>2</span>"?>
   </div>
   <div class='j-color5 j-btn j-circle'style='position:absolute;right:35px;z-index:0;'>
    <span class='j-bolder'style='padding:5px 5px;'>3</span>
   </div>
  </div>
  <?php // the text?>
  <div class='j-padding j-center'>
   <div class='j-bolder j-left <?=$page==='delivery'?'j-padding-small j-color1 j-round':'j-text-color5'?>'style='display:inline;'>Delivery</div>
   <div class='j-bolder <?=$page==='payment'?'j-padding-small j-color1 j-round':'j-text-color5'?>'style='display:inline;'>Payment</div>
   <div class='j-bolder j-right <?=$page==='summary'?'j-padding-small j-color1 j-round':'j-text-color5'?>'style='display:inline'>Summary</div>
   <span class='j-clearfix'></span>
  </div>
 </div>
 <?php
}
//CHECKOUT FUNCTION ENDS
?>