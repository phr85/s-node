<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(5600);

// Plugin tables
$GLOBALS['plugin']->addTable('rbs_rooms','rbs_rooms','Rooms', false);
$GLOBALS['plugin']->addTable('bookings','rbs_bookings','Rooms', false);
XT::addTable('addresses');
XT::addTable('user');

$GLOBALS['plugin']->addContentType(5600, "Room");
$GLOBALS['plugin']->addConfig("image_picker_base_id", 240, "");
$GLOBALS['plugin']->addConfig("image_picker_tpl", 597, "");

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('e','Edit room','editRoom.php',false,false);
$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);
$GLOBALS['plugin']->addTab('datepicker','Datepicker','datepicker.php',false,false);
$GLOBALS['plugin']->addTab('eb','Edit Booking','editBooking.php',false,false);
$GLOBALS['plugin']->addTab('lb','List Booking','listBooking.php',false,false);



XT::addConfig('create_tpl',10066);

// relations
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.relations.zl")){
    $display['relations']=true;
}


XT::assign("DISPLAY",$display);
XT::assign("DATE_PICKER_TPL",305);

// Addresspicker template
XT::addConfig("ADDR_PICKER_TPL", 281);


XT::addConfig("blocksize", 1800);

// Image picker
XT::addConfig("image_picker_base_id", 240, "");
XT::addConfig("image_picker_tpl", 597, "");


// Load permissions
$GLOBALS['plugin']->enablePermissions();
// DO not edit below this line
if(XT::getSessionValue("date")==""){
    XT::setSessionValue("date",TIME);
}


// returns an array with startpoint (0) and endpoint(1) for a given "day,week, month or year";
if(!function_exists("getDateRange")){
    function getDateRange($date,$range="day"){
        switch ($range) {
            case "day":
                $datearr[0]= mktime(0,0,0,date("m",$date),date("d",$date),date("Y",$date));
                $datearr[1]= mktime(0,0,0,date("m",$date),date("d",$date) +1,date("Y",$date));
                break;
            case "week":
                $datearr[0] = mktime(0,0,0,1,(date("W",$date)*7)-5,date("Y",$date));
                $datearr[1] = mktime(23,59,59,1,(date("W",$date)*7)+1,date("Y",$date));
                break;
            case "month":
                $datearr[0] = mktime(0,0,0,date("m",$date),1,date("Y",$date));
                $datearr[1] = mktime(23,59,59,date("m",$date)+1,0,date("Y",$date));
                break;
            case "year":
                $datearr[0] = mktime(0,0,0,1,1,date("Y",$date));
                $datearr[1] = mktime(0,0,0,13,0,date("Y",$date));
                break;
        }
        return $datearr;
    }
}
// check collission for bookings returns true if no collision and false if there is a collision
if(!function_exists("checkCollission")){
    function checkCollission($room,$from,$to=0,$booking=0,$duration=0){
        if($booking!=0){
            $bookingsql = "AND id != " . $booking;
        }else{
            $bookingsql = "";
        }
        if($duration != 0){
            $to=$from+$duration;
        }
        $result = XT::query("select count(id) as cnt from " . XT::getTable('bookings') . " where
        ((date_from < " . $from . " AND date_to > " . $from . ")
    OR
        (date_from > " . $from . " AND date_from < " . $to . ")
    OR
        (date_from = " . $from . " AND date_to = " . $to . ")
        )
     " . $bookingsql . " AND room_id=" . $room ,__FILE__,__LINE__);
        $count = XT::getQueryData($result);
        if($count[0]['cnt']>0){
            return false;
        }else{
            return true;
        }
    }
}
?>
