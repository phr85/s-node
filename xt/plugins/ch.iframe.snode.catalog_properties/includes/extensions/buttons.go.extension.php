<?php

if(XT::getPermission('manageProperties')){
    $GLOBALS['plugin']->contribute("overview_fieldgroups_buttons", "add group", "addGroup","add.png","0","slave1");
}

?>
