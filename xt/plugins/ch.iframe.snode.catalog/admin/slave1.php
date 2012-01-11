<?php
if(XT::getPermission('list')){
    // Newest entries
    $result = XT::query("
        SELECT
            a.id,
            a.art_nr,
            a.active,
            d.title,
            d.active as lang_active,
            d.lang,
            a.edate
        FROM
            " . $GLOBALS['plugin']->getTable('articles') . " as a
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('articles_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        ORDER BY
            a.id DESC
        LIMIT
            10
        ",__FILE__,__LINE__);

    XT::assign("NEWEST", XT::getQueryData($result));


    // Last 15 changes
    $result = XT::query("
        SELECT
            a.id,
            a.art_nr,
            a.active,
            d.title,
            d.active as lang_active,
            d.lang,
            a.edate
        FROM
            " . $GLOBALS['plugin']->getTable('articles') . " as a
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('articles_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        ORDER BY
            a.edate DESC
        LIMIT
            10
        ",__FILE__,__LINE__);
    XT::assign("CHANGES", XT::getQueryData($result));
}
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build("slave1.tpl");

?>
