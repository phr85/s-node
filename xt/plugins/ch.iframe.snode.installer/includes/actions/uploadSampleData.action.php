<?php

$GLOBALS['plugin']->setAdminModule('slave1');

/**
 * Is a file posted
 */
if($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['error'] == 1){
    XT::log('upload error ',__FILE__,__LINE__,XT_ERROR);
}


if(isset($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']) && $_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['name'] != '' && substr($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['name'],-5) == '.xtsd'){
    require_once(CLASS_DIR . "install.class.php");
    $install = new XT_Install();
    $install->installSampleData('file');
    XT::log("Done",__FILE__,__LINE__,XT_INFO);
}else {
    XT::log('Please use a XT Package (*.xtsd)',__FILE__,__LINE__,XT_ERROR);
    $GLOBALS['plugin']->setAdminModule('upload_sampledata');
}

if($GLOBALS['plugin']->getValue("url")){
    $GLOBALS['preplugin_content'] .= $GLOBALS['plugin']->getValue("url");
}


?>