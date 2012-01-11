<?php

XT::query("DELETE FROM " . XT::getTable('relations') . " 
WHERE content_type=" . XT::getBaseID() . " AND content_id=" . XT::getValue('node_id') . "
 AND target_content_type=" . XT::getValue('ctype') . " AND target_content_id=" . XT::getValue('cid') ,__FILE__,__LINE__);
?>