<?php

// timer

if(XT::getValue('sdate_str')!=""){
    $sdate_pre = explode(".",XT::getValue('sdate_str'));
    $sdate = mktime(0,0,0,$sdate_pre[1],$sdate_pre[0],$sdate_pre[2]);
}else{
    $sdate = 'NULL';
}
if($sdate > 0){
    XT::setValue('sdate',mktime(XT::getValue('hstart') ,XT::getValue('mstart'),0,date('m',$sdate),date('d',$sdate),date('y',$sdate)));
}

if(XT::getValue('edate_str')!=""){
    $edate_pre = explode(".",XT::getValue('edate_str'));
    $edate = mktime(0,0,0,$edate_pre[1],$edate_pre[0],$edate_pre[2]);
}else{
    $edate = 'NULL';
}
if ($edate > 0){
    XT::setValue('edate',mktime(XT::getValue('hend') ,XT::getValue('mend'),0,date('m',$edate),date('d',$edate),date('y',$edate)));
}

XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable("banner") . "
    SET
        title = '" . $GLOBALS['plugin']->getValue("title") . "',
        description = '" . $GLOBALS['plugin']->getValue("description") . "',
        link = '" . $GLOBALS['plugin']->getValue("link") . "',
        link_type = '" . $GLOBALS['plugin']->getValue("link_type") . "',
        target = '" . $GLOBALS['plugin']->getValue("target") . "',
        image = '" . $GLOBALS['plugin']->getValue("image") . "',
        code = '" . $GLOBALS['plugin']->getValue("code") . "',
        image_version = '" . $GLOBALS['plugin']->getValue("image_version") . "',
        type = '" . $GLOBALS['plugin']->getValue("type") . "',
        mod_date = '" . time() . "',
        mod_user = '" . XT::getUserID() . "',
        display_time_type ='" . XT::getValue('time_type') . "',
        display_time_start ='" . XT::getValue('sdate') . "',
        display_time_end ='" . XT::getValue('edate') . "',
		width ='" . XT::getValue('bannerwidth') . "',
		height ='" . XT::getValue('bannerheight') . "'
    WHERE id = " . $GLOBALS['plugin']->getSessionValue("banner_id") . "
",__FILE__,__LINE__);

// Get zone rel infos
$result = XT::query("SELECT views, clicks, zone_id FROM " . $GLOBALS['plugin']->getTable("banner_zones_rel") . " WHERE banner_id = " . $GLOBALS['plugin']->getSessionValue("banner_id") . "",__FILE__,__LINE__);

$zone = array();
while($row = $result->FetchRow()){
    $zone[$row['zone_id']] = $row;
}

// Update zone links
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("banner_zones_rel") . " WHERE banner_id = " . $GLOBALS['plugin']->getSessionValue("banner_id") . "",__FILE__,__LINE__);

if(is_array($GLOBALS['plugin']->getValue("zones"))){
    foreach($GLOBALS['plugin']->getValue("zones") as $key => $value){
        if($value == 1){
            XT::query("
                INSERT INTO
                    " . $GLOBALS['plugin']->getTable("banner_zones_rel") . "
                (
                    zone_id,
                    banner_id,
                    views,
                    clicks
                ) VALUES (
                    " . $key . ",
                    " . $GLOBALS['plugin']->getSessionValue("banner_id") . ",
                    '" . $zone[$key]['views'] . "',
                    '" . $zone[$key]['clicks'] . "'
                )
            ",__FILE__,__LINE__);
        }
    }
}

$GLOBALS['plugin']->setAdminModule("eb");

?>
