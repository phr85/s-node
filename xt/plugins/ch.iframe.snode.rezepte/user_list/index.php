<?php

if(XT::getParam("mode")=="published"){
    $mode = 1;
}else {
    $mode = 0;
}

// Enable page navigator
XT::enableAdminCharFilter('d.title');
XT::enableAdminNavigator('', '',"SELECT count(a.id) as count_id FROM " . XT::getTable('rezepte') . " as a LEFT JOIN " . XT::getTable('r_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "') " . $GLOBALS['plugin']->getCharFilter());
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());
XT::assign('ACTUAL_ID',XT::getSessionValue('recipeID'));
$result = XT::query("
        SELECT
            a.id,
            d.title,
            d.active as lang_active,
            d.lang,
            a.c_date,
            a.m_date,
            d.validated
        FROM
            " . XT::getTable('rezepte') . " as a,

            " . XT::getTable('r_details') . " as d
        WHERE
            a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "'
        " . $GLOBALS['plugin']->getCharFilter('AND') . "
        AND a.c_user=" . XT::getUserID() . "
        AND a.active_by_user=" . $mode . "
        ORDER by a.c_date asc" ,__FILE__,__LINE__,0);

XT::assign("DATA", XT::getQueryData($result));


// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);
?>