<?php

XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order("id,title","title",1,"scripts");
$order->setListener("sort","sortby");

// Enable Char filter and navigator
XT::enableAdminCharFilter('title');
XT::enableAdminNavigator('forms_scripts');

// Add buttons
XT::addImageButton('Add script','addScript','default','scroll_add.png','0','slave1');

// Get scripts
$result = XT::query("
    SELECT
        id,
        title
    FROM
        " . XT::getTable("forms_scripts") .  "
        " . XT::getAdminCharFilter() . "
     " . $order->get() . "
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
",__FILE__,__LINE__);
    

XT::assign("SCRIPTS", XT::getQueryData($result));

$content = XT::build('scripts.tpl');

?>