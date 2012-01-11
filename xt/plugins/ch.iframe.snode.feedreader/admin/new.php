<?php
if(XT::getPermission('editfeeds')){
    $GLOBALS['plugin']->contribute("edit_buttons", "Save", "newFeed","disk_blue.png","0");
}

$content = XT::build("new.tpl");
?>