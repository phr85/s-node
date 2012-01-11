<?php
include_once(CLASS_DIR . 'tree.class.php');
$tree = new XT_Tree("events_tree");

switch(XT::getValue("position")){
    case 'into':
    if(XT::getSessionValue("ctrl_add")){
        $newid = $tree->addChildNode(XT::getValue("node_id"));
        XT::setAdminModule("en");
    }
    if(XT::getSessionValue("ctrl_cut")){
        $newid = $tree->moveNode(XT::getSessionValue("source_node_id"),XT::getValue("node_id"),'last');
    }
    if(XT::getSessionValue("ctrl_cut_entry")){
        // Update relation
        XT::query("UPDATE " . $GLOBALS['cfg']->get("database","prefix") . "events_tree_rel
             SET
                 node_id= " . XT::getValue("node_id") . "
             WHERE 
                node_id = " . XT::getSessionValue('source_node_id') . "
             AND
                event_id = " . XT::getSessionValue('source_entry_id') 
        ,__FILE__,__LINE__);
    }

    if(XT::getSessionValue("ctrl_copy")){
        $newid = $tree->copyNode(XT::getSessionValue("source_node_id"),XT::getValue("node_id"),'last');
        // Copy the entries
        foreach ($newid as $copyelements) {
            // select all elements from original node
            $result = XT::query("SELECT event_id as id FROM " . XT::getTable('events_tree_rel') . " WHERE node_id =" . $copyelements['original'],__FILE__,__LINE__);
            while($row = $result->FetchRow()){
                // copy each event into copy node
                duplicate_entry($row['id'],$copyelements['original'],$copyelements['copy']);
            }
        }
    }
    if(XT::getSessionValue("ctrl_copy_entry")){
        // copy the entry
        duplicate_entry(XT::getSessionValue('source_entry_id'),XT::getSessionValue('source_node_id'),XT::getValue("node_id"));
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
        
        // Copy the entries
        foreach ($newid as $copyelements) {
            // select all elements from original node
            $result = XT::query("SELECT event_id as id FROM " . XT::getTable('events_tree_rel') . " WHERE node_id =" . $copyelements['original'],__FILE__,__LINE__);
            while($row = $result->FetchRow()){
                // copy each event into copy node
                duplicate_entry($row['id'],$copyelements['original'],$copyelements['copy']);
            }
        }
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
        
        // Copy the entries
        foreach ($newid as $copyelements) {
            
            // select all elements from original node
            $result = XT::query("SELECT event_id as id FROM " . XT::getTable('events_tree_rel') . " WHERE node_id =" . $copyelements['original'],__FILE__,__LINE__);
            while($row = $result->FetchRow()){
                // copy each event into copy node
                duplicate_entry($row['id'],$copyelements['original'],$copyelements['copy']);
            }
        }
    }
    break;
}

if(XT::getSessionValue("ctrl_add")){
    $GLOBALS['plugin']->setValue("node_id", $newid);

    // Create detail row
    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('events_tree_details') . "
        (
            node_id,
            lang,
            creation_user,
            creation_date
        ) VALUES (
            " . XT::getValue('node_id') . ",
            '" . $GLOBALS['plugin']->getActiveLang() . "',
            '" . $GLOBALS['auth']->getUserID() . "',
            '" . time() . "'
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
                " . $GLOBALS['plugin']->getTable('events_tree_details') . "
            WHERE
                node_id = " . $value['original'] . "
            ",__FILE__,__LINE__);

        while($row = $result->FetchRow()){

            XT::query("
                INSERT INTO
                    " . $GLOBALS['plugin']->getTable('events_tree_details') . "
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

function duplicate_entry()
{
	
}
?>
