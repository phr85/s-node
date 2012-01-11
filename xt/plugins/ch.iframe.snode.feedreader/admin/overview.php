<?php
XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order("creation_date,title,url","title",1,"list");
$order->setListener("sort","sortby");

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

// Buttons
$GLOBALS['plugin']->contribute("overview_buttons", "Add Feed", "addFeed","add.png","0","slave1");
// Get Feeds
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable('feedreader_feeds') . "
    " . $order->get() . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("DATA", $data);

$content = XT::build('overview.tpl');

?>