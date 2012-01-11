<?php
XT::call('saveAssessment');
switch(XT::getValue("position")){
    
    case 'up':
        
        XT::query("
            UPDATE 
                " . XT::getTable("assessment_questions") .  " 
            SET 
                position = position - 1 
            WHERE 
                assessment_id = " . XT::getValue("id") . " AND 
                position = " . XT::getValue("move_position")
            ,__FILE__,__LINE__);
            
        XT::query("
            UPDATE 
                " . XT::getTable("assessment_questions") .  " 
            SET 
                position = position + 1 
            WHERE 
                assessment_id = " . XT::getValue("id") . " AND 
                position = (" . XT::getValue("move_position") . " - 1) 
                AND id != " . XT::getValue("question_id")
            ,__FILE__,__LINE__);
        
        break;
        
    case 'down':
        
        XT::query("
            UPDATE 
                " . XT::getTable("assessment_questions") .  " 
            SET 
                position = position + 1 
            WHERE 
                assessment_id = " . XT::getValue("id") . " AND 
                position = " . XT::getValue("move_position")
            ,__FILE__,__LINE__);
        XT::query("
            UPDATE 
                " . XT::getTable("assessment_questions") .  " 
            SET 
                position = position - 1 
            WHERE 
                assessment_id = " . XT::getValue("id") . " AND 
                position = (" . XT::getValue("move_position") . " + 1) 
                AND id != " . XT::getValue("question_id")
            ,__FILE__,__LINE__);
            
        break;
        
}

XT::setAdminModule("e");

?>
