<div class='j-home-padding'style='margin:0px;margin-bottom:9px;'>
    <div class='j-color6'>
        <div class='j-large j-color7 j-text-color4 j-padding'>You may also like</div>
        <div id='recommended'><center><br><br><span class='j-text-color1 j-spinner-border j-spinner-border j-large'></span> <br><br></center></div>
    </div>
</div>
    <?php
$total = get_numrow('food_table','f_status','available',"return",'no round');
if($_SERVER['PHP_SELF'] === '/category/food.enc.php'){
    $reco_type = 'foods'; $reco_id = $val;
}elseif($_SERVER['PHP_SELF'] === '/food/index.php'){
    $reco_type = 'food_details'; $reco_id = $id;
}else{
    $reco_type = 'others'; $reco_id = 'others';
}
$reco_data = 'run_request';
?>