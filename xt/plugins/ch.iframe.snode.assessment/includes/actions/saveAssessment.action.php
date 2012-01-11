<?php

XT::query("UPDATE " . XT::getTable('assessment') . " 
	SET
	mod_user=" . XT::getUserID() . ",
	mod_date=" . time() . ",
	title='" . XT::getValue("title") . "',
	description='" . XT::getValue("description") . "'
	WHERE id=" . XT::getValue("id")  . "
	",__FILE__,__LINE__);

// Get all sollution for the requested assessment
$result_assessment_solutions = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('assessment_solutions') .  "
    WHERE
	assessment_id=" . XT::getValue("id") . "
    ",__FILE__,__LINE__);
while ($row_assessment_solutions = $result_assessment_solutions->fetchRow()) {
	
	XT::query("UPDATE " . XT::getTable('assessment_solutions') . " 
	SET
	mod_user=" . XT::getUserID() . ",
	mod_date=" . time() . ",
	title='" . XT::getValue("solution_title_" . $row_assessment_solutions['id']) . "',
	lower_level='" . XT::getValue("solution_lower_level_" . $row_assessment_solutions['id']) . "',
	upper_level='" . XT::getValue("solution_upper_level_" . $row_assessment_solutions['id']) . "',
	description='" .  XT::getValue("solution_description_" . $row_assessment_solutions['id']) . "'
	WHERE id=" . $row_assessment_solutions['id']  . "
	",__FILE__,__LINE__);
}
// Set the view to edit
XT::setAdminModule("e");
?>