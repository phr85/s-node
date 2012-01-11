<?php

/**
 * Main tasks configuration
 *
 * @package S-Node
 * @subpackage Tasks
 * @author Roger Dudler <rdudler@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: config.inc.php 1066 2005-07-19 13:27:58Z vzaech $
 */

// Set Base id
$GLOBALS['plugin']->setBaseID(2800);

// Add tables
$GLOBALS['plugin']->addTable("tasks","tasks","Main tasks data");
$GLOBALS['plugin']->addTable("projects","projects","Main projects data");
$GLOBALS['plugin']->addTable("projects_steps","projects_steps","Main projects steps data");
$GLOBALS['plugin']->addTable("user","user","Main user data");

// Add tabs
$GLOBALS['plugin']->addTab("o","My tasks","overview.php",true,true);
$GLOBALS['plugin']->addTab("ot","Others tasks","overview_other.php",true,true);
$GLOBALS['plugin']->addTab("ct","Create task","create.php",false,false);

// Enable permissions
$GLOBALS['plugin']->enablePermissions();

?>