<?php
//TOKEN FUNCTION STARTS
//set token starts
function set_order_token(){
 if(!isset($_COOKIE['urntl'])){
  $data = rand(0000,9999).time().rand(0000,9999);
  $cookie_data = ssl_encrypt_input($data);
  $expiretime = time()+(86400 * 365);
  setcookie("urntl",$cookie_data,$expiretime,"/","",true,true);
  return ssl_decrypt_input($cookie_data);
 }
}
//set token ends

//get token starts
function get_order_token($type='none'){if(isset($_COOKIE['urntl'])){return test_input(ssl_decrypt_input($_COOKIE['urntl']));}else{if($type === 'none'){return 'no_token';}else{return set_order_token();}}}
//get token ends

//delete token starts
function delete_order_token(){if(isset($_COOKIE['urntl'])){setcookie("urntl","",time()-3600,"/","",true,true);}}
//delete token ends
//TOKEN FUNCTION STARTS
?>