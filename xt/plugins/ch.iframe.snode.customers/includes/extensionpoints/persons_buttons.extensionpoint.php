<?php
function xt_ch_iframe_snode_customers_contribute_persons_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1], "persons_overview",$args[2],$args[3],$args[4],$args[5]);
}

function xt_ch_iframe_snode_customers_build_persons_buttons(){
    XT::assign("PERSONS_BUTTONS", $GLOBALS['plugin']->getButtons("persons_overview"));
}

?>
