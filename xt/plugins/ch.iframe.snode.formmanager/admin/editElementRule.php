<?php

if($GLOBALS['plugin']->getValue("rule_id") != ''){
    $GLOBALS['plugin']->setSessionValue("rule_id", $GLOBALS['plugin']->getValue("rule_id"));
}

$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("forms_elements_rules") .  "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("rule_id") . "
    ",__FILE__,__LINE__);

$data = XT::getQueryData($result);
XT::assign("DATA", $data[0]);


// Get script info
$result = XT::query("
        SELECT
            id,
            title
        FROM
            " . $GLOBALS['plugin']->getTable("forms_scripts") .  "
        ORDER BY
            title ASC
        ",__FILE__,__LINE__);

$scripts = XT::getQueryData($result);

if (is_numeric($scripts[0]['id'])) {
    XT::assign("SCRIPT_CONTENT", highlight_file(DATA_DIR . 'scripts/ch.iframe.snode.formmanager/' . $scripts[0]['id'] . '.php',true));
}

XT::assign("SCRIPTS", $scripts);


$content = XT::build("editElementRule.tpl");

?>
