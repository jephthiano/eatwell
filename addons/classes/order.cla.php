<?php
class order {
    use transaction, notification, review;
    private $table = 'order_table';
    private $table2 = 'orderer_table';
    private $table3 = 'order_history_table';
    private $table4 = 'food_table';
    private $table5 = 'refund_table';
    public $dbconn;
	protected $dbstmt;
	protected $dbsql;
    protected $dbnumRow;
    
    public $id;
    public $quantity;
    public $amount;
    public $delivery_fee;
    public $delivery_method;
    public $payment_method;
    public $token;
    public $order_id;
    public $delivery_note;
    public $status;
    public $cancel_reason;
    public $refund;
    public $review;
    public $payment_received;
    public $regdatetime;
    public $pmt_regdatetime;
	public $pmt_date;
	public $pmt_month;
	public $pmt_year;
    public $f_id;
    public $user_id;
    
    
    public $o_id;
    public $u_id;
    public $uc_id;
    
    public $oh_id;
    public $oh_status;
    public $oh_regdatetime;
    
    public $new_status;
    public $or_id;
    
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
    
    public function insert_cart(){
        $this->dbsql = "INSERT INTO {$this->table}(or_quantity,or_delivery_fee,or_amount,or_token,or_order_id,f_id)
        VALUES(:quantity,:delivery_fee,:amount,:token,:order_id,:f_id)";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':quantity',$this->quantity,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':delivery_fee',$this->delivery_fee,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':amount',$this->amount,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':order_id',$this->order_id,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':f_id',$this->f_id,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;} 
    }
    
    public function update_cart(){
        $this->dbsql = "UPDATE {$this->table} SET or_quantity = :quantity,or_delivery_fee = :delivery_fee,or_amount = :amount WHERE or_token = :token AND f_id = :f_id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':quantity',$this->quantity,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':delivery_fee',$this->delivery_fee,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':amount',$this->amount,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':f_id',$this->f_id,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;} 
    }
    
    public function delete_cart($type = 'normal'){
        if($type === 'logout'){
            $this->dbsql = "DELETE FROM {$this->table} WHERE or_status = :status AND or_token = :token";
        }else{
            $this->dbsql = "DELETE FROM {$this->table} WHERE or_status = :status AND or_token = :token AND or_id = :id LIMIT 1";
        }
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':status',$this->status,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
        if($type === 'normal'){
            $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        }
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;} 
    }
    
    public function insert_update_orderer($type='multi'){
        if(!content_data('orderer_table','o_id',$this->token,'or_token')){ // if table does not exists... insert
            $this->dbsql = "INSERT INTO {$this->table2}(or_token,u_id,uc_id) VALUES(:token,:u_id,:uc_id)";
        }else{ //update
            $this->dbsql = "UPDATE {$this->table2} SET u_id = :u_id, uc_id = :uc_id WHERE or_token = :token LIMIT 1";
        }
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':u_id',$this->u_id,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':uc_id',$this->uc_id,PDO::PARAM_INT);
        $this->dbstmt->execute();
        if($type === 'single'){
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($this->dbnumRow > 0){return true;}else{return false;}
        }
    }
    
    public function update_user_id($type='multi'){
        $add = "AND or_status = 'cart' AND order_table.f_id = food_table.f_id AND f_status = 'available' ORDER BY or_id DESC";;
        $this->dbsql = "UPDATE {$this->table},{$this->table4} SET user_id = :u_id WHERE or_token = :token {$add}";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':u_id',$this->current_user,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
        $this->dbstmt->execute();
        if($type === 'single'){
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($this->dbnumRow > 0){return true;}else{return false;} 
        }
    }
    
    public function update_delivery_fee($type='multi'){
        $add = "AND or_status = 'cart' AND order_table.f_id = food_table.f_id AND f_status = 'available' ORDER BY or_id DESC";
        $or_ids = multiple_content_data('order_table,food_table','or_id',$this->token,'or_token',$add);
        if($or_ids !== false){
            if($type === 'single'){
                $this->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                try{
                    //begin transaction
                    $this->dbconn->beginTransaction();
                    foreach($or_ids AS $id){
                        $this->or_id = $id;
                        $this->quantity = content_data('order_table','or_quantity',$this->or_id,'or_id');
                        $this->delivery_fee = cal_del_fee($this->quantity,$this->delivery_method);                
                        $this->dbsql = "UPDATE {$this->table} SET or_delivery_fee = :delivery_fee WHERE or_id = :or_id";
                        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
                        $this->dbstmt->bindParam(':delivery_fee',$this->delivery_fee,PDO::PARAM_STR);
                        $this->dbstmt->bindParam(':or_id',$this->or_id,PDO::PARAM_INT);
                        $this->dbstmt->execute();
                    }
                    // commit the transation
                    if($this->dbconn->commit()){return true;}
                }catch(PDOException $e){
                        //rollback
                        if($this->dbconn->rollback()){return false;}//if rollback
                }// end of try and catch
            }else{
                foreach($or_ids AS $id){
                    $this->or_id = $id;
                    $this->quantity = content_data('order_table','or_quantity',$this->or_id,'or_id');
                    $this->delivery_fee = cal_del_fee($this->quantity,$this->delivery_method);                
                    $this->dbsql = "UPDATE {$this->table} SET or_delivery_fee = :delivery_fee WHERE or_id = :or_id";
                    $this->dbstmt = $this->dbconn->prepare($this->dbsql);
                    $this->dbstmt->bindParam(':delivery_fee',$this->delivery_fee,PDO::PARAM_STR);
                    $this->dbstmt->bindParam(':or_id',$this->or_id,PDO::PARAM_INT);
                    $this->dbstmt->execute();
                }
            }
        }
    }
    
    public function update_delivery_method($type='multi'){
        $add = "AND or_status = 'cart' AND order_table.f_id = food_table.f_id AND f_status = 'available' ORDER BY or_id DESC";;
        $this->dbsql = "UPDATE {$this->table},{$this->table4} SET or_delivery_method = :delivery_method WHERE or_token = :token {$add}";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':delivery_method',$this->delivery_method,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
        $this->dbstmt->execute();
        if($type === 'single'){
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($this->dbnumRow > 0){return true;}else{return false;} 
        }
    }
    
    public function update_payment_method($type='multi'){
        $add = "AND or_status = 'cart' AND order_table.f_id = food_table.f_id AND f_status = 'available' ORDER BY or_id DESC";;
        $this->dbsql = "UPDATE {$this->table},{$this->table4} SET or_payment_method = :payment_method WHERE or_token = :token {$add}";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':payment_method',$this->payment_method,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
        $this->dbstmt->execute();
        if($type === 'single'){
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($this->dbnumRow > 0){return true;}else{return false;} 
        }
    }
    
    public function update_delivery_note($type='multi'){
        $add = "AND or_status = 'cart' AND order_table.f_id = food_table.f_id AND f_status = 'available' ORDER BY or_id DESC";;
        $this->dbsql = "UPDATE {$this->table},{$this->table4} SET or_delivery_note = :delivery_note WHERE or_token = :token {$add}";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':delivery_note',$this->delivery_note,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
        $this->dbstmt->execute();
        if($type === 'single'){
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($this->dbnumRow > 0){return true;}else{return false;} 
        }
    }
    
    public function update_review_status($type='multi'){
        $this->dbsql = "UPDATE {$this->table} SET or_review = 'yes' WHERE or_id = :id";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        $this->dbstmt->execute();
        if($type === 'single'){
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($this->dbnumRow > 0){return true;}else{return false;} 
        }
    }
    
    public function update_payment_received($type='multi'){
        $this->pmt_month = date('Y-m');
        $this->pmt_year = date('Y');
        $this->dbsql = "UPDATE {$this->table} SET or_payment_received = 'yes',or_pmt_regdatetime = NOW(),or_pmt_date = NOW(),
        or_pmt_month = :month, or_pmt_year = :year WHERE or_id = :or_id";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':or_id',$this->or_id,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':month',$this->pmt_month,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':year',$this->pmt_year,PDO::PARAM_STR);
        $this->dbstmt->execute();
        if($type === 'single'){
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($this->dbnumRow > 0){return true;}else{return false;} 
        }
    }
    
    public function update_order_status($type='multi',$mode='token'){
        $add = "AND order_table.f_id = food_table.f_id AND f_status = 'available'";
        if($mode === 'token'){
            $this->dbsql = "UPDATE {$this->table},{$this->table4} SET or_status = :new_status WHERE or_token = :token AND or_status = :status {$add}";   
        }else{
            $this->dbsql = "UPDATE {$this->table} SET or_status = :new_status WHERE or_id = :or_id";
        }
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':new_status',$this->new_status,PDO::PARAM_STR);
        if($mode === 'token'){
            $this->dbstmt->bindParam(':status',$this->status,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':token',$this->token,PDO::PARAM_STR);
        }else{
            $this->dbstmt->bindParam(':or_id',$this->or_id,PDO::PARAM_INT);
        }
        $this->dbstmt->execute();
        if($type === 'single'){
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($this->dbnumRow > 0){return true;}else{return false;}
        }
    }
    
    public function update_cancel_reason($type='multi'){
        if(empty(content_data($this->table,'or_cancel_reason',$this->or_id,'or_id'))){
            $this->dbsql = "UPDATE {$this->table} SET or_cancel_reason = :cancel_reason WHERE or_id = :or_id";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':cancel_reason',$this->cancel_reason,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':or_id',$this->or_id,PDO::PARAM_INT);
            $this->dbstmt->execute();
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($type === 'single'){
                $this->dbnumRow = $this->dbstmt->rowCount();
                if($this->dbnumRow > 0){return true;}else{return false;} 
            }
        }
    }
    public function update_total_available($type='multi'){
        $this->dbsql = "UPDATE {$this->table4} SET f_total_available = :total_available WHERE f_id = :f_id";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':total_available',$this->new_total_available,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':f_id',$this->f_id,PDO::PARAM_INT);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($type === 'single'){
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($this->dbnumRow > 0){return true;}else{return false;}
        }
    }
    
    public function change_food_status($type='multi'){
        $this->dbsql = "UPDATE {$this->table4} SET f_status = :new_f_status WHERE f_id = :f_id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':f_id',$this->f_id,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':new_f_status',$this->new_f_status,PDO::PARAM_STR);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;} 
    }
    
    public function insert_order_history($type='multi'){
        if(content_data($this->table3,'oh_id',$this->or_id,'or_id',"AND oh_status = '{$this->new_status}'") === false){
            $this->dbsql = "INSERT INTO {$this->table3}(oh_status,or_id) VALUES(:new_status,:or_id)";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':new_status',$this->new_status,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':or_id',$this->or_id,PDO::PARAM_INT);
            $this->dbstmt->execute();
            $this->dbnumRow = $this->dbstmt->rowCount();
            if($type === 'single'){
                $this->dbnumRow = $this->dbstmt->rowCount();
                if($this->dbnumRow > 0){return true;}else{return false;} 
            }
        }
    }
    
    
    function change_order_status(){
        $this->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        try{
            //begin transaction
            $this->dbconn->beginTransaction();
            //change status to new one
            $this->update_order_status('multi','order_id');
            //update payment received
            if($this->new_status === 'delivered' && content_data($this->table,'or_payment_method',$this->or_id,'or_id') === 'payment on delivery'){
                $this->update_payment_received();
            }
            //update reasons
            if($this->new_status === 'cancelled'){$this->update_cancel_reason();}
            //update total_available & update food status
            if($this->new_status === 'confirmed' || ($this->new_status === 'cancelled' && $this->status !== 'order placed')){
                //update total available
                $this->f_id = content_data('order_table','f_id',$this->or_id,'or_id');
                $this->quantity = content_data('order_table','or_quantity',$this->or_id,'or_id');
                $this->total_available = content_data('food_table','f_total_available',$this->f_id,'f_id');
                if($this->new_status === 'cancelled'){ // add from total available or remove fromt it
                    $this->new_total_available = ($this->total_available + $this->quantity);
                }else{
                    $this->new_total_available = ($this->total_available - $this->quantity);
                }
                $this->update_total_available();
                //update food status
                $this->f_status = content_data('food_table','f_status',$this->f_id,'f_id');
                if($this->new_status === 'confirmed' && ($this->new_total_available < 1) && $this->f_status === 'available'){
                    $this->new_f_status = 'unavailable';
                }else{
                    $this->new_f_status = 'available';
                }
                $this->change_food_status();
            }//update reasons
			$this->insert_order_history();//insert into the order history
            $this->insert_notification();//insert notification
            // commit the transation
            if($this->dbconn->commit()){
                //SEND EMAIL
                $company_email = get_json_data('support_email','about_us');
                $company_name = ucwords(get_xml_data('company_name'));
                $customer_email = content_data('user_table','u_email',$this->u_id,'u_id');
                $customer_name = content_data('user_table','u_fullname',$this->u_id,'u_id');
                $mail = new mail();
                $mail->p_receiver = $customer_email;
                $mail->p_subject = email_subject($this->new_status,$this->order_id);
                $mail->p_message = email_message($this->new_status,$customer_name,$this->order_id);
                $mail->p_header = implode("\r\n",[
                        "From:".$company_name." <".$company_email.">",
                        "MIME-Version: 1.0",
                        "Content-Type: text/html; charset=UTF-8"
                        ]);
                $mailsent = $mail->send_mail();
                return true;
            }//if commit
        }catch(PDOException $e){
            //rollback
            if($this->dbconn->rollback()){return false;}//if rollback
        }// end of try and catch
    }
    
    function run_trans(){
        //DELETE ORDER TOEKN
        delete_order_token();
        $this->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        try{
            //begin transaction
            $this->dbconn->beginTransaction();
            $this->update_order_status(); //change status to order placed
            $this->insert_transaction(); //insert into transaction
            //insert into order history
            $add = "AND order_table.f_id = food_table.f_id AND f_status = 'available' ORDER BY or_id DESC";
            $or_ids = multiple_content_data('order_table,food_table','or_id',$this->token,'or_token',$add);
            if($or_ids !== false){
                foreach($or_ids AS $id){
                    $this->or_id = $id;
                    $this->insert_order_history();
                    $this->u_id = $this->current_user;
                    $this->insert_notification();
                    //update payment received
                    if($this->t_payment_method !== "Payment on Delivery/Pickup" && $this->t_status === 'success'){
                        $this->update_payment_received();
                    }
                }
            }
            // commit the transation
            if($this->dbconn->commit()){
                //SEND EMAIL
                if($or_ids !== false){
                    $company_email = get_json_data('support_email','about_us');
                    $company_name = ucwords(get_xml_data('company_name'));
                    $customer_email = content_data('user_table','u_email',$this->current_user,'u_id');$customer_name = content_data('user_table','u_fullname',$this->current_user,'u_id');
                    foreach($or_ids AS $or_id){
                        $order_id = content_data('order_table','or_order_id',$or_id,'or_id');
                        $mail = new mail();
                        $mail->p_receiver = $customer_email;
                        $mail->p_subject = email_subject($this->new_status,$order_id);
                        $mail->p_message = email_message($this->new_status,$customer_name,$order_id);
                        $mail->p_header = implode("\r\n",[
                                            "From:".$company_name." <".$company_email.">",
                                            "MIME-Version: 1.0",
                                            "Content-Type: text/html; charset=UTF-8"
                                            ]);
                        $mailsent = $mail->send_mail();
                    }
               }
            return true;
            }//if commit
        }catch(PDOException $e){
            //rollback
            if($this->dbconn->rollback()){return false;}//if rollback
        }// end of try and catch
    }
    
    public function refund_customer(){
        $this->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        try{
            //begin transaction
            $this->dbconn->beginTransaction();
            //update order table
            $this->dbsql = "UPDATE {$this->table} SET or_refund = 'yes' WHERE or_id = :id";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
            $this->dbstmt->execute();
            //insert into refund table
            $this->pmt_month = date('Y-m');
            $this->dbsql = "INSERT INTO {$this->table5}(r_amount,r_month,or_order_id,user_id) VALUES(:amount,:month,:order_id,:user_id)";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':amount',$this->amount,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':month',$this->pmt_month,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':order_id',$this->order_id,PDO::PARAM_INT);
            $this->dbstmt->bindParam(':user_id',$this->user_id,PDO::PARAM_INT);
            $this->dbstmt->execute();
            // commit the transation
            if($this->dbconn->commit()){
                return true;
            }
        }catch(PDOException $e){
            //rollback
            if($this->dbconn->rollback()){return false;}//if rollback
        }// end of try and catch
    }
}
?>