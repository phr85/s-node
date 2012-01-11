<?php

$GLOBALS['plugin']->setAdminModule('slave1');

if($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['error'] == 1){
    XT::log('upload error ',__FILE__,__LINE__,XT_ERROR);
}

/**
 * Is a file posted
 */
if(isset($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']) && $_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['name'] != '' && substr($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['name'],-9) == '.xtupdate'){
    require_once(CLASS_DIR . "install.class.php");
    $install = new XT_Install();
    $install->prepareFile('file');     
}else{
 	XT::log('Please use a XT Update Package (*.xtupdate)',__FILE__,__LINE__,XT_ERROR);
	$GLOBALS['plugin']->setAdminModule('update');   
}

if($GLOBALS['plugin']->getValue("url")){
    $GLOBALS['preplugin_content'] .= $GLOBALS['plugin']->getValue("url");
}
?>