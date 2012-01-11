<?php

function xt_ch_iframe_snode_tasks_contribute_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'overview_buttons',$args[2]);
}
function xt_ch_iframe_snode_tasks_build_buttons(){
    XT::assign("OVERVIEW_BUTTONS", $GLOBALS['plugin']->getButtons('overview_buttons'));
}

?>