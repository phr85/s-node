<?php
if (XT::getValue("package") != "") {
    require_once(CLASS_DIR . "install.class.php");
    $install = new XT_Install();
    if (!XT::getValue("overwrite_config")){
        foreach (glob(PLUGIN_DIR . substr(XT::getValue("package"),0,-4) . "/includes/*.inc.php") as $file){
            $install->skip_files[] = basename($file);
        }
    } else {
        foreach (glob(PLUGIN_DIR . substr(XT::getValue("package"),0,-4) . "/includes/*.inc.php") as $file){
            $install->backup_files[] = basename($file);
        }
    }
    if (!XT::getValue("overwrite_translations")){
        $install->skip_files[] = ".lang.php";
    } else {
        $install->backup_files[] = ".lang.php";
    }
    $install->downloadFile("http://www.s-node.com/packages/" . XT::getValue("package"));
    XT::log("Done",__FILE__,__LINE__,XT_INFO);
}
?>