<?php
if(is_numeric($GLOBALS['plugin']->getValue("node_id"))){
    include_once(CLASS_DIR . 'tree.class.php');
    $tree = new XT_Tree("articles_tree");
    $deleted_nodes = $tree->nodeDelete($GLOBALS['plugin']->getValue("node_id"));

    // Get ID's of deleted nodes
    $nodes = array();
    foreach($deleted_nodes as $values){
        $nodes[] = $values['id'];
    }
    
    // Delete node permissions
    XT::query("DELETE FROM " . $GLOBALS['cfg']->get("database","prefix") . "node_perms WHERE
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND 
        base_id = " . $GLOBALS['plugin']->getBaseID() . " AND
        node_id IN (" . implode(',',$nodes) . ")",__FILE__,__LINE__);

    // Delete node details
    XT::query("DELETE FROM " . XT::getTable("articles_tree_details") . " WHERE
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND 
        node_id IN (" . implode(',',$nodes) . ")",__FILE__,__LINE__);
    
    // Get all articles
    $result = XT::query("
        SELECT 
            article_id 
        FROM 
            " . XT::getTable("articles_tree_rel") . " 
        WHERE
            node_id IN (" . implode(',',$nodes) . ")
    ",__FILE__,__LINE__);
    
    $tmp_data = array();
    $to_delete = array();
    while($row = $result->FetchRow()){
        $to_delete[$row['article_id']] = true;
        if(in_array($row['article_id'],$tmp_data)){
            unset($to_delete[$row['article_id']]);
        } else {
            $tmp_data[] = $row['article_id'];
        }
    }
    
    // Delete node details relations
    XT::query("DELETE FROM " . XT::getTable("articles_tree_rel") . " WHERE
        node_id IN (" . implode(',',$nodes) . ")
    ",__FILE__,__LINE__);
    
    $to_delete = array_keys($to_delete);
    
    // Delete articles
    if(sizeof($to_delete) > 0){
        // Delete articles
        XT::query("DELETE FROM " . XT::getTable("articles") . " WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id IN (" . implode(',',$to_delete) . ")",__FILE__,__LINE__);
        XT::query("DELETE FROM " . XT::getTable("articles_v") . " WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id IN (" . implode(',',$to_delete) . ")",__FILE__,__LINE__);
        XT::query("DELETE FROM " . XT::getTable("articles_chapters") . " WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id IN (" . implode(',',$to_delete) . ")",__FILE__,__LINE__);
        XT::query("DELETE FROM " . XT::getTable("articles_chapters_v") . " WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id IN (" . implode(',',$to_delete) . ")",__FILE__,__LINE__);
        
        foreach($to_delete as $article_id){
            XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
            $search = new XT_SearchIndex($article_id,$GLOBALS['plugin']->getContentType("Article"),0);
            $search->setLang($GLOBALS['plugin']->getActiveLang());
            $search->delete();
        }
    }
}
?>