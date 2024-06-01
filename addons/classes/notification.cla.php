<?php
trait notification{
    protected $noti_table = 'notification_table';
    
    public $n_id;
    public $n_title;
    public $n_message;
    public $n_status;
    public $n_regdatetime;
    public $or_id;
    public $u_id;
    
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
    
    public function insert_notification($type='multi'){
        if(content_data($this->noti_table,'n_title',$this->u_id,'u_id',"AND or_id = {$this->or_id} AND n_title = '{$this->n_title}'") === false){
            $this->dbsql = "INSERT INTO {$this->noti_table}(n_title,n_message,or_id,u_id)
                VALUES(:title,:message,:or_id,:id)";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':title',$this->n_title,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':message',$this->n_message,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':or_id',$this->or_id,PDO::PARAM_INT);
            $this->dbstmt->bindParam(':id',$this->u_id,PDO::PARAM_INT);
            $this->dbstmt->execute();
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($type === 'single'){
                $this->dbnumRow = $this->dbstmt->rowCount();
                if($this->dbnumRow > 0){return true;}else{return false;} 
            }
        }
    }//end insert user
    
    public function change_status($type = 'change_seen'){
        if($type === 'change_read'){
            $this->dbsql = "UPDATE {$this->noti_table} SET n_status = 'read' WHERE or_id = :or_id AND u_id = :id ";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':or_id',$this->or_id,PDO::PARAM_INT);
        }else{
            $this->dbsql = "UPDATE {$this->noti_table} SET n_status = 'seen' WHERE u_id = :id AND n_status = 'sent'";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        }
        $this->dbstmt->bindParam(':id',$this->current_user,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;}
    }
}
?>