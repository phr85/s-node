<?php

/**
 * Create workflow buttons extension point
 *
 * @package S-Node
 * @subpackage Workflow
 * @author Roger Dudler <rdudler@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: editWorkflow_buttons.extensionpoint.php 1066 2005-07-19 13:27:58Z vzaech $
 */

/**
 * Contributes a button to the top button bar in the create workflow tab
 *
 * @param string label for the button
 * @param string action that should be called when the button is pressed
 */
function xt_ch_iframe_snode_workflow_contribute_editWorkflow_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1], "create",$args[2],$args[3],$args[4],$args[5]);
}

/**
 * Assigns buttons to the button bar in the create workflow tab
 */
function xt_ch_iframe_snode_workflow_build_editWorkflow_buttons(){
    XT::assign("CREATE_BUTTONS", $GLOBALS['plugin']->getButtons("create"));
}

?>
