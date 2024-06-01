<?php
//MODAL FUNCTION STARTS
//user modal starts
function user_modal($type,$id='none',$subtype=''){
 if($type === 'user_log_out'){
 ?>
 <!--logout modal starts-->
 <center>
  <div id="log_out_modal"class="j-modal j-modal-click">
   <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1"style="width:98%;max-width:400px;height:auto;">
    <div class="j-display-container j-center">
     <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#log_out_modal').fadeOut('slow');"></span>
     <div class="j-container j-text-color1"><p><b>Log Out?</b></p></div>
     <div>
      <h5 class="j-text-color3">Are you sure want to log out of your account?</h5><hr>
							<p style='display:inline'><button id='lobtn'class="j-margin j-btn j-round-large j-color1 j-text-color4"onClick="lg();">Log Out</button></p>
       <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color3 j-hover-color1 j-round-large"onclick="$('#log_out_modal').fadeOut('slow');">Cancel</button></p>
					</div>
    </div>
   </div>
  </div>
	</center>
	<!--logout modal ends-->
 <?php
 }elseif($type === 'user_delete_account'){
  ?>
  <!--deleteadmin modal starts-->
  <center>
   <div  id="delete_account_modal" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <div class="j-display-container j-center">
      <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#delete_account_modal').fadeOut('slow');"></span>
      <div class="j-container j-text-color1"><p><b>Delete Account?</b></p></div>
      <div>
       <h5 class="j-text-color3">Are you sure want to delete your account?. The action cannot be reverse.</h5><hr>
       <span class='j-text-color1 mg j-left'id='pse'></span>
       <input type="password"class=" j-input j-medium j-border j-border-color5 j-round-large"placeholder="Password"
          name="ps"id="ps"value=""style="width:100%;"/>
							<p style='display:inline'><button type="submit"id='dabtn'class="j-margin j-btn j-round j-color1 j-text-color4"onClick="da($('#ps'))">Delete Account</button></p>
       <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color1 j-hover-color1 j-round" onclick="$('#delete_account_modal').fadeOut('slow');">Cancel</button></p>
      </div>
     </div>
    </div>
   </div>
  </center>
  <!--deleteadmin modal ends-->
  <?php
 }elseif($type === 'account'){
  ?>
  <!--account dropdown starts-->
      <div id=''class='dropdown-content j-medium j-account-dropdown-position j-color4 j-card j-padding'
      style='line-height:25px;z-index:2;display:none;'>
       <?php
       if(isset($_SESSION['user_id'])){
        ?><a href='<?=file_location('home_url','account/')?>' class='j-bolder'><p>Profile</p></a><?php
       }else{
        ?><span class='j-bolder j-text-color1 j-clickable'onclick="$('#account_modal').fadeOut('slow');$('#login_modal').fadeIn('slow');"><p>Login/Sign Up</p></span><?php
       }
       ?>
       <a class='j-clickable'href='<?=file_location('home_url','order/order placed/')?>'><p>Orders</p></a>
       <a class='j-clickable'href='<?=file_location('home_url','account/wishlist/')?>'><p>Wishlist</p></a>
       <a class='j-clickable'href='<?=file_location('home_url','account/viewed/')?>'><p>Recently Viewed</p></a>
       <a class='j-clickable'href='<?=file_location('home_url','review/')?>'><p>Pending Reviews</p></a>
       <?php
       if(isset($_SESSION['user_id'])){?><span class='j-text-color4 j-clickable j-round j-btn j-color1'onclick="$('#account_modal').fadeOut('slow');$('#log_out_modal').fadeIn('slow');">Logout</span><?php }
       ?>
      </div>
  <!--account dropdown ends-->
  <?php
 }elseif($type === 'settings'){
  ?>
  <!--settings modal starts-->
   <div  id="settings_modal" class="j-modal j-modal-click j-large j-hide-large j-hide-xlarge">
    <div class="j-card-4 j-modal-content j-modal-content-support2 j-light-color5 j-round-large j-padding j-text-color3" style="width:98%; max-width:400px;height: auto;">
     <div class="j-medium">
      <a href='<?=file_location('home_url','account/')?>'class="j-text-color3"><p><b>Account</b></p></a><hr>
      <div class='j-bolder'style='line-height:35px;'>
       <a href='<?=file_location('home_url','account/edit_profile/')?>'><p>Edit Profile</p></a>
       <a href='<?=file_location('home_url','account/change_password/')?>'><p>Change Password</p></a>
       <a href='<?=file_location('home_url','order/order placed/')?>'><p>Orders</p></a>
       <a href='<?=file_location('home_url','account/wishlist/')?>'><p>Wishlist</p></a>
       <a href='<?=file_location('home_url','account/contact/')?>'><p>Contact Details</p></a>
       <a href='<?=file_location('home_url','account/viewed/')?>'><p>Recently Viewed</p></a>
       <a href='<?=file_location('home_url','review/')?>'><p>Pending Reviews</p></a>
       <p class='j-text-color1'onclick="$('#log_out_modal').fadeIn('slow');$('#settings_modal').fadeOut('slow');">Logout</p>
       <p class='j-text-color1'onclick="$('#delete_account_modal').fadeIn('slow');$('#settings_modal').fadeOut('slow');">Delete Account</p>
      </div>
     </div>
    </div>
   </div>
  <!--settings modal ends-->
  <?php
 }elseif($type === 'cancel_order'){
  ?>
  <!--cancel order modal starts-->
   <div  id="cancel_order<?=$id?>" class="j-modal">
    <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <br>
     <div class="">
      <div>
       <div class="j-text-color3"><b>Tell us why you want to cancel this order?</b></div>
       <br>
       <select name='r'id='r<?=$id?>'class='j-select j-color4 j-round j-border-2 j-border-color5'style="width:100%;max-width:400px;">
        <option value="">Select reason</option>
        <option value="i don't like this food">I don't like this food</option>
        <option value="i want to order another food">I want to order another food</option>
        <option value="i'm not interested in the food anymore">I'm not interested in the food anymore</option>
       </select><br><br>
       <button type="submit"id='cbtn<?=$id?>'style='margin-bottom:9px;width:100%'class="j-btn j-round j-color1 j-text-color4"
       onClick="cos(<?=$id?>,'cancelled');">Cancel Order</button>
       <button class="j-btn j-color6 j-text-color4 j-round j-border j-border-color1"style='width:100%'onclick="$('#cancel_order<?=$id?>').fadeOut('slow');">Close</button>
      </div>
     </div>
     <br>
    </div>
   </div>
  <!--cancel order modal ends-->
  <?php
 }elseif($type === 'remove_item'){
  ?>
  <!--remove from cart  modal starts-->
   <center>
    <div  id="remove_item<?=$id?>" class="j-modal j-modal-click">
     <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
      <div class="j-display-container j-center">
       <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#remove_item<?=$id?>').fadeOut('slow');"></span>
       <div class="j-container j-text-color1"><p><b>Remove this item from cart?</b></p></div>
       <div>
        <h5 class="j-text-color3">Are you sure want to remove this item from cart?.</h5><hr>
        <p style='display:inline;'><button id='rmbtn<?=$id?>'type="submit"class="j-margin j-btn j-hover-color5 j-round j-color1 j-text-color4"onClick="rc(<?=$id?>);">Remove Item</button></p>
        <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color1 j-hover-color5 j-round" onclick="$('#remove_item<?=$id?>').fadeOut('slow');">Cancel</button></p>
       </div>
      </div>
     </div>
    </div>
   </center>
  <!--remove from cart  modal ends-->
  <?php
 }elseif($type === 'contact_modal'){
  if(isset($_SESSION['user_id'])){global $u_id;}else{$u_id = '';}
  if($subtype === 'change_contact_modal'){
   ?>
   <!--change contact modal starts-->
    <div  id="change_contact_modal" class="j-modal j-modal-click j-large">
    <div class="j-card-4 j-modal-content j-light-color5 j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <div class="j-display-container">
      <div class="j-text-color3 j-bolder"><p>Contact Details</p></div>
      <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#change_contact_modal').fadeOut('slow');"></span>
      <div class='j-medium'>
       <div>
        <div onclick="$('#change_contact_modal').fadeOut('slow');$('#add_contact_modal').fadeIn('slow');"class='j-clickable'style='margin-bottom:9px;'>
         <span class='j-color1 j-round j-bolder j-tiny'style='padding:5px;'><i class='<?=icon('plus')?>'></i></span><span class='j-large'style='margin-left:9px;'>Add New Address</span>
        </div>
        <?php
        $or = multiple_content_data('user_contact_table','uc_id',$u_id,'u_id',"ORDER BY uc_status DESC");
        if($or !== false){
        ?>
        <div class='j-row'>
         <?php foreach($or AS $id){
          user_modal('contact_modal',$id,'delete_contact');
          $status = content_data('user_contact_table','uc_status',$id,'uc_id','','null');
          ?>
          <div class='j-text-color3'>
          <?php get_contact_detail($id,'account');?>
          </div>
          <div class='j-row'style='position:relative;top:;'>
           <div class='j-col s6'>
            <?php
            if($status === 'default'){
             ?><div class='j-color5 j-padding j-center j-bolder'>Default Address</div><?php
            }else{
             ?><button id='btn<?=$id?>'class='j-color1 j-padding j-center j-bolder j-clickable'onclick="scad(<?=$id?>,'chk');">Select This</button><?php
            }
            ?>
           </div>
           <div class='j-col s6'>
            <span class='j-right j-large j-text-color1 j-bolder'>
             <span onclick="$('#change_contact_modal').fadeOut('slow');$('#edit_contact_modal<?=$id?>').fadeIn('slow');"><i class='<?=icon('edit')?>'></i></span>
             <?php if(content_data('user_contact_table','uc_status',$id,'uc_id') === 'none'){
              ?><span onclick="$('#delete_contact<?=$id?>').fadeIn('slow');"style='margin-left:30px;'><i class='<?=icon('trash')?>'></i></span><?php
              }?>
             </span>
            <br class='clearfix'>
           </div>
          </div>          
         <?php
         }
        }
        ?>
        </div>
       </div>
      </div>
      <br>
     </div>
    </div>
   </div>
  <!--change contact modal ends-->
   <?php
  }elseif($subtype === 'add_contact_modal'){
   ?>
   <!--add contact modal starts-->
   <div  id="add_contact_modal" class="j-modal j-modal-click j-large">
    <div class="j-card-4 j-modal-content j-light-color5 j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <div class="j-display-container">
      <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#add_contact_modal').fadeOut('slow');"></span>
      <div class="j-text-color1"><p><b>Add New Contact Details</b></p></div>
      <div>
       <div class='j-medium j-text-color3'>
        <form id='adctfrm'>
         <label><b>Fullname: </b><span class='mg j-text-color1'id='acfne'></span></label><br>
         <input type='text'id='acfn'name='acfn'class="ip j-input j-color4 j-round j-border-2 j-border-color5"
         value=''placeholder='Fullname'maxlength='50'style="width:100%;max-width:400px;"/><br>
         
         <label><b>Address: </b><span class='mg j-text-color1'id='acade'></span></label><br>
         <textarea name='acad'class='j-input j-medium j-color4 j-round j-border-2 j-border-color5'placeholder='Address'maxlength='350'
          style="width:100%;max-width:400px;"></textarea><br>
           
         <label><b>Region: </b><span class='mg j-text-color1'id='acrge'></span></label><br>
         <select name='acrg'class='j-select j-color4 j-round j-border-2 j-border-color5'style="width:100%;max-width:400px;">
          <option value=''>Select region</option><?php get_region()?>
         </select><br><br>
         
         <label><b>Phone Number: </b><span class='mg j-text-color1'id='acphe'></span></label><br>
         <input type='tel'id='acph'name='acph'class="ip j-input j-color4 j-round j-border-2 j-border-color5"
          value=''placeholder='Phone Number'maxlength='50'style="width:100%;max-width:400px;"/><br>
         
         <label><b>Additional Phone Number: </b><span class='mg j-text-color1'id='acph2e'></span></label><br>
         <input type='tel'id='acph2'name='acph2'class="ip j-input j-color4 j-round j-border-2 j-border-color5"
          value=''placeholder='Additional Phone Number'maxlength='50'style="width:100%;max-width:400px;"/><br>
          
         <input type='checkbox'class='j-check'name='dflt'value='dflt'/><span class='j-bolder j-text-color3'style='margin-left:9px;'>Set as Default</span><br><br>
         
         <button type='submit'id='acbtn'class="j-btn j-medium j-color1 j-round j-bolder"style="width:100%;max-width:400px;">Add Contact</button>
        </form>
       </div>
      </div>
     </div>
    </div>
   </div>
  <!--add contact modal ends-->
  <?php
  }elseif($subtype === 'edit_contact_modal'){
   ?>
   <!--edit contact modal starts-->
   <div id="edit_contact_modal<?=$id?>" class="j-modal j-modal-click j-large">
    <div class="j-card-4 j-modal-content j-light-color5 j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <div class="j-display-container">
      <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#edit_contact_modal<?=$id?>').fadeOut('slow');"></span>
      <div class="j-text-color1"><p><b>Edit Contact Details</b></p></div>
      <div>
       <div class='j-medium j-text-color3'>
        <form class=''id='etctfrm<?=$id?>'>
         <label><b>Fullname: </b><span class='mg j-text-color1'id='ecfne'></span></label><br>
         <input type='text'id='ecfn'name='ecfn'class="ip j-input j-color4 j-round j-border-2 j-border-color5"
         value='<?=content_data('user_contact_table','uc_fullname',$id,'uc_id')?>'placeholder='Fullame'maxlength='50'style="width:100%;max-width:400px;"/><br>
         
         <label><b>Address: </b><span class='mg j-text-color1'id='ecade'></span></label><br>
         <textarea name='ecad'class='j-input j-medium j-color4 j-round j-border-2 j-border-color5'placeholder='Address'maxlength='350'
          style="width:100%;max-width:400px;"><?=content_data('user_contact_table','uc_address',$id,'uc_id')?></textarea><br>
           
         <label><b>Region: </b><span class='mg j-text-color1'id='ecrge'></span></label><br>
         <select name='ecrg'class='j-select j-color4 j-round j-border-2 j-border-color5'style="width:100%;max-width:400px;">
          <option value=''>Select region</option><?php get_region(content_data('user_contact_table','uc_region',$id,'uc_id'))?>
         </select><br><br>
         
         <label><b>Phone Number: </b><span class='mg j-text-color1'id='ecphe'></span></label><br>
         <input type='tel'id='ecph'name='ecph'class="ip j-input j-color4 j-round j-border-2 j-border-color5"
          value='<?=content_data('user_contact_table','uc_phnumber1',$id,'uc_id')?>'placeholder='Phone Number'maxlength='50'style="width:100%;max-width:400px;"/><br>
         
         <label><b>Additional Phone Number: </b><span class='mg j-text-color1'id='ecph2e'></span></label><br>
         <input type='tel'id='ecph2'name='ecph2'class="ip j-input j-color4 j-round j-border-2 j-border-color5"
          value='<?=content_data('user_contact_table','uc_phnumber2',$id,'uc_id')?>'placeholder='Additional Phone Number'maxlength='50'style="width:100%;max-width:400px;"/><br>
         
         <input type='hidden'name='cid'value='<?=addnum($id)?>'/>
         
         <button type='submit'class="ecbtn j-btn j-medium j-color1 j-round j-bolder"style="width:100%;max-width:400px;">Save</button>
        </form>
       </div>
      </div>
     </div>
    </div>
   </div>
  <!--edit contact modal ends-->
  <?php
  }elseif($subtype === 'delete_contact'){
   ?>
   <!--deleteadmin modal starts-->
   <center>
    <div  id="delete_contact<?=$id?>" class="j-modal j-modal-click">
     <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
      <div class="j-display-container j-center">
       <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#delete_contact<?=$id?>').fadeOut('slow');"></span>
       <div class="j-container j-text-color1"><p><b>Delete this contact details?</b></p></div>
       <div>
        <h5 class="j-text-color3">Are you sure want to delete the contact details?. The contact details will be permanently deleted.</h5><hr>
        <p style='display:inline;'><button id='dcbtn<?=$id?>'type="submit"class="j-margin j-btn j-hover-color5 j-round j-color1 j-text-color4"onClick="duc(<?=$id?>)">Delete Contact</button></p>
        <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color1 j-hover-color5 j-round" onclick="$('#delete_contact<?=$id?>').fadeOut('slow');">Cancel</button></p>
       </div>
      </div>
     </div>
    </div>
   </center>
   <!--deleteadmin modal ends-->
  <?php
  }
 }elseif($type === 'login_signup'){
  ?>
  <?php $company = ucwords(get_xml_data('company_name'));$pry_color = get_json_data('primary_color','color');?>
  <div id='login_modal'class='j-modal'>
   <div class='j-card-4 j-modal-content j-modal-content-support2 j-color4'>
    <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#login_modal').fadeOut('slow');"></span>
    <div class='j-padding'>
     <center class='j-text-color1 j-bolder j-large'>
      <img src="<?=file_location('media_url','home/logo.png')?>"class=''style="width:150px;height:50px;">
     </center>
     <div class='j-center j-padding j-bolder j-large'>
      <div style='display:inline;color:<?=$pry_color?>;border-bottom:solid 2px <?=$pry_color?>'class='laucher2 j-padding j-clickable'onclick="sgrghrn('signin',this);">
       Sign In
      </div>
      <div style='display:inline;'class='laucher2 j-padding j-clickable'onclick="sgrghrn('register',this);">
       Register
      </div>
     </div>
     <div>
      <div>
       <div class='trigger2'id='signin'>
        <form id='lgfrm'onsubmit="event.preventDefault();">
         <br><br>
         <input type="text"class="j-input j-medium j-border j-border-color5 j-round-large"minlength="3"maxlength="30"placeholder="Email"
             name="uemail"id="uemail"value=""style="width:100%;max-width:400px;outline:none;"/><br>
         
         <input type="password"class="j-input j-medium j-border j-border-color5 j-round-large"maxlength="70"minlength="7"
             placeholder="Password" name="pd"id="pd"value=""style="width:100%;max-width:400px;outline:none;"/><br>
             
         <input type="hidden"name="re"value="<?=$id;?>">
         <a class="j-right j-text-color3 j-bolder"href="<?=file_location('home_url','forgot_password/');?>">Forget Your Password?</a><br class='j-clearfix'><br>
         <button type='submit'id='lgbtn'class="j-btn j-medium j-color1 j-round-large j-bolder"style='width:100%;'>Log In</button>
         <br><br>
        </form>
       </div>
       <div class='trigger2'id='register'style='display:none;'>
        <form id='sufrm'onsubmit="event.preventDefault();">
         <br><br>
         <span class='mg j-text-color1 j-left'id='emae'></span>
         <input type="text"class="j-input j-medium j-border j-border-color5 j-round-large"minlength="3"maxlength="70"placeholder="Email"
          name="ema"id="ema"value=""style="width:100%;max-width:400px;outline:none;"/><br>
         
         <span class='mg j-text-color1 j-left'id='name'></span>
         <input type="text"class="j-input j-medium j-border j-border-color5 j-round-large"minlength="3"maxlength="50"placeholder="Fullname"
          name="nam"id="nam"value=""style="width:100%;max-width:400px;outline:none;"/><br>
         
         <span class='mg j-text-color1 j-left'id='pde'></span>
         <input type="password"class="j-input j-medium j-border j-border-color5 j-round-large"maxlength="40"minlength="7"placeholder="Password"
          name="pd"value=""style="width:100%;max-width:400px;outline:none;"/><br>
          
         <input type="hidden"name="re"value="<?=$id;?>">
         
         <button type='submit'id='subtn'class="j-btn j-medium j-color1 j-round-large j-bolder"style='width:100%;'>Sign Up</button>
         <br><br>
        </form>
       </div>
      </div>
     </div>
    </div>
    <br>
   </div>
  </div>
<?php
 }
}
// user modal ends

//admin modal starts
function admin_modal($type,$id='none',$subtype=''){
 if($type === 'admin_log_out'){
 ?>
 <!--logout modal starts-->
 <center>
  <div id="log_out_modal"class="j-modal j-modal-click">
   <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1"style="width:98%;max-width:400px;height:auto;">
    <div class="j-display-container j-center">
     <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#log_out_modal').fadeOut('slow');"></span>
     <div class="j-container j-text-color1"><p><b>Log Out?</b></p></div>
     <div>
      <h5 class="j-text-color3">Are you sure want to log out of your account?</h5><hr>
							<p style='display:inline'><button id='lobtn'class="j-margin j-btn j-round-large j-color1 j-text-color4"onClick="lg();">Log Out</button></p>
       <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color3 j-hover-color1 j-round-large"onclick="$('#log_out_modal').fadeOut('slow');">Cancel</button></p>
					</div>
    </div>
   </div>
  </div>
	</center>
	<!--logout modal ends-->
 <?php
 }elseif($type === 'admin_delete_account'){
  ?>
  <!--deleteadmin modal starts-->
  <center>
   <div  id="delete_account_modal" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <div class="j-display-container j-center">
      <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#delete_account_modal').fadeOut('slow');"></span>
      <div class="j-container j-text-color1"><p><b>Delete Account?</b></p></div>
      <div>
       <h5 class="j-text-color3">Are you sure want to delete your account?. The action cannot be reverse.</h5><hr>
       <span class='j-text-color1 mg j-left'id='pse'></span>
       <input type="password"class=" j-input j-medium j-border j-border-color5 j-round-large"placeholder="Password"
          name="ps"id="ps"value=""style="width:100%;"/>
							<p style='display:inline'><button type="submit"id='dabtn'class="j-margin j-btn j-round j-color1 j-text-color4"onClick="da($('#ps'))">Delete Account</button></p>
       <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color1 j-hover-color1 j-round" onclick="$('#delete_account_modal').fadeOut('slow');">Cancel</button></p>
      </div>
     </div>
    </div>
   </div>
  </center>
  <!--deleteadmin modal ends-->
  <?php
 }
}
//admin modal ends

function image_modal($type,$id,$s_id=-1500000000){
 if(get_media($type,$id) !== 'home/no_media.png' && get_media($type,$id) !== 'home/avatar.png'){$image = 'exists';}else{$image = 'no image';} //check if image exists
 ?>
 <div id="<?=$type.$id?>_pics_modal" class="j-modal">
  <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-teal">
   <div class="j-display-container">
    <div class="j-line-height j-text-color1">
     <div class='j-clickable j-row'onclick="$('#<?=$type.$id?>_pics_modal').fadeOut('slow');ti($('#<?=$type.$id?>_pics'))">
      <div class="j-col s1"> <i class='<?= icon('upload');?>'></i> </div>
      <div class="j-col s11 j-bolder"><?= $image === 'exists'?'Change':'Upload'?> Image</div>
     </div>
     <input type="file"name="<?=$type?>_pics"id="<?=$type.$id?>_pics"class="j-round j-hide"onchange="ci(this,'<?=$type?>',<?=addnum($id)?>,<?=addnum($s_id)?>);">
     <?php
     if($image === 'exists'){
      ?>
      <div class='j-clickable j-row' onclick="$('#remove_<?=$type.$id?>_image_modal').fadeIn('slow');$('#<?=$type.$id?>_pics_modal').fadeOut('slow');">
       <div class="j-col s1"> <i class='<?= icon('times');?>'></i> </div>
       <div class="j-col s11 j-bolder">Remove Image</div>
      </div>
      <?php
      }
      ?>
   </div>
   </div>
  </div>
 </div>
 <!--remove image modal starts-->
  <center>
   <div  id="remove_<?=$type.$id?>_image_modal" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <div class="j-display-container j-center">
      <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#remove_<?=$type.$id?>_image_modal').fadeOut('slow');"></span>
      <div class="j-container j-text-color1"><p><b>Remove Image?</b></p></div>
      <div>
       <h5 class="j-text-color3">Are you sure want to remove the image? The action cannot be reverse.</h5><hr>
							<p style='display:inline'><button type="submit"id='rmbtn<?=$id?>'class="rmbtn j-margin j-btn j-round j-color1 j-text-color4"onClick="ri('<?=$type?>',<?=addnum($id)?>);">Remove</button></p>
       <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color1 j-hover-color1 j-round" onclick="$('#remove_<?=$type.$id?>_image_modal').fadeOut('slow');">Cancel</button></p>
      </div>
     </div>
    </div>
   </div>
  </center>
  <!--remove image modal ends-->
 <?php
 }
//image modal ends

//preview modal starts
function preview_modal($type,$id=''){
 ?>
 <?php //STARTS OF SUB MODAL?>
  <?php if($type === 'admin'){
   //<!--update level modal for admin starts-->
   ?>
  <center>
   <div  id="update_<?=$type.$id?>" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <div class="j-display-container j-center">
      <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#update_<?=$type.$id?>').fadeOut('slow');"></span>
      <div class="j-container j-text-color1"><p><b>Update <?=ucfirst(content_data('admin_table','ad_username',$id,'ad_id'))?> Level?</b></p></div>
      <div>
       <?php $cur_level = content_data('admin_table','ad_level',$id,'ad_id');?>
       <div class='j-left'style='margin-bottom:9px;'><span class='j-bolder j-text-color5'>Current Level:</span> <span><?=ucwords(check_level($cur_level))?></span></div>
       <select id="lv"name="lv"class="j-select j-border j-border-color5 j-color4 j-round-large"style="width:98%;"><?php get_level(3,$cur_level,'upgrade')?></select><br>
							<p style='display:inline'><button type="submit"id='clbtn'class="j-margin j-btn j-round j-color1 j-text-color4"onclick="upl($('#lv').val(),<?=$id?>);">Update</button></p>
       <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color1 j-hover-color1 j-round" onclick="$('#update_<?=$type.$id?>').fadeOut('slow');">Cancel</button></p>
      </div>
     </div>
    </div>
   </div>
  </center>
  <?php
  //<!--update level modal ends-->
  }
  if($type === 'admin' || $type === 'food' || $type === 'user'){
   //<!--update status starts-->
  ?>
  <center>
   <div  id="<?=$type.$id?>status" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <div class="j-display-container j-center">
      <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#<?=$type.$id?>status').fadeOut('slow');"></span>
      <?php
      if($type === 'admin' || $type === 'user'){
       if($type === 'admin'){
        $status = content_data('admin_table','ad_status',$id,'ad_id');
       }elseif($type === 'user'){
        $status = content_data('user_table','u_status',$id,'u_id');
       }
       $status === 'active'? $new_status = 'suspended' : $new_status = 'active';
       ?>
       <div class="j-container j-text-color1"><p><b> <?=$status === 'active'?'Suspend':'Re-activate';?> <?=ucwords($type)?>?</b></p></div>
        <h5 class="j-text-color3">Are you sure?</h5><hr>
        <p style='display:inline'>
         <button type="submit"id='upbtn<?=$type?>'class="j-margin j-btn j-round j-color1 j-text-color4"
         onClick="cs('<?=$type?>',<?=addnum($id)?>,'<?=$new_status?>')">Update
         </button>
        </p>
       <?php
      }elseif($type === 'food'){
       $cur_status = content_data('food_table','f_status',$id,'f_id');
       ?>
       <div class="j-container j-text-color1"><p><b>Change Food Availability Status?</b></p></div>
       <div class='j-bolder'><span class='j-text-color7'>Current Status: </span> <span class='j-text-color1'><?=ucwords($cur_status)?></span></div>
       <select name='nw_st'id='nw_st'class='j-select j-color4 j-round j-border-2 j-border-color5'style="width:100%;max-width:400px;">
        <option value="">Select Status</option>
        <?php
        $statuses = ['available','unavailable','deleted'];
        foreach($statuses AS $status){
         if($status !== $cur_status){
          ?><option value="<?=$status?>"><?=ucwords($status)?></option><?php
         }
         }
         ?>
        </select><br><br>
        <p style='display:inline'>
         <button type="submit"id='upbtn<?=$type?>'class="j-margin j-btn j-round j-color1 j-text-color4"
         onClick="cs('<?=$type?>',<?=addnum($id)?>,$('#nw_st').val());">Update
         </button>
        </p>
       <?php
      }
      ?>
       <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color1 j-hover-color1 j-round" onclick="$('#<?=$type.$id?>status').fadeOut('slow');">Cancel</button></p>
     </div>
    </div>
   </div>
  </center>
  <?php }
  //<!--update status ends-->
  //<!--change pod status starts-->
  if($type === 'user'){
  ?>
  <center>
   <div  id="<?=$type.$id?>pod" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <div class="j-display-container j-center">
      <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#<?=$type.$id?>pod').fadeOut('slow');"></span>
      <?php
       $pod = content_data('user_table','u_pod',$id,'u_id');
       $pod === 'enabled'? $new_pod = 'disabled' : $new_pod = 'enabled';
       $pod === 'enabled'? $new_pod2 = 'disable' : $new_pod2 = 'enable';
       ?>
       <div class="j-container j-text-color1"><p><b>
       <?=ucwords($new_pod2.' '.content_data('user_table','u_fullname',$id,'u_id'))?> POD</b></p></div>
        <h5 class="j-text-color3">Are you sure?</h5><hr>
        <p style='display:inline'>
         <button type="submit"id='upbtn<?=$type?>'class="j-margin j-btn j-round j-color1 j-text-color4"onClick="cs('pod',<?=addnum($id)?>,'<?=$new_pod?>')">
          Update
         </button>
        </p>
       <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color1 j-hover-color1 j-round" onclick="$('#<?=$type.$id?>pod').fadeOut('slow');">Cancel</button></p>
     </div>
    </div>
   </div>
  </center>
  <?php }
  //change pod status ends
  //update status for order starts
  if($type === 'order'){
   $cur_status = content_data('order_table','or_status',$id,'or_id');
   $delivery_method = content_data('order_table','or_delivery_method',$id,'or_id');
   if($cur_status === 'order placed' || $cur_status === 'confirmed' || $cur_status === 'packaging' || $cur_status === 'in-transit' || $cur_status === 'ready-for-pickup' || $cur_status === 'delivered'){
   ?>
   <div  id="update_<?=$type.$id?>" class="j-modal">
    <div class="j-card-4 j-modal-content j-light-color5 j-round j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <br>
     <div class="">
      <div>
       <div class="j-text-color7 j-large"><b>Update Order <?=content_data('order_table','or_order_id',$id,'or_id')?> Status?</b></div>
       <br>
       <div class='j-bolder'><span class='j-text-color7'>Current Status: </span> <span class='j-text-color1'><?=ucwords(content_data('order_table','or_status',$id,'or_id'))?></span></div>
       <select name='nw_st'id='nw_st'class='j-select j-color4 j-round j-border-2 j-border-color5'style="width:100%;max-width:400px;">
        <option value="">Select Status</option>
        <?php
        if($cur_status === 'order placed'){
         $statuses = ['confirmed','cancelled'];
        }elseif($cur_status === 'confirmed'){
         $statuses = ['packaging','cancelled'];
        }elseif($cur_status === 'packaging'){
         if($delivery_method === 'pickup'){
          $statuses = ['ready-for-pickup','cancelled'];
         }else{
          $statuses = ['in-transit','cancelled'];
         }
        }elseif($cur_status === 'in-transit' || $cur_status === 'ready-for-pickup'){
         $statuses = ['delivered','failed delivery','cancelled'];
        }elseif($cur_status === 'delivered'){
         $statuses = ['returned'];
        }
        foreach($statuses AS $status){
         if($status !== content_data('order_table','or_status',$id,'or_id')){
          ?><option value="<?=$status?>"><?=ucwords($status)?></option><?php
         }
        }
        ?>
       </select><br><br>
       <button type="submit"id='cbtn'style='margin-bottom:9px;width:100%'class="j-btn j-round j-color1 j-text-color4"onClick="cos(<?=$id?>,$('#nw_st').val());">Update Status</button>
       <button class="j-btn j-color6 j-text-color4 j-round j-border j-border-color1"style='width:100%'onclick="$('#update_<?=$type.$id?>').fadeOut('slow');">Close</button>
      </div>
				 </div>
				 <br>
				</div>
			</div>
   <?php
   }
  }
  //update status for order ends
  //update refund status starts
  if($type === 'order'){
   $amount = content_data('order_table','or_amount',$id,'or_id');
   $delivery_fee = content_data('order_table','or_delivery_fee',$id,'or_id');
   $total = add_total($amount,$delivery_fee);
   ?>
   <center>
   <div  id="update_refund<?=$id?>" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <div class="j-display-container j-center">
      <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#update_refund<?=$id?>').fadeOut('slow');"></span>
      
       <div class="j-container j-text-color1"><p><b>Refund Customer</b></p></div>
        <h5 class="j-text-color3">Are you sure you want to refund this customer?</h5><hr>
        <p style='display:inline'>
         <span class='j-left'>* Max amount to be refunded is <?=get_json_data('currency_symbol','about_us').' '.$total?></span>
         <input type="text"class=" j-input j-medium j-border j-border-color5 j-round-large"placeholder="Amount"
          name="amt"id="amt"value="<?=$total?>"style="width:100%;"/>
         <button type="submit"id='rebtn'class="j-margin j-btn j-round j-color1 j-text-color4"onClick="rc(<?=addnum($id)?>,$('#amt'))">
          Process Refund
         </button>
        </p>
       <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color1 j-hover-color1 j-round" onclick="$('#update_refund<?=$id?>').fadeOut('slow');">Cancel</button></p>
     </div>
    </div>
   </div>
  </center>
   <?php
   }
  //update refund status ends
  //delete modal starts
  if($type === 'admin' || $type === 'social_handle' || $type === 'category' || $type === 'user'){
  ?>
  <center>
   <div  id="delete_<?=$type.$id?>" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <div class="j-display-container j-center">
      <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#delete_<?=$type.$id?>').fadeOut('slow');"></span>
      <div class="j-container j-text-color1"><p><b>Delete <?=ucfirst($type)?>?</b></p></div>
      <div>
       <h5 class="j-text-color3">Your action cannot be reversed.</h5><hr>
							<p style='display:inline'>
        <button type="submit"id=''class="dcbtn<?=$type?> j-margin j-btn j-round j-color1 j-text-color4"onClick="dc('<?=$type?>',<?=addnum($id)?>);">
          Delete
        </button>
       </p>
       <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color1 j-hover-color1 j-round" onclick="$('#delete_<?=$type.$id?>').fadeOut('slow');">Cancel</button></p>
      </div>
     </div>
    </div>
   </div>
  </center>
  <?php
  }
  //delete modal ends
  //clear logs modal starts
  if($type === 'log' ){
  ?>
  <center>
   <div  id="clear_<?=$type?>" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <div class="j-display-container j-center">
      <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#clear_<?=$type?>').fadeOut('slow');"></span>
      <div class="j-container j-text-color1"><p><b>Clear <?=($type)?>?</b></p></div>
      <div>
       <h5 class="j-text-color3">Your action cannot be reversed.</h5><hr>
							<p style='display:inline'>
        <button type="submit"id='clbtn'class="j-margin j-btn j-round j-color1 j-text-color4"onClick="cl();">Clear Logs</button>
       </p>
       <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color1 j-hover-color1 j-round" onclick="$('#clear_<?=$type?>').fadeOut('slow');">Cancel</button></p>
      </div>
     </div>
    </div>
   </div>
  </center>
  <?php
  }
  //clear logs modal ends
  //run action modal starts
  if($type === 'run_action' ){
  ?>
  <center>
   <div  id="run_action" class="j-modal j-modal-click">
    <div class="j-card-4 j-modal-content j-light-color5 j-round-large j-padding j-text-color1" style="width:98%; max-width:400px;height: auto;">
     <div class="j-display-container j-center">
      <span class="j-button j-display-topright j-large j-text-color1 <?=icon('times')?>"onclick="$('#run_action').fadeOut('slow');"></span>
      <div class="j-container j-text-color1"><p><b>Run Action?</b></p></div>
      <div>
       <h5 class="j-text-color3">Your action cannot be reversed.</h5><hr>
							<p style='display:inline'>
        <button type="submit"id='rabtn'class="j-margin j-btn j-round j-color1 j-text-color4"onClick="ra();">Run Actions</button>
       </p>
       <p style='display:inline'><button class="j-margin j-btn j-border j-border-color1 j-text-color1 j-hover-color1 j-round" onclick="$('#run_action').fadeOut('slow');">Cancel</button></p>
      </div>
     </div>
    </div>
   </div>
  </center>
  <?php
  }
  //run action modal ends
  //END OF SUB MODAL
}
//preview modal ends
//MODAL FUNCTIONS ENDS
?>