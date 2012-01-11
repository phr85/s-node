<?php
function xt_ch_iframe_snode_catalog_contribute_edit_node_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'edit_node',$args[2],$args[3],$args[4],$args[5]);
}

/**
 * Assigns buttons to the button bar in the edit tab
 */
function xt_ch_iframe_snode_catalog_build_edit_node_buttons(){
    XT::assign("EDIT_NODE_BUTTONS", $GLOBALS['plugin']->getButtons('edit_node'));
}

?>
