<?php
function xt_ch_iframe_snode_mediamanager_contribute_edit_folder_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'edit_folder',$args[2],$args[3],$args[4],$args[5],$args[6]);
}

/**
 * Assigns buttons to the button bar in the edit tab
 */
function xt_ch_iframe_snode_mediamanager_build_edit_folder_buttons(){
    XT::assign("EDIT_FOLDER_BUTTONS", $GLOBALS['plugin']->getButtons('edit_folder'));
}

?>
