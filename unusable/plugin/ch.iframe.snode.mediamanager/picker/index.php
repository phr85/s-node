<?php

if($GLOBALS['plugin']->getValue("form") != ''){
    $GLOBALS['plugin']->setSessionValue('form',$GLOBALS['plugin']->getValue("form"));
}

if($GLOBALS['plugin']->getValue("field") != ''){
    $GLOBALS['plugin']->setSessionValue('field',$GLOBALS['plugin']->getValue("field"));
}

XT::assign("PICKER", true);
XT::assign("PICKER_FORM", $GLOBALS['plugin']->getSessionValue("form"));
XT::assign("PICKER_FIELD", $GLOBALS['plugin']->getSessionValue("field"));

include($GLOBALS['plugin']->location . '../admin/overview.php');

$content = XT::build("popup.tpl");

?>
