<?php
// Set default Options
if(file_exists($GLOBALS['plugin']->location . '../' . 'includes/config_options.inc.php')){
    unlink($GLOBALS['plugin']->location . '../' . 'includes/config_options.inc.php');
}

header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['tpl_id']);

$GLOBALS['plugin']->setAdminModule('eo');
?>