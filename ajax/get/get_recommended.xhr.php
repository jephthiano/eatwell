<?php
if(isset($_GET['i']) && isset($_GET['p'])){
    require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
	
    // validating and sanitizing val
	$va = test_input(($_GET['i']));
    
	// validating and sanitizing type
	$ty = ($_GET['p']);
	if(empty($ty)){$error[] = "type";}else{$type = test_input($ty);}
    
    if(empty($error)){
        $total = get_numrow('food_table','f_status','available',"return",'no round');
        if($type === 'foods'){
            $val = $va;
            $or = multiple_content_data('food_table','f_id','available','f_status',"AND f_category != '{$val}' ORDER BY RAND() LIMIT 0,12");
        }elseif($type === 'others'){
            $or = multiple_content_data('food_table','f_id','available','f_status',"ORDER BY RAND() LIMIT 0,12");
        }elseif($type === 'food_details'){
            $id = $va;
            $food_name = content_data('food_table','f_name',$id,'f_id');
            $food_category = content_data('food_table','f_category',$id,'f_id');
            $or = multiple_content_data('food_table','f_id','available','f_status',"AND f_name != '{$food_name}' AND f_category = '{$food_category}' ORDER BY RAND() LIMIT 0,12");
            if($or !== false){$total = count($or);}else{$total = 0;}
        }
        if($or !== false){
            if($total > 12){?><a href="<?=file_location('home_url','category/food/all/')?>"class='j-right j-text-color1 j-padding'><span class=''><b>SEE MORE &#10095</b></span></a><span class='j-clearfix'></span><?php }
            ?>
            <div class='j-vertical-scroll'>
                <?php
                foreach($or AS $id){show_food($id,'horizontal');}
                if($type === 'food_details' && $total < 12){
                    $rem = (12-$total);
                    $or = multiple_content_data('food_table','f_id','available','f_status',"AND f_category != '{$food_category}' ORDER BY RAND() LIMIT 0,{$rem}");
                    foreach($or AS $id){show_food($id,'horizontal');}
                }
                ?>
            </div>
            <?php
        }else{
            ?><center><br><div class='j-text-color7'>No recommendation at the moment</div><br></center><?php
        }
    }
}
?>