<?php
/**
 * addUnit
 *
 * @package S-Node
 * @subpackage promo
 * @author Veith Zaech <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: promo_overview.php 3016 2007-02-07 13:28:12Z vzaech $
 */
if(XT::getPermission("manage_promo")){
    // Enable page navigator
    XT::enableAdminCharFilter('dd.name');
    XT::enableAdminNavigator('promo', 'id',"SELECT count(d.id) FROM " . $GLOBALS['plugin']->getTable('promo') . " as d LEFT JOIN " . $GLOBALS['plugin']->getTable('promo_details') . " as dd ON (d.id = dd.id AND dd.lang='" . $GLOBALS['plugin']->getActiveLang() . "') " . $GLOBALS['plugin']->getCharFilter());

    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    $result = XT::query("
        SELECT
            d.id,
            d.kummulierbar,
            d.give_discount_at,
            dd.name
        FROM
            " . $GLOBALS['plugin']->getTable('promo') . " as d
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('promo_details') . " as dd ON (d.id = dd.id AND dd.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        " . $GLOBALS['plugin']->getCharFilter() . "
        ORDER BY
            d.id ASC
        LIMIT
            " . $GLOBALS['plugin']->getLimiter() . "
        ",__FILE__,__LINE__);

    XT::assign("DATA", XT::getQueryData($result));

    XT::addImageButton('[a]dd promo','addpromo','promo_overview','add.png','0','slave1','a');
    XT::assign("promo_BUTTONS", $GLOBALS['plugin']->getButtons('promo_overview'));

    // Fetch content
    $content = XT::build("promo_overview.tpl");
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}

?>
