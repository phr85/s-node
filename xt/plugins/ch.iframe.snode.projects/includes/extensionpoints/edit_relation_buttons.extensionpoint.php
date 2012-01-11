<?php
function xt_ch_iframe_snode_projects_contribute_edit_relation_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'edit_relation_buttons',$args[2],$args[3],$args[4],$args[5]);
}

function xt_ch_iframe_snode_projects_build_edit_relation_buttons(){
    XT::assign("EDIT_RELATION_BUTTONS", $GLOBALS['plugin']->getButtons('edit_relation_buttons'));
}

?>
