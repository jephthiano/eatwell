<?php //hide modal when page is ready ?>
$(document).ready(function(){$('#load_modal').fadeOut(300);})
const hu="<?=file_location('admin_url','')?>";var adar="<?=file_location('admin_ajax_url','')?>";
function loading(s='Loading',t='id',i='sbtn'){let vl= "<span class='j-spinner-border j-spinner-border-sm j-text-color4'style='margin-right:7px;'></span>"+s;if(t==='id'){$('#'+i).html(vl);$('#'+i).prop('disabled',true);}else if(t==='class'){$('.'+i).html(vl);}$('.'+i).prop('disabled',true);}
function r_b(s='Submit',t='id',i='sbtn'){if(t==='id'){$('#'+i).html(s);$('#'+i).prop('disabled',false);}else if(t==='class'){$('.'+i).html(s);$('.'+i).prop('disabled',false);}}
function r_m(s){if(s.length>0){s=s;}else{s='Error running request';}return "<span class='j-center j-wrap j-text-color4 alert j-color1 j-bolder j-container j-padding j-round j-fixalert'id='thealert'>"+s+"</span>";}
function r_m2(s){if(s.length>0){s=s;}else{s='Sorry!!!<br>Error occurred while runing request, please try again later or reload page';}var err="<div id='return_message_modal'class='j-modal'><div class='j-card-4 j-modal-content j-color4 j-bolder'style='margin-top:200px;'><div class='j-padding'>"+s+"</div><center class='j-padding'><div class='j-clickable j-text-color1 j-round j-border-2 j-border-color1 j-padding'style='width:100%'onclick=$('#return_message_modal').fadeOut('slow');>Close</div></center></div></div>";$('#st').html(err);$('#return_message_modal').fadeIn('slow');}
alertoff();function alertoff(){setTimeout(thealert,8000);}function thealert(){$("#thealert").fadeOut('slow');}
<?php //click anywhere to hide modal?>
$(document).ready(function(){let m = document.getElementsByClassName('j-modal');window.onclick = function(event){for(let i = 0; i < m.length; i++){if(event.target == m[i]){m[i].style.display = 'none';}}};})
<?php //code for show and hide with menu and close symbol on small and medium screen ?>
function ad(){$('#a').toggle('',function(){if($('#a').is(":hidden")){$('#mo').html('&#9776');}else{$('#mo').html('&times');}});}
<?php if(strstr(file_location('home_url',''),'000webhostapp')){ ?>
<?php //hide 000webhost advert ?>
$(document).ready(function(){$('div').last().hide();})
<?php } ?>
<?php // fix admin first column height?>
$(document).ready(function(){var screen_height = screen.availHeight-72;document.getElementById('firstcol').style.height=screen_height+"px";document.getElementById('mainbody').style.height=screen_height+"px";})
