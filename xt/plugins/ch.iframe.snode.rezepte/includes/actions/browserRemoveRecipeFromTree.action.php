<?php
$data = XT::getQueryData(XT::query("SELECT position FROM " . XT::getTable('r2tree') . " where node_id=" . XT::getValue('node_id') . " AND recipe_id = " . XT::getValue('recipe_id'),__FILE__,__LINE__,0));
XT::query("DELETE FROM " . XT::getTable('r2tree') . " where node_id=" . XT::getValue('node_id') . " AND recipe_id = " . XT::getValue('recipe_id'),__FILE__,__LINE__,0);
XT::query("UPDATE " . XT::getTable('r2tree') . " SET position = position-1 where node_id=" . XT::getValue('node_id') . " AND position > " . ($data[0]['position']) ,__FILE__,__LINE__,0);

?>
