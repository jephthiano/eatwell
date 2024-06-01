<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
require_once(file_location('inc_path','session_start.inc.php'));
if(isset($_SESSION['user_id']) && content_data('user_table','u_id',test_input(ssl_decrypt_input($_SESSION['user_id'])),'u_id') !== false
   && content_data('user_table','u_status',test_input(ssl_decrypt_input($_SESSION['user_id'])),'u_id') === "active"){
	$GLOBALS['u_id'] = test_input(ssl_decrypt_input($_SESSION['user_id']));
}elseif(isset($_COOKIE['_jyualdj'])){ // PICK FROM REMEMBER ME COOKIE IF SESSION IS SET
	$cookie = $_COOKIE['_jyualdj'];
	if($cookie !== ""){
		list($huser_id,$cookie_token,$huser_ip) = explode(':',$cookie);
		$user_id = removenum(ssl_decrypt_input($huser_id));
		$h_token = hash_input($cookie_token);
		$user_ip = ssl_decrypt_input($huser_ip);
		// create connection
		require_once(file_location('inc_path','connection.inc.php'));
		@$conn = dbconnect('admin','PDO');
		$sql = "SELECT cd_expiretime FROM cookie_data_table
		WHERE u_id = :id AND cd_token = :token AND cd_ipaddress = :ipaddress
		LIMIT 1";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':id',$user_id,PDO::PARAM_STR);
		$stmt->bindParam(':token',$h_token,PDO::PARAM_STR);
		$stmt->bindParam(':ipaddress',$user_ip,PDO::PARAM_STR);
		$stmt->bindColumn('cd_expiretime',$time);
		$stmt->execute();
		$numRow = $stmt->rowCount();
		if($numRow > 0){
			while($stmt->fetch()){
				if($time >= time()){
               // no chance for suspended users || false user
					if(content_data('user_table','u_status',$user_id,'u_id') === "suspended" || content_data('user_table','u_id',$user_id,'u_id') === false){
						require_once(file_location('inc_path','session_destroy.inc.php'));
						require_once(file_location('inc_path','session_redirection.inc.php'));
					}
					$_SESSION['user_id'] = ssl_encrypt_input($user_id);
					$GLOBALS['u_id'] = test_input(ssl_decrypt_input($_SESSION['user_id']));
				}else{ // if the time has expired
					require_once(file_location('inc_path','session_destroy.inc.php'));
					require_once(file_location('inc_path','session_redirection.inc.php'));
				}
			}// end of while
		}else{ // if authentication is not true
			require_once(file_location('inc_path','session_destroy.inc.php'));
			require_once(file_location('inc_path','session_redirection.inc.php'));
		}
	}else{// if cookie is false
		require_once(file_location('inc_path','session_destroy.inc.php'));
		require_once(file_location('inc_path','session_redirection.inc.php'));
	}
}else{
	require_once(file_location('inc_path','session_destroy.inc.php'));
	require_once(file_location('inc_path','session_redirection.inc.php'));
}
?>