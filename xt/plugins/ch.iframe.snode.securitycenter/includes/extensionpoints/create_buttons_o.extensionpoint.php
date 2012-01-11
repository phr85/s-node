<?php
function xt_ch_iframe_snode_securitycenter_contribute_create_buttons_o(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'overview_create',$args[2],$args[3],$args[4],$args[5]);
}
function xt_ch_iframe_snode_securitycenter_build_create_buttons_o(){
    XT::assign("OVERVIEW_CREATE_BUTTONS", $GLOBALS['plugin']->getButtons('overview_create'));
}

?>
