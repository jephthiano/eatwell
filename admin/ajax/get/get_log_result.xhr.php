<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
if(isset($_POST['s']) && isset($_POST['pg'])){
	$searchtext = test_input(($_POST['s']));
	$cur_page = test_input(($_POST['pg']));
	require_once(file_location('admin_inc_path','pagination_total.inc.php'));
	
	if(!empty($searchtext)){ // if the search text is not empty
		$searchtext2 = $searchtext."*";
		$sql = "SELECT l_id,l_brief,l_details,l_regdatetime,ad_id,ad_username FROM log_table
		WHERE (MATCH(l_brief,l_details,l_ip_address,ad_username) AGAINST(:searchtext IN BOOLEAN MODE))
		ORDER BY MATCH(l_brief,l_details,l_ip_address,ad_username) AGAINST(:searchtext IN BOOLEAN MODE)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':searchtext',$searchtext2,PDO::PARAM_STR);
		$stmt->bindColumn('l_id',$id);
		$stmt->bindColumn('l_brief',$brief);
		$stmt->bindColumn('l_details',$details);
		$stmt->bindColumn('l_regdatetime',$datetime);
		$stmt->bindColumn('ad_id',$admin);
		$stmt->bindColumn('ad_username',$admin_username);
		$stmt->execute();
		$numRow = $stmt->rowCount();
	}else{ // if it the field is empty
		$sql = "SELECT l_id,l_brief,l_details,l_regdatetime,ad_id,ad_username FROM log_table ORDER BY l_id DESC LIMIT $start,$display";
		$stmt = $conn->prepare($sql);
		$stmt->bindColumn('l_id',$id);
		$stmt->bindColumn('l_brief',$brief);
		$stmt->bindColumn('l_details',$details);
		$stmt->bindColumn('l_regdatetime',$datetime);
		$stmt->bindColumn('ad_id',$admin);
		$stmt->bindColumn('ad_username',$admin_username);
		$stmt->execute();
		$numRow = $stmt->rowCount();
	}// end of if empty($searchtext)
	if($numRow > 0){		// if a record is found
		if(empty($searchtext)){$numRow = $total_records;}
		?>
		<center>
			<div class="j-responsive"style='line-height:27px;'>
				<p class="j-text-color5">
					<b><?=empty($searchtext)?$numRow.' Log(s)':$numRow." result(s) found for <span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in Logs";?></b>
				</p>
				<table class="j-table-all j-border-0">
					<tr class="j-border-0 j-text-color1">
						<td><b>S/N</b></td><td><b>Admin</b></td><td><b>Brief</b></td><td><b>Details</b></td><td><b>Date</b></td><td><b>Preview</b></td>
					</tr>
					<?php
					while($stmt->fetch()){
						?>
						<tr class="j-border-0">
							<td><?php s_n();?></td>
							<td><?=ucwords($admin_username);?></td>
							<td><?=ucfirst($brief)?></td>
							<td><?=ucfirst($admin_username).' '.text_length(($details),30,'dots');?></td>
							<td><?=showdate($datetime,'')?></td>
							<td><a href='<?= file_location('admin_url','log/preview_log/'.addnum($id))?>'><i class="j-large <?= icon('eye');?>"></i></a></td>
						</tr>
						<?php
					}// end of while
					preview_modal('log',1);
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
				<b><?=empty($searchtext)?'0 Log found':"0 result found for <b><span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in Log";?></b>
			</div>
		</center>
		<?php
	}// end of if $numRow
	
	require_once(file_location('admin_inc_path','pagination_button.inc.php'));
}// end of if isset
?>
<br><br><br><br>