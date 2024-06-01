<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png'); $image_type = substr($image_link,-3);
$page_url = file_location('admin_url','refund/refund/'.$_GET['status'].'/'.$_GET['page'].'/');
require_once(file_location('admin_inc_path','session_check.inc.php'));
if(isset($_GET['status'])){
	$sta = ($_GET['status']);
	$return_status = ['all','request opened','request approved','request rejected','return approved','return rejected'];
	foreach($return_status AS $rt_status){if($rt_status === $sta){$status = $sta;break;}else{$status = 'all';}}
}else{
	$status = 'all';	
}
if(isset($_GET['page'])){
	$pag = ($_GET['page']);
	if(!empty($pag) && is_numeric($pag)){$page_num = $pag;}else{$page_num = 1;}
}else{
	$page_num = 1;
}
$page = "MANAGE ".strtoupper($status)." RETURNS";
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
				<h2 class='j-text-color1 j-padding j-color4'><b><?=strtoupper($status)?> RETURN LIST</b></h2>
			</div>
			<center>
				<div class='j-padding'>
					<?php
					foreach($return_status AS $rt_status){
						if($rt_status !== $sta){
							if($rt_status === 'all'){
								$numRow = get_numrow('return_table','','',"return",'round');
							}else{
								$numRow = get_numrow('return_table','rh_status',$rt_status,"return",'round');
							}
							?>
							<a href="<?=file_location('admin_url',"return/{$rt_status}/")?>"class='j-btn j-color1 j-margin j-round j-card-4'>
							<b><?=ucwords($rt_status)?> Returns</b> (<?=$numRow?>)
							</a>
							<?php
						}
					}
					?>
				</div>
				<div class="j-container">
					<input type="search"name="sx"id="sx"class="j-input j-breturn-2 j-breturn-color1 j-round"
					placeholder="Search <?=$status?> return"style="width:96%;max-width:500px;outline:none;display:inline"onsearch="grtr('<?=$status?>',<?=$page_num?>);"onkeyup="grtr('<?=$status?>',<?=$page_num?>);"/>
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