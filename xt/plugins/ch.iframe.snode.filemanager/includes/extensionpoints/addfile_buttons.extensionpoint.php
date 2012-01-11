<?php
function xt_ch_iframe_snode_filemanager_contribute_addfile_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'addfile_buttons',$args[2],$args[3],$args[4],$args[5],$args[6],$args[7]);
}

function xt_ch_iframe_snode_filemanager_build_addfile_buttons(){
    XT::assign("ADDFILE_BUTTONS", $GLOBALS['plugin']->getButtons('addfile_buttons'));
}

?>
