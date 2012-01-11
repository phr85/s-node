<?php
$year = XT::getValue("year") == "" ? date("Y", time()) : XT::getValue("year");
$month = XT::getValue("month") == "" ? date("m", time()) : XT::getValue("month");

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

XT::assign("SELECT_MONTH", $month);
XT::assign("YEAR", $year);
XT::assign("DAYS", $days);
XT::assign("SELECTED_DAY", XT::getValue("day"));
$content = XT::build("calendar.tpl");
?>