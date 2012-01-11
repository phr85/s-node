<?php
if($GLOBALS['ajaxmode']){
    XT::axParam("ax_interface1");
}
// get parameters
unset($errormessage);
if(XT::getParam('room') == ""){
    $errormessage[] = "room is not defined";
}
$room = XT::getParam('room');
if(!is_numeric($room) && !is_int($room)){
    $errormessage[] = "incorrect room definition";
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
    $endtime = $endtime + 604800;
}

if(XT::getParam('blocksize') == ""){
    $blocksize = XT::getConfig("blocksize");
}else{
    $blocksize = XT::getParam('blocksize');
}

if(!is_array($errormessage)){
    $ifaceweek = XT::getParam("week");
    if(is_numeric($ifaceweek)){
        $daterange=getDateRange(TIME + ($ifaceweek * 604800),"week");
    }else {
        $daterange=getDateRange(TIME,"week");
    }
    // Set Range
    //$daterange[1]=$daterange[1] + $endtime;
    $timerangeend =$daterange[0] + $endtime;
    $daterange[0]=$daterange[0] + $starttime;

    // build timeshema with bloxksize, starttime, endtime
    $i = $daterange[0];
    while ($i <= $timerangeend) {
        $timeshema[]['date'] = $i;
        $i = $i + $blocksize;
    }

    foreach ($timeshema as $key => $val) {
        $timeshema[$key]['day'][1]['booked']=0;
        $timeshema[$key]['day'][1]['date'] = $val['date'];
        $timeshema[$key]['day'][1]['label'] = "mo";
        $timeshema[$key]['day'][2]['booked']=0;
        $timeshema[$key]['day'][2]['date'] = $val['date'] + 86400;
        $timeshema[$key]['day'][2]['label'] = "di";
        $timeshema[$key]['day'][3]['booked']=0;
        $timeshema[$key]['day'][3]['date']=$val['date'] + 172800;
        $timeshema[$key]['day'][3]['label'] = "mi";
        $timeshema[$key]['day'][4]['booked']=0;
        $timeshema[$key]['day'][4]['date']=$val['date'] + 259200;
        $timeshema[$key]['day'][4]['label'] = "do";
        $timeshema[$key]['day'][5]['booked']=0;
        $timeshema[$key]['day'][5]['date']=$val['date'] + 345600;
        $timeshema[$key]['day'][5]['label'] = "fr";
        $timeshema[$key]['day'][6]['booked']=0;
        $timeshema[$key]['day'][6]['date']=$val['date'] + 432000;
        $timeshema[$key]['day'][6]['label'] = "sa";
        $timeshema[$key]['day'][7]['booked']=0;
        $timeshema[$key]['day'][7]['date']=$val['date'] + 518400;
        $timeshema[$key]['day'][7]['label'] = "so";
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
        book.room_id = " . $room . "
    AND
        book.date_from >= " . $daterange[0] . "
    AND 
        book.date_from <= " . $daterange[1] . " ORDER by book.date_from asc"      
    ,__FILE__,__LINE__);

    while($row = $result->FetchRow()){
        $booking[$row['room_id']][] = $row;
        foreach ($timeshema as $key => $value){
            for($i=1;$i < 8;$i++){
                if($row['date_to'] > $value['day'][$i]['date'] && $row['date_from'] < ($value['day'][$i]['date'] + $blocksize)){
                    if(date("w",$row['date_from'])>0){
                        $timeshema[$key]['day'][date("w",$row['date_from'])]['booked']++;
                        $timeshema[$key]['day'][date("w",$row['date_from'])]['data'] = $row;
                    }else {
                        $timeshema[$key]['day'][7]['booked']++;
                        $timeshema[$key]['day'][7]['data'] = $row;
                    }
                }
            }

        }
    }


    // Fetch content
    if($GLOBALS['plugin']->getParam("style") != ""){
        $style = $GLOBALS['plugin']->getParam("style");
    }else{
        $style = "default.tpl";
    }

    for($i=1;$i<8;$i++){
        $week[$i]['day']=$i;
    }

    XT::assign("WEEK",$week);
    XT::assign("LABEL",XT::getParam("label"));
    XT::assign("TIMESHEMA",$timeshema);
    XT::assign("BLOCKSIZE",$blocksize);
    XT::assign("DIPLAYDATE",$daterange);
    XT::assign("NAME",$_REQUEST["name"]);
    XT::assign("ROOMID",$room);

    $content = XT::build($style);
}else {
    foreach ($errormessage as $value) {
        $content .=	XT::translate($value) . "<br />";
    }
}
?>