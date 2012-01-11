<?php
XT::call('saveQuestion');
// Delete finally the answer 
XT::query("
    DELETE
    FROM
        " . XT::getTable('assessment_answers') .  "
    WHERE
	id=" . XT::getValue("answer_id") . "
    ",__FILE__,__LINE__);
    // Get all questions for the requested assessment
$result_assessment_answers = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('assessment_answers') .  "
    WHERE
	question_id=" . XT::getValue("question_id") . "
	ORDER BY position ASC
    ",__FILE__,__LINE__);
$i = 0;
while ($row_assessment_answers = $result_assessment_answers->fetchRow()) {
	// Delete all answers
	XT::query("
    UPDATE
        " . XT::getTable('assessment_answers') .  "
	SET position = " . $i . "
    WHERE
	id=" . $row_assessment_answers['id']. "
	AND question_id=" . XT::getValue("question_id") ."
    ",__FILE__,__LINE__);
    $i++;
}
?>
