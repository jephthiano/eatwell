<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
require_once(file_location('admin_inc_path','session_start.inc.php'));
if(isset($_SESSION['admin_id']) && content_data('admin_table','ad_id',test_input(ssl_decrypt_input($_SESSION['admin_id'])),'ad_id') !== false
   && content_data('admin_table','ad_status',test_input(ssl_decrypt_input($_SESSION['admin_id'])),'ad_id') === "active"){
	$GLOBALS['adid'] = (int)test_input(ssl_decrypt_input(($_SESSION['admin_id'])));
	$GLOBALS['adlevel'] = content_data('admin_table','ad_level',$adid,'ad_id');
}else{
	require_once(file_location('admin_inc_path','session_redirection.inc.php'));
	require_once(file_location('admin_inc_path','session_destroy.inc.php'));
}
?>