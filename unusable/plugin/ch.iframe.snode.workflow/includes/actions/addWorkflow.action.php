<?php
// Insert new workflow
XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable("workflows") . "
    (
        title,
        lang,
        description
    ) VALUES (
        'Workflow',
        '" . $GLOBALS['plugin']->getActiveLang() . "',
        'No description'
    )",__FILE__,__LINE__);

// Get id of the new workflow
$result = XT::query("
    SELECT
        id
    FROM
        " . $GLOBALS['plugin']->getTable("workflows") . "
    ORDER BY
        id DESC
    LIMIT 1
    ");
while($row = $result->FetchRow()){
    $newid = $row['id'];
}

// Update workflow id
XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable("workflows") . "
    SET
        workflow_id = " . $newid . "
    WHERE
        id = " . $newid . "
    ");

$GLOBALS['plugin']->setValue("id", $newid);
$GLOBALS['plugin']->setAdminModule('e');

?>
