<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(1100);

// Plugin tables
$GLOBALS['plugin']->addTable('banner_zones','banner_zones','Banner zones', false);
$GLOBALS['plugin']->addTable('banner_zones_rel','banner_zones_rel','Banner zones relations', false);
$GLOBALS['plugin']->addTable('banner','banner','Banners', false);
$GLOBALS['plugin']->addTable('views','banner_views','Views', false);
$GLOBALS['plugin']->addTable('clicks','banner_clicks','Clicks', false);
$GLOBALS['plugin']->addTable('navigation_details','navigation_details','Pages', false);
XT::addTable('files');
XT::addTable('files_details');


$GLOBALS['plugin']->addContentType(1100, "Banner");
$GLOBALS['plugin']->addConfig("image_picker_base_id", 240, "");
$GLOBALS['plugin']->addConfig("image_picker_tpl", 597, "");

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('e','Edit zone','editZone.php',false,false);
$GLOBALS['plugin']->addTab('eb','Edit banner','editBanner.php',false,false);
$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);


// relations
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.relations.zl")){
    $display['relations']=true;
}

// log actions?
$GLOBALS['plugin']->addConfig("log_actions", false);

XT::assign("DISPLAY",$display);



// Load permissions
$GLOBALS['plugin']->enablePermissions();

?>
