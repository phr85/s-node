<?php

switch($GLOBALS['plugin']->getValue("position")){
    
    case 'up':
        
        XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("forms_elements_values") .  " 
            SET 
                pos = pos - 1 
            WHERE 
                pos = " . $GLOBALS['plugin']->getValue("move_position") . " 
                AND element_id = " . $GLOBALS['plugin']->getSessionValue("element_id")
            ,__FILE__,__LINE__);
            
        XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("forms_elements_values") .  " 
            SET 
                pos = pos + 1 
            WHERE 
                pos = (" . $GLOBALS['plugin']->getValue("move_position") . " - 1) 
                AND id != " . $GLOBALS['plugin']->getValue("value_id") . " 
                AND element_id = " . $GLOBALS['plugin']->getSessionValue("element_id")
            ,__FILE__,__LINE__);
        
        break;
        
    case 'down':
        
        XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("forms_elements_values") .  " 
            SET 
                pos = pos + 1 
            WHERE 
                pos = " . $GLOBALS['plugin']->getValue("move_position") . " 
                AND element_id = " . $GLOBALS['plugin']->getSessionValue("element_id")
            ,__FILE__,__LINE__);
        XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("forms_elements_values") .  " 
            SET 
                pos = pos - 1 
            WHERE 
                pos = (" . $GLOBALS['plugin']->getValue("move_position") . " + 1) 
                AND id != " . $GLOBALS['plugin']->getValue("value_id") . " 
                AND element_id = " . $GLOBALS['plugin']->getSessionValue("element_id")
            ,__FILE__,__LINE__);
            
        break;
        
}

$GLOBALS['plugin']->setAdminModule("ee");

?>
