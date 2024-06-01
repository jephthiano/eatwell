<?php //AFTERLOAD JS STARTS ?>
<?php if($_SERVER['PHP_SELF'] === "/index.php"){?>
  <?php // get flash sales?>
  $.ajax({type:'GET',url:dar+'get/gfs/',cache:true})
  .done(function(s){
   $("#flash_sales").html(s);
   <?php // get new arrival?>
   $.ajax({type:'GET',url:dar+'get/gna/',cache:true})
   .done(function(s){
    $("#new_arrival").html(s);
    <?php // get top deal?>
    $.ajax({type:'GET',url:dar+'get/gtd/',cache:true})
    .done(function(s){
     $("#top_deal").html(s);
     <?php // get top category?>
     $.ajax({type:'GET',url:dar+'get/gtc/',cache:true}).done(function(s){$("#top_category").html(s);})
    })
   })
  })
<?php } ?>
<?php if(isset($reco_data) && $reco_data === 'run_request'){?>
<?php //for recommended ?>
$(document).ready(function(){gr('<?=$reco_id?>','<?=$reco_type?>');})
function gr(i,p){$.ajax({type:'GET',url:dar+'get/gr/'+i+'/'+p,cache:true}).done(function(s){$("#recommended").html(s);})}
<?php } ?>
<?php if(isset($wish_data) && $wish_data === 'run_request'){?>
<?php //for wishlist ?>
$(document).ready(function(){$.ajax({type:'GET',url:dar+'get/gw/',cache:false}).done(function(s){$("#wishlist").html(s);})})
<?php } ?>
<?php if(isset($recent_data) && $recent_data === 'run_request'){?>
<?php //for recently viewed ?>
$(document).ready(function(){$.ajax({type:'GET',url:dar+'get/grv/',cache:false}).done(function(s){$("#recently_viewed").html(s);})})
<?php } ?>