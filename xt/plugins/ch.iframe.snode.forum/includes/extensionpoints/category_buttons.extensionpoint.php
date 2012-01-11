<?php
function xt_ch_iframe_snode_forum_contribute_category_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'category_buttons',$args[2],$args[3],$args[4],$args[5],$args[6]);
}

/**
 * Assigns buttons to the button bar in the edit tab
 */
function xt_ch_iframe_snode_forum_build_CATEGORY_buttons(){
    XT::assign("CATEGORY_BUTTONS", $GLOBALS['plugin']->getButtons('category_buttons'));
}

?>
