<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
if(isset($_POST['s']) && isset($_POST['st']) && isset($_POST['pg'])){
	$searchtext = test_input(($_POST['s']));
	$status2 = ($_POST['st']);
	if($status2 === 'all'){$add = "ad_status != ''";}else{$add = "ad_status = '{$status2}'" ;}
	$cur_page = test_input(($_POST['pg']));
	require_once(file_location('admin_inc_path','pagination_total.inc.php'));
	
	if(!empty($searchtext)){ // if the search text is not empty
		$searchtext2 = $searchtext."*";
		$sql = "SELECT ad_id,ad_email,ad_username,ad_fullname,ad_level,ad_status FROM admin_table
		WHERE (MATCH(ad_email,ad_username,ad_fullname) AGAINST(:searchtext IN BOOLEAN MODE)) AND ad_id != 1 AND {$add}
		ORDER BY MATCH(ad_email,ad_username,ad_fullname) AGAINST(:searchtext IN BOOLEAN MODE)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':searchtext',$searchtext2,PDO::PARAM_STR);
	}else{ // if it the field is empty
		$sql = "SELECT ad_id,ad_email,ad_username,ad_fullname,ad_level,ad_status FROM admin_table WHERE ad_id != 1 AND {$add} ORDER BY ad_id DESC LIMIT $start,$display";
		$stmt = $conn->prepare($sql);
	}// end of if empty($searchtext)
	$stmt->bindColumn('ad_id',$id);
	$stmt->bindColumn('ad_email',$email);
	$stmt->bindColumn('ad_username',$username);
	$stmt->bindColumn('ad_fullname',$fullname);
	$stmt->bindColumn('ad_level',$level);
	$stmt->bindColumn('ad_status',$status);
	$stmt->execute();
	$numRow = $stmt->rowCount();
	if($numRow > 0){// if a record is found
		if(empty($searchtext)){$numRow = $total_records;}
		?>
		<center>
			<div class="j-responsive"style='line-height:27px;'>
				<p class="j-text-color5">
					<b><?=empty($searchtext)?$numRow.' Admin(s) found':$numRow." result(s) found for <span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in ".$status2." admins";?></b>
				</p>
				<table class="j-table-all j-border-0">
					<tr class="j-border-0 j-text-color1">
						<td><b>S/N</b></td><td><b>Name</b></td><td><b>Username</b></td><td><b>Email</b></td><td><b>Level</b></td>
						<?php if($status2 === 'all'){echo '<td><b>Status</b></td>';}?>
						<td><b>Preview</b></td><td><b>Delete</b></td>
					</tr>
					<?php
					while($stmt->fetch()){
						?>
						<tr class="j-border-0">
							<td><?php s_n();?></td><td><?=ucwords(($fullname))?></td><td><?=ucwords(($username))?></td></td><td><?=($email)?></td>
							</td><td><?=ucwords(check_level($level))?></td></td><?php if($status2 === 'all'){echo '<td>'.ucwords(($status)).'</td>';}?>
							<td><a href='<?= file_location('admin_url','admin/preview_admin/'.addnum($id))?>'><i class="j-large <?= icon('eye');?>"></i></a></td>
							<td><i class="j-large <?= icon('trash');?> j-clickable"onclick="$('#delete_admin<?=$id?>').fadeIn('slow');"></i></td>
						</tr>
						<?php
						preview_modal('admin',$id);
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
				<b><?=empty($searchtext)?"0 $status2 admin found":"0 result found for <b><span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in ".$status2." admin";?></b>
			</div>
		</center>
	<?php
	}// end of if $numRow
	
	require_once(file_location('admin_inc_path','pagination_button.inc.php'));
}
?>
<br><br><br><br>