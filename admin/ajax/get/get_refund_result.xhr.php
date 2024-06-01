<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
if(isset($_POST['s']) && isset($_POST['st']) && isset($_POST['pg'])){
	$searchtext = test_input(($_POST['s']));
	$status2 = ($_POST['st']);
	if($status2 === 'pending refund'){
		$new_url = 'pending_refund';
		$add = "AND or_refund = 'no' AND or_status IN ('failed','cancelled','returned','failed delivery')";
	}else{
		$new_url = 'refund';
		$add = "";
	}
	$cur_page = test_input(($_POST['pg']));
	require_once(file_location('admin_inc_path','pagination_total.inc.php'));
	if($status2 === 'pending refund'){
		if(!empty($searchtext)){ // if the search text is not empty
			$searchtext = $searchtext."*";
			$sql = "SELECT or_id,or_amount,or_delivery_fee,or_order_id,or_pmt_regdatetime FROM order_table
			WHERE (MATCH(or_order_id,or_token) AGAINST(:searchtext IN BOOLEAN MODE)) AND or_payment_received = 'yes' {$add}
			ORDER BY MATCH(or_order_id,or_token) AGAINST(:searchtext IN BOOLEAN MODE)";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':searchtext',$searchtext,PDO::PARAM_STR);
		}else{ // if it the field is empty
			$sql = "SELECT or_id,or_amount,or_delivery_fee,or_order_id,or_payment_method,or_pmt_regdatetime FROM order_table
			WHERE or_payment_received = 'yes' {$add} ORDER BY or_pmt_regdatetime DESC LIMIT $start,$display";
			$stmt = $conn->prepare($sql);
		}// end of if empty($searchtext)
		$stmt->bindColumn('or_id',$id);
		$stmt->bindColumn('or_amount',$amount);
		$stmt->bindColumn('or_delivery_fee',$delivery_fee);
		$stmt->bindColumn('or_order_id',$order_id);
		$stmt->bindColumn('or_payment_method',$payment_method);
		$stmt->bindColumn('or_pmt_regdatetime',$datetime);
		$stmt->execute();
		$numRow = $stmt->rowCount();
		if($numRow > 0){// if a record is found
			if(empty($searchtext)){$numRow = $total_records;}
			?>
			<center>
				<div class="j-responsive"style='line-height:27px;'>
					<p class="j-text-color5">
						<b><?=empty($searchtext)?$numRow.' Pending Status found':$numRow." result(s) found for <span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in ".$status2;?></b>
					</p>
					<table class="j-table-all j-border-0">
						<tr class="j-border-0 j-text-color1">
							<td><b>S/N</b></td>
							<td><b>Order Id</b></td>
							<td><b>Total Amount</b></td>
							<td><b>Order Amount</b></td>
							<td><b>Delivery Amount</b></td>
							<?php if($status2 === 'all'){?><td><b>Payment Method</b></td><?php } ?>
							<td><b>Date</b></td>
							<td><b>Order Page</b></td>
						</tr>
						<?php
						while($stmt->fetch()){
							?>
							<tr class="j-border-0">
								<td><?php s_n();?></td><td><?=$order_id;?></td>
								<td><b><?=get_json_data('currency_symbol','about_us').' '.add_total($amount,$delivery_fee)?></b></td>
								<td><b><?=get_json_data('currency_symbol','about_us').' '.$amount?></b></td>
								<td><b><?=get_json_data('currency_symbol','about_us').' '.$delivery_fee?></b></td>
								<?php if($status2 === 'all'){?><td><?=$payment_method?></td><?php } ?>
								<td><?=showdate($datetime,'')?></td>
								<td><a href='<?= file_location('admin_url','order/preview_order/'.($order_id))?>'><i class="j-large <?= icon('eye');?>"></i></a></td>
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
					<b><?=empty($searchtext)?"0 $status2 transaction found":"0 result found for <b><span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in ".$status2." message";?></b>
				</div>
			</center>
			<?php
		}// end of if $numRow
	}else{
		if(!empty($searchtext)){ // if the search text is not empty
			$searchtext = $searchtext."*";
			$sql = "SELECT r_id,r_amount,r_regdatetime,or_order_id,user_id FROM refund_table
			WHERE (MATCH(or_order_id) AGAINST(:searchtext IN BOOLEAN MODE))
			ORDER BY MATCH(or_order_id) AGAINST(:searchtext IN BOOLEAN MODE)";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':searchtext',$searchtext,PDO::PARAM_STR);
		}else{ // if it the field is empty
			$sql = $sql = "SELECT r_id,r_amount,r_regdatetime,or_order_id,user_id FROM refund_table
			ORDER BY r_regdatetime DESC LIMIT $start,$display";
			$stmt = $conn->prepare($sql);
		}// end of if empty($searchtext)
		$stmt->bindColumn('r_id',$id);
		$stmt->bindColumn('r_amount',$amount);
		$stmt->bindColumn('or_order_id',$order_id);
		$stmt->bindColumn('r_regdatetime',$datetime);
		$stmt->bindColumn('user_id',$user_id);
		$stmt->execute();
		$numRow = $stmt->rowCount();
		if($numRow > 0){// if a record is found
			if(empty($searchtext)){$numRow = $total_records;}
			?>
			<center>
				<div class="j-responsive"style='line-height:27px;'>
					<p class="j-text-color5">
						<b><?=empty($searchtext)?$numRow.' Refund(s) found':$numRow." result(s) found for <span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in ".$status2;?></b>
					</p>
					<table class="j-table-all j-border-0">
						<tr class="j-border-0 j-text-color1">
							<td><b>S/N</b></td>
							<td><b>Order Id</b></td>
							<td><b>Amount</b></td>
							<td><b>Date</b></td>
							<td><b>Preview</b></td>
						</tr>
						<?php
						while($stmt->fetch()){
							?>
							<tr class="j-border-0">
								<td><?php s_n();?></td>
								<td><?=$order_id;?></td>
								<td><b><?=get_json_data('currency_symbol','about_us').' '.$amount?></b></td>
								<td><?=showdate($datetime,'')?></td>
								<td><a href='<?= file_location('admin_url','refund/preview_refund/'.($order_id))?>'><i class="j-large <?= icon('eye');?>"></i></a></td>
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
					<b><?=empty($searchtext)?"0 $status2 found":"0 result found for <b><span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in ".$status2;?></b>
				</div>
			</center>
			<?php
		}// end of if $numRow
	}
	require_once(file_location('admin_inc_path','pagination_button.inc.php'));
}// end of if isset
?>
<br><br><br><br>