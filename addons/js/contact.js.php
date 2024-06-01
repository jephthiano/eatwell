<?php //CONTACT JS STARTS ?>
<?php if($_SERVER['PHP_SELF'] === '/account/contact.enc.php' || $_SERVER['PHP_SELF'] === '/checkout/index.php' && isset($_SESSION['user_id'])){ ?>
<?php //check contact maximum ?>
function ccm(t){
if(t<5){
$('#add_contact_modal').fadeIn('slow');
}else{
r_m2('Sorry!!!<br>You have reached the maximum contact details, please delete some contact details and try again.');
}
}
<?php //add new contact ?>
$(document).ready(function(){
$('#adctfrm').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('Creating','id','acbtn');
$.ajax({type:'POST',url:dar+"act/anc/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while creating contact,try again'));r_b('Add Contact','id','acbtn');})
.done(function(s){if(s.status === 'success'){window.location='';}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){$('#st').html(r_m2(s.message));}r_b('Add Contact','id','acbtn');}})
})
})
<?php //edit contact ?>
<?php
$or = multiple_content_data('user_contact_table','uc_id',$u_id,'u_id',"ORDER BY uc_status DESC");
if($or !== false){
foreach($or AS $id){
 ?>
 $(document).ready(function(){
$('#etctfrm<?=$id?>').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('Saving','class','ecbtn');
$.ajax({type:'POST',url:dar+"act/uc/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while saving contact,try again'));r_b('Save','class','ecbtn');})
.done(function(s){if(s.status === 'success'){window.location='';}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else if(s.status === 'fail'){$('#st').html(r_m2(s.message));}r_b('Save','class','ecbtn');}})
})
})
 <?php
}
 }
?>
<?php //set contact as default?>
function scad(i,t){loading('Saving settings','id','btn'+i);
if(t === 'cnt'){var mes = "Set As Default";}else{var mes = "Select This Address";}
$.ajax({type:'POST',url:dar+'act/scad/',data:{"i":i},cache:false,dataType:'JSON'}).fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while setting contact as default'));r_b(mes,'id','btn'+i);})
.done(function(s){$('#st').html(r_m2(s.message));if(s.status==='success'){window.location='';}else{r_b(mes,'id','btn'+i);}});alertoff();
}
<?php //delete user contact?>
function duc(i){loading('Deleting Contact','id','dcbtn'+i);
 $.ajax({type:'POST',url:dar+'act/duc/',data:{"i":i},cache:false,dataType:'JSON'}).fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while deleting contact'));r_b('Delete Contact','id','dcbtn'+i);})
.done(function(s){if(s.status === 'success'){window.location='';}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else{$('#st').html(r_m2(s.message));};r_b('Delete Contact','id','dcbtn'+i);}})
}
<?php } ?>