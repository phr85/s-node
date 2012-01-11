<?php
//die (XT::getValue("lang_filter"));
$GLOBALS['plugin']->getActiveLang();
// Get mode
$mode = XT::getValue('entry_mode');

// Set query addition
if($mode == 'after'){
    $query = ' > ' . XT::getValue('entry_pos');
} else {
    $query = ' >= ' . XT::getValue('entry_pos');
}

// Update positions of existing entries
XT::query("
    UPDATE
        " . XT::getTable('navigation_contents') . "
    SET
        position = position + 1
    WHERE
        position " . $query . "
        AND node_id = '" . XT::getValue('node_id') . "'
",__FILE__,__LINE__);

if($mode == 'after'){
    XT::setValue('insert_pos', XT::getValue('entry_pos') + 1);
} else {
    XT::setValue('insert_pos', XT::getValue('entry_pos'));
}

XT::unsetSessionValue('ctrl');
if (XT::getValue('livetpl') != 1) {
	XT::call('savePage');
}
$GLOBALS['plugin']->setAdminModule('acs');

?>