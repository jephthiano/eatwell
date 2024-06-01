<?php
if(isset($_GET)){
    require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
    ?>
    <?//Top Deal?>
    <div class='j-home-padding'style='margin:15px 0px;'>
        <div class='j-color4'>
            <div class='j-color7'><div class='j-padding j-large'><b>Top Deals</b></div></div>
            <div class='j-vertical-scroll'>
                <?php
                //GET TOP DEAL
                // creating connection
                require_once(file_location('inc_path','connection.inc.php'));
                @$conn = dbconnect('admin','PDO');
                $sql = "SELECT f_id,COUNT(f_id) as total from order_table GROUP BY f_id ORDER BY total DESC LIMIT 12";
                $stmt = $conn->prepare($sql);
                $stmt->bindColumn('f_id',$id);
                $stmt->execute();
                $numRow = $stmt->rowCount();
                $data = [];
                if($numRow > 0){
                    while($stmt->fetch()){$data[] = $id;}
                    $data = array_unique($data);
                    $data = re_key_array($data);
                    $total = count($data);
                    //ECHO THE GOTTEN CATEGORY
                    $top_deal_data = '';
                    for($i = 0; $i < $total; $i++){
                        show_food($data[$i],'horizontal');
                        if($i == ($total-1)){$top_deal_data .= "'".$data[$i]."'";}else{$top_deal_data .= "'".$data[$i]."',";}// dont add , for the last one
                    }
                }else{
                    $total = 0;
                }
                //IF THE CATEGORY IS NOT UP TO 12
                if($total < 12){ // if top brand is not up to 12
                    $rem = (12 - $total);
                    if($total === 0){$top_deal_data = "'unknown'";}
                    $sql = "SELECT DISTINCT f_id FROM food_table WHERE f_id NOT IN ({$top_deal_data}) ORDER BY RAND() LIMIT 0,{$rem}";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindColumn('f_id',$id);
                    $stmt->execute();
                    $numRow = $stmt->rowCount();
                    if($numRow > 0){
                        while($stmt->fetch()){show_food($id,'horizontal');}
                    }else{
                        if($total === 0){
                            ?><center><br><br><div class='j-text-color3'><b>No top deal available at the moment</b></div></center><br><br><?php
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <? //for top category?>
    <div id='top_category'><center><br><br><span class='j-text-color1 j-spinner-border j-spinner-border j-large'></span> <br><br></center></div>
    <?php
}
?>