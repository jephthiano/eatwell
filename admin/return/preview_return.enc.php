<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','return/preview_return/'.$_GET['page']);
$page = "RETURN DATA";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
if(isset($_GET['page']) AND is_numeric($_GET['page'])){ //getting the value of the get 
	$cid = test_input(removenum($_GET['page']));
	if(!empty($cid)){	
		$id = content_data('return_table','rh_id',$cid,'rh_id');
	}else{
		trigger_error_manual(404);
	}
}else{
	trigger_error_manual(404);
}
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
		<div class='j-padding'>
			<h2 class='j-text-color1 j-padding j-color4'><b>PREVIEW RETURN DATA</b></h2>
		</div>
		<center>
			<div class='j-padding'>
				<a href="<?=file_location('admin_url','return/return/')?>"class='j-bolder j-btn j-color1 j-right j-round j-card-4'>All Returns</a>
				<span class='j-clearfix'></span>
			</div>
		</center>
		<br class='j-clearfix'>
		<div class='j-row'>
			<?php
			if($id === false){
				page_not_available('short');
			}else{
				$status = content_data('return_table','rh_status',$id,'rh_id','','null');
				$or_id = content_data('return_table','or_id',$id,'rh_id','','null');
				$order_id = content_data('return_table','or_order_id',$id,'rh_id','','null');
				$u_id = content_data('return_table','u_id',$id,'rh_id','','null');
				$p_id = content_data('return_table','p_id',$id,'rh_id','','null');
				$pm_id = content_data('product_media_table','pm_id',$p_id,'p_id','','null');
				
				preview_modal('return',$or_id);
				?>
				<div id=""class='j-col m7 j-padding'>
				<div class='j-color2'><div class='j-padding j-large'><b>Return Details</b></div></div>
					<div class="j-container j-color4 j-padding">
						<?php
						if($status === 'request opened'){
							?>
							<div class='j-right j-bolder'>
								<div class='j-color1 j-btn j-round'style='margin-right:16px;'onclick="$('#request_approved_return').fadeIn('slow');">
									Approve Request
								</div>
								<div class='j-color1 j-btn j-round'onclick="$('#request_rejected_return').fadeIn('slow');">Reject Request</div>
							</div>
							<span class='j-clearfix'></span>
							<?php
						}elseif($status === 'request approved'){
							?>
							<div class='j-right j-bolder'>
								<div class='j-color1 j-btn j-round'style='margin-right:16px;'onclick="$('#return_approved_return').fadeIn('slow');">
									Approve Return
								</div>
								<div class='j-color1 j-btn j-round'onclick="$('#return_rejected_return').fadeIn('slow');">Reject Return</div>
							</div>
							<span class='j-clearfix'></span>
							<?php
						}
						?>
						<div class='j-row'style='margin-bottom:10px;'>
							<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Return Status:</span><br>
							<span class='j-text-color5'><?=$status;?></span>
						</div>
						<div class='j-row'style='margin-bottom:10px;'>
							<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Reason For Return Request:</span><br>
							<span class='j-text-color5'><?=(content_data('return_table','rh_return_reason',$id,'rh_id','','null'));?></span>
						</div>
						<?php
						if($status === 'request rejected'){
							?>
							<div class='j-row'style='margin-bottom:10px;'>
								<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Reason For Rejection of Return Request :</span><br>
								<span class='j-text-color5'><?=(content_data('return_table','rh_request_reject_reason',$id,'rh_id','','null'));?></span>
							</div>
							<?php
						}
						if($status === 'return rejected'){
							?>
							<div class='j-row'style='margin-bottom:10px;'>
								<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Reason For Return Rejection:</span><br>
								<span class='j-text-color5'><?=(content_data('return_table','rh_return_reject_reason',$id,'rh_id','','null'));?></span>
							</div>
							<?php
						}
						?>
						<div class='j-row'style='margin-bottom:10px;'>
							<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Request Opened On:</span><br>
							<span class='j-text-color5'><?=showdate(content_data('return_table','rh_regdatetime',$id,'rh_id','','null'),'');?></span>
						</div>
					</div>
					<br<br><br>
					
					<div class='j-color3'><div class='j-padding j-large'><b>Product Details</b></div></div>
					<div class="j-container j-color4 j-padding">
						<div class='j-row'style='margin-bottom:10px;'>
							<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Product Image:</span><br>
							<span><img class='j-round'src="<?=file_location('media_url',get_media('product',$pm_id))?>"style='width:50px;height:50px;'/></span>
						</div>
						<div class='j-row'style='margin-bottom:10px;'>
							<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Product Name:</span><br>
							<span class='j-text-color5'><?=(content_data('product_table','p_name',$p_id,'p_id','','null'));?></span>
						</div>
						<div class='j-row'style='margin-bottom:10px;'>
							<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Product Category:</span><br>
							<span class='j-text-color5'><?=(content_data('product_table','p_category',$p_id,'p_id','','null'));?></span>
						</div>
						<div class='j-row'style='margin-bottom:10px;'>
							<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Product Brand:</span><br>
							<span class='j-text-color5'><?=(content_data('product_table','p_brand',$p_id,'p_id','','null'));?></span>
						</div>
						<div><a href="<?=file_location('admin_url','product/preview_product/'.addnum($p_id).'/')?>"class='j-itallic j-text-color1'>See More</a></div>
					</div>
					<br<br><br>
					
					<div class='j-color5'><div class='j-padding j-large'><b>Customer Details</b></div></div>
					<div class="j-container j-color4 j-padding">
						<div class='j-row'style='margin-bottom:10px;'>
							<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Quantity:</span><br>
							<span class='j-text-color5'><?=ucwords(content_data('user_table','u_fullname',$u_id,'u_id','','null'));?></span>
						</div>
						<div><a href="<?=file_location('admin_url','user/preview_user/'.addnum($u_id).'/')?>"class='j-itallic j-text-color1'>See More</a></div>
					</div>
					<br<br><br>
				</div>
				
				<div id=""class='j-col m5 j-padding'>
					<?php
					if($status === 'return approved' && (content_data('order_table','or_status',$order_id,'or_order_id','','null') !== 'returned')){
						?>
						<div class='j-color7'><div class='j-padding j-large'><b>Return Notice</b></div></div>
						<div class="j-container j-color4 j-padding">
							<div class=''>
								Please note that order status has not been updated to <b class='j-text-color1'>RETURNED</b>.
								<a href="<?=file_location('admin_url','order/preview_order/'.$order_id.'/')?>"class='j-itallic j-text-color1'> Click here </a> to update the order status
							</div>
						</div>
						<br<br><br>
						<?php
					}
					?>
					
					<div class='j-color7'><div class='j-padding j-large'><b>Return History</b></div></div>
					<div class="j-container j-color4 j-padding">
						<div class='j-text-color7 j-bolder j-large j-text-color1' style='margin-bottom:9px;'>RETURN HISTORY</div>
						<div class='j-padding j-small'><?php track_return($order_id,'admin');?></div>
					</div>
					<br<br><br>
					
					<div class='j-color3'><div class='j-padding j-large'><b>Order Details</b></div></div>
					<div class="j-container j-color4 j-padding">
						<div class='j-row'style='margin-bottom:10px;'>
							<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Order ID:</span><br>
							<span class='j-text-color5'><?=($order_id);?></span>
						</div>
						<div class='j-row'style='margin-bottom:10px;'>
							<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Quantity:</span><br>
							<span class='j-text-color5'><?=(content_data('order_table','or_quantity',$or_id,'or_id','','null'));?></span>
						</div>
						<div class='j-row'style='margin-bottom:10px;'>
							<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Amount:</span><br>
							<span class='j-text-color5'><?=(content_data('order_table','or_amount',$or_id,'or_id','','null'));?></span>
						</div>
						<div class='j-row'style='margin-bottom:10px;'>
							<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Delivery Fee:</span><br>
							<span class='j-text-color5'><?=(content_data('order_table','or_delivery_fee',$or_id,'or_id','','null'));?></span>
						</div>
						<div class='j-row'style='margin-bottom:10px;'>
							<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Order Date</span><br>
							<span class='j-text-color5'><?=showdate(content_data('order_history_table','oh_regdatetime',$or_id,'or_id',"AND oh_status = 'order placed'",'null'),'');?></span>
						</div>
						<div class='j-row'style='margin-bottom:10px;'>
							<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Delivery Date</span><br>
							<span class='j-text-color5'><?=showdate(content_data('order_history_table','oh_regdatetime',$or_id,'or_id',"AND oh_status = 'delivered'",'null'),'');?></span>
						</div>
						<div><a href="<?=file_location('admin_url','order/preview_order/'.($order_id).'/')?>"class='j-itallic j-text-color1'>See More</a></div>
					</div>
					<br<br><br>
				</div>
				<?php
			}
			?>
			<span id="st"></span>
		</div>
<br>
	</div>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>