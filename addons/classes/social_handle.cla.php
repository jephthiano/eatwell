<?php
class social_handle{
    private $table = 'social_handle_table';
    private $dbconn;
	private $dbstmt;
	private $dbsql;
    private $dbnumRow;
    
    public $id;
    public $name;
    public $icon;
    public $link;
    
    private $current_admin;
    private $last_id;
    
    public function __construct($conn = ''){
        if(!empty($conn)){
            //CREATE CONNECTION
            require_once(file_location('inc_path','connection.inc.php'));
            $this->dbconn = dbconnect($conn,'PDO');
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
    
    
    public function insert_social_handle(){
        $this->dbsql = "INSERT INTO {$this->table}(s_name,s_icon,s_link)
        VALUES(:name,:icon,:link)";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':name',$this->name,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':icon',$this->icon,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':link',$this->link,PDO::PARAM_STR);
        if($this->dbstmt->execute()){return $this->dbconn->lastInsertId();}else{return false;} 
    }//end insert social_handle
    
    public function update_social_handle(){
        $this->dbsql = "UPDATE {$this->table} SET s_name = :name,s_icon= :icon,s_link= :link
        WHERE s_id = :id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':name',$this->name,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':icon',$this->icon,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':link',$this->link,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        if($this->dbstmt->execute()){return true;}else{return false;} 
    }
    
    public function delete_social_handle(){
        $this->dbsql = "DELETE FROM {$this->table} WHERE s_id = :id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        if($this->dbstmt->execute()){return true;}else{return false;} 
    }
}
?>