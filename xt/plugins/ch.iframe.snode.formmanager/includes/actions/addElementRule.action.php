<?php

XT::query("
    INSERT INTO " . $GLOBALS['plugin']->getTable("forms_elements_rules") . " (
        form_id,
        element_id,
        lang,
        compare_type,
        compare_query,
        title
    ) VALUES (
        " . $GLOBALS['plugin']->getSessionValue("form_id") . ",
        " . $GLOBALS['plugin']->getSessionValue("element_id") . ",
        'de',
        1,
        '==',
        'Rule'
    )", __FILE__,__LINE__);

$result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable("forms_elements_rules") . " ORDER BY id DESC LIMIT 1");
$data = XT::getQueryData($result);

$GLOBALS['plugin']->setValue("rule_id", $data[0]['id']);
$GLOBALS['plugin']->setAdminModule("eer");

?>
