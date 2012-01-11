<?php
function xt_ch_iframe_snode_customers_contribute_editPersonButtons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1], "editPerson",$args[2],$args[3],$args[4],$args[5]);
}

function xt_ch_iframe_snode_customers_build_editPersonButtons(){
    XT::assign("EDIT_PERSON_BUTTONS", $GLOBALS['plugin']->getButtons("editPerson"));
}

?>
