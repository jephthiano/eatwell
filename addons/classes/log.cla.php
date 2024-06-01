<?php
class log{
    private $table = 'log_table';
    private $dbconn;
	private $dbstmt;
	private $dbsql;
    private $dbnumRow;
    
    public $id;
    public $brief;
    public $details;
    
    private $current_admin;
    private $current_username;
    private $current_ip;
    
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
        //username
        $this->current_username = content_data('admin_table','ad_username',$this->current_admin,'ad_id');
        //ip address
        $this->current_ip = get_ip_address();
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
    
    
    public function insert_log($type='all'){
        if($type === 'logout'){
            $this->dbsql = "INSERT INTO {$this->table}(l_brief,l_details,l_ip_address,ad_id,ad_username)VALUES(:brief,:details,:current_ip,:current_admin,:current_username)";
        }else{
            $this->dbsql = "INSERT INTO {$this->table}(l_brief,l_details,l_ip_address,ad_id,ad_username)VALUES(:brief,:details,:current_ip,:current_admin,:current_username)";
        }
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':brief',$this->brief,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':details',$this->details,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':current_ip',$this->current_ip,PDO::PARAM_STR);
        if($type === 'logout'){
            $this->dbstmt->bindParam(':current_admin',$this->admin_id,PDO::PARAM_INT);
            $this->dbstmt->bindParam(':current_username',$this->admin_username,PDO::PARAM_STR);
        }else{
            $this->dbstmt->bindParam(':current_admin',$this->current_admin,PDO::PARAM_INT);
            $this->dbstmt->bindParam(':current_username',$this->current_username,PDO::PARAM_STR);
        }
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;}
    }//end insert category
    
    public function clear_log(){
        $this->dbsql = "DELETE FROM {$this->table}";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;}
    }//end insert category
}
?>