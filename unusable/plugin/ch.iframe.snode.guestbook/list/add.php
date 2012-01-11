<?php

// Buttons
XT::addButton("Save entry", "saveEntry");

// if are an error, take content from POST-data
$error = $GLOBALS['error']->getErrors();

if($GLOBALS['error']->getErrors() != array() AND $error[0]['severity'] < 8){

    XT::assign('NAME',$GLOBALS['plugin']->getPostValue('name'));
    XT::assign('EMAIL',$GLOBALS['plugin']->getPostValue('email'));
    XT::assign('WEBSITE',$GLOBALS['plugin']->getPostValue('website'));
    XT::assign('COMMENT',$GLOBALS['plugin']->getPostValue('comment'));

}

XT::assign('TPL', 500);

$content = XT::build("add.tpl");

?>