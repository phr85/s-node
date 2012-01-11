<?php
if(is_string($_REQUEST['form'])){
    $GLOBALS['plugin']->setSessionValue("form",$_REQUEST['form']);
}
if(is_string($_REQUEST['field'])){
    $GLOBALS['plugin']->setSessionValue("field",$_REQUEST['field']);
}
if(is_string($_REQUEST['titlefield'])){
    $GLOBALS['plugin']->setSessionValue("titlefield",$_REQUEST['titlefield']);
}



XT::assign('FORM',XT::getSessionValue("form"));
XT::assign('FIELD',XT::getSessionValue("field"));
XT::assign('TITLEFIELD',XT::getSessionValue("titlefield"));

if(XT::getPermission("recipeSelector")){

    // get the last 5 entries
    $result = XT::query("
        SELECT
            a.id,
            d.title,
            d.active as lang_active,
            d.lang

        FROM
            " . XT::getTable('rezepte') . " as a
        LEFT JOIN
            " . XT::getTable('r_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "')

        ORDER BY
            a.id DESC
        LIMIT
            0,5
    ",__FILE__,__LINE__,0);

    XT::assign("DATA_LAST", XT::getQueryData($result));

    // Handle search
    $search = '';
    if(XT::getValue('search') != ''){
        $search = " AND " . XT::getValue('search_field') . " LIKE '%" . XT::getValue('search') . "%'";
    }

    XT::assign("SEARCH_TERM", XT::getValue('search'));
    XT::assign("SEARCH_BY", XT::getValue('search_field'));

    // Enable page navigator
    XT::enableAdminCharFilter('d.title');
    XT::enableAdminNavigator('', '',"SELECT count(a.id) as count_id FROM " . XT::getTable('rezepte') . " as a LEFT JOIN " . XT::getTable('r_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "') " . $GLOBALS['plugin']->getCharFilter());
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    $result = XT::query("
        SELECT
            a.id,
            d.title,
            d.active as lang_active,
            d.lang
        FROM
            " . XT::getTable('rezepte') . " as a LEFT JOIN
            " . XT::getTable('r_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
            WHERE
                a.id = a.id
                " . $GLOBALS['plugin']->getCharFilter('AND') . "
                " . $search . "
        ORDER BY
            a.id DESC
        LIMIT
            " . $GLOBALS['plugin']->getLimiter() . "
        ",__FILE__,__LINE__,0);

    XT::assign("DATA", XT::getQueryData($result));

    // Fetch content
    $content = XT::build("select_recipes.tpl");
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}

?>
