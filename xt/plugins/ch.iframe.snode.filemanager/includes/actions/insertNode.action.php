<?php

include_once(CLASS_DIR . 'tree.class.php');
$tree = new XT_Tree("files_tree");

switch($GLOBALS['plugin']->getValue("position")){
    case 'into':
        if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
            $newid = $tree->addChildNode($GLOBALS['plugin']->getValue("node_id"));
            $GLOBALS['plugin']->setAdminModule("en");
        }
        if($GLOBALS['plugin']->getSessionValue("ctrl_cut")){
            $newid = $tree->moveNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'last');
        }
        if($GLOBALS['plugin']->getSessionValue("ctrl_copy")){
            $newid = $tree->copyNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'last');
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
        }
        break;
}
if (is_array($newid)) {
	// Take the first copy id as new id
	XT::setSessionValue('open',$newid[0]['copy']);
} else {
    if(!$GLOBALS['plugin']->getSessionValue("ctrl_cut")){
	XT::setSessionValue('open',$newid);
    }
} 

// Move files
if($GLOBALS['plugin']->getSessionValue("ctrl_cut_file")){
    XT::query("UPDATE " . XT::getTable('files_rel') . " SET node_id=" . $GLOBALS['plugin']->getValue("node_id") . " WHERE node_id=" . $GLOBALS['plugin']->getSessionValue("source_node_id") . " AND file_id=" . $GLOBALS['plugin']->getSessionValue("source_file_id"),__FILE__,__LINE__ );
XT::unsetSessionValue('source_file_id');
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
    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('files_tree_details') . "
        (
            node_id,
            lang,
            creation_user,
            public,
            creation_date
        ) VALUES (
            " . $GLOBALS['plugin']->getValue('node_id') . ",
            '" . $GLOBALS['plugin']->getActiveLang() . "',
            '" . $GLOBALS['auth']->getUserID() . "',
            " . XT::getConfig("newfolderdefault") . ",
            '" . time() . "'
        )
    ",__FILE__,__LINE__);
}

if($GLOBALS['plugin']->getSessionValue("ctrl_copy")){

    foreach($newid as $value){

        // Get node details
        $result = XT::query("
            SELECT
                *
            FROM
                " . $GLOBALS['plugin']->getTable('files_tree_details') . "
            WHERE
                node_id = " . $value['original'] . "
            ",__FILE__,__LINE__);

        while($row = $result->FetchRow()){

            XT::query("
                INSERT INTO
                    " . $GLOBALS['plugin']->getTable('files_tree_details') . "
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
                    '" . $row['title'] . "',
                    '" . $row['description'] . "',
                    " . XT::getUserID() . ",
                    " . time() . ",
                    " . XT::getUserID() . ",
                    " . time() . ",
                    '" . $row['active'] . "',
                    '" . $row['public'] . "'
                )
            ",__FILE__,__LINE__);

        }

        // Copy the Permissions

        // Get node details
        $result = XT::query("
            SELECT
                *
            FROM
                " . $GLOBALS['plugin']->getTable('node_perms') . "
            WHERE
                node_id = " . $value['original'] . "
            AND base_id = " . XT::getBaseID() . "
            ",__FILE__,__LINE__);

        while($row = $result->FetchRow()){

            XT::query("
                INSERT INTO
                " . $GLOBALS['plugin']->getTable('node_perms') . "
                ( `base_id`,
                  `node_id`,
                  `principal_id`,
                  `principal_type`,
                  `perms`,
                  `lang`
                  ) values (
                    '" . $row['base_id'] . "',
                    " . $value['copy'] . ",
                    '" . $row['principal_id'] . "',
                    '" . $row['principal_type'] . "',
                    '" . $row['perms'] . "',
                    '" . $row['lang'] . "'
                )
            ",__FILE__,__LINE__,0);

        }

        // eof Copy the Permissions

    }
}

$GLOBALS['plugin']->unsetSessionValue("ctrl_add");
$GLOBALS['plugin']->unsetSessionValue("ctrl_cut");
$GLOBALS['plugin']->unsetSessionValue("ctrl_cut_file");
$GLOBALS['plugin']->unsetSessionValue("ctrl_copy");

?>
