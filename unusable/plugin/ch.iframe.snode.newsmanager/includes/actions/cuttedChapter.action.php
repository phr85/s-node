<?php

$newlevel = $GLOBALS['plugin']->getValue('newlevel');
$origlevel = $GLOBALS['plugin']->getValue('origlevel');
$id = $GLOBALS['plugin']->getSessionValue('id');

//if($GLOBALS['plugin']->getValue('newlevel')==$GLOBALS['plugin']->getValue('origlevel')||(($GLOBALS['plugin']->getValue('newlevel')-1)==$GLOBALS['plugin']->getValue('origlevel'))){
    // Do nothing
//} else {
    $result = XT::query("UPDATE " . XT::getTable('newsmanager_chapters_v') . " SET level = (level+1) WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND level > " . $newlevel . " AND id=" . $id . " order by level desc",__FILE__,__LINE__);
    if($newlevel < $origlevel){
        $result = XT::query("UPDATE " . XT::getTable('newsmanager_chapters_v') . " SET level = " . ($newlevel+1) . " WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND level = " . ($origlevel+1) . " AND id=" . $id,__FILE__,__LINE__);
    }else{
        $result = XT::query("UPDATE " . XT::getTable('newsmanager_chapters_v') . " SET level = " . ($newlevel+1) . " WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND level = " . $origlevel . " AND id=" . $id,__FILE__,__LINE__);
    }
    $result = XT::query("UPDATE " . XT::getTable('newsmanager_chapters_v') . " SET level = (level-1) WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND level > " . $origlevel . " AND id=" . $id . " order by level asc",__FILE__,__LINE__);
//}
        
$GLOBALS['plugin']->setAdminModule("e");
?>