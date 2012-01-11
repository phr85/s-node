<?php

/**
 * Create project buttons extension point
 *
 * @package S-Node
 * @subpackage Projects
 * @author Roger Dudler <rdudler@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: createButtons.extensionpoint.php 1066 2005-07-19 13:27:58Z vzaech $
 */

/**
 * Contributes a button to the top button bar in the create project tab
 *
 * @param string label for the button
 * @param string action that should be called when the button is pressed
 */
function xt_ch_iframe_snode_projects_contribute_createButtons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'createButtons',$args[2],$args[3],$args[4],$args[5]);
}

/**
 * Assigns buttons to the button bar in the create project tab
 */
function xt_ch_iframe_snode_projects_build_createButtons(){
    XT::assign("CREATE_BUTTONS", $GLOBALS['plugin']->getButtons('createButtons'));
}

?>
