<?php
function xt_ch_iframe_snode_filemanager_contribute_browser_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'browser_buttons',$args[2],$args[3],$args[4],$args[5]);
}

function xt_ch_iframe_snode_filemanager_build_browser_buttons(){
    XT::assign("BROWSER_BUTTONS", $GLOBALS['plugin']->getButtons('browser_buttons'));
}

?>
