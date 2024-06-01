<?php
//DATE AND TIME FUNCTION STARTS
//show date starts
function show_date($date,$type = 'date'){
 if($type === 'year'){
  $year = new DateTime($date.'-01');
  return $year->format('Y');
 }elseif($type === 'month'){
  $month = new DateTime($date);
  return $month->format('F Y');
 }else{
  $now = time()+(get_xml_data('time_correction'));
  $today = date("Y-m-d",$now); // today day,month and year
  $yesterday = date("Y-m-d",strtotime($today)-60*60*24); // yesterday day,month and year
  $thedate = date('Y-m-d',strtotime($date));
  if($today === $thedate){  // if same day return the time not days
    return "Today"; // ECHO TODAY
  }elseif($yesterday === $thedate){  //if yesterday return yesterday
    return "Yesterday";
  }else{
    $thedate = strtotime($date);
    return date('M d, Y',$thedate);
  }
 }//end of else
}
//show date ends

//show date starts
 function showdate($datetime,$type='full'){
	$now = time()+(get_xml_data('time_correction'));
	$thedate = strtotime($datetime);
	if($type === "short"){ //return in full format for short
		return date('M d, Y',$thedate);
	}else{ // else return in full format
		return date('M d, Y : g:i a',$thedate);	
	}
 }
//show date ends

//show time starts
function show_time($time){
 $time = new DateTime($time);
 return $time->format('g:ia');
}
//show time ends

//function process day starts
function process_day($type = 'current',$date = ''){
	if($type === 'current'){
		return date("Y-m-d");
	}elseif($type === 'next'){
		$thedate = new DateTime($date);
  $interval = new DateInterval('P1D');
  $next = $thedate->add($interval);
		return $next->format('Y-m-d');
	}elseif($type === 'previous'){
		$thedate = new DateTime($date);
  $interval = new DateInterval('P1D');
  $prev = $thedate->sub($interval);
		return $prev->format('Y-m-d');
		return date('Y-m-d',$thedate);	
	}
}
//function process day ends

//process month starts
function process_month($type = 'current',$month = ''){
	if($type === 'current'){
		return date("Y-m");
	}elseif($type === 'next'){
  $thedate = new DateTime($month);
  $interval = new DateInterval('P1M');
  $next = $thedate->add($interval);
		return $next->format('Y-m');
	}elseif($type === 'previous'){
		$thedate = new DateTime($month);
  $interval = new DateInterval('P1M');
  $prev = $thedate->sub($interval);
		return $prev->format('Y-m');
	}
}
//process month ends

//process year starts
function process_year($type = 'current',$year = ''){
	if($type === 'current'){
		return date("Y");
	}elseif($type === 'next'){
  $year = $year.'-01';
  $thedate = new DateTime($year);
  $interval = new DateInterval('P1Y');
  $next = $thedate->add($interval);
		return $next->format('Y');
	}elseif($type === 'previous'){
  $year = $year.'-01';
		$thedate = new DateTime($year);
  $interval = new DateInterval('P1Y');
  $prev = $thedate->sub($interval);
		return $prev->format('Y');
	}
}
//process year ends
// DATE AND TIME FUNCTION ENDS
?>