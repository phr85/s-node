<?
// create buttons
$GLOBALS['plugin']->addButton('Refresh updates', 'refreshUpdates');
$GLOBALS['plugin']->addButton('Update all', 'updateAll');

$GLOBALS['tpl']->assign("BUTTONS", $GLOBALS['plugin']->getButtons());

// get updates
$sql = sprintf("SELECT package_id,module_id,version,reqversion FROM %s ORDER BY package_id, module_id ASC", $GLOBALS['plugin']->getTable('updates'));
$result = XT::query($sql,__FILE__,__LINE__);
$updates = array();
$i = 0;

while ($row = $result->FetchRow()) {
    $updates[$i++] = $row;
}

$GLOBALS['tpl']->assign('UPDATES', $updates);
$content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'updates.tpl');
?>