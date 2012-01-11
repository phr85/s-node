<?php
XT::call('saveQuestion');
// Insert a new question
$now = time();
XT::query("INSERT INTO " . XT::getTable('assessment_answers') . " (creation_date,creation_user, position,description,question_id) VALUES (" . $now . "," . XT::getUserID() . ",0,'" . XT::translate("New answer") . "'," . XT::getValue("question_id") . ")",__FILE__,__LINE__);

// Set the view to edit question
XT::setAdminModule("eq");
?>