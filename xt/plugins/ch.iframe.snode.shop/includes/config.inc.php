<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(2400);



// TPL Definitions for login, register,...
$sidenav['login']['TPL'] = 167;
$sidenav['login']['txt'] = 'login';
$sidenav['register']['TPL'] = 166;
$sidenav['register']['txt'] = 'register';
$sidenav['directorder']['TPL'] = 169;
$sidenav['directorder']['txt'] = 'register';
$GLOBALS['plugin']->addConfig("sidenav", $sidenav, "Sidenavigation shop");

// Plugin tables
include_once('config.ext.inc.php');

// Plugin admin tabs
$GLOBALS['plugin']->addTab('do','discounts','discounts_overview.php',true,true);
$GLOBALS['plugin']->addTab('de','edit discounts','discounts_edit.php',false,false);
$GLOBALS['plugin']->addTab('promo','promo','promo_overview.php',true,true);
$GLOBALS['plugin']->addTab('promoedit','edit promo','promo_edit.php',false,false);
$GLOBALS['plugin']->addTab('ta','Taxes','taxes_overview.php',false,true);
$GLOBALS['plugin']->addTab('tae','Edit taxes','taxes_edit.php',false,false);
$GLOBALS['plugin']->addTab('slave1','Slave1 Overview','slave1.php',false,false);


//Catalog data
$GLOBALS['plugin']->addConfig("catalogBaseId", 1200, "");
$GLOBALS['plugin']->addConfig("article_details_tpl", 468, "");


// Article picker
$GLOBALS['plugin']->addConfig("article_picker_base_id", 1200, "");
$GLOBALS['plugin']->addConfig("article_picker_tpl", 147, "");

$op[1]['tpl'] = 162;
$op[1]['label'] = $GLOBALS['lang']->msg('Your Basket');
$op[2]['tpl'] = 163;
$op[2]['label'] = $GLOBALS['lang']->msg('Address');
$op[3]['tpl'] = 164;
$op[3]['label'] = $GLOBALS['lang']->msg('Check');
$op[4]['tpl'] = 165;
$op[4]['label'] = $GLOBALS['lang']->msg('Finish');


$GLOBALS['plugin']->addConfig("paypal_account", 'vzaech@iframe.ch', "");
$GLOBALS['plugin']->addConfig("paypal_subject", 'Licence from S-Node.org', "");
$GLOBALS['plugin']->addConfig("paypal_return_page", 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?TPL=' . $op[3]['tpl'], "");
$GLOBALS['plugin']->addConfig("paypal_cancel_return_page", 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?TPL=' . $op[1]['tpl'], "");


// Orderprocess
$GLOBALS['plugin']->addConfig("orderprocess", $op, "");

// Picture picker
$GLOBALS['plugin']->addConfig("image_picker_base_id", 240, "");
$GLOBALS['plugin']->addConfig("image_picker_tpl", 597, "");

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();

// Content Type
$GLOBALS['plugin']->addContentType(7,'Product');

?>
