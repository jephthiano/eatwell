<?php
$login = file_location('admin_url','login');
	if(isset($page_url)){ // if page url is set for pages with $_GET
		$redirect = $page_url;
	}else{
		$redirect = file_location('admin_url','');
	}
	header("Location:$login?re=$redirect");
	die();
?>