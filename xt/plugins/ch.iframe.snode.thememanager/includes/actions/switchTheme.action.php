<?php
require_once(FUNC_DIR . 'basic.functions.php');
// Activate theme
$_SESSION['theme'] = XT::getValue('theme_title');
$file = file_get_contents(INCLUDE_DIR . 'config.inc.php');

    $file = preg_replace('\'"theme",\s+"' . $GLOBALS['cfg']->get("system","theme") . '"\'',  '"theme", "' . $_SESSION['theme'] . '"',$file);
     
file_put_contents(getcwd() . '/xt/includes/config.inc.php',$file);

// Clean up compiled templates
XT::call('cleanUp');

XT::setAdminModule('slave1');

?>