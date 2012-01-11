<?php
XT::addImageButton("[S]ave","saveBooking","default","disk_blue.png","0","slave1","s");
XT::addImageButton("Save and close","saveBookingAndClose","default","save_close.png","0","slave1","e");

if($GLOBALS['plugin']->getValue("room_id") != ''){
    $GLOBALS['plugin']->setSessionValue("room_id", $GLOBALS['plugin']->getValue("room_id"));
}
if(XT::getValue("booking_id") > 0){
    XT::setValue("id",XT::getValue("booking_id"));
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


// Get booking
$result = XT::query("
    SELECT * FROM
        " . $GLOBALS['plugin']->getTable("bookings") . "
    WHERE
        id = " . XT::getValue("id") . "
",__FILE__,__LINE__);
$data = array();
$data = XT::getQueryData($result);
$timedata = $data[0];
$timeerror = XT::getValue("timeerror");
if(is_array($timeerror)){
    $timedata['date_from']=$timeerror[0];
    $timedata['date_to']=$timeerror[1];
    
    $result = XT::query("select title, date_from,date_to from " . XT::getTable('bookings') . " where
        ((date_from < " . $timeerror[0] . " AND date_to > " . $timeerror[0] . ")
    OR
        (date_from > " . $timeerror[0] . " AND date_from < " . $timeerror[1] . ")
    OR
        (date_from = " . $timeerror[0] . " AND date_to = " . $timeerror[1] . ")
        )
    AND id != " . XT::getValue("id") . " AND room_id=" . XT::getSessionValue("room_id") ,__FILE__,__LINE__);
    XT::assign("COLLISIONS",XT::getQueryData($result));
    
}
XT::assign("BOOKING",$data[0]);

if(XT::getValue("error")){
    XT::log(XT::getValue("error"),__FILE__,__LINE__,XT_ERROR);
}


// timer
for ($i=0;$i<24;$i++){
    if($i == date('H',$timedata['date_from'])){
        $time['shour'][$i]=true;
    }else{
        $time['shour'][$i]=false;
    }
    if($i == date('H',$timedata['date_to'])){
        $time['ehour'][$i]=true;
    }else{
        $time['ehour'][$i]=false;
    }
}

for ($i=0;$i<60;$i= $i+5){
    if($i == intval(date('i',$timedata['date_from']))){
        $time['smin'][$i]=true;
    }else{
        $time['smin'][$i]=false;
    }
    if($i == intval(date('i',$timedata['date_to']))){
        $time['emin'][$i]=true;
    }else{
        $time['emin'][$i]=false;
    }
}

$time['sdate']= $timedata['date_from'] > 0 ? $timedata['date_from'] : XT::getSessionValue("date");
$time['sdate_str']=$timedata['date_from'] > 0 ? date('d.m.Y',$timedata['date_from']) : date('d.m.Y', XT::getSessionValue("date"));
$time['edate']= $timedata['date_to'] > 0 ? $timedata['date_to'] : XT::getSessionValue("date");
$time['edate_str']=$timedata['date_to'] > 0 ? date('d.m.Y',$timedata['date_to']) : date('d.m.Y', (XT::getSessionValue("date")));

XT::assign('TIME',$time);

for($no=0;$no<7;$no++){

    for($no2=0;$no2<24;$no2++){
        $hrs[$no][$no2] = true ;
    }

}

XT::assign("HRS",$hrs);
XT::assign("BOOKINGID",XT::getValue("id"));

$content = XT::build("editBooking.tpl");
?>