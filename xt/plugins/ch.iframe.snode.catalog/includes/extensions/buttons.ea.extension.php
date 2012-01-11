<?php

 if(XT::getPermission('editArticle')){
    $GLOBALS['plugin']->contribute("edit_articles_buttons", "[s]ave", "saveArticle","disk_blue.png","0","slave1","s");
    $GLOBALS['plugin']->contribute("edit_articles_buttons", "save and [e]xit", "exitSaveArticle","save_close.png","0","slave1","e","master");
}

$GLOBALS['plugin']->contribute("edit_articles_buttons", "e[x]it", "exitArticle","exit.png","0","slave1","x","master");

?>
