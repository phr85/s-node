<?php
function xt_ch_iframe_snode_events_contribute_editreg_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'editreg_buttons',$args[2],$args[3],$args[4],$args[5]);
}

function xt_ch_iframe_snode_events_build_editreg_buttons(){
    XT::assign("EDITREG_BUTTONS", $GLOBALS['plugin']->getButtons('editreg_buttons'));
}

?>
