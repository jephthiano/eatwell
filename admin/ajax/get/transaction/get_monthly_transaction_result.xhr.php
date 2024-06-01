<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
if(isset($_POST['st']) && isset($_POST['pg'])){
	$cur_page = test_input(($_POST['pg']));
	$status2 = test_input($_POST['st']);
	if($status2 === 'all'){
		$add = "WHERE or_payment_received = 'yes'";
	}else{
		$add = "WHERE or_pmt_month = '{$status2}' AND or_payment_received = 'yes'";
		$board = 'per_month';//for dashboard
		require_once(file_location('admin_inc_path','transaction_dashboard.inc.php'));
	}
	require_once(file_location('admin_inc_path','pagination_total.inc.php'));
	if($status2 === 'all'){
		$sql = "SELECT DISTINCT or_pmt_month FROM order_table {$add} ORDER BY or_pmt_regdatetime DESC LIMIT $start,$display";
	}else{
		$sql = "SELECT DISTINCT or_pmt_date FROM order_table {$add} ORDER BY or_pmt_regdatetime DESC LIMIT $start,$display";
	}
	$stmt = $conn->prepare($sql);
	if($status2 === 'all'){$stmt->bindColumn('or_pmt_month',$month);}else{$stmt->bindColumn('or_pmt_date',$date);}
	$stmt->execute();
	$numRow = $stmt->rowCount();
	if($status2 !== 'all'){
		?>
		<?php //next and previous ?>
		<div class='j-container'>
			<a href="<?= file_location('admin_url','transaction/monthly/'.process_month('previous',$status2).'/')?>">
			<span class='j-color1 j-text-color4 j-round j-btn j-left'>PREVIOUS</span>
			</a>
			<?php
			if(strtotime($status2) < strtotime(date("Y-m"))){
				?>
				<a href="<?= file_location('admin_url','transaction/monthly/'.process_month('next',$status2).'/')?>">
				<span class='j-color1 j-text-color4 j-round j-btn j-right'>NEXT</span>
				</a>
				<?php
			}
			?>
		</div><br>
		<?php
	}
	if($numRow > 0){// if a record is found
		?>
		<center>
			<div class="j-responsive"style='line-height:27px;'>
				<table class="j-table-all j-border-0">
					<tr class="j-border-0 j-text-color1">
						<td><b>S/N</b></td>
						<td><b><?=$status2==='all'?'Months':'Days'?></b></td>
						<td><b>Total Amount</b></td>
						<td><b>Order Amount</b></td>
						<td><b>Delivery Amount</b></td>
						<td><b>Preview</b></td>
					</tr>
					<?php
					while($stmt->fetch()){
						if($status2 === 'all'){
							$amount = paid_sum('or_amount','or_pmt_month',$month);
							$delivery_fee = paid_sum('or_delivery_fee','or_pmt_month',$month);
							?>
							<tr class="j-border-0">
								<td><?php s_n();?></td><td><?= strtoupper(show_date($month,'month'));?></td>
								<td><b><?=get_json_data('currency_symbol','about_us').' '.add_total($amount,$delivery_fee)?></b></td>
								<td><b><?=get_json_data('currency_symbol','about_us').' '.$amount?></b></td>
								<td><b><?=get_json_data('currency_symbol','about_us').' '.$delivery_fee?></b></td>
								<td><a href='<?= file_location('admin_url','transaction/monthly/'.$month.'/')?>'><i class="j-large <?= icon('eye');?>"></i></a></td>
							</tr>
							<?php
						}else{
							$amount = paid_sum('or_amount','or_pmt_date',$date);
							$delivery_fee = paid_sum('or_delivery_fee','or_pmt_date',$date);
							?>
							<tr class="j-border-0">
								<td><?php s_n();?></td><td><?= strtoupper(show_date($date));?></td>
								<td><b><?=get_json_data('currency_symbol','about_us').' '.add_total($amount,$delivery_fee)?></b></td>
								<td><b><?=get_json_data('currency_symbol','about_us').' '.$amount?></b></td>
								<td><b><?=get_json_data('currency_symbol','about_us').' '.$delivery_fee?></b></td>
								<td><a href='<?= file_location('admin_url','transaction/daily/'.$date.'/')?>'><i class="j-large <?= icon('eye');?>"></i></a></td>
							</tr>
							<?php
						}
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
				<b>No Transaction Data Available</b>
			</div>
		</center>
			<?php
		}// end of if $numRow
		require_once(file_location('admin_inc_path','pagination_button.inc.php'));
}// end of if isset
?>
<br><br><br><br>