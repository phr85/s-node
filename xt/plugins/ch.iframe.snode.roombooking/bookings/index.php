<?php
// get parameters
if(XT::getValue('room_id') >0){
    XT::setSessionValue('room_id',XT::getValue('room_id'));
}
if(XT::getParam("room_id") > 0){
    XT::setSessionValue("room_id",XT::getParam("room_id"));
}
$room_id = XT::getSessionValue("room_id");


// Range (day, week, month)
if(XT::getSessionValue("range")==""){
    XT::setSessionValue('range',"day");
}
if(XT::getValue('range') != ""){
    XT::setSessionValue('range',XT::getValue('range'));
}
if(XT::getParam("range") != ""){
    XT::setSessionValue("range",XT::getParam("range"));
}
$range = XT::getSessionValue("range");
  

$daterange=getDateRange(XT::getSessionValue("date"),XT::getSessionValue("range"));
 
switch (XT::getSessionValue("range")) {
	case "day":
		include("day.php");
		break;
	case "month":
		include("month.php");
		break;
	case "week":
		include("week.php");
		break;
	case "year":
		include("year.php");
		break;
	default:
	    include("default.php");
		break;
}


?>