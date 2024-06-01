<?php
if(empty($searchtext)){// if the search text is not empty
  //MAKING THE NEXT, CURRENT AND PREVIOUS BUTTON LINKS STARTS
  if($total_pages > 1){ //create next,previous and other links if pages are more than 1
    //setting the url
    if($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_admin_result.xhr.php'){ //for admin
      $url = "admin/{$status2}/";
    }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_social_handle_result.xhr.php'){ //for social_handle
      $url = "social_handle/";
    }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_message_result.xhr.php'){ //for message
      $url = "message/{$status2}/";
    }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_category_result.xhr.php'){ //for social_handle
      $url = "category/";
    }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_food_result.xhr.php'){ //for food
      $url = "food/{$status2}/";
    }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_user_result.xhr.php'){ //for user
      $url = "user/{$status2}/";
    }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_order_result.xhr.php'){ //for order
      $url = "order/{$status2}/";
    }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/transaction/get_transaction_result.xhr.php'){ //for all transaction
      $url = "transaction/all/{$status2}/";
    }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/transaction/get_annual_transaction_result.xhr.php'){ //for annual transaction
      $url = "transaction/annual/{$status2}/";
    }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/transaction/get_monthly_transaction_result.xhr.php'){ //for monthly transaction
      $url = "transaction/monthly/{$status2}/";
    }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/transaction/get_daily_transaction_result.xhr.php'){ //for daily transaction
      $url = "transaction/daily/{$status2}/";
    }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_refund_result.xhr.php'){ //for refund
      $url = "refund/{$new_url}/";
    }elseif($_SERVER['PHP_SELF'] === '/admin/ajax/get/get_log_result.xhr.php'){ //for log
      $url = "log/";
    }
    ?>
    <div class="j-center j-container">
      <br><br>
      <?php
      // previous button (if the page is not first page)
      if($current_page != 1){
        ?><a class='j-button j-color1 j-round j-left j-bolder'style='position:relative;top:-4px;'href="<?=file_location('admin_url',$url.($current_page-1).'/')?>"><<</a> <?php
      }
      // other pages start
      //for start and end pagination link
      if($current_page <= 2){$start_link = 1;}else{$start_link = $current_page-2;}
      if(($current_page + 2) > $total_pages){$end_link = $total_pages;}else{$end_link = $current_page + 2;}
      //for first page
      if($current_page  > 3){?><a class='j-button j-color5 j-tiny j-bolder' href="<?=file_location('admin_url',$url.'1'.'/')?>">1</a> <span style='margin:10px;position:relative;top:5px;'><b>...</b></span> <?php }
      for($i = $start_link; $i <= $end_link; $i++){
        if($i != $current_page){//  link the other pages except current page
          ?><a class='j-button j-color5 j-tiny j-bolder' href="<?=file_location('admin_url',$url.$i.'/')?>"><?=$i;?></a> <?php
        }else{// do not link the current page
          ?><span class='j-btn j-color1 j-tiny j-bolder'><?=$i;?></span> <?php
        }
      }//end of for
      //for last page
      if($current_page+2  < $total_pages){?><span style='margin:10px;position:relative;top:5px;'><b>...</b></span><a class='j-button j-color5 j-tiny' href="<?=file_location('admin_url',$url.$total_pages.'/')?>"><?=$total_pages;?></a> <?php }
      // next button (if the current page is not the last page)
      if($current_page != $total_pages){
        ?><a class='j-button j-color1 j-round j-right  j-bolder'style='position:relative;top:-4px;'href="<?=file_location('admin_url',$url.($current_page+1).'/')?>">>></a><?php
      }
      ?>
      </div>
    <br><br>
    <?php
  }// end of if($total_pages > 1)
  //MAKING THE NEXT, CURRENT AND PREVIOUS BUTTON LINKS ENDS
}
?>