<?php

// Delete and insert new folder entry
XT::query("
    DELETE FROM
        " . XT::getTable('galleries_rel') . "
    WHERE
        file_id = '" . $GLOBALS['plugin']->getValue("file_id") . "'",__FILE__,__LINE__);


?>