<?php
if ($GLOBALS['plugin']->getValue("value") == "") {
	$GLOBALS['plugin']->setValue("value",$GLOBALS['plugin']->getValue("label"));	
}
XT::query("UPDATE " . $GLOBALS['plugin']->getTable("forms_elements_values") .  "
    SET
        label = '" . $GLOBALS['plugin']->getValue("label") . "',
        value = '" . $GLOBALS['plugin']->getValue("value") . "'
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("value_id") . "
    ",__FILE__,__LINE__);
    
$GLOBALS['plugin']->setAdminModule("eev");

?>
