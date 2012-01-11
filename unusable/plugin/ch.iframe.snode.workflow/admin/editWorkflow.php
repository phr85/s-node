<?php

// Get open id
if($GLOBALS['plugin']->getValue("id") != ''){
    $GLOBALS['plugin']->setSessionValue("id",$GLOBALS['plugin']->getValue("id"));
    $GLOBALS['plugin']->unsetSessionValue("open_step");
}
!is_numeric($GLOBALS['plugin']->getSessionValue("id")) ? $GLOBALS['plugin']->setSessionValue("id",0) : null;

// Get open_step id
$GLOBALS['plugin']->getValue("open_step") != '' ? $GLOBALS['plugin']->setSessionValue("open_step",$GLOBALS['plugin']->getValue("open_step")) : null;
!is_numeric($GLOBALS['plugin']->getSessionValue("open_step")) ? $GLOBALS['plugin']->setSessionValue("open_step",$GLOBALS['plugin']->getSessionValue("id")) : null;
$active = $GLOBALS['plugin']->getSessionValue("open_step");

// Get details about requested workflow
$result = XT::query("
    SELECT
        id,
        title,
        description,
        max_duration
    FROM
        " . $GLOBALS['plugin']->getTable("workflows") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("id") . "
    LIMIT 1
");

$data = array();
while ($row = $result->FetchRow()){
    $data[] = $row;
}
XT::assign("WORKFLOW", $data[0]);

// Empty data array
$data = array();

// Get tree
$result = XT::query("
    SELECT
        main.id,
        main.title,
        phases.title as phase_title,
        main.phase
    FROM
        " . $GLOBALS['plugin']->getTable("workflows") . " AS main,
        " . $GLOBALS['plugin']->getTable("workflows_phases") . " AS phases
    WHERE
        main.workflow_id = " . $GLOBALS['plugin']->getSessionValue("id") . "
        AND main.id != main.workflow_id
        AND phases.phase_id = main.phase
        AND phases.workflow_id = main.workflow_id
        AND main.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    ORDER BY
        main.phase ASC
",__FILE__,__LINE__);

// Fill tree data
while ($row = $result->FetchRow()){
    $data[$row['phase']][] = $row;
}

XT::assign("STEPS", $data);

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

// Get executers for each step
$result = XT::query("
    SELECT
        members1.step_id as step_id,
        members1.executer_id,
        members1.executer_mode,
        user.username as title1,
        groups.title as title2,
        roles.title as title3
    FROM
        " . $GLOBALS['plugin']->getTable("workflows_members") . " AS members1 LEFT JOIN
        " . $GLOBALS['plugin']->getTable("user") . " as user ON (user.id = members1.executer_id),
        " . $GLOBALS['plugin']->getTable("workflows_members") . " AS members2 LEFT JOIN
        " . $GLOBALS['plugin']->getTable("groups") . " as groups ON (groups.id = members2.executer_id),
        " . $GLOBALS['plugin']->getTable("workflows_members") . " AS members3 LEFT JOIN
        " . $GLOBALS['plugin']->getTable("roles") . " as roles ON (roles.id = members3.executer_id)
    WHERE
        members1.workflow_id = " . $GLOBALS['plugin']->getSessionValue("id") . " AND
        members2.workflow_id = " . $GLOBALS['plugin']->getSessionValue("id") . " AND
        members3.workflow_id = " . $GLOBALS['plugin']->getSessionValue("id") . "
    ORDER BY
        members1.executer_mode ASC
",__FILE__,__LINE__);

$data = array();
while ($row = $result->FetchRow()){
    $row['title'] = $row['title' . $row['executer_mode']];
    unset($row['title1']);
    unset($row['title2']);
    unset($row['title3']);
    if(!@in_array($row,$data[$row['step_id']]) && $row['title'] != ''){
        $data[$row['step_id']][] = $row;
    }
}

XT::assign("MEMBERS", $data);

// Create add buttons
XT::addButton("Add phase", "addPhase", "add_elements");
XT::addButton("Add step", "addStep", "add_elements");
XT::assign("ADD_ELEMENTS", $GLOBALS['plugin']->getButtons("add_elements"));

require_once(CLASS_DIR . "workflow.class.php");
$workflow = new XT_Workflow();
//$workflow->start(1);

$content = XT::build("editWorkflow.tpl");

?>
