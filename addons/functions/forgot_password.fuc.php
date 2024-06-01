<?php
//FOGROT PASSWORD FUNCTION STARTS
//set token starts
function set_forgot_password_token($email,$code=''){
 $en_email = ssl_encrypt_input($email);
 $en_code = ssl_encrypt_input($code);
 $cookie_data = $en_email.":".$en_code;
 $expiretime = time()+(300);
 setcookie("_ftpsw",$cookie_data,$expiretime,"/","",true,true);
}
//set token ends

//get token starts
function get_forgot_password_token($type='email'){
 if(isset($_COOKIE['_ftpsw'])){
  $cookie = $_COOKIE['_ftpsw'];
  if(!empty($cookie)){
   list($de_email,$de_code) = explode(':',$cookie);
   if($type === 'email'){return test_input(ssl_decrypt_input($de_email));}elseif($type === 'code'){return test_input(ssl_decrypt_input($de_code));}else{return false;}
  }else{
   return false;
  }
 }else{
  return false;
  }
 }
//get token ends

//delete token starts
function delete_forgot_password_token(){if(isset($_COOKIE['_ftpsw'])){setcookie("_ftpsw","",time()-3600,"/","",true,true);}}
//delete token ends

//insert and delete code starts
function insert_delete_code($type,$email,$code = ''){
 $emailcode = new emailcode('admin');
 $emailcode->type = $type;
 $emailcode->email = $email;
 $emailcode->code = $code;
 return $emailcode->run_request();
}
//insert and delete code ends

//generate code starts
function generate_code(){return rand(100000,999999);}
//generate code ends

//check time validity starts
function time_validity($duration,$starttime='',$endtime=''){
 if(empty($endtime)){
  $end_time = time();
 }else{
  $end_time = strtotime($endtime);
 }
 $total_time = strtotime($starttime)+$duration;
 if($total_time < $end_time){
  return true;
 }else{
  return false;
 }
}
//check time validity starts

//FORGOT PASSWORD FUNCTION ENDS
?>