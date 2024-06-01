<?php //MESSAGE JS STARTS ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/message/index.php'){ ?>
<?php //get message result ?>
gmr('<?=$status?>',<?=$page_num?>);function gmr(st,pg){$.ajax({type:'POST',url:adar+'get/gmr/',data:{"s":$('#sx').val(),"st":st,"pg":pg}}).fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while fetching data...'));}).done(function(s){$('#shr').html(s);});alertoff();}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/message/send_email.enc.php'){ ?>
<?php //send email ?>
$(document).ready(function(){
$('#sndem').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('Sending Email');
$.ajax({type:'POST',url:adar+"act/se/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while sending email,try again'));r_b('Send Email');})
.done(function(s){if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else{if(s.status==='success'){$('.ip').val('');}$('#st').html(r_m2(s.message));};r_b('Send Email');});alertoff();
})
})
<?php } ?>