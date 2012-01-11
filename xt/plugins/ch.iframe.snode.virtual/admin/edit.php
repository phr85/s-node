<?php

if($GLOBALS['plugin']->getValue("virtual_id") != ''){
    $GLOBALS['plugin']->setSessionValue("virtual_id", $GLOBALS['plugin']->getValue("virtual_id"));
}

$virtual_id = $GLOBALS['plugin']->getSessionValue("virtual_id");

if(XT::getPermission('editVirtual')){
    $GLOBALS['plugin']->contribute("edit_buttons", "Save", "saveVirtual","disk_blue.png","0");
}

$result = XT::query("
    SELECT 
        * 
    FROM 
        " . $GLOBALS['plugin']->getTable('virtual_url') . " 
    WHERE 
        id = " . $virtual_id . "
    LIMIT 
        1
", __FILE__, __LINE__);

$row = $result->fetchRow();
XT::assign('VIRTUAL', $row);
$content = XT::build('edit.tpl');
?>