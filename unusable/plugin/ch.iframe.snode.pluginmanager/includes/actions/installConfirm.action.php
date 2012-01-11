<?php

/**
 * installConfirm
 *
 * @package S-Node
 * @subpackage Pluginmanager
 * @author Roger Dudler <rdudler@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: installConfirm.action.php 1066 2005-07-19 13:27:58Z vzaech $
 */

/**
 * Installs a plugin
 */
    require_once(CLASS_DIR . "install.class.php");
    $install = new XT_Install();
    $install->prepareFile('file');

?>
