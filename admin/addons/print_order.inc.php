<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
//for meta
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page = "SALES INVOICE";
$page_name = $page;
$page_url = file_location('home_url','');
$keywords = 'Eatwell';
$description = ucwords(get_xml_data('company_name'))." Home | Order Foods and Get it Delivered to Your Doorstep";
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<?php
//$order_id = content_data('order_table','or_order_id',$or_id,'or_id');
//$user_id = content_data('order_table','user_id',$or_id,'or_id');
//$token = content_data('order_table','or_token',$or_id,'or_id');
//$delivery_method = content_data('order_table','or_delivery_method',$or_id,'or_id');
//$uc_id = content_data('orderer_table','uc_id',$token,'or_token');
//$f_id = content_data('order_table','f_id',$or_id,'or_id');
//$item_fee = content_data('order_table','or_amount',$or_id,'or_id');
//$delivery_fee = content_data('order_table','or_delivery_fee',$or_id,'or_id');
//$total_fee = $item_fee + $delivery_fee;
$customer_name = content_data('user_table','u_fullname',$user_id,'u_id');
$payment_method = content_data('order_table','or_payment_method',$or_id,'or_id');
$food_name = content_data('food_table','f_name',$f_id,'f_id');
$qty = content_data('order_table','or_quantity',$or_id,'or_id');
?>
<body id="body"class="j-color4"style="font-family:Roboto,sans-serif;">
	<? //header ?>
	<div style=''>
		<b>SALES INVOICE (CUSTOMER COPY)</b>
	</div>
	<br>
	<? //letter?>
	<div style=''>
		<div><b>Dear <?=ucwords($customer_name)?></b></div>
		<div>
			Thanks for shopping with us at <b><?=ucwords(get_xml_data('company_name'))?></b>. If part of your items has been delivered, be rest assured that the
			remaining will be delivered as soon as possible.<br>
			We apprecaite your effort in shopping with us. Thanks once again.<br><br>
			Yours Sincerely,<br>
			<b><?=ucwords(get_xml_data('company_name'))?></b> Team.
		</div>
	</div>
	<br>
	<? //customer/delivery details ?>
	<div style=''>
		<b>CUSTOMER/DELIVERY DETAILS</b>
		<div style='border:solid 1px black;padding:8px;'>
			<div><span><b>Delivery Method :</b></span> <span><?=ucwords($delivery_method)?></span></div>
			<?php
			if($delivery_method === 'door delivery'){
				?><div><?php get_contact_detail($uc_id)?></div><?php
			}else{
				?><div><b><?=ucwords($customer_name)?></b></div><?php
			}
			?>
		</div>
	</div>
	<br>
	<? //order summary ?>
	<div style=''>
		<b>ORDER SUMMARY</b>
		<div style='border:solid 1px black;padding:8px;'>
			<div><span><b>Order Id :</b></span> <span><?=$order_id?></span></div>
			<div>
				<span><b>Payable Amount :</b></span>
				<span>
					<b>
					<?=get_json_data('currency_symbol','about_us')?>
					<?php if($payment_method === 'payment on delivery'){echo $total_fee;}else{?>0.00<?php }?>
					</b>
				</span>
			</div>
		</div>
	</div>
	<br>
	<? //order details ?>
	<div style=''>
		<b>ORDER DETAILS</b>
		<div style='border:solid 1px black;padding:8px;'>
			<div style='padding-bottom:8px;'>
				<b>
					<div style='width:5%;display:inline-block;vertical-align:top;padding-right:4px;'>Qty</div>
					<div style='width:30%;display:inline-block;vertical-align:top;padding-right:4px;'>Product Name </div>
					<div style='width:20%;display:inline-block;vertical-align:top;padding-right:4px;'>Item Price</div>
					<div style='display:inline-block;vertical-align:top;'>Total (+ Shipping Fee)</div>
				</b>
			</div>
			<div>
				<div style='width:5%;display:inline-block;vertical-align:top;padding-right:4px;'><?=$qty?></div>
				<div style='width:30%;display:inline-block;vertical-align:top;padding-right:4px;'><?=ucwords($food_name)?></div>
				<div style='width:20%;display:inline-block;vertical-align:top;padding-right:4px;'><?=get_json_data('currency_symbol','about_us').' '.$item_fee?></div>
				<div style='display:inline-block;vertical-align:top;'><?=get_json_data('currency_symbol','about_us').' '.$total_fee?></div>
			</div>
		</div>
	</div>
	<? //cut section ?>
	<div style=''>
		<div style='padding:16px;'>
			<center>
				<b>
					<span>..................................................................</span>
					<span style='padding:9px;position: relative;top:4px;'>CUT HERE</span>
					<span>..................................................................</span>
				</b>
			</center>
		</div>
		<div style='margin-top:8px;'><b>FOR RETURN ONLY</b></div>
		<div style='padding:8px;'>
			<div style='margin-bottom:8px;'>
				<span style='padding-right:20px;'>Retrieved by :............................................</span>
				<span>Signature & Date :........................................</span>
			</div>
			<div style='margin-bottom:8px'>
				<div><span><b>Order Id :</b></span> <span><?=$order_id?></span></div>
			</div>
			<div>
				<div style='padding-bottom:8px;'>
					<b>
						<div style='width:5%;display:inline-block;vertical-align:top;padding-right:4px;'>Qty</div>
						<div style='width:30%;display:inline-block;vertical-align:top;padding-right:4px;'>Product Name </div>
						<div style='width:20%;display:inline-block;vertical-align:top;padding-right:4px;'>Item Price</div>
						<div style='display:inline-block;vertical-align:top;'>Total (+ Shipping Fee)</div>
					</b>
				</div>
				<div>
					<div style='width:5%;display:inline-block;vertical-align:top;padding-right:4px;'><?=$qty?></div>
					<div style='width:30%;display:inline-block;vertical-align:top;padding-right:4px;'><?=ucwords($food_name)?></div>
					<div style='width:20%;display:inline-block;vertical-align:top;padding-right:4px;'><?=get_json_data('currency_symbol','about_us').' '.$item_fee?></div>
					<div style='display:inline-block;vertical-align:top;'><?=get_json_data('currency_symbol','about_us').' '.$total_fee?></div>
				</div>
			</div>
		</div>
	</div>
	<? //delivery man/pickup station manager copy ?>
	<div style=''>
		<div style='padding:16px;'>
			<center>
				<b>
					<span>..................................................................</span>
					<span style='padding:9px;position: relative;top:4px;'>CUT HERE</span>
					<span>..................................................................</span>
				</b>
			</center>
		</div>
		<div style='margin-top:8px;'><b>SALES INVOICE (DELIVERY MAN/PICK-UP STATION MANAGER COPY)</b></div>
		<div style='padding:8px;'>
			<div style='margin-bottom:8px;'>
				<div><span><b>Order Id :</b></span> <span><?=$order_id?></span></div>
			</div>
			<div>
				<div style='padding-bottom:8px;'>
					<b>
						<div style='width:5%;display:inline-block;vertical-align:top;padding-right:4px;'>Qty</div>
						<div style='width:30%;display:inline-block;vertical-align:top;padding-right:4px;'>Product Name </div>
						<div style='width:20%;display:inline-block;vertical-align:top;padding-right:4px;'>Item Price</div>
						<div style='display:inline-block;vertical-align:top;'>Total (+ Shipping Fee)</div>
					</b>
				</div>
				<div style='padding-bottom:8px;'>
					<div style='width:5%;display:inline-block;vertical-align:top;padding-right:4px;'><?=$qty?></div>
					<div style='width:30%;display:inline-block;vertical-align:top;padding-right:4px;'><?=ucwords($food_name)?></div>
					<div style='width:20%;display:inline-block;vertical-align:top;padding-right:4px;'><?=get_json_data('currency_symbol','about_us').' '.$item_fee?></div>
					<div style='display:inline-block;vertical-align:top;'><?=get_json_data('currency_symbol','about_us').' '.$total_fee?></div>
				</div>
				<div>
					<div><span><b>Delivery Method :</b></span> <span><?=ucwords($delivery_method)?></span></div>
					<?php
					if($delivery_method === 'door delivery'){
						?><div><?php get_contact_detail($uc_id)?></div><?php
					}else{
						?><div><b><?=ucwords($customer_name)?></b></div><?php
					}
					?>
				</div>
			</div>
			<div style='margin-top:8px;'>
				<span style='padding-right:20px;'>Received by :............................................</span>
				<span>Signature & Date :........................................</span>
			</div>
		</div>
	</div>
</body>
</html>