<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','transaction/stats/');
require_once(file_location('admin_inc_path','session_check.inc.php'));
if($adlevel < 3){trigger_error_manual(404);}
$page = "TRANSACTIONS STATISTICS";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(file_location('inc_path','meta.inc.php'));?>		
<title><?=$page_name?></title>
</head>
<body class="j-color6"style="font-family:Roboto,sans-serif;width:100%;"onload="">
<?php require_once(file_location('inc_path','page_load.inc.php')); //page load?>
<!-- BODY STARTS-->
<div class="j-row">
	<div class="j-col s12 l2 j-hide-small j-hide-medium">
		<?php require_once(file_location('admin_inc_path','first_column.inc.php'));?>
	</div>
	<div class="j-col s12 l10"id='mainbody'>
		<?php require(file_location('admin_inc_path','navigation.inc.php'));?>
		<div id="maincol">
			<div class='j-padding'>
				<h2 class='j-text-color1 j-padding j-color4'><b>TRANSACTION STATISTICS</b></h2>
				
				<div class='j-color5'><div class='j-padding j-large'><b>All Time Statistics</b></div></div>
				<div class='j-container j-color4 j-padding'>
					<?php
					$total_amount = paid_sum('or_amount');
					$total_delivery_fee = paid_sum('or_delivery_fee');
					$total_expected = amount_sum('t_status','success');
					$total_generated = add_total($total_amount,$total_delivery_fee);
					$total_refunded = refund_sum();
					$total_revenue = get_revenue($total_generated,$total_refunded);
					$total_pod = paid_sum('or_amount','or_payment_method','payment on delivery');
					$total_card = paid_sum('or_amount','or_payment_method','card payment');
					?>
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
				
				<div class='j-color2'><div class='j-padding j-large'><b>This Year Statistics</b></div></div>
				<div class='j-container j-color4 j-padding'>
					<?php
					$this_year = date("Y");
					$total_amount = paid_sum('or_amount','or_pmt_year',$this_year);
					$total_delivery_fee = paid_sum('or_delivery_fee','or_pmt_year',$this_year);
					$total_expected = amount_sum('t_year',$this_year,"AND t_status = 'success'");
					$total_generated = add_total($total_amount,$total_delivery_fee);
					$total_refunded = refund_sum('r_year',$this_year);
					$total_revenue = get_revenue($total_generated,$total_refunded);
					$total_pod = paid_sum('or_amount','or_pmt_year',$this_year,"AND or_payment_method = 'payment on delivery'");
					$total_card = paid_sum('or_amount','or_pmt_year',$this_year,"AND or_payment_method = 'card payment'");
					?>
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
				
				<div class='j-color3'><div class='j-padding j-large'><b>This Month Statistics</b></div></div>
				<div class='j-container j-color4 j-padding'>
					<?php
					$this_month = date("Y-m");
					$total_amount = paid_sum('or_amount','or_pmt_month',$this_month);
					$total_delivery_fee = paid_sum('or_delivery_fee','or_pmt_month',$this_month);
					$total_expected = amount_sum('t_month',$this_month,"AND t_status = 'success'");
					$total_generated = add_total($total_amount,$total_delivery_fee);
					$total_refunded = refund_sum('r_month',$this_month);
					$total_revenue = get_revenue($total_generated,$total_refunded);
					$total_pod = paid_sum('or_amount','or_pmt_month',$this_month,"AND or_payment_method = 'payment on delivery'");
					$total_card = paid_sum('or_amount','or_pmt_month',$this_month,"AND or_payment_method = 'card payment'");
					?>
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
				
				<div class='j-color7'><div class='j-padding j-large'><b>Today Statistics</b></div></div>
				<div class='j-container j-color4 j-padding'>
					<?php
					$today = date("Y-m-d"); //process_day();
					$total_amount = paid_sum('or_amount','or_pmt_date',$today);
					$total_delivery_fee = paid_sum('or_delivery_fee','or_pmt_date',$today);
					$total_expected = amount_sum('t_date',$today,"AND t_status = 'success'");
					$total_generated = add_total($total_amount,$total_delivery_fee);
					$total_refunded = refund_sum('r_date',$today);
					$total_revenue = get_revenue($total_generated,$total_refunded);
					$total_pod = paid_sum('or_amount','or_pmt_date',$today,"AND or_payment_method = 'payment on delivery'");
					$total_card = paid_sum('or_amount','or_pmt_date',$today,"AND or_payment_method = 'card payment'");
					?>
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
				
			</div>
			<span id="st"></span>
		</div>
	</div>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>