<?php
//PROCESS IMAGE
if(isset($upload_type) && $upload_type === 'multiple'){
	if(isset($_FILES['image'])){
		$html_file_name = $_FILES['image']; $file_length = count($html_file_name['tmp_name']);
	}else{
		$file_length = 0; $html_file_name = '';
	}
	if($file_length > 4){
		$error[] = "exceed max"; $data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Only 4 images are allowed at maximum, please re-select.';
	}else{
		for($i = 0; $i < $file_length; $i++){ // check if the file is not false image and assign name
			if($html_file_name === '' || (isset($html_file_name["error"][$i]) && $html_file_name["error"][$i] === UPLOAD_ERR_NO_FILE)){
				$file2 = "no file";
			}elseif($html_file_name["error"][$i] === UPLOAD_ERR_INI_SIZE || $html_file_name["error"][$i] === UPLOAD_ERR_FORM_SIZE){ //IF FILE IS LARGER THAN EXPECTED
				$file2 = "larger";
			}elseif($html_file_name["error"][$i] === UPLOAD_ERR_OK){// if file error is 0 i.e false
				$file2 = "normal";
				if(!validate_uploaded_file($html_file_name,$file_type,$file_mode,$size,$upload_type,$i)){ //if the image is not valid
					$error[] = "false image"; $data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>File must be jpg & png and must not exceed 5mb';
				}else{//if image is valid
					$extension =".". strtolower(pathinfo($html_file_name['name'][$i],PATHINFO_EXTENSION));
					// to be used for naming the uploaded file
					$file_name = "IMG_".time_token().$i;
					// write all needed values into new array
					$arr_tmpname[] = $html_file_name["tmp_name"][$i];
					$arr_file_name[] = $file_name;
					$arr_extension[] = $extension;
				}//end of if image is valid
			}//end of if the a selected and $file is normal	
		}// end of first for
		
		//IF NO ERROR, MISSING AND FILE TYPE IS NORMAL (UPLOAD FILE )
		if(empty($error) && empty($missing) && $file2 === 'normal'){
			for($x = 0; $x < $file_length; $x++){
				$imagename = basename($arr_file_name[$x].$arr_extension[$x]);
				// filepath
				$dir = file_location('media_path',$location."/");
				$file = $dir.$imagename;
				if(@!move_uploaded_file($arr_tmpname[$x],$file)){//upload file
					$error[] = "not upload";
					$data["status"] = 'fail';
					$data["message"] = 'Sorry!!!<br>Error uploading image, try again later';
				}
				$arr_file[] = $file; //set file name into array
			}// end of second for
			unset($arr_tmpname);// delete $arr_tmpname
			unset($arr_file_name);// delete $arr_file_name
			unset($arr_extension);// delete $arr_extension
			
			//IF NO ERROR (CORRECT EXTENSION)
			if(empty($error)){
				for($x = 0; $x < $file_length; $x++){
					// correct image extension type and unlink image that does not have correct image extension
					$newfile = correct_image_extension($arr_file[$x],[2,3]);
					if($newfile === false){
						$error[] = "wrong image type";
						$data["status"] = 'fail';
						$data["message"] = 'Sorry!!!<br>Invalid image selected';
					}else{
						$arr_newfile[] = $newfile; //set new file name into array
					}
				}
			}else{ //if there is error in file upload
				// DELETE ALL OTHER FILE IF THERE IS ERROR WITH MOVED
				$arr_length = count($arr_file);
				for($x = 0; $x < $arr_length; $x++){
					$full_path = $arr_file[$x];
					$path = pathinfo($full_path);
					$full_file_name = $path['filename'][$x].".".$path['extension'][$x];
					if(file_exists($full_path) && $full_file_name !== 'home/no_media.png' && is_file($full_path)){unlink($full_path);}
				}
				unset($arr_file);
			}
			//IF NO ERROR CORRECT IMAGE ROTATION
			if(empty($error)){// if no error correct image rotation
				for($x = 0; $x < $file_length; $x++){
					correct_image_rotation($arr_newfile[$x]);
					$correct = pathinfo($arr_newfile[$x]);
					// create array for corrected file
					$arr_file_name[] = $correct['filename'];
					$arr_extension[] = $correct['extension'];
				}
			}else{
				// DELETE ALL OTHER FILE IF THERE IS ERROR WITH EXTENSION CORRECTION
				$arr_length = count($arr_newfile);
				for($x = 0; $x < $arr_length; $x++){
					$full_path = $arr_newfile[$x];
					$path = pathinfo($full_path);
					$full_file_name = $path['filename'][$x].".".$path['extension'][$x];
					if(file_exists($full_path) && $full_file_name !== 'home/no_media.png' && is_file($full_path)){unlink($full_path);}
				}
				unset($arr_newfile);
			}
		}//end of if empty and missing, normal
	}//end of if file is not > 4
}else{
	if(isset($_FILES['image'])){$html_file_name = $_FILES['image'];}else{$html_file_name = '';}
	if($html_file_name === '' || (isset($html_file_name["error"]) && $html_file_name["error"] === UPLOAD_ERR_NO_FILE)){
		$file2 = "no file";
	}elseif($html_file_name["error"] === UPLOAD_ERR_INI_SIZE || $html_file_name["error"] === UPLOAD_ERR_FORM_SIZE){ //IF FILE IS LARGER THAN EXPECTED
		$file2 = "larger";
	}elseif($html_file_name["error"] === UPLOAD_ERR_OK){// if file error is 0 i.e false
		$file2 = "normal";
		if(!validate_uploaded_file($html_file_name,$file_type,$file_mode,$size)){ //if the image is not valid
			$error[] = "false image"; $data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>File must be jpg & png and must not exceed 5mb';
		}
		// UPLOAD FILE AND CONTINUE
		if((empty($missing) && empty($error))){
			$extension =".". strtolower(pathinfo($html_file_name['name'],PATHINFO_EXTENSION));
			// to be used for naming the uploaded file
			$file_name = "IMG_".time_token();$imagename = basename($file_name.$extension);
			// filepath
			$dir = file_location('media_path',$location."/");$file = $dir.$imagename;
			if(@!move_uploaded_file($html_file_name["tmp_name"],$file)){//upload file
				$error[] = "not upload";$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Error uploading image, try again later';
			}
			//CORRECT EXTENSION AND ROTATION
			if(empty($error)){
				// correct image extension type and unlink image that does not have correct image extension
				$newfile = correct_image_extension($file,[2,3]);
				if($newfile === false){
					$error[] = "wrong image type";$data["status"] = 'fail';$data["message"] = 'Sorry!!!<br>Invalid image selected';
				}else{//correct iamge extension and assign file name and extension
					correct_image_rotation($newfile);
					$correct = pathinfo($newfile);
				}
			}
		}
	}//end of if the a selected and $file is normal	
}
?>