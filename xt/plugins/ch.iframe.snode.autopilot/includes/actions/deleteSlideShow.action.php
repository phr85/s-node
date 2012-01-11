<?php
// Get the maxpos
XT::query("
    DELETE FROM " . $GLOBALS['plugin']->getTable("autopilot_data") . "
    WHERE id= " . XT::getSessionValue("slide_id")
 ,__FILE__,__LINE__);

XT::query("
    DELETE FROM " . $GLOBALS['plugin']->getTable("autopilot") . "
    WHERE id= " . XT::getSessionValue("slide_id")
 ,__FILE__,__LINE__);

$GLOBALS['plugin']->setAdminModule('o');


?>