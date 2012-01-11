<?php
/**
 * addUnit
 *
 * @package S-Node
 * @subpackage Taxes
 * @author Veith Zaech <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: taxes_overview.php 3016 2007-02-07 13:28:12Z vzaech $
 */
if(XT::getPermission("manage_taxes")){
    // Enable page navigator
    XT::enableAdminNavigator('taxes', 'id' );
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    $result = XT::query("
        SELECT
            t.id,
            t.value
        FROM
            " . $GLOBALS['plugin']->getTable('taxes') . " as t
        ORDER BY
            t.id ASC
        LIMIT
            " . $GLOBALS['plugin']->getLimiter() . "
        ",__FILE__,__LINE__);

    XT::assign("DATA", XT::getQueryData($result));


    XT::addImageButton('<u>A</u>dd Taxes','addTaxes','taxes_overview','add.png','0','slave1','a');
    XT::assign("TAXES_BUTTONS", $GLOBALS['plugin']->getButtons('taxes_overview'));

    // Fetch content
    $content = XT::build("taxes_overview.tpl");
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}

?>
