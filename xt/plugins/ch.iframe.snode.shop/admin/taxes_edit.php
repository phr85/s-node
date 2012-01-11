<?php
/**
 * addUnit
 *
 * @package S-Node
 * @subpackage Shop
 * @author Veith Zaech <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: taxes_edit.php 1771 2005-09-20 13:08:48Z rdudler $
 */

if(XT::getPermission("manage_taxes")){
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
            t.id,
            t.value,
            td.description
        FROM
            " . $GLOBALS['plugin']->getTable('taxes') . " as t
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('taxes_details') . " as td ON (t.id = td.id AND td.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        WHERE t.id = " . $GLOBALS['plugin']->getValue('id') ,__FILE__,__LINE__);

    $data = XT::getQueryData($result);
    XT::assign("DATA", $data[0]);

    XT::addImageButton('[S]ave'         ,'saveTaxes'        ,'taxes_edit','disk_blue.png','0','slave1','s');
    XT::addImageButton('Save and [E]xit','exitAndSaveTaxes' ,'taxes_edit','save_close.png','0','slave1','e');
    XT::addImageButton('E[x]it'         ,'exitTaxes'        ,'taxes_edit','exit.png','0','slave1','x');

    XT::assign("EDIT_BUTTONS", $GLOBALS['plugin']->getButtons('taxes_edit'));

    // Fetch content
    $content = XT::build("taxes_edit.tpl");
}else{
    XT::log("No Permission \"edit\" (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
}

?>
