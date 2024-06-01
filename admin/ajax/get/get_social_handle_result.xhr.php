<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
if(isset($_POST['s']) && isset($_POST['pg'])){
	$searchtext = test_input(($_POST['s']));
	$cur_page = test_input(($_POST['pg']));
	require_once(file_location('admin_inc_path','pagination_total.inc.php'));
	
	if(!empty($searchtext)){ // if the search text is not empty
		$searchtext2 = $searchtext."*";
		$sql = "SELECT s_id,s_name,s_icon,s_link FROM social_handle_table
		WHERE (MATCH(s_name) AGAINST(:searchtext IN BOOLEAN MODE))
		ORDER BY MATCH(s_name) AGAINST(:searchtext IN BOOLEAN MODE)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':searchtext',$searchtext2,PDO::PARAM_STR);
		$stmt->bindColumn('s_id',$id);
		$stmt->bindColumn('s_name',$name);
		$stmt->bindColumn('s_icon',$icon);
		$stmt->bindColumn('s_link',$link);
		$stmt->execute();
		$numRow = $stmt->rowCount();
	}else{ // if it the field is empty
		$sql = "SELECT s_id,s_name,s_icon,s_link FROM social_handle_table ORDER BY s_id DESC LIMIT $start,$display";
		$stmt = $conn->prepare($sql);
		$stmt->bindColumn('s_id',$id);
		$stmt->bindColumn('s_name',$name);
		$stmt->bindColumn('s_icon',$icon);
		$stmt->bindColumn('s_link',$link);
		$stmt->execute();
		$numRow = $stmt->rowCount();
	}// end of if empty($searchtext)
	if($numRow > 0){		// if a record is found
		if(empty($searchtext)){$numRow = $total_records;}
		?>
		<center>
			<div class="j-responsive"style='line-height:27px;'>
				<p class="j-text-color5">
					<b><?=empty($searchtext)?$numRow.' Social Handle(s)':$numRow." result(s) found for <span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in Social Handles";?></b>
				</p>
				<table class="j-table-all j-border-0">
					<tr class="j-border-0 j-text-color1">
						<td><b>S/N</b></td><td><b>Name</b></td><td><b>Icon</b></td><td><b>Link</b></td><td><b>Preview</b></td><td><b>Edit</b></td><td><b>Delete</b></td>
					</tr>
					<?php
					while($stmt->fetch()){
						?>
						<tr class="j-border-0">
							<td><?php s_n();?></td><td><?=ucwords(($name));?></td><td><i class="<?=icon($icon,'fab');?>"></i></td><td><?= text_length(($link),30,'dots');?></td>
							<td><a href='<?= file_location('admin_url','social_handle/preview_social_handle/'.addnum($id))?>'><i class="j-large <?= icon('eye');?>"></i></a></td>
							<td><a href='<?= file_location('admin_url','social_handle/update_social_handle/'.addnum($id))?>'><i class="j-large <?= icon('edit');?>"></i></a></td>
							<td><i class="j-large <?= icon('trash');?> j-clickable"onclick="$('#delete_social_handle<?=$id?>').fadeIn('slow');"></i></td>
						</tr>
						<?php
						preview_modal('social_handle',$id);
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
				<b><?=empty($searchtext)?'0 Social Handle found':"0 result found for <b><span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in Social Handle";?></b>
			</div>
		</center>
		<?php
	}// end of if $numRow
	
	require_once(file_location('admin_inc_path','pagination_button.inc.php'));
}// end of if isset
?>
<br><br><br><br>