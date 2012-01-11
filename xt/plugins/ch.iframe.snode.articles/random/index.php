<?php
// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

// Parameter :: Linking
$link2details = $GLOBALS['plugin']->getParam('link2details') != '' ? $GLOBALS['plugin']->getParam('link2details') : 'no';

// Parameter :: Category
$categories = $GLOBALS['plugin']->getParam('categories') != '' ? $GLOBALS['plugin']->getParam('categories') : '0';

// Parameter :: Target
$target_tpl = $GLOBALS['plugin']->getParam('target_tpl') != '' ? $GLOBALS['plugin']->getParam('target_tpl') : '113';

// Parameter :: Count
$count = $GLOBALS['plugin']->getParam('count') != '' ? $GLOBALS['plugin']->getParam('count') : '1';
!is_numeric($count) ? $count = 1 : null;

$sql = "
    SELECT
        rel.article_id
    FROM
        " . XT::getTable("articles_tree") . " as tree,
        " . XT::getTable("articles_tree") . " as tree2,
        " . XT::getTable("articles_tree_rel") . " as rel
    INNER JOIN
        " . XT::getTable('articles') . " as art on (rel.article_id = art.id)
    WHERE
        tree2.id IN (" . $categories . ")
    AND
        tree.l >= tree2.l
    AND
        tree.r <= tree2.r
    AND
        rel.node_id = tree.id
    AND
        (art.display_time_start = 0 OR art.display_time_start < " . time() . ")
    AND
        (art.display_time_end = 0 OR art.display_time_end > " . time() . ")
    AND
        art.lang='" . XT::getLang() . "'
    ORDER BY
        RAND()
    LIMIT " . $count;
    //echo $sql;
// Get files for the active folder
$result = XT::query($sql,__FILE__,__LINE__);

$data = array();

while($row = $result->FetchRow()){
    $id = $row['article_id'];
	if($id > 0){
		// Normal view
		$result_s = XT::query("
				SELECT
					a.id,
					a.title,
					a.subtitle,
					a.autor,
					a.introduction,
					a.maintext,
					a.creation_date,
					a.image,
					a.image_version,
					a.image_link,
					a.image_link_target,
					a.image_zoom,
					a.rid,
					fdet.description as image_description,
					f.type as image_type,
					f.width,
					f.height
				FROM
					" . $GLOBALS['plugin']->getTable("articles_v") . " as a
				LEFT JOIN
					" . $GLOBALS['plugin']->getTable("files") . " as f ON (f.id = a.image)
				LEFT JOIN
					" . $GLOBALS['plugin']->getTable("files_details") . " as fdet ON (fdet.id = a.image AND fdet.lang='" . XT::getLang() . "')
				WHERE
					a.id = " . $id . "
					" . $active . "
					AND a.latest = 1
					AND a.lang = '" . XT::getLang() . "'
				",__FILE__,__LINE__);


		while($row_s = $result_s->FetchRow()){
			if($title != ''){
				XT::assign("TITLE", $title);
			} else {
				XT::assign("TITLE", $row_s['title']);
			}
			if($row['image_version'] != ''){
				XT::assign("IMAGE_VERSION", '_' . $row_s['image_version']);
			}
			$data[] = $row_s;
		}

		$article = $data[0];

        XT::assign("xt" . XT::getBaseID() . "_random", $data);

		XT::assign("LINK2DETAILS", $link2details);
		XT::assign("TARGET_TPL", $target_tpl);
		XT::assign("DATA", XT::getQueryData($result_s));
		XT::assign("ADMIN_TPL", $GLOBALS['plugin']->getConfig('admin_tpl'));

	}
    $content = XT::build($style);
}

?>