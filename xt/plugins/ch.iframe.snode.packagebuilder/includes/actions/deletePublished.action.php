<?php
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable("publish") . "
    WHERE
        id = " . XT::getValue("package_id") . "
");

$row = $result->FetchRow();

XT::query("DELETE FROM  " . XT::getTable("publish") . " WHERE id=". XT::getValue("package_id"));
unlink(PUBLISHED_PACKAGES . $row["package"]. "." . $row["revision"] . ".xtp");
?>
