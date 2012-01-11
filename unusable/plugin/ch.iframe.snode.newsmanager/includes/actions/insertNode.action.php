<?php

include_once(CLASS_DIR . 'tree.class.php');
$tree = new XT_Tree("newsmanager_tree");

switch($GLOBALS['plugin']->getValue("position")){
    case 'into':
    if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
        $newid = $tree->addChildNode($GLOBALS['plugin']->getValue("node_id"));
        $GLOBALS['plugin']->setAdminModule("en");
    }
    if($GLOBALS['plugin']->getSessionValue("ctrl_cut")){
        $newid = $tree->moveNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'last');
    }
    if($GLOBALS['plugin']->getSessionValue("ctrl_cut_entry")){
        // Update relation
        XT::query("UPDATE " . $GLOBALS['cfg']->get("database","prefix") . "newsmanager_tree_rel
             SET
                 node_id= " . $GLOBALS['plugin']->getValue("node_id") . "
             WHERE 
                node_id = " . XT::getSessionValue('source_node_id') . "
            AND
                news_id = " . XT::getSessionValue('source_entry_id') 
        ,__FILE__,__LINE__);
    }

    if($GLOBALS['plugin']->getSessionValue("ctrl_copy")){
        $newid = $tree->copyNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'last');
        // Copy the entries
        foreach ($newid as $copyelements) {
            // select all elements from original node
            $result = XT::query("SELECT news_id as id FROM " . XT::getTable('newsmanager_tree_rel') . " WHERE node_id =" . $copyelements['original'],__FILE__,__LINE__);
            while($row = $result->FetchRow()){
                // copy each news into copy node
                duplicate_entry($row['id'],$copyelements['original'],$copyelements['copy']);
            }
        }
    }
    if($GLOBALS['plugin']->getSessionValue("ctrl_copy_entry")){
        // copy the entry
        duplicate_entry(XT::getSessionValue('source_entry_id'),XT::getSessionValue('source_node_id'),$GLOBALS['plugin']->getValue("node_id"));
    }
    break;
    case 'before':
    if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
        $newid = $tree->addNode($GLOBALS['plugin']->getValue("node_id"),"before");
        $GLOBALS['plugin']->setAdminModule("en");
    }
    if($GLOBALS['plugin']->getSessionValue("ctrl_cut")){
        $newid = $tree->moveNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'before');
    }
    if($GLOBALS['plugin']->getSessionValue("ctrl_copy")){
        $newid = $tree->copyNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'before');
        // Copy the entries
        foreach ($newid as $copyelements) {
            // select all elements from original node
            $result = XT::query("SELECT news_id as id FROM " . XT::getTable('newsmanager_tree_rel') . " WHERE node_id =" . $copyelements['original'],__FILE__,__LINE__);
            while($row = $result->FetchRow()){
                // copy each news into copy node
                duplicate_entry($row['id'],$copyelements['original'],$copyelements['copy']);
            }
        }
    }
    break;
    case 'after':
    if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
        $newid = $tree->addNode($GLOBALS['plugin']->getValue("node_id"),"after");
        $GLOBALS['plugin']->setAdminModule("en");
    }
    if($GLOBALS['plugin']->getSessionValue("ctrl_cut")){
        $newid = $tree->moveNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'after');
    }
    if($GLOBALS['plugin']->getSessionValue("ctrl_copy")){
        $newid = $tree->copyNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'after');
        // Copy the entries
        foreach ($newid as $copyelements) {
            // select all elements from original node
            $result = XT::query("SELECT news_id as id FROM " . XT::getTable('newsmanager_tree_rel') . " WHERE node_id =" . $copyelements['original'],__FILE__,__LINE__);
            while($row = $result->FetchRow()){
                // copy each news into copy node
                duplicate_entry($row['id'],$copyelements['original'],$copyelements['copy']);
            }
        }
    }
    break;
}

if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
    /*
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
    }
    */
    $GLOBALS['plugin']->setValue("node_id", $newid);

    // Create detail row
    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('newsmanager_tree_details') . "
        (
            node_id,
            lang,
            creation_user,
            creation_date
        ) VALUES (
            " . $GLOBALS['plugin']->getValue('node_id') . ",
            '" . $GLOBALS['plugin']->getActiveLang() . "',
            '" . $GLOBALS['auth']->getUserID() . "',
            '" . time() . "'
        )
    ");
}

if($GLOBALS['plugin']->getSessionValue("ctrl_copy")){

    foreach($newid as $value){

        // Get node details
        $result = XT::query("
            SELECT
                *
            FROM
                " . $GLOBALS['plugin']->getTable('newsmanager_tree_details') . "
            WHERE
                node_id = " . $value['original'] . "
            ",__FILE__,__LINE__);

        while($row = $result->FetchRow()){

            XT::query("
                INSERT INTO
                    " . $GLOBALS['plugin']->getTable('newsmanager_tree_details') . "
                (
                    node_id,
                    lang,
                    title,
                    description,
                    creation_user,
                    creation_date,
                    mod_user,
                    mod_date,
                    active,
                    public
                ) VALUES (
                    " . $value['copy'] . ",
                    '" . $row['lang'] . "',
                    '" . addslashes($row['title']) . "',
                    '" . addslashes($row['description']) . "',
                    " . XT::getUserID() . ",
                    " . time() . ",
                    " . XT::getUserID() . ",
                    " . time() . ",
                    1,
                    '" . $row['public'] . "'
                )
            ",__FILE__,__LINE__,0);

        }

    }
}

$GLOBALS['plugin']->unsetSessionValue("ctrl_add");
$GLOBALS['plugin']->unsetSessionValue("ctrl_cut");
$GLOBALS['plugin']->unsetSessionValue("ctrl_copy");
$GLOBALS['plugin']->unsetSessionValue("ctrl_copy_entry");
$GLOBALS['plugin']->unsetSessionValue("ctrl_cut_entry");

function duplicate_entry($entry_id,$original_node,$copy_node){
    // read newsmanager_v and newsmanager_chapters_v
    $result_news = XT::query("SELECT * FROM " . XT::getTable('newsmanager_v') . " WHERE id=" . $entry_id . " AND latest=1",__FILE__,__LINE__);

    // insert into news newsmanager_chapters and newsmanager_v and newsmanager_chapters_v aND langs
    // get the new ID
    $result = XT::query("SELECT MAX(id) as maxid FROM " . $GLOBALS['plugin']->getTable('newsmanager'),__FILE__,__LINE__);
    $row = $result->FetchRow();
    $new_id = $row['maxid'] + 1;
    while ($row_news = $result_news->FetchRow()) {
        // Add a Entry in the live table and get the ID
        XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('newsmanager') . " (id, creation_date,creation_user,lang) VALUES (" . $new_id . "," . time() . "," . XT::getUserID() . ",'" . $row_news['lang'] . "')",__FILE__,__LINE__);
        XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('newsmanager_v') . " (id, creation_date,creation_user,lang) VALUES (" . $new_id . "," . time() . "," . XT::getUserID() . ",'" . $row_news['lang'] . "')",__FILE__,__LINE__);

        XT::query("
        UPDATE
            " . XT::getTable('newsmanager_v') . "
        SET
            title = '" . addslashes($row_news['title']) . "',
            subtitle = '" . addslashes($row_news['subtitle']) . "',
            autor = '" . $row_news['autor'] . "',
            introduction = '" . addslashes($row_news['introduction']) . "',
            maintext = '" . addslashes($row_news['maintext']) . "',
            image = '" . $row_news['image'] . "',
            image_version = '" . $row_news['image_version'] . "',
            image_link = '" . $row_news['image_link'] . "',
            image_link_target = '" . $row_news['image_link_target'] . "',
            image_zoom = '" . $row_news['image_zoom'] . "',
            rid = '1',
            lang = '" . $row_news['lang'] . "',
            active = 0,
    	    mod_date = '" . time() . "',
    	    mod_user = '" . XT::getUserID() . "',
    	    latest = 1
        WHERE
            id = " . $new_id . " AND
            lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        ",__FILE__,__LINE__);


        XT::query("INSERT into " . XT::getTable('newsmanager_tree_rel') . "
             (node_id, news_id) VALUES (" . $copy_node . "," . $new_id . ")" ,__FILE__,__LINE__);
        $result_newsmanager_chapters = XT::query("SELECT * FROM " . XT::getTable('newsmanager_chapters_v') . " WHERE id=" . $entry_id . " AND rid=" . $row_news['rid'] ,__FILE__,__LINE__);

        while($chapter = $result_newsmanager_chapters->FetchRow()){
            XT::query("
                INSERT INTO
                    " . XT::getTable('newsmanager_chapters_v') . "
                (
                    id,
                    level,
                    title,
                    subtitle,
                    maintext,
                    image,
                    image_version,
                    image_link,
                    image_link_target,
                    image_zoom,
                    active,
                    layout,
                    rid,
                    lang
                ) VALUES (
                    '" . $new_id . "', 
                    '" . $chapter['level'] . "',
                    '" . addslashes($chapter['title']) . "',
                    '" . addslashes($chapter['subtitle']) . "',
                    '" . addslashes($chapter['maintext']) . "',
                    '" . $chapter['image'] . "',
                    '" . $chapter['image_version'] . "',
                    '" . $chapter['image_link'] . "',
                    '" . $chapter['image_link_target'] . "',
                    '" . $chapter['image_zoom'] . "',
                    '" . $chapter['active'] . "',
                    '" . $chapter['layout'] . "',
                    '1',
                    '" . $chapter['lang'] . "'
                )
            ",__FILE__,__LINE__);

        }

    }

}
?>
