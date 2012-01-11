<?php

 if(XT::getPermission('editRecipe')){
    $GLOBALS['plugin']->contribute("edit_recipe_buttons", "[s]ave", "saveRecipe","disk_blue.png","0","slave1","s");
    $GLOBALS['plugin']->contribute("edit_recipe_buttons", "save and [e]xit", "exitSaveRecipe","save_close.png","0","slave1","e","master");
}

$GLOBALS['plugin']->contribute("edit_recipe_buttons", "e[x]it", "exitRecipe","exit.png","0","slave1","x","master");

?>
