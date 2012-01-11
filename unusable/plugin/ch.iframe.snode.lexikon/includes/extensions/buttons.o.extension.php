<?php

if(XT::getPermission('editArticle')){
    $GLOBALS['plugin']->contribute("overview_buttons", "[a]dd article", "addArticle","","0","slave1","a");
}

?>