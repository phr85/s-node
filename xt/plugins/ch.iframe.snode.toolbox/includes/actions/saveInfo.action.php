<?php
// Delete existing node details

$result = XT::query("SELECT count(*) as anz FROM " . $GLOBALS['plugin']->getTable("navigation_details") . " WHERE
    node_id = " . XT::getValue('tpl_id') . "
    AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'",__FILE__,__LINE__);
$row = $result->FetchRow();

if ($row["anz"] == 0) {
	XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable("navigation_details") . " (node_id,lang) VALUES (" . XT::getValue('tpl_id') . ",'" . $GLOBALS['plugin']->getActiveLang() . "')",__FILE__,__LINE__);
}

XT::query("UPDATE " . $GLOBALS['plugin']->getTable("navigation_details") . " SET
	title = '" . XT::getValue('title')  . "',
	header = '" . XT::getValue('header')  . "',
	footer = '" . XT::getValue('footer')  . "',
	css = '" . XT::getValue('css')  . "',
	target = '" . XT::getValue('target')  . "',
	tpl_file = '" . XT::getValue('tpl_file')  . "'
WHERE
    node_id = " . XT::getValue('tpl_id') . "
    AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);
XT::setValue('node_id',XT::getValue('tpl_id'));
XT::call("ch.iframe.snode.navigation.cleanup");


?>