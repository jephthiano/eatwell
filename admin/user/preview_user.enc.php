<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','user/preview_user/'.$_GET['page']);
$page = "USER DATA";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
if(isset($_GET['page']) AND is_numeric($_GET['page'])){ //getting the value of the get 
	$cid = test_input(removenum($_GET['page']));
	if(!empty($cid)){	
		$id = content_data('user_table','u_id',$cid,'u_id');
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
			<h2 class='j-text-color1 j-padding j-color4'><b>PREVIEW CUSTOMER DATA</b></h2>
		</div>
		<div class='j-row'>
			<div class='j-margin'>
				<center>
					<a href="<?=file_location('admin_url','user/all/')?>"class="j-btn j-color1 j-left j-round j-card-4 j-bolder">All Customers</a>
					<a href="<?=file_location('admin_url','user/suspended/')?>"style='margin-right:9px;'class="j-btn j-color1 j-round j-card-4 j-bolder">Suspended Customers</a>
					<a href="<?=file_location('admin_url','user/pod_disabled/')?>"class="j-btn j-color1 j-round j-right j-card-4 j-bolder">POD Disabled Customers</a>
				</center>
			</div>
			<br class='j-clearfix'><br>
			<?php
			if($id === false){
				page_not_available('short');
			}else{
				$fullname = content_data('user_table','u_fullname',$id,'u_id','','null');
				$pod_status = content_data('user_table','u_pod',$id,'u_id');
				$status = content_data('user_table','u_status',$id,'u_id','','null');
				?>
				<div id=""class='j-col m7 j-padding'>
					<div class='j-color5'><div class='j-padding j-large'><b>Customer Details</b></div></div>
					<div class="j-container j-color4 j-padding">
						<?php
						if($adlevel > 1){
							preview_modal('user',$id);
							?>
							<div class='j-right'>
								<span class='j-clickable j-color1 j-btn j-round j-bolder'style="margin:3px;"onclick="$('#user<?=$id?>pod').fadeIn('slow');">
									<i class='<?=icon('sort-amount-up');?>'style='padding-right:5px;'></i>
									<?=$pod_status === 'enabled'?'Disable':'Enable';?> Customer POD
								</span>
								<span class='j-clickable j-color1 j-btn j-round j-bolder'style="margin:3px;"onclick="$('#user<?=$id?>status').fadeIn('slow');">
									<i class='<?=icon('ban');?>'style='padding-right:5px;'></i>
									<?= $status === 'active'?'Suspend':'Re-activate';?> User
								</span>
								<span class='j-clickable j-color1 j-btn j-round j-bolder'style="margin:3px;"onclick="$('#delete_user<?=$id?>').fadeIn('slow');">
									<i class='<?=icon('trash');?>'style='padding-right:5px;'></i>
									Delete Account
								</span>
							</div>
							<span class='j-clearfix'></span>
							<?php
						}
						?>
						<div style='line-height:30px;'>
							<div class='j-row'style='margin-bottom:15px;'>
								<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Fullname:</span><br>
								<span class='j-text-color3'><?=ucwords($fullname);?></span>
							</div>
							<div class='j-row'style='margin-bottom:15px;'>
								<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Email:</span><br>
								<span class='j-text-color3'><?=ucwords(content_data('user_table','u_email',$id,'u_id','','null'));?></span>
							</div>
							<div class='j-row'style='margin-bottom:15px;'>
								<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Gender:</span><br>
								<span class='j-text-color3'><?=ucwords(content_data('user_table','u_gender',$id,'u_id','','null'));?></span>
							</div>
							<div class='j-row'style='margin-bottom:15px;'>
								<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Status:</span><br>
								<span class='j-text-color3'><?=ucwords($status);?></span>
							</div>
							<div class='j-row'style='margin-bottom:15px;'>
								<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Payment on Delivery Status:</span><br>
								<span class='j-text-color3'><?=ucwords($pod_status);?></span>
							</div>
							<div class='j-row'style='margin-bottom:15px;'>
								<span class='j-text-color7 j-bolder' style='margin-right:9px;'>Joined On:</span><br>
								<span class='j-text-color3'><?=showdate(content_data('user_table','u_regdatetime',$id,'u_id','','null'));?></span>
							</div><br>
						</div>
					</div>
					<br><br>
					
					<div class='j-color2'><div class='j-padding j-large'><b>Customer Contact Details</b></div></div>
					<div class="j-container j-color4 j-padding">
						<div>
							<?php
							user_modal('contact_modal','','add_contact_modal');
							$or = multiple_content_data('user_contact_table','uc_id',$id,'u_id',"ORDER BY uc_status DESC");
							if($or !== false){
								?>
								<div class='j-row-padding'>
									<?php foreach($or AS $user_id){ ?>
									<div class='j-col m6 j-section'><div class='j-border-2 j-border-color5 j-padding j-round'><?php get_contact_detail($user_id,'admin');?></div></div>
									<?php } ?>
								</div>
								<?php
							}else{
								?><center class='j-bolder j-text-color7'>No contact details for this user</center><?php
							}
							?>
							<br>
						</div>
					</div>
				</div>
				
				<div class='j-col m5 j-padding'>
				<div class='j-color3'><div class='j-padding j-large'><b>Transaction History</b></div></div>
					<div class="j-container j-color4 j-padding">
						<div class=''style='line-height: 30px;'>
							<?php
							$total_amount = paid_sum('or_amount','user_id',$id);
							$total_delivery_fee = paid_sum('or_delivery_fee','user_id',$id);
							?>
							<div>
								<span class='j-bolder j-text-color7'>Total Amt Spent on Item:</span><br>
								<span class='j-bolder j-text-color5'><?=get_json_data('currency_symbol','about_us').' '.$total_amount?></span>
							</div>
							<div>
								<span class='j-bolder j-text-color7'>Total Amt Spent on Delivery:</span><br>
								<span class='j-bolder j-text-color5'><?=get_json_data('currency_symbol','about_us').' '.$total_delivery_fee?></span>
							</div>
							<div>
								<span class='j-bolder j-text-color7'>Total Amt Spent:</span><br>
								<span class='j-bolder j-text-color5'><?=get_json_data('currency_symbol','about_us').' '.add_total($total_amount,$total_delivery_fee)?></span>
							</div>
						</div>
					</div>
					<br>

					<div class='j-color7'><div class='j-padding j-large'><b>To DO</b></div></div>
					<div class="j-container j-color4 j-padding">
						<div class='j-large'>
							<a href="<?=file_location('admin_url','message/send_email/'.addnum($id).'/')?>" class='j-bolder j-text-color7 j-btn j-color1 j-round j-small'>
								Mail customer
							</a>
						</div>
					</div>
					<br>

					<div class='j-color2'><div class='j-padding j-large'><b>Order Summary</b></div></div>
					<div class="j-container j-color4 j-padding">
						<a href="<?=file_location('admin_url','order/user_all_orders/'.addnum($id).'/')?>"style='margin-right:9px;'class="j-btn j-color1 j-round j-card-4 j-bolder j-small">
						Click to see all customer orders</a>
						<div class=''style='line-height: 40px;'>
							<span class='j-bolder j-text-color1'>Total Orders: </span>
							<span><?=get_numrow('order_table','user_id',$id,"return",'round',"AND or_status NOT IN ('cart')")?></span>
							<div class='j-bolder j-text-color1'>Total In: </div>
							<div>
								<?php
								$order_statuses = ['failed','order placed','cancelled','confirmed','packaging','in-transit','delivered','failed delivery'];
								foreach($order_statuses AS $order_status){
									?>
									<div class='j-medium'>
										<i class='<?=icon('thumb-up-right')?>'style='margin-right:5px'></i>
										<span class='j-bolder j-text-color5'><?=ucwords($order_status)?>: </span>
										<span><?=get_numrow('order_table','user_id',$id,"return",'round',"AND or_status = '{$order_status}'")?></span>
									</div>
									<?php
								}
								?>
							</div>
						</div>
					</div>
					<br>

					<div class='j-color5'><div class='j-padding j-large'><b>Customer Activities</b></div></div>
					<div class="j-container j-color4 j-padding">
						<div class=''style='line-height: 40px;'>
							<div>
								<span class='j-text-color7 j-medium'>Current No of Cons. Cancelled Order:</span>
								<span><?=content_data('user_data_table','ud_cancel_counter',$id,'u_id','','null')?></span>
							</div>
							<div>
								<span class='j-text-color7 j-medium'>Current No of Cons. Successful Order:</span>
								<span><?=content_data('user_data_table','ud_delivery_counter',$id,'u_id','','null')?></span>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
			<span id="st"></span>
		</div>
	</div>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>