<?php //RETURN?>
<?php if($_SERVER['PHP_SELF'] === '/admin/return/index.php'){ ?>
<?php //get order result ?>
grtr('<?=$status?>',<?=$page_num?>);function grtr(st,pg){$.ajax({type:'POST',url:adar+'get/grtr/',data:{"s":$('#sx').val(),"st":st,"pg":pg}}).fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while fetching data...'));}).done(function(s){$('#shr').html(s);});alertoff();}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/return/preview_return.enc.php'){ ?>
<?php //request for return approved?>
$(document).ready(function(){
$('#rrafrm').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('Approving','id','rrabtn');
$.ajax({type:'POST',url:adar+"act/rta/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while running request, try again'));r_b('Approve','id','rrabtn');})
.done(function(s){$('#st').html(r_m2(s.message));if(s.status === 'success'){window.location='';}else{r_b('Approve','id','rrabtn');}})
})
})
<?php //enable submit button for return reject?>
function esb(t){
if(t==='request reject'){
 let rr = $('#rrj').val();let orr = $('#orrj').val(); $('#rrje').html('');
 if(rr===''){
  $('#dorrj').fadeOut('slow');$('#rrje').html('* select the reason why return request is rejected');$('#rrjbtn').attr('disabled','disabled');
 }else if(rr==='other'){
 $('#dorrj').fadeIn('slow');
  if($.trim(orr)===''){
   $('#rrje').html('* input the reason for return rejection in the textbox below');$('#rrjbtn').attr('disabled','disabled');
  }else{
   $('#rrjbtn').removeAttr('disabled');
  }
 }else{
  $('#dorrj').fadeOut('slow');$('#rrjbtn').removeAttr('disabled');
 }
}else if(t==='return reject'){ 
 let rr = $('#rj').val();let orr = $('#orj').val(); $('#rje').html('');
 if(rr===''){
  $('#dorj').fadeOut('slow');$('#rje').html('* select the reason return of the item is rejected');$('#rjbtn').attr('disabled','disabled');
 }else if(rr==='other'){
 $('#dorj').fadeIn('slow');
  if($.trim(orr)===''){
   $('#rje').html('* input the reason for return rejection in the textbox below');$('#rjbtn').attr('disabled','disabled');
  }else{
   $('#rjbtn').removeAttr('disabled');
  }
 }else{
  $('#dorj').fadeOut('slow');$('#rjbtn').removeAttr('disabled');
 }
}
}
<?php //request for return rejected?>
$(document).ready(function(){
$('#rrjfrm').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('Rejecting','id','rrjbtn');;
$.ajax({type:'POST',url:adar+"act/rta/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while running request, try again'));r_b('Rejecting','id','rrjbtn');})
.done(function(s){if(s.status === 'success'){$('#st').html(r_m2(s.message));window.location='';}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else{$('#st').html(r_m2(s.message));};r_b('Rejecting','id','rrjbtn');}})
})
})
<?php //return approved?>
$(document).ready(function(){
$('#rafrm').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('Approving','id','rabtn');
$.ajax({type:'POST',url:adar+"act/rta/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while running request, try again'));r_b('Approve','id','rabtn');})
.done(function(s){$('#st').html(r_m2(s.message));if(s.status === 'success'){window.location='';}else{r_b('Approve','id','rabtn');}})
})
})
<?php //return rejected?>
$(document).ready(function(){
$('#rjfrm').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('Rejecting','id','rjbtn');;
$.ajax({type:'POST',url:adar+"act/rta/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while running request, try again'));r_b('Rejecting','id','rjbtn');})
.done(function(s){if(s.status === 'success'){$('#st').html(r_m2(s.message));window.location='';}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else{$('#st').html(r_m2(s.message));};r_b('Rejecting','id','rjbtn');}})
})
})
<?php } ?>