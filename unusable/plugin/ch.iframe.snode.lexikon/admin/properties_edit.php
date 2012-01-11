<?php
/**
 * addUnit
 *
 * @package S-Node
 * @subpackage Units
 * @author Veith Zaech <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: properties_edit.php 1066 2005-07-19 13:27:58Z vzaech $
 */
// set And get session values
if(!$GLOBALS['plugin']->getValue('property_id')){
    $GLOBALS['plugin']->setValue('property_id', $GLOBALS['plugin']->getSessionValue('property_id'));
}else{
    $GLOBALS['plugin']->setSessionValue('property_id',$GLOBALS['plugin']->getValue('property_id'));
}

if(XT::getPermission("manageProperties")){
    // Enable page navigator
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    $result = XT::query("
        SELECT
            p.id,
            p.lang,
            p.fieldname,
            p.description,
            p.position
        FROM
            " . $GLOBALS['plugin']->getTable('fieldnames') . " as p
        WHERE p.id = " . $GLOBALS['plugin']->getValue('property_id') . " AND p.lang='" . $GLOBALS['plugin']->getActiveLang() . "'" ,__FILE__,__LINE__,0);

    $data = XT::getQueryData($result);
    XT::assign("DATA", $data[0]);

    // Fetch content
    $content = XT::build("properties_edit.tpl");
}else{
    XT::log("No Permission \"edit\" (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
}

?>
