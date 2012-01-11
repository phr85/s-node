<?php

XT::addButton("Add step", "addStepConfirm", "add_step_buttons");
XT::assign("ADD_STEP_BUTTONS", $GLOBALS['plugin']->getButtons("add_step_buttons"));

// Get phases
$result = XT::query("
    SELECT
        title,
        phase_id,
        position
    FROM
        " . $GLOBALS['plugin']->getTable("workflows_phases") . "
    WHERE
        workflow_id = " . $GLOBALS['plugin']->getSessionValue("id") . "
    ORDER BY
        position ASC
    ");

XT::assign("PHASES", XT::getQueryData($result));
XT::assign("ACTIVE_PHASE", $GLOBALS['plugin']->getSessionValue("phase_id"));

$content = XT::build("addStep.tpl");

?>
