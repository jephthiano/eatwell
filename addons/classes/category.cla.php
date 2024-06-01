<?php
class category{
    private $table = 'category_table';
    private $table2 = 'food_table';
    private $media_table = 'category_media_table';
    private $dbconn;
	private $dbstmt;
	private $dbsql;
    private $dbnumRow;
    
    public $id;
    public $category;
    public $icon;
    public $old_category;
    
    public $type;
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
    
    
    public function insert_category(){
        if(content_data('category_table','c_id',$this->category,'c_category') !== false){
            if($this->type === 'normal'){
                //delete image recently uploaded if content exists
                $this->full_file_name = $this->file_name.".".$this->extension;
                $this->full_path = file_location('media_path','category/'.$this->full_file_name);
                if(file_exists($this->full_path) && $this->full_file_name !== 'home/no_media.png' && is_file($this->full_path)){unlink($this->full_path);}
            }
            return 'exists';
        }else{
            $this->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            try{
                //begin transaction
                $this->dbconn->beginTransaction();
                $this->dbsql = "INSERT INTO {$this->table}(c_category,c_icon)VALUES(:category,:icon)";
                $this->dbstmt = $this->dbconn->prepare($this->dbsql);
                $this->dbstmt->bindParam(':category',$this->category,PDO::PARAM_STR);
                $this->dbstmt->bindParam(':icon',$this->icon,PDO::PARAM_STR);
                $this->dbstmt->execute();
                $this->last_id = $this->dbconn->lastInsertId(); //last id
                if($this->type === 'normal'){
                    // insert image
                    $this->dbsql = "INSERT INTO {$this->media_table}(cm_link_name,cm_extension,c_id) VALUES(:link_name,:extension,:c_id)";
                    $this->dbstmt = $this->dbconn->prepare($this->dbsql);
                    $this->dbstmt->bindParam(':link_name',$this->file_name,PDO::PARAM_STR);
                    $this->dbstmt->bindParam(':extension',$this->extension,PDO::PARAM_STR);
                    $this->dbstmt->bindParam(':c_id',$this->last_id,PDO::PARAM_INT);
                    $this->dbstmt->execute();
                }
                // commit the transation
                if($this->dbconn->commit()){return $this->last_id;}//if commit
            }catch(PDOException $e){
                //rollback
                if($this->dbconn->rollback()){
                    if($this->type === 'normal'){
                        //delete image
                        $this->full_file_name = $this->file_name.".".$this->extension;
                        $this->full_path = file_location('media_path','category/'.$this->full_file_name);
                        if(file_exists($this->full_path) && $this->full_file_name !== 'home/no_media.png' && is_file($this->full_path)){unlink($this->full_path);}
                    }
                    return false;
                }//if rollback
            }// end of try and catch
        }
    }//end insert category
    
    public function update_category(){
        $this->old_category = content_data('category_table','c_category',$this->id,'c_id');
        
        $this->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        try{
            //begin transaction
            $this->dbconn->beginTransaction();
            //update category in category
            $this->dbsql = "UPDATE {$this->table} SET c_category = :category,c_icon = :icon  WHERE c_id = :id LIMIT 1";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':category',$this->category,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':icon',$this->icon,PDO::PARAM_STR);
            $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
            $this->dbstmt->execute(); 
            //update category in food table
            $this->update_food_category();
            // commit the transation
            if($this->dbconn->commit()){return true;}//if commit
        }catch(PDOException $e){
            //rollback
            if($this->dbconn->rollback()){return false;}//if rollback
        }// end of try and catch
    }
    
    public function delete_category(){
        $this->category = 'others';
        $this->old_category = content_data('category_table','c_category',$this->id,'c_id');
        $this->full_file_name = get_media('category',$this->id);
        
        $this->dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        try{
            //begin transaction
            $this->dbconn->beginTransaction();
            //delete category in food
            $this->dbsql = "DELETE FROM {$this->table} WHERE c_id = :id LIMIT 1";
            $this->dbstmt = $this->dbconn->prepare($this->dbsql);
            $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
            $this->dbstmt->execute();
            //update category in food table
            $this->update_food_category();
            // commit the transation
            if($this->dbconn->commit()){
                $this->full_path = file_location('media_path',$this->full_file_name);
                if(file_exists($this->full_path) && $this->full_file_name !== 'home/no_media.png'){
                    unlink($this->full_path);
                }
                return true;
            }//if commit
        }catch(PDOException $e){
            //rollback
            if($this->dbconn->rollback()){return false;}//if rollback
        }// end of try and catch
    }
    
    public function update_food_category(){
        $this->dbsql = "UPDATE {$this->table2} SET f_category = :category WHERE f_category = :old_category";
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':category',$this->category,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':old_category',$this->old_category,PDO::PARAM_STR);
        if($this->dbstmt->execute()){return true;}else{return false;} 
    }
    
    public function remove_image(){
        $this->full_file_name = get_media('category',$this->id);
        $this->full_path = file_location('media_path',$this->full_file_name);
        if(file_exists($this->full_path) && $this->full_file_name !== 'home/no_media.png' && is_file($this->full_path)){
                if(unlink($this->full_path)){
                    $this->dbsql = "DELETE FROM {$this->media_table} WHERE c_id = :id LIMIT 1";
                    $this->dbstmt = $this->dbconn->prepare($this->dbsql);
                    $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
                    $this->dbstmt->execute();
                    return true;
                }else{
                    return false;
                }
        }
    }
    public function change_image(){
        $this->full_file_name = get_media('category',$this->id);
        $this->full_path = file_location('media_path',$this->full_file_name);
        
        if(content_data($this->media_table,'cm_id',$this->id,'c_id') !== false){
            $this->dbsql = "UPDATE {$this->media_table} SET cm_link_name = :link_name,cm_extension = :extension WHERE c_id = :id LIMIT 1";
        }else{
            $this->dbsql = "INSERT INTO {$this->media_table}(cm_link_name,cm_extension,c_id)VALUES(:link_name,:extension,:id)";
        }
        $this->dbstmt = $this->dbconn->prepare($this->dbsql);
        $this->dbstmt->bindParam(':link_name',$this->file_name,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':extension',$this->extension,PDO::PARAM_STR);
        $this->dbstmt->bindParam(':id',$this->id,PDO::PARAM_INT);
        if($this->dbstmt->execute()){
            //delete the existing image
            if(file_exists($this->full_path) && $this->full_file_name !== 'home/no_media.png' && is_file($this->full_path)){unlink($this->full_path);}
            return true;
        }else{
            //delete new image
            $this->full_file_name = $this->file_name.".".$this->extension;
            $this->full_path = file_location('media_path','category/'.$this->full_file_name);
            if(file_exists($this->full_path) && $this->full_file_name !== 'home/no_media.png' && is_file($this->full_path)){unlink($this->full_path);}
            return false;
        }
    }//end of store user image
}
?>