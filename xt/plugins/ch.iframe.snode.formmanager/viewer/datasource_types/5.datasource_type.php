<?php

// Post values
if($row['datasource_query'] != ''){
    $count = 0;

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

    while($row_value = $result_values->FetchRow()){
        $row['values'][$count]['label'] = $row_value['label'];
        $row['values'][$count]['value'] = $row_value['value'];
        $count++;
    }
    
    if(isset($_POST[$row['datasource_query']]) &&
       is_array($_POST[$row['datasource_query']])) {
        foreach($_POST[$row['datasource_query']] as $row_value) {
            $row['values'][$count]['label'] = $row_value[$row['datasource_label_field']];
            $row['values'][$count]['value'] = $row_value[$row['datasource_value_field']];
            $count++;
        }
    }
}
?>