<?php

function xt_ch_iframe_snode_messages_contribute_view_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'view_buttons',$args[2],$args[3],$args[4]);
}
function xt_ch_iframe_snode_messages_build_view_buttons(){
    XT::assign("VIEW_BUTTONS", $GLOBALS['plugin']->getButtons('view_buttons'));
}

?>
