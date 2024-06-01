<?php //ORDER JS STARTS ?>
<?php if($_SERVER['PHP_SELF'] === '/index.php' || $_SERVER['PHP_SELF'] === '/cart.enc.php' || $_SERVER['PHP_SELF'] === '/category/food.enc.php' || $_SERVER['PHP_SELF'] === '/search.enc.php'
         || $_SERVER['PHP_SELF'] === '/food/index.php' || $_SERVER['PHP_SELF'] === '/order/order_details.enc.php' || $_SERVER['PHP_SELF'] === '/account/wishlist.enc.php'){ ?>
<?php //add to cart?>
function ac(i,t,p){
 <?php
if(get_json_data('cart','act') == 0 || get_json_data('all','act') == 0){
 ?> r_m2('Sorry!!!<br> Cart is not avalaible at the moment'); <?php
}else{
 ?>
 $('#crt_btn'+i).html("<center><span class='j-large j-spinner-border j-spinner-border-sm'style='position:relative;top:3px;'></span><center>");
 $.ajax({type:'GET',url:dar+'act/ac/'+i+'/'+t,cache:false,dataType:'JSON'}).fail(function(e,f,g){gacb(i,p);$('#st').html(r_m2('Error occurred while adding product to cart'));})
 .done(function(s){
  if(s.status==='success'){
   gnc('cart');gnc('noti');$('#st').html(r_m(s.message));
   if(t==='buy'){window.location=hu+'cart/';}else{<?php if($_SERVER['PHP_SELF'] === '/cart.enc.php'){?>gc();<?php }else{?>gacb(i,p);<?php }?>}
  }else{
   $('#st').html(r_m2(s.message));gacb(i,p);
  }
  });alertoff();
 <?php } ?>
}
<?php // get add cart button?>
function gacb(i,p){$.ajax({type:'GET',url:dar+'get/gacb/'+i+'/'+p,cache:false}).done(function(s){$("#crt_btn"+i).html(s);})}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/cart.enc.php'){?>
<?php // remove from cart?>
function rc(i){
loading('Removing Item','id','rmbtn'+i);
 $.ajax({type:'GET',url:dar+'act/rc/'+i,cache:false,dataType:'JSON'}).fail(function(e,f,g){$('#st').html(r_m2('Error occurred while removing product form cart'));r_b('Remove Item','id','rmbtn'+i);})
 .done(function(s){if(s.status==='success'){$('#st').html(r_m(s.message));gc();}else{$('#st').html(r_m2(s.message));r_b('Remove Item','id','rmbtn'+i);}});alertoff();
 }
 <?php // get cart?>
function gc(){$.ajax({type:'GET',url:dar+'get/gc/',cache:false}).done(function(s){$("#cartDiv").html(s);})}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/food/index.php' || $_SERVER['PHP_SELF'] === '/account/wishlist.enc.php' || $_SERVER['PHP_SELF'] === '/cart.enc.php'){?>
<?php // add and remove wishlist?>
function arw(i){
<?php if(isset($_SESSION['user_id'])){?>
$.ajax({type:'GET',url:dar+'act/arw/'+i,cache:false,dataType:'JSON'}).fail(function(e,f,g){$('#st').html(r_m2('Error occurred,try again later'));})
.done(function(s){if(s.status==='success'){$('#st').html(r_m(s.message));window.location='';}else{$('#st').html(r_m(s.message));}});alertoff();<?php }else{?>$('#login_modal').fadeIn('slow');<?php }?>}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/checkout/index.php'){?>
<?php // process checkout step1 (contact and delivery method)?>
$(document).ready(function(){
$('#chkfrm1').on('submit',function(event){event.preventDefault();$('.mg').html('');
<?php
if(get_json_data('checkout','act') == 0 || get_json_data('all','act') == 0){
 ?> r_m2('Sorry!!!<br> Checkout is not avalaible at the moment'); <?php
}else{
 ?>
 loading('PROCESSING DATA');
 $.ajax({type:'POST',url:dar+"act/pcddm/",data:$(this).serialize(),cache:false,dataType:'JSON'}).fail(function(e,f,g){$('#st').html(r_m2('Error occurred while processing order, try again later'));r_b('PROCEED TO PAYMENT METHOD');})
 .done(function(s){if(s.status === 'success'){window.location=s.message;}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){r_m2(s.message);};r_b('PROCEED TO PAYMENT METHOD');}})
 alertoff();
 <?php
}
?>
})
})
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/checkout/payment_method.enc.php'){?>
<?php // process checkout step2 (payment method)?>
$(document).ready(function(){
$('#chkfrm2').on('submit',function(event){event.preventDefault();$('.mg').html('');
<?php
if(get_json_data('checkout','act') == 0 || get_json_data('all','act') == 0){
 ?> r_m2('Sorry!!!<br> Checkout is not avalaible at the moment'); <?php
}else{
 ?>
 loading('PROCESSING DATA');
 $.ajax({type:'POST',url:dar+"act/ppm/",data:$(this).serialize(),cache:false,dataType:'JSON'}).fail(function(e,f,g){$('#st').html(r_m2('Error occurred while processing order, try again later'));r_b('PROCEED TO CONFIRM ORDER');})
 .done(function(s){if(s.status === 'success'){window.location=s.message;}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){r_m2(s.message);};r_b('PROCEED TO CONFIRM ORDER');}})
 alertoff();
 <?php
}
?>
})
})
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/checkout/summary.enc.php'){?>
<?php // process checkout step3 (summary)?>
$(document).ready(function(){
$('#chkfrm3').on('submit',function(event){event.preventDefault();$('.mg').html('');
<?php
if(get_json_data('checkout','act') == 0 || get_json_data('all','act') == 0){
 ?> r_m2('Sorry!!!<br> Checkout is not avalaible at the moment'); <?php
}else{
 ?>
 loading('PROCESSING DATA');
 $.ajax({type:'POST',url:dar+"act/pos/",data:$(this).serialize(),cache:false,dataType:'JSON'}).fail(function(e,f,g){$('#st').html(r_m2('Error occurred while processing order, try again later'));r_b('CONFIRM');})
 .done(function(s){if(s.status === 'success'){window.location=s.message;}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){r_m2(s.message);};r_b('CONFIRM');}})
 alertoff();
 <?php
}
?>
})
})
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/checkout/index.php'){?>
<?php // set delivery fee?>
sdfm('door delivery');
function sdfm(t){
 $.ajax({type:'GET',url:dar+'act/sdfm/'+t,cache:false,dataType:'JSON'})
 .fail(function(e,f,g){gtc(t,'fail');}).done(function(s){if(s.status === 'success'){gtc(t,'success');}else{gtc(t,'fail');}});alertoff();
}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/checkout/payment_method.enc.php'){?>
<?php // set payment method?>
function spm(t){$.ajax({type:'GET',url:dar+'act/spm/'+t,cache:false,dataType:'JSON'})}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/checkout/index.php' || $_SERVER['PHP_SELF'] === '/checkout/payment_method.enc.php' || $_SERVER['PHP_SELF'] === '/checkout/summary.enc.php'){?>
<?php // get total amount section?>
gtc('<?=$del_med?>');
function gtc(t,r='success'){
if(r === 'success'){
$.ajax({type:'GET',url:dar+'get/gtc/'+t,cache:false}).done(function(s){$('.tc').html(s);})
}else{
$('.tc').html("<span class='j-medium'>Error occurred while getting order data and "+t+" fee, please reload page and try again</span>");
}
}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/order/order_details.enc.php'){ ?>
<?php //change order status?>
function cos(i,s){
 var r = $('#r'+i).val();loading('Cancelling Order','id','cbtn'+i);
 $.ajax({type:'POST',url:dar+'act/cos/',data:{"i":i,"s":s,"r":r},cache:false,dataType:'JSON'}).fail(function(e,f,g){r_b('Cancel Order','id','cbtn'+i);$('#st').html(r_m2('Sorry!!!<br>Error occurred while running request'));})
 .done(function(s){if(s.status==='success'){window.location='';}else{r_b('Cancel Order','id','cbtn'+i);};$('#st').html(r_m2(s.message));});alertoff();
}
<?php } ?>