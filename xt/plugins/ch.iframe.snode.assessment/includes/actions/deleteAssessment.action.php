<?php
// Get all questions for the requested assessment
$result_assessment_questions = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('assessment_questions') .  "
    WHERE
	assessment_id=" . XT::getValue("id") . "
    ",__FILE__,__LINE__);
while ($row_assessment_questions = $result_assessment_questions->fetchRow()) {
	// Delete all answers
	XT::query("
    DELETE
    FROM
        " . XT::getTable('assessment_answers') .  "
    WHERE
	question_id=" . $row_assessment_questions['id']. "
    ",__FILE__,__LINE__);
}
// Delete all questions
XT::query("
    DELETE
    FROM
        " . XT::getTable('assessment_questions') .  "
    WHERE
	assessment_id=" . XT::getValue("id") . "
    ",__FILE__,__LINE__);
    
// Delete finally the assessment 
XT::query("
    DELETE
    FROM
        " . XT::getTable('assessment') .  "
    WHERE
	id=" . XT::getValue("id") . "
    ",__FILE__,__LINE__);

?>