<?php
if($GLOBALS['ajaxmode']){
XT::axParam("ax_interface1");
}
// get parameters
unset($errormessage);
if(XT::getParam('rooms') == ""){
    $errormessage[] = "rooms not defined";
}

if(XT::getParam('starttime') == ""){
    $errormessage[] = "starttime not defined";
}else {
    $starttime = XT::getParam('starttime');
}
if(!is_numeric($starttime)){
    $stime = explode(":",$starttime);
    $starttime = ($stime[0] * 3600) + ($stime[1] * 60);
}

if(XT::getParam('endtime') == ""){
    $errormessage[] = "endtime not defined";
}else{
    $endtime = XT::getParam('endtime');
}
if(!is_numeric($endtime)){
    $etime = explode(":",$endtime);
    $endtime = ($etime[0] * 3600) + ($etime[1] * 60);
}
if($endtime < $starttime){
    $endtime = $endtime + 86400;
}

if(XT::getParam('blocksize') == ""){
    $blocksize = XT::getConfig("blocksize");
}else{
    $blocksize = XT::getParam('blocksize');
}

if(!is_array($errormessage)){
    $rooms = XT::getParam('rooms');
    $ifaceday = XT::getParam("day");
    if(is_numeric($ifaceday)){
        $daterange=getDateRange(TIME + ($ifaceday * 86400),"day");
    }else {
        $daterange=getDateRange(XT::getSessionValue("date"),"day");
    }
    // Set Range 
    $daterange[1]=$daterange[0] + $endtime;
    $daterange[0]=$daterange[0] + $starttime;
    
    // build timeshema with bloxksize, starttime, endtime
    $i = $daterange[0];
    while ($i <= $daterange[1]) {
        $timeshema[]['date'] = $i;
        $i = $i + $blocksize;
    }
    $roomarr = explode(",",$rooms);
    foreach ($timeshema as $key => $val) {
        foreach ($roomarr as $value) {
            $timeshema[$key]['room'][$value]['booked']=0;
        }
        if($timeshema[$key]['date'] < TIME && ($timeshema[$key]['date'] + $blocksize) > TIME ){
            $timeshema[$key]['actual_block'] = 1;
        }
    }
    
    // Get data for range and room
$result = XT::query("
    SELECT usr.username, 
           usr.firstName,
           usr.lastName,
           usr.street,
           usr.plz,
           usr.city,
           usr.email,
           usr.tel,
           usr.facsimile,
           usr.lang,
           usr.description,
           usr.image,
           usr.image_version,
    book.* FROM
        " . $GLOBALS['plugin']->getTable("bookings") . " as book
    LEFT JOIN 
        " . XT::gettable("user") . " as usr on(book.creation_user = usr.id)
    WHERE
        book.room_id in ( " . $rooms . ")
    AND
        book.date_from >= " . $daterange[0] . "
    AND 
        book.date_from <= " . $daterange[1] . " ORDER by book.date_from asc"      
,__FILE__,__LINE__);

while($row = $result->FetchRow()){
        $booking[$row['room_id']][] = $row;
        foreach ($timeshema as $key => $value){
             if($row['date_to'] > $value['date'] && $row['date_from'] < ($value['date'] + $blocksize)){
                 $timeshema[$key]['room'][$row['room_id']]['booked']++;
                 $timeshema[$key]['room'][$row['room_id']]['data'] = $row;
             }
        }
}

    
    // Fetch content
    if($GLOBALS['plugin']->getParam("style") != ""){
        $style = $GLOBALS['plugin']->getParam("style");
    }else{
        $style = "default.tpl";
    }
    XT::assign("LABELS",explode(",",XT::getParam("labels")));
    XT::assign("TIMESHEMA",$timeshema);
    XT::assign("BLOCKSIZE",$blocksize);
    XT::assign("DIPLAYDATE",$daterange[0]);
    XT::assign("NAME",$_REQUEST["name"]);
    
    $content = XT::build($style);
}else {
    foreach ($errormessage as $value) {
        $content .=	XT::translate($value) . "<br />";
    }
}
?>