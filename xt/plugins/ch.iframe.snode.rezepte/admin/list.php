<?php
if(XT::getPermission("list")){

    XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order("a.id,d.title,d.active,d.validated","d.title",1,"list");
$order->setListener("sort","sortby");

    // Enable page navigator
    XT::enableAdminCharFilter('d.title');
    XT::enableAdminNavigator('', '',"SELECT count(a.id) as count_id FROM "
     . XT::getTable('rezepte') . " as a LEFT JOIN "
     . XT::getTable('r_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "') " . " WHERE a.active_by_user = 1" . $GLOBALS['plugin']->getCharFilter('AND')
     );
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());
    XT::assign('ACTUAL_ID',XT::getSessionValue('recipeID'));
    $result = XT::query("
        SELECT
            a.id,
            d.title,
            d.active as lang_active,
            d.validated,
            d.lang,
            d.recipe_of_month
        FROM
            " . XT::getTable('rezepte') . " as a,

            " . XT::getTable('r_details') . " as d
        WHERE
            a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "'
            AND a.active_by_user = 1
        " . $GLOBALS['plugin']->getCharFilter('AND') . "
        " . $order->get() . "
        LIMIT
            " . $GLOBALS['plugin']->getLimiter() . "
        ",__FILE__,__LINE__,0);

    XT::assign("DATA", XT::getQueryData($result));

    // Fetch content
    $content = XT::build("list.tpl");
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}
?>
