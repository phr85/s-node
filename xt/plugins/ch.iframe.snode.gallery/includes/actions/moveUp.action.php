<?php

// Update follow ups
XT::query("
    UPDATE
        " . XT::getTable('galleries_rel') . "
    SET 
        pos = pos + 1
    WHERE
        pos < " . XT::getValue('pos') . " AND
        gallery_id = " . XT::getSessionValue('open') . "
    ORDER BY
        pos DESC
    LIMIT 1
",__FILE__,__LINE__);

// Update active entry
XT::query("
    UPDATE
        " . XT::getTable('galleries_rel') . "
    SET 
        pos = pos - 1
    WHERE
        file_id = " . XT::getValue('file') . " AND
        gallery_id = " . XT::getSessionValue('open') . "
",__FILE__,__LINE__);
XT::call("reorder");
?>