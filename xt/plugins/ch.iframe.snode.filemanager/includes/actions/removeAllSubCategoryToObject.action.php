<?php

$result = XT::query("SELECT tree.id from " . XT::getTable('files_tree') . " as tree, " . XT::getTable('files_tree') . " as tree2 WHERE tree2.id =" . XT::getValue('node_id') . " AND tree.l >= tree2.l AND tree.r <= tree2.r ",__FILE__,__LINE__);
while($row = $result->FetchRow()){
XT::query("DELETE FROM " . XT::getTable('relations') . " WHERE content_type=" . XT::getContentType('Filefolder') . " AND content_id=" . $row['id']. " AND target_content_type=" . XT::getValue('ctype') . " AND target_content_id=" . XT::getValue('cid'),__FILE__,__LINE__);
}
?>