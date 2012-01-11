<?php
function xt_ch_iframe_snode_formmanager_contribute_edit_form_elements_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'edit_form_elements_buttons',$args[2],$args[3],$args[4],$args[5]);
}

function xt_ch_iframe_snode_formmanager_build_edit_form_elements_buttons(){
    XT::assign("EDIT_FORM_ELEMENTS_BUTTONS", $GLOBALS['plugin']->getButtons('edit_form_elements_buttons'));
}

?>
