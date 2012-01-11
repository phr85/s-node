<?php

XT::query("
    UPDATE
        " . XT::getTable("jobs_detail") . "
    SET
        active = 1
    WHERE
        id = '" . XT::getValue("id") . "' AND
        lang = '" . XT::getActiveLang() . "'
",__FILE__,__LINE__);

?>