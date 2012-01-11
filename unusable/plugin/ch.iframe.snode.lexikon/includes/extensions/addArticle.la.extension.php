<?php

/**
 * Contributes an "Add article" button
 *
 * @package S-Node
  * @subpackage lexikon
 * @author Veith Zaech <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: addArticle.la.extension.php 1066 2005-07-19 13:27:58Z vzaech $
 */

if(XT::getPermission('addArticle')){
    $GLOBALS['plugin']->contribute("list_articles_buttons", "[a]dd article", "addArticle","add.png","0","slave1","a","slave1");
}

?>
