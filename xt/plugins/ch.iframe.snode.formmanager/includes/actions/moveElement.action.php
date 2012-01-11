<?php

switch($GLOBALS['plugin']->getValue("position")){
    
    case 'up':
        
        XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("forms_elements") .  " 
            SET 
                pos = pos - 1 
            WHERE 
                form_id = " . $GLOBALS['plugin']->getSessionValue("form_id") . " AND 
                pos = " . $GLOBALS['plugin']->getValue("move_position")
            ,__FILE__,__LINE__);
            
        XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("forms_elements") .  " 
            SET 
                pos = pos + 1 
            WHERE 
                form_id = " . $GLOBALS['plugin']->getSessionValue("form_id") . " AND 
                pos = (" . $GLOBALS['plugin']->getValue("move_position") . " - 1) 
                AND element_id != " . $GLOBALS['plugin']->getValue("element_id")
            ,__FILE__,__LINE__);
        
        break;
        
    case 'down':
        
        XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("forms_elements") .  " 
            SET 
                pos = pos + 1 
            WHERE 
                form_id = " . $GLOBALS['plugin']->getSessionValue("form_id") . " AND 
                pos = " . $GLOBALS['plugin']->getValue("move_position")
            ,__FILE__,__LINE__);
        XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("forms_elements") .  " 
            SET 
                pos = pos - 1 
            WHERE 
                form_id = " . $GLOBALS['plugin']->getSessionValue("form_id") . " AND 
                pos = (" . $GLOBALS['plugin']->getValue("move_position") . " + 1) 
                AND element_id != " . $GLOBALS['plugin']->getValue("element_id")
            ,__FILE__,__LINE__);
            
        break;
        
}

$GLOBALS['plugin']->setAdminModule("ef");

?>
