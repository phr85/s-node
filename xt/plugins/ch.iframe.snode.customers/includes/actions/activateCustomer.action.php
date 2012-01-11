<?php

XT::query("
    UPDATE 
        " . $GLOBALS['plugin']->getTable("customers") . " 
    SET 
        active = 1
    WHERE
        id = " . $GLOBALS['plugin']->getValue("customer_id") . "
    ",__FILE__,__LINE__);

?>
