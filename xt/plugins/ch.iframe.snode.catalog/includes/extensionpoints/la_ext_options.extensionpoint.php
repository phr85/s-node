<?php
function xt_ch_iframe_snode_catalog_contribute_la_ext_options($args){
    $GLOBALS['plugin']->la_ext_options[$args[0]] .= $args[1];
}

function xt_ch_iframe_snode_catalog_build_la_ext_options(){
    XT::assign("EXT_OPTIONS", $GLOBALS['plugin']->la_ext_options);
}
?>
