<?php //USER?>
<?php if($_SERVER['PHP_SELF'] === '/admin/user/index.php'){ ?>
<?php //get user result ?>
gur('<?=$status?>',<?=$page_num?>);function gur(st,pg){$.ajax({type:'POST',url:adar+'get/gur/',data:{"s":$('#sx').val(),"st":st,"pg":pg}}).fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while fetching data...'));}).done(function(s){$('#shr').html(s);});alertoff();}
<?php } ?>
