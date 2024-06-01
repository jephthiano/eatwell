<?php
//MAIL FUNCTION STARTS
//email subject starts
function email_subject($type,$order_id=''){
 if($type === 'order placed'){
   $message = "Your order {$order_id} has been received";
 }elseif($type === 'cancelled'){
   $message = "Your order {$order_id} has been cancelled";
 }elseif($type === 'failed'){
   $message = "Your order {$order_id} is not successful";
 }elseif($type === 'confirmed'){
   $message = "Your order {$order_id} has been confirmed";
 }elseif($type === 'packaging'){
   $message = "Your order {$order_id} is being prepared";
 }elseif($type === 'in-transit'){
   $message = "Your order {$order_id} is in transit";
 }elseif($type === 'ready-for-pickup'){
   $message = "Your order {$order_id} is ready for pickup";
 }elseif($type === 'delivered'){
   $message = "Your order {$order_id} has been delivered";
 }elseif($type === 'failed delivery'){
   $message = "Failed delivery";
 }elseif($type === 'returned'){
   $message = "Your returned order {$order_id} has been received";
 }
 return $message;
}
//email subject ends

//email message starts
function email_message($type='',$name='Customer',$order_id=''){
 if($type === 'order placed'){
   $message = "Your order {$order_id} has been received, we will confirm the order very soon and notify you.";
 }elseif($type === 'cancelled'){
   $message = "Your order {$order_id} has been cancelled, if payment method is prepaid, refund will be processed as soon as possible and we will notify you.";
 }elseif($type === 'failed'){
   $message = "Your order {$order_id} was not succesfull, please try again.";
 }elseif($type === 'confirmed'){
   $message = "Your order {$order_id} has been confirmed, we will prepare the item(s) as soon as possible and notify you.";
 }elseif($type === 'packaging'){
   $message = "Your order {$order_id} is being prepared, we will package the item(s) as soon as possible and notify you.";
 }elseif($type === 'in-transit'){
   $message = "Your order {$order_id} is in transit, it will soon be delivered. Please note that our delivery agent will contact you when attempting delivery.";
 }elseif($type === 'ready-for-pickup'){
   $message = "Your order {$order_id} is ready for pick up, you can pick up your item at our pickup station";
 }elseif($type === 'delivered'){
   $message = "Your order {$order_id} has been delivered, we are glad you shopped with us, you can leave a review about the product under Account >> Pending Review.";
 }elseif($type === 'failed delivery'){
   $message = "Your order {$order_id} delivery failed, our delivery agent attempt the delivery but it wasn't successful, if payment method is prepaid, refund will be processed as soon as possible and we will notify you.";
 }elseif($type === 'returned'){
   $message = "Your returned order {$order_id} has been received, we will confirm the item validity. if payment method is prepaid, refund will be processed as soon as possible and we will notify you.";
 }
 $name = ucwords($name);
 $media_url = file_location('media_url','home/admin_logo.png');
 $home_url = file_location('home_url','');
 $track_url = file_location('home_url','order/track/'.$order_id);
 $company_name = ucwords(get_xml_data('company_name'));
	return
	<<< EOF
<html>
				<head>
					<meta charset='UTF-8'>
					<meta name='viewport' content='width=device-width, initial-scale=1.0'>
					<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
					<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
     <link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Roboto">
					<style>
						.j-j-text-shadow{j-text-shadow: 7px 3px 5px;}
      .j-color1{background-color:#ff1a1a!important}
						.j-text-color5{color:#757575!important}
						.j-text-color7{color:#3a3a3a!important}
						</style>
				</head>
				<body id='body'class=''style='font-family:Roboto,sans-serif;font-size:20px;'>
					<div style='padding: 20px;text-align: justify'>
						<center>
							<a href="{$home_url}" class='j-xxlarge j-j-text-shadow' style='padding: 15px 10px;color: teal;text-decoration: none;font-size: 35px;cursor: pointer;'>
        <img src="{$media_url}"class=''alt="{$company_name} LOGO IMAGE"style="width:98%;max-width:500px;height:70px;">
							</a><br><br><br>
						</center>
						<div class='j-text-color7'>
							<p><b>Dear {$name},</b></p>
							<p>{$message}</b></p>
							<p>We appreciate your effort in shopping with us.</p><br>
							<p>You can track your item here.</p>
       <center><a href='{$track_url}'><div class='j-color1'style='padding:8px 8px;color:white'>Track Item</div></a></center><br>
       
							<p>Thanks for supporting us.</p>
							<p>Best Regards.</p>
							<p>{$company_name} Team.</p><br>
							
							<p>You are receiving this email, because you are a registered member/user of <a href="{$home_url}" class=''style='color: red;text-decoration: none;cursor: pointer;'>
       {$company_name}</a>.</p>
							<hr>
							<div class='j-text-color5' style='font-family: Open Sans'>
								<p>Copyright <?= date('Y');?> {$company_name} All rights reserved.</p>
							</div>
							<hr>
						</div>
					</div>
				</body>
			</html>
EOF;
}
//email message ends

//email code message starts
function email_code_message($code){
 $media_url = file_location('media_url','home/admin_logo.png');
 $home_url = file_location('home_url','');
 $company_name = ucwords(get_xml_data('company_name'));
	return
	<<< EOF
<html>
				<head>
					<meta charset='UTF-8'>
					<meta name='viewport' content='width=device-width, initial-scale=1.0'>
					<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
					<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
     <link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Roboto">
					<style>
						.j-j-text-shadow{j-text-shadow: 7px 3px 5px;}
						.j-text-color5{color:#757575!important}
						.j-text-color7{color:#3a3a3a!important}
						</style>
				</head>
    <body id='body'class=''style='font-family:Roboto,sans-serif;font-size:20px;'>
					<div style='padding: 20px;text-align: justify'>
						<center>
							<a href="{$home_url}" class='j-xxlarge j-j-text-shadow' style='padding: 15px 10px;color: teal;text-decoration: none;font-size: 35px;cursor: pointer;'>
        <img src="{$media_url}"class=''alt="{$company_name} LOGO IMAGE"style="width:98%;max-width:500px;height:70px;">
							</a><br><br><br>
						</center>
						<div class='j-text-color7'>
							<p>Hi,</p>
							<p>Your Passcode is <b>{$code}</b></p>
							<p> Please note that it expires in 5 minutes. We appreciate your effort in shopping with us.</p><br>
							
							<p>Thanks for supporting us.</p>
							<p>Best Regards.</p>
							<p>{$company_name} Team.</p><br>
							
       <p>Please do not reply to this email.</p>
							<p>You are receiving this email, because you are a registered member/user of <a href="{$home_url}" class=''style='color: red;text-decoration: none;cursor: pointer;'>
       {$company_name}</a>. If you are not responsible for this email, please ignore and don't share the code with anyone.</p>
							<hr>
							<div class='j-text-color5' style='font-family: Open Sans'>
								<p>Copyright <?= date('Y');?> {$company_name} All rights reserved.</p>
							</div>
							<hr>
						</div>
					</div>
				</body>
			</html>
EOF;
}
//email code message ends

//welcome message email starts
function welcome_message($name){
 $name = ucwords($name);
 $media_url = file_location('media_url','home/admin_logo.png');
 $home_url = file_location('home_url','');
 $company_name = ucwords(get_xml_data('company_name'));
	return
	<<< EOF
<html>
				<head>
					<meta charset='UTF-8'>
					<meta name='viewport' content='width=device-width, initial-scale=1.0'>
					<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
					<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
     <link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Roboto">
					<style>
						.j-j-text-shadow{j-text-shadow: 7px 3px 5px;}
						.j-text-color5{color:#757575!important}
						.j-text-color7{color:#3a3a3a!important}
						</style>
				</head>
    <body id='body'class=''style='font-family:Roboto,sans-serif;font-size:20px;'>
					<div style='padding: 20px;text-align: justify'>
						<center>
							<a href="{$home_url}" class='j-xxlarge j-j-text-shadow' style='padding: 15px 10px;color: teal;text-decoration: none;font-size: 35px;cursor: pointer;'>
        <img src="{$media_url}"class=''alt="{$company_name} LOGO IMAGE"style="width:98%;max-width:500px;height:70px;">
							</a><br><br><br>
						</center>
						<div class='j-text-color7'>
							<p>Hi {$name},</p>
							<p>We (The team at {$company_name}) welcome you to {$company_name}.</p>
							<p>We hope that you have a quality and memorable moment while shopping with us. We appreciate your effort in shopping with us.</p><br>
							
							<p>Thanks for supporting us.</p>
							<p>Best Regards.</p>
							<p>{$company_name} Team.</p><br>
							
       <p>Please do not reply to this email.</p>
							<p>You are receiving this email, because you are a registered member/user of
       <a href="{$home_url}" class=''style='color: red;text-decoration: none;cursor: pointer;'>
       {$company_name}</a>. If you are not responsible for thisemail, please ignore and don't share with anyone.</p>
							<hr>
							<div class='j-text-color5' style='font-family: Open Sans'>
								<p>Copyright <?= date('Y');?> {$company_name} All rights reserved.</p>
							</div>
							<hr>
						</div>
					</div>
				</body>
			</html>
EOF;
}
//welcome message email ends
//MAIL FUNCTION ENDS
?>