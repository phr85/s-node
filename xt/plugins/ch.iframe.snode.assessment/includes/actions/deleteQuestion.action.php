<?php
XT::call('saveAssessment');
// Delete all answers
XT::query("
    DELETE
    FROM
        " . XT::getTable('assessment_answers') .  "
    WHERE
	question_id=" . XT::getValue("question_id") . "
    ",__FILE__,__LINE__);
    
// Delete finally the question 
XT::query("
    DELETE
    FROM
        " . XT::getTable('assessment_questions') .  "
    WHERE
	id=" . XT::getValue("question_id") . "
    ",__FILE__,__LINE__);
// Get all questions for the requested assessment
$result_assessment_questions = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('assessment_questions') .  "
    WHERE
	assessment_id=" . XT::getValue("id") . "
	ORDER BY position ASC
    ",__FILE__,__LINE__);
$i = 0;
while ($row_assessment_questions = $result_assessment_questions->fetchRow()) {
	// Delete all answers
	XT::query("
    UPDATE
        " . XT::getTable('assessment_questions') .  "
	SET position = " . $i . "
    WHERE
	id=" . $row_assessment_questions['id']. "
	AND assessment_id=" . XT::getValue("id") ."
    ",__FILE__,__LINE__);
    $i++;
}
?>