<?php //REVIEW JS STARTS ?>
<?php if($_SERVER['PHP_SELF'] === '/review/add_review.enc.php'){ ?>
<?php //add review ?>
$(document).ready(function(){
$('#adrvfrm').on('submit',function(event){event.preventDefault();$('.mg').html('');loading('Submiting Review');
$.ajax({type:'POST',url:dar+"act/ir/",data:$(this).serialize(),cache:false,dataType:'JSON'})
.fail(function(e,f,g){$('#st').html(r_m2('Sorry!!!<br>Error occurred while submitting review, try again'));r_b('Submit Review');})
.done(function(s){if(s.status === 'success'){window.location=s.message;}else{if(s.status === 'error'){for(let x in s.errors){$('#'+x).html(s.errors[x]);}}else{$('#st').html(r_m2(s.message));};;r_b('Submit Review');}})
})
})
<?php //star ?>
function srs(i){
 $('#rt').val(i);var st = '';var cl;
 for(let x = 1;x < 6;x++){
  if(x <= i){cl='j-text-color1'}else{cl='j-text-color5'};st += "<i class='j-xlarge "+cl+" <?=icon('star')?>'style='margin-right:9px;'onclick='srs("+x+")'></i>";
 }
 $('#rtg').html(st);
}
<?php } ?>