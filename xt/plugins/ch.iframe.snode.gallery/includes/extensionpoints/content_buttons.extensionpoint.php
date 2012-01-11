<?php
function xt_ch_iframe_snode_gallery_contribute_content_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'content_buttons',$args[2],$args[3],$args[4],$args[5]);
}

function xt_ch_iframe_snode_gallery_build_content_buttons(){
    XT::assign("CONTENT_BUTTONS", $GLOBALS['plugin']->getButtons('content_buttons'));
}

?>
