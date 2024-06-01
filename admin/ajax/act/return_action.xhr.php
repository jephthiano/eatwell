<?php
if(isset($_POST)){
	require_once($_SERVER["DOCUMENT_ROOT"]."/addons/function.inc.php");// all functions
	$error = []; $data = [];
	
	// validate id
	$id = removenum($_POST['orid']);
	if(empty($id)){$error['empty'] = "empty";}else{$cid = test_input($id);}
	
	//validate type
	$ty = ($_POST['type']);
	if(empty($ty)){
		$error['empty'] = "empty";
	}else{
		$type = test_input($ty);
		// validate correct type
		if($type === 'request approved'){
			$new_status = 'request approved';
		}elseif($type === 'request rejected'){
			$new_status = 'request rejected';
		}elseif($type === 'return approved'){
			$new_status = 'return approved';
		}elseif($type === 'return rejected'){
			$new_status = 'return rejected';
		}else{
			$error['empty'] = "empty";
		}
	}
	
	// validating return reason
	if($type === 'request rejected'){
		$rr = $_POST['rrj'];
		if(empty($rr)){
			$error['rrje'] = "* select the reason why return request is rejected";
		}elseif($rr === 'other'){
			$orr = $_POST['orrj'];
			$orr = '';
			if(empty($orr)){
				$error['rrje'] = "* input the reason for return rejection in the textbox below";
			}else{
				$return_reason = test_input($orr);
			}
		}else{
			$return_reason = test_input($rr);
		}
	}elseif($type === 'return rejected'){
		$rr = $_POST['rj'];
		if(empty($rr)){
			$error['rje'] = "* select the reason return of the item is rejected";
		}elseif($rr === 'other'){
			$orr = $_POST['orj'];
			if(empty($orr)){
				$error['rje'] = "* input the reason for return rejection in the textbox below";
			}else{
				$return_reason = test_input($orr);
			}
		}else{
			$return_reason = test_input($rr);
		}
	}
	if(empty($error)){
		$order_id = content_data('order_table','or_order_id',$cid,'or_id');
		$return = new return_product('admin');
		$return->new_status = $new_status;
		if($new_status === 'request rejected'){
            $return->request_reject_reason = $return_reason;
			 $reason = "<br><b>Reason:</b> {$return_reason}";
        }elseif($new_status === 'return rejected'){
            $return->return_reject_reason = $return_reason;
			$reason = "<br><b>Reason:</b> {$return_reason}";
        }else{
			$reason = '';
			}
		$return->or_id = $cid;
		$return->or_order_id = $order_id;
		$return->u_id = content_data('order_table','user_id',$cid,'or_id');
		$return->n_title = notification_subject($new_status);
		$return->n_message = notification_message($new_status).$reason;
		$insert = $return->run_return_data($new_status);
		if($insert === true){
			$data["status"] = 'success';$data["message"] = 'Success!!!<br>Request successfully ';
			//INSERT LOG
			if($new_status === 'request approved'){
				$brief = "Request for return was approved";
				$message = "approved the request to return order {$order_id} {$reason}";
			}elseif($new_status === 'request rejected'){
				$brief = "Request for return was rejected";
				$message = "rejected the request to return order {$order_id} {$reason}";
			}elseif($new_status === 'return approved'){
				$brief = "Return of item was approved";
				$message = "approved the return of order {$order_id} {$reason}";
			}elseif($new_status === 'return rejected'){
				$brief = "Return of item was rejected";
				$message = "rejected the return of order {$order_id} {$reason}";
			}
			$log = new log('admin');
			$log->brief = $brief;
			$log->details = $message;
			$log->insert_log();
		}else{
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occur while running request, try again later.";
		}
	}else{
		if(in_array('empty',$error)){
			$data["status"] = 'fail';$data["message"] = "Sorry!!!<br>Error occur while running request, try again later.";
		}else{
			$data["status"] = 'error';$data["errors"] = $error;
		}
	}
	echo json_encode($data);
}//end of if isset
?>