<?php
/**
 * addUnit
 *
 * @package S-Node
 * @subpackage Units
 * @author Veith Zaech <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: edit.php 1771 2005-09-20 13:08:48Z rdudler $
 */

if(XT::getPermission("edit")){
    // set And get session values
    if(!$GLOBALS['plugin']->getValue('id')){
        $GLOBALS['plugin']->setValue('id', $GLOBALS['plugin']->getSessionValue('id'));
    }else{
        $GLOBALS['plugin']->setSessionValue('id',$GLOBALS['plugin']->getValue('id'));
    }

    // Enable page navigator
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    $result = XT::query("
        SELECT
            u.id,
            u.standard,
            ud.short,
            ud.full
        FROM
            " . XT::getTable( 'units') . " as u
        LEFT JOIN
            " . XT::getTable( 'units_det') . " as ud ON (u.id = ud.id AND ud.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        WHERE u.id = " . $GLOBALS['plugin']->getValue('id') ,__FILE__,__LINE__);

    $data = XT::getQueryData($result);
    XT::assign("DATA", $data[0]);

    // get relations
    $result = XT::query("
        SELECT
            r.id,
            r.relation_id,
            r.factor,
            ud.short
        FROM
            " . XT::getTable( 'units_relations') . " as r
        LEFT JOIN
            " . XT::getTable( 'units_det') . " as ud ON (r.relation_id = ud.id AND ud.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        WHERE r.id = " . $GLOBALS['plugin']->getValue('id') ,__FILE__,__LINE__);

    $relations = XT::getQueryData($result);
    XT::assign("RELATIONS", $relations);

    // Fetch content
    $content = XT::build("edit.tpl");
}else{
    XT::log("No Permission \"edit\" (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
}

?>
