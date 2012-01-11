<?php
$result = XT::query("
            SELECT
                *
            FROM
                " . $GLOBALS['plugin']->getTable('relations') . "
            WHERE
                content_id = " . XT::getValue('node_id') . "
            AND
                content_type = " .XT::getBaseID() . "
            ORDER by position ASC
            ",__FILE__,__LINE__);

$position = 1;
while($row = $result->FetchRow()){
    XT::query("UPDATE " . $GLOBALS['plugin']->getTable('relations') . " SET position=" . $position . " WHERE id=" . $row['id'],__FILE__,__LINE__);
    $position++;
}
?>