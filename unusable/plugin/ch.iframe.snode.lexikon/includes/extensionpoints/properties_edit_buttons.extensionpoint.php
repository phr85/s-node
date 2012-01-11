<?php
function xt_ch_iframe_snode_lexikon_contribute_properties_edit_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'properties_edit',$args[2],$args[3],$args[4],$args[5]);
}

/**
 * Assigns buttons to the button bar in the edit tab
 */
function xt_ch_iframe_snode_lexikon_build_properties_edit_buttons(){
    XT::assign("PROPERTIE_EDIT_BUTTONS", $GLOBALS['plugin']->getButtons('properties_edit'));
}

?>
