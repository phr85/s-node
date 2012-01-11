<?php
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('relations') . " SET position=" . XT::getValue('position')  . " WHERE 
content_type=" . XT::getBaseID() . "
AND
content_id=" . XT::getValue('node_id') . "
AND
position=" . (XT::getValue('position') + 1) 
,__FILE__,__LINE__);

XT::query("UPDATE " . $GLOBALS['plugin']->getTable('relations') . " SET position=" . (XT::getValue('position') + 1 )  . " WHERE 
id=" . XT::getValue('id')
,__FILE__,__LINE__);
XT::call('cleanupPositions');
?>