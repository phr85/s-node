<?php

include_once(CLASS_DIR . 'tree.class.php');
$tree = new XT_Tree("tree");

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
        " . $GLOBALS['plugin']->getBaseID() . ",
        " . $newid . ",
        " . XT::getUserID() . ",
        1,
        1048575,
        '" . $key . "'
    )",__FILE__,__LINE__);


        XT::query("
    INSERT INTO
        " . XT::getTable("nodes") . "
    (
        node_id,
        title,
        description,
        lang
    ) VALUES (
        " . $newid . ",
        NULL,
        NULL,
        '" . $key . "')",__FILE__,__LINE__);
    }
    $GLOBALS['plugin']->setValue("node_id", $newid);
    $GLOBALS['plugin']->setAdminModule("en");
}


if(XT::getSessionValue("ctrl_copy")){

    foreach($newid as $value){


        // Get node details
        $result = XT::query("
            SELECT
                *
            FROM
                " . XT::getTable('nodes') . "
            WHERE
                node_id = " . $value['original'] . "
            ",__FILE__,__LINE__);

        while($row = $result->FetchRow()){

            XT::query("
                INSERT INTO
                    " . XT::getTable('nodes') . "
                (
                    node_id,
                    lang,
                    title,
                    description,
                    use_description,
                    active,
                    public,
                    image,
                    image_version,
                    subtitle
                ) VALUES (
                    " . $value['copy'] . ",
                    '" . $row['lang'] . "',
                    '" . $row['title'] . "',
                    '" . $row['description'] . "',
                    '" . $row['use_description'] . "',
                    '" . $row['active'] . "',
                    '" . $row['public'] . "',
                    '" . $row['image'] . "',
                    '" . $row['image_version'] . "',
                    '" . $row['subtitle'] . "'
                )
            ",__FILE__,__LINE__,0);

        }

        // Copy the relations
        $result = XT::query("
            SELECT
                *
            FROM
                " . XT::getTable('r2tree') . "
            WHERE
                node_id = " . $value['original'] . "
            ",__FILE__,__LINE__);

        while($row = $result->FetchRow()){

            XT::query("
                INSERT INTO
                    " . XT::getTable('r2tree') . "
                (
                    node_id,
                    recipe_id,
                    position
                ) VALUES (
                    " . $value['copy'] . ",
                    '" . $row['recipe_id'] . "',
                    '" . $row['position'] . "'
                )
            ",__FILE__,__LINE__,0);
        }
    }
}

$GLOBALS['plugin']->unsetSessionValue("ctrl_add");
$GLOBALS['plugin']->unsetSessionValue("ctrl_cut");
$GLOBALS['plugin']->unsetSessionValue("ctrl_copy");
?>
