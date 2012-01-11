<?php

/**
 * createTaskConfirm
 *
 * @package S-Node
 * @subpackage Tasks
 * @author Roger Dudler <rdudler@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: createTaskConfirm.action.php 1066 2005-07-19 13:27:58Z vzaech $
 */


/**
 * Jumps to create task tab in the administration
 */

// If subject is empty display error
if($GLOBALS['plugin']->getValue("title") == ''){
    XT::log("Please fill in a subject for this task",__FILE__,__LINE__,XT_ERROR);
}

// If receiver is empty display error
if($GLOBALS['plugin']->getValue("receiver") == ''){
    XT::log("Please choose a receiver for this task",__FILE__,__LINE__,XT_ERROR);
}

// Build deadline timestamp
$minute = $GLOBALS['plugin']->getValue("minute");
$hour = $GLOBALS['plugin']->getValue("hour");
$day = $GLOBALS['plugin']->getValue("day");
$month = $GLOBALS['plugin']->getValue("month");
$year = $GLOBALS['plugin']->getValue("year");
$deadline = mktime($hour,$minute,0,$month,$day,$year);

// Calculate max duration time
$max_duration = $GLOBALS['plugin']->getValue("max_duration") * $GLOBALS['plugin']->getValue("max_duration_mode");

if(!XT::hasErrors()){

    // Get receivers id
    $result = XT::query("
        SELECT
            id
        FROM
            " . $GLOBALS['plugin']->getTable("user") . "
        WHERE
            username = '" . $GLOBALS['plugin']->getValue("receiver") . "'
        LIMIT
            1
        ");

    while($row = $result->FetchRow()){

        // If there were no errors, continue creating new task
        XT::query("
        INSERT INTO " . $GLOBALS['plugin']->getTable("tasks") . " (
            sender,
            receiver,
            title,
            text,
            priority,
            deadline,
            max_duration,
            creation_date,
            creation_user,
            mod_date,
            mod_user
        ) VALUES (
            " . XT::getUserID() . ",
            " . $row['id'] . ",
            '" . $GLOBALS['plugin']->getValue("title") . "',
            '" . $GLOBALS['plugin']->getValue("text") . "',
            '" . $GLOBALS['plugin']->getValue("priority") . "',
            " . $deadline . ",
            " . $max_duration . ",
            " . time() . ",
            " . XT::getUserID() . ",
            " . time() . ",
            " . XT::getUserID() . "
        )
        ",__FILE__,__LINE__);

        // if all is ok jump to overview
        $GLOBALS['plugin']->setAdminModule('o');

        return;
    }

    XT::log("Receiver doesn't exist. Please choose another one.",__FILE__,__LINE__,XT_ERROR);

}

// if there are errors jump to create task tab
$GLOBALS['plugin']->setAdminModule('ct');

?>