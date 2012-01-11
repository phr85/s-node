<?php
switch ($GLOBALS['plugin']->getValue("wizard")) {
	case "upload":
        $GLOBALS['plugin']->setAdminModule('upload');
		break;
	case "overview":
        $GLOBALS['plugin']->setAdminModule('slave1');
		break;
	case "update":
        $GLOBALS['plugin']->setAdminModule('update');
		break;
	case "install":
		$GLOBALS['plugin']->setAdminModule('install');

		break;
}

?>