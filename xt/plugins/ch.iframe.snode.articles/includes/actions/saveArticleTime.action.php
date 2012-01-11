<?php

// Save the time from the news
$GLOBALS['plugin']->setAdminModule('t');
require_once(FUNC_DIR . 'basic.functions.php');
$failure = false;
//CALSTART + CALEND MUESSEN NOCH MIT KALENDER UEBERGEBEN WERDEN!
//if TIMER INTERVAL is disabled, set all fields on NULL
if($GLOBALS['plugin']->getPostValue('timeinterval') == 1){
    $time_active = 0;
    $rep_hstart = '"NULL"';
    $rep_mstart = '"NULL"';
    $rep_hend   = '"NULL"';
    $rep_mend   = '"NULL"';
    $startdate  = '"NULL"';
    $enddate    = '"NULL"';
    $time_start = '"NULL"';
    $time_end   = '"NULL"';
}else{
    //get the starttime
    $addhour = $GLOBALS['plugin']->getPostValue('rep_hstart') * 3600;
    $addminutes = $GLOBALS['plugin']->getPostValue('rep_mstart') * 60;
    $time_start = $addhour + $addminutes + $calstart;
    //get the endtime
    $addhour = $GLOBALS['plugin']->getPostValue('rep_hend') * 3600;
    $addminutes = $GLOBALS['plugin']->getPostValue('rep_mend') * 60;
    $time_end = $addhour + $addminutes + $calend;

    //No date is set or not all fields are set -> set fields on disabled
    if(($time_start < 86400)||($time_end < 86400)){
        $time_active = 0;
        $rep_hstart = '"NULL"';
        $rep_mstart = '"NULL"';
        $rep_hend   = '"NULL"';
        $rep_mend   = '"NULL"';
        XT::log("Active Time Interval disabled - Data is missing! Please make sure to fill out all fields.", __FILE__,__LINE__,XT_WARNING);
        $failure = true;
    }
    //Enddate is higher then startdate -> set fields on disabled
    elseif($time_start > $time_end){
        $time_active = 0;
        $rep_hstart = '"NULL"';
        $rep_mstart = '"NULL"';
        $rep_hend   = '"NULL"';
        $rep_mend   = '"NULL"';
        XT::log("Active Time Interval disabled - Your enddate was higher set then the startdate! Please make sure to give in correct data.", __FILE__,__LINE__,XT_WARNING);
        $failure = true;
    }
}
//if RECURRING EVENT is disabled, set all fields on maxvalue or Zero
if($GLOBALS['plugin']->getPostValue('recurring') == 1){
    $time_r_active = 0;
    $time_r_start     = 'NULL';
    $time_r_end       = 'NULL';
    $wert_months    = 4095;
    $wert_monthdays = 2147483647;
    $wert_weekdays  = 127;
}else{
    $time_r_active = 1;
    //Days of the week
    $wert_weekdays = 127; //maxnumber of binary weekdaydata (means by 127 are all weekdays flagged)
    $weekdaysarray = $GLOBALS['plugin']->getPostValue('time');
    if(!isset($weekdaysarray[0])&&(is_array($weekdaysarray))){
        $wert_weekdays = 0;
        foreach($weekdaysarray as $angaben){
            //set Values on true if they are set
            if($angaben > 0){
                $wert_weekdays = addbit($wert_weekdays,$angaben);
            }
        }
    }
    //Days of the month
    $wert_monthdays = 2147483647; //maxnumber of binary monthdata (means this value are all days flagged)
    $montharray = $GLOBALS['plugin']->getPostValue('timew');
    if(!isset($montharray[0])&&(is_array($montharray))){
        $wert_monthdays = 0;
        foreach($montharray as $angaben){
            //set Values on true if they are set
            if($angaben > 0){
                $wert_monthdays = addbit($wert_monthdays,$angaben);
            }
        }
    }
    //Months of the year
    $wert_months = 4095; //maxnumber of binary yeardata (means this value are all months flagged)
    $monthsarray = $GLOBALS['plugin']->getPostValue('timem');
    if(!isset($monthsarray[0])&&(is_array($monthsarray))){
        $wert_months = 0;
        foreach($monthsarray as $angaben){
            //set Values on true if they are set
            if($angaben > 0){
                $wert_months = addbit($wert_months,$angaben);
            }
        }
    }
    //Starthour/-minute and Endhour/-minute
    $time_r_start = 'NULL';
    $time_r_end   = 'NULL';
    if($GLOBALS['plugin']->getPostValue('timeexact')!= true){
        $addhour2 = $GLOBALS['plugin']->getPostValue('rep_hstart2') * 3600;
        $addminutes2 = $GLOBALS['plugin']->getPostValue('rep_mstart2') * 60;
        $time_r_start = $addhour2 + $addminutes2;
        $Eaddhour2 = $GLOBALS['plugin']->getPostValue('rep_hend2') * 3600;
        $Eaddminutes2 = $GLOBALS['plugin']->getPostValue('rep_mend2') * 60;
        $time_r_end = $Eaddhour2 + $Eaddminutes2;
        if($time_r_start == $time_r_end){
            $time_r_start = 'NULL';
            $time_r_end   = 'NULL';
            XT::log("Recurring Event - Your start and enddate have been set on the same time - time disabled!", __FILE__,__LINE__,XT_WARNING);
            $failure = true;
        }
        elseif($time_r_start > $time_r_end){
            $time_r_start = 'NULL';
            $time_r_end   = 'NULL';
            XT::log("Recurring Event - The startdate is smaller then the enddate - time disabled!", __FILE__,__LINE__,XT_WARNING);
            $failure = true;
        }
    }
}
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('news') . " SET
  time_active = " . $time_active . "
, time_start = " . $time_start . "
, time_end = " . $time_end . "
, time_r_active = " . $time_r_active . "
, time_r_weekdays = " . $wert_weekdays . "
, time_r_months = " . $wert_months . "
, time_r_monthdays = " . $wert_monthdays . "
, time_r_start = " . $time_r_start . "
, time_r_end = " . $time_r_end . "
WHERE id = " . $GLOBALS['plugin']->getSessionValue('id'));

if($failure == false){
    XT::log("Your changes for the timetable were successfully saved.", __FILE__,__LINE__,XT_INFO);
}

?>