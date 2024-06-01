<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
if(isset($_POST['s']) && isset($_POST['st']) && isset($_POST['pg'])){
	$searchtext = test_input(($_POST['s']));
	$status2 = test_input($_POST['st']);
	$cur_page = test_input(($_POST['pg']));
	if($status2 === 'all'){
		$add = "";
	}elseif($status2 === 'suspended'){
		$add = "AND u_status = 'suspended'";	
	}elseif($status2 === 'pod_disabled'){
		$add = "AND u_pod = 'disabled'";	
	}
	require_once(file_location('admin_inc_path','pagination_total.inc.php'));
	if(!empty($searchtext)){ // if the search text is not empty
		$searchtext = $searchtext."*";
		$sql = "SELECT u_id,u_fullname,u_email,u_status,u_pod FROM user_table
		WHERE (MATCH(u_email,u_fullname) AGAINST(:searchtext IN BOOLEAN MODE)) {$add}
		ORDER BY MATCH(u_email,u_fullname) AGAINST(:searchtext IN BOOLEAN MODE)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':searchtext',$searchtext,PDO::PARAM_STR);
	}else{ // if it the field is empty
		$sql = "SELECT u_id,u_fullname,u_email,u_status,u_pod FROM user_table WHERE u_id != 'NULL' {$add} ORDER BY u_id DESC LIMIT $start,$display";
		$stmt = $conn->prepare($sql);
	}// end of if empty($searchtext)
	$stmt->bindColumn('u_id',$id);
	$stmt->bindColumn('u_fullname',$fullname);
	$stmt->bindColumn('u_email',$email);
	$stmt->bindColumn('u_status',$status);
	$stmt->bindColumn('u_pod',$pod);
	$stmt->execute();
	$numRow = $stmt->rowCount();
	if($numRow > 0){// if a record is found
		if(empty($searchtext)){$numRow = $total_records;}
		?>
		<center>
			<div class="j-responsive"style='line-height:27px;'>
				<p class="j-text-color5">
					<b><?=empty($searchtext)?$numRow.' User(s) found':$numRow." result(s) found for <span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in ".$status2." users";?></b>
				</p>
				<table class="j-table-all j-border-0">
					<tr class="j-border-0 j-text-color1">
						<td><b>S/N</b></td><td><b>Fullname</b></td><td><b>Email</b></td><td><b>Status</b></td><td><b>POD</b></td><td><b>Preview</b></td>
					</tr>
					<?php
					while($stmt->fetch()){
						?>
						<tr class="j-border-0">
							<td><?php s_n();?></td><td><?=ucwords(($fullname));?></td>
							<td><?=$email?></td><td><?=($status)?></td><td><?=$pod?></td>
							<td><a href='<?= file_location('admin_url','user/preview_user/'.addnum($id))?>'><i class=" j-large <?= icon('eye');?>"></i></a></td>
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
				<b><?=empty($searchtext)?"0 $status2 user found":"0 result found for <b><span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in ".$status2." user";?></b>
			</div>
		</center>
			<?php
		}// end of if $numRow
		
		require_once(file_location('admin_inc_path','pagination_button.inc.php'));
}// end of if isset
?>
<br><br><br><br>