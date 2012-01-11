<?php

include_once(CLASS_DIR . 'tree.class.php');
$tree = new XT_Tree("formreport_tree");

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
            XT::query("UPDATE " . XT::getTable("formreport_tree_rel") ."
             SET
                 node_id= " . $GLOBALS['plugin']->getValue("node_id") . "
             WHERE 
                node_id = " . XT::getSessionValue('source_node_id') . "
            AND
                article_id = " . XT::getSessionValue('source_entry_id') 
            ,__FILE__,__LINE__);

            if(XT::queryRowsAffected()==0){
                $arr = XT::getQueryData(XT::query("SELECT count(*) as cnt from " . XT::getTable("formreport_tree_rel") . " WHERE article_id = " . XT::getSessionValue('source_entry_id'),__FILE__,__LINE__));
                if($arr[0]['cnt']==0){
                    XT::query("INSERT into  " . XT::getTable("formreport_tree_rel") . "
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
                $result = XT::query("SELECT article_id as id FROM " . XT::getTable('formreport_tree_rel') . " WHERE node_id =" . $copyelements['original'],__FILE__,__LINE__);
                while($row = $result->FetchRow()){
                    // copy each article into copy node
                    duplicate_entry($row['id'],$copyelements['original'],$copyelements['copy']);
                }
            }
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
        
        break;
    case 'after':
        if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
            $newid = $tree->addNode($GLOBALS['plugin']->getValue("node_id"),"after");
            $GLOBALS['plugin']->setAdminModule("en");
        }
        if($GLOBALS['plugin']->getSessionValue("ctrl_cut")){
            $newid = $tree->moveNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'after');
        }
        
        break;
}

if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
   
    $GLOBALS['plugin']->setValue("node_id", $newid);

    // Create detail row
    XT::query("
    	INSERT INTO " . $GLOBALS['plugin']->getTable('formreport_tree_details') . "
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
                " . $GLOBALS['plugin']->getTable('formreport_tree_details') . "
            WHERE
                node_id = " . $value['original'] . "
            ",__FILE__,__LINE__);

        while($row = $result->FetchRow()){

            XT::query("
                INSERT INTO
                    " . $GLOBALS['plugin']->getTable('formreport_tree_details') . "
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
?>
