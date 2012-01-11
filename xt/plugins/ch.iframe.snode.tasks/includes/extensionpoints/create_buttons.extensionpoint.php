<?php

function xt_ch_iframe_snode_tasks_contribute_create_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'create_buttons',$args[2]);
}

/**
 * Assigns buttons to the button bar in the create tab
 */
function xt_ch_iframe_snode_tasks_build_create_buttons(){
    XT::assign("CREATE_BUTTONS", $GLOBALS['plugin']->getButtons('create_buttons'));
}

?>