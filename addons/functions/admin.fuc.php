<?php
//ADMIN FUNCTION STARTS
function get_level($highest,$cur_level='',$type=''){
 if($type === 'upgrade'){
  ?><option value="">Select Admin Level</option><?php
  for($i = 1;$i <= $highest;$i++){
   if($i != $cur_level){
    ?><option value="<?=$i?>"><?=ucwords(check_level($i))?></option><?php
   }
  }//end of for
 }else{
  ?><option value="">Select Admin Level</option><?php
  for($i = 1;$i <= $highest;$i++){
   ?><option value="<?=$i?>"><?=ucwords(check_level($i))?></option><?php
  }//end of for
 }
}
function check_level($id){
 if($id == 1){
  return 'customer rep';
 }elseif($id == 2){
  return 'admin';
 }elseif($id == 3){
  return "grand admin";
 }
}
//ADMIN FUNCTION ENDS
?>