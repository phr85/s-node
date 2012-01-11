<?php

$folder = $GLOBALS['plugin']->getParam("folder") > 0 ? $GLOBALS['plugin']->getParam("folder") : 1;
$target = $GLOBALS['plugin']->getParam("target") != "" ? $GLOBALS['plugin']->getParam("target") : "_self";
XT::assign("TARGET", $target);

// Get the way
$result = XT::query("
    SELECT
        n1.id
    FROM
        " . $GLOBALS['plugin']->getTable("files_tree") . " AS n1,
        " . $GLOBALS['plugin']->getTable("files_tree") . " AS n2
    WHERE
        n2.id ='" . $folder . "'
        AND n1.l <= n2.l
        AND n1.r >= n2.r
        AND n1.tree_id = 1
    GROUP BY
        n1.ID
    ORDER BY
        n1.l ASC
",__FILE__,__LINE__);

$count = 0;

while ($row = $result->FetchRow()){
    $way[$count] = $row['id'];
    $count++;
}

XT::setTreeWay($way);

$result = XT::query("
    SELECT
        n1.id,
        n1.pid,
        n1.level,
        n2.level as start_level,
        floor((n1.r-n1.l-1)/2) as subs,
        details.title,
        details.active,
        details.public
    FROM
        " . $GLOBALS['plugin']->getTable("files_tree") . " as n2,
        " . $GLOBALS['plugin']->getTable("files_tree") . " as n1
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_tree_details") . " as details ON (details.node_id = n1.id AND details.lang = '" . $GLOBALS['lang']->getLang() . "')
    WHERE
        n2.id = " . $folder . " AND
        n1.l > n2.l AND
        n1.r < n2.r AND
        n1.tree_id = 1
    ORDER BY
        n1.l ASC
",__FILE__,__LINE__);

while($row = $result->fetchRow()) {
    if($row['public'] == 1 || XT::getNodePermission($row['id'],'viewFiles',$row['pid'],true)){
          $data[] = $row;
    }
}

XT::assign("CATEGORIES", $data);

$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("files_tree_details") . "
    WHERE
        node_id = " . $folder . " AND lang='" . $GLOBALS['lang']->getLang() . "'
",__FILE__,__LINE__);
XT::assign("FOLDER",$result->FetchRow());

if($GLOBALS['plugin']->getValue("node_id") <= 0){
    $GLOBALS['plugin']->setValue("node_id",$data[0]['id']);
}

if(is_numeric($GLOBALS['plugin']->getValue("node_id"))){

    if (XT::getParam("open") == "all") {
    	$nodes = "";

    	foreach ($data as $node) {
    		$nodes .= $node['id'] . ",";
    	}
    	$node_ids = substr($nodes, 0, strlen($nodes) - 1);

    	if ($node_ids == "") {
    		$node_ids = $folder;
    	}

    	$nodes = " IN (" . $node_ids . ")";
    }
    else {
    	$nodes = "= " . $GLOBALS['plugin']->getValue("node_id");
    }



    // Get files for the active folder
    $result = XT::query("
        SELECT
            det.title,
            files.id,
            files.filesize,
			files.upload_date,
            files.filename,
            det.description,
            rel.node_id
        FROM
            " . $GLOBALS['plugin']->getTable("files_rel") . " as rel
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable("files") . " as files ON (files.id = rel.file_id)
        LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_details") . " as det ON (files.id = det.id AND det.lang = '" . XT::getLang() .  "')

        WHERE
            rel.node_id " . $nodes . "
    ",__FILE__,__LINE__);

    $data = array();
    while($row = $result->FetchRow()){
        $data[] = $row;
    }

    XT::assign("FILES", $data);

}

    if(XT::getParam('show_root_files') && XT::getParam('folder') > 0){
        // Get files for the active folder
        $result = XT::query("
        SELECT
            det.title,
            files.id,
            files.filesize,
            files.filename,
            det.description,
            rel.node_id
        FROM
            " . $GLOBALS['plugin']->getTable("files_rel") . " as rel
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable("files") . " as files ON (files.id = rel.file_id)
        LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_details") . " as det ON (files.id = det.id AND det.lang = '" . XT::getLang() .  "')

        WHERE
            rel.node_id = " . XT::getParam('folder') . "
    ",__FILE__,__LINE__);

        $data = array();
        while($row = $result->FetchRow()){
            $data[] = $row;
        }


        XT::assign("ROOTFILES", $data);
    }

$content = XT::build("default.tpl");

?>
