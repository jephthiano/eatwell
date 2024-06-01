<?php //ADMIN JS STARTS ?>
<?php //logout?>
function lg(){loading('Loggin out','id','lobtn');
$.ajax({type:'POST',url:adar+'act/lg/',cache:false,dataType:'JSON'}).fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while logging out'));r_b('Log Out','id','lobtn');})
.done(function(s){if(!s.status){$('#st').html(r_m(s.message));r_b('Log Out','id','lobtn');}else{window.location=s.message;}})
alertoff();
}
<?php if($_SERVER['PHP_SELF'] === '/admin/login.enc.php'){ ?>
<?php //login ?>
$(document).ready(function(){
$('form').on('submit',function(event){event.preventDefault();$('#error').html('');loading('Logging In');
$.ajax({type:'POST',url:adar+"act/l/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while logging in,try again'));r_b('Log In As Admin');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{$('#st').html(r_m2(s.errors));r_b('Log In As Admin')}});alertoff();
})
})
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/admin/index.php'){ ?>
<?php //get admin result ?>
gar('<?=$status?>',<?=$page_num?>);function gar(st,pg){$.ajax({type:'POST',url:adar+'get/gar/',data:{"s":$('#sx').val(),"st":st,'pg':pg}}).fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while fetching data...'));}).done(function(s){$('#shr').html(s);});alertoff();}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/admin/insert_admin.enc.php'){ ?>
<?php //insert admin (IMAGE)?>
$(document).ready(function(){
$('#insad').on('submit',function(event){event.preventDefault();$('.mg').html('*');loading('Inserting Admin');
$.ajax({type:'POST',url:adar+"act/ia/",data:new FormData(this),cache:false,contentType:false,processData:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while inserting admin'));r_b('Insert Admin');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else{$('#st').html(r_m2(s.message));};r_b('Insert Admin');}})
})
})
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/admin/profile.enc.php'){ ?>
<?php //delete account ?>
function da(d){
$('.mg').html('');loading('Deleting Account','id','dabtn');
$.ajax({type:'POST',url:adar+'act/da/',data:{"d":d.val()},cache:false,dataType:'JSON'}).fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while running request'));r_b('Delete Account','id','dabtn');})
.done(function(s){if(s.status === 'success'){window.location='';}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else{$('#st').html(r_m2(s.message));};r_b('Delete Account','id','dabtn');}})
alertoff();d.val('');
}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/admin/preview_admin.enc.php'){ ?>
<?php //update level ?>
function upl(l,i){loading('Updating','id','clbtn');let d="/"+l+"/"+i+"/";
$.ajax({type:'GET',url:adar+'act/ul'+d,cache:false,dataType:'JSON'}).fail(function(e,f,g){r_b('Update','id','clbtn');$('#st').html(r_m2('Sorry!!!<br>Error Occured while updating level'));})
.done(function(s){$('#st').html(r_m2(s.message));if(s.status==='success'){window.location='';}else{r_b('Update','id','clbtn');}})
alertoff();
}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/admin/edit_profile.enc.php'){ ?>
<?php //edit_profile ?>
$(document).ready(function(){
$('#edpro').on('submit',function(event){event.preventDefault();$('.mg').html('*');loading('Updating Profile');
$.ajax({type:'POST',url:adar+"act/up/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while updating profile,try again'));r_b('Update Profile');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){$('#st').html(r_m2(s.message));};r_b('Update Profile');})
})
})
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/admin/admin/change_password.enc.php'){ ?>
<?php //change_password ?>
$(document).ready(function(){
$('#chpsw').on('submit',function(event){event.preventDefault();$('.mg').html('*');loading('Changing Password');
$.ajax({type:'POST',url:adar+"act/cp/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2(''));r_b('Change Password');})
.done(function(s){if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else{$('#st').html(r_m2(s.message))};r_b('Change Password');});alertoff();
$('.pss').val('');
})
})
<?php } ?>