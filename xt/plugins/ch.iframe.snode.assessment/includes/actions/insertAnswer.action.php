<?php
XT::call('saveQuestion');
XT::call("cancelAnswer");
switch(XT::getValue("position")){

    case 'before':
        XT::query("
            UPDATE " . XT::getTable("assessment_answers") .  " SET position = position + 1 WHERE question_id = " . XT::getValue("question_id") . " AND position >= " . XT::getValue("insert_position") . "",__FILE__,__LINE__);

        XT::query("
            INSERT INTO
                " . XT::getTable("assessment_answers") .  " (question_id,position,description) VALUES (" . XT::getValue("question_id") . "," . (XT::getValue("insert_position")) . ",'" . XT::translate("New answer") . "')
            ",__FILE__,__LINE__);

        break;

    case 'after':
        XT::query("
            UPDATE " . XT::getTable("assessment_answers") .  " SET position = position + 1 WHERE question_id = " . XT::getValue("question_id") . " AND position > " . XT::getValue("insert_position") . "",__FILE__,__LINE__);

        XT::query("
            INSERT INTO
                " . XT::getTable("assessment_answers") .  " (question_id,position,description) VALUES (" . XT::getValue("question_id") . "," . (XT::getValue("insert_position") + 1) . ",'" . XT::translate("New answer") . "')
            ",__FILE__,__LINE__);

        break;

}

XT::setAdminModule("eq");

?>