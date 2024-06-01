<?php
// DEVICE AND LOCATION FUNCTION STARTS
//get browser details starts
function browser_detail($type){
 $br = get_browser();
 if($br){
  return $br->$type;
 }else{
  return "unknown type";
 }
}
//get browser details ends

//get ip address starts
function get_ip_address(){
 $geolocation = @unserialize(file_get_contents("https://ip-api.com/php/"));
	if($geolocation && $geolocation['status'] === 'success'){
  $ip_address = $geolocation['query'];
 }else{
  if(!empty($_SERVER['HTTP_CLIENT_IP'])){ // shared network
   $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ // proxy network
   $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }else{
   $ip_address = $_SERVER['REMOTE_ADDR'];
  }
 }
	return $ip_address;
}
//get ip address ends
//get location data starts
function get_location_data($data){
 $geolocation = @unserialize(file_get_contents("http://ip-api.com/php/"));
	if($geolocation && $geolocation['status'] === 'success'){
  return strtolower($geolocation[$data]);
 }else{
  return 'unknown';
 }
}
//get location data ends
// DEVICE AND LOCATION FUNCTION ENDS
?>