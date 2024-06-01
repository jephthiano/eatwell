<?php
trait user_contact{
    protected $contact_table = 'user_contact_table';
    
    public $uc_id;
    public $uc_fullname;
    public $uc_address;
    public $uc_region;
    public $uc_phnumber1;
    public $uc_phnumber2;
    public $uc_status;
    public $u_id;
    
    public function insert_user_contact(){
        $this->dbsql = "INSERT INTO {$this->contact_table}(uc_fullname,uc_address,uc_region,uc_phnumber1,uc_phnumber2,uc_status,u_id)
            VALUES(:fullname,:address,:region,:phnumber1,:phnumber2,:status,:id)";
        $this->dbstmt =  $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':fullname',$this->uc_fullname,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':address',$this->uc_address,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':region',$this->uc_region,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':phnumber1',$this->uc_phnumber1,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':phnumber2',$this->uc_phnumber2,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':status',$this->uc_status,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':id',$this->current_user,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        $this->last_id = $this->dbconn->lastInsertId(); //last id
        if($this->dbnumRow > 0){return $this->last_id;}else{return false;} 
    }//end of insert transation
    
    public function update_user_contact(){
        $this->dbsql = "UPDATE {$this->contact_table} SET uc_fullname = :fullname,uc_address = :address,uc_region = :region,
        uc_phnumber1 = :phnumber1,uc_phnumber2 = :phnumber2 WHERE uc_id = :uc_id AND u_id = :id LIMIT 1";
        $this->dbstmt =  $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':fullname',$this->uc_fullname,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':address',$this->uc_address,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':region',$this->uc_region,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':phnumber1',$this->uc_phnumber1,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':phnumber2',$this->uc_phnumber2,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':uc_id',$this->uc_id,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':id',$this->current_user,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;}
    }
    
    public function delete_user_contact(){
        $this->dbsql = "DELETE FROM {$this->contact_table} WHERE uc_id = :uc_id AND u_id = :id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':uc_id',$this->uc_id,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':id',$this->current_user,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;}
    }
    
    public function set_contact_as_default(){
        $this->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        try{
            //begin transaction
            $this->dbconn->beginTransaction();
            //set all contact to none
            $this->dbsql = "UPDATE {$this->contact_table} SET uc_status = 'none' WHERE u_id = :id";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':id',$this->current_user,PDO::PARAM_INT);
            $this->dbstmt->execute();
            //set one contact to default
            $this->dbsql = "UPDATE {$this->contact_table} SET uc_status = 'default' WHERE uc_id = :uc_id AND u_id = :id LIMIT 1";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':uc_id',$this->uc_id,PDO::PARAM_INT);
            $this->dbstmt->bindParam(':id',$this->current_user,PDO::PARAM_INT);
            $this->dbstmt->execute();
            // commit the transation
            if($this->dbconn->commit()){return true;}//if commit
        }catch(PDOException $e){
            //rollback
            if($this->dbconn->rollback()){return false;}//if rollback
        }// end of try and catch
    }
}
?>