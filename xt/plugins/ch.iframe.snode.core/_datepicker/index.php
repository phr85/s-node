<?php

$year = XT::getValue("date") == "" ? date("Y", time()) : date("Y", XT::getValue("date"));
$month = XT::getValue("date") == "" ? date("m", time()) : date("m", XT::getValue("date"));
$sday = XT::getValue("date") == "" ? date("j", time()) : date("j", XT::getValue("date"));

if(XT::getValue('reset') !=1){
    XT::unsetSessionValue('field');
    XT::unsetSessionValue('form');
}
if(XT::getValue('field') !=''){
    XT::setSessionValue('field',XT::getValue('field'));
}
if(XT::getValue('form') !=''){
    XT::setSessionValue('form',XT::getValue('form'));
}

if (XT::getValue("yeardown") !=  "") {
	$year--;
}

if (XT::getValue("yearup") !=  "") {
	$year++;
}

$makedtime = mktime(0,0,0, $month, 1, $year);
$days_in_month = date("t", $makedtime);
$day_start = date("w", $makedtime)-1;
if ($day_start==-1){
    $day_start=6;
}
$days = array();
$rows = 0;
$day = 1;

// create rows
while ($rows < 6) {
	$cols = 0;
	
	$days[$rows] = array();
    
	// create cols 
	for ($i = 0; $i < 7; $i++) {
	    // skip day start
	    if ($i < $day_start && $skip_start == false) {
	    	$days[$rows][$i] = '';
	    }
	    // 
	    else {
	        $skip_start = true;
	        
	        if($day < ($days_in_month + 1)) {
	    	  $days[$rows][$i] = $day++;
	        }
	        else {
	        	$days[$rows][$i] = '';
	        }
	    }
	}
    
    $rows++;
}

XT::assign('FIELD',XT::getSessionValue('field'));
if(XT::getSessionValue('form')!=""){
    XT::assign('FORM',"'" . XT::getSessionValue('form') . "'");
}else {
    XT::assign('FORM',0);
}
XT::assign("USE_DATE", XT::getValue("date"));
XT::assign("USE_DATE_STR", date("d.m.Y", XT::getValue("date")));
XT::assign("MONTH", $month);
XT::assign("YEAR", $year);
XT::assign("DAYS", $days);
XT::assign("SELECTED_DAY", $sday);
$content = XT::build("calendar.tpl");
?>