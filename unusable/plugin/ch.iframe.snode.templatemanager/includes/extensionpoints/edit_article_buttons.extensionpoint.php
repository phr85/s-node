<?php
function xt_ch_iframe_snode_faq_contribute_edit_article_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'edit_article_buttons',$args[2],$args[3],$args[4],$args[5]);
}

function xt_ch_iframe_snode_faq_build_edit_article_buttons(){
    XT::assign("EDIT_ARTICLE_BUTTONS", $GLOBALS['plugin']->getButtons('edit_article_buttons'));
}

?>
