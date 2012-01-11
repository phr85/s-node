<?php
function xt_ch_iframe_snode_articles_contribute_edit2_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'edit2_buttons',$args[2],$args[3],$args[4],$args[5]);
}

function xt_ch_iframe_snode_articles_build_edit2_buttons(){
    XT::assign("EDIT2_BUTTONS", $GLOBALS['plugin']->getButtons('edit2_buttons'));
}

?>
