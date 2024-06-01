<?php
if($board === 'all_time'){
  $total_amount = paid_sum('or_amount');
			$total_delivery_fee = paid_sum('or_delivery_fee');;
			$total_expected = amount_sum('t_status','success');
			$total_generated = add_total($total_amount,$total_delivery_fee);
			$total_refunded = refund_sum();
			$total_revenue = get_revenue($total_generated,$total_refunded);
			$total_pod = paid_sum('or_amount','or_payment_method','payment on delivery');
			$total_card = paid_sum('or_amount','or_payment_method','card payment');
			?>
      <div class='j-color5'><div class='j-padding j-large'><b>All Time Summary</b></div></div>
			<div class='j-container j-color4 j-padding'>
				<div class='j-container j-padding'>
					<div class='j-row'>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Amt. Expected: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_expected?>)</span>
						</span>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Amt. Generated: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_generated?>)</span>
						</span>
					</div>
				</div>
				<div class='j-container j-padding'>
					<div class='j-row'>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Amt. Refunded: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_refunded?>)</span>
						</span>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Amt. of Revenue: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_revenue?>)</span>
						</span>
					</div>
				</div>
				<div class='j-container j-padding'>
					<div class='j-row'>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Order Amt.: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_amount?>)</span>
						</span>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Delivery Amt.: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_delivery_fee?>)</span>
						</span>
					</div>
				</div>
				<div class='j-container j-padding'>
					<div class='j-row'>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Card Trans: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_card?>)</span>
						</span>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total POD Trans: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_pod?>)</span>
						</span>
					</div>
				</div>
			</div>
			<br>
			<?php
}elseif($board === 'per_year'){
  $total_amount = paid_sum('or_amount','or_pmt_year',$status2);
			$total_delivery_fee = paid_sum('or_delivery_fee','or_pmt_year',$status2);
			$total_expected = amount_sum('t_year',$status2,"AND t_status = 'success'");
			$total_generated = add_total($total_amount,$total_delivery_fee);
			$total_refunded = refund_sum('r_year',$status2);
			$total_revenue = get_revenue($total_generated,$total_refunded);
			$total_pod = paid_sum('or_amount','or_pmt_year',$status2,"AND or_payment_method = 'payment on delivery'");
			$total_card = paid_sum('or_amount','or_pmt_year',$status2,"AND or_payment_method = 'card payment'");
			?>
      <div class='j-color5'><div class='j-padding j-large'><b>Summary For <?=$status2?></b></div></div>
			<div class='j-container j-color4 j-padding'>
				<div class='j-container j-padding'>
					<div class='j-row'>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Amt. Expected: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_expected?>)</span>
						</span>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Amt. Generated: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_generated?>)</span>
						</span>
					</div>
				</div>
				<div class='j-container j-padding'>
					<div class='j-row'>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Amt. Refunded: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_refunded?>)</span>
						</span>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Amt. of Revenue: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_revenue?>)</span>
						</span>
					</div>
				</div>
				<div class='j-container j-padding'>
					<div class='j-row'>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Order Amt.: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_amount?>)</span>
						</span>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Delivery Amt.: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_delivery_fee?>)</span>
						</span>
					</div>
				</div>
				<div class='j-container j-padding'>
					<div class='j-row'>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Card Trans: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_card?>)</span>
						</span>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total POD Trans: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_pod?>)</span>
						</span>
					</div>
				</div>
			</div>
			<br>
			<?php
}elseif($board === 'per_month'){
  $total_amount = paid_sum('or_amount','or_pmt_month',$status2);
			$total_delivery_fee = paid_sum('or_delivery_fee','or_pmt_month',$status2);
			$total_expected = amount_sum('t_month',$status2,"AND t_status = 'success'");
			$total_generated = add_total($total_amount,$total_delivery_fee);
			$total_refunded = refund_sum('r_month',$status2);
			$total_revenue = get_revenue($total_generated,$total_refunded);
			$total_pod = paid_sum('or_amount','or_pmt_month',$status2,"AND or_payment_method = 'payment on delivery'");
			$total_card = paid_sum('or_amount','or_pmt_month',$status2,"AND or_payment_method = 'card payment'");
			?>
			<?php //dashboard ?>
      <div class='j-color5'><div class='j-padding j-large'><b>Summary For <?=show_date($status2,'month')?></b></div></div>
			<div class='j-container j-color4 j-padding'>
				<div class='j-container j-padding'>
					<div class='j-row'>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Amt. Expected: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_expected?>)</span>
						</span>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Amt. Generated: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_generated?>)</span>
						</span>
					</div>
				</div>
				<div class='j-container j-padding'>
					<div class='j-row'>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Amt. Refunded: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_refunded?>)</span>
						</span>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Amt. of Revenue: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_revenue?>)</span>
						</span>
					</div>
				</div>
				<div class='j-container j-padding'>
					<div class='j-row'>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Order Amt.: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_amount?>)</span>
						</span>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Delivery Amt.: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_delivery_fee?>)</span>
						</span>
					</div>
				</div>
				<div class='j-container j-padding'>
					<div class='j-row'>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Card Trans: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_card?>)</span>
						</span>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total POD Trans: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_pod?>)</span>
						</span>
					</div>
				</div>
			</div>
			<br>
			<?php
}elseif($board === 'per_day'){
  $total_amount = paid_sum('or_amount','or_pmt_date',$status2);
			$total_delivery_fee = paid_sum('or_delivery_fee','or_pmt_date',$status2);
			$total_expected = amount_sum('t_date',$status2,"AND t_status = 'success'");
			$total_generated = add_total($total_amount,$total_delivery_fee);
			$total_refunded = refund_sum('r_date',$status2);
			$total_revenue = get_revenue($total_generated,$total_refunded);
			$total_pod = paid_sum('or_amount','or_pmt_date',$status2,"AND or_payment_method = 'payment on delivery'");
			$total_card = paid_sum('or_amount','or_pmt_date',$status2,"AND or_payment_method = 'card payment'");
			?>
			<?php //dashboard ?>
      <div class='j-color5'><div class='j-padding j-large'><b>Summary For <?=show_date($status2)?></b></div></div>
			<div class='j-container j-color4 j-padding'>
				<div class='j-container j-padding'>
					<div class='j-row'>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Amt. Expected: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_expected?>)</span>
						</span>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Amt. Generated: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_generated?>)</span>
						</span>
					</div>
				</div>
				<div class='j-container j-padding'>
					<div class='j-row'>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Amt. Refunded: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_refunded?>)</span>
						</span>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Amt. of Revenue: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_revenue?>)</span>
						</span>
					</div>
				</div>
				<div class='j-container j-padding'>
					<div class='j-row'>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Order Amt.: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_amount?>)</span>
						</span>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Delivery Amt.: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_delivery_fee?>)</span>
						</span>
					</div>
				</div>
				<div class='j-container j-padding'>
					<div class='j-row'>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total Card Trans: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_card?>)</span>
						</span>
						<span class='j-col m6'>
							<span class='j-text-color5 j-bolder'>Total POD Trans: </span>
							<span class='j-text-color1 j-bolder'>(<?=get_json_data('currency_symbol','about_us').' '.$total_pod?>)</span>
						</span>
					</div>
				</div>
			</div>
			<br>
			<?php
}
?>