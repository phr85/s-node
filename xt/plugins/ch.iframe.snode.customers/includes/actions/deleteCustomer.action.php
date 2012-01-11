<?php

XT::query("
    DELETE FROM 
        " . $GLOBALS['plugin']->getTable("customers") . " 
    WHERE
        id = " . $GLOBALS['plugin']->getValue("customer_id") . "
    ",__FILE__,__LINE__);

XT::query("
    DELETE FROM 
        " . $GLOBALS['plugin']->getTable("customers_persons") . " 
    WHERE
        customer_id = " . $GLOBALS['plugin']->getValue("customer_id") . "
    ",__FILE__,__LINE__);

?>
