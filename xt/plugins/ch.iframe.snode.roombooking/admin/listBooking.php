<?php

if($GLOBALS['plugin']->getValue("room_id") != ''){
    $GLOBALS['plugin']->setSessionValue("room_id", $GLOBALS['plugin']->getValue("room_id"));
}

// Buttons

XT::addImageButton("[a]dd booking","addRes2Room","default","calendar.png","0","slave1","a");
if(XT::getSessionValue("daterange")!="day"){
    XT::addImageButton("[d]ay","setview_day","default","table_selection_cell.png","0","slave1","d");
}else{
    XT::addImageButton("[d]ay","setview_day","default","table_sql_check.png","0","slave1","d");
}

if(XT::getSessionValue("daterange")!="week"){
    XT::addImageButton("[w]eek","setview_week","default","table_selection_row.png","0","slave1","w");
}else {
	XT::addImageButton("[w]eek","setview_week","default","table_sql_check.png","0","slave1","w");
}
if(XT::getSessionValue("daterange")!="month"){
    XT::addImageButton("[m]onth","setview_month","default","table_selection_block.png","0","slave1","m");
}else {
	XT::addImageButton("[m]onth","setview_month","default","table_sql_check.png","0","slave1","m");
}
if(XT::getSessionValue("daterange")!="year"){
    XT::addImageButton("[y]ear","setview_year","default","table_selection_all.png","0","slave1","m");
}else {
	XT::addImageButton("[y]ear","setview_year","default","table_sql_check.png","0","slave1","m");
}

// Get room details
$result = XT::query("
    SELECT * FROM
        " . $GLOBALS['plugin']->getTable("rbs_rooms") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("room_id") . "
",__FILE__,__LINE__);
$data = array();
$data = XT::getQueryData($result);
XT::assign("ROOM",$data[0]);
unset($data);

if(XT::getSessionValue("daterange")==""){
    XT::setSessionValue("daterange","week");
}
$daterange=getDateRange(XT::getSessionValue("date"),XT::getSessionValue("daterange"));

//count weekrange
$weekrange=getDateRange(XT::getSessionValue("date"),"week");
$result = XT::query("
    SELECT count(id) as cnt FROM
        " . $GLOBALS['plugin']->getTable("bookings") . "
    WHERE
        room_id = " . $GLOBALS['plugin']->getSessionValue("room_id") . "
    AND
        date_from > " . $weekrange[0] . "
    AND 
        date_to < " . $weekrange[1]       
,__FILE__,__LINE__);
$data = array();
$data = XT::getQueryData($result);
$bookingcount['week'] = $data[0]['cnt'];
unset($data);

//count monthrange
$monthrange=getDateRange(XT::getSessionValue("date"),"month");
$result = XT::query("
    SELECT count(id) as cnt FROM
        " . $GLOBALS['plugin']->getTable("bookings") . "
    WHERE
        room_id = " . $GLOBALS['plugin']->getSessionValue("room_id") . "
    AND
        date_from > " . $monthrange[0] . "
    AND 
        date_to < " . $monthrange[1]       
,__FILE__,__LINE__);
$data = array();
$data = XT::getQueryData($result);
$bookingcount['month'] = $data[0]['cnt'];
unset($data);

//count yearrange
$yearrange=getDateRange(XT::getSessionValue("date"),"year");
$result = XT::query("
    SELECT count(id) as cnt FROM
        " . $GLOBALS['plugin']->getTable("bookings") . "
    WHERE
        room_id = " . $GLOBALS['plugin']->getSessionValue("room_id") . "
    AND
        date_from > " . $yearrange[0] . "
    AND 
        date_to < " . $yearrange[1]       
,__FILE__,__LINE__);
$data = array();
$data = XT::getQueryData($result);
$bookingcount['year'] = $data[0]['cnt'];
unset($data);


switch (XT::getSessionValue("daterange")) {
	case "day":
		include("listBooking/day.php");
		break;
	case "month":
		include("listBooking/month.php");
		break;
	case "week":
		include("listBooking/week.php");
		break;
	case "year":
		include("listBooking/year.php");
		break;
	default:
	    include("listBooking/default.php");
		break;
}
?>