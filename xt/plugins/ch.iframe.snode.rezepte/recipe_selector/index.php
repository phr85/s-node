<?php

XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order("a.id,d.title,d.active,d.validated","d.title",1,"selector");
$order->setListener("sort","sortby");

if(XT::getPermission("recipeSelector")){
    // Enable page navigator
    XT::enableAdminCharFilter('d.title');
    XT::enableAdminNavigator('', '',"SELECT count(a.id) as count_id FROM " . XT::getTable('rezepte') . " as a LEFT JOIN " . XT::getTable('r_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "') " . $GLOBALS['plugin']->getCharFilter());
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

// get the last 5 entries
    $result = XT::query("
        SELECT
            a.id,
            d.title,
            d.active as lang_active,
            d.lang,
            ta.recipe_id,
            ta." . XT::getSessionValue('assign_field') . "
        FROM
            " . XT::getTable('rezepte') . " as a LEFT JOIN
            " . XT::getTable('r_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        LEFT JOIN
             " . XT::getSessionValue('assign_table') . " as ta on (ta.recipe_id = a.id AND ta." . XT::getSessionValue('assign_field') . "=" . XT::getSessionValue('assign_id') . ")
        ORDER BY
            a.id DESC
        LIMIT
            0,5
        ",__FILE__,__LINE__,0);

    XT::assign("DATA_LAST", XT::getQueryData($result));
 

// Handle search
$search = '';
if(XT::getValue('search') != ''){
    if($GLOBALS['plugin']->getCharFilter() == ""){
        $search = "WHERE " . XT::getValue('search_field') . " LIKE '%" . XT::getValue('search') . "%'";
    }else {
        $search = "AND " . XT::getValue('search_field') . " LIKE '%" . XT::getValue('search') . "%'";
    }
}

XT::assign("SEARCH_TERM", XT::getValue('search'));
XT::assign("SEARCH_BY", XT::getValue('search_field'));

    $result = XT::query("
        SELECT
            a.id,
            d.title,
            d.active as lang_active,
            d.lang,
            ta.recipe_id,
            ta." . XT::getSessionValue('assign_field') . "
        FROM
            " . XT::getTable('rezepte') . " as a
        LEFT JOIN
            " . XT::getTable('r_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        LEFT JOIN
             " . XT::getSessionValue('assign_table') . " as ta on (ta.recipe_id = a.id AND ta." . XT::getSessionValue('assign_field') . "=" . XT::getSessionValue('assign_id') . ")
        " . $GLOBALS['plugin']->getCharFilter() . "
        " . $search . "
        " . $order->get() . "
        LIMIT
            " . $GLOBALS['plugin']->getLimiter() . "
        ",__FILE__,__LINE__,0);

    XT::assign("DATA", XT::getQueryData($result));
    // set the node title
    XT::assign("NODE_TITLE", XT::getSessionValue('assign_title'));

    // Fetch content
    $content = XT::build("select_recipes.tpl");
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}

?>
