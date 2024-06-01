<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
if(isset($_POST['s']) && isset($_POST['st']) && isset($_POST['pg'])){
	$searchtext = test_input(($_POST['s']));
	$status2 = test_input($_POST['st']);
	if($status2 === 'all'){$add = "AND or_status != 'cart'";}else{$add = "AND or_status = '{$status2}'" ;}
	$cur_page = test_input(($_POST['pg']));
	require_once(file_location('admin_inc_path','pagination_total.inc.php'));
	
	if(!empty($searchtext)){ // if the search text is not empty
		$searchtext = $searchtext."*";
		$sql = "SELECT f_id,or_id,or_token,or_order_id,or_status,or_regdatetime FROM order_table
		WHERE (MATCH(or_order_id,or_token) AGAINST(:searchtext IN BOOLEAN MODE)) {$add}
		ORDER BY MATCH(or_order_id,or_token) AGAINST(:searchtext IN BOOLEAN MODE)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':searchtext',$searchtext,PDO::PARAM_STR);
	}else{ // if it the field is empty
		$sql = "SELECT f_id,or_id,or_token,or_order_id,or_status,or_regdatetime FROM order_table WHERE or_id != 'NULL' {$add} ORDER BY or_id DESC LIMIT $start,$display";
		$stmt = $conn->prepare($sql);
	}// end of if empty($searchtext)
	$stmt->bindColumn('f_id',$f_id);
	$stmt->bindColumn('or_id',$id);
	$stmt->bindColumn('or_token',$token);
	$stmt->bindColumn('or_order_id',$order_id);
	$stmt->bindColumn('or_status',$or_status);
	$stmt->bindColumn('or_regdatetime',$regdatetime);
	$stmt->execute();
	$numRow = $stmt->rowCount();
	if($numRow > 0){// if a record is found
		if(empty($searchtext)){$numRow = $total_records;}
		?>
		<center>
			<div class="j-responsive"style='line-height:27px;'>
				<p class="j-text-color5">
					<b><?=empty($searchtext)?$numRow.' Order(s) found':$numRow." result(s) found for <span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in ".$status2." orders";?></b>
				</p>
				<table class="j-table-all j-border-0">
					<tr class="j-border-0 j-text-color1">
						<td><b>S/N</b></td><td><b>Token</b></td><td><b>Order ID</b></td>
						<?php if($status2 === 'all'){?> <td><b>Status</b></td><?php }?>
						<td><b>Food Name</b></td><td><b>Food Image</b></td>
						<td><b>Ordered Time</b></td><td><b>Preview</b></td>
					</tr>
					<?php
					while($stmt->fetch()){
						$fm_id = content_data('food_media_table','fm_id',$f_id,'f_id','','null');
						$quantity = get_numrow('order_table','or_token',$token,"return",'no round',"AND or_status != 'cart'");
						if($quantity > 1){$url = "preview_orders/{$token}";}else{$url = "preview_order/{$order_id}";}
						$placed_time = content_data('order_history_table','oh_regdatetime',$id,'or_id','','null');
						?>
						<tr class="j-border-0">
							<td><?php s_n();?></td>
							<td><?=$token?></td><td><?=ucwords($order_id)?></td>
							<?php if($status2 === 'all'){?><td><?=ucwords($or_status)?></td><?php }?>
							<td><?=ucwords(text_length(content_data('food_table','f_name',$f_id,'f_id'),20,'dots'));?></td>
							<td><img class='j-round'src="<?=file_location('media_url',get_media('food',$fm_id))?>"style='width:50px;height:50px;'/></td>
							<td><?=showdate($placed_time)?></td>
							<td><a href='<?= file_location('admin_url',"order/{$url}")?>'><i class="<?= icon('eye');?>"></i></a></td>
						</tr>
						<?php
					}// end of while+
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
				<b><?=empty($searchtext)?"0 $status2 order found":"0 result found for <b><span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in ".$status2." order";?></b>
			</div>
		</center>
			<?php
		}// end of if $numRow
		
		require_once(file_location('admin_inc_path','pagination_button.inc.php'));
}// end of if isset
?>
<br><br><br><br>