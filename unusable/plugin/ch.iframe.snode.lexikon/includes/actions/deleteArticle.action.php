<?php
$GLOBALS['plugin']->setAdminModule('la');

// Searchindex
include_once(CLASS_DIR . 'searchindex.class.php');
$search = new XT_SearchIndex($GLOBALS['plugin']->getValue('id'),$GLOBALS['plugin']->getContentType('Lexikon'),1,'global');
foreach ($GLOBALS['cfg']->getLangs() as $key => $lang){
    $search->setLang($key);
    $search->delete();
}

// Delete from main table
XT::query("DELETE FROM
               " . $GLOBALS['plugin']->getTable('articles') . "
           WHERE
               id=" . $GLOBALS['plugin']->getValue('id')
          ,__FILE__,__LINE__);
// Delete from detail table
XT::query("DELETE FROM
               " . $GLOBALS['plugin']->getTable('articles_details') . "
           WHERE
               id=" . $GLOBALS['plugin']->getValue('id')
           ,__FILE__,__LINE__);
XT::log("Article " . $GLOBALS['plugin']->getValue('id') . " has been <b>deleted</b>.",__FILE__,__LINE__,XT_INFO);


// delete from tree (browser)
$result = XT::query("SELECT node_id FROM
               " . $GLOBALS['plugin']->getTable('tree2articles') . "
           WHERE
               article_id=" . $GLOBALS['plugin']->getValue('id')
          ,__FILE__,__LINE__);

$GLOBALS['plugin']->setValue('article_id',$GLOBALS['plugin']->getValue('id'));
while($row = $result->FetchRow()){
    $data = XT::getQueryData(XT::query("SELECT position FROM " . $GLOBALS['plugin']->getTable('tree2articles') . " where node_id=" . $row['node_id'] . " AND article_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__,0));
    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('tree2articles') . " where node_id=" . $row['node_id'] . " AND article_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__,0);
    XT::query("UPDATE " . $GLOBALS['plugin']->getTable('tree2articles') . " SET position = position-1 where node_id=" . $row['node_id'] . " AND position > " . ($data[0]['position']) ,__FILE__,__LINE__,0);
}

// delete from fields
XT::query("DELETE FROM
               " . $GLOBALS['plugin']->getTable('fields') . "
           WHERE
               article_id=" . $GLOBALS['plugin']->getValue('id')
          ,__FILE__,__LINE__);


// delete from relations and delete relations
XT::query("DELETE FROM
               " . $GLOBALS['plugin']->getTable('articles_relations') . "
           WHERE
               article_id=" . $GLOBALS['plugin']->getValue('id') . "
           OR
               main_article_id=" . $GLOBALS['plugin']->getValue('id')
          ,__FILE__,__LINE__);

?>