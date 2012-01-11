<?php
function xt_ch_iframe_snode_rezepte_contribute_list(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'list_recipes',$args[2],$args[3],$args[4],$args[5], $args[6],$args[7]);
}

/**
 * Assigns buttons to the button bar in the overview tab
 */
function xt_ch_iframe_snode_rezepte_build_list(){
    XT::assign("LIST_BUTTONS", $GLOBALS['plugin']->getButtons('list_recipes'));
}

?>
