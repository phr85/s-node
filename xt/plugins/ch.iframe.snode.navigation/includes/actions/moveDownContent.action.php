<?php

XT::query("
        UPDATE 
            " . $GLOBALS['plugin']->getTable("navigation_contents") .  " 
        SET 
            position = position + 1 
        WHERE 
            position = " . $GLOBALS['plugin']->getValue("entry_pos") . "
            AND node_id= " . $GLOBALS['plugin']->getValue("node_id")
        ,__FILE__,__LINE__);
    
XT::query("
        UPDATE 
            " . $GLOBALS['plugin']->getTable("navigation_contents") .  " 
        SET 
            position = position - 1 
        WHERE 
            position = (" . $GLOBALS['plugin']->getValue("entry_pos") . " + 1) 
            AND id != " . $GLOBALS['plugin']->getValue("entry_id") . " 
            AND node_id= " . $GLOBALS['plugin']->getValue("node_id")
            
        ,__FILE__,__LINE__);
        
$GLOBALS['plugin']->call('saveTemplateContent');
?>