<?php

/**
* addPhaseConfirm
*
* @package S-Node
* @subpackage Workflow
* @author Roger Dudler <rdudler@iframe.ch>
* @copyright Copyright 2005, iframe AG, http://www.iframe.ch
* @version $Id: addPhaseConfirm.action.php 1066 2005-07-19 13:27:58Z vzaech $
*/
if($GLOBALS['plugin']->getValue("title") == ''){
    XT::log("Please fill in a title for the phase",__FILE__,__LINE__,XT_ERROR);
}

if(!XT::hasErrors()){

    $start = '';

    // Position: At the end
    if($GLOBALS['plugin']->getValue("position") == 1){
        $GLOBALS['plugin']->setValue("after",0);

        // Get last position
        $result = XT::query("
            SELECT
                position
            FROM
                " . $GLOBALS['plugin']->getTable("workflows_phases") . "
            WHERE
                workflow_id = " . $GLOBALS['plugin']->getSessionValue("id") . "
            ORDER BY
                position DESC
            LIMIT 1
            ",__FILE__,__LINE__);

        $GLOBALS['plugin']->setValue("after", 0); // if there are no phases, take first position
        while($row = $result->FetchRow()){
            $GLOBALS['plugin']->setValue("after", $row['position']);
        }
    }

    // Position: At the beginning
    if($GLOBALS['plugin']->getValue("position") == 2){
        $GLOBALS['plugin']->setValue("after",0);
        $start = '=';
    }

    // Update positions
    XT::query("
        UPDATE
            " . $GLOBALS['plugin']->getTable("workflows_phases") . "
        SET
            position = position + 1
        WHERE
            position >" . $start . " " . $GLOBALS['plugin']->getValue("after") . "
            AND workflow_id = " . $GLOBALS['plugin']->getSessionValue("id") . "
        ",__FILE__,__LINE__);

    // Insert new phase
    XT::query("
        INSERT INTO
            " . $GLOBALS['plugin']->getTable("workflows_phases") . "
        (
            workflow_id,
            title,
            position
        ) VALUES (
            " . $GLOBALS['plugin']->getSessionValue("id") . ",
            '" . $GLOBALS['plugin']->getValue("title") . "',
            " . ($GLOBALS['plugin']->getValue("after") + 1) . "
        )
        ",__FILE__,__LINE__);

    // Get last inserted phase id
    $result = XT::query("
        SELECT
            phase_id
        FROM
            " . $GLOBALS['plugin']->getTable("workflows_phases") . "
        WHERE
            workflow_id = " . $GLOBALS['plugin']->getSessionValue("id") . "
            AND title = '" . $GLOBALS['plugin']->getValue("title") . "'
        LIMIT 1
        ",__FILE__,__LINE__);

    while($row = $result->FetchRow()){
        $GLOBALS['plugin']->setSessionValue("phase_id", $row['phase_id']);
    }

    $GLOBALS['plugin']->setAdminModule('as');
} else {
    $GLOBALS['plugin']->setAdminModule('ap');
}

?>
