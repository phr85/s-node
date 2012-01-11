<?php

// get parameters
unset($errormessage);
if(XT::getValue('room_id') == ""){
    $errormessage[] = "room not defined";
}

if(XT::getValue('blocksize') == ""){
    $blocksize = XT::getConfig("blocksize");
}else{
    $blocksize = XT::getValue('blocksize');
}
if(XT::getParam('blocksize') != ""){
    $blocksize = XT::getParam('blocksize');
}


if(XT::getValue("day") > 0){
    XT::setValue("starttime",mktime(XT::getValue("hstart"),XT::getValue("mstart"),0,XT::getValue("month"),XT::getValue("day"),XT::getValue("year")));
    XT::setValue("endtime",mktime(XT::getValue("hend"),XT::getValue("mend"),0,XT::getValue("month"),XT::getValue("day"),XT::getValue("year")));
}


if(XT::getValue("action")=="goToToday"){
    XT::setValue("starttime",TIME);
    XT::setSessionValue("date",TIME);
}

if(XT::getValue('starttime') == ""){
    $errormessage[] = "starttime not defined";
}else {
    $starttime = XT::getValue('starttime');
    $timedata['date_from']=$starttime;
    
    if (XT::getValue("endtime") > 0 && XT::getValue("endtime") > XT::getValue("starttime")){
        $timedata['date_to'] = XT::getValue("endtime");
    }else {
    $timedata['date_to']=$starttime + $blocksize;	
    }
}






if(!is_array($errormessage)){
    $room = XT::getValue('room_id');

    // Get username for default title
    if(XT::getValue("title")==""){
        XT::assign("TITLE",XT::getUSername());
    }else{
        XT::assign("TITLE",XT::getValue("title"));
    }
    XT::assign("COMMENT",XT::getValue("comment"));





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
    
    for ($i=0;$i<60;$i= $i+($blocksize/60)){
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
    XT::assign("DATECOLLISION",XT::getValue("DATECOLLISION"));

    XT::assign("booking_added",XT::getValue("booking_added"));
    XT::assign("ROOMID",$room);
    XT::assign("day",date("d",$timedata['date_from']));
    XT::assign("month",date("m",$timedata['date_from']));
    XT::assign("year",date("y",$timedata['date_from']));

    // Fetch content
    if($GLOBALS['plugin']->getParam("style") != ""){
        $style = $GLOBALS['plugin']->getParam("style");
    }else{
        $style = "default.tpl";
    }
    $content = XT::build($style);
}else {
    foreach ($errormessage as $value) {
        $content .=	XT::translate($value) . "<br />";
    }
}
?>