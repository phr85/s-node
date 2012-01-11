<?php

if(XT::getPermission('manageProperties')){
    $GLOBALS['plugin']->contribute("overview_properties_buttons", "add property", "addProperty","add.png","0","slave1");
}

?>
