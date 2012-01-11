<?php
XT::call('saveNewsletter');

$newlevel = $GLOBALS['plugin']->getValue('newlevel');
$origlevel = $GLOBALS['plugin']->getValue('origlevel');
$id = $GLOBALS['plugin']->getSessionValue('newsletter_id');


$result = XT::query("UPDATE " . XT::getTable('newsletter_chapters') . " SET level = (level+1) WHERE level > " . $newlevel . " AND id=" . $id . " order by level desc",__FILE__,__LINE__);
if($newlevel < $origlevel){
    $result = XT::query("UPDATE " . XT::getTable('newsletter_chapters') . " SET level = " . ($newlevel+1) . " WHERE  level = " . ($origlevel+1) . " AND id=" . $id,__FILE__,__LINE__);
}else{
    $result = XT::query("UPDATE " . XT::getTable('newsletter_chapters') . " SET level = " . ($newlevel+1) . " WHERE  level = " . $origlevel . " AND id=" . $id,__FILE__,__LINE__);
}
$result = XT::query("UPDATE " . XT::getTable('newsletter_chapters') . " SET level = (level-1) WHERE  level > " . $origlevel . " AND id=" . $id . " order by level asc",__FILE__,__LINE__);
 
$GLOBALS['plugin']->setAdminModule("e");
?>