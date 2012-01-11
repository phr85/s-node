<?php

/**
 * Contributes an "Add user" button
 *
 * @package S-Node
 * @subpackage Usermanager
 * @author Roger Dudler <rdudler@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: addUser.o.buttons.extension.php 1066 2005-07-19 13:27:58Z vzaech $
 */

if(XT::getPermission('add')){
    $GLOBALS['plugin']->contribute("buttons", "Add user", "addUser","","1","master");
}

?>