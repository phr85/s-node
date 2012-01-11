<?php

include_once(CLASS_DIR . 'tree.class.php');
$tree = new XT_Tree("forum_categories");

switch($GLOBALS['plugin']->getValue("position")){
    case 'into':
        if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
            $newid = $tree->addChildNode($GLOBALS['plugin']->getValue("node_id"));
        }
        if($GLOBALS['plugin']->getSessionValue("ctrl_cut")){
            $newid = $tree->moveNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'last');
        }
        break;
    case 'before':
        if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
            $newid = $tree->addNode($GLOBALS['plugin']->getValue("node_id"),"before");
        }
        if($GLOBALS['plugin']->getSessionValue("ctrl_cut")){
            $newid = $tree->moveNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'before');
        }
 
        break;

    case 'after':
        if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
            $newid = $tree->addNode($GLOBALS['plugin']->getValue("node_id"),"after");
        }
        if($GLOBALS['plugin']->getSessionValue("ctrl_cut")){
            $newid = $tree->moveNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'after');
        }
 
        break;
}

if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
    foreach($GLOBALS['cfg']->getLangs() as $key => $value){
        XT::query("
    INSERT INTO
        " . $GLOBALS['cfg']->get("database","prefix") . "node_perms
    (
        base_id,
        node_id,
        principal_id,
        principal_type,
        perms,
        lang
    ) VALUES (
        " . $GLOBALS['plugin']->getBaseID() . ",
        " . $newid . ",
        " . XT::getUserID() . ",
        1,
        1048575,
        '" . $key . "'
    )",__FILE__,__LINE__);


        XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable("forum_categories_details") . "
    (
        node_id,
        title,
        description,
        lang
    ) VALUES (
        " . $newid . ",
        NULL,
        NULL,
        '" . $key . "'
    )
    ",__FILE__,__LINE__);
    }
    $GLOBALS['plugin']->setValue("node_id", $newid);
    $GLOBALS['plugin']->setAdminModule("ec");
}



if($GLOBALS['plugin']->getSessionValue("ctrl_cutforum")){
    XT::query("update " . $GLOBALS['plugin']->getTable("forum_forums") . " set  
            `category_id`='" . $GLOBALS['plugin']->getValue("node_id") . "',  
            `mod_date`=" . time() . "  
             where `id`='" . XT::getSessionValue('forum_id') . "'",__FILE__,__LINE__);
}

if($GLOBALS['plugin']->getSessionValue("ctrl_addforum")){

    
    XT::query("insert into  " . $GLOBALS['plugin']->getTable("forum_forums") . " 
     ( `id`, `category_id`, `title`, `description`, `topic_count`, `posting_count`, `lastentry_user`, `lastentry_date`, `lastentry_topic`, `lastentry_posting`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `lastentry_posting_title`, `active`, `image`, `image_version` ) 
     
     values 
     
     ( '',  '" . $GLOBALS['plugin']->getValue("node_id") . "', '',  '',  '0',  '0',  '0',  '" . time() . "',  '0',  '0',  '" . time() . "',  '0',  '" . time() . "',  '0',  '',  '1',  '0',  '0' )
    ",__FILE__,__LINE__);
    
    
    $result = XT::query("select max(id) as id from  " . $GLOBALS['plugin']->getTable("forum_forums"),__FILE__,__LINE__);
    $newid = XT::getQueryData($result);
    $GLOBALS['plugin']->setValue("id", $newid[0]['id']);
    $GLOBALS['plugin']->setAdminModule("ef");
}

 
$GLOBALS['plugin']->unsetSessionValue("ctrl_add");
$GLOBALS['plugin']->unsetSessionValue("ctrl_cut");
$GLOBALS['plugin']->unsetSessionValue("ctrl_cutforum");
$GLOBALS['plugin']->unsetSessionValue("ctrl_addforum");
?>
