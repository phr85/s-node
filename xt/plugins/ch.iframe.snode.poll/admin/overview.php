<?php
XT::loadClass("ordering.class.php","ch.iframe.snode.core");

$order = new XT_Order("date,id,title","id",-1,"overview");

$order->setListener("sort","sortby");

XT::enableAdminNavigator('poll','',"
    SELECT
        count(id) as count_id
    FROM
        " . XT::getTable('poll') . "
    WHERE
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
");

if(XT::getPermission('administrator')){
    // Buttons
    XT::addImageButton("Add poll", "addPoll","default","document_new.png",0,"slave1");
}

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

$content = XT::build('question_' . $style);
XT::assign("DATA", $data);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build("overview.tpl");
?>