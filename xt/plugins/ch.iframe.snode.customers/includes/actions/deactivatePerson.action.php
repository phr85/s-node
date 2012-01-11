<?php

XT::query("
    UPDATE 
        " . $GLOBALS['plugin']->getTable("customers_persons") . " 
    SET 
        active = 0
    WHERE
        id = " . $GLOBALS['plugin']->getValue("person_id") . "
    ",__FILE__,__LINE__);

?>
