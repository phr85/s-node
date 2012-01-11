<?php

$GLOBALS['plugin']->addTable('price','shop_articles','detail informations for the articles', false);
$GLOBALS['plugin']->addTable('staffelpreise','shop_articles_staffelpreise','detail informations for the articles', false);
$GLOBALS['plugin']->addTable('taxes','shop_taxes','', false);
$GLOBALS['plugin']->addTable('taxes_details','shop_taxes_details','', false);
$GLOBALS['plugin']->addTable('discounts','shop_discounts','', false);
$GLOBALS['plugin']->addTable('discounts_details','shop_discounts_details','', false);
$GLOBALS['plugin']->addTable('discounts_articles','shop_discounts_articles','', false);
$GLOBALS['plugin']->addTable('promo','shop_promo','', false);
$GLOBALS['plugin']->addTable('promo_details','shop_promo_details','', false);
$GLOBALS['plugin']->addTable('promo_articles','shop_promo_articles','', false);
$GLOBALS['plugin']->addTable('promo_gifts','shop_promo_gifts','', false);
$GLOBALS['plugin']->addTable('orders','shop_orders','', false);
$GLOBALS['plugin']->addTable('orders_details','shop_orders_details','', false);
$GLOBALS['plugin']->addTable('shop_articles','shop_articles','product of month and present', false);
$GLOBALS['plugin']->addTable('fields','catalog_articles_fields','Additional fields for the articles', false);
$GLOBALS['plugin']->addTable('fieldnames','catalog_articles_fieldnames','Additional fields for the articles', false);


// Catalog tables
$GLOBALS['plugin']->addTable('catalog_images','catalog_articles_images','Images for the articles', false);
$GLOBALS['plugin']->addTable('catalog_articles','catalog_articles','Description', false);
$GLOBALS['plugin']->addTable('catalog_articles_details','catalog_articles_details','detail informations for the articles', false);
$GLOBALS['plugin']->addTable('catalog_tree_articles','catalog_tree_articles','detail informations for the articles', false);
$GLOBALS['plugin']->addTable('catalog_tree_nodes','catalog_tree_nodes','detail informations for the articles', false);
$GLOBALS['plugin']->addTable('files','files','detail informations for the articles', false);

// Units
$GLOBALS['plugin']->addTable('units'    ,'units'           ,'Units main table'     , false);
$GLOBALS['plugin']->addTable('units_det','units_details'   ,'Units details table'  , false);

// Customers
$GLOBALS['plugin']->addTable('customers','addresses' ,'Customers table'    , false);


// Files
$GLOBALS['plugin']->addTable('files','files','Main files table', false);
$GLOBALS['plugin']->addTable('files_rel','files_rel','Main files relation to nodes table', false);
$GLOBALS['plugin']->addTable('files_details','files_details','Main files relation to nodes table', false);
$GLOBALS['plugin']->addTable('files_versions','files_versions','Version files table', false);

// shop settings
$GLOBALS['plugin']->addConfig("min_order_value", 100, "Minimal order value in base currency");
$GLOBALS['plugin']->addConfig("base_currency", 'chf' , "Base currency");
$GLOBALS['plugin']->addConfig("taxes", 'ex', ""); //inc or ex
$GLOBALS['plugin']->addConfig("taxvalue", 7.6, "");
$GLOBALS['plugin']->addConfig("taxtype", 0, "0=prices are excl. 1=prices are inc");


// Allowed countrys
$GLOBALS['plugin']->addConfig("allowed_countries", array('CH','US'), "");

// mail addresses
XT::addConfig('shopadmin','vzaech@s-node.org');
XT::addConfig('shopadmin_name','Shop Administrator');
XT::addConfig('shopadmin_replyAddr','vzaech@s-node.org');

XT::addConfig('shopoperator','vzaech@iframe.ch');
XT::addConfig('shopoperator_name','Shop');




$gift[1] = 1500000; // give gift at this price
$gift[2] = 3900000;
$GLOBALS['plugin']->addConfig("gift", $gift, "");



$transportcost[0] = 6;
$transportcost[100] = 9;
$transportcost[200] = 0;
$GLOBALS['plugin']->addConfig("transportcost", $transportcost, "");

if (!function_exists(getTransportCost)){
    function getTransportCost($price){
        foreach ($GLOBALS['plugin']->getConfig("transportcost") as $from => $cost) {
            if($price > $from){
                $tcost = $cost;
            }
        }
        return $tcost;
    }
}
?>