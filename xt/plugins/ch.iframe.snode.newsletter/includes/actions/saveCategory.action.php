<?php

XT::query("
    UPDATE
        " . XT::getDatabasePrefix() . "newsletter_categories
    SET
        title = '" . XT::getValue('title') . "',
        description = '" . XT::getValue('description') . "',
        mod_date = '" . XT::getValue('mod_date') . "',
        mod_user = '" . XT::getValue('mod_user') . "'
    WHERE
        id = '" . XT::getValue('category_id') . "'
",__FILE__,__LINE__);

XT::setAdminModule('ec');

?>
