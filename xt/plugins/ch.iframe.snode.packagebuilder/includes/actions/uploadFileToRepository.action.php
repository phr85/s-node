<?php

$GLOBALS['plugin']->setAdminModule('slave1');

/**
 * Is a file posted
 */
if(isset($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']) && $_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['name'] != '' && substr($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['name'],-4) == '.xtp'){
    require_once(CLASS_DIR . "install.class.php");
    $install = new XT_Install();
    $install->prepareFile('file');     
}else {
	XT::log('Please use a XT Package (*.xtp)',__FILE__,__LINE__,XT_ERROR);
	$GLOBALS['plugin']->setAdminModule('upload');
}

if($GLOBALS['plugin']->getValue("url")){
    $GLOBALS['preplugin_content'] .= $GLOBALS['plugin']->getValue("url");
}


?>