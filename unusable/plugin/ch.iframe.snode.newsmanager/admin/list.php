<?php

XT::enableAdminNavigator('newsmanager_v','',"
    SELECT
        count(id) as count_id
    FROM
        " . XT::getTable('newsmanager_v') . "
    WHERE
        latest = 1 AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
");

if(XT::getPermission('add')){
    // Buttons
    XT::addImageButton("Add news", "addNews","default","document_new.png",0,"slave1");
}

// SQL
$result = XT::query("
    SELECT
        id,
        title,
        subtitle,
        creation_date,
        active,
        locked,
        locked_user,
        locked_date,
        published,
        rid
    FROM
        " . XT::getTable('newsmanager_v') . "
    WHERE
        latest = 1 AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    ORDER BY
        creation_date DESC
    LIMIT
        " . $GLOBALS['plugin']->getLimiter() . "
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}
XT::assign("DATA", $data);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build("list.tpl");
?>