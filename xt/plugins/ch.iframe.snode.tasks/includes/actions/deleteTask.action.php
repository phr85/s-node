<?php

/**
 * deleteTask
 *
 * @package S-Node
 * @subpackage Tasks
 * @author Roger Dudler <rdudler@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: deleteTask.action.php 1066 2005-07-19 13:27:58Z vzaech $
 */


/**
 * Deletes a task
 */

    // Deleting of tasks only allowed for the creator
    XT::query("
        DELETE FROM
            " . $GLOBALS['plugin']->getTable("tasks") . "
        WHERE
            id = " . $GLOBALS['plugin']->getValue("id") . " AND
            creation_user = " . XT::getUserID() . "
        ");

?>
