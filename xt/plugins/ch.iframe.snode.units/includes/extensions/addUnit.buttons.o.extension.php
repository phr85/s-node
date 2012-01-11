<?php

/**
 * Contributes an "Add user" button
 *
 * @package S-Node
  * @subpackage units
 * @author Veith Zaech <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: addUnit.buttons.o.extension.php 1771 2005-09-20 13:08:48Z rdudler $
 */

if(XT::getPermission('add')){
    $GLOBALS['plugin']->contribute("overview_buttons", "Add unit", "addUnit","add.png","0","slave1");
}

?>