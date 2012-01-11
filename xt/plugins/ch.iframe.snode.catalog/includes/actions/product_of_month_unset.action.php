<?php
// set product of month
XT::query("UPDATE " . XT::getTable('articles_details') . " SET product_of_month=0
    WHERE id=" . XT::getValue('id') . " AND lang='" . XT::getValue('save_lang') . "'",__FILE__,__LINE__);

?>