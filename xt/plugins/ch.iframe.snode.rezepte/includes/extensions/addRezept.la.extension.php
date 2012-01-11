<?php

if(XT::getPermission('addRecipe')){
    $GLOBALS['plugin']->contribute("list", "[a]dd recipe", "addRecipe","add.png","0","slave1","a","slave1");
}

if(XT::getPermission('list')){
$GLOBALS['plugin']->contribute("list", "search recipe", "searchRecipe","view.png","0","slave1","3","slave1");
}
?>
