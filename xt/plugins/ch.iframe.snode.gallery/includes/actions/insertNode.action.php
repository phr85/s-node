<?php

include_once(CLASS_DIR . 'tree.class.php');
$tree = new XT_Tree("galleries");

switch(XT::getValue("position")){
    case 'into':
        if(XT::getSessionValue("ctrl_add")){
            $newid = $tree->addChildNode(XT::getValue("node_id"));
            XT::setAdminModule("en");
        }
        if(XT::getSessionValue("ctrl_cut")){
            $newid = $tree->moveNode(XT::getSessionValue("source_node_id"),XT::getValue("node_id"),'last');
        }
        if(XT::getSessionValue("ctrl_copy")){
            $newid = $tree->copyNode(XT::getSessionValue("source_node_id"),XT::getValue("node_id"),'last');
        }
        break;
    case 'before':
        if(XT::getSessionValue("ctrl_add")){
            $newid = $tree->addNode(XT::getValue("node_id"),"before");
            XT::setAdminModule("en");
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
            XT::setAdminModule("en");
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

    XT::setValue("node_id", $newid);

    // Create detail row
    XT::query("INSERT INTO " . XT::getTable('galleries_details') . "
        (
            node_id,
            lang,
            creation_user,
            creation_date,
            public
        ) VALUES (
            " . XT::getValue('node_id') . ",
            '" . $GLOBALS['plugin']->getActiveLang() . "',
            '" . XT::getUserID() . "',
            '" . time() . "',
            1
        )
    ");
}

if(XT::getSessionValue("ctrl_copy")){

    foreach($newid as $value){

        // Get node details
        $result = XT::query("
            SELECT
                *
            FROM
                " . XT::getTable('galleries_details') . "
            WHERE
                node_id = " . $value['original'] . "
            ",__FILE__,__LINE__);

        while($row = $result->FetchRow()){
            XT::query("
                INSERT INTO
                    " . XT::getTable('galleries_details') . "
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
                    public,
					image,
					image_version
                ) VALUES (
                    " . $value['copy'] . ",
                    '" . $row['lang'] . "',
                    '" . $row['title'] . "',
                    '" . $row['description'] . "',
                    " . XT::getUserID() . ",
                    " . time() . ",
                    " . XT::getUserID() . ",
                    " . time() . ",
                    0,
                    '" . $row['public'] . "',
					" . $row['image'] . ",
					" . $row['image_version'] . "
                )
            ",__FILE__,__LINE__,0);

        }

        // copy file and file relations
        // Get node details
        $result = XT::query("
            SELECT
                *
            FROM
                " . XT::getTable('galleries_rel') . "
            WHERE
                gallery_id = " . $value['original'] . "
            ",__FILE__,__LINE__);

        while($row = $result->FetchRow()){
             XT::query("
                INSERT INTO
                    " . XT::getTable('galleries_rel') . " (
                `gallery_id`, 
                `file_id`, 
                `source_folder_id`, 
                `lang`, 
                `title`, 
                `description`, 
                `views`, 
                `active`, 
                `public`, 
                `comments_count`, 
                `pos` 
             ) values ( 
              '" . $value['copy'] . ",',  
              '" . $row['file_id'] . "',  
              '" . $row['source_folder_id'] . "',  
              '" . $row['lang'] . "', 
              '" . $row['title'] . "', 
              '" . $row['description'] . "', 
              '" . $row['views'] . "', 
              '" . $row['active'] . "', 
              '" . $row['public'] . "', 
              '" . $row['comments_count'] . "', 
              '" . $row['pos'] . "'
               )",__FILE__,__LINE__,0);

        }

    }
}

XT::unsetSessionValue("ctrl_add");
XT::unsetSessionValue("ctrl_cut");
XT::unsetSessionValue("ctrl_copy");

XT::setAdminModule('en');

?>
