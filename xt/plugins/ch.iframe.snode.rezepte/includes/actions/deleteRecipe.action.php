<?php
$GLOBALS['plugin']->setAdminModule('la');

// Searchindex
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex(XT::getValue('id'),$GLOBALS['plugin']->getContentType('Recipe'),1,'global');
foreach ($GLOBALS['cfg']->getLangs() as $key => $lang){
    $search->setLang($key);
    $search->delete();
}

// Delete from main table
XT::query("DELETE FROM
               " . XT::getTable('rezepte') . "
           WHERE
               id=" . XT::getValue('id')
          ,__FILE__,__LINE__);
// Delete from detail table
XT::query("DELETE FROM
               " . XT::getTable('r_details') . "
           WHERE
               id=" . XT::getValue('id')
           ,__FILE__,__LINE__);
XT::log("Recipe " . XT::getValue('id') . " has been <b>deleted</b>.",__FILE__,__LINE__,XT_INFO);


// delete from tree (browser)
$result = XT::query("SELECT node_id FROM
               " . XT::getTable('r2tree') . "
           WHERE
               recipe_id=" . XT::getValue('id')
          ,__FILE__,__LINE__);

$GLOBALS['plugin']->setValue('recipe_id',XT::getValue('id'));
while($row = $result->FetchRow()){
    $data = XT::getQueryData(XT::query("SELECT position FROM " . XT::getTable('r2tree') . " where node_id=" . $row['node_id'] . " AND recipe_id = " . XT::getValue('id'),__FILE__,__LINE__,0));
    XT::query("DELETE FROM " . XT::getTable('r2tree') . " where node_id=" . $row['node_id'] . " AND recipe_id = " . XT::getValue('id'),__FILE__,__LINE__,0);
    XT::query("UPDATE " . XT::getTable('r2tree') . " SET position = position-1 where node_id=" . $row['node_id'] . " AND position > " . ($data[0]['position']) ,__FILE__,__LINE__,0);
}


?>