<?php
if(isset($_GET['i']) && isset($_GET['p'])){
    require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
    // validating and sanitizing content id
	$id = ($_GET['i']);
	if(empty($id) || !is_numeric($id)){$error[] = "number";}else{$c_id = test_input($id);}
		
	// validating and sanitizing type
	$ty = ($_GET['p']);
	if(empty($ty)){$error[] = "type";}else{$type = test_input($ty);}
    if(empty($error)){
        add_to_cart_btn($id,$type);
    }
}
?>