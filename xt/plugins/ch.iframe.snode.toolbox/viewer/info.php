<?php
// Add buttons
XT::addImageButton('Save','saveInfo','default','disk_blue.png','info');

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

  // get available header / footer templates
foreach (glob(TEMPLATE_DIR . '/default/includes/header/*.tpl') as $usertpls){
   $USER_TPL['HEADERS'][trim(basename($usertpls))]= 'system';
}

foreach (glob(TEMPLATE_DIR . $_SESSION['theme'] . '/includes/header/*') as $usertpls){
    $USER_TPL['HEADERS'][trim(basename($usertpls))]= $_SESSION['theme'];
}

foreach (glob(TEMPLATE_DIR . '/default/includes/footer/*.tpl') as $usertpls){
   $USER_TPL['FOOTERS'][trim(basename($usertpls))]= 'system';
}

foreach (glob(TEMPLATE_DIR . $_SESSION['theme'] . '/includes/footer/*') as $usertpls){
    $USER_TPL['FOOTERS'][trim(basename($usertpls))]= $_SESSION['theme'];
}

XT::assign("USERTPL",$USER_TPL);

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

?>
