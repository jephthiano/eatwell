<?php
//START SESSION STARTS
session_name('_mntyxlr');
if(version_compare(PHP_VERSION,'7.0.0')){
	//if version is greater than 7.0.0
	if(session_status() === PHP_SESSION_NONE){
		session_start([
		               //'use_only_cookie' => 1,
		               //'cookie_lifetime' => 0,
		               //'cookie_secure' => 1,
		               //'cookie_httponly' => 1
		               // settings that control the ini
		               ]);
		}
	}elseif(version_compare(PHP_VERSION,'5.4.0')){
		//if version is greater than 5.4.0 but less than 7.0.0
		if(session_status() === PHP_SESSION_NONE){session_start();}
	}else{
		//if version is lesser than 5.4.0
		if(session_id()==''){session_start();}
	}
?>