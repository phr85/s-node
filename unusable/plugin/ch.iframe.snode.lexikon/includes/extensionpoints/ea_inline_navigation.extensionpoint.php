<?php
function xt_ch_iframe_snode_lexikon_contribute_ea_inline_navigation(){
    $args = func_get_args();
    $GLOBALS['plugin']->inline_navigation[$args[0][2]] = array("anchor" => $args[0][0],"title" => $args[0][1],"accesskey" => $args[0][3]);
}

/**
 * Assigns buttons to the button bar in the overview tab
 */
function xt_ch_iframe_snode_lexikon_build_ea_inline_navigation(){
    XT::assign("INLINE_NAVIGATION", $GLOBALS['plugin']->inline_navigation);
}

?>
