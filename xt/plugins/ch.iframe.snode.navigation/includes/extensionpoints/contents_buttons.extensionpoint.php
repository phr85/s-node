<?php
function xt_ch_iframe_snode_navigation_contribute_contents_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'contents_buttons',$args[2],$args[3],$args[4],$args[5]);
}

function xt_ch_iframe_snode_navigation_build_contents_buttons(){
    XT::assign("CONTENTS_BUTTONS", $GLOBALS['plugin']->getButtons('contents_buttons'));
}

?>
