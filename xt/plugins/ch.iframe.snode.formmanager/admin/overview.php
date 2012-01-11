<?php
XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order("id,title","title",1,"list");
$order->setListener("sort","sortby");

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

// Enable Char filter and navigator
XT::enableAdminCharFilter('title');
XT::enableAdminNavigator('forms');

$result = XT::query("
    SELECT
        id,
        title,
        active
    FROM
        " . $GLOBALS['plugin']->getTable("forms") .  "
    WHERE
        lang = 'de'
        " . XT::getAdminCharFilter('AND') . "
    " . $order->get() . "
    LIMIT
            " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);


XT::assign("DATA", XT::getQueryData($result));
XT::assign("VIEWER_TPL", $GLOBALS['plugin']->getConfig('viewer_tpl'));

$content = XT::build("overview.tpl");

?>