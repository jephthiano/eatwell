<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
if(isset($_POST['s']) && isset($_POST['pg'])){
	$searchtext = test_input(($_POST['s']));
	$cur_page = test_input(($_POST['pg']));
	require_once(file_location('admin_inc_path','pagination_total.inc.php'));
	
	if(!empty($searchtext)){ // if the search text is not empty
		$searchtext = $searchtext."*";
		$sql = "SELECT c_id,c_icon,c_category FROM category_table
		WHERE (MATCH(c_category) AGAINST(:searchtext IN BOOLEAN MODE))
		ORDER BY MATCH(c_category) AGAINST(:searchtext IN BOOLEAN MODE)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':searchtext',$searchtext,PDO::PARAM_STR);
	}else{ // if it the field is empty
		$sql = "SELECT c_id,c_icon,c_category FROM category_table ORDER BY c_id DESC LIMIT $start,$display";
		$stmt = $conn->prepare($sql);
	}// end of if empty($searchtext)
	$stmt->bindColumn('c_id',$id);
	$stmt->bindColumn('c_icon',$icon);
	$stmt->bindColumn('c_category',$c_category);
	$stmt->execute();
	$numRow = $stmt->rowCount();
	if($numRow > 0){// if a record is found
		if(empty($searchtext)){$numRow = $total_records;}
		?>
		<center>
			<div class="j-responsive"style='line-height:27px;'>
				<p class="j-text-color5">
					<b><?=empty($searchtext)?$numRow.' Category found':$numRow." result(s) found for <span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in category";?></b>
				</p>
				<table class="j-table-all j-border-0">
					<tr class="j-border-0 j-text-color1">
						<td><b>S/N</b></td><td><b>Category</b></td><td><b>Image</b></td><td><b>Icon</b></td><td><b>Preview</b></td>
						<?php if($adlevel > 1){ ?>
						<td><b>Edit</b></td><td><b>Delete</b></td>
						<?php } ?>
					</tr>
					<?php
					while($stmt->fetch()){
						?>
						<tr class="j-border-0">
							<td><?php s_n();?></td><td><?=ucwords(($c_category));?></td>
							<td><img class='j-round'src="<?=file_location('media_url',get_media('category',$id))?>"style='width:30px;height:30px;'/></td>
							<td><i class="<?=icon($icon);?>"></i></td>
							<td><a href='<?= file_location('admin_url','category/preview_category/'.addnum($id))?>'><i class="<?= icon('eye');?>"></i></a></td>
							<?php if($adlevel > 1){ ?>
							<td><a href='<?= file_location('admin_url','category/update_category/'.addnum($id))?>'><i class="j-large <?= icon('edit');?>"></i></a></td>
							<td><i class="j-large <?= icon('trash');?> j-clickable"onclick="$('#delete_category<?=$id?>').fadeIn('slow');"></i></td>
							<?php } ?>
						</tr>
						<?php
						preview_modal('category',$id);
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
				<b><?=empty($searchtext)?"0 category found":"0 result found for <b><span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in category";?></b>
			</div>
		</center>
			<?php
		}// end of if $numRow
		
		require_once(file_location('admin_inc_path','pagination_button.inc.php'));
}// end of if isset
?>
<br><br><br><br>