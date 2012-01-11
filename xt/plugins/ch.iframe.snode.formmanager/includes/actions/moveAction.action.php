<?php

switch($GLOBALS['plugin']->getValue("position")){
    
    case 'up':
        
        XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("forms_actions") .  " 
            SET 
                pos = pos - 1 
            WHERE 
                pos = " . $GLOBALS['plugin']->getValue("move_position") . " 
                AND form_id = " . $GLOBALS['plugin']->getSessionValue("form_id")
            ,__FILE__,__LINE__);
            
        XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("forms_actions") .  " 
            SET 
                pos = pos + 1 
            WHERE 
                pos = (" . $GLOBALS['plugin']->getValue("move_position") . " - 1) 
                AND id != " . $GLOBALS['plugin']->getValue("action_id") . " 
                AND form_id = " . $GLOBALS['plugin']->getSessionValue("form_id")
            ,__FILE__,__LINE__);
        
        break;
        
    case 'down':
        
        XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("forms_actions") .  " 
            SET 
                pos = pos + 1 
            WHERE 
                pos = " . $GLOBALS['plugin']->getValue("move_position") . " 
                AND form_id = " . $GLOBALS['plugin']->getSessionValue("form_id")
            ,__FILE__,__LINE__);
        XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("forms_actions") .  " 
            SET 
                pos = pos - 1 
            WHERE 
                pos = (" . $GLOBALS['plugin']->getValue("move_position") . " + 1) 
                AND id != " . $GLOBALS['plugin']->getValue("action_id") . " 
                AND form_id = " . $GLOBALS['plugin']->getSessionValue("form_id")
            ,__FILE__,__LINE__);
            
        break;
        
}

$GLOBALS['plugin']->setAdminModule("ef");

?>
