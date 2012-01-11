<?php

/**
 * Contributes an "Add article" button
 *
 * @package S-Node
  * @subpackage catalog
 * @author Veith Zaech <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: addArticle.la.extension.php 2469 2006-02-15 13:08:35Z vzaech $
 */

if(XT::getPermission('addArticle')){
    $GLOBALS['plugin']->contribute("list_articles_buttons", "[a]dd article", "addArticle","add.png","0","slave1","a","slave1");
}
if(XT::getPermission('list')){
$GLOBALS['plugin']->contribute("list_articles_buttons", "search article", "searchArticle","view.png","0","slave1","3","slave1");
}
?>
