<?php

XT::query("
    UPDATE 
        " . $GLOBALS['plugin']->getTable("banner_zones_rel") . " 
    SET 
        active = 0
    WHERE
        banner_id = " . $GLOBALS['plugin']->getValue("banner_id") . " AND
        zone_id = " . $GLOBALS['plugin']->getValue("zone_id") . "
",__FILE__,__LINE__);

$GLOBALS['plugin']->setAdminModule("e");

?>
