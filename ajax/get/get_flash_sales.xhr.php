<?php
if(isset($_GET)){
    require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
    ?>
    <?//flash sale?>
    <div class='j-home-padding'style='margin:15px 0px;'>
        <div class='j-color4'>
            <div class='j-color5'><div class='j-padding j-large'><b>Flash Sale</b></div></div>
            <div class='j-vertical-scroll'>
                <?php
                // creating connection
                require_once(file_location('inc_path','connection.inc.php'));
                @$conn = dbconnect('admin','PDO'); 
                $sql = "SELECT f_id,(100-(f_original_price - f_discounted_price)*100) as discount FROM food_table WHERE f_status = 'available' ORDER BY discount ASC LIMIT 12";
                $stmt = $conn->prepare($sql);
                $stmt->bindColumn('f_id',$id);
                $stmt->execute();
                $numRow = $stmt->rowCount();
                if($numRow > 0){
                    while($stmt->fetch()){show_food($id,'horizontal');}
                }else{
                    ?><center><br><br><div class='j-text-color3'><b>No flash sale available at the moment</b></div></center><br><br><?php
                }
				?>
            </div>
        </div>
    </div>
    <? //for new arrival?>
    <div id='new_arrival'><center><br><br><span class='j-text-color1 j-spinner-border j-spinner-border j-large'></span> <br><br></center></div>
    <?php
}
?>