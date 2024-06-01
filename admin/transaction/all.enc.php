<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','transaction/all/'.$_GET['status'].'/'.$_GET['page'].'/');
require_once(file_location('admin_inc_path','session_check.inc.php'));
if($adlevel < 3){trigger_error_manual(404);}
if(isset($_GET['status'])){
	$sta = ($_GET['status']);
	if($sta === 'all' || $sta === 'pod' || $sta === 'card' ){$status = $sta;}else{$status = 'all';}
}else{
$status = 'all';	
}
if(isset($_GET['page'])){
	$pag = ($_GET['page']);
	if(!empty($pag) && is_numeric($pag)){$page_num = $pag;}else{$page_num = 1;}
}else{
	$page_num = 1;
}
$page = "MANAGE ALL ".strtoupper($status)." TRANSACTIONS";
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
				<h2 class='j-text-color1 j-padding j-color4'><b><?=strtoupper($status)?> TRANSACTIONS LIST</b></h2>
			</div>
			<center>
				<div class='j-padding'>
					<?php
					if($status === 'all'){
						?>
						<a href="<?=file_location('admin_url','transaction/all/card/')?>"class='j-margin j-btn j-color1 j-left j-round j-card-4'><b>Card Transactions</b></a>
						<a href="<?=file_location('admin_url','transaction/all/pod/')?>"class='j-margin j-btn j-color1 j-right j-round j-card-4'><b>POD Transactions</b></a>
						<?php
					}elseif($status === 'card'){
						?>
						<a href="<?=file_location('admin_url','transaction/all/all/')?>"class='j-margin j-btn j-color1 j-left j-round j-card-4'><b>All Transactions</b></a>
						<a href="<?=file_location('admin_url','transaction/all/pod/')?>"class='j-margin j-btn j-color1 j-right j-round j-card-4'><b>POD Transactions</b></a>
						<?php
					}elseif($status === 'pod'){
						?>
						<a href="<?=file_location('admin_url','transaction/all/all/')?>"class='j-margin j-btn j-color1 j-left j-round j-card-4'><b>All Transactions</b></a>
						<a href="<?=file_location('admin_url','transaction/all/card/')?>"class='j-margin j-btn j-color1 j-right j-round j-card-4'><b>Card Transactions</b></a>
						<?php
					}
					?>
				</div>
				<div class="j-container">
					<input type="search"name="sx"id="sx"class="j-input j-border-2 j-border-color1 j-round"
					placeholder="Search <?=$status?> transaction"style="width:96%;max-width:500px;outline:none;display:inline"onsearch="gtr('<?=$status?>',<?=$page_num?>);"onkeyup="gtr('<?=$status?>',<?=$page_num?>);"/>
				</div>
				<div id="shr"></div>
			</center>
			<span id="st"></span>
		</div>
	</div>
</div>
<!-- BODY ENDS -->
<?php require_once(file_location('admin_inc_path','js.inc.php'));?>
</body>
</html>