<?php
function xt_ch_iframe_snode_hr_contribute_edit_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1], "edit_buttons", $args[2],$args[3],$args[4]);
}
function xt_ch_iframe_snode_hr_build_edit_buttons(){
    XT::assign("EDIT_BUTTONS", $GLOBALS['plugin']->getButtons("edit_buttons"));
}

?>