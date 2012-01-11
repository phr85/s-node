<?php
if(is_numeric($GLOBALS['plugin']->getValue("phase_id"))){

    // Delete steps for this phase
    XT::query("
        DELETE FROM
            " . $GLOBALS['plugin']->getTable("workflows") . "
        WHERE
            workflow_id = " . $GLOBALS['plugin']->getSessionValue("id") . "
            AND phase = " . $GLOBALS['plugin']->getValue("phase_id") . "
        ");

    // Get phase position
    $result = XT::query("
        SELECT
            position
        FROM
            " . $GLOBALS['plugin']->getTable("workflows_phases") . "
        WHERE
            workflow_id = " . $GLOBALS['plugin']->getSessionValue("id") . "
            AND phase_id = " . $GLOBALS['plugin']->getValue("phase_id") . "
        ");

    while($row = $result->FetchRow()){
        $position = $row['position'];
    }

    // Update phase position
    XT::query("
        UPDATE
            " . $GLOBALS['plugin']->getTable("workflows_phases") . "
        SET
            position = position - 1
        WHERE
            position > " . $position . "
        ");

    // Delete phase
    XT::query("
        DELETE FROM
            " . $GLOBALS['plugin']->getTable("workflows_phases") . "
        WHERE
            workflow_id = " . $GLOBALS['plugin']->getSessionValue("id") . "
            AND phase_id = " . $GLOBALS['plugin']->getValue("phase_id") . "
        ");

}

header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['tpl_id']);

?>
