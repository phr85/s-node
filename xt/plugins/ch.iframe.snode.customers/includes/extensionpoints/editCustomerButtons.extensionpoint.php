<?php
function xt_ch_iframe_snode_customers_contribute_editCustomerButtons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1], "editCustomer",$args[2],$args[3],$args[4],$args[5]);
}

function xt_ch_iframe_snode_customers_build_editCustomerButtons(){
    XT::assign("EDIT_CUSTOMER_BUTTONS", $GLOBALS['plugin']->getButtons("editCustomer"));
}

?>
