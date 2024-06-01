<div id="firstcol"style='line-height:27px;background-color:rgba(0,0,10,0.8);overflow-y:scroll;'>
    <a href="<?= file_location('admin_url','');?>"class="j-bar-item"style='padding:0px;'>
    <img src="<?=file_location('media_url','home/admin_logo.png')?>"class=''alt="<?=get_xml_data('company_name')?> LOGO IMAGE"style="width:100%;height:60px;">
    </a>
    <div class="j-text-color4"style='padding:20px 15px;background-image:url(<?=file_location('media_url','home/admin_image.png')?>)'>
        <div class='j-row'>
            <div class='j-col s4 xl3'>
                <img class='j-circle'src='<?=file_location('media_url',get_media('admin',$adid))?>'style="height:40px;width:40px">
            </div>
            <div class='j-col s8 xl9'style='position: relative;top:5px;left:5px;'>
                <span class='j-bolder'><?=ucwords(content_data('admin_table','ad_fullname',$adid,'ad_id'))?> </span>
            </div>
        </div>
        <center><div class=''><b>(<?=ucwords(check_level(content_data('admin_table','ad_level',$adid,'ad_id')))?>)</b></div></center>
    </div>
    <div class=''>
        <div class='j-xlarge j-text-color4 j-padding'><b>Dashboard</b></div>
        <div class="j-small"style=''>
            <?php if($adlevel == 3){?>
                <a href="<?= file_location('admin_url','misc/run_action/');?>"class="">
                <div class='<?=$_SERVER['PHP_SELF'] === '/admin/misc/run_action.enc.php'?'j-color4 j-text-color3':'j-text-color4'?> j-row j-padding'>
                    <b><span class="j-large j-col s3"><i class="<?=icon('hourglass-start')?>"></i> </span> <span class='j-col s9'>Run Action</span></b>
                </div>
                </a>
                <a href="<?= file_location('admin_url','misc/settings/');?>"class="">
                <div class='<?=$_SERVER['PHP_SELF'] === '/admin/misc/settings.enc.php'?'j-color4 j-text-color3':'j-text-color4'?> j-row j-padding'>
                    <b><span class="j-large j-col s3"><i class="<?=icon('cog')?>"></i> </span> <span class='j-col s9'>Site Settings</span></b>
                </div>
                </a>
                <a href="<?= file_location('admin_url','misc/site_data/');?>"class="">
                <div class='<?=$_SERVER['PHP_SELF'] === '/admin/misc/site_data.enc.php'?'j-color4 j-text-color3':'j-text-color4'?> j-row j-padding'>
                    <b><span class="j-large j-col s3"><i class="<?=icon('address-card')?>"></i> </span> <span class='j-col s9'>Site Data</span></b>
                </div>
                </a>
                
            <?php }?>
            <a href="<?= file_location('admin_url','refund/pending_refund/');?>"class="">
                <div class='<?=$_SERVER['PHP_SELF'] === '/admin/refund/index.php' && isset($status) && $status === 'pending refund'?'j-color4 j-text-color3':'j-text-color4'?> j-row j-padding'>
                    <?php
                    $add="AND or_refund = 'no' AND or_status IN ('failed','cancelled','returned','failed delivery')";
                    $numrow = get_numrow('order_table','or_payment_received','yes',"return",'round',$add);if($numrow === false){$numrow = 0;}
                    ?>
                    <b><span class="j-large j-col s3"><i class="<?=icon('hourglass-start')?>"></i> </span> <span class='j-col s9'>Pending Refund (<?=$numrow?>)</span></b>
                </div>
            </a>
            <?php if($adlevel == 3){?>
                <a href="<?= file_location('admin_url','admin/all/');?>"class="">
                <div class='
                    <?=$_SERVER['PHP_SELF'] === '/admin/admin/index.php' || $_SERVER['PHP_SELF'] === '/admin/admin/preview_admin.enc.php' || $_SERVER['PHP_SELF'] === '/admin/admin/insert_admin.enc.php'?'j-color4 j-text-color3':'j-text-color4'?> 
                    j-row j-padding'>
                  <b><span class="j-large j-col s3"><i class='<?=icon('users')?>'></i> </span> <span class='j-col s9'> Admin</span></b>
                </div>
                </a>
            <?php } ?>
            <?php if($adlevel > 1){ ?>
                <a href="<?= file_location('admin_url','social_handle/');?>"class="">
                <div class='
                    <?=$_SERVER['PHP_SELF'] === '/admin/social_handle/index.php' || $_SERVER['PHP_SELF'] === '/admin/social_handle/preview_social_handle.enc.php' || $_SERVER['PHP_SELF'] === '/admin/social_handle/insert_social_handle.enc.php' || $_SERVER['PHP_SELF'] === '/admin/social_handle/update_social_handle.enc.php'?'j-color4 j-text-color3':'j-text-color4'?> 
                    j-row j-padding'>
                    <b><span class="j-large j-col s3"><i class='<?=icon('scribd','fab')?>'></i> </span> <span class='j-col s9'>Soc-Handles</span></b>
                </div>
                </a>
            <?php } ?>
                <a href="<?= file_location('admin_url','message/all/');?>"class="">
                <div class='
                    <?=$_SERVER['PHP_SELF'] === '/admin/message/index.php' || $_SERVER['PHP_SELF'] === '/admin/message/preview_message.enc.php' || $_SERVER['PHP_SELF'] === '/admin/message/send_email.enc.php'?'j-color4 j-text-color3':'j-text-color4'?>
                    j-row j-padding'>
                    <b>
                        <span class="j-large j-col s3"><i class='<?=icon('envelope')?>'></i> </span>
                        <?php $numrowms = get_numrow('message_table','m_status','new',"return",'round');?>
                        <span class='j-col s9'>Messages (<?=$numrowms?>)</span>
                    </b>
                </div>
                </a>
                <a href="<?= file_location('admin_url','category/');?>"class="">
                <div class='
                    <?=$_SERVER['PHP_SELF'] === '/admin/category/index.php' || $_SERVER['PHP_SELF'] === '/admin/category/preview_category.enc.php' || $_SERVER['PHP_SELF'] === '/admin/category/insert_category.enc.php' || $_SERVER['PHP_SELF'] === '/admin/category/update_category.enc.php'?'j-color4 j-text-color3':'j-text-color4'?> 
                    j-row j-padding'>
                    <b><span class="j-large j-col s3"><i class='<?=icon('list-ul')?>'></i> </span> <span class='j-col s9'>Category</span></b>
                </div>
                </a>
                <a href="<?= file_location('admin_url','food/available/');?>"class="">
                <div class='
                    <?=$_SERVER['PHP_SELF'] === '/admin/food/index.php' || $_SERVER['PHP_SELF'] === '/admin/food/preview_food.enc.php' || $_SERVER['PHP_SELF'] === '/admin/food/insert_food.enc.php' || $_SERVER['PHP_SELF'] === '/admin/food/update_food.enc.php'?'j-color4 j-text-color3':'j-text-color4'?> 
                    j-row j-padding'>
                    <b><span class="j-large j-col s3"><i class='<?=icon('hamburger')?>'></i> </span> <span class='j-col s9'>Foods</span></b>
                </div>
                </a>
                <a href="<?= file_location('admin_url','user/all/');?>"class="">
                <div class='
                    <?=$_SERVER['PHP_SELF'] === '/admin/user/index.php' || $_SERVER['PHP_SELF'] === '/admin/user/preview_user.enc.php'?'j-color4 j-text-color3':'j-text-color4'?> 
                    j-row j-padding'>
                    <b><span class="j-large j-col s3"><i class='<?=icon('users')?>'></i> </span> <span class='j-col s9'>Users</span></b>
                </div>
                </a>
                <a href="<?= file_location('admin_url','order/all/');?>"class="">
                <div class='
                    <?=$_SERVER['PHP_SELF'] === '/admin/order/index.php' || $_SERVER['PHP_SELF'] === '/admin/order/preview_orders.enc.php' || $_SERVER['PHP_SELF'] === '/admin/order/preview_order.enc.php' || $_SERVER['PHP_SELF'] === '/admin/order/user_all_orders.enc.php' || $_SERVER['PHP_SELF'] === '/admin/order/print_order.enc.php'?'j-color4 j-text-color3':'j-text-color4'?>
                    j-row j-padding'>
                    <b>
                        <span class="j-large j-col s3"><i class='<?=icon('shopping-cart')?>'></i> </span>
                        <?php $numrow = get_numrow('order_table','or_status','order placed',"return",'round');if($numrow === false){$numrow = 0;}?>
                        <span class='j-col s9'>Orders (<?=$numrow?>)</span>
                    </b>
                </div>
                </a>
                <?php if($adlevel == 3){?>
                <a href="<?= file_location('admin_url','transaction/');?>"class="">
                <div class='
                    <?=$_SERVER['PHP_SELF'] === '/admin/transaction/index.php' || $_SERVER['PHP_SELF'] === '/admin/transaction/preview_transaction.enc.php' || $_SERVER['PHP_SELF'] === '/admin/transaction/all.enc.php' || $_SERVER['PHP_SELF'] === '/admin/transaction/annual.enc.php' || $_SERVER['PHP_SELF'] === '/admin/transaction/monthly.enc.php' || $_SERVER['PHP_SELF'] === '/admin/transaction/daily.enc.php'?'j-color4 j-text-color3':'j-text-color4'?> 
                    j-row j-padding'>
                    <b><span class="j-large j-col s3"><i class='<?=icon('credit-card')?>'></i> </span> <span class='j-col s9'>Transactions</span></b>
                </div>
                </a>
                <a href="<?= file_location('admin_url','refund/refund/');?>"class="">
                <div class='
                    <?=($_SERVER['PHP_SELF'] === '/admin/refund/index.php' && isset($status) && $status !== 'pending refund') || $_SERVER['PHP_SELF'] === '/admin/refund/preview_transaction.enc.php' ?'j-color4 j-text-color3':'j-text-color4'?> 
                    j-row j-padding'>
                    <b><span class="j-large j-col s3"><i class='<?=icon('credit-card')?>'></i> </span> <span class='j-col s9'>Refunds</span></b>
                </div>
                </a>
                <a href="<?= file_location('admin_url','log/');?>"class="">
                <div class='
                    <?=$_SERVER['PHP_SELF'] === '/admin/log/index.php' || $_SERVER['PHP_SELF'] === '/admin/log/preview_log.enc.php'?'j-color4 j-text-color3':'j-text-color4'?>
                    j-row j-padding'>
                    <b>
                        <span class="j-large j-col s3"><i class='<?=icon('file-alt')?>'></i> </span>
                        <span class='j-col s9'>Logs</span>
                    </b>
                </div>
                </a>
                <?php } ?>
        </div>
    </div>
</div>