<?php

$data = array();

// Die Hauptdaten zusammenstellen
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable("jobs_applications") . "
    WHERE
        id = " . XT::getValue("id") . "
    LIMIT 1
",__FILE__,__LINE__);

$data['edit'] = $result->fetchRow();

// Die Values zusammenstellen
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable("jobs_applications_values") . "
    WHERE
        application_id = " . XT::getValue("id") . "
    ORDER BY
        id
",__FILE__,__LINE__);

$data['values'] = array();

while($row = $result->fetchRow()) {
    $data['values'][$row['key']] = $row;
}

// Buttons
XT::addImageButton("saveApplication", "saveApplication" , "default", "disk_blue.png","editApplication","slave1","s");
XT::addImageButton("sendApplication", "sendApplication" , "default", "mail.png","editApplication","slave1","se");

// Zuweisungen
XT::assign("EDIT", $data['edit']);
XT::assign("VALUES", $data['values']);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", XT::getActiveLang());


$content = XT::build("editApplication.tpl");

?>