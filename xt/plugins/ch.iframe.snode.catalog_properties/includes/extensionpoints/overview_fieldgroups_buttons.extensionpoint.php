<?php
function xt_ch_iframe_snode_catalog_properties_contribute_overview_fieldgroups_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'overview_fieldgroups',$args[2],$args[3],$args[4],$args[5]);
}

/**
 * Assigns buttons to the button bar in the edit tab
 */
function xt_ch_iframe_snode_catalog_properties_build_overview_fieldgroups_buttons(){
    XT::assign("FIELDGROUPS_OVERVIEW_BUTTONS", $GLOBALS['plugin']->getButtons('overview_fieldgroups'));
}

?>
