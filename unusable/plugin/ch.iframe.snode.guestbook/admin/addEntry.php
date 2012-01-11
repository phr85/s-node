<?php

if(XT::getPermission('add')){

    // Buttons
    XT::addButton("Save entry", "saveNewEntry");
    XT::addButton("Save entry and add Entry", "saveNewEntryaddNew");

    if($GLOBALS['logger']->getErrors() != array() AND $error[0]['severity'] < 8){

        XT::assign("NAME", $GLOBALS['plugin']->getPostValue('name'));
        XT::assign("EMAIL", $GLOBALS['plugin']->getPostValue('email'));
        XT::assign("WEBSITE", $GLOBALS['plugin']->getPostValue('website'));
        XT::assign("COMMENT", $GLOBALS['plugin']->getPostValue('comment'));

    }

    $content = XT::build("addEntry.tpl");

}

?>