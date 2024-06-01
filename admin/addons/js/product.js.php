<?php //PRODUCT JS STARTS ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/product/index.php'){ ?>
<?php //get product result ?>
gpr('<?=$status?>',<?=$page_num?>);function gpr(st,pg){$.ajax({type:'POST',url:adar+'get/gpr/',data:{"s":$('#sx').val(),"st":st,"pg":pg}}).fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while fetching data...'));}).done(function(s){$('#shr').html(s);});alertoff();}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/product/insert_product.enc.php'){ ?>
<?php //insert product (IMAGE)?>
$(document).ready(function(){
$('#insfd').on('submit',function(event){event.preventDefault();$('.mg').html('*');loading('Adding Product');
$.ajax({type:'POST',url:adar+"act/if/",data:new FormData(this),cache:false,contentType:false,processData:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while adding product'));r_b('Insert Product');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{r_b('Insert Product');if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else{$('#st').html(r_m2(s.message));}}})
})
})
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/product/update_product.enc.php'){ ?>
<?php //update product?>
$(document).ready(function(){
$('#upsfd').on('submit',function(event){event.preventDefault();$('.mg').html('*');loading('Updating Product');
$.ajax({type:'POST',url:adar+"act/uf/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){r_b('Update Product');$('#st').html(r_m2('Sorry!!!<br>Error occurred while updating product,try again'));})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{r_b('Update Product');if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){$('#st').html(r_m2(s.message));}}})
})
})
<?php } ?>