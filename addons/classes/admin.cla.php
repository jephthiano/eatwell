<?php
class admin{
    private $table = 'admin_table';
    private $media_table = 'admin_media_table';
    private $dbconn;
	private $dbstmt;
	private $dbsql;
    private $dbnumRow;
    
    public $id;
    public $email;
    public $username;
    public $password;
    public $fullname;
    public $level;
    public $status;
    public $registered_by;
    
    public $new_email;
    public $new_username;
    public $new_password;
    
    public $type;
    public $file_name;
    public $extension;
    
    private $current_admin;
    private $last_id;
    private $full_file_name;
    private $full_path;
    
    public function __construct($conn = ''){
        if(!empty($conn)){
            //CREATE CONNECTION
            require_once(file_location('inc_path','connection.inc.php'));
            $this->dbconn = dbconnect($conn,'PDO');
        }
        require_once(file_location('admin_inc_path','session_start.inc.php'));
        if(isset($_SESSION['admin_id'])){
         @$this->current_admin = test_input(ssl_decrypt_input($_SESSION['admin_id']));
        }
    }
    
    public function __destruct(){
    	//CLOSES ALL CONNECTION
        if(is_resource($this->dbconn)){
            closeconnect('db', $this->dbconn);
        }
        if(is_resource($this->dbstmt)){
            closeconnect('stmt',$this->dbstmt);
        }
    }
    
    
    public function auto_insert_update(){
        if(content_data('admin_table','ad_id',$this->id,'ad_id') === false //if id 1 is not occupied
           && (content_data('admin_table','ad_id',$this->new_username,'ad_username')) === false //if the username is not used
           && (content_data('admin_table','ad_id',$this->new_email,'ad_email') === false)){ //if email does not exists
           $this->dbsql = "INSERT INTO {$this->table}(ad_id,ad_email,ad_username,ad_password,ad_fullname,ad_level,ad_registered_by)
           VALUES(:id,:email,:username,:password,:fullname,:level,:registered_by)";
           $this->dbstmt = $this->dbconn->prepare($this->dbsql);
           $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_STR);
           $this->dbstmt->bindParam(':email',$this->new_email,PDO::PARAM_STR);
           $this->dbstmt->bindParam(':username',$this->new_username,PDO::PARAM_STR);
           $this->dbstmt->bindParam(':password',$this->new_password,PDO::PARAM_STR);
           $this->dbstmt->bindParam(':fullname',$this->fullname,PDO::PARAM_STR);
           $this->dbstmt->bindParam(':level',$this->level,PDO::PARAM_INT);
           $this->dbstmt->bindParam(':registered_by',$this->registered_by,PDO::PARAM_INT);
           $this->dbstmt->execute();
           $this->dbnumRow = $this->dbstmt->rowCount();
           if($this->dbnumRow > 0){return true;}else{return false;} 
        }else{
            if((content_data('admin_table','ad_username',$this->id,'ad_id')) != $this->new_username //if the username where id ===1 is not correct username
               || (content_data('admin_table','ad_email',$this->id,'ad_id')) != $this->new_email //if the email where id ===1 is not correct email
               || content_data('admin_table','ad_id',$this->new_username,'ad_username') != $this->id //if the id where username ===username is not === 1
               || content_data('admin_table','ad_id',$this->new_email,'ad_email') != $this->id){ //if the id where email ===email is not === 1
                //DELETE AND INSERT
                $this->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                try{
                    //begin transaction
                    $this->dbconn->beginTransaction();
                    //DELETE
                    $this->dbsql = "DELETE FROM {$this->table} WHERE ad_id = :id OR ad_email = :email OR ad_username = :username";
                    $this->dbstmt = $this->dbconn->prepare($this->dbsql);
                    $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
                    $this->dbstmt->bindParam(':email',$this->new_email,PDO::PARAM_STR);
                    $this->dbstmt->bindParam(':username',$this->new_username,PDO::PARAM_STR);
                    $this->dbstmt->execute();
                    //INSERT
                    $this->dbsql = "INSERT INTO {$this->table}(ad_id,ad_email,ad_username,ad_password,ad_fullname,ad_level,ad_registered_by)
                    VALUES(:id,:email,:username,:password,:fullname,:level,:registered_by)";
                    $this->dbstmt = $this->dbconn->prepare($this->dbsql);
                    $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_STR);
                    $this->dbstmt->bindParam(':email',$this->new_email,PDO::PARAM_STR);
                    $this->dbstmt->bindParam(':username',$this->new_username,PDO::PARAM_STR);
                    $this->dbstmt->bindParam(':password',$this->new_password,PDO::PARAM_STR);
                    $this->dbstmt->bindParam(':fullname',$this->fullname,PDO::PARAM_STR);
                    $this->dbstmt->bindParam(':level',$this->level,PDO::PARAM_INT);
                    $this->dbstmt->bindParam(':registered_by',$this->registered_by,PDO::PARAM_INT);
                    $this->dbstmt->execute();
                    // commit the transation
                    if($this->dbconn->commit()){return true;}//if commit
                }catch(PDOException $e){
                    //rollback
                    if($this->dbconn->rollback()){return false;}//if rollback
                }// end of try and catch
            }
        }
    }//end auto insert update
    
    public function re_hash_pass(){
        $this->new_password = hash_pass($this->current_password);
        $this->dbsql = "UPDATE {$this->table} SET ad_password = :password WHERE ad_username = :username LIMIT 1";
        $this->dbstmt =  $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':password',$this->new_password,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':username',$this->username,PDO::PARAM_STR);
        $this->dbstmt->execute();
    }
    
    public function authenticate_login(){
        //check if admin exists
        $this->id = content_data($this->table,'ad_id',$this->username,'ad_username');
        if($this->id !== false){
            $this->status = content_data($this->table,'ad_status',$this->id,'ad_id');
            $this->password = content_data($this->table,'ad_password',$this->id,'ad_id');
            if(password_verify($this->current_password,$this->password)){// verify
                if(password_needs_rehash($this->password,PASSWORD_DEFAULT)){$this->re_hash_pass();}//end of if need rehash
                if($this->status === "suspended"){return 'suspended';}elseif($this->status === "active"){return $this->id;}
            }else{//if password doesnt match
                return false;
            }//end of if passowrd match
        }else{// if user does not exits
            return false;
        }
    }// end of authenticate_login
    
    
    public function log_out(){
     require_once(file_location('admin_inc_path','session_destroy.inc.php'));
     return true;
    }
    
    public function insert_admin(){
        $this->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        try{
            //begin transaction
            $this->dbconn->beginTransaction();
            $this->dbsql = "INSERT INTO {$this->table}(ad_email,ad_username,ad_fullname,ad_password,ad_level,ad_registered_by)
            VALUES(:email,:username,:fullname,:password,:level,:registered_by)";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':email',$this->email,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':username',$this->username,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':fullname',$this->fullname,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':password',$this->password,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':level',$this->level,PDO::PARAM_INT);
            $this->dbstmt->bindParam(':registered_by',$this->registered_by,PDO::PARAM_INT);
            $this->dbstmt->execute();
            $this->last_id = $this->dbconn->lastInsertId(); //last id
            if($this->type === 'normal'){
                // insert image
                $this->dbsql = "INSERT INTO {$this->media_table}(am_link_name,am_extension,ad_id) VALUES(:link_name,:extension,:adid)";
                $this->dbstmt = $this->dbconn->prepare($this->dbsql);
                $this->dbstmt->bindParam(':link_name',$this->file_name,PDO::PARAM_STR);
                $this->dbstmt->bindParam(':extension',$this->extension,PDO::PARAM_STR);
                $this->dbstmt->bindParam(':adid',$this->last_id,PDO::PARAM_INT);
                $this->dbstmt->execute();
            }
            // commit the transation
            if($this->dbconn->commit()){return $this->last_id;}//if commit
        }catch(PDOException $e){
            //rollback
            if($this->dbconn->rollback()){
                if($this->type === 'normal'){
                    //delete image
                    $this->full_file_name = $this->file_name.".".$this->extension;
                    $this->full_path = file_location('media_path','admin/'.$this->full_file_name);
                    if(file_exists($this->full_path) && $this->full_file_name !== 'home/avatar.png' && is_file($this->full_path)){unlink($this->full_path);}
                }
                return false;
            }//if rollback
        }// end of try and catch
    }//end insert admin
    
    public function update_profile(){
        $this->dbsql = "UPDATE {$this->table} SET ad_email = :email,ad_username = :username,ad_fullname = :fullname
        WHERE ad_id = :id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':email',$this->email,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':username',$this->username,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':fullname',$this->fullname,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;}
    }
    
    public function change_password(){
		$this->dbsql = "UPDATE {$this->table} SET ad_password = :password WHERE ad_id = :id LIMIT 1";
		$this->dbstmt =  $this->dbconn->prepare($this->dbsql);
		$this->dbstmt->bindParam(':password',$this->new_password,PDO::PARAM_STR);
		$this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
		$this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;} 
    }//end of change password
    
    public function delete_admin(){
        $this->full_file_name = get_media('admin',$this->id);
        $this->dbsql = "DELETE FROM {$this->table} WHERE ad_id = :id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){
            $this->full_path = file_location('media_path',$this->full_file_name);
            if(file_exists($this->full_path) && $this->full_file_name !== 'home/avatar.png'){
                unlink($this->full_path);
            }
            return true;
        }else{
            return false;
        }
    }
    
    public function change_status(){
        $this->dbsql = "UPDATE {$this->table} SET ad_status = :status WHERE ad_id = :id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':status',$this->status,PDO::PARAM_STR);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;} 
    }
    
    public function update_level(){
        $this->dbsql = "UPDATE {$this->table} SET ad_level = :level WHERE ad_id = :id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':level',$this->level,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;} if($this->dbstmt->execute()){return true;}else{return false;} 
    }
    
    public function remove_image(){
        $this->full_file_name = get_media('admin',$this->current_admin);
        $this->full_path = file_location('media_path',$this->full_file_name);
        if(file_exists($this->full_path) && $this->full_file_name !== 'home/avatar.png' && is_file($this->full_path)){
            if(unlink($this->full_path)){
                $this->dbsql = "DELETE FROM {$this->media_table} WHERE ad_id = :id LIMIT 1";
                $this->dbstmt = $this->dbconn->prepare($this->dbsql);
                $this->dbstmt->bindParam(':id',$this->current_admin,PDO::PARAM_INT);
                $this->dbstmt->execute();
                return true;
            }else{
                return false;
            }
        }
    }
    public function change_image(){
        $this->full_file_name = get_media('admin',$this->current_admin);
        $this->full_path = file_location('media_path',$this->full_file_name);
        if(content_data($this->media_table,'am_id',$this->current_admin,'ad_id') !== false){
            $this->dbsql = "UPDATE {$this->media_table} SET am_link_name = :link_name,am_extension = :extension WHERE ad_id = :id LIMIT 1";
        }else{
            $this->dbsql = "INSERT INTO {$this->media_table}(am_link_name,am_extension,ad_id)VALUES(:link_name,:extension,:id)";
        }
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':link_name',$this->file_name,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':extension',$this->extension,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':id',$this->current_admin,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){
            //delete the current image
            if(file_exists($this->full_path) && $this->full_file_name !== 'home/avatar.png' && is_file($this->full_path)){unlink($this->full_path);}
            return true;
        }else{
            //delete image
            $this->full_file_name = $this->file_name.".".$this->extension;
            $this->full_path = file_location('media_path','admin/'.$this->full_file_name);
            if(file_exists($this->full_path) && $this->full_file_name !== 'home/avatar.png' && is_file($this->full_path)){unlink($this->full_path);}
            return false;
        }
    }//end of store user image
}
?>