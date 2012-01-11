<?php

// Manual (Multiple values)
$result_values = XT::query("
    SELECT
        label,
        value
    FROM
        " . $GLOBALS['plugin']->getTable("forms_elements_values") . "
    WHERE
        element_id = " . $row['element_id'] . "
    ORDER BY
        pos ASC
    ",__FILE__,__LINE__);

$count = 0;
while($row_value = $result_values->FetchRow()){
    $row['values'][$count]['label'] = $row_value['label'];
    $row['values'][$count]['value'] = $row_value['value'];
    $count++;
}

?>