<?php
if(XT::getPermission("editRecipe")){
    // Enable page navigator
    XT::enableAdminCharFilter('d.title');
    XT::enableAdminNavigator('', '',"SELECT count(a.id) as count_id FROM " . $GLOBALS['plugin']->getTable('rezepte') . " as a LEFT JOIN " . $GLOBALS['plugin']->getTable('r_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "') " . $GLOBALS['plugin']->getCharFilter());
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    $result = XT::query("
        SELECT
            a.id,
            d.title,
            d.active as lang_active,
            d.lang,
            ta.recipe_id,
            ta.node_id
        FROM
            " . $GLOBALS['plugin']->getTable('rezepte') . " as a
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('r_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        LEFT JOIN
             " . $GLOBALS['plugin']->getTable('r2tree') . " as ta on (ta.recipe_id = a.id AND ta.node_id=" . XT::getSessionValue('open') . ")
        " . $GLOBALS['plugin']->getCharFilter() . "
        ORDER BY
            a.id DESC
        LIMIT
            " . $GLOBALS['plugin']->getLimiter() . "
        ",__FILE__,__LINE__,0);

    XT::assign("DATA", XT::getQueryData($result));
    // get the node title
    $node_title = XT::getQueryData(XT::query("SELECT title FROM " . $GLOBALS['plugin']->getTable('nodes') . " where node_id=" . XT::getSessionValue('open') . " AND lang='" . $GLOBALS['plugin']->getActiveLang() . "'",__FILE__,__LINE__,0));
    XT::assign("NODE_TITLE", $node_title[0]['title']);

    // Fetch content
    $content = XT::build("select_recipes.tpl");
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}

?>
