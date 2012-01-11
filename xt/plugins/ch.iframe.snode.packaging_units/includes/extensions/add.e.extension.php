<?php

/**
 * Contributes an "Add unit" button
 *
 * @package S-Node
  * @subpackage units
 * @author Veith Zaech <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: add.e.extension.php 1066 2005-07-19 13:27:58Z vzaech $
 */

if(XT::getPermission('edit')){
    $GLOBALS['plugin']->contribute("edit_relations_buttons", "Add relations", "add_relation","","1","slave1");
}

?>
