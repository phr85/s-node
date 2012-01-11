<?php
// Save
XT::addImageButton("Save", "saveQuestion" ,"default","disk_blue.png","0");
// Save
XT::addImageButton("Save and close", "saveQuestionClose" ,"default","save_close.png","0");

// Clear the data array
$data = array();

// Get assessment data
$result_assessment_question = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('assessment_questions') .  "
    WHERE
	id=" . XT::getValue("question_id") . "
    ",__FILE__,__LINE__);
$row_assessment_question = $result_assessment_question->fetchRow();
$data['question'] = $row_assessment_question;

// Get all questions for the requested assessment
$result_assessment_ansewrs = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('assessment_answers') .  "
    WHERE
	question_id=" . XT::getValue("question_id") . "
	ORDER BY position ASC
    ",__FILE__,__LINE__);
while ($row_assessment_answers = $result_assessment_ansewrs->fetchRow()) {
	$data['answers'][] = $row_assessment_answers;
}
// Answers buttons
XT::addImageButton("Save", "saveQuestion" ,"answerList","disk_blue.png","0");
if (XT::getSessionValue("ctrl_add_answer") < 1){
	if (count($data['answers']) > 0) {
		XT::addImageButton("add answer", "addAnswer" ,"answerList","document_add.png","0","slave1","0");
	} else {
		XT::addImageButton("add answer", "addAnswerFirst" ,"answerList","document_add.png","0","slave1","0");
	}
} else {
	XT::addImageButton("Cancel", "cancelAnswer" ,"answerList","cancel.png","0","slave1","0");
}

$data['answerListButtons'] = $GLOBALS['plugin']->getButtons('answerList');

// ctrl_add handler
$data['ctrl_add_answer'] = XT::getSessionValue("ctrl_add_answer");

//assign the assessment id
$data['id'] = XT::getValue("id");

// Assign the whole shit to the template
XT::assign("xt" . XT::getBaseID() . "_admin",$data);

$content = XT::build('editQuestion.tpl');
?>