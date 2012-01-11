<?php

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

if(XT::getPermission('list')){

// Get active folder
$active = 1;
if($GLOBALS['plugin']->getSessionValue("open") != ''){
    $active = $GLOBALS['plugin']->getSessionValue("open");
}
if($GLOBALS['plugin']->getValue('active') != ''){
    $active = $GLOBALS['plugin']->getValue('active');
}
$GLOBALS['plugin']->setSessionValue("open", $active);


// Get the way
$result = XT::query("SELECT n1.id, COUNT(n1.id) AS level
FROM
    " . $GLOBALS['plugin']->getTable("tree") . " AS n1,
    " . $GLOBALS['plugin']->getTable("tree") . " AS n3
WHERE
    n3.id = " . $GLOBALS['plugin']->getSessionValue("open") . "
    AND n1.l <= n3.l
    AND n1.r >= n3.r
GROUP BY
    n1.ID
ORDER BY
    n1.l
",__FILE__,__LINE__);

// Empty in that results as e.g. 1,2,23,54
$in = '';
$way = array();
while ($row = $result->FetchRow()){
   $in .= ', ' . $row['id'] ;
   $way[] = $row['id'];
}

// Strip away first comma
$in = $in != '' ? @substr($in, 1) : 1;

// Get the folders
$result = XT::query("
    SELECT
        a.id, a.l, a.r, a.level, a.pid, floor((a.r-a.l-1)/2) as subs, f.title
    FROM
        " . $GLOBALS['plugin']->getTable('tree') . " as a
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('folders') . " as f
        ON (f.node_id = a.id AND f.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
    WHERE
        a.pid IN (" . $in . ")
    ORDER BY
        l ASC
    ",__FILE__,__LINE__);

$data = array();
$in = '';
while($row = $result->FetchRow()){
    if($row['id'] == $GLOBALS['plugin']->getSessionValue("open")){
        $GLOBALS['plugin']->setSessionValue("opentitle", $row['title']);
        $row['selected'] = true;
    } else {
        $row['selected'] = false;
    }
    $in .= ', ' . $row['id'] ;
    $row['itw'] = in_array($row['id'],$way);

    $data[] = $row;
}

// Strip away first comma
$in = $in != '' ? @substr($in, 1) : 1;

if($GLOBALS['plugin']->getSessionValue("opentitle") == ''){
    $GLOBALS['plugin']->setSessionValue("opentitle", "Root");
}

// Get permissions for visible nodes
$groups = implode(',',XT::getGroups());
$roles = implode(',',XT::getRoles());

$result = XT::query("
SELECT
    perms,
    node_id
FROM
    " . $GLOBALS['plugin']->getTable("node_perms") . "
WHERE
    base_id = " . $GLOBALS['plugin']->getBaseID() . "
    AND node_id IN (" . $in . ")
    AND
        (
            (principal_id = " . XT::getUserID() . " AND principal_type = 1)
        OR
            (principal_id IN (" . $groups . ") AND principal_type = 2)
        OR
            (principal_id IN (" . $roles . ") AND principal_type = 3)
        )
    AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__,0);

$perms = array();
while($row = $result->FetchRow()){
    if(!isset($perms[$row["node_id"]])){
        $perms[$row["node_id"]] = 0;
    }
    $perms[$row["node_id"]] |= $row["perms"];
}

$GLOBALS['plugin']->setNodePerms($perms);

// Add action buttons
if($in == "1"){
    XT::getNodePermission(1,'addFolders') ? XT::addImageButton('Add folder', 'addFirstNode','default','add.png','1','master','a') : null;
} else {
    if(!$GLOBALS['plugin']->getSessionValue("ctrl_add")){
        XT::getPermission('addFolders') ? XT::addImageButton('Add folder', 'addFolder','default','add.png','1','master','a') : null;
    } else {
        XT::getPermission('addFolders') ? XT::addImageButton('Cancel', 'cancel','default','','1','master','c') : null;
    }
}
if(XT::getPermission('addMedia')){
    XT::addImageButton('Add picture', 'addPicture','default','add.png','1','master','i');

    /*
    $GLOBALS['plugin']->addButton('Add movie', 'addMovie', 'default', 'button', 'disabled');
    $GLOBALS['plugin']->addButton('Add music', 'addMusic', 'default', 'button', 'disabled');
    */
}


// Assign folder tree
XT::assign("NODES", $data);
XT::assign("NODE_MANAGER_TPL", $GLOBALS['plugin']->getConfig('node_manager_tpl'));
XT::assign("NODE_MANAGER_BASE_ID", $GLOBALS['plugin']->getConfig('node_manager_base_id'));
XT::assign("PACKAGE", $GLOBALS['plugin']->package);
XT::assign("CTRL_ADD", $GLOBALS['plugin']->getSessionValue("ctrl_add"));

/**
 * get media folder content
 */
$result = XT::query("
    SELECT
        a.id,
        a.title,
        a.width,
        a.height,
        a.filesize
    FROM
        " . $GLOBALS['plugin']->getTable('media') . " as a
    WHERE
        a.node_id = " . $GLOBALS['plugin']->getSessionValue("open") . "
    ",__FILE__,__LINE__);

$data = XT::getQueryData($result);

// Assign media content
XT::assign("MEDIA", $data);

// fetch content
$content = XT::build('overview.tpl');

}

?>