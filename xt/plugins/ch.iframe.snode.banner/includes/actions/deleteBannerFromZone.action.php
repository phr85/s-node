<?php

if($GLOBALS['plugin']->getValue("banner_id") > 0){
    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("banner_zones_rel") . " WHERE zone_id = " . $GLOBALS['plugin']->getValue("zone_id") . " AND banner_id = " . $GLOBALS['plugin']->getValue("banner_id") . "",__FILE__,__LINE__);
}

$result = XT::query("SELECT count(*) as cnt FROM " . $GLOBALS['plugin']->getTable("banner_zones_rel") . " WHERE banner_id = " . $GLOBALS['plugin']->getValue("banner_id") . "",__FILE__,__LINE__);
$count = XT::getQueryData($result);

if($count[0]['cnt']==0){
    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("banner") . " WHERE id = " . $GLOBALS['plugin']->getValue("banner_id"),__FILE__,__LINE__) ;
}

$GLOBALS['plugin']->setAdminModule("e");

?>
