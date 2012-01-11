<?php
if(XT::getPermission("articleSelector")){
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
            d.lang,
            ta.article_id,
            ta." . $GLOBALS['plugin']->getSessionValue('assign_field') . "
        FROM
            " . $GLOBALS['plugin']->getTable('articles') . " as a
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('articles_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        LEFT JOIN
             " . $GLOBALS['plugin']->getSessionValue('assign_table') . " as ta on (ta.article_id = a.id AND ta." . $GLOBALS['plugin']->getSessionValue('assign_field') . "=" . $GLOBALS['plugin']->getSessionValue('assign_id') . ")
        " . $GLOBALS['plugin']->getCharFilter() . "
        ORDER BY
            a.id DESC
        LIMIT
            " . $GLOBALS['plugin']->getLimiter() . "
        ",__FILE__,__LINE__,0);

    XT::assign("DATA", XT::getQueryData($result));
    // set the node title
    XT::assign("NODE_TITLE", $GLOBALS['plugin']->getSessionValue('assign_title'));

    // Fetch content
    $content = XT::build("select_articles.tpl");
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}

?>
