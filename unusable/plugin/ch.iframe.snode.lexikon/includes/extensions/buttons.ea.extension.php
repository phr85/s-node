<?php

 if(XT::getPermission('editArticle')){
    $GLOBALS['plugin']->contribute("edit_articles_buttons", "[s]ave", "saveArticle","","0","slave1","s");
    $GLOBALS['plugin']->contribute("edit_articles_buttons", "save and [e]xit", "exitSaveArticle","","0","slave1","e","master");
}

$GLOBALS['plugin']->contribute("edit_articles_buttons", "e[x]it", "exitArticle","","0","slave1","x","master");

?>
