<?php
class page_visit{
    private $table = 'page_visit_table';
    private $dbconn;
	private $dbstmt;
	private $dbsql;
    private $dbnumRow;
    
    public $id;
    public $ipaddress;
    public $location;
    public $page;
    public $datetime;
    public $date;
    public $month;
    public $year;
    
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
    
    
    public function insert_page_visit(){
        $this->ipaddress = get_ip_address();
        $this->location = get_location_data('country');
        $this->month = date('Y-m');
        $this->dbsql = "INSERT INTO {$this->table}(pg_ipaddress,pg_location,pg_page,pg_month) VALUES(:ipaddress,:location,:page,:month)";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':ipaddress',$this->ipaddress,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':location',$this->location,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':page',$this->page,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':month',$this->month,PDO::PARAM_STR);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return $this->dbconn->lastInsertId();}else{return false;} 
    }//end insert insight
}
?>