<?php

switch($GLOBALS['plugin']->getValue("position")){

    case 'before':
        XT::query("
            UPDATE " . $GLOBALS['plugin']->getTable("areas") .  " SET pos = pos + 1 WHERE pos >= " . $GLOBALS['plugin']->getValue("insert_position") . "",__FILE__,__LINE__);

        XT::query("
            INSERT INTO
                " . $GLOBALS['plugin']->getTable("areas") . "
            (
                title,
                creation_date,
                creation_user,
                pos
            ) VALUES (
                '" . $GLOBALS['lang']->msg('New area') . "',
                '" . time() . "',
                " . XT::getUserID() . ",
                " . $GLOBALS['plugin']->getValue("insert_position") . "
            )
        ",__FILE__,__LINE__); 

        break;

    case 'after':
        XT::query("
            UPDATE " . $GLOBALS['plugin']->getTable("areas") .  " SET pos = pos + 1 WHERE pos > " . $GLOBALS['plugin']->getValue("insert_position") . "",__FILE__,__LINE__);

        XT::query("
            INSERT INTO
                " . $GLOBALS['plugin']->getTable("areas") . "
            (
                title,
                creation_date,
                creation_user,
                pos
            ) VALUES (
                '" . $GLOBALS['lang']->msg('New area') . "',
                '" . time() . "',
                " . XT::getUserID() . ",
                " . ($GLOBALS['plugin']->getValue("insert_position") + 1) . "
            )
        ",__FILE__,__LINE__);

        break;

}

$GLOBALS['plugin']->call("cancel");

// Get the new id
$result = XT::query("
    SELECT
        id
    FROM
        " . $GLOBALS['plugin']->getTable("areas") . "
    ORDER BY
        id DESC
    LIMIT 1
",__FILE__,__LINE__);

$data = XT::getQueryData($result);

// Set the new id
$GLOBALS['plugin']->setValue("id",$data[0]['id']);

$GLOBALS['plugin']->setAdminModule('e');
?>
