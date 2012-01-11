<?php
XT::call('saveQuestion');
switch(XT::getValue("position")){
    
    case 'up':
        
        XT::query("
            UPDATE 
                " . XT::getTable("assessment_answers") .  " 
            SET 
                position = position - 1 
            WHERE 
                question_id = " . XT::getValue("question_id") . " AND 
                position = " . XT::getValue("move_position")
            ,__FILE__,__LINE__);
            
        XT::query("
            UPDATE 
                " . XT::getTable("assessment_answers") .  " 
            SET 
                position = position + 1 
            WHERE 
                question_id = " . XT::getValue("question_id") . " AND 
                position = (" . XT::getValue("move_position") . " - 1) 
                AND id != " . XT::getValue("answer_id")
            ,__FILE__,__LINE__);
        
        break;
        
    case 'down':
        
        XT::query("
            UPDATE 
                " . XT::getTable("assessment_answers") .  " 
            SET 
                position = position + 1 
            WHERE 
                question_id = " . XT::getValue("question_id") . " AND 
                position = " . XT::getValue("move_position")
            ,__FILE__,__LINE__);
        XT::query("
            UPDATE 
                " . XT::getTable("assessment_answers") .  " 
            SET 
                position = position - 1 
            WHERE 
                question_id = " . XT::getValue("question_id") . " AND 
                position = (" . XT::getValue("move_position") . " + 1) 
                AND id != " . XT::getValue("answer_id")
            ,__FILE__,__LINE__);
            
        break;
        
}

XT::setAdminModule("eq");

?>
