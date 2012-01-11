<?php

if(XT::getPermission("articleSelector")){
    // Enable page navigator
    XT::enableAdminCharFilter('d.title');
    XT::enableAdminNavigator('', '',"SELECT count(a.id) as count_id FROM " . $GLOBALS['plugin']->getTable('articles') . " as a LEFT JOIN " . $GLOBALS['plugin']->getTable('articles_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "') " . $GLOBALS['plugin']->getCharFilter());
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

// get the last 5 entries
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
            " . $GLOBALS['plugin']->getTable('articles') . " as a LEFT JOIN
            " . $GLOBALS['plugin']->getTable('articles_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        LEFT JOIN
             " . $GLOBALS['plugin']->getSessionValue('assign_table') . " as ta on (ta.article_id = a.id AND ta." . $GLOBALS['plugin']->getSessionValue('assign_field') . "=" . $GLOBALS['plugin']->getSessionValue('assign_id') . ")
        ORDER BY
            a.id DESC
        LIMIT
            0,5
        ",__FILE__,__LINE__,0);

    XT::assign("DATA_LAST", XT::getQueryData($result));
    
// Handle order requests
if(XT::getValue("order_by") != ''){
    XT::setSessionValue("order_by", XT::getValue("order_by"));
}
if(XT::getValue("order_by_dir") != ''){
    XT::setSessionValue("order_by_dir", XT::getValue("order_by_dir"));
}
if(XT::getSessionValue('order_by') != '' && XT::getSessionValue('order_by_dir') != ''){
    $order_by = XT::getSessionValue('order_by') . ' ' . XT::getSessionValue('order_by_dir');
} else {
    $order_by = 'a.id DESC';
    XT::setSessionValue('order_by','a.id');
    XT::setSessionValue('order_by_dir','desc');
}
XT::assign("ORDER_BY_DIR", XT::getSessionValue('order_by_dir'));
XT::assign("ORDER_BY", XT::getSessionValue('order_by'));

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
        " . $search . "
        ORDER BY
            " . $order_by . "
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
