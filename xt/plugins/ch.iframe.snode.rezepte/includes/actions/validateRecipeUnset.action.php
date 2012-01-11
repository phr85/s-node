<?php
// set product of month
XT::query("UPDATE " . XT::getTable('r_details') . " SET validated=0
    WHERE id=" . XT::getValue('id') . " AND lang='" . XT::getPluginLang() . "'",__FILE__,__LINE__);

?>