<?php
// Set Base id
$GLOBALS['plugin']->setBaseID(9200);

// Plugin tables
XT::addTable('microshop_display');
XT::addTable('microshop_pages');
XT::addTable('microshop_productpage');
XT::addTable('microshop_products');
XT::addTable('microshop_textpage');
XT::addTable('microshop_order_history');


// Plugin admin tabs
$GLOBALS['plugin']->addTab('list','Displays','list.php',true,true);
$GLOBALS['plugin']->addTab('edit_display','','edit_display.php',false,false);
$GLOBALS['plugin']->addTab('edit_textpage','','edit_textpage.php',false,false);
$GLOBALS['plugin']->addTab('edit_productpage','','edit_productpage.php',false,false);
$GLOBALS['plugin']->addTab('order_history','','order_history.php',false,false);
$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);

$GLOBALS['plugin']->enablePermissions();

XT::addConfig("pagetypes",array(0 => "textpage", 1 => "productpage", 3 => "orderpage"));
$defaults['pm_email'] = "fgaechter@iframe.ch";
$defaults['currency'] = "CHF";
$defaults['meta_description'] = "Default Display description";
$defaults['meta_keywords'] = "Default Keywords for Display ";

XT::addConfig("defaults",$defaults);
XT::addConfig("image_picker_base_id", 240, "");
XT::addConfig("image_picker_tpl", 597, "");