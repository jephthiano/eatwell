<?php
require_once(file_location('inc_path','session_start.inc.php'));
//DELETE SESSION
if(isset($_SESSION['user_id'])){
    @session_regenerate_id();// regenarate session include destroy_session
    //invalidate the session cookie
    if(isset($_COOKIE[session_name()])){
        $param = session_get_cookie_params();
        setcookie(session_name(),'',time()-86400,$param['path'],$param['domain'],$param['secure'],$param['httponly']); //24hours ago
        unset($_COOKIE[session_name()]);
    }
    //end session and redirect
    $_SESSION['user_id'] = [];//empty the $_SESSION array
    unset($_SESSION['user_id']);
    session_unset();
    session_destroy();
}
//DELETE BROWSER COOKIE AND STORED COOKIE DATA IN DATABASE
if(isset($_COOKIE['_jyualdj'])){
    $cookie = $_COOKIE['_jyualdj'];
    list($huser_id,$cookie_token,$huser_ip) = explode(':',$cookie);
    
    if(isset($_SESSION['user_id'])){$uid = test_input(ssl_decrypt_input($_SESSION['user_id']));}else{$uid = removenum(ssl_decrypt_input($huser_id));}
    
    $h_token = hash_input($cookie_token);
    $user_ip = ssl_decrypt_input($huser_ip);
    //UNSET COOKIE IN USER BROWSER
    setcookie("_jyualdj","",time()-3600,"/","",true,true);
}
$cookie_data = new cookie_data('admin');
$cookie_data->token = $h_token;
$cookie_data->ipaddress = $user_ip;
$cookie_data->uid = $uid;
$cookie_data->delete_cookie('current');
?>