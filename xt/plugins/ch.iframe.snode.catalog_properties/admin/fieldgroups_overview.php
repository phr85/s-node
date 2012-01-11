<?php
/**
 *
 * @package S-Node
 * @subpackage catalog
 * @author Haydar Cifti <hciftci@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: fieldgroups_overview.php 1066 2005-07-19 13:27:58Z hciftci $
 */
if(XT::getPermission("manageProperties")){
    // Enable page navigator
    XT::enableAdminCharFilter('name');
    XT::enableAdminNavigator('fieldgroups', 'id' );
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    $result = XT::query("
        SELECT
            id,
            name,
            description
        FROM 
            " . XT::getTable("fieldgroups") . "
        WHERE
            lang='" . XT::getPluginLang() . "'
             " . $GLOBALS['plugin']->getCharFilter('AND') . "
        ORDER BY
            name ASC
        LIMIT " . $GLOBALS['plugin']->getLimiter() . "
        ",__FILE__,__LINE__);
    
    XT::assign("DATA", XT::getQueryData($result));
    
    // Fetch content
    $content = XT::build("fieldgroups_overview.tpl");
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}

?>