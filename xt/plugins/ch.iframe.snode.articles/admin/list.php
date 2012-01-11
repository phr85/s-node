<?php
XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order("id,title,rid,published","title",1,"list");
$order->setListener("sort","sortby");

XT::enableAdminNavigator('articles_v','',"
    SELECT
        count(id) as count_id
    FROM
        " . XT::getTable('articles_v') . "
    WHERE
        latest = 1 AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
");

if(XT::getPermission('add')){
    // Buttons
    XT::addImageButton("Add article", "addArticle","default","document_new.png",0,"slave1");
}
if($display['convert']){
    // converter for the new articles system
    $result = XT::query("
    SELECT
        count(*) as cnt
    FROM
        " . XT::getTable('articles_v') . "
    WHERE
        maintext is not NULL
    ORDER BY
        id ASC
    ",__FILE__,__LINE__);
    $old_articles = XT::getQueryData($result);
    if($old_articles[0]['cnt']>0){
        XT::addImageButton("Convert articles", "convertArticle","default","data_table.png",0);
    }
}
// SQL
$result = XT::query("
    SELECT
        id,
        title,
        subtitle,
        creation_date,
        active,
        locked,
        locked_user,
        locked_date,
        published,
        rid
    FROM
        " . XT::getTable('articles_v') . "
    WHERE
        latest = 1 AND
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

$content = XT::build("list.tpl");
?>