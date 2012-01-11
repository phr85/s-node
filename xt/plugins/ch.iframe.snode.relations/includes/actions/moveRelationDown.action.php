<?php
$result = XT::query("SELECT * FROM " . XT::getTable('relations') . " WHERE id=" . XT::getValue('relation_id'),__FILE__,__LINE__);
$row = $result->FetchRow();
$pos = $row['position'];
$target_content_id = $row['target_content_id'];
$target_content_type = $row['target_content_type'];

$result = XT::query("UPDATE " . XT::getTable('relations') . " SET position= " . $pos . " WHERE position =" . ($pos + 1) . " AND target_content_id=" . $target_content_id . " AND target_content_type=" . $target_content_type,__FILE__,__LINE__);
$result = XT::query("UPDATE " . XT::getTable('relations') . " SET position= " . ($pos + 1) . " WHERE id =" .  XT::getValue('relation_id'),__FILE__,__LINE__);

?>