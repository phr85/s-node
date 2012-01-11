<?php

if($GLOBALS['plugin']->getValue("new_type") == 1){
    $GLOBALS['plugin']->setValue("value","");
}

if($GLOBALS['plugin']->getValue("value") == "" && $GLOBALS['plugin']->getValue("new_type") != 1) {
    $result = XT::query("
        SELECT
            pos
        FROM
            " . XT::getTable("forms_prepreactions") . "
        WHERE
            id=" . XT::getSessionValue("preaction_id")
    ,__FILE__,__LINE__);
    
    $row = $result->fetchRow();
    $pos = $row['pos'];
    
    XT::query("
        UPDATE
            " . XT::getTable("forms_preactions") . "
        SET
            pos = pos - 1
        WHERE
            form_id=" . XT::getSessionValue("form_id") . " AND
            pos > " . $pos 
    ,__FILE__,__LINE__);
    
    XT::query("
        DELETE FROM
            " . XT::getTable("forms_preactions") . "
        WHERE
            id=" . XT::getSessionValue("preaction_id") 
    ,__FILE__,__LINE__);
}
else {
	XT::query("UPDATE " . $GLOBALS['plugin']->getTable("forms_preactions") .  "
    SET
        type = '" . $GLOBALS['plugin']->getValue("type") . "',
        value = '" . $GLOBALS['plugin']->getValue("value") . "'
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("preaction_id") . "
    ",__FILE__,__LINE__);

}

$GLOBALS['plugin']->setAdminModule("epa");

?>
