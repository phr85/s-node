<?php

XT::query("
    DELETE FROM 
        " . $GLOBALS['plugin']->getTable("customers_persons") . " 
    WHERE
        id = " . $GLOBALS['plugin']->getValue("person_id") . "
    ",__FILE__,__LINE__);

?>
