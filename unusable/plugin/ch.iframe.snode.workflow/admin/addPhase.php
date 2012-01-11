<?php

XT::addButton("Add phase", "addPhaseConfirm", "add_phase_buttons");
XT::assign("ADD_PHASE_BUTTONS", $GLOBALS['plugin']->getButtons("add_phase_buttons"));

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

$content = XT::build("addPhase.tpl");

?>
