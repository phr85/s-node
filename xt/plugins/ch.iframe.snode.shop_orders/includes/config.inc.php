<?php
// Lizenz vorausladen weil es mit shop gebaut wurde
if(function_exists("zend_loader_install_license")){
    @zend_loader_install_license(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . "_ch.iframe.snode.shop.zl",1);
}

// Set Base id
$GLOBALS['plugin']->setBaseID(2500);

// Set tables
$GLOBALS['plugin']->addTable('shop_orders','shop_orders','',false);
$GLOBALS['plugin']->addTable('order_details','shop_orders_details','', false);
$GLOBALS['plugin']->addTable('customers_persons','addresses','',false);
$GLOBALS['plugin']->addTable('articles','catalog_articles','informations for the articles', false);
$GLOBALS['plugin']->addTable('articles_details','catalog_articles_details','detail informations for the articles', false);
$GLOBALS['plugin']->addTable('prices','shop_articles','detail informations for the articles', false);

// Tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);
$GLOBALS['plugin']->addTab('details','details','order_details.php',false,false);

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();

// Content Type
$GLOBALS['plugin']->addContentType(7,'Product');

?>
