<?php
XT::loadClass("ordering.class.php","ch.iframe.snode.core");

$order = new XT_Order("id,title","id",1,"overview");

$order->setListener("sort","sortby");

XT::enableAdminNavigator('poll','',"
    SELECT
        count(id) as count_id
    FROM
        " . XT::getTable('poll') . "
    WHERE
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
");

// SQL
$result = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('poll') . "
    WHERE
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    " . $order->get() . "
    LIMIT
        " . $GLOBALS['plugin']->getLimiter() . "
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}
XT::assign("DATA", $data);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build("archive.tpl");
?>