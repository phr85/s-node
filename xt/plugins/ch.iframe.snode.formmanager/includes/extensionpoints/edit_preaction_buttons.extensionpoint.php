<?php
function xt_ch_iframe_snode_formmanager_contribute_edit_preaction_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'edit_preaction_buttons',$args[2],$args[3],$args[4],$args[5]);
}

function xt_ch_iframe_snode_formmanager_build_edit_preaction_buttons(){
    XT::assign("EDIT_PREACTION_BUTTONS", $GLOBALS['plugin']->getButtons('edit_preaction_buttons'));
}

?>
