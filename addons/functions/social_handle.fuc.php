<?php
//SOCIAL HANDLE FUNCTION STARTS
function get_all_social_handle(){
 // creating connection
 require_once(file_location('inc_path','connection.inc.php'));
 @$conn = dbconnect('admin','PDO');
 $sql = "SELECT s_id,s_name,s_icon,s_link FROM social_handle_table";
 $stmt = $conn->prepare($sql);
 $stmt->bindColumn('s_id',$id);
 $stmt->bindColumn('s_name',$name);
 $stmt->bindColumn('s_icon',$icon);
 $stmt->bindColumn('s_link',$link);
 $stmt->execute();
 $numRow = $stmt->rowCount();
 if($numRow > 0){
  while($stmt->fetch()){
   ?><a href="http://<?=$link?>"style="margin:5px"class="j-tag j-xlarge j-round-large"title="<?=$name?>"target="_blank"><i class="<?=icon($icon,'fab')?>"></i></a></span><?php
  }// end of while
 }else{
   ?> <div class='j-text-color1 j-bolder'>No Social Media handle Uploaded</div> <?php
 }
closeconnect("stmt",$stmt);
closeconnect("db",$conn);
}
//SOCIAL HANDLE FUNCTION ENDS
?>