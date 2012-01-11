<?php

if(XT::getPermission('manageProperties')){
    $GLOBALS['plugin']->contribute("overview_properties_buttons", "add property", "addProperty","","0","slave1");
}

?>
