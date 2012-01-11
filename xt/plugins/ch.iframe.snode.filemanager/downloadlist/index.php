<?php

// Parameter :: node
$category = XT::autoval("node","P",1);

// Parameter :: count
$limitcount = XT::autoval("count","P",0);

// Parameter :: image_version
$version = XT::autoval("image_version","P",1);

// Parameter :: min width
$min_width = XT::getParam("min_width") != '' ? XT::getParam("min_width") : 0;

// Parameter :: style
$style = XT::getParam("style") != '' ? XT::getParam("style") : 'default.tpl';
$data = array();
$additional = '';
// Build query additionals
if($min_width > 0){
	$additional .= " AND f.width > " . $min_width . " ";
}

$unsecure = $GLOBALS['cfg']->get("system", "disable_file_security");

if(substr($category, 0, 2) == "0,") {
	$category = substr($category, 2);
}

$data['node_id'] = $category;

//check node permissions
$incat = explode(",",$category);
unset($allowed_cat);

foreach ($incat as $catval) {
	// Get the way
	$result = XT::query("
            SELECT
                n1.id,n2.pid,dets.public
            FROM
                " . $GLOBALS['plugin']->getTable("files_tree") . " AS n1,
                " . $GLOBALS['plugin']->getTable("files_tree") . " AS n2
            LEFT JOIN " . XT::getTable("files_tree_details") . " as dets on(dets.node_id = n2.id)
            WHERE
                n2.id ='" . $catval . "'
                AND n1.l <= n2.l
                AND n1.r >= n2.r
            GROUP BY
                n1.ID
            ORDER BY
                n1.l ASC
        ",__FILE__,__LINE__);
	$count = 0;
	$in = "0";
	while ($row = $result->FetchRow()){
		$way[$count] = $row['id'];
		$count++;
		$in .= ',' . $row['id'];
		$ispublic = $row['public'];
		$thepid = $row['pid'];
	}
	XT::setTreeWay($way);

	$data['node_pid'] = $thepid;

	if($unsecure || $ispublic == 1 || XT::getNodePermission($catval,'viewFiles',$thepid,true) ){
		$allowed_cat[] = $catval;
	}
}

if(is_array($allowed_cat)){
	$category = implode(",",$allowed_cat);


	// Limit
	$limit = '';
	if($limitcount > 0){
		$limit = ' LIMIT ' . $limitcount;
	}


	XT::loadClass("ordering.class.php","ch.iframe.snode.core");
	$order = new XT_Order("det.title,f.filesize,f.upload_date,f.filename,f.manual_date",XT::autoval("order","P"),XT::autoval("orderdir","P",1),XT::autoval("ordername","P","list"));
	$order->setListener("order","orderdir");


	// Get files for the active folder
	$result = XT::query("
    SELECT
        det.title,
        nodes.description as folderdescription,
        nodes.image as folderimage,
        f.id,
        f.filesize,
        f.upload_date,
		f.manual_date,
		f.valid_date,
		f.valid_from,
        f.filename,
        det.description,
        f.image,
        imagedet.title as image_title,
        imagedet.description as image_description,
        nodes.node_id,
        nodes.title as nodetitle,
        f.type,
        f.width,
        f.height
    FROM
        " . XT::getTable("files_rel") . " as rel
    LEFT JOIN
        " . XT::getTable("files") . " as f ON (rel.file_id = f.id)
    LEFT JOIN
        " . XT::getTable("files_tree_details") . " as nodes on(rel.node_id = nodes.node_id AND nodes.lang= '" . XT::getLang() .  "')
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_details") . " as det ON (rel.file_id = det.id AND det.lang = '" . XT::getLang() .  "')
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_details") . " as imagedet ON (f.image = imagedet.id AND imagedet.lang = '" . XT::getLang() .  "')
    WHERE

        rel.node_id in(" . $category . ")

        " . $additional . $order->get() . "
    " . $limit . "
",__FILE__,__LINE__);


	while($row = $result->FetchRow()){
		if($row['valid_from'] < TIME){
			if($row['valid_date'] > 0 && $row['valid_date'] < TIME){
				$row['abgelaufen'] = true;
			}
			$data[$row['node_id']]['data'][] = $row;
			$data[$row['node_id']]['title'] = $row['nodetitle'];
			$data[$row['node_id']]['description'] = $row['folderdescription'];
            $data[$row['node_id']]['image'] = $row['folderimage'];
			$files[] = $row;
		}
	}

	$data['order'] = XT::getValue("order");

	XT::assign("VERSION", $version);
	XT::assign("FILES", $files);
	XT::assign("DATA", $data);


	$content = XT::build($style);
}
?>