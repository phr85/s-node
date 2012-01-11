<?php
function xt_ch_iframe_snode_packaging_units_contribute_edit_relations_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'relations',$args[2],$args[3],$args[4],$args[5]);
}

/**
 * Assigns buttons to the button bar in the edit tab
 */
function xt_ch_iframe_snode_packaging_units_build_edit_relations_buttons(){
    XT::assign("EDIT_RELATIONS_BUTTONS", $GLOBALS['plugin']->getButtons('relations'));
}

?>
