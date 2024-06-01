<?php
class cookie_data{
    private $table = 'cookie_data_table';
    private $dbconn;
	private $dbstmt;
	private $dbsql;
    private $dbnumRow;
    
    public $id;
    public $token;
    public $ipaddress;
    public $login_time;
    public $expiretime;
    public $uid;
    
    public $current_user;
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
    
    
    public function insert_cookie(){
        $this->dbsql = "INSERT INTO {$this->table}(cd_token,cd_ipaddress,cd_expiretime,u_id)
        VALUES(:token,:ipaddress,:exptime,:user_id)";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':ipaddress',$this->ipaddress,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':exptime',$this->expiretime,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':user_id',$this->current_user,PDO::PARAM_STR);
        if($this->dbstmt->execute()){return true;}else{return false;}
    }//end insert cookie
    
    public function delete_cookie($type){
        if($type === 'current'){
            $this->dbsql = "DELETE FROM {$this->table} WHERE u_id = :user_id AND cd_token = :token AND cd_ipaddress = :ipaddress";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':ipaddress',$this->ipaddress,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':user_id',$this->uid,PDO::PARAM_INT);
            if($this->dbstmt->execute()){return true;}else{return false;}
        }elseif($type === 'all'){
            $this->dbsql = "DELETE FROM {$this->table} WHERE u_id = :user_id";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':user_id',$this->uid,PDO::PARAM_INT);
            $this->dbstmt->execute();
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($this->dbnumRow > 0){return true;}else{return false;}
        }
    }//end delete cookie
}
?>