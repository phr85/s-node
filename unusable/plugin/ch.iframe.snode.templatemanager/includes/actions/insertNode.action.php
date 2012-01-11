<?php

include_once(CLASS_DIR . 'tree.class.php');
$tree = new XT_Tree("faq_tree");

switch($GLOBALS['plugin']->getValue("position")){
    case 'into':
        if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
            $newid = $tree->addChildNode($GLOBALS['plugin']->getValue("node_id"));
            $GLOBALS['plugin']->setAdminModule("en");
        }
        if($GLOBALS['plugin']->getSessionValue("ctrl_cut")){
            $newid = $tree->moveNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'into');
        }
        if($GLOBALS['plugin']->getSessionValue("ctrl_copy")){
            $newid = $tree->copyNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'into');
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
    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('faq_tree_details') . "
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
                " . $GLOBALS['plugin']->getTable('faq_tree_details') . "
            WHERE
                node_id = " . $value['original'] . "
            ",__FILE__,__LINE__);

        while($row = $result->FetchRow()){

            XT::query("
                INSERT INTO
                    " . $GLOBALS['plugin']->getTable('faq_tree_details') . "
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
                    keywords
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
                    '" . $row['keywords'] . "'
                )
            ",__FILE__,__LINE__,0);

        }

    }
}

$GLOBALS['plugin']->unsetSessionValue("ctrl_add");
$GLOBALS['plugin']->unsetSessionValue("ctrl_cut");
$GLOBALS['plugin']->unsetSessionValue("ctrl_copy");

?>
