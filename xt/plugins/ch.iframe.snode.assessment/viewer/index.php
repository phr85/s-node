<?php

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';
// Parameter :: id
$id = XT::getParam('id') != '' ? XT::getParam('id') : '';
if ($id != "") {
	// Get assessment data
	$result_assessment = XT::query("
	    SELECT
	       *
	    FROM
	        " . XT::getTable('assessment') .  "
	    WHERE
		id=" . $id. "
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
		assessment_id=" . $id . "
		ORDER BY position ASC
	    ",__FILE__,__LINE__);
	$i = 0;
	while ($row_assessment_questions = $result_assessment_questions->fetchRow()) {
		$data['questions'][$i] = $row_assessment_questions;
		// Get all questions for the requested assessment
		$result_assessment_ansewrs = XT::query("
	    SELECT
	       *
	    FROM
	        " . XT::getTable('assessment_answers') .  "
	    WHERE
		question_id=" . $row_assessment_questions['id'] . "
		ORDER BY position ASC
	    ",__FILE__,__LINE__);
		while ($row_assessment_answers = $result_assessment_ansewrs->fetchRow()) {
			$data['questions'][$i]['answers'][] = $row_assessment_answers;
		}
		$i++;	
	}
	// Get all sollutions for the requested assessment
	$result_assessment_solutions = XT::query("
	    SELECT
	       *
	    FROM
	        " . XT::getTable('assessment_solutions') .  "
	    WHERE
		assessment_id=" . $id . "
		ORDER BY lower_level ASC
	    ",__FILE__,__LINE__);
	while ($row_assessment_solutions = $result_assessment_solutions->fetchRow()) {
		$data['solutions'][] = $row_assessment_solutions;
	}
	// Assign the content to the template
	XT::assign("xt" . XT::getBaseID() . "_viewer",$data);
	// build content
	$content = XT::build($style);
} else {
	$content = XT::translate("No id set!");	
}
?>
