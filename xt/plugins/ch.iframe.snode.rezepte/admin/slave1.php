<?php
if(XT::getPermission('list')){
    // Newest entries
    $result = XT::query("
        SELECT
             a.id,
            d.title,
            d.active as lang_active,
            d.validated,
            d.lang,
            d.recipe_of_month,
            a.c_date
        FROM
            " . XT::getTable('rezepte') . " as a
        LEFT JOIN
            " . XT::getTable('r_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
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
            d.title,
            d.active as lang_active,
            d.validated,
            d.lang,
            d.recipe_of_month,
            a.m_date
        FROM
            " . XT::getTable('rezepte') . " as a
        LEFT JOIN
            " . XT::getTable('r_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        ORDER BY
            a.m_date DESC
        LIMIT
            10
        ",__FILE__,__LINE__);
    XT::assign("CHANGES", XT::getQueryData($result));
}
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build("slave1.tpl");

?>
