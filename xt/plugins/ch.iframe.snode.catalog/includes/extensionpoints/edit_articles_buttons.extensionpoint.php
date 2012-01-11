<?php
function xt_ch_iframe_snode_catalog_contribute_edit_articles_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'edit_articles',$args[2],$args[3],$args[4],$args[5],$args[6]);
}

/**
 * Assigns buttons to the button bar in the overview tab
 */
function xt_ch_iframe_snode_catalog_build_edit_articles_buttons(){
    XT::assign("EDIT_ARTICLES_BUTTONS", $GLOBALS['plugin']->getButtons('edit_articles'));
}

?>
