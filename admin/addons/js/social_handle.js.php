<?php //SOCIAL HANDLE JS STARTS ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/social_handle/index.php'){ ?>
<?php //get social handle result ?>
gshr(<?=$page_num?>);function gshr(pg){$.ajax({type:'POST',url:adar+'get/gshr/',data:{"s":$('#sx').val(),'pg':pg}}).fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error Occured while fetching data...'));}).done(function(s){$('#shr').html(s);});alertoff();}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/social_handle/insert_social_handle.enc.php'){ ?>
<?php //insert social handle ?>
$(document).ready(function(){
$('#inssmh').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('Inserting');
$.ajax({type:'POST',url:adar+"act/ish/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while creating social handle,try again'));r_b('Insert New Social Handle');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){$('#st').html(r_m2(s.message));};r_b('Insert New Social Handle');}})
})
})
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/social_handle/update_social_handle.enc.php'){ ?>
<?php //update social_handle ?>
$(document).ready(function(){
$('#upsmh').on('submit',function(event){event.preventDefault();$('.mg').html('*');loading('Updating');
$.ajax({type:'POST',url:adar+"act/ush/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while updating social handle,try again'));r_b('Update Social Handle');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){$('#st').html(r_m2(s.message));};r_b('Update Social Handle');}})
})
})
<?php } ?>