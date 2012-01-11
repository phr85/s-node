<?php
if(XT::getPermission("list")){
    // Enable page navigator
    $GLOBALS['plugin']->per_page = 50;
    XT::enableAdminCharFilter('d.title');
    XT::enableAdminNavigator('', '',"SELECT count(a.id) as count_id FROM " . $GLOBALS['plugin']->getTable('articles') . " as a LEFT JOIN " . $GLOBALS['plugin']->getTable('articles_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "') " . $GLOBALS['plugin']->getCharFilter());
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    $result = XT::query("
        SELECT
            a.id,
            a.art_nr,
            a.active,
            d.title,
            d.active as lang_active,
            d.lang
        FROM
            " . $GLOBALS['plugin']->getTable('articles') . " as a,

            " . $GLOBALS['plugin']->getTable('articles_details') . " as d
        WHERE
            a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "'
        " . $GLOBALS['plugin']->getCharFilter('AND') . "
        ORDER BY
            a.id DESC
        LIMIT
            " . $GLOBALS['plugin']->getLimiter() . "
        ",__FILE__,__LINE__,0);

    XT::assign("DATA", XT::getQueryData($result));

    // Fetch content
    $content = XT::build("list_articles.tpl");
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}

?>
