<?php

XT::unlock($GLOBALS['plugin']->getSessionValue('id'), $GLOBALS['plugin']->getContentType('Article'));

$result = XT::query("select id, rid, published, latest from " . XT::getTable("articles_v") . " where id = " . XT::getSessionValue("id") . " and published=0 and `lang`='" . $GLOBALS['plugin']->getActiveLang() . "'",__FILE__,__LINE__);
if($row = $result->FetchRow()){
    if($row['rid']>1){
        //delete
        XT::query("delete from " . XT::getTable("articles_v") . " where id=" . XT::getSessionValue("id") . " and rid=" . $row['rid'] . " and `lang`='" . $GLOBALS['plugin']->getActiveLang() . "'",__FILE__,__LINE__);
        XT::query("delete from " . XT::getTable("articles_chapters_v") . " where id=" . XT::getSessionValue("id") . " and rid=" . $row['rid'] . " and `lang`='" . $GLOBALS['plugin']->getActiveLang() . "'",__FILE__,__LINE__);
        //set actual
        XT::query("update " . XT::getTable("articles_v") . " set latest=1 where id=" . XT::getSessionValue("id") . " and rid=" . ($row['rid']-1) . " and `lang`='" . $GLOBALS['plugin']->getActiveLang() . "'",__FILE__,__LINE__);
    }
}


if(isset($_SESSION['referer'])){
    $referer = $_SESSION['referer'];
    unset($_SESSION['referer']);
    header("Location: " . $referer . "&lang=" . $GLOBALS['plugin']->getActiveLang() . "");
} else {
    $GLOBALS['plugin']->setAdminModule("slave1");
}
?>