<?php

switch($GLOBALS['plugin']->getValue("position")){

    case 'before':
        XT::query("
            UPDATE " . $GLOBALS['plugin']->getTable("forms_elements") .  "
            SET
            	pos = pos + 1
            WHERE
            	form_id = " . $GLOBALS['plugin']->getSessionValue("form_id") . "
            AND
            	pos >= " . $GLOBALS['plugin']->getValue("insert_position") . "",__FILE__,__LINE__);

        XT::query("
            INSERT INTO
                " . $GLOBALS['plugin']->getTable("forms_elements") .  " (form_id,pos,active,lang)
            VALUES
            	(" . $GLOBALS['plugin']->getSessionValue("form_id") . "," . ($GLOBALS['plugin']->getValue("insert_position")) . ",0,'de')
            ",__FILE__,__LINE__);

        break;

    case 'after':
        XT::query("
            UPDATE
            	" . $GLOBALS['plugin']->getTable("forms_elements") .  "
            SET
            	pos = pos + 1
            WHERE
            	form_id = " . $GLOBALS['plugin']->getSessionValue("form_id") . "
            AND
            	pos > " . $GLOBALS['plugin']->getValue("insert_position") . "",__FILE__,__LINE__);

        XT::query("
            INSERT INTO
                " . $GLOBALS['plugin']->getTable("forms_elements") .  " (form_id,pos,active,lang)
            VALUES
            	(" . $GLOBALS['plugin']->getSessionValue("form_id") . "," . ($GLOBALS['plugin']->getValue("insert_position") + 1) . ",0,'de')
            ",__FILE__,__LINE__);
        break;
}

// Get last insert id
$result = XT::query("
    SELECT element_id FROM " . $GLOBALS['plugin']->getTable("forms_elements") .  " ORDER BY element_id DESC LIMIT 1", __FILE__,__LINE__);
while($row = $result->FetchRow()){
    $GLOBALS['plugin']->setValue("element_id", $row['element_id']);
}

$GLOBALS['plugin']->call("cancel");
$GLOBALS['plugin']->setAdminModule("ee");

?>