<?php //TRANSACTION JS STARTS ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/refund/index.php'){ ?>
<?php //get refund result ?>
grr('<?=$status?>',<?=$page_num?>);function grr(st,pg){$.ajax({type:'POST',url:adar+'get/grr/',data:{"s":$('#sx').val(),"st":st,"pg":pg}}).fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while fetching data...'));}).done(function(s){$('#shr').html(s);});alertoff();}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/order/preview_order.enc.php'){ ?>
<?php // for refund ?>
function rc(i,s){loading('Processing Refund','id','rebtn');
$.ajax({type:'POST',url:adar+'act/rc',data:{"s":s.val(),"i":i},cache:false,dataType:'JSON'}).fail(function(e,f,g){r_b('Process Refund','id','rebtn');$('#st').html(r_m2('Sorry!!!<br>Error occurred while processing refund'));})
.done(function(s){$('#st').html(r_m2(s.message));if(s.status==='success'){window.location='';}else{r_b('Process Refund','id','rebtn');}})
alertoff();
}
<?php } ?>