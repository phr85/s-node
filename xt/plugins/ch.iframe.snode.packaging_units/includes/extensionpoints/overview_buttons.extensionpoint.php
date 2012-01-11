<?php

/**
 * Overview buttons extension point
 *
 * @package S-Node
  * @subpackage units
 * @author Veith Zaech <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: overview_buttons.extensionpoint.php 1066 2005-07-19 13:27:58Z vzaech $
 */

/**
 * Contributes a button to the top button bar in the overview tab
 *
 * @param string label for the button
 * @param string action that should be called when the button is pressed
 */
function xt_ch_iframe_snode_packaging_units_contribute_overview_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'overview',$args[2],$args[3],$args[4],$args[5]);
}

/**
 * Assigns buttons to the button bar in the overview tab
 */
function xt_ch_iframe_snode_packaging_units_build_overview_buttons(){
    XT::assign("OVERVIEW_BUTTONS", $GLOBALS['plugin']->getButtons('overview'));
}

?>
