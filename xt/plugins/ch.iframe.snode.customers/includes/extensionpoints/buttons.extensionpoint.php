<?php

/**
 * Overview buttons extension point 
 *
 * @package S-Node
 * @subpackage Customers
 * @author Roger Dudler <rdudler@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: buttons.extensionpoint.php 1066 2005-07-19 13:27:58Z vzaech $
 */

/**
 * Contributes a button to the top button bar in the overview tab
 *
 * @param string label for the button
 * @param string action that should be called when the button is pressed
 */
function xt_ch_iframe_snode_customers_contribute_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],"overview_buttons",$args[2],$args[3],$args[4],$args[5],$args[6],$args[7]);
}

/**
 * Assigns buttons to the button bar in the overview tab
 */
function xt_ch_iframe_snode_customers_build_buttons(){
    XT::assign("OVERVIEW_BUTTONS", $GLOBALS['plugin']->getButtons("overview_buttons"));
}

?>
