<?php //FOOD JS STARTS ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/food/index.php'){ ?>
<?php //get message result ?>
gfr('<?=$status?>',<?=$page_num?>);function gfr(st,pg){$.ajax({type:'POST',url:adar+'get/gfr/',data:{"s":$('#sx').val(),"st":st,"pg":pg}}).fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while fetching data...'));}).done(function(s){$('#shr').html(s);});alertoff();}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/food/insert_food.enc.php'){ ?>
<?php //insert food (IMAGE)?>
$(document).ready(function(){
$('#insfd').on('submit',function(event){event.preventDefault();$('.mg').html('*');loading('Adding Food');
$.ajax({type:'POST',url:adar+"act/if/",data:new FormData(this),cache:false,contentType:false,processData:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while adding food'));r_b('Insert Food');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{r_b('Insert Food');if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else{$('#st').html(r_m2(s.message));}}})
})
})
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/food/update_food.enc.php'){ ?>
<?php //update food?>
$(document).ready(function(){
$('#upsfd').on('submit',function(event){event.preventDefault();$('.mg').html('*');loading('Updating Food');
$.ajax({type:'POST',url:adar+"act/uf/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){r_b('Update Food');$('#st').html(r_m2('Sorry!!!<br>Error occurred while updating food,try again'));})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{r_b('Update Food');if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){$('#st').html(r_m2(s.message));}}})
})
})
<?php } ?>