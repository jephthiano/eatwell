<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
if(isset($_POST['s']) && isset($_POST['st']) && isset($_POST['pg'])){
	$searchtext = test_input(($_POST['s']));
	$status2 = test_input($_POST['st']);
	if($status2 === 'all'){$add = "";}else{$add = "AND rh_status = '{$status2}'" ;}
	$cur_page = test_input(($_POST['pg']));
	require_once(file_location('admin_inc_path','pagination_total.inc.php'));
	
	if(!empty($searchtext)){ // if the search text is not empty
		$searchtext = $searchtext."*";
		$sql = "SELECT rh_id,rh_status,or_order_id,rh_regdatetime FROM return_table
		WHERE (MATCH(or_order_id) AGAINST(:searchtext IN BOOLEAN MODE)) {$add}
		ORDER BY MATCH(or_order_id) AGAINST(:searchtext IN BOOLEAN MODE)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':searchtext',$searchtext,PDO::PARAM_STR);
	}else{ // if it the field is empty
		$sql = "SELECT rh_id,rh_status,or_order_id,rh_regdatetime FROM return_table
		WHERE or_id != 'NULL' {$add} ORDER BY rh_id DESC LIMIT $start,$display";
		$stmt = $conn->prepare($sql);
	}// end of if empty($searchtext)
	$stmt->bindColumn('rh_id',$id);
	$stmt->bindColumn('rh_status',$rh_status);
	$stmt->bindColumn('or_order_id',$order_id);
	$stmt->bindColumn('rh_regdatetime',$regdatetime);
	$stmt->execute();
	$numRow = $stmt->rowCount();
	if($numRow > 0){// if a record is found
		if(empty($searchtext)){$numRow = $total_records;}
		?>
		<center>
			<div class="j-responsive"style='line-height:27px;'>
				<p class="j-text-color5">
					<b><?=empty($searchtext)?$numRow.' Return(s) found':$numRow." result(s) found for <span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in ".$status2." returns";?></b>
				</p>
				<table class="j-table-all j-border-0">
					<tr class="j-border-0 j-text-color1">
						<td><b>S/N</b></td><td><b>Order ID</b></td>
						<?php if($status2 === 'all'){?> <td><b>Status</b></td><?php }?>
						<td><b>Date</b></td><td><b>Preview</b></td>
					</tr>
					<?php
					while($stmt->fetch()){
						?>
						<tr class="j-border-0">
							<td><?php s_n();?></td>
							<td><?=($order_id)?></td>
							<?php if($status2 === 'all'){?><td><?=ucwords($rh_status)?></td><?php }?>
							<td><?=showdate($regdatetime,'')?></td>
							<td><a href='<?= file_location('admin_url',"return/preview_return/".addnum($id)."/")?>'><i class="<?= icon('eye');?>"></i></a></td>
						</tr>
						<?php
					}// end of while
					?>
				</table>
			</div>
		</center>
		<?php
	}else{
		?>
		<br>
		<center>
			<div class='j-text-color5'>
				<b><?=empty($searchtext)?"0 $status2 return found":"0 result found for <b><span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in ".$status2." return";?></b>
			</div>
		</center>
			<?php
		}// end of if $numRow
		
		require_once(file_location('admin_inc_path','pagination_button.inc.php'));
}// end of if isset
?>
<br><br><br><br>