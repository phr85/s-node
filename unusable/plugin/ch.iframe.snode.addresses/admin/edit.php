<?php

if($GLOBALS['plugin']->getValue("address_id") != ''){
    $GLOBALS['plugin']->setSessionValue("address_id", $GLOBALS['plugin']->getValue("address_id"));
}

// Add buttons
XT::addImageButton('<u>S</u>ave','save','default','disk_blue.png','1','master','s');
XT::addImageButton('Save and <u>e</u>xit','saveAndClose','default','save_close.png','1','master','e');
XT::addImageButton('E<u>x</u>it','exit','default','exit.png','1','master','x');

$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("addresses") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("address_id") . "
    ",__FILE__,__LINE__);

$data = XT::getQueryData($result);


$row = $result->fetchRow();

// timer
$time['type']=$row['display_time_type'];

for ($i=0;$i<24;$i++){
    if($i == date('H',$row['display_time_start'])){
        $time['shour'][$i]=true;
    }else{
        $time['shour'][$i]=false;
    }
    if($i == date('H',$row['display_time_end'])){
        $time['ehour'][$i]=true;
    }else{
        $time['ehour'][$i]=false;
    }
}

for ($i=0;$i<60;$i= $i+5){
    if($i == intval(date('i',$row['display_time_start']))){
        $time['smin'][$i]=true;
    }else{
        $time['smin'][$i]=false;
    }
    if($i == intval(date('i',$row['display_time_end']))){
        $time['emin'][$i]=true;
    }else{
        $time['emin'][$i]=false;
    }
}

switch ($row['display_time_type']) {
    case 0:
        $time['sdate']=0;
        $time['sdate_str']=0;
        $time['edate']=0;
        $time['edate_str']=0;
        break;
    case 1:
        $time['sdate']= $row['display_time_start'] > 0 ? $row['display_time_start'] : time();
        $time['sdate_str']=$row['display_time_start'] > 0 ? date('d.m.Y',$row['display_time_start']) : date('d.m.Y', time());
        $time['edate']=0;
        $time['edate_str']=0;
        break;
    case 2:
        $time['sdate']= 0;
        $time['sdate_str']=0;
        $time['edate']= $row['display_time_end'] > 0 ? $row['display_time_end'] : time();
        $time['edate_str']=$row['display_time_end'] > 0 ? date('d.m.Y',$row['display_time_end']) : date('d.m.Y', (time() + 86400));
        break;
    case 3:
        $time['sdate']= $row['display_time_start'] > 0 ? $row['display_time_start'] : time();
        $time['sdate_str']=$row['display_time_start'] > 0 ? date('d.m.Y',$row['display_time_start']) : date('d.m.Y', time());
        $time['edate']= $row['display_time_end'] > 0 ? $row['display_time_end'] : time();
        $time['edate_str']=$row['display_time_end'] > 0 ? date('d.m.Y',$row['display_time_end']) : date('d.m.Y', (time() + 86400));
        break;
    default:
        $time['sdate']= $row['display_time_start'] > 0 ? $row['display_time_start'] : time();
        $time['sdate_str']=$row['display_time_start'] > 0 ? date('d.m.Y',$row['display_time_start']) : date('d.m.Y', time());
        $time['edate']= $row['display_time_end'] > 0 ? $row['display_time_end'] : time();
        $time['edate_str']=$row['display_time_end'] > 0 ? date('d.m.Y',$row['display_time_end']) : date('d.m.Y', (time() + 86400));

        break;
}


XT::assign('TIME',$time);
XT::assign('DATE_PICKER_TPL',305);
// <-timer


XT::assign("ADDRESS", $data[0]);

// Get company list
$result = XT::query("
    SELECT
        title,
        id
    FROM
        " . $GLOBALS['plugin']->getTable("addresses") . "
    WHERE
        type = 1
    ORDER BY
        title ASC
",__FILE__,__LINE__);

$organizations = array();
while($row = $result->FetchRow()){
    $organizations[] = $row;
}
XT::assign("ORGANIZATIONS", $organizations);

// Get departments list
$result = XT::query("
    SELECT
        title,
        id
    FROM
        " . $GLOBALS['plugin']->getTable("addresses") . "
    WHERE
        type = 2 AND
        organization = " . $data[0]['organization'] . "
    ORDER BY
        title ASC
",__FILE__,__LINE__);

$departments = array();
while($row = $result->FetchRow()){
    $departments[] = $row;
}
XT::assign("DEPARTMENTS", $departments);

// Get countries
$result = XT::query("
    SELECT
        country,
        name
    FROM 
        " . XT::getTable('countries') . "
    ORDER BY
        name ASC
",__FILE__,__LINE__);

XT::assign("COUNTRIES",XT::getQueryData($result));

// Get regions
$result = XT::query("
    SELECT
        region,
        name
    FROM 
        " . XT::getTable('countries_regions') . "
    WHERE
        country = '" . $data[0]['country'] . "'
    ORDER BY
        name ASC
",__FILE__,__LINE__);

XT::assign("REGIONS",XT::getQueryData($result));

$content = XT::build('edit.tpl');

?>