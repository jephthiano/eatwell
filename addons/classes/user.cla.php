<?php
class user{
    use user_contact;
    private $table = 'user_table';
    private $table2 = 'user_data_table';
    private $dbconn;
	private $dbstmt;
	private $dbsql;
    private $dbnumRow;
    
    public $id;
    public $email;
    public $fullname;
    public $gender;
    public $password;
    public $status;
    public $pod;
    public $regdatetime;
    
    public $ud_id;
    public $ud_cancel_counter;
    public $ud_delivery_counter;
    public $new_counter;
    
    public $new_email;
    public $new_password;
    public $current_password;
    
    private $current_user;
    private $last_id;
    
    public function __construct($conn = ''){
        if(!empty($conn)){
            //CREATE CONNECTION
            require_once(file_location('inc_path','connection.inc.php'));
            $this->dbconn = dbconnect($conn,'PDO');
        }
        if(!strstr($_SERVER['PHP_SELF'],'admin')){
            require_once(file_location('inc_path','session_start.inc.php'));
            if(isset($_SESSION['user_id'])){
                @$this->current_user = test_input(ssl_decrypt_input($_SESSION['user_id']));
            }
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
    
    public function re_hash_pass(){
        $this->new_password = hash_pass($this->current_password);
        $this->dbsql = "UPDATE {$this->table} SET u_password = :password WHERE u_email = :email LIMIT 1";
        $this->dbstmt =  $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':password',$this->new_password,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':email',$this->email,PDO::PARAM_INT);
        $this->dbstmt->execute();
    }
    
    public function authenticate_login(){
        //check if admin exists
        $this->id = content_data($this->table,'u_id',$this->email,'u_email');
        if($this->id !== false){
            $this->status = content_data($this->table,'u_status',$this->id,'u_id');
            $this->password = content_data($this->table,'u_password',$this->id,'u_id');
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
                
    public function sign_up(){
        $this->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        try{
            //begin transaction
            $this->dbconn->beginTransaction();
            //insert user
            $this->dbsql = "INSERT INTO {$this->table}(u_email,u_fullname,u_password)
                VALUES(:email,:fullname,:password)";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':email',$this->email,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':fullname',$this->fullname,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':password',$this->password,PDO::PARAM_STR);
            $this->dbstmt->execute();
            $this->last_id = $this->dbconn->lastInsertId(); //last id
            //insert user data
            $this->dbsql = "INSERT INTO {$this->table2}(u_id)
                VALUES(:id)";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':id',$this->last_id,PDO::PARAM_INT);
            $this->dbstmt->execute();
            // commit the transation
            if($this->dbconn->commit()){return $this->last_id;}//if commit
        }catch(PDOException $e){
            //rollback
            if($this->dbconn->rollback()){return false;}
        }
    }//end insert user
    
    public function log_out(){
        require_once(file_location('inc_path','session_destroy.inc.php'));
        require_once(file_location('inc_path','delete_recentview_and_cart_tokencookie.inc.php'));
        return true;
    }
    
    public function delete_user(){
        $this->dbsql = "DELETE FROM {$this->table} WHERE u_id = :id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){
            if(isset($_SESSION['user_id'])){
                require_once(file_location('inc_path','session_destroy.inc.php'));
                require_once(file_location('inc_path','delete_recentview_and_cart_tokencookie.inc.php'));
            }
            return true;
        }else{
            return false;
        }
    }
    public function update_profile(){
        $this->dbsql = "UPDATE {$this->table} SET u_email = :email,u_fullname = :fullname,u_gender = :gender WHERE u_id = :id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':email',$this->email,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':fullname',$this->fullname,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':gender',$this->gender,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':id',$this->current_user,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;}
    }
    
    public function change_password($type='user'){
        if($type === 'email'){
            $this->dbsql = "UPDATE {$this->table} SET u_password = :password WHERE u_email = :email LIMIT 1";
        }else{
            $this->dbsql = "UPDATE {$this->table} SET u_password = :password WHERE u_id = :id LIMIT 1";
        }
		$this->dbstmt =  $this->dbconn->prepare($this->dbsql);
		$this->dbstmt->bindParam(':password',$this->new_password,PDO::PARAM_STR);
        if($type === 'email'){
            $this->dbstmt->bindParam(':email',$this->email,PDO::PARAM_STR);
        }else{
            $this->dbstmt->bindParam(':id',$this->current_user,PDO::PARAM_INT);
        }
		
		$this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;} 
    }//end of change password
    
    public function change_status($type='status',$return = 'single'){
        if($type === 'status'){
            $this->dbsql = "UPDATE {$this->table} SET u_status = :status WHERE u_id = :id LIMIT 1";
        }elseif($type === 'pod'){
            $this->dbsql = "UPDATE {$this->table} SET u_pod = :status WHERE u_id = :id LIMIT 1";
        }
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':status',$this->status,PDO::PARAM_STR);
        $this->dbstmt->execute();
        if($return === 'single'){
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($this->dbnumRow > 0){return true;}else{return false;} 
        }
    }
    
    public function update_counter($counter = 'cancel'){
        $this->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            try{
                //begin transaction
                $this->dbconn->beginTransaction();
                //update the userdata counter
                if($counter === 'cancel'){
                    $this->dbsql = "UPDATE {$this->table2} SET ud_cancel_counter = :counter WHERE u_id = :id LIMIT 1";
                }elseif($counter === 'delivery'){
                    $this->dbsql = "UPDATE {$this->table2} SET ud_delivery_counter = :counter WHERE u_id = :id LIMIT 1";
                }
                $this->dbstmt = $this->dbconn->prepare($this->dbsql);
                $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
                $this->dbstmt->bindParam(':counter',$this->new_counter,PDO::PARAM_INT);
                $this->dbstmt->execute();
                // reset the other counter and also pod status
                if($this->new_counter > 2){
                    if($counter === 'cancel'){
                        $this->status = 'disabled';
                        //set delivery counter to 0
                        $this->dbsql = "UPDATE {$this->table2} SET ud_delivery_counter = :counter WHERE u_id = :id LIMIT 1";
                    }elseif($counter === 'delivery'){
                        $this->status = 'enabled';
                        //set cancel counter to 0
                        $this->dbsql = "UPDATE {$this->table2} SET ud_cancel_counter = :counter WHERE u_id = :id LIMIT 1";
                    }
                    $this->new_counter = 0;
                    $this->dbstmt = $this->dbconn->prepare($this->dbsql);
                    $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
                    $this->dbstmt->bindParam(':counter',$this->new_counter,PDO::PARAM_INT);
                    $this->dbstmt->execute();
                    // change the pod status
                    $this->change_status('pod','multi');
                }
                // commit the transation
                if($this->dbconn->commit()){return true;}//if commit
            }catch(PDOException $e){
                //rollback
                if($this->dbconn->rollback()){return false;}//if rollback
            }// end of try and catch
    }
}
?>