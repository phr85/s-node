<?php
function xt_ch_iframe_snode_events_contribute_registration_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'registration_buttons',$args[2],$args[3],$args[4],$args[5]);
}

function xt_ch_iframe_snode_events_build_registration_buttons(){
    XT::assign("REGISTRATION_BUTTONS", $GLOBALS['plugin']->getButtons('registration_buttons'));
}

?>
