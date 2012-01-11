<?php

// Add a new FAQ entry
XT::query("
    INSERT INTO " . XT::getTable('faq') . " (
        date,
        c_user,
        lang
    ) VALUES (
        " . TIME . ",
        " . XT::getUserID() . ",
        '" . XT::getActiveLang() . "'
    )
",__FILE__,__LINE__);

$result = XT::query("
    SELECT
        id
    FROM
        " . XT::getTable('faq') . "
    WHERE
        date = '" . TIME . "' AND
        c_user = '" . XT::getUserID() . "' AND
        lang = '" . XT::getActiveLang() . "'
",__FILE__,__LINE__);
$row = $result->FetchRow();
$id = $row['id'];

$result = XT::query("
    SELECT
        IF(MAX(position) > 0,(MAX(position)+1),1) as maxpos
    FROM
        " . XT::getTable('faq2cat') . "
",__FILE__,__LINE__);
$row = $result->FetchRow();
$max_pos = $row['maxpos'];

XT::query("
    INSERT INTO " . XT::getTable('faq2cat') . " (
        faq_id,
        node_id,
        position
    ) VALUES (
        " . $id . ",
        2,
        " . $max_pos . "
    )
",__FILE__,__LINE__);

XT::setValue("id", $id);
XT::setAdminModule("edit");

?>