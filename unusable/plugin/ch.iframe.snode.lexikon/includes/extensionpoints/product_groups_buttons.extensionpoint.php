<?php
function xt_ch_iframe_snode_lexikon_contribute_product_groups_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'product_groups',$args[2],$args[3],$args[4],$args[5]);
}

/**
 * Assigns buttons to the button bar in the overview tab
 */
function xt_ch_iframe_snode_lexikon_build_product_groups_buttons(){
    XT::assign("PRODUCT_GROUPS_BUTTONS", $GLOBALS['plugin']->getButtons('product_groups'));
}

?>
