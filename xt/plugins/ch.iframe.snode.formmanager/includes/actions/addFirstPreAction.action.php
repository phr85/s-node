<?php
XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable("forms_preactions") .  " (form_id,pos,lang,type) VALUES (" . $GLOBALS['plugin']->getSessionValue("form_id") . ",1,'de',1)
    ",__FILE__,__LINE__);

// Get last insert id
$result = XT::query("
    SELECT id FROM " . $GLOBALS['plugin']->getTable("forms_preactions") .  " ORDER BY id DESC LIMIT 1", __FILE__,__LINE__);
while($row = $result->FetchRow()){
    $GLOBALS['plugin']->setValue("preaction_id", $row['id']);
}

$GLOBALS['plugin']->setAdminModule("epa");

?>
