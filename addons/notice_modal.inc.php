<?php
$company = ucwords(get_xml_data('company_name'));
$message = "
			<center class='j-large j-text-color1 j-bolder'>NOTICE (PLEASE READ BEFORE USE)</center><hr>
			<div class='j-text-color3 j-justify'>
				Welcome to {$company}, Please read the following carefully before using the web app. And please note that the web app may undergo
				changes at anytime.<br><br>
				Due to testing phase of the web app, the web app is hosted on a free hosting which has a limited resources. So you may experience
				the following fluctuations listed below and some others not mentioned here. please bear with us<br>
				<span class='j-xxlarge'style='position:relative;top:7px'>•</span> You may and may not receive email depending on the amount
				of resources available when you carry out activities like forgot password, order item, cancel order, order is being
				prepared, order is delivered and so on.<br>
				<span class='j-xxlarge'style='position:relative;top:7px'>•</span> You may not see items like products and some other data
				from database, if the maximum resource of the database has been overused.<br>
				<span class='j-xxlarge'style='position:relative;top:7px'>•</span> You may also experience slow loading time and some other
				fluctuation, please understand that the site is for testing not for production so we use free hosting (which is limited)
				for the web app .<br>
				<br>
				{$company} is a web application developed by Oladejo Jephthah. The Application is responsive and scalable,it has different views for different screen sizes.<br><br>
				This project renders an food ordering and delivery web app run by a single vendor.<br>
				It features include:<br>
				° Admin section with different admin level<br>
				° User section with login and registration features<br>
				° Cart and checkout<br>
				° Tracking of order status<br>
				° Online payment with payment gateway<br>
				° Option of making payment when order is delivered or picked up<br>
				° Pickup and home delivery options<br>
				° Print receipt<br>
				° All transactions and it yearly, monthly and daily data<br>
				° Many more features<br><br>
				You can now proceed to surf the food delivery application, thanks for your time.<br><br>
				if You need one or any other web application for your project or business, please visit my portfolio<br>
				<center><a href='https://jephthiano.000webhostapp.com'target='_blank'class='j-btn j-color1 j-round-large'>Visit Porfolio</a><center>
			</div>
			";
?>
<div id='notice_modal'class='j-modal j-modal-click'>
	<div class='j-card-4 j-modal-content j-color4 j-blder'style='width:96%;max-width:600px;'>
		<div class='j-padding'><?=$message?></div>
		<center class='j-padding'>
			<div class='j-clickable j-text-color1 j-round j-border j-border-color1 j-padding'style='width:100%'onclick=$('#notice_modal').fadeOut('slow');>
				Close
			</div>
			<br>
		</center>
	</div>
</div>