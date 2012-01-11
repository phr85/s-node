<?php
XT::call('saveAssessment');
// Insert a new question
$now = time();
XT::query("INSERT INTO " . XT::getTable('assessment_questions') . " (creation_date,creation_user, position,title,assessment_id) VALUES (" . $now . "," . XT::getUserID() . ",0,'" . XT::translate("New question") . "'," . XT::getValue("id") . ")",__FILE__,__LINE__);

// Get the newest id
$result_assessment_question = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('assessment_questions') .  "
    WHERE
	creation_date=" . $now . "
    ",__FILE__,__LINE__);
$row_assessment_questions = $result_assessment_question->fetchRow();
XT::setValue("question_id",$row_assessment_questions['id']);

// Set the view to edit question
XT::setAdminModule("eq");
?>