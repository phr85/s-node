<?php

include_once(CLASS_DIR . 'tree.class.php');
$tree = new XT_Tree("faq_tree");

switch(XT::getValue("position")){
    case 'into':
        if(XT::getSessionValue("ctrl_add")){
            $newid = $tree->addChildNode(XT::getValue("node_id"));
        }
        if(XT::getSessionValue("ctrl_cut")){
            $newid = $tree->moveNode(XT::getSessionValue("source_node_id"),XT::getValue("node_id"),'last');
        }
        if(XT::getSessionValue("ctrl_copy")){
            $newid = $tree->copyNode(XT::getSessionValue("source_node_id"),XT::getValue("node_id"),'last');
        }
	    if(XT::getSessionValue("ctrl_cut_entry")){

	        // Update relation
	        XT::query("UPDATE " . $GLOBALS['cfg']->get("database","prefix") . "faq2cat
	         SET
	            node_id= " . XT::getValue("node_id") . "
	         WHERE
	            node_id = " . XT::getSessionValue('source_node_id') . "
	        AND
	            faq_id = " . XT::getSessionValue('source_entry_id')
	        ,__FILE__,__LINE__);
	    }
	    if(XT::getSessionValue("ctrl_copy_entry")){
            // copy the entry
            duplicate_entry(XT::getSessionValue('source_entry_id'),XT::getSessionValue('source_node_id'),XT::getValue("node_id"));
        }
        break;
    case 'before':
        if(XT::getSessionValue("ctrl_add")){
            $newid = $tree->addNode(XT::getValue("node_id"),"before");
        }
        if(XT::getSessionValue("ctrl_cut")){
            $newid = $tree->moveNode(XT::getSessionValue("source_node_id"),XT::getValue("node_id"),'before');
        }
        if(XT::getSessionValue("ctrl_copy")){
            $newid = $tree->copyNode(XT::getSessionValue("source_node_id"),XT::getValue("node_id"),'before');
        }
        break;
    case 'after':
        if(XT::getSessionValue("ctrl_add")){
            $newid = $tree->addNode(XT::getValue("node_id"),"after");
        }
        if(XT::getSessionValue("ctrl_cut")){
            $newid = $tree->moveNode(XT::getSessionValue("source_node_id"),XT::getValue("node_id"),'after');
        }
        if(XT::getSessionValue("ctrl_copy")){
            $newid = $tree->copyNode(XT::getSessionValue("source_node_id"),XT::getValue("node_id"),'after');
        }
        break;
}
if(XT::getSessionValue("ctrl_add")){
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
        " . XT::getBaseID() . ",
        " . $newid . ",
        " . XT::getUserID() . ",
        1,
        1048575,
        '" . $key . "'
    )",__FILE__,__LINE__);


        XT::query("
    INSERT INTO
        " . XT::getTable("faq_tree_details") . "
    (
        node_id,
        title,
        description,
        lang,
        public
    ) VALUES (
        " . $newid . ",
        NULL,
        NULL,
        '" . $key . "',
        1
    )
    ",__FILE__,__LINE__);
    }
    XT::setValue("node_id", $newid);
    XT::setAdminModule("edit_cat");
}


if(XT::getSessionValue("ctrl_copy")){

    foreach($newid as $value){


        // Get node details
        $result = XT::query("
            SELECT
                *
            FROM
                " . XT::getTable('faq_tree_details') . "
            WHERE
                node_id = " . XT::getValue("node_id") . "
            ",__FILE__,__LINE__);

        while($row = $result->FetchRow()){

            XT::query("
                INSERT INTO
                    " . XT::getTable('faq_tree_details') . "
                (
                    node_id,
                    lang,
                    title,
                    description,
                    active,
                    public,
                    image,
                    image_version,
                    creation_date,
                    creation_user,
                    mod_date,
                    mod_user
                ) VALUES (
                    " . $value['copy'] . ",
                    '" . $row['lang'] . "',
                    '" . $row['title'] . "',
                    '" . $row['description'] . "',
                    '" . $row['active'] . "',
                    '" . $row['public'] . "',
                    '" . $row['image'] . "',
                    '" . $row['image_version'] . "',
                    '" . $row['creation_date'] . "',
                    '" . $row['creation_user'] . "',
                    '" . $row['mod_date'] . "',
                    '" . $row['mod_user'] . "'
                )
            ",__FILE__,__LINE__,0);

        }

        // Copy the relations
        $result = XT::query("
            SELECT
                *
            FROM
                " . XT::getTable('relations') . "
            WHERE
                content_id = " . $value['original'] . "
            AND
                content_type = " .XT::getBaseID() . "
            ",__FILE__,__LINE__);

        while($row = $result->FetchRow()){

            XT::query("
                INSERT INTO
                    " . XT::getTable('relations') . "
                (
                $way,
                content_id,
                content_type,
                target_content_id,
                target_content_type,
                priority,
                title,
                description,
                image,
                type,
                position
                ) VALUES (
                    " . $value['copy'] . ",
                    '" . $row['content_id'] . "',
                    '" . $row['content_type'] . "',
                    '" . $row['target_content_id'] . "',
                    '" . $row['target_content_type'] . "',
                    '" . $row['priority'] . "',
                    '" . $row['title'] . "',
                    '" . $row['description'] . "',
                    '" . $row['image'] . "',
                    '" . $row['type'] . "',
                    '" . $row['position'] . "'
                )
            ",__FILE__,__LINE__,0);
        }
    }
    XT::setAdminModule("edit_cat");
}

function duplicate_entry($entry_id,$original_node,$copy_node){
    // read articles_v and articles_chapters_v
    $result_articles = XT::query("SELECT * FROM " . XT::getTable('faq') . " WHERE id=" . $entry_id ,__FILE__,__LINE__);

    // insert into articles articles_chapters and articles_v and articles_chapters_v aND langs
    // get the new ID
    $result = XT::query("SELECT MAX(id) as maxid FROM " . XT::getTable('faq'),__FILE__,__LINE__);
    $row = $result->FetchRow();
    $new_id = $row['maxid'] + 1;

    while ($row_article = $result_articles->FetchRow()) {

        // Add a Entry in the live table and get the ID
        XT::query("INSERT INTO " . XT::getTable('faq') . " (c_user,lang) VALUES (" . XT::getUserID() . ",'" . $row_article['lang'] . "')",__FILE__,__LINE__);
        XT::query("INSERT INTO " . XT::getTable('faq2cat') . " (faq_id, node_id) VALUES (" . $new_id . "," . $copy_node . ")",__FILE__,__LINE__);

        XT::query("
        UPDATE
            " . XT::getTable('faq') . "
        SET
            title = '" . addslashes($row_article['title']) . "',
            active = 0,
            date = '" . $row_article['date'] . "',
            public = '" . $row_article['public'] . "',
            is_answered = '" . $row_article['is_answered'] . "',
            answer = '" . $row_article['answer'] . "',
            questioner = '" . $row_article['questioner'] . "',
            answer_date = '" . $row_article['answer_date'] . "',
            image = '" . $row_article['image'] . "',
            image_version = '" . $row_article['image_version'] . "',
            image_zoom = '" . $row_article['image_zoom'] . "',
            lang = '" . $row_article['lang'] . "',
            description = '" . addslashes($row_article['description']) . "',
    	    mod_date = '" . time() . "',
    	    mod_user = '" . XT::getUserID() . "',
            c_user = '" . $row_article['c_user'] . "',
            questioner_mail = '" . $row_article['questioner_mail'] . "',
            answer_title = '" . $row_article['aswer_title'] . "',
            answer_name = '" . $row_article['answer_name'] . "',
            answer_address = '" . $row_article['answer_address'] . "'
        WHERE
            id = " . $new_id . " AND
            lang = '" . $row_article['lang'] . "'
        ",__FILE__,__LINE__);
    }
}

XT::unsetSessionValue("ctrl_add");
XT::unsetSessionValue("ctrl_cut");
XT::unsetSessionValue("ctrl_copy");
XT::unsetSessionValue("ctrl_copy_entry");
XT::unsetSessionValue("ctrl_cut_entry");
?>
