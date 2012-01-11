<?php

if(XT::getPermission('editRecipe')){
    $GLOBALS['plugin']->contribute("overview_buttons", "[a]dd recipe", "addRecipe","","0","slave1","a");
}

?>