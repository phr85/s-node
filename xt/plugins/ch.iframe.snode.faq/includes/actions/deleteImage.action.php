<?php

XT::query("
    UPDATE
        " . XT::getTable("faq") . "
    SET
        image = '',
        image_version = '',
        image_zoom = ''
    WHERE
        id = " . XT::getValue("id") . " AND
        lang = '" . XT::getActiveLang() . "'
",__FILE__,__LINE__);

XT::setAdminModule("edit");

?>