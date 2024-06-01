<?php //GENERAL JS STARTS ?>
<?php //hide modal when page is ready ?>
$(document).ready(function(){$('#load_modal').fadeOut(300);})
const hu="<?=file_location('home_url','')?>";var dar="<?=file_location('ajax_url','')?>";
function loading(s='Loading',t='id',i='sbtn'){let vl= "<span class='j-spinner-border j-spinner-border-sm'style='margin-right:7px;'></span>"+s;if(t==='id'){$('#'+i).html(vl);$('#'+i).prop('disabled',true);}else if(t==='class'){$('.'+i).html(vl);}$('.'+i).prop('disabled',true);}
function r_b(s='Submit',t='id',i='sbtn'){if(t==='id'){$('#'+i).html(s);$('#'+i).prop('disabled',false);}else if(t==='class'){$('.'+i).html(s);$('.'+i).prop('disabled',false);}}
alertoff();function alertoff(){setTimeout(thealert,8000);}function thealert(){$("#thealert").fadeOut('slow');}
function r_m(s){if(s.length>0){s=s;}else{s='Error running request';}return "<span class='j-text-color4 j-button alert j-color1 j-bolder j-container j-padding j-round j-fixalert'id='thealert'>"+s+"</span>";}
function r_m2(s){if(s.length>0){s=s;}else{s='Sorry!!!<br>Error occurred while running request, please try again later or reload page';}var err="<div id='return_message_modal'class='j-modal j-modal-click'><div class='j-card-4 j-modal-content j-color4 j-bolder'style='margin-top:200px;'><div class='j-padding'>"+s+"</div><center class='j-padding'><div class='j-clickable j-text-color1 j-round j-border j-border-color1 j-padding'style='width:100%'onclick=$('#return_message_modal').fadeOut('slow');>Close</div></center></div></div>";$('#st').html(err);$('#return_message_modal').fadeIn('slow');}
<?php //for notice ?>
$('#notice_modal').fadeIn('slow');
<?php //show dropdown of account?>
$('.dropdown-btn,.dropdown-content').hover(function(e){$('.dropdown-content').show();},function(e){$('.dropdown-content').hide();})
<?php //click anywhere to hide modal?>
$(document).ready(function(){let m = document.getElementsByClassName('j-modal-click');window.onclick = function(event){for(let i = 0; i < m.length; i++){if(event.target == m[i]){m[i].style.display = 'none';}}};})
<?php //hide 000webhost advert ?>
<?php if(strstr(file_location('home_url',''),'000webhostapp')){ ?>
$(document).ready(function(){$('div').last().hide();})
<?php } ?>
<?php //hide navi and show and vice versa ?>
function n(t,n,s){if(t==='nav'){n.fadeOut('slow');s.fadeIn('slow');$('#txtsearch2').focus();}else{s.fadeOut('slow');n.fadeIn('slow');}}
<?php // for show search button on small screen after x is clicked?>
function sc(d,f){
 if(d.val().length > 0){
  f.html('<span class="j-large j-clickable j-padding j-round j-color1 j-btn"onclick=sb($("#txtsearch2").val());><i class="<?= icon('search');?>"></i></span>');
 }else{
  f.html('<span class="j-xlarge" onclick=n("sea",$("#nav"),$("#sp"))>&times</span>');
 }
}
<?php // for search?>
function sb(s){if(s.length > 0){window.location=hu+'search/'+s+'/';}}
<?php //for getting cart/inbox number?>
gnc('cart');gnc('noti');function gnc(t){$.ajax({type:'GET',url:dar+'get/gnc/'+t,cache:false}).done(function(s){if(t==='cart'){$('.crt').html(s);}else{$('.ntf').html(s);}})}
<?php if($_SERVER['PHP_SELF'] === "/index.php"){?>
<?php //slidehow//?>
var sI = 1;var s = document.getElementsByClassName("s");var t = null;
function pD(n) {clearTimeout(t);sD(sI += n);}
function sD(n) {
  var i;
  if(n === undefined){n = ++sI}if (n > s.length) {sI = 1}if (n < 1) {sI = s.length}
  for (i = 0; i < s.length; i++) {s[i].style.display = "none";}
  s[sI-1].style.display = "block";t = setTimeout(sD,5000); // Change image every 2 seconds
}
<?php //for horizontal navigation?>
function hornavigation(n,c){
 let x = document.getElementsByClassName("trigger");
 for(let i = 0; i < x.length; i++){x[i].style.display="none";}
 document.getElementById(n).style.display="block";
 let y = document.getElementsByClassName("laucher");
 for(let i = 0; i < y.length; i++){y[i].style.color="black";y[i].style.backgroundColor="#f2f2f2";}
 c.style.color="white";c.style.backgroundColor="<?=get_json_data('primary_color','color')?>";
}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === "/food/index.php"){?>
<?php //slidehow//?>
var slideIndex = 1;
sD(slideIndex);
//$('#img_bx').on('swipeleft',function(){alert(500)});
//$('#img_bx').on('swiperight',function(){alert(500)});
function pD(n){sD(slideIndex += n);}
function cS(n){sD(slideIndex = n);}
function sD(n){
 var i; var s = document.getElementsByClassName("s");var dot = document.getElementsByClassName("dot");
 if(n > s.length){slideIndex = 1};
 if(n < 1){slideIndex = s.length};
 for(i=0;i<s.length;i++){s[i].style.display = 'none';}
 for(i=0;i<dot.length;i++){dot[i].style.border = 'solid 0px red';}
 if(slideIndex == 1){$('#prv').fadeOut('slow');}else{$('#prv').fadeIn('slow');}
 if(slideIndex == s.length){$('#nxt').fadeOut('slow');}else{$('#nxt').fadeIn('slow');}
 s[slideIndex-1].style.display = 'block';
 dot[slideIndex-1].style.border = 'solid 1px red';
 $('.cnt').html(slideIndex+' / '+s.length);
}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === "/food/index.php" || $_SERVER['PHP_SELF'] === "/checkout/index.php" || $_SERVER['PHP_SELF'] === '/cart.enc.php'
         || (isset($nav) && $nav === 'nav' )){?>
<?php //for horizintal login modal?>
function sgrghrn(n,c){
 let x = document.getElementsByClassName("trigger2");
 for(let i = 0; i < x.length; i++){x[i].style.display="none";}
 document.getElementById(n).style.display="block";
 let y = document.getElementsByClassName("laucher2");
 for(let i = 0; i < y.length; i++){y[i].style.color="black";y[i].style.border='0px';}
 c.style.color="<?=get_json_data('primary_color','color')?>";c.style.borderBottom="solid 2px <?=get_json_data('primary_color','color')?>";
}
<?php } ?>