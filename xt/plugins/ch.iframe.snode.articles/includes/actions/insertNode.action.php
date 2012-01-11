<?php

include_once(CLASS_DIR . 'tree.class.php');
$tree = new XT_Tree("articles_tree");

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
            XT::query("UPDATE " . $GLOBALS['cfg']->get("database","prefix") . "articles_tree_rel
             SET
                 node_id= " . $GLOBALS['plugin']->getValue("node_id") . "
             WHERE
                node_id = " . XT::getSessionValue('source_node_id') . "
            AND
                article_id = " . XT::getSessionValue('source_entry_id')
            ,__FILE__,__LINE__);

            if(XT::queryRowsAffected()==0){
                $arr = XT::getQueryData(XT::query("SELECT count(*) as cnt from " . XT::getTable("articles_tree_rel") . " WHERE article_id = " . XT::getSessionValue('source_entry_id'),__FILE__,__LINE__));
                if($arr[0]['cnt']==0){
                    XT::query("INSERT into  " . $GLOBALS['cfg']->get("database","prefix") . "articles_tree_rel
             SET
                 node_id= " . $GLOBALS['plugin']->getValue("node_id") . ",
                article_id = " . XT::getSessionValue('source_entry_id')
                    ,__FILE__,__LINE__);
                }
            }
        }

        if($GLOBALS['plugin']->getSessionValue("ctrl_copy")){
            $newid = $tree->copyNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'last');
            // Copy the entries
            foreach ($newid as $copyelements) {
                // select all elements from original node
                $result = XT::query("SELECT article_id as id FROM " . XT::getTable('articles_tree_rel') . " WHERE node_id =" . $copyelements['original'],__FILE__,__LINE__);
                while($row = $result->FetchRow()){
                    // copy each article into copy node
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
                $result = XT::query("SELECT article_id as id FROM " . XT::getTable('articles_tree_rel') . " WHERE node_id =" . $copyelements['original'],__FILE__,__LINE__);
                while($row = $result->FetchRow()){
                    // copy each article into copy node
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
                $result = XT::query("SELECT article_id as id FROM " . XT::getTable('articles_tree_rel') . " WHERE node_id =" . $copyelements['original'],__FILE__,__LINE__);
                while($row = $result->FetchRow()){
                    // copy each article into copy node
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
    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('articles_tree_details') . "
        (
            node_id,
            lang,
            creation_user,
            creation_date,
            public
        ) VALUES (
            " . $GLOBALS['plugin']->getValue('node_id') . ",
            '" . $GLOBALS['plugin']->getActiveLang() . "',
            '" . $GLOBALS['auth']->getUserID() . "',
            '" . time() . "',
            1
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
                " . $GLOBALS['plugin']->getTable('articles_tree_details') . "
            WHERE
                node_id = " . $value['original'] . "
            ",__FILE__,__LINE__);

        while($row = $result->FetchRow()){

            XT::query("
                INSERT INTO
                    " . $GLOBALS['plugin']->getTable('articles_tree_details') . "
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
    // read articles_v and articles_chapters_v
    $result_articles = XT::query("SELECT * FROM " . XT::getTable('articles_v') . " WHERE id=" . $entry_id . " AND latest=1",__FILE__,__LINE__);

    // insert into articles articles_chapters and articles_v and articles_chapters_v aND langs
    // get the new ID
    $result = XT::query("SELECT MAX(id) as maxid FROM " . $GLOBALS['plugin']->getTable('articles'),__FILE__,__LINE__);
    $row = $result->FetchRow();
    $new_id = $row['maxid'] + 1;

    while ($row_article = $result_articles->FetchRow()) {
    	// Copy Properties
        if (XT::getConfig('display_properties') == true) {
        	// Set the content type
        	XT::setValue("XT_PROP_content_type",XT::getContentType('Article'));
        	// Set the original content_id
        	XT::setValue('XT_PROP_content_id',$entry_id);
        	// Set the new content_id
        	XT::setValue('XT_PROP_target_content_id',$new_id);
        	// call the copy proces
        	XT::call('ch.iframe.snode.properties.copyPropertyValues');
        }
        
        // Add a Entry in the live table and get the ID
        XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('articles') . " (id, creation_date,creation_user,lang) VALUES (" . $new_id . "," . time() . "," . XT::getUserID() . ",'" . $row_article['lang'] . "')",__FILE__,__LINE__);
        XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('articles_v') . " (id, creation_date,creation_user,lang) VALUES (" . $new_id . "," . time() . "," . XT::getUserID() . ",'" . $row_article['lang'] . "')",__FILE__,__LINE__);

        XT::query("
        UPDATE
            " . XT::getTable('articles_v') . "
        SET
            title = '" . addslashes($row_article['title']) . "',
            date = '" . $row_article['date'] . "',
            subtitle = '" . addslashes($row_article['subtitle']) . "',
            autor = '" . $row_article['autor'] . "',
            introduction = '" . addslashes($row_article['introduction']) . "',
            maintext = '" . addslashes($row_article['maintext']) . "',
            image = '" . $row_article['image'] . "',
            image_version = '" . $row_article['image_version'] . "',
            image_link = '" . $row_article['image_link'] . "',
            image_link_target = '" . $row_article['image_link_target'] . "',
            image_zoom = '" . $row_article['image_zoom'] . "',
            rid = '1',
            lang = '" . $row_article['lang'] . "',
            active = 0,
    	    mod_date = '" . time() . "',
    	    mod_user = '" . XT::getUserID() . "',
    	    display_time_type= '" . $row_article['display_time_type'] . "',
    	    display_time_start= '" . $row_article['display_time_start'] . "',
    	    display_time_end= '" . $row_article['display_time_end'] . "',
			hide_title= '" . $row_article['hide_title'] . "',
    	    latest = 1
        WHERE
            id = " . $new_id . " AND
            lang = '" . $row_article['lang'] . "'
        ",__FILE__,__LINE__);

        $result_articles_chapters = XT::query("SELECT * FROM " .
        XT::getTable('articles_chapters_v') . " WHERE id=" . $entry_id . " AND rid=" . $row_article['rid'] . " AND lang = '" . $row_article['lang'] . "'" ,__FILE__,__LINE__);
        while($chapter = $result_articles_chapters->FetchRow()){
            XT::query("
                INSERT INTO
                    " . XT::getTable('articles_chapters_v') . "
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

        if(XT::getLang() ==$row_article['lang']){
            // set relation to tree
            XT::query("INSERT into " . XT::getTable('articles_tree_rel') . "
    (node_id, article_id) VALUES (" . $copy_node . "," . $new_id . ")" ,__FILE__,__LINE__);
        }
    }
}
?>