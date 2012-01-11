<?php

// Enable Char filter and navigator
XT::enableAdminCharFilter('main.title');
XT::enableAdminNavigator('','',"
    SELECT
        count(main.id)
    FROM
        " . $GLOBALS['plugin']->getTable("workflows") . " AS main
    WHERE
        main.id = main.workflow_id
        AND main.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        " . XT::getAdminCharFilter('AND') . "
");

// Get open id
$GLOBALS['plugin']->getValue("open") != '' ? $GLOBALS['plugin']->setSessionValue("open",$GLOBALS['plugin']->getValue("open")) : null;
!is_numeric($GLOBALS['plugin']->getSessionValue("open")) ? $GLOBALS['plugin']->setSessionValue("open",0) : null;
$active = $GLOBALS['plugin']->getSessionValue("open");

// Empty data array
$data = array();

// Get tree
$result = XT::query("
    SELECT
        main.id,
        main.title,
        main.description
    FROM
        " . $GLOBALS['plugin']->getTable("workflows") . " AS main
    WHERE
        main.id = main.workflow_id
        AND main.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        " . XT::getAdminCharFilter('AND') . "
    ORDER BY
        main.title ASC
",__FILE__,__LINE__);

// Fill tree data
while ($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("WORKFLOWS", $data);

// Fetch content
$content = XT::build("overview.tpl");

?>
