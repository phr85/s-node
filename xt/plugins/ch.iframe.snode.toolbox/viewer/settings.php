<?php
// Add buttons
XT::addImageButton('Save','saveSettings','default','disk_blue.png','settings');

// Get the information about the page
$result = XT::query("SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("navigation_details") . "
    WHERE
        node_id = " . $GLOBALS['tpl_id']. "
        AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);

// Initialize field arrays
$fields_info = array();
$node_id = 0;
$resultcount = 0;
while($row = $result->FetchRow()){

	$resultcount++;
    // Template file
    if($row['tpl_file'] == ''){
        $row['tpl_file'] = '_pages/' . $row['node_id'] . '_' . $GLOBALS['plugin']->getActiveLang() . '.tpl';
    }

    // Half decay period
    if($row['halflife'] >= 3600){
        $row['halflife_mode'] = 3600;
    }
    if($row['halflife'] >= 86400){
        $row['halflife_mode'] = 86400;
    }
    if($row['halflife'] >= 2592000){
        $row['halflife_mode'] = 2592000;
    }
    if($row['halflife'] >= 31536000){
        $row['halflife_mode'] = 31536000;
    }
    $row['halflife'] = @floor($row['halflife'] / $row['halflife_mode']);

    $row['mod_user'] = XT::getUserName($row['mod_user']);
    $row['c_user'] = $row['creation_user'];
    $row['creation_user'] = XT::getUserName($row['creation_user']);

    $node_id = $row['node_id'];
    $nav_active = $row['active'];

    /*
    $GLOBALS['usr']->getUserString(
    */
    XT::assign("DATA", $row);
}

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

// Get Pid
$sql = "SELECT pid FROM " . $GLOBALS['plugin']->getTable('navigation') . " WHERE id = " . $GLOBALS['tpl_id'] ;
$result = XT::query($sql, __FILE__, __LINE__);
$row = $result->fetchRow();
XT::assign("PID", $row['pid']);
?>