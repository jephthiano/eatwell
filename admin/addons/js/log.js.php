<?php //LOG JS STARTS ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/log/index.php'){ ?>
<?php //get log result ?>
glr(<?=$page_num?>);function glr(pg){$.ajax({type:'POST',url:adar+'get/glr/',data:{"s":$('#sx').val(),'pg':pg}}).fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while fetching data...'));}).done(function(s){$('#shr').html(s);});alertoff();}
<?php //clear log ?>
function cl(){loading('Clearing Logs','id','clbtn');
$.ajax({type:'GET',url:adar+'act/cl/',cache:false,dataType:'JSON'}).fail(function(e,f,g){r_b('Clear Logs','id','clbtn');$('#st').html(r_m2('Sorry!!!<br>Error occurred while clearing logs'));})
.done(function(s){$('#st').html(r_m2(s.message));if(s.status==='success'){window.location='';}else{r_b('Clear Logs','id','clbtn');}})
alertoff();
}
<?php } ?>