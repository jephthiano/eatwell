<?php
if(isset($_GET)){
    require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
    require_once(file_location('inc_path','session_check_nologout.inc.php'));
    if(isset($_SESSION['user_id']) AND isset($u_id)){
        $total = get_numrow('wishlist_table','u_id',$u_id,"return",'no round');
        $or = multiple_content_data('wishlist_table','f_id',$u_id,'u_id',"ORDER BY w_id DESC LIMIT 0,12");
        if($or !== false){
            if($total > 12){?><a href="<?=file_location('home_url','account/wishlist/')?>"class='j-right j-text-color1 j-padding'><span class=''><b>SEE ALL &#10095</b></span></a><span class='j-clearfix'></span><?php }
            ?>
            <div class='j-vertical-scroll'>
                <?php                
                foreach($or AS $id){show_food($id,'horizontal');}
                ?>
            </div>
            <?php
        }else{
            ?><center><br><div class='j-text-color7'>You have no saved item, add items to wishlist to make shopping easy.</div><br></center><?php
        }
    }else{
        ?><center><br><div class='j-text-color7'>You have not signed in, log in and add items to wishlist to make shopping easy.</div><br></center><?php
    }
}
?>