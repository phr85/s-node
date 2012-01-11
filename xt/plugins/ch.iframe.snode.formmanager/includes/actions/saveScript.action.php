<?php

XT::query("
    UPDATE 
        " . XT::getTable("forms_scripts") .  "
    SET
        title = '" . XT::getValue("title") . "'
    WHERE
        id = " . XT::getSessionValue("script_id") . "
",__FILE__,__LINE__);

if(is_writable(DATA_DIR . 'scripts/ch.iframe.snode.formmanager/' . XT::getSessionValue("script_id") . '.php')){
    file_put_contents(DATA_DIR . 'scripts/ch.iframe.snode.formmanager/' . XT::getSessionValue("script_id") . '.php',stripslashes(XT::getValue('content')));
} else {
    XT::log("Cannot write to file",__FILE__,__LINE__,XT_ERROR);
}
    
XT::setAdminModule("es");

?>