<?php

// Includes
require_once(FUNC_DIR . 'basic.functions.php');

if(XT::getPermission('add')){
    // Add action buttons
    XT::addButton('Save', 'saveNewsTime');
}

// Set session variables
if(is_numeric($GLOBALS['plugin']->getValue('id'))){
    $GLOBALS['plugin']->setSessionValue("id", $GLOBALS['plugin']->getValue('id'));
}

if(is_numeric($GLOBALS['plugin']->getSessionValue('id'))){

    // Get the news timesettings out of the table
    $result = XT::query("
       SELECT
           time_active,
           time_r_active,
           time_r_months,
           time_r_weekdays,
           time_r_monthdays,
           time_r_start,
           time_r_end
       FROM
           " . $GLOBALS['plugin']->getTable("newsmanager") . "
       WHERE
           id = " . $GLOBALS['plugin']->getSessionValue('id') . "
       ",__FILE__,__LINE__);

    while($row = $result->FetchRow()){

        XT::assign("CHECKED_TIMEINTERVAL", $row['time_active']);
        XT::assign("CHECKED_TIMERECURRING", $row['time_r_active']);

        //Weekdays (Mo-Su)
        if($row['time_r_weekdays'] != 127){
            $time_weekdays = array();
            $time_weekdays[0] = false;
            for($i=1;$i<=7;$i++){
                $time_weekdays[$i] = getbit($row['time_r_weekdays'], $i);
            }
            XT::assign("CHECKED_TIME", $time_weekdays);
        }else{
            $time_weekdays[0] = true;
            XT::assign("CHECKED_TIME", $time_weekdays);
        }

        //Months (Jan-Dec)
        if($row['time_r_months'] != 4095){
            $time_month = array();
            $time_month[0] = false;
            for($i=1;$i<=12;$i++){
                $time_month[$i] = getbit($row['time_r_months'], $i);
            }
            XT::assign("CHECKED_TIMEM", $time_month);
        }else{
            $time_month[0] = true;
            XT::assign("CHECKED_TIMEM", $time_month);
        }

        //Monthdays (1-31)
        if($row['time_r_monthdays'] != 2147483647){
            $time_w = array();
            $time_w[0] = false;
            for($i=1;$i<=31;$i++){
                $time_w[$i] = getbit($row['time_r_monthdays'], $i);
            }
            XT::assign("CHECKED_TIMEW", $time_w);
        }else{
            $time_w[0] = true;
            XT::assign("CHECKED_TIMEW", $time_w);
        }

        //Starttime
        if($row['time_r_start'] != NULL){
            $secondsleft = $row['time_r_start'];
            $anzhours = ($row['time_r_start']/3600);
            if($row['time_r_start']>3600){
                $secondsleft = ($row['time_r_start']%3600);
            }
            $anzhours = (int) $anzhours;
            $anzminutes = ($secondsleft/60);
            $hoursSarray[$anzhours] = true;
            $minutesSarray[$anzminutes] = true;
            XT::assign("CHECKED_R_HOURSTART", $hoursSarray);
            XT::assign("CHECKED_R_MINUTESTART", $minutesSarray);
            XT::assign("CHECKED_TIMEEXACT", false);
        }else{
            XT::assign("CHECKED_TIMEEXACT", true);
        }

        //Endtime
        if($row['time_r_end'] != NULL){
            $Esecondsleft = $row['time_r_end'];
            $Eanzhours = ($row['time_r_end']/3600);
            if($row['time_r_end']>3600){
                $Esecondsleft = ($row['time_r_end']%3600);
            }
            $Eanzhours = (int) $Eanzhours;
            $Eanzminutes = ($Esecondsleft/60);
            $hoursEarray[$Eanzhours] = true;
            $minutesEarray[$Eanzminutes] = true;
            XT::assign("CHECKED_R_HOUREND", $hoursEarray);
            XT::assign("CHECKED_R_MINUTEEND", $minutesEarray);
            XT::assign("CHECKED_TIMEEXACT", false);
        }else{
            XT::assign("CHECKED_TIMEEXACT", true);
        }
    }
    /*
    $datum = getdate();
    $timenow = $datum[hours]*3600;
    $timenow += $datum[minutes]*60;
    $Bmonthday = (pow(2, $datum[mday]-1));
    $Bmonth = (pow(2, $datum[mon]-1));
    $Bweekday = (pow(2, date("w")));

    $result = XT::query("SELECT * FROM " . $GLOBALS['plugin']->getTable("newsmanager") .
    " WHERE (time_active = 0 OR (" . $datum[0] . " > time_start AND " . $datum[0] . " < time_end))" .
    " AND " .
    " (time_r_active = 0 OR " .
    " (time_r_weekdays & " . $Bweekday . " = " . $Bweekday . " AND time_r_monthdays & " . $Bmonthday . " = " . $Bmonthday . " AND time_r_months & " . $Bmonth . " = " . $Bmonth . " AND " .
    "((" . $timenow . " > time_r_start AND " . $timenow . " < time_r_end) OR time_r_start is NULL)))");
    XT::errorCheck(__FILE__,__LINE__);
    while($row = $result->FetchRow()){
        echo $row['title'] . "<br>";
    }
    */
    $content = XT::build('../../includes/time.tpl');

} else{
    $GLOBALS['error']->add("No user ID set!", __FILE__,__LINE__,XT_ERROR);
}
?>