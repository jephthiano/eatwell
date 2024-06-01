<?php
require_once(file_location('inc_path','session_start.inc.php'));
$_SESSION['user_id'] = ssl_encrypt_input($user_id);
session_regenerate_id();
//COOKIE DATA (REMEMBER ME)
$huser_id = ssl_encrypt_input(addnum($user_id));
$cookie_token = random_token();
$h_token = hash_input($cookie_token);
$ipaddress = get_ip_address();
$huser_ip = ssl_encrypt_input($ipaddress);
$cookie_data = $huser_id.":".$cookie_token.":".$huser_ip;
$expiretime = time()+(86400 * 365); // 1 year
//INSERT COOKIE DATA INTO DB AND CREATE DATA
$cookie = new cookie_data('admin');
$cookie->token = $h_token;
$cookie->ipaddress = $ipaddress;
$cookie->expiretime = $expiretime;
$insert = $cookie->insert_cookie();
if($insert === true){setcookie("_jyualdj",$cookie_data,$expiretime,"/","",true,true);}
?>