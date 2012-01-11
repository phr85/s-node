<?php
if(XT::getPermission('manageStructure')){
    $GLOBALS['plugin']->contribute("browser_buttons", "<u>a</u>dd articles", "addArticlesToTreeTab","add.png","0","slave1","a");
}

?>
