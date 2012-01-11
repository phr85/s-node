<?php

XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("banner_zones") . " WHERE id = " . $GLOBALS['plugin']->getValue("zone_id") . "",__FILE__,__LINE__);
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("banner_zones_rel") . " WHERE zone_id = " . $GLOBALS['plugin']->getValue("zone_id") . "",__FILE__,__LINE__);



?>
