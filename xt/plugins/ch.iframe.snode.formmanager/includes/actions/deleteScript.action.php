<?php

XT::query("
    DELETE FROM 
        " . XT::getTable("forms_scripts") . " 
    WHERE 
        id = " . XT::getValue("script_id")
,__FILE__,__LINE__);

@unlink(DATA_DIR . 'scripts/ch.iframe.snode.formmanager/' . XT::getValue("script_id") . '.php');

?>
