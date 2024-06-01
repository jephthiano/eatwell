<?php
//REVIEW FUNCTION STARTS
function avg_rating($id){
 $total_rating = get_numrow('review_table','f_id',$id,"return",'round');
 $total_sum = get_sum('review_table','r_rating',$id,'f_id');
 if($total_sum < 1){
  return 0;
 }else{
  return ($total_sum/$total_rating);
 }
}
//start level starts
function star_level($avg_rating){
 $floor = floor($avg_rating);
 for($i=0;$i<$floor;$i++){?><i class='j-text-color1 <?=icon('star')?>'></i><?php }
 if($avg_rating > $floor){?><i class='j-text-color1 <?=icon('star-half')?>'></i><?php }
}
//start level ends

//function get rating starts
function get_rating($id,$type='product'){
 $total_rating = get_numrow('review_table','f_id',$id,"return",'round');
 $total_sum = get_sum('review_table','r_rating',$id,'f_id');
 if($type === 'product'){ //$id is f_id
  $avg_rating = avg_rating($id);
  star_level($avg_rating);
  ?>
  <span style='margin-left:5px;'><?=round($avg_rating,1)?></span>
  <span style='margin-left:5px;'>Review<?=$total_rating > 1 ?'s':''?> <b>(<?=$total_rating?>)</b></span>
  <?php
 }elseif($type === 'rating'){ //$id is f_id
  $avg_rating = avg_rating($id);
  ?>
  <div class='j-row'>
   <div class='j-col s6 l12 j-padding'>
    <div class='j-color5 j-round j-center'style='padding:32px;'>
     <div class='j-xlarge j-text-color3'><span class='j-bolder j-xxlarge'><?=round($avg_rating,1)?></span>/5</div>
     <div class=''>
      <?php star_level($avg_rating);?>
					</div>
					<div class=' j-text-color3'><b><?=$total_rating?></b> Ratings</div>
				</div>
   </div>
   <div class='j-col s6 l12 j-padding'>
    <?php for($i=5;$i>0;$i--){
     $total_level_rating = get_numrow('review_table','f_id',$id,"return",'round',"AND r_rating = {$i}");
     ?>
     <div class='j-row'>
      <div class='j-col s5'>
       <span style='margin-right:5px;'><b><?=$i?></b></span><i style='margin-right:5px;' class='j-text-color1 <?=icon('star')?>'></i>
       <span>(<?=$total_level_rating?>)</span>
      </div>
      <div class='j-col s7'>
       <div class='j-color5 j-round'style='width:100%;height:10px;position:relative;top:8px;'>
        <div class='j-round j-color1'style='width:<?=(($total_level_rating/$total_rating)*100)?>%;height:10px;'></div>
       </div>
      </div>
     </div>
     <?php }?>
   </div>
  </div>
  <?php
 }elseif($type === 'feedback' || $type === 'second_column_feedback'){ //$id is r_id
  // creating connection
  require_once(file_location('inc_path','connection.inc.php'));
  @$conn = dbconnect('admin','PDO');
  $sql = "SELECT r_id,r_name,r_rating,r_title,r_feedback,r_regdatetime FROM review_table WHERE r_id = :id ORDER BY r_id DESC LIMIT 1";
		$stmt = $conn->prepare($sql);
  $stmt->bindParam(':id',$id,PDO::PARAM_INT);
		$stmt->bindColumn('r_id',$id);
  $stmt->bindColumn('r_name',$name);
		$stmt->bindColumn('r_rating',$rating);
		$stmt->bindColumn('r_title',$title);
		$stmt->bindColumn('r_feedback',$feedback);
  $stmt->bindColumn('r_regdatetime',$regdatetime);
		$stmt->execute();
		$numRow = $stmt->rowCount();
  if($numRow > 0){		// if a record is found
   while($stmt->fetch()){
    ?>
    <div style='line-height:29px;'>
     <div><b><?=ucfirst(decode_data($name))?></b></div>
     <div class=''>
      <?php
      for($i=0;$i<5;$i++){?><i class='<?=$i<$rating?'j-text-color1':'j-text-color5'?> <?=icon('star')?>'></i><?php }
      ?>
      </div>
     <div class='j-bolder'><?=ucfirst(decode_data($title))?></div>
     <div><?=convert_2_br(ucfirst(decode_data($feedback)))?></div>
     <div class='j-text-color7 j-bolder'><?=showdate($regdatetime,'short')?></div>
    </div>
    <hr>
    <?php
   }
  }
 }
}
//function get rating ends
//REVIEW FUNCTION ENDS
?>