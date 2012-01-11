<?php
function xt_ch_iframe_snode_lexikon_contribute_overview_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'overview',$args[2],$args[3],$args[4],$args[5]);
}

/**
 * Assigns buttons to the button bar in the overview tab
 */
function xt_ch_iframe_snode_lexikon_build_overview_buttons(){
    XT::assign("OVERVIEW_BUTTONS", $GLOBALS['plugin']->getButtons('overview'));
}

?>
