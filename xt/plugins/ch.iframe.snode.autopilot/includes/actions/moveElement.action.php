<?php
if(XT::getValue('direction')=="up"){
    $newpos = XT::getValue('position') - 1;
}else{
    $newpos = XT::getValue('position') + 1;
}

XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable("autopilot_data") . "
        SET position = " . ($newpos + 1000). "
    WHERE
        id= " . XT::getSessionValue("slide_id") . "
    AND
        position = " . XT::getValue('position') ,__FILE__,__LINE__);

XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable("autopilot_data") . "
        SET position = " . (XT::getValue('position') + 1000) . "
    WHERE
        id= " . XT::getSessionValue("slide_id") . "
    AND
        position = " . $newpos ,__FILE__,__LINE__);

XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable("autopilot_data") . "
        SET position = position - 1000
    WHERE
        id= " . XT::getSessionValue("slide_id") . "
    AND
        position > 1000",__FILE__,__LINE__);





?>