<?php
XT::call('saveAssessment');
// Insert a new question
$now = time();
XT::query("INSERT INTO " . XT::getTable('assessment_solutions') . " (creation_date,creation_user,title,assessment_id) VALUES (" . $now . "," . XT::getUserID() . ",'" . XT::translate("New solution") . "'," . XT::getValue("id") . ")",__FILE__,__LINE__);
?>