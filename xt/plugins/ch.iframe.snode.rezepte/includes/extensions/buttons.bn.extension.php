<?php
if(XT::getPermission('manageStructure')){
    $GLOBALS['plugin']->contribute("browser_buttons", "<u>a</u>dd recipes", "addRecipeToTreeTab","add.png","0","slave1","a");
}

?>
