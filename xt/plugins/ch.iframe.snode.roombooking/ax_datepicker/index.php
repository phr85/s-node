<?php
XT::axParam("ax_datepicker");

if(XT::getValue("day") > 0){
    XT::setValue("date",mktime(0,0,0,XT::getValue("month"),XT::getValue("day"),XT::getValue("year")));
    XT::setSessionValue("date",XT::getValue("date"));
}
if(XT::getValue("action")=="goToToday"){
    XT::setValue("date",TIME);
    XT::setSessionValue("date",TIME);
}


$rooms = XT::getParam('rooms');
switch ($rooms) {
	case "all":
	$room_in = "";	
		break;
	case "":
	$room_in = "";	
		break;
	default:
	    $room_in = " AND room_id in(" . XT::getParam("rooms") . ")";
		break;
}


// Get data for room and month 
    //count weekrange
    $daterange=getDateRange(XT::getSessionValue("date"),"month");
    $result = XT::query("
    SELECT date_from FROM
        " . $GLOBALS['plugin']->getTable("bookings") . "
    WHERE
        date_from > " . $daterange[0] . "
    AND 
        date_to < " . $daterange[1]       
    . $room_in
    ,__FILE__,__LINE__);

    while($row = $result->FetchRow()){
        $bookeddays[date("d",$row['date_from'])] ++;
    }
    XT::assign("BOOKEDDAYS",$bookeddays);
 



$year =  date("Y", XT::getSessionValue("date"));
$month = date("m", XT::getSessionValue("date"));
$sday =  date("j", XT::getSessionValue("date"));
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
        } else {
            $skip_start = true;

            if($day < ($days_in_month + 1)) {
                $days[$rows][$i] = $day++;
            } else {
                $days[$rows][$i] = '';
            }
        }
    }
    $rows++;
}
 
XT::assign("MONTH", $month);
XT::assign("YEAR", $year);
XT::assign("DAYS", $days);
XT::assign("SELECTED_DAY", $sday);
XT::assign("SETTEDDATE", XT::getSessionValue("date"));

// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);
?>