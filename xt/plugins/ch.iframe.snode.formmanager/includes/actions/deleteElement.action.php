<?php

$result = XT::query("SELECT pos FROM " . $GLOBALS['plugin']->getTable("forms_elements") . " WHERE element_id = " . $GLOBALS['plugin']->getValue("element_id"),__FILE__,__LINE__);
$data = XT::getQueryData($result);

XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("forms_elements") . " WHERE element_id = " . $GLOBALS['plugin']->getValue("element_id"),__FILE__,__LINE__);
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("forms_elements_rules") . " WHERE element_id = " . $GLOBALS['plugin']->getValue("element_id"),__FILE__,__LINE__);
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("forms_elements_values") . " WHERE element_id = " . $GLOBALS['plugin']->getValue("element_id"),__FILE__,__LINE__);

XT::query("UPDATE " . $GLOBALS['plugin']->getTable("forms_elements") . " SET pos = pos - 1 WHERE pos > " . $data[0]['pos'] . " AND form_id = '" . XT::getSessionValue('form_id') . "'");

$GLOBALS['plugin']->setAdminModule("ef");

?>
