<?php
if(XT::getValue('id') > 0){
    XT::setSessionValue('id',XT::getValue('id'));
}
// Parameter :: ID of the gallery
$gallery_id = XT::getParam("id") > 0 ? XT::getParam("id") : XT::getSessionValue('id');
$gallery_id = $gallery_id + 0;

// Parameter :: Image version (int => default is 2)
$image_version = XT::getParam("image_version") != '' ? XT::getParam("image_version") : 2;

// Parameter :: Per page (int => default is 9)
$per_page = XT::getParam("per_page") > 0 ? XT::getParam("per_page") : 12;

// Parameter :: Per line (int => default is 3)
$per_line = XT::getParam("per_line") > 0 ? XT::getParam("per_line") : 4;

// Parameter :: Show titles (boolean => default is true)
$show_titles = XT::getParam("show_titles") != '' ? XT::getParam("show_titles") : 0;

// Parameter :: Show views (boolean => default is true)
$show_views = XT::getParam("show_views") != '' ? XT::getParam("show_views") : 0;

// Parameter :: style (string  => default is default.tpl)
$style = XT::getParam("style") !='' ? XT::getParam("style") : "default.tpl";

// Parameter :: Viewer style (string  => default is viewer.tpl)
$viewer_style = substr($style,0,-4) . "/viewer.tpl";

// Sort
XT::setValue("sort", XT::autoval("sort"));
XT::setValue("sortby", XT::autoval("sortby"));
$sortparams = "rel.pos,rel.title,rel.description,fdet.title,fdet.description,f.upload_date,f.manual_date";
XT::assign("SORT", explode(",", $sortparams));
XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order($sortparams,"rel.pos",1,"gallery");
$order->setListener("sort","sortby");

// Get gallery details
$result = XT::query("
    SELECT
        node_id as id,
        lang,
        creation_date,
        creation_user,
        mod_date,
        mod_user,
        description,
        title,
        active,
        public,
        image as main_image,
        image_version as main_image_version
    FROM
        " . XT::getTable('galleries_details') . "
    WHERE
        node_id = '" . $gallery_id . "'
        AND lang = '" . XT::getLang() . "'
    LIMIT 1
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

// Assign wheter titles should be shown or not
XT::assign("SHOW_TITLES", $show_titles);
XT::assign("SHOW_VIEWS", $show_views);

if(XT::getValue('view') > 0){

    // Count view
    XT::query("
        UPDATE
            " . XT::getTable('galleries_rel') . "
        SET
            views = views + 1
        WHERE
            file_id = '" . XT::getValue('view') . "'
    ",__FILE__,__LINE__);

    // Get images in this gallery
    $result = XT::query("
        SELECT
            rel.description,
            rel.title,
            rel.views,
            rel.pos,
            rel.file_id as id,
            fdet.title as file_title,
            fdet.description as file_description,
            f.manual_date,
            f.filesize,
            f.width,
            f.height
        FROM
            " . XT::getTable('galleries_rel') . " as rel
        LEFT JOIN
            " . XT::getTable('files') . " as f ON (f.id = rel.file_id)
        LEFT JOIN
            " . XT::getTable('files_details') . " as fdet ON (fdet.id = rel.file_id AND fdet.lang ='" . XT::getLang() . "')
        WHERE
            rel.gallery_id = '" . $gallery_id . "' AND
            rel.active = 1 AND
            rel.lang = '" . XT::getLang() . "' AND
            rel.file_id = '" . XT::getValue('view') . "'
        LIMIT 1
    ",__FILE__,__LINE__);

    $image = array();
    while($row = $result->FetchRow()){

        // If gallery image relation title is empty, use file title
        if($row['title'] == ''){
            $row['title'] = $row['file_title'];
        }

        // If gallery image relation description is empty, use file description
        if($row['description'] == ''){
            $row['description'] = $row['file_description'];
        }

        $image = $row;
    }

    XT::assign("IMAGE", $image);
    XT::assign("GALLERY", $data[0]);

    // Get previous images
    $result = XT::query("
        SELECT
            rel.description,
            rel.title,
            rel.views,
            rel.pos,
            rel.file_id as id,
            fdet.title as file_title,
            fdet.description as file_description,
            f.manual_date,
            f.filesize,
            f.width,
            f.height
        FROM
            " . XT::getTable('galleries_rel') . " as rel
        LEFT JOIN
            " . XT::getTable('files') . " as f ON (f.id = rel.file_id)
        LEFT JOIN
            " . XT::getTable('files_details') . " as fdet ON (fdet.id = rel.file_id AND fdet.lang ='" . XT::getLang() . "')
        WHERE
            rel.gallery_id = '" . $gallery_id . "' AND
            rel.active = 1 AND
            rel.lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND
            rel.pos < " . $image['pos'] . "
        ORDER BY rel.pos DESC
        LIMIT 5
    ",__FILE__,__LINE__);

    $prev_images = array();
    while($row = $result->FetchRow()){

        if(!isset($p_image)){
            $p_image = $row;
        }

        // If gallery image relation title is empty, use file title
        if($row['title'] == ''){
            $row['title'] = $row['file_title'];
        }

        // If gallery image relation description is empty, use file description
        if($row['description'] == ''){
            $row['description'] = $row['file_description'];
        }

        $prev_images[] = $row;
    }

    XT::assign("PREV_IMAGES", $prev_images);

    // Get next images
    $result = XT::query("
        SELECT
            rel.description,
            rel.title,
            rel.views,
            rel.pos,
            rel.file_id as id,
            fdet.title as file_title,
            fdet.description as file_description,
            f.manual_date,
            f.filesize,
            f.width,
            f.height
        FROM
            " . XT::getTable('galleries_rel') . " as rel
        LEFT JOIN
            " . XT::getTable('files') . " as f ON (f.id = rel.file_id)
        LEFT JOIN
            " . XT::getTable('files_details') . " as fdet ON (fdet.id = rel.file_id AND fdet.lang ='" . XT::getLang() . "')
        WHERE
            rel.gallery_id = '" . $gallery_id . "' AND
            rel.active = 1 AND
            rel.lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND
            rel.pos > " . $image['pos'] . "
        ORDER BY rel.pos ASC
        LIMIT 5
    ",__FILE__,__LINE__);

    $next_images = array();
    while($row = $result->FetchRow()){

        if(!isset($n_image)){
            $n_image = $row;
        }

        // If gallery image relation title is empty, use file title
        if($row['title'] == ''){
            $row['title'] = $row['file_title'];
        }

        // If gallery image relation description is empty, use file description
        if($row['description'] == ''){
            $row['description'] = $row['file_description'];
        }

        $next_images[] = $row;
    }

    XT::assign("NEXT_IMAGES", $next_images);
    XT::assign("N_IMAGE", $n_image);
    XT::assign("P_IMAGE", $p_image);

    // Fetch content
    $content = XT::build($viewer_style);

} else {

    // Get image count for this gallery
    $result = XT::query("
        SELECT
            count(rel.file_id) as count
        FROM
            " . XT::getTable('galleries_rel') . " as rel
        WHERE
            rel.gallery_id = '" . $gallery_id . "' AND
            rel.active = 1 AND
            rel.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    ",__FILE__,__LINE__);

    $count_data = array();
    while($row = $result->FetchRow()){
        $count_data[] = $row;
    }

    // Image count
    $image_count = $count_data[0]['count'];
    $data[0]['image_count'] = $image_count;

    // Calculate page count
    $page_count = ceil($image_count / $per_page);
    $data[0]['page_count'] = $page_count;

    // Assign image version
    $data[0]['image_version'] = $image_version;

    // Assign pages
    for($i = 1; $i <= $page_count; $i++){
        $data[0]['pages'][] = $i;
    }

    // Get active page
    $active_page = XT::getValue('page') > 0 ? XT::getValue('page') : 1;
    $data[0]['active_page'] = $active_page;

    // Define start point
    $begin = ($active_page-1)*$per_page;
    $data[0]['begin'] = $begin;

    // Get images in this gallery
    $result = XT::query("
        SELECT
            rel.description,
            rel.title,
            rel.views,
            rel.gallery_id,
            rel.pos,
            rel.file_id as id,
            fdet.title as file_title,
            fdet.description as file_description,
            f.manual_date,
            f.filesize,
            f.width,
            f.height
        FROM
            " . XT::getTable('galleries_rel') . " as rel
        LEFT JOIN
            " . XT::getTable('files') . " as f ON (f.id = rel.file_id)
        LEFT JOIN
            " . XT::getTable('files_details') . " as fdet ON (fdet.id = rel.file_id AND fdet.lang ='" . XT::getLang() . "')
        WHERE
            rel.gallery_id = '" . $gallery_id . "' AND
            rel.active = 1 AND
            rel.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        " . $order->get() ."
        LIMIT " . $begin . "," . $per_page . "
    ",__FILE__,__LINE__);

    $data[0]['images'] = array();
    while($row = $result->FetchRow()){

        // If gallery image relation title is empty, use file title
        if($row['title'] == ''){
            $row['title'] = $row['file_title'];
        }

        // If gallery image relation description is empty, use file description
        if($row['description'] == ''){
            $row['description'] = $row['file_description'];
        }

        $data[0]['images'][] = $row;
    }

    $data[0]['per_line'] = $per_line;
    $data[0]['per_page'] = $per_page;

    // Assign whole data array
    XT::assign("GALLERY", $data[0]);
    XT::assign("PER_LINE", $per_line);

    // Register this content
    XT::addToTitle($data[0]['title']);
    XT::addToContentStack(XT::getContentType('Gallery'),$gallery_id, $data[0]['title']);

    // Fetch content
    $content = XT::build($style);

}

?>