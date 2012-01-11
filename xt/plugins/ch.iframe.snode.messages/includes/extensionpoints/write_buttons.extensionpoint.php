<?php

function xt_ch_iframe_snode_messages_contribute_write_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'write_buttons',$args[2],$args[3],$args[4]);
}
function xt_ch_iframe_snode_messages_build_write_buttons(){
    XT::assign("WRITE_BUTTONS", $GLOBALS['plugin']->getButtons('write_buttons'));
}

?>
