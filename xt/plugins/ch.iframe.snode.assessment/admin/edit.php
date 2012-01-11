<?php
// Save
XT::addImageButton("Save", "saveAssessment" ,"default","disk_blue.png","0");


// Clear the data array
$data = array();

// Get assessment data
$result_assessment = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('assessment') .  "
    WHERE
	id=" . XT::getValue("id") . "
    ",__FILE__,__LINE__);
$row_assessment = $result_assessment->fetchRow();
$data['assessment'] = $row_assessment;

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
while ($row_assessment_questions = $result_assessment_questions->fetchRow()) {
	$data['questions'][] = $row_assessment_questions;
}
// Question buttons
XT::addImageButton("Save", "saveAssessment" ,"questionList","disk_blue.png","0");
if (XT::getSessionValue("ctrl_add") < 1){
	if (count($data['questions']) > 0) {
		XT::addImageButton("add question", "addQuestion" ,"questionList","document_add.png","0","slave1","0");
	} else {
		XT::addImageButton("add question", "addQuestionFirst" ,"questionList","document_add.png","0","slave1","0");
	}
} else {
	XT::addImageButton("Cancel", "cancel" ,"questionList","cancel.png","0","slave1","0");
}
$data['questionListButtons'] = $GLOBALS['plugin']->getButtons('questionList');

// Get all sollutions for the requested assessment
$result_assessment_solutions = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('assessment_solutions') .  "
    WHERE
	assessment_id=" . XT::getValue("id") . "
	ORDER BY lower_level ASC
    ",__FILE__,__LINE__);
while ($row_assessment_solutions = $result_assessment_solutions->fetchRow()) {
	$data['solutions'][] = $row_assessment_solutions;
}

// Solution buttons
XT::addImageButton("Save", "saveAssessment" ,"solutionList","disk_blue.png","0");
XT::addImageButton("add solution", "addSolution" ,"solutionList","document_chart.png","0","slave1","0");
$data['solutionListButtons'] = $GLOBALS['plugin']->getButtons('solutionList');

// ctrl_add handler
$data['ctrl_add'] = XT::getSessionValue("ctrl_add");

// Assign the whole shit to the template
XT::assign("xt" . XT::getBaseID() . "_admin",$data);

$content = XT::build('edit.tpl');
?>