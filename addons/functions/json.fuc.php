<?php
//JSON FUNCTION STARTS
//get json_data starts
function get_json_data($subtype,$type,$file_location='settings.json'){
 $json = file_get_contents(file_location('home_path',$file_location));
 $array = json_decode($json,true);
 return decode_data($array[$type][$subtype]);
}
//get json_data ends

//write json data starts
function write_json_data($section,$key,$value,$file_location='settings.json'){
 $json = file_get_contents(file_location('home_path',$file_location));
 $array = json_decode($json,true);
 if(key_exists($key,$array[$section]) && key_exists($section,$array)){
  $array[$section][$key] = $value;
  $file = json_encode($array);
  if(file_put_contents(file_location('home_path',$file_location),$file)){return true;}else{return false;}
 }else{
  return false;
 }
}
//write json data ends
//JSON FUNCTION ENDS
?>