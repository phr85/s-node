<?php
if(XT::getPermission("editArticles")){
    // Enable page navigator
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
            ta.node_id
        FROM
            " . $GLOBALS['plugin']->getTable('articles') . " as a
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('articles_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        LEFT JOIN
             " . $GLOBALS['plugin']->getTable('tree2articles') . " as ta on (ta.article_id = a.id AND ta.node_id=" . $GLOBALS['plugin']->getSessionValue('open') . ")
        " . $GLOBALS['plugin']->getCharFilter() . "
        ORDER BY
            a.id DESC
        LIMIT
            " . $GLOBALS['plugin']->getLimiter() . "
        ",__FILE__,__LINE__,0);

    XT::assign("DATA", XT::getQueryData($result));
    // get the node title
    $node_title = XT::getQueryData(XT::query("SELECT title FROM " . $GLOBALS['plugin']->getTable('nodes') . " where node_id=" . $GLOBALS['plugin']->getSessionValue('open') . " AND lang='" . $GLOBALS['plugin']->getActiveLang() . "'",__FILE__,__LINE__,0));
    XT::assign("NODE_TITLE", $node_title[0]['title']);

    // Fetch content
    $content = XT::build("select_articles.tpl");
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}

?>
