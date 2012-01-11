<?php

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
        1
    )
",__FILE__,__LINE__); 

// Get last insert id
$result = XT::query("
    SELECT id FROM " . $GLOBALS['plugin']->getTable("areas") .  " ORDER BY id DESC LIMIT 1", __FILE__,__LINE__);
while($row = $result->FetchRow()){
    $GLOBALS['plugin']->setValue("id", $row['id']);
}

$GLOBALS['plugin']->setAdminModule("e");

?>
