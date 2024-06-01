<?php
//XML FUNCTION STARTS
//get import data starts
function get_xml_data($type,$file_location='data.xml'){
 $file = file_location('home_path',$file_location);
 $xmlElement = new SimpleXMLElement($file, NULL, true); //object oriented
 return $xmlElement->$type;
}
//get import data ends
//XML FUNCTION ENDS
?>