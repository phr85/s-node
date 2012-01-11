<?php

XT::query("
    UPDATE
        " . XT::getTable('faq_tree_details') . "
    SET
        active = 0
    WHERE
        lang = '" . XT::getActiveLang() . "' AND
        node_id = " . XT::getValue('node_id') . "
",__FILE__,__LINE__);

?>
