<?php

// Parameter :: Title
$title = $GLOBALS['plugin']->getParam('title') != '' ? $GLOBALS['plugin']->getParam('title') : '';

// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

// Parameter :: Step Style
$step_style = $GLOBALS['plugin']->getParam('step_style') != '' ? $GLOBALS['plugin']->getParam('step_style') : 'default_step.tpl';

// Parameter :: ID
$id = $GLOBALS['plugin']->getParam('id') != '' ? $GLOBALS['plugin']->getParam('id') : $GLOBALS['plugin']->getValue('id');

if($GLOBALS['auth']->isAuth() && XT::getPermission('statuschange')){
    $active = ''; 
} else {
    $active = 'AND a.active = 1';
}

if($id > 0){
    
    if(XT::getValue('step') > 0){
        
        // Chapter view
        
        $result = XT::query("
            SELECT
                a.id,
                a.title,
                a.subtitle,
                a.autor,
                a.introduction,
                a.maintext,
                a.creation_date,
                a.mod_date,
                a.image,
                a.image_version,
                a.image_link,
                a.image_link_target,
                a.image_zoom,
                fdet.description as image_description,
                f.type as image_type,
                f.width,
                f.height
            FROM
                " . $GLOBALS['plugin']->getTable("articles") . " as a 
            LEFT JOIN 
                " . $GLOBALS['plugin']->getTable("files") . " as f ON (f.id = a.image)
            LEFT JOIN 
                " . $GLOBALS['plugin']->getTable("files_details") . " as fdet ON (fdet.id = a.image AND fdet.lang='" . XT::getLang() . "')
            WHERE
                a.id = " . $id . "
                " . $active . "
                AND a.lang = '" . $GLOBALS['lang']->getLang() . "'
            ",__FILE__,__LINE__,0);
        
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
        
        $data[0]['title_image'] = IMAGE_DIR . 'tmp/' . XT::getContentType('Article') . '/' . $data[0]['id'] . '.png';
        
        XT::assign("ARTICLE", $data[0]);
        
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
                a.image_link,
                a.image_link_target,
                a.image_zoom,
                a.level,
                a.layout,
                fdet.description as image_description,
                f.width,
                f.height,
                f.type as image_type,
                fd.width as image_width,
                fd.height as image_height
            FROM
                " . $GLOBALS['plugin']->getTable("articles_chapters") . " as a 
            LEFT JOIN 
                " . $GLOBALS['plugin']->getTable("files") . " as f ON (f.id = a.image)
            LEFT JOIN 
                " . $GLOBALS['plugin']->getTable("files_details") . " as fdet ON (fdet.id = a.image AND fdet.lang='" . XT::getLang() . "')
            LEFT JOIN 
                " . $GLOBALS['plugin']->getTable("files_versions") . " as fd ON (fd.file_id = a.image AND fd.version = a.image_version)
            WHERE
                a.id = " . $id . "
                " . $active . "
                AND a.lang = '" . $GLOBALS['lang']->getLang() . "'
            GROUP BY
                a.level
            ORDER BY
                a.level ASC",__FILE__,__LINE__);
        
        $chapters = array();
        while($row = $result->FetchRow()){
            if($row['image_description'] == ''){
                $row['image_description'] = $row['title'];
            }
            $chapters[$row['level']] = $row;
        }  
        
        XT::assign("CHAPTERS", $chapters);
        XT::assign("CHAPTER", $chapters[XT::getValue('step')]);
        XT::assign("NEXT_CHAPTER", $chapters[XT::getValue('step')+1]);
    
        $content = XT::build($step_style);
        
    } else {
        
        // Normal view
        $result = XT::query("
            SELECT
                a.id,
                a.title,
                a.subtitle,
                a.autor,
                a.introduction,
                a.maintext,
                a.creation_date,
                a.mod_date,
                a.image,
                a.image_version,
                a.image_link,
                a.image_link_target,
                a.image_zoom,
                fdet.description as image_description,
                f.type as image_type,
                f.width,
                f.height
            FROM
                " . $GLOBALS['plugin']->getTable("articles") . " as a 
            LEFT JOIN 
                " . $GLOBALS['plugin']->getTable("files") . " as f ON (f.id = a.image)
            LEFT JOIN 
                " . $GLOBALS['plugin']->getTable("files_details") . " as fdet ON (fdet.id = a.image AND fdet.lang='" . XT::getLang() . "')
            WHERE
                a.id = " . $id . "
                " . $active . "
                AND a.lang = '" . $GLOBALS['lang']->getLang() . "'
            ",__FILE__,__LINE__,0);
        
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
        
        $data[0]['title_image'] = IMAGE_DIR . 'tmp/' . XT::getContentType('Article') . '/' . $data[0]['id'] . '.png';
        
        XT::assign("ARTICLE", $data[0]);
        
        // Register this content
        XT::addToTitle($data[0]['title']);
        XT::addToContentStack(XT::getContentType('Article'),$data[0]['id'], $data[0]['title']);
         
        $result = XT::query("
            SELECT
                a.id,
                a.title,
                a.subtitle,
                a.image,
                a.image_link,
                a.image_link_target,
                a.image_zoom,
                a.level,
                a.layout,
                fdet.description as image_description,
                f.width,
                f.height,
                f.type as image_type,
                fd.width as image_width,
                fd.height as image_height
            FROM
                " . $GLOBALS['plugin']->getTable("articles_chapters") . " as a 
            LEFT JOIN 
                " . $GLOBALS['plugin']->getTable("files") . " as f ON (f.id = a.image)
            LEFT JOIN 
                " . $GLOBALS['plugin']->getTable("files_details") . " as fdet ON (fdet.id = a.image AND fdet.lang='" . XT::getLang() . "')
            LEFT JOIN 
                " . $GLOBALS['plugin']->getTable("files_versions") . " as fd ON (fd.file_id = a.image AND fd.version = a.image_version)
            WHERE
                a.id = " . $id . "
                " . $active . "
                AND a.lang = '" . $GLOBALS['lang']->getLang() . "'
            GROUP BY
                a.level
            ORDER BY
                a.level ASC",__FILE__,__LINE__);
        
        $chapters = array();
        while($row = $result->FetchRow()){
            if($row['image_description'] == ''){
                $row['image_description'] = $row['title'];
            }
            $chapters[] = $row;
        }  
        
        XT::assign("CHAPTERS", $chapters);
    
        $content = XT::build($style);
    }

}

?>
