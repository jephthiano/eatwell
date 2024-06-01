<?php
trait transaction{
    protected $trans_table = 'transaction_table';
    
    public $id;
    public $t_status;
    public $amount;
    public $currency;
    public $ref_id;
    public $t_payment_method;
    public $bank;
    public $brand;
    public $account_name;
    public $account_number;
    public $ipaddress;
    public $regdatetime;
    public $date;
    public $month;
    public $year;
    public $token;
    
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
            closeconnect('db',$this->dbconn);
        }
        if(is_resource($this->dbstmt)){
            closeconnect('stmt',$this->dbstmt);
        }
    }
    
    public function insert_transaction(){
        $this->month = date('Y-m');
        $this->year = date('Y');
        $this->dbsql = "INSERT INTO {$this->trans_table}(t_status,t_amount,t_currency,t_ref_id,t_payment_method,t_bank,t_brand,t_account_name,t_account_number,t_ipaddress,t_month,t_year,or_token)
        VALUES(:status,:amount,:currency,:ref_id,:payment_method,:bank,:brand,:account_name,:account_number,:ipaddress,:month,:year,:token)";
        $this->dbstmt =  $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':status',$this->t_status,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':amount',$this->amount,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':currency',$this->currency,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':ref_id',$this->ref_id,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':payment_method',$this->t_payment_method,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':bank',$this->bank,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':brand',$this->brand,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':account_name',$this->account_name,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':account_number',$this->account_number,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':ipaddress',$this->ipaddress,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':month',$this->month,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':year',$this->year,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;} 
    }//end of insert transation
}
?>