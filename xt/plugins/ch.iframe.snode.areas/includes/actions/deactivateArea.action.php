<?php

XT::query("
    UPDATE 
        " . $GLOBALS['plugin']->getTable("areas") . " 
    SET 
        active = 0
    WHERE
        id = " . $GLOBALS['plugin']->getValue("id") . "
    ",__FILE__,__LINE__);

?>
