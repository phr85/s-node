<?php

XT::query("
    UPDATE 
        " . $GLOBALS['plugin']->getTable('news') . " 
    SET
        " . $GLOBALS['plugin']->getValue('field') . " = '" . $GLOBALS['plugin']->getValue('value') . "'
    WHERE 
        id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
        
?>
