<?php
class food{
    private $table = 'food_table';
    private $media_table = 'food_media_table';
    private $dbconn;
	private $dbstmt;
	private $dbsql;
    private $dbnumRow;
    
    public $id;
    public $name;
    public $category;
    public $max_order;
    public $total_available;
    public $original_price;
    public $discounted_price;
    public $short_description;
    public $details;
    public $weight;
    public $status;
    public $added;
    public $updated;
    
    public $type;
    public $file_length;
    public $arr_file_name;
    public $arr_extension;
    public $fm_id;
    public $file_name;
    public $extension;
    
    private $current_admin;
    private $last_id;
    private $full_file_name;
    private $full_path;
    
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
    
    
    public function insert_food(){
        if(content_data('food_table','f_id',$this->name,'f_name') !== false){
            if($this->type === 'normal'){
                //delete image
                for($x = 0; $x < $this->file_length; $x++){
                    $this->full_file_name = $this->arr_file_name[$x].".".$this->arr_extension[$x];
                    $this->full_path = file_location('media_path','food/'.$this->full_file_name);
                    if(file_exists($this->full_path) && $this->full_file_name !== 'home/no_media.png' && is_file($this->full_path)){unlink($this->full_path);}
                }
            }
            return 'exists';
        }else{
            $this->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            try{
                //begin transaction
                $this->dbconn->beginTransaction();
                $this->dbsql = "INSERT INTO {$this->table}(f_name,f_category,f_max_order,f_total_available,f_original_price,f_discounted_price,f_short_description,
                f_details,f_weight,f_added,f_updated)
                VALUES(:name,:category,:max_order,:total_available,:original_price,:discounted_price,:short_description,:details,:weight,:added,:updated)";
                $this->dbstmt = $this->dbconn->prepare($this->dbsql);
                $this->dbstmt->bindParam(':name',$this->name,PDO::PARAM_STR);
                $this->dbstmt->bindParam(':category',$this->category,PDO::PARAM_STR);
                $this->dbstmt->bindParam(':max_order',$this->max_order,PDO::PARAM_STR);
                $this->dbstmt->bindParam(':total_available',$this->total_available,PDO::PARAM_INT);
                $this->dbstmt->bindParam(':original_price',$this->original_price,PDO::PARAM_STR);
                $this->dbstmt->bindParam(':discounted_price',$this->discounted_price,PDO::PARAM_STR);
                $this->dbstmt->bindParam(':short_description',$this->short_description,PDO::PARAM_STR);
                $this->dbstmt->bindParam(':details',$this->details,PDO::PARAM_STR);
                $this->dbstmt->bindParam(':weight',$this->weight,PDO::PARAM_INT);
                $this->dbstmt->bindParam(':added',$this->current_admin,PDO::PARAM_INT);
                $this->dbstmt->bindParam(':updated',$this->current_admin,PDO::PARAM_INT);
                $this->dbstmt->execute();
                $this->last_id = $this->dbconn->lastInsertId(); //last id
                if($this->type === 'normal' && $this->file_length === count($this->arr_file_name) && $this->file_length === count($this->arr_extension)){
                    // insert image
                    for($x = 0; $x < $this->file_length; $x++){
                        $this->dbsql = "INSERT INTO {$this->media_table}(fm_link_name,fm_extension,f_id) VALUES(:link_name,:extension,:f_id)";
                        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
                        $this->dbstmt->bindParam(':link_name',$this->arr_file_name[$x],PDO::PARAM_STR);
                        $this->dbstmt->bindParam(':extension',$this->arr_extension[$x],PDO::PARAM_STR);
                        $this->dbstmt->bindParam(':f_id',$this->last_id,PDO::PARAM_INT);
                        $this->dbstmt->execute();
                    }
                }
                // commit the transation
                if($this->dbconn->commit()){return $this->last_id;}//if commit
            }catch(PDOException $e){
                //rollback
                if($this->dbconn->rollback()){
                    if($this->type === 'normal'){
                        //delete image
                        for($x = 0; $x < $this->file_length; $x++){
                            $this->full_file_name = $this->arr_file_name[$x].".".$this->arr_extension[$x];
                            $this->full_path = file_location('media_path','food/'.$this->full_file_name);
                            if(file_exists($this->full_path) && $this->full_file_name !== 'home/no_media.png' && is_file($this->full_path)){unlink($this->full_path);}
                        }
                    }
                    return false;
                }//if rollback
            }// end of try and catch
        }
    }//end insert food
    
    public function update_food(){
        $this->dbsql = "UPDATE {$this->table} SET f_name = :name,f_category = :category,
        f_max_order = :max_order,f_total_available = :total_available,f_original_price = :original_price,
        f_discounted_price = :discounted_price,f_short_description = :short_description,
        f_details = :details,f_weight = :weight,f_updated = :updated WHERE f_id = :id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':name',$this->name,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':category',$this->category,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':max_order',$this->max_order,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':total_available',$this->total_available,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':original_price',$this->original_price,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':discounted_price',$this->discounted_price,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':short_description',$this->short_description,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':details',$this->details,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':weight',$this->weight,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':updated',$this->current_admin,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        if($this->dbstmt->execute()){return true;}else{return false;} 
    }
    
    public function change_status(){
        $this->dbsql = "UPDATE {$this->table} SET f_status = :status WHERE f_id = :id LIMIT 1";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        $this->dbstmt->bindParam(':status',$this->status,PDO::PARAM_STR);
        $this->dbstmt->execute();
        $this->dbnumRow = $this->dbstmt->rowCount();
        if($this->dbnumRow > 0){return true;}else{return false;} 
    }
    
    public function remove_image(){
        $this->full_file_name = get_media('food',$this->fm_id);
        $this->full_path = file_location('media_path',$this->full_file_name);
        if(file_exists($this->full_path) && $this->full_file_name !== 'home/no_media.png' && is_file($this->full_path)){
                if(unlink($this->full_path)){
                    $this->dbsql = "DELETE FROM {$this->media_table} WHERE fm_id = :id LIMIT 1";
                    $this->dbstmt = $this->dbconn->prepare($this->dbsql);
                    $this->dbstmt->bindParam(':id',$this->fm_id,PDO::PARAM_INT);
                    $this->dbstmt->execute();
                    return true;
                }else{
                    return false;
                }
        }
    }
    
    public function change_image(){
        $this->full_file_name = get_media('food',$this->fm_id);
        $this->full_path = file_location('media_path',$this->full_file_name);
        $exists = content_data($this->media_table,'fm_id',$this->fm_id,'fm_id');
        if($exists !== false){
            $this->dbsql = "UPDATE {$this->media_table} SET fm_link_name = :link_name,fm_extension = :extension WHERE fm_id = :fm_id LIMIT 1";
        }else{
            $this->dbsql = "INSERT INTO {$this->media_table}(fm_link_name,fm_extension,f_id)VALUES(:link_name,:extension,:id)";
        }
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':link_name',$this->file_name,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':extension',$this->extension,PDO::PARAM_STR);
        if($exists !== false){$this->dbstmt->bindParam(':fm_id',$this->fm_id,PDO::PARAM_INT);}else{$this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);}
        if($this->dbstmt->execute()){
            //delete the existing image
            if(file_exists($this->full_path) && $this->full_file_name !== 'home/no_media.png' && is_file($this->full_path)){unlink($this->full_path);}
            return true;
        }else{
            //delete new image
            $this->full_file_name = $this->file_name.".".$this->extension;
            $this->full_path = file_location('media_path','food/'.$this->full_file_name);
            if(file_exists($this->full_path) && $this->full_file_name !== 'home/no_media.png' && is_file($this->full_path)){unlink($this->full_path);}
            return false;
        }
    }//end of store user image
}
?>