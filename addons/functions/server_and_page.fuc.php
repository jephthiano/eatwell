<?php
//SERVER AND PAGE FUNCTION STARTS
// validate php self starts
function php_self($filename,$type='home',$return='checked'){
	global $link_type, $local_url;
	$home_root = $_SERVER['PHP_SELF'];
	if(strstr($local_url,'000webhostapp') || $link_type === 'internal_link'){
		if($type === 'admin'){$filename = '/admin'.$filename;}elseif($type === 'seller'){$filename = '/seller'.$filename;}
 }
	if($return === 'checked'){
		if($home_root === $filename){
			return true;
		}else{
			return false;
		}
	}elseif($return === 'return'){
		return $filename;
	}
}
// validate php self ends
//SERVER AND PAGE FUNCTION ENDS
?>