<?php

/**
 * Contributes an "Create workflow" button
 *
 * @package S-Node
 * @subpackage Workflow
 * @author Roger Dudler <rdudler@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: createWorkflow.o.extension.php 1066 2005-07-19 13:27:58Z vzaech $
 */

$GLOBALS['plugin']->contribute("manage_buttons", "Create workflow", "addWorkflow","","1","master");

?>
