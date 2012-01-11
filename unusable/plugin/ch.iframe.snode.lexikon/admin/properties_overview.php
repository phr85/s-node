<?php
/**
 * addUnit
 *
 * @package S-Node
 * @subpackage Units
 * @author Veith Zaech <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: properties_overview.php 1066 2005-07-19 13:27:58Z vzaech $
 */
if(XT::getPermission("manageProperties")){
    // Enable page navigator
    $GLOBALS['plugin']->per_page = 50;
    XT::enableAdminCharFilter('fieldname');
    XT::enableAdminNavigator('fieldnames', 'id' );
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    $result = XT::query("
        SELECT
            p.id,
            p.lang,
            p.fieldname,
            p.description
        FROM
            " . $GLOBALS['plugin']->getTable('fieldnames') . " as p
        WHERE
            p.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        " . $GLOBALS['plugin']->getCharFilter('AND') . "
        ORDER BY
            p.position ASC,
            p.fieldname ASC
        LIMIT
            " . $GLOBALS['plugin']->getLimiter() . "
        ",__FILE__,__LINE__,0);
    XT::assign("DATA", XT::getQueryData($result));
    // Fetch content
    $content = XT::build("properties_overview.tpl");
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}

?>
