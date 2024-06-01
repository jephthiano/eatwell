<?php
//GENERAL FUNCTIONS STARTS
//classes auto load starts
spl_autoload_register(function ($className){
 $className = str_replace('..','',$className); //to removes .. so as to ensure that it is not used by attacker to get to above folder
 require_once(file_location('inc_path','classes/'.$className.'.cla.php'));
});
//classes auto load ends

//no surf starts
if(!strstr($_SERVER['PHP_SELF'],'admin')){no_surf();}
function no_surf(){
 if(get_json_data('surfing','act') == 0 || get_json_data('all','act') == 0){
  die(require_once(file_location('home_path','error/no_surfing.enc.php')));
 }
}
//no surf ends


//close connection function starts
function closeconnect($connectionType='',$connectionVar=''){
	if(@$connectionType === "db"){
		return @$connectionVar = null;
	}elseif(@$connectionType === "stmt"){
		return @$connectionVar = null;
	}elseif(@$connectionType === "curl"){
		return curl_close(@$connectionVar);
	}
}
//close connection function ends

// decode output starts
function decode_data($data){$data = htmlspecialchars_decode($data);return $data;}
//decode output ends

//sanitaition starts
//function test_input($data){
//	$data = filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
//	$data = trim($data);
//	$data = stripslashes($data);
//	$data = stripslashes($data);
//	$data = stripslashes($data);
//	$data = stripslashes($data);
//	$data = stripslashes($data);
//	$data = htmlspecialchars($data);
//	$data = strip_tags($data);
//	$data = htmlentities($data);
// return $data;
//}
//sanitaition ends

//encryption and decryption 2 starts
define('IV','mwrsaasghsh53456');
define("CIPHER","aes-128-cfb");
define("KEY","6346634bchbjdb");
//encryption
function ssl_encrypt_input($data){
	return openssl_encrypt($data,CIPHER,KEY,OPENSSL_ZERO_PADDING,IV);
}
//decryption
function ssl_decrypt_input($data){
	return openssl_decrypt($data,CIPHER,KEY,OPENSSL_ZERO_PADDING,IV);
}
// message encryption
function ssl_encrypt_message($data){
	return openssl_encrypt($data,CIPHER,KEY,OPENSSL_ZERO_PADDING,IV);
}
// message decryption
function ssl_decrypt_message($data){
	return openssl_decrypt($data,CIPHER,KEY,OPENSSL_ZERO_PADDING,IV);
}
//encryption and decryption 2 ends	

// hash input starts
function hash_input($data){$salt1 = '@jhdge$#fyyigtun76565665nk3?(hryryr())hghg@%^&#$#';$salt2 = 'leehack2DJhs(874764_))';return hash('ripemd128',"$salt1$data$salt2");}
// hash input ends

// hash pass starts
function hash_pass($pass){$options = ['cost' => 10,];return password_hash($pass, PASSWORD_DEFAULT, $options);}
// hash pass ends

//page not available starts
function page_not_available($type="full"){
	?>
	<br>
	<center>
   <div class=""style="font-family: Roboto,sans-serif;width: 100%;"">
        <p class="j-text-color1">
            Sorry, the page you are looking for is not available, page may have been deleted, link may have been broken or you may not have access to the content<br><br>
            <a href="<?php if(strstr($_SERVER['REQUEST_URI'],'admin')){echo file_location('admin_url',''); }else{echo file_location('home_url','');}?>"class="j-btn j-bolder j-color1 j-text-color4 j-round-large">
            Back to home
            </a>
        </p>
    </div>
	</center>
	<?php
 require_once(file_location('inc_path','js.inc.php')); //js
}
//page not available ends

// trigger error starts
function trigger_error_manual($error=404){http_response_code($error);require_once(file_location('home_path','error/index.php'));die();}
// trigger error starts

//error return starts
function return_message($type = ''){
 ?><span class='j-text-color4 j-button alert j-color1 j-bolder j-container j-padding j-round j-fixalert'id='thealert'><?=empty($type)?'Error running request':$type;?></span><?php
}
function return_message2($type = ''){
 ?><div id='return_message_modal'class='j-modal j-modal-click'><div class='j-card-4 j-modal-content j-color4 j-bolder'style='margin-top:200px;'><div class='j-padding'><?=empty($type)?'Error occurred while runing request, please try again later or reload page':$type;?></div><center class='j-padding'><div class='j-clickable j-text-color1 j-round j-border j-border-color1 j-padding'style='width:100%'onclick=$('#return_message_modal').fadeOut('slow');>Close</div></center></div></div><?php
}
//error return ends

//redirection starts
function redirection($type){
 if($type === 'reload'){?><center><div class='j-text-color1 j-xlarge'style='margin-top: 50px;'>Error loading page<br><a href='' class='j-color1 j-round-xlarge j-large j-text-color4 j-btn'>Reload</a></div></center><?php
 }elseif($type === 'redirect'){header("location:".file_location('home_url',''));}
}
//redirection ends

//add random number starts
function addnum($data){$first_four = rand(1,9).rand(1,9).rand(1,9).rand(1,9);$last_three = rand(1,9).rand(1,9).rand(1,9);return strrev($first_four.$data.$last_three);}
//add random number ends
	
//remove random number starts
function removenum($data){return strrev(substr(substr($data,3),0,-4));}
//add random number ends

//time token starts
function time_token(){return time().rand(000000,999999);}
//time token ends
 
// generate random token starts
function random_token($data = ''){return md5(microtime(true).mt_rand().$data);}
// generate random token ends
	
//text length start
function text_length($data,$length,$type='see_more'){
 if(strlen($data) > $length){
  if($type === 'see_more'){
   $data = substr($data,0,$length)."...<i class='j-text-color5'>See More</i>";
  }elseif($type === 'no_dot'){
   $data = substr($data,0,$length);
  }else{
   $data = substr($data,0,$length)."...";
  }  
 }
  return $data;
 }
//text length ends

//function convert to line break starts
function convert_2_br($data){$data2 = str_replace(array("\r\n","\r","\n"),"<br>",$data);echo $data2;}
//function convert to line break ends

//icon starts
function icon($data,$type='fas'){return $type.' fa-'.$data;}
//icon ends

//remove last starts
function remove_last_value($input,$remove = '*'){
	$position = strpos($input,$remove);
	if ($position === false){
		return $input;
	}else{
		$input = substr($input,0,-1);return $input;
	}
}
//remove last ends

//s/n starts
function s_n(){
 static $x = 1;
 echo $x;
 $x++;
}
//s/n ends

// regex starts
function regex($type,$data){
 if($type === 'email'){
  $reg = "/^[\w.-]*@[\w.-]+\.[A-Za-z]{2,6}$/";
 }elseif($type === 'word_comma'){ //for languages and co
  $reg = "/^[\w]*\,?\ ?[\w]*\,?\ ?[\w]*\,?\ ?[\w]*\,?\ ?$/";
 }elseif($type === 'word_space'){
  $reg = "/^[a-zA-Z ]*$/";
 }elseif($type === 'word_number_nospace'){
  $reg = "/^[a-zA-Z0-9]*$/";
 }elseif($type === 'phonenumber'){
  $reg = "/^\+?[\d]{11,17}$/";
 }elseif($type === 'skill'){ // for word . ' - @ 
  $reg = "/^[\w .'-@]+$/";
 }elseif($type === 'sql_date'){
  $reg = "/^[\d]{4}-[\d]{2}-[\d]{2} [\d]{2}:[\d]{2}:[\d]{2}$/";
 }else{
  return false;
 }
 return preg_match($reg,$data);
}
// regex ends

//re key array starts
function re_key_array($data){if(is_array($data)){$data = implode('|',$data);$data = explode('|',$data);return $data;}else{return false;}}
// re key array ends

//function get_header starts
function get_header($header,$button='settings',$size=30){
 if($button === 'settings'){
  $btn = "<span style='margin-right:30px;'class='j-btn j-hide-large j-hide-xlarge'onclick=$('#settings_modal').fadeIn('slow');><i class='j-xlarge ".icon('cog')."'></i></span>";
 }elseif($button === 'back'){
  $btn = "<span onclick='history.go(-1);'><span style='margin-right:30px;'class='j-btn''><i class='j-xlarge ".icon('arrow-left')."'></i></span></span>";
 }else{
  $btn = "<a href='".file_location('home_url',$button)."'><span style='margin-right:30px;'class='j-btn''><i class='j-xlarge ".icon('arrow-left')."'></i></span></a>";
 }
 ?>
 <div class='j-hide-small j-hide-medium'>
  <div class='j-large j-bolder j-padding'><span><?=$btn.$header?></span></div><hr>
 </div>
 <div class='j-hide-large j-hide-xlarge'style='margin-bottom:<?=$size?>px;'>
  <div class='j-bolder j-padding j-fixed-top j-card-2 j-color4'><span><?=$btn.$header?></span></div>
  <br>
 </div>
 <?php
}
//function get header ends

//fucntion back button starts
function back_btn(){
 ?>
 <a href='<?=file_location('home_url','')?>'><span style='margin-left:5px;'class='j-right j-xlarge'>
  &#10094;<span class="j-large"style='margin:5px 10px;position:relative;top:-2px'>Home</span></span>
 </a>
 <span onclick='history.go(-1);'><span style='margin:5px 15px;'class='j-clickable j-xlarge'>&#10094;</span></span>
 <?php
}
//fucntion back button ends

//back to the top starts
function back_to_top($type=''){
 ?> <div><a class="j-color3 j-button j-right"href="#<?=$type?>"><i class="fa fa-arrow-up j-margin-right"> </i>To the top</a></div><br><br> <?php
}
//back to the top ends

//function misc header starts
function misc_header($data){
 ?>
	<div class='j-display-container j-misc-height'style='width:100%'>
		<img src="<?=file_location('media_url','home/logo_large.png')?>"style='height:inherit;width:inherit;'/>
		<div class='j-display-middle j-text-color4 j-misc-height'style="font-family:Sofia;width:100%;background-color:rgba(0,0,0,0.4)">
			<?php back_btn();?>
			<center>
				<span class='j-xxxlarge j-hide-small'><b><br><?=strtoupper(get_xml_data('company_name'))?><br><?=strtoupper($data)?></b></span>
				<span class='j-xlarge j-hide-medium j-hide-large j-hide-xlarge'><b><br><?=strtoupper(get_xml_data('company_name'))?><br><?=strtoupper($data)?></b></span>
			</center>
		</div>
	</div>
	<br>
 <?php
}
//function misc header ends
//GENERAL FUNCTIONS ENDS
?>