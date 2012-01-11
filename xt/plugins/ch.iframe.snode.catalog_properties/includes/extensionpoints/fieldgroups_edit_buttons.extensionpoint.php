<?php
function xt_ch_iframe_snode_catalog_properties_contribute_fieldgroups_edit_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'fieldgroups_edit',$args[2],$args[3],$args[4],$args[5]);
}

/**
 * Assigns buttons to the button bar in the edit tab
 */
function xt_ch_iframe_snode_catalog_properties_build_fieldgroups_edit_buttons(){
    XT::assign("FIELDGROUPS_EDIT_BUTTONS", $GLOBALS['plugin']->getButtons('fieldgroups_edit'));
}

?>
