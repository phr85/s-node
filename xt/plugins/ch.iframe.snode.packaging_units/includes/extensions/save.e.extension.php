<?php

if(XT::getPermission('edit')){
    $GLOBALS['plugin']->contribute("edit_buttons", "Save", "save","disk_blue.png","units","");
}

?>
