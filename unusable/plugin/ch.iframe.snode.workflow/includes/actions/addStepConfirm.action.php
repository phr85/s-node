<?php
if($GLOBALS['plugin']->getValue("title") == ''){
    XT::log("Please fill in a title for the step",__FILE__,__LINE__,XT_ERROR);
}

if($GLOBALS['plugin']->getValue("phase") != ''){
    $GLOBALS['plugin']->setSessionValue("phase_id",$GLOBALS['plugin']->getValue("phase"));
}

$GLOBALS['plugin']->setAdminModule("as");

if(!XT::hasErrors()){
    XT::query("
        INSERT INTO
            " . $GLOBALS['plugin']->getTable("workflows") . "
        (
            workflow_id,
            phase,
            title,
            lang,
            description
        ) VALUES (
            " . $GLOBALS['plugin']->getSessionValue("id") . ",
            " . $GLOBALS['plugin']->getSessionValue("phase_id") . ",
            '" . $GLOBALS['plugin']->getValue("title") . "',
            '" . $GLOBALS['plugin']->getActiveLang() . "',
            '" . $GLOBALS['plugin']->getValue("description") . "'
        )
        ");
        $GLOBALS['plugin']->setAdminModule("e");
}
?>
