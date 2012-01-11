<?php

switch($GLOBALS['plugin']->getValue("position")){
    
    case 'up':
        
        XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("areas") .  " 
            SET 
                pos = pos - 1 
            WHERE 
                pos = " . $GLOBALS['plugin']->getValue("move_position")
            ,__FILE__,__LINE__);
            
        XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("areas") .  " 
            SET 
                pos = pos + 1 
            WHERE 
                pos = (" . $GLOBALS['plugin']->getValue("move_position") . " - 1) 
                AND id != " . $GLOBALS['plugin']->getValue("id")
            ,__FILE__,__LINE__);
        
        break;
        
    case 'down':
        
        XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("areas") .  " 
            SET 
                pos = pos + 1 
            WHERE 
                pos = " . $GLOBALS['plugin']->getValue("move_position")
            ,__FILE__,__LINE__);
        XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("areas") .  " 
            SET 
                pos = pos - 1 
            WHERE 
                pos = (" . $GLOBALS['plugin']->getValue("move_position") . " + 1) 
                AND id != " . $GLOBALS['plugin']->getValue("id")
            ,__FILE__,__LINE__);
            
        break;
        
}

$GLOBALS['plugin']->setAdminModule("o");

?>
