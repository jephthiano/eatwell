<?php //ORDER?>
<?php if($_SERVER['PHP_SELF'] === '/admin/order/index.php'){ ?>
<?php //get order result ?>
gor('<?=$status?>',<?=$page_num?>);function gor(st,pg){$.ajax({type:'POST',url:adar+'get/gor/',data:{"s":$('#sx').val(),"st":st,"pg":pg}}).fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while fetching data...'));}).done(function(s){$('#shr').html(s);});alertoff();}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/order/preview_order.enc.php'){ ?>
<?php //change order status?>
function cos(i,s){loading('Updating Status','id','cbtn');
 $.ajax({type:'POST',url:adar+'act/cos/',data:{"i":i,"s":s},cache:false,dataType:'JSON'}).fail(function(e,f,g){r_b('Update Status','id','cbtn');$('#st').html(r_m2('Sorry!!!<br>Error occurred while running request'));})
 .done(function(s){if(s.status==='success'){window.location='';}else{r_b('Update Status','id','cbtn');};$('#st').html(r_m2(s.message));});alertoff();
}
<?php //print page?>
function print_page(i){var cnt = document.getElementById(i);var winPrint = window.open('','SALES INVOICE','');winPrint.document.write(cnt.innerHTML);winPrint.document.close();winPrint.focus();winPrint.print();winPrint.close();}
<?php } ?>