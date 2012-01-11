<?php

$result = XT::query("SELECT tree.id from " . XT::getTable(XT::getParam('table_tree')) . " as tree, " . XT::getTable(XT::getParam('table_tree')) . " as tree2 WHERE tree2.id =" . XT::getValue('node_id') . " AND tree.l >= tree2.l AND tree.r <= tree2.r ",__FILE__,__LINE__);
while($row = $result->FetchRow()){
XT::query("DELETE FROM " . XT::getTable('relations') . " WHERE content_type=" . XT::getValue('univctype') . " AND content_id=" . $row['id']  . " AND target_content_type=" . XT::getValue('ctype') . " AND target_content_id=" . XT::getValue('cid') . " 
 AND lang='" . $GLOBALS['plugin']->getActiveLang() . "'" ,__FILE__,__LINE__);

}

$result = XT::query("SELECT id FROM " . XT::getTable('relations') . " WHERE target_content_type=" . XT::getValue('ctype')  . " AND target_content_id=" . XT::getValue('cid') . " ORDER BY position ASC",__FILE__,__LINE__);
$i = 1;
while($row = $result->FetchRow()){
	XT::query("UPDATE  " . XT::getTable('relations') . " SET position=" . $i  . " WHERE id=" . $row['id'],__FILE__,__LINE__);
	$i++;
}
?>