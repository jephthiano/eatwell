<?php
class viewed{
    private $table = 'viewed_table';
    private $dbconn;
	private $dbstmt;
	private $dbsql;
    private $dbnumRow;
    
    public $id;
    public $f_id;
    public $regdatetime;
    
    private $last_id;
    public $token;
    
    public function __construct($conn = ''){
        if(!empty($conn)){
            //CREATE CONNECTION
            require_once(file_location('inc_path','connection.inc.php'));
            $this->dbconn = dbconnect($conn,'PDO');
        }
         @$this->token = get_viewed_token('set');
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
    
    public function insert_viewed(){
        if(check_viewed($this->f_id) === false){
            $this->dbsql = "INSERT INTO {$this->table}(f_id,v_token)
            VALUES(:fid,:token)";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':fid',$this->f_id,PDO::PARAM_INT);
            $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
            $this->dbstmt->execute();
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($this->dbnumRow > 0){return true;}else{return false;}
        }
    }//end insert user
    
    public function delete_viewed(){
        $this->dbsql = "DELETE FROM {$this->table} WHERE v_token = :token";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;}
    }//end insert user
}
?>