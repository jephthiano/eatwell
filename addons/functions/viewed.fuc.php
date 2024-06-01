<?php
//VIEWED FUNCTION STARTS
//set token starts
function set_viewed_token(){
 if(!isset($_COOKIE['ryn_vd'])){
  $data = "view".time().rand(0000,9999);
  $cookie_data = ssl_encrypt_input($data);
  $expiretime = time()+(86400 * 7);
  setcookie("ryn_vd",$cookie_data,$expiretime,"/","",true,true);
  return ssl_decrypt_input($cookie_data);
 }
}
//set token ends

//get token starts
function get_viewed_token($type='none'){if(isset($_COOKIE['ryn_vd'])){return test_input(ssl_decrypt_input($_COOKIE['ryn_vd']));}else{if($type === 'none'){return 'no_view';}else{return set_viewed_token();}}}
//get token ends

//delete token starts
function delete_viewed_token(){if(isset($_COOKIE['ryn_vd'])){setcookie("ryn_vd","",time()-3600,"/","",true,true);}};
//delete token ends

//check viewed starts
function check_viewed($id){
 $token = get_viewed_token();
 require_once(file_location('inc_path','connection.inc.php'));
 @$conn = dbconnect('admin','PDO');
 $sql = "SELECT v_id FROM viewed_table WHERE f_id = :fid AND v_token = :token";
 $stmt = $conn->prepare($sql);
 $stmt->bindParam(':fid',$id,PDO::PARAM_INT);
 $stmt->bindParam(':token',$token,PDO::PARAM_INT);
 $stmt->bindColumn('v_id',$vid);
 $stmt->execute();
 $numRow = $stmt->rowCount();
 if($numRow > 0){
  return true;
 }else{
  return false;
 }
 closeconnect("stmt",$stmt);
 closeconnect("db",$conn);
}
//check viewed ends

//insert viewed starts
function insert_viewed($id){
 $viewed = new viewed('admin');
 $viewed->f_id = $id;
 $viewed->insert_viewed();
}
//inserts viewed ends
//VIEWED FUNCTION ENDS
?>