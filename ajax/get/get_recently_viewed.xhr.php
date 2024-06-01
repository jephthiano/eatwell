<?php
if(isset($_GET)){
    require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
    $view_token = get_viewed_token();
    $total = get_numrow('viewed_table','v_token',$view_token,"return",'no round');
    $or = multiple_content_data('viewed_table','f_id',$view_token,'v_token',"ORDER BY v_id DESC LIMIT 0,12");
    if($or !== false){
        ?>
        <div class='j-vertical-scroll'>
            <?php
            if($total > 12){?><a href="<?=file_location('home_url','account/viewed/')?>"class='j-right j-text-color1 j-padding'><span class=''><b>SEE ALL &#10095</b></span></a><span class='j-clearfix'></span><?php }
            foreach($or AS $id){show_food($id,'horizontal');}
            ?>
        </div>
        <?php
    }else{
        ?><center><br><div class='j-text-color7'>No viewed item at the moment, try browsing through our products</div><br></center><?php
    }
}
?>