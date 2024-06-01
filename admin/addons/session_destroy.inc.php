<?php
require_once(file_location('admin_inc_path','session_start.inc.php'));
//invalidate the session cookie
if(isset($_COOKIE[session_name()])){
    $param = session_get_cookie_params();
    setcookie(session_name(),'',time()-864000034,$param['path'],$param['domain'],$param['secure'],$param['httponly']); //24hours ago
    unset($_COOKIE[session_name()]);
    
}
//empty the $_SESSION array
$_SESSION = [];
unset($_SESSION);
session_unset();
session_destroy();
?>