<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','order/user_all_orders/'.$_GET['id']);
$page = "USER ALL ORDERS";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
require_once(file_location('admin_inc_path','session_check.inc.php'));
if(isset($_GET['id']) AND is_numeric($_GET['id'])){ //getting the value of the get 
	$cid = test_input(removenum($_GET['id']));
	if(!empty($cid)){	
		$user_id = content_data('user_table','u_id',$cid,'u_id');
	}else{
		trigger_error_manual(404);
	}
}else{
	trigger_error_manual(404);
}
if(isset($_GET['type'])){
	$sta = ($_GET['type']);
	if($sta === 'order placed' || $sta === 'in-transit' || $sta === 'delivered' || $sta === 'unsuccessful' ){$type = $sta;}else{$type = 'order placed';}
}else{
$type = 'order placed';	
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
			<h2 class='j-text-color1 j-padding j-color4'><b><?=strtoupper(content_data('user_table','u_fullname',$user_id,'u_id','','null'));?> ORDERS</b></h2>
		</div>
		<div class='j-row'>
			<?php
			if($user_id !== false){
				?>
				<div class='j-margin'>
					<div class=''>
						<a href="<?=file_location('admin_url',"user/preview_user/".addnum($user_id)."/")?>"class="j-btn j-color1 j-left j-round j-card-4 j-bolder">
						Back to customer details</a>
					</div>
				</div>
				<?php
			}
			?>
			<br class='j-clearfix'><br>
			<?php
			if($user_id === false){
				page_not_available('short');
			}else{
				?>
				<div id=""class='j-col m7 j-padding'>
					<div class="j-container j-color4">
						<div class=''>
							<?php $user = 'admin'; $u_id = $user_id; require_once(file_location('inc_path','orders_link_header.inc.php')); //order pagination?>
						</div>
						<br<br><br>
					</div>
				</div>
					
				<div class='j-col m5 j-padding'>
				<div class='j-color5'><div class='j-padding j-large'><b>Customer Summary</b></div></div>
					<div class="j-container j-color4 j-padding">
						<a href="<?=file_location('admin_url','user/preview_user/'.addnum($user_id).'/')?>" class='j-bolder j-text-color7 j-btn j-color1 j-round j-small'>
						Click to see customer details
						</a>
						<a href="<?=file_location('admin_url','message/send_email/'.addnum($user_id).'/')?>" class=' j-right j-bolder j-text-color7 j-btn j-color1 j-round j-small'>
						Mail customer
						</a>
						<div class=''style='line-height: 40px;'>
							<div>
								<span class='j-bolder j-text-color7'>Name:</span>
								<span class='j-text-color7'><?=ucwords(content_data('user_table','u_fullname',$user_id,'u_id','','null'))?></span>
							</div>
							<div>
								<span class='j-bolder j-text-color7'>Email:</span>
								<span class='j-text-color7'><?=content_data('user_table','u_email',$user_id,'u_id','','null')?></span>
							</div>
							<div>
								<span class='j-bolder j-text-color7'>Gender:</span>
								<span class='j-text-color7'><?=ucwords(content_data('user_table','u_gender',$user_id,'u_id','','null'))?></span>
							</div>
						</div>
					</div>
					<br>

					<div class='j-color2'><div class='j-padding j-large'><b>Order Details</b></div></div>
					<div class='j-padding j-color4'>
						<div class='j-large j-bolder j-text-color1'>All Customer Orders</div>
						<div class=''style='line-height: 40px;'>
							<span class='j-bolder j-text-color1'>Total Orders: </span>
							<span><?=get_numrow('order_table','user_id',$user_id,"return",'round',"AND or_status NOT IN ('cart')")?></span>
							<div class='j-bolder j-text-color1'>Total In: </div>
							<div>
								<?php
								$order_statuses = ['failed','order placed','cancelled','confirmed','packaging','in-transit','ready-for-pickup','delivered','failed delivery','returned'];
								foreach($order_statuses AS $order_status){
									?>
									<div class='j-medium'>
										<i class='<?=icon('thumb-up-right')?>'style='margin-right:5px'></i>
										<span class='j-bolder j-text-color5'><?=ucwords($order_status)?>: </span>
										<span><?=get_numrow('order_table','user_id',$user_id,"return",'round',"AND or_status = '{$order_status}'")?></span>
									</div>
									<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<br>
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