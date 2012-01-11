<?php

// Insert script
XT::query("
    INSERT INTO 
        " . XT::getTable("forms_scripts") .  "
    (
        title
    ) VALUES (
        '" . $GLOBALS['lang']->msg('New script') . "'
    )
",__FILE__,__LINE__);

// Get the id of the inserted script
$result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable("forms_scripts") . " ORDER BY id DESC LIMIT 1");
$data = XT::getQueryData($result);

// Set new script id
XT::setValue("script_id", $data[0]['id']);

// Create empty script
@file_put_contents(DATA_DIR . 'scripts/ch.iframe.snode.formmanager/' . XT::getValue("script_id") . '.php','');

// Change to script edit mode
XT::setAdminModule("es");

?>