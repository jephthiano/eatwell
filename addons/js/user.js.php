<?php //USER JS STARTS ?>
<?php if($_SERVER['PHP_SELF'] === '/login.enc.php' || $_SERVER['PHP_SELF'] === "/food/index.php" || $_SERVER['PHP_SELF'] === "/checkout/index.php" || $_SERVER['PHP_SELF'] === '/cart.enc.php'
         || (isset($nav) && $nav === 'nav' )){ ?>
<?php //login ?>
$(document).ready(function(){
$('#lgfrm').on('submit',function(event){event.preventDefault();$('#error').html('');loading('Loggin in','id','lgbtn');
$.ajax({type:'POST',url:dar+"act/l/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while logging in, try again'));r_b('Log In','id','lgbtn');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{$('#st').html(r_m2(s.errors));r_b('Log In','id','lgbtn');}});alertoff();
})
})
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/signup.enc.php'  || $_SERVER['PHP_SELF'] === "/food/index.php" || $_SERVER['PHP_SELF'] === "/checkout/index.php" || $_SERVER['PHP_SELF'] === '/cart.enc.php'
         || (isset($nav) && $nav === 'nav' )){ ?>
<?php //sign up ?>
$(document).ready(function(){
$('#sufrm').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('Creating Account','id','subtn');
$.ajax({type:'POST',url:dar+"act/sp/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while creating account, try again'));r_b('Sign Up','id','subtn');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){$('#st').html(r_m2(s.message));};r_b('Sign Up','id','subtn');}});alertoff();
})
})
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/forgot_password.enc.php'){ ?>
<?php if($type === 'enter_email'){ ?>
<?php //process email?>
$(document).ready(function(){
$('#eemfrm').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('PROCESSING EMAIL','id','eembtn');
$.ajax({type:'POST',url:dar+"act/pfpe/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while processing email, try again'));r_b('CONTINUE','id','eembtn');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){$('#st').html(r_m2(s.message));};r_b('CONTINUE','id','eembtn');}});alertoff();
})
})
<?php } ?>
<?php if($type === 'enter_code'){ ?>
<?php //process code?>
$(document).ready(function(){
$('#ecdfrm').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('PROCESSING CODE','id','ecdbtn');
$.ajax({type:'POST',url:dar+"act/pfpc/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while processing code, try again'));r_b('CONTINUE','id','ecdbtn');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){$('#st').html(r_m2(s.message));};r_b('CONTINUE','id','ecdbtn');}});alertoff();
})
})
<?php } ?>
<?php if($type === 'enter_password'){ ?>
<?php //process password?>
$(document).ready(function(){
$('#epsfrm').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('RESETING PASSWORD','id','epsbtn');
$.ajax({type:'POST',url:dar+"act/pfpp/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while resseting, try again'));r_b('SUBMIT','id','epsbtn');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){$('#st').html(r_m2(s.message));$('#psw').val('');};r_b('SUBMIT','id','epsbtn');}});alertoff();
})
})
<?php } ?>
<?php } ?>
<?php if(isset($log_delete) && $log_delete === 'enabled' || (isset($nav) && $nav === 'nav' )){?>
<?php //logout?>
function lg(){loading('Loggin out','id','lobtn');
$.ajax({type:'POST',url:dar+'act/lg/',cache:false,dataType:'JSON'}).fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while logging out'));r_b('Log Out','id','lobtn');})
.done(function(s){if(!s.status){$('#st').html(r_m(s.message));r_b('Log Out','id','lobtn');}else{window.location=s.message;}})
alertoff();
}
<?php //delete account ?>
function da(d){
$('.mg').html('');loading('Deleting Account','id','dabtn');
$.ajax({type:'POST',url:dar+'act/da/',data:{"d":d.val()},cache:false,dataType:'JSON'}).fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while running request'));r_b('Delete Account','id','dabtn');})
.done(function(s){if(s.status === 'success'){window.location='';}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else{$('#st').html(r_m2(s.message));};r_b('Delete Account','id','dabtn');}})
alertoff();d.val('');
}
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/account/edit_profile.enc.php'){ ?>
$(document).ready(function(){
$('#etprfrm').on('submit',function(event){event.preventDefault();$('.mg').html('*');loading('Saving');
$.ajax({type:'POST',url:dar+"act/up/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while updating profile,try again'));r_b('Save');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){$('#st').html(r_m2(s.message));};r_b('Save');}})
})
})
<?php } ?>
<?php if($_SERVER['PHP_SELF'] === '/account/change_password.enc.php'){ ?>
<?php //change_password ?>
$(document).ready(function(){
$('#chpsfrm').on('submit',function(event){event.preventDefault();$('.mg').html('*');loading('Updating Password');
$.ajax({type:'POST',url:dar+"act/cp/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2(''));r_b('Change Password');})
.done(function(s){if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else{$('#st').html(r_m2(s.message))};r_b('Change Password');});alertoff();
$('.pss').val('');
})
})
<?php } ?>