<?php

$GLOBALS['plugin']->setAdminModule('slave1');

/**
 * Is a file posted
 */
if($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['error'] == 1){
    XT::log('upload error ',__FILE__,__LINE__,XT_ERROR);
}


if(isset($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']) && $_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['name'] != '' && substr($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['name'],-4) == '.xtp'){
    require_once(CLASS_DIR . "install.class.php");
    $install = new XT_Install();
    $config_files = glob(PLUGIN_DIR . substr($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['name'],0,-4) . "/includes/*.inc.php");
    if(is_array($config_files)) {
        foreach($config_files as $file) {
            if(!XT::getValue("overwrite_config")) {
                $install->skip_files[] = basename($file);
            }
            else {
                $install->backup_files[] = basename($file);
            }
        }
    }
    if (!XT::getValue("overwrite_translations")){
        $install->skip_files[] = ".lang.php";
    } else {
        $install->backup_files[] = ".lang.php";
    }
    $install->prepareFile('file');

    // handle translation files

    // handle config files



    XT::log("Done",__FILE__,__LINE__,XT_INFO);
}else {
    XT::log('Please use a XT Package (*.xtp)',__FILE__,__LINE__,XT_ERROR);
    $GLOBALS['plugin']->setAdminModule('upload');
}

if($GLOBALS['plugin']->getValue("url")){
    $GLOBALS['preplugin_content'] .= $GLOBALS['plugin']->getValue("url");
}


?>