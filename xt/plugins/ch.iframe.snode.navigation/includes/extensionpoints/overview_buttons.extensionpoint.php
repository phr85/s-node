<?php
function xt_ch_iframe_snode_navigation_contribute_overview_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'overview_buttons',$args[2],$args[3],$args[4],$args[5]);
}

function xt_ch_iframe_snode_navigation_build_overview_buttons(){
    XT::assign("OVERVIEW_BUTTONS", $GLOBALS['plugin']->getButtons('overview_buttons'));
}

?>
