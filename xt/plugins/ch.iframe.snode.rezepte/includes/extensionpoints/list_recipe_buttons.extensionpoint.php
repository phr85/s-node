<?php
function xt_ch_iframe_snode_catalog_contribute_list_recipe_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'list_recipe',$args[2],$args[3],$args[4],$args[5], $args[6],$args[7]);
}

/**
 * Assigns buttons to the button bar in the overview tab
 */
function xt_ch_iframe_snode_catalog_build_list_recipe_buttons(){
    XT::assign("LIST_RECIPE_BUTTONS", $GLOBALS['plugin']->getButtons('list_recipe'));
}

?>
