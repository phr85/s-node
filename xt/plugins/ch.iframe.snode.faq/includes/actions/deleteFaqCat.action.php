<?php

$result = XT::query("
    SELECT
        id
    FROM
        " . XT::getTable('faq') . "
    WHERE
        id = " . XT::getValue("id") . " AND
        lang != '" . XT::getActiveLang() . "'
    LIMIT 1
",__FILE__,__LINE__);
$row = $result->fetchRow();

XT::query("
    DELETE FROM
        " . XT::getTable("faq") . "
    WHERE
        id = " . XT::getValue("id") . " AND
        lang = '" . XT::getActiveLang() . "'
",__FILE__,__LINE__);

if(!$row['id']) {
    XT::query("
        DELETE FROM
            " . XT::getTable("faq2cat") . "
        WHERE
            faq_id = " . XT::getValue("id") . "
    ",__FILE__,__LINE__);
}

XT::setAdminModule("categories");

?>