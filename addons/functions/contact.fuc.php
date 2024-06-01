<?php
//CONTACT FUNCTION STARTS
//function get contact details starts
function get_contact_detail($id,$type='account'){
 // creating connection
	require_once(file_location('inc_path','connection.inc.php'));
	@$conn = dbconnect('admin','PDO');
$sql = "SELECT uc_id,uc_fullname,uc_address,uc_region,uc_phnumber1,uc_phnumber2,uc_status,u_id FROM user_contact_table WHERE uc_id = :id ORDER BY uc_id DESC LIMIT 1";
		$stmt = $conn->prepare($sql);
  $stmt->bindParam(':id',$id,PDO::PARAM_INT);
		$stmt->bindColumn('uc_id',$id);
		$stmt->bindColumn('uc_fullname',$fullname);
		$stmt->bindColumn('uc_address',$address);
		$stmt->bindColumn('uc_region',$region);
  $stmt->bindColumn('uc_phnumber1',$phnumber1);
  $stmt->bindColumn('uc_phnumber2',$phnumber2);
  $stmt->bindColumn('uc_status',$status);
  $stmt->bindColumn('u_id',$user_id);
		$stmt->execute();
		$numRow = $stmt->rowCount();
  if($numRow > 0){		// if a record is found
   while($stmt->fetch()){
    ?>
    <div style='line-height:30px;min-height:100px;'>
     <div class='j-bolder'><b><?=ucwords(decode_data($fullname))?></b></div>
     <div style='line-height:20px;'>
      <div><?=ucfirst(decode_data($address))?></div>
      <div><?=ucfirst(decode_data($region))?></div>
     </div>
     <div>
      <?=decode_data($phnumber1)?>
      <?php if(!empty(decode_data($phnumber2))){echo " / ".decode_data($phnumber2);}?>
     </div>
     </div>
     <?php
     if($type === 'contact'){
      ?><hr>
      <div>
       <?php
        if(($status) === 'default'){
        ?><span class='j-bolder j-btn j-text-color5'>Default Address</span><?php
        }else{
         ?><button id='btn<?=$id?>'class='j-btn j-color1 j-round j-bolder'onclick="scad(<?=$id?>,'cnt');">Set As Default</button><?php
        } ?>
        <span class='j-right j-large j-padding j-text-color1 j-bolder'>
         <span onclick="$('#edit_contact_modal<?=$id?>').fadeIn('slow');"style='margin-right:8px;'><i class='<?=icon('edit')?>'></i></span>
         <?php if($status === 'none'){
          ?><span onclick="$('#delete_contact<?=$id?>').fadeIn('slow');"><i class='<?=icon('trash')?>'></i></span><?php
          }?>
          </span>
        <br class='clearfix'>
      </div>
      <?php
     }elseif($type === 'admin'){
      if($status === 'default'){
       ?><hr><div><span class='j-bolder j-btn j-text-color5'>Default Address</span></div><?php
      }else{
       ?><hr><div><span class='j-bolder j-btn j-text-color5'>Additional Address</span></div><?php
      }
     }
   }
  }
}
//function get contact details ends

//function get region starts
function get_region($user_region=''){
 $region = get_json_data('region','about_us');
 $region_array = explode('|',$region);$len = count($region_array);
			if(count($region_array) > 0){
				foreach($region_array AS $index => $region){?><option value='<?=strtolower($region)?>'<?php if(strtolower($user_region)===strtolower($region)){echo 'selected';}?>><?=ucwords($region)?></option><?php }
			}
}
//function get region ends
//CONTACT FUNCTION ENDS
?>