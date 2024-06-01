<?php
//FILE UPLOAD STARTS
//get media starts
function get_media($type,$id){
 require_once(file_location('inc_path','connection.inc.php'));
 @$conn = dbconnect('admin','PDO');
	if($type === 'admin'){
  $sql = "SELECT am_link_name,am_extension FROM admin_media_table WHERE ad_id = :id LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id',$id,PDO::PARAM_INT);
  $stmt->bindColumn('am_link_name',$link_name);
  $stmt->bindColumn('am_extension',$extension);
 }elseif($type === 'food'){
  $sql = "SELECT fm_link_name,fm_extension FROM food_media_table WHERE fm_id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id',$id,PDO::PARAM_INT);
  $stmt->bindColumn('fm_link_name',$link_name);
  $stmt->bindColumn('fm_extension',$extension);
 }elseif($type === 'category'){
  $sql = "SELECT cm_link_name,cm_extension FROM category_media_table WHERE c_id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id',$id,PDO::PARAM_INT);
  $stmt->bindColumn('cm_link_name',$link_name);
  $stmt->bindColumn('cm_extension',$extension);
 }else{
  return 'home/no_media.png';
 }
	$stmt->execute();
	$numRow = $stmt->rowCount();
	if($numRow > 0){
		while($stmt->fetch()){
   $file = $type.'/'.$link_name.".".$extension;
   if(file_exists(file_location('media_path',$file)) && is_file(file_location('media_path',$file))){
    return $file;
   }else{
     if($type === 'admin'){return 'home/avatar.png';}else{return 'home/no_media.png';}
   }
		}
	}else{
  if($type === 'admin'){return 'home/avatar.png';}else{return 'home/no_media.png';}
	}
 closeconnect("stmt",$stmt);
 closeconnect("db",$conn);
}
//get media ends

// validate file starts
	function validate_uploaded_file($upload_name,$type,$array_file_format,$size,$form = 'single',$array_num = 0){
	if(is_array($upload_name) && is_array($array_file_format) && is_numeric($size) && is_numeric($array_num)){
		if($form === 'multiple'){
			if($type === 'image'){//if the type is image
				if(!is_uploaded_file($upload_name['tmp_name'][$array_num])){//check if file is truly uploaded
					return false;
				}elseif(!getimagesize($upload_name["tmp_name"][$array_num])){//check if file is image
					return false;
				}elseif(!in_array($upload_name["type"][$array_num],$array_file_format)){//check file format
					return false;
				}elseif($upload_name["size"][$array_num] > $size){//check image size $size000kb
					return false;
				}else{
					return true;
				}
			}elseif($type === 'video'){//if the type is video
				if(!in_array($upload_name["type"][$array_num],$array_file_format)){//check file format
					return false;
				}elseif($upload_name["size"][$array_num] > $size){//check video size $size000kb
					return false;	
				}else{
					return true;
				}
			}else{//if $type is not image or video
				return false;
			}
		}else{// else if $form is multiple
			if($type === 'image'){//if the type is image
				if(!is_uploaded_file($upload_name['tmp_name'])){//check if file is truly uploaded
					return false;
				}elseif(!getimagesize($upload_name["tmp_name"])){//check if file is image
					return false;
				}elseif(!in_array($upload_name["type"],$array_file_format)){//check file format
					return false;
				}elseif($upload_name["size"] > $size){//check image size $size000kb
					return false;
				}else{
					return true;
				}
			}elseif($type === 'video'){//if the type is video
				if(!in_array($upload_name["type"],$array_file_format)){//check file format
					return false;
				}elseif($upload_name["size"] > $size){//check video size $size000kb
					return false;	
				}else{
					return true;
				}
			}else{//if $type is not image or video
				return false;
			}
		}//end of else if $form is single
	}else{// if the upload and co requirment is not met
		return false;
	}// end if the upload and co requirment is not met
}
// validate file ends

//correct rotation starts
function correct_image_rotation($filename){
	//if function exists
	if(function_exists('exif_read_data')){
		@$exif = exif_read_data($filename); // assign exif_read_data info to variable
		// if the exif array and the orientation sub array is set
		if($exif && isset($exif['Orientation']) && ($exif['Orientation'] !== 1)){
			//if $orientation is not 1 check the orientation and assign the appropriate degree to be rotated to it
    $deg = 0;
    switch($exif['Orientation']){
     case 3:
     $deg = 180;
     break;
     case 6:
     $deg = 270;
     break;
     case 8:
     $deg = 90;
     break;
    }// end of switch
				if(exif_imagetype($filename) === 1 ){ //if imagetypes is gif
					$img = imagecreatefromgif($filename);
					//if degree is set
					if($deg){
						$img = imagerotate($img,$deg,0); //rotate image
					}// end of if degree
					imagegif($img,$filename,95); //rewrite image back to the disk as $filename
					imagedestroy($img); //destory image
				}elseif(exif_imagetype($filename) === 2 ){ //if imagetypes is jpg
					$img = imagecreatefromjpeg($filename);
					//if degree is set
					if($deg){
						$img = imagerotate($img,$deg,0); //rotate image
					}// end of if degree
					//rewrite image back to the disk as $filename
					imagejpeg($img,$filename,95);//rewrite image back to the disk as $filename
					imagedestroy($img); //destory image
				}elseif(exif_imagetype($filename) === 3){ //if imagetypes is png
					$img = imagecreatefrompng($filename);
					//if degree is set
					if($deg){
						$img = imagerotate($img,$deg,0); //rotate image
					}// end of if degree
					//rewrite image back to the disk as $filename
					imagepng($img,$filename,95);
					imagedestroy($img);
				}
		}// end of if orientation is set
	}// end of if function exists
}// end of function
//correct rotation ends

//correct_image_extension starts
function correct_image_extension($newfile,$extension_type){
 if(in_array(exif_imagetype($newfile),$extension_type) && exif_imagetype($newfile) === 1){ //gif
  $extension = "gif";
 }elseif(in_array(exif_imagetype($newfile),$extension_type) && exif_imagetype($newfile) === 2){ //jpg
  $extension = "jpg";
 }elseif(in_array(exif_imagetype($newfile),$extension_type) && exif_imagetype($newfile) === 3){ //png
  $extension = "png";
 }else{// else unlink
  unlink($newfile);
  $error[] = "no accepted extension";
  return false;
 }// end of else unlink
 
 if(empty($error)){
  $file = pathinfo($newfile);
  $realnewfile = $file['dirname']."/".$file['filename'].".".$extension;
  if(rename($newfile,$realnewfile)){
   return $realnewfile;
  }else{
   return false;
  }
 }
}
//correct_image_extension ends
//FILE UPLOAD ENDS
?>