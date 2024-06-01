<?php
$link_type = 'internal_link';$local_url = 'https://'.$_SERVER['SERVER_NAME'];
//test input starts
function test_input($data){
 $data = htmlspecialchars($data,ENT_QUOTES,'UTF-8',true);
	$data = htmlentities($data,ENT_QUOTES,'UTF-8',true);
	$data = trim($data);
	$data = stripslashes($data);
	$data = stripslashes($data);
	$data = stripslashes($data);
	$data = stripslashes($data);
	$data = stripslashes($data);
 return $data;
}
//test input ends

//file location starts
function file_location($type='home_url',$filename = ''){
 global $link_type, $local_url;
 if(strstr($local_url,'000webhostapp') || $link_type === 'internal_link'){
  $home_root = $_SERVER['DOCUMENT_ROOT'];
  $home_url = $local_url.'/';
  $admin_url = $local_url.'/admin/';
 }else{
  //for home document root
  $home_root = str_replace('/admin','',$home_root);
  //for url
  $home_url = "https://www.eatwell.com/";
  $admin_url = "https://admin.eatwell.com/";
 }
	if($type === 'media_path'){// MEDIA
		return ($home_root.'/media/'.$filename);
	}elseif($type === 'media_url'){
		return test_input($home_url.'media/'.$filename);
	}elseif($type === 'home_url'){// ABSOLUTE SECTION URL
		return test_input($home_url.$filename);
	}elseif($type === 'admin_url'){
		return test_input($admin_url.$filename);
	}elseif($type === 'ajax_url'){// AJAX URL
		return test_input($home_url.'ajax/'.$filename);
	}elseif($type === 'admin_ajax_url'){
		return test_input($admin_url.'ajax/'.$filename);
	}elseif($type === 'home_path'){ //ABSOLUTE PATHS
		return ($home_root.'/'.$filename);
	}elseif($type === 'admin_path'){
		return ($home_root.'/admin/'.$filename);
	}elseif($type === 'inc_path'){// ADDS ON PATH
		return ($home_root.'/addons/'.$filename);
	}elseif($type === 'admin_inc_path'){
		return ($home_root.'/admin/addons/'.$filename);
	}
}
//file location ends

$fur = ['json','xml','general','server_and_page','get_database','money','mail','device_and_location','order','forgot_password','token','viewed','date_and_time','file_upload','social_handle','category','food','contact','transaction','order','checkout','review','others','page_visit','admin','modal'];
foreach($fur AS $section){
 require_once(file_location('inc_path',"functions/$section.fuc.php"));
}
?>