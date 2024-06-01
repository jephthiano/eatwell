<?php
if(isset($_GET)){
    require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
    ?>
    <?//Top category?>
    <div class='j-home-padding'style='margin:15px 0px;'>
        <div class='j-color4'>
            <div class='j-color3'><div class='j-padding j-large'><center><b>Top Categories</b></center></div></div>
            <div class='j-row'>
                <?php
                //GET THE CATEGORY
                // creating connection
                require_once(file_location('inc_path','connection.inc.php'));
                @$conn = dbconnect('admin','PDO');
                $sql = "SELECT f_id,COUNT(f_id) as total FROM order_table GROUP BY f_id ORDER BY total ASC LIMIT 12";
                $stmt = $conn->prepare($sql);
                $stmt->bindColumn('f_id',$id);
                $stmt->execute();
                $numRow = $stmt->rowCount();
                $data = [];
                if($numRow > 0){
                    while($stmt->fetch()){$data[] = content_data('food_table','f_category',$id,'f_id');}
                    $data = array_unique($data);
                    $data = re_key_array($data);
                    $total = count($data);
                    //ECHO THE GOTTEN CATEGORY
                    $category_data = '';
                    for($i = 0; $i < $total; $i++){
                        get_category($data[$i],'home_data');
                        if($i == ($total-1)){$category_data .= "'".$data[$i]."'";}else{$category_data .= "'".$data[$i]."',";}// dont add , for the last one
                    }
                }else{
                    $total = 0;
                }
                //IF THE CATEGORY IS NOT UP TO 12
                if($total < 12){ // if top category is not up to 12
                    $rem = (12 - $total);
                    if($total === 0){$category_data = "'unknown'";}
                    $sql = "SELECT DISTINCT f_category FROM food_table WHERE f_category NOT IN ({$category_data}) ORDER BY RAND() LIMIT 0,{$rem}";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindColumn('f_category',$category);
                    $stmt->execute();
                    $numRow = $stmt->rowCount();
                    if($numRow > 0){while($stmt->fetch()){get_category($category,'home_data');}}
                }
                ?>
                <? //for others?>
                <a href='<?=file_location('home_url','category/')?>'>
                <div class='j-col s6 m4 l3 xl3 j-padding j-section j-display-container j-clickable j-round'>
					<div class='j-color4 j-card-4 j-display-container j-text-color4 j-round'style="height:150px;background-image:url('<?=file_location('media_url','category/all.png')?>');background-size:cover;">
                        <div class='j-display-bottommiddle j-round'style='width:100%;background-color:rgba(0,0,0,0.7);min-height:30px;'>
                            <center><div class='j-medium'><b>See All Category</b></div></center>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
    <?php
}
?>