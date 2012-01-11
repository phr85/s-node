<?php

if(is_writeable(PAGES_DIR . XT::getValue("tpl_file"))){
    $tpl_content = stripslashes($GLOBALS['plugin']->getValue("tpl_content",true));
    $file = fopen(PAGES_DIR . XT::getValue("tpl_file"),"w+");
    fwrite($file,$tpl_content);
    fclose($file);
} else {
    XT::log("Template is not writeable",__FILE__,__LINE__,XT_ERROR);
}

XT::setAdminModule('et');

?>
