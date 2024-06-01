<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');
require_once(file_location('admin_inc_path','session_check_nologout.inc.php'));
if(isset($_POST['s']) && isset($_POST['st']) && isset($_POST['pg'])){
	$searchtext = test_input(($_POST['s']));
	$status2 = test_input($_POST['st']);
	$cur_page = test_input(($_POST['pg']));
	$add = "p_status = '{$status2}'" ;
	require_once(file_location('admin_inc_path','pagination_total.inc.php'));
	
	if(!empty($searchtext)){ // if the search text is not empty
		$searchtext = $searchtext."*";
		$sql = "SELECT p_id,p_name,p_max_order,p_category,p_discounted_price FROM product_table
		WHERE (MATCH(p_name,p_category,p_details,p_brand) AGAINST(:searchtext IN BOOLEAN MODE)) AND {$add}
		ORDER BY MATCH(p_name,p_category,p_details,p_brand) AGAINST(:searchtext IN BOOLEAN MODE)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':searchtext',$searchtext,PDO::PARAM_STR);
	}else{ // if it the field is empty
		$sql = "SELECT p_id,p_name,p_max_order,p_category,p_discounted_price FROM product_table WHERE {$add} ORDER BY p_id DESC LIMIT $start,$display";
		$stmt = $conn->prepare($sql);
	}// end of if empty($searchtext)
	$stmt->bindColumn('p_id',$id);
	$stmt->bindColumn('p_name',$name);
	$stmt->bindColumn('p_max_order',$max_order);
	$stmt->bindColumn('p_category',$category);
	$stmt->bindColumn('p_discounted_price',$price);
	$stmt->execute();
	$numRow = $stmt->rowCount();
	if($numRow > 0){// if a record is found
		if(empty($searchtext)){$numRow = $total_records;}
		?>
		<center>
			<div class="j-responsive"style='line-height:27px;'>
				<p class="j-text-color5">
					<b><?=empty($searchtext)?$numRow.' Product(s) found':$numRow." result(s) found for <span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in ".$status2." products";?></b>
				</p>
				<table class="j-table-all j-border-0">
					<tr class="j-border-0 j-text-color1">
						<td><b>S/N</b></td><td><b>Name</b></td><td><b>Image</b></td>
						<td><b>Max Order</b></td> <td><b>Total Available</b></td><td><b>Category</b></td><td><b>Price</b></td><td><b>Preview</b></td>
						<?php if($adlevel > 1){ ?>
						<td><b>Edit</b></td>
						<?php } ?>
					</tr>
					<?php
					while($stmt->fetch()){
						$name = content_data('product_table','p_name',$id,'p_id','','null');
						$pm_id = content_data('product_media_table','pm_id',$id,'p_id','','null');
						?>
						<tr class="j-border-0">
							<td><?php s_n();?></td><td><?=ucwords(($name));?></td>
							<td><img class='j-round'src="<?=file_location('media_url',get_media('product',$pm_id))?>"style='width:50px;height:50px;'/></td>
							<td><?=$max_order?></td><td><?=get_total_available($id)?></td><td><?=ucwords($category)?></td><td><?=$price?></td>
							<td><a href='<?= file_location('admin_url','product/preview_product/'.addnum($id))?>'><i class="<?= icon('eye');?>"></i></a></td>
							<?php if($adlevel > 1){ ?>
							<td><a href='<?= file_location('admin_url','product/update_product/'.addnum($id))?>'><i class="j-large <?= icon('edit');?>"></i></a></td>
							<?php } ?>
						</tr>
						<?php
					}// end of while
					?>
				</table>
			</div>
		</center>
		<?php
	}else{
		?>
		<br>
		<center>
			<div class='j-text-color5'>
				<b><?=empty($searchtext)?"0 $status2 product found":"0 result found for <b><span class='j-text-color1'> '".remove_last_value($searchtext)."' </span> in ".$status2." product";?></b>
			</div>
		</center>
			<?php
		}// end of if $numRow
		
		require_once(file_location('admin_inc_path','pagination_button.inc.php'));
}// end of if isset
?>
<br><br><br><br>