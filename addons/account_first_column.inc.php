<div class='j-color4 j-bolder j-hide-small j-hide-medium j-padding-flexible j-medium'style='margin-top:8px;'>
    <div style='line-height:40px;'>
        <a href="<?=file_location('home_url','account/')?>"><div class='<?=$_SERVER['PHP_SELF'] === '/account/index.php'?'j-color5':'j-color4'?> j-padding'style='width:100%;'>My Account</div></a>
        <a href="<?=file_location('home_url','account/edit_profile/')?>"><div class='<?=$_SERVER['PHP_SELF'] === '/account/edit_profile.enc.php'?'j-color5':'j-color4'?> j-padding'style='width:100%;'>Edit Profile</div></a>
        <a href="<?=file_location('home_url','account/change_password/')?>"><div class='<?=$_SERVER['PHP_SELF'] === '/account/change_password.enc.php'?'j-color5':'j-color4'?> j-padding'style='width:100%;'>Change Password</div></a>
        <a href="<?=file_location('home_url','order/'.rawurlencode('order placed').'/')?>"><div class='<?=$_SERVER['PHP_SELF'] === '/order/index.php' || $_SERVER['PHP_SELF'] === '/order/order_details.enc.php' ||$_SERVER['PHP_SELF'] === '/order/track.enc.php'?'j-color5':'j-color4'?> j-padding'style='width:100%;'>Orders</div></a>
        <a href="<?=file_location('home_url','inbox/')?>"><div class='<?=$_SERVER['PHP_SELF'] === '/inbox/index.php' || $_SERVER['PHP_SELF'] === '/inbox/message.enc.php'?'j-color5':'j-color4'?> j-padding'style='width:100%;'>Inbox</div></a>
        <a href="<?=file_location('home_url','account/wishlist/')?>"><div class='<?=$_SERVER['PHP_SELF'] === '/account/wishlist.enc.php'?'j-color5':'j-color4'?> j-padding'style='width:100%;'>Wishlist</div></a>
        <a href="<?=file_location('home_url','account/contact/')?>"><div class='<?=$_SERVER['PHP_SELF'] === '/account/contact.enc.php'?'j-color5':'j-color4'?> j-padding'style='width:100%;'>Contact Details</div></a>
        <a href="<?=file_location('home_url','account/viewed/')?>"><div class='<?=$_SERVER['PHP_SELF'] === '/account/viewed.enc.php'?'j-color5':'j-color4'?> j-padding'style='width:100%;'>Viewed</div></a>
        <a href="<?=file_location('home_url','review/')?>"><div class='<?=$_SERVER['PHP_SELF'] === '/review/index.php' || $_SERVER['PHP_SELF'] === '/review/add_review.enc.php'?'j-color5':'j-color4'?> j-padding'style='width:100%;'>Pending Reviews</div></a>
    </div>
    <hr>
    <center>
        <div class='j-btn j-color1 j-center j-margin j-round'style='display:block'onclick="$('#log_out_modal').fadeIn('slow');">Logout</div>
        <div class='j-btn j-color1  j-center j-margin j-round'style='display:block'onclick="$('#delete_account_modal').fadeIn('slow');">Delete Account</div>
    </center>
    <br>
</div>
<?php  user_modal('user_delete_account');$log_delete = 'enabled'?>