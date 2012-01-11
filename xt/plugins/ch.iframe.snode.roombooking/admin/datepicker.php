<?php

if(XT::getValue("date")>0){
    XT::setValue("use_date",XT::getValue("date"));
    XT::call("updateDate");
}

// Get data for room and month
if(XT::getSessionValue("room_id")>0){
    //count weekrange
    $daterange=getDateRange(XT::getSessionValue("date"),"month");
    $result = XT::query("
    SELECT date_from FROM
        " . $GLOBALS['plugin']->getTable("bookings") . "
    WHERE
        room_id = " . XT::getSessionValue("room_id") . "
    AND
        date_from > " . $daterange[0] . "
    AND 
        date_to < " . $daterange[1]       
    ,__FILE__,__LINE__);

    while($row = $result->FetchRow()){
        $bookeddays[date("d",$row['date_from'])] ++;
    }
    XT::assign("BOOKEDDAYS",$bookeddays);
}

$year =  XT::getValue("date") == "" ? date("Y", XT::getSessionValue("date")) : date("Y", XT::getValue("date"));
$month = XT::getValue("date") == "" ? date("m", XT::getSessionValue("date")) : date("m", XT::getValue("date"));
$sday =  XT::getValue("date") == "" ? date("j", XT::getSessionValue("date")) : date("j", XT::getValue("date"));

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

XT::assign("USE_DATE", XT::getValue("date"));
XT::assign("USE_DATE_STR", date("d.m.Y", XT::getValue("date")));
XT::assign("MONTH", $month);
XT::assign("YEAR", $year);
XT::assign("DAYS", $days);
XT::assign("SELECTED_DAY", $sday);
XT::assign("SETTEDDATE", XT::getSessionValue("date"));
$content = XT::build("calendar.tpl");
?>