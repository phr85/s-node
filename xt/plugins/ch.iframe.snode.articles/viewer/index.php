<?php
// Parameter :: Title
$title = XT::getParam('title') != '' ? XT::getParam('title') : '';

// Parameter :: Slave
$slave = XT::getParam('slave') != '' ? XT::getParam('slave') : '';

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Parameter :: ID
$id = XT::autoval("id","P");

$GLOBALS['relations'][XT::getBaseID()][$id] = true;

/*if($GLOBALS['auth']->isAuth() && XT::getPermission('statuschange')){
    $active = '';
} else {
    $active = 'AND a.active = 1';
}*/
// Show only active content also for administrators
$active = 'AND a.active = 1';

$chaptertpldir = substr($style,0,-4) . '/';

// Get the way
$result = XT::query("
            SELECT
                n1.id,
                n1.pid
            FROM
                " . $GLOBALS['plugin']->getTable("articles_tree") . " AS n1,
                " . $GLOBALS['plugin']->getTable("articles_tree") . " AS n2
            LEFT JOIN " . $GLOBALS['plugin']->getTable("articles_tree_rel") . " as treeart on n2.id = treeart.node_id
            WHERE
                treeart.article_id ='" . $id . "'
                AND n1.l <= n2.l
                AND n1.r >= n2.r
            GROUP BY
                n1.ID
            ORDER BY
                n1.l ASC
        ",__FILE__,__LINE__);
$count = 0;

while ($row = $result->FetchRow()){
    $way[$count] = $row['id'];
    $count++;
    $node_id = $row['id'];
    $node_pid = $row['pid'];
    
}
XT::setTreeWay($way);

// Use Nodepermissions if wished, installed and licensed 
$use_node_permissions = false;
if(XT::getConfig("use_node_permissions") &&
   is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.nodepermissions.zl") &&
   is_file(PLUGIN_DIR . "ch.iframe.snode.nodepermissions/includes/config.inc.php")) {
    $use_node_permissions = true;
}

if($id > 0 && (!$use_node_permissions || ($use_node_permissions && XT::getNodePermission($node_id, 'view', $node_pid, true)))){
    if(XT::getValue('preview') == 1 && XT::getPermission('edit')){
        // Preview mode
        $articles_db = XT::getTable("articles_v");
        $chapters_db = XT::getTable("articles_chapters_v") ;
 		$active = '';
        $article_where =  ' AND a.latest = 1 ';
    }else{
        // Normal view
        $articles_db = XT::getTable("articles");
        $chapters_db = XT::getTable("articles_chapters") ;
        $timecontrol = " AND (a.display_time_start = 0 OR a.display_time_start < " . time() . ") AND (a.display_time_end = 0 OR a.display_time_end > " . time() . ")";

        $article_where = '';
    }

    $result = XT::query("
            SELECT
                a.id,
                a.title,
                a.subtitle,
                a.date,
                a.autor,
                a.introduction,
                a.maintext,
                a.creation_date,
                a.image,
                a.image_version,
                a.image_link,
                a.image_link_target,
                a.image_zoom,
                fdet.description as image_description,
                f.type as image_type,
                f.width,
                f.height,
                a.rid,
                a.hide_title
            FROM
                " . $articles_db . " as a
             LEFT JOIN
                " . XT::getTable("files") . " as f ON (f.id = a.image)
             LEFT JOIN
                    " . XT::getTable("files_details") . " as fdet ON (fdet.id = a.image AND fdet.lang='" . XT::getLang() . "')
             WHERE
                a.id = " . $id . "
                " . $active .
    $timecontrol . $article_where . "
             AND a.lang = '" . $GLOBALS['lang']->getLang() . "'
            ",__FILE__,__LINE__);

    $data = array();
    while($row = $result->FetchRow()){
        if($title != ''){
            XT::assign("TITLE", $title);
        } else {
            XT::assign("TITLE", $row['title']);
        }
        if($row['image_version'] != ''){
            XT::assign("IMAGE_VERSION", '_' . $row['image_version']);
        }

        $data[] = $row;
    }
    // wenn keine daten da sind, auch nichts anzeigen.
    if(count($data) >0){

        if($data[0]['rid'] > 0){
             $chapter_where = " AND a.rid = " . $data[0]['rid'];
        } else {
            $chapter_where = "";
        }

        $data[0]['title_image'] = IMAGE_DIR . 'tmp/' . XT::getContentType('Article') . '/' . $data[0]['id'] . '.png';

        // Register this content
        XT::addToTitle($data[0]['title']);
        XT::addToContentStack(XT::getContentType('Article'),$data[0]['id'], $data[0]['title']);

        $result = XT::query("
            SELECT
                a.id,
                a.title,
                a.subtitle,
                a.maintext,
                a.image,
                a.image_version,
                a.image_link,
                a.image_link_target,
                a.image_zoom,
                a.level,
                a.layout,
                fdet.description as image_description,
                f.width as image_original_width,
                f.height as image_original_height,
                f.type as image_type,
                f.width,
                f.height,
                fd.width as image_width,
                fd.height as image_height
            FROM
                " . $chapters_db . " as a
            LEFT JOIN
                " . XT::getTable("files") . " as f ON (f.id = a.image)
            LEFT JOIN
                " . XT::getTable("files_details") . " as fdet ON (fdet.id = a.image AND fdet.lang='" . XT::getLang() . "')
            LEFT JOIN
                " . XT::getTable("files_versions") . " as fd ON (fd.file_id = a.image AND fd.version = a.image_version)
            WHERE
                a.id = " . $id . "
                " . $active . $chapter_where . "
            AND a.lang = '" . $GLOBALS['lang']->getLang() . "'

            GROUP BY
                a.level
            ORDER BY
                a.level ASC",__FILE__,__LINE__);
                
        $res = XT::getQueryData($result);
        
        $i =1;
        $chapters = array();
        
        foreach($res as $row) {
            $chapters[$i] = $row['title'];
            $i++;
        }
        
        $data[0]['CHAPTERS'] = $chapters;
        XT::assign("ARTICLE", $data[0]);

        $chapter_content = '';
        $i=1;
        foreach($res as $row) {

            XT::assign("CHAPTER", $row);
            $layout = $row['layout'] != '' ? $row['layout'] : 'image_left.tpl';
            $chapter_content[$i] = $row;

            if(is_file(TEMPLATE_DIR . $_SESSION['theme'] ."/". $GLOBALS['plugin']->package . "/viewer/" . $chaptertpldir . $layout)){

                $chapter_content[$i]['rendered'] = $GLOBALS['tpl']->fetch(TEMPLATE_DIR . $_SESSION['theme'] ."/". $GLOBALS['plugin']->package . "/viewer/" . $chaptertpldir . $layout);
            }else{
                $chapter_content[$i]['rendered'] = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . $chaptertpldir . $layout);
            }
            $i ++;
            if($layout=="flying_image.tpl"){
                XT::assign("flying",true);
            }
        }

        XT::assign("CHAPTERCONTENT", $chapter_content);

        $content = XT::build($style);
    }
    if($slave != ''){
    	$data = $data[0];
	    $data['CHAPTERCONTENT'] = $chapter_content;
    	$GLOBALS['slaves'][$slave]['DATA']=$data;
    }
}

?>