<?php

$result = XT::query("SELECT pos FROM " . $GLOBALS['plugin']->getTable("forms_elements_values") . " WHERE id = " . $GLOBALS['plugin']->getValue("value_id"),__FILE__,__LINE__);
$data = XT::getQueryData($result);

XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("forms_elements_values") . " WHERE id = " . $GLOBALS['plugin']->getValue("value_id"),__FILE__,__LINE__);
XT::query("UPDATE " . $GLOBALS['plugin']->getTable("forms_elements_values") . " SET pos = pos - 1 WHERE pos > " . $data[0]['pos'] . " AND element_id = '" . XT::getSessionValue('element_id') . "'");

$GLOBALS['plugin']->setAdminModule("ee");

?>
