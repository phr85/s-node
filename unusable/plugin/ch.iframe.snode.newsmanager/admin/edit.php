<?php
if(XT::getPermission('addChapter')){
    XT::addImageButton('Add chapter', 'addChapter',"document_new.png","0","slave1");
}

if(XT::getPermission('edit')){
    XT::addImageButton('Save', 'saveNews', 'down',"disk_blue.png","0");
    XT::addImageButton('Save and preview', 'saveNewsAndPreview', 'down', 'view.png',"0");
    XT::addImageButton('Add chapter', 'addChapter', 'down',"document_new.png","0");
}

XT::assign('BUTTONSDOWN',$GLOBALS['plugin']->getButtons('down'));
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

/**
* Set session variables
*/
if(is_numeric($GLOBALS['plugin']->getValue('id'))){
    $GLOBALS['plugin']->setSessionValue("id", $GLOBALS['plugin']->getValue('id'));
}

if(is_numeric($GLOBALS['plugin']->getSessionValue('id'))){
    // get the MAINFIELDS out of the database
    $result = XT::query("
        SELECT
            id,
            title,
            subtitle,
            autor,
            introduction,
            maintext,
            creation_date,
            image,
            image_version,
            image_link,
            image_link_target,
            image_zoom,
            rid,
            published,
            active,
            lang,
            exclude_from_feed
            
        FROM
            " . $GLOBALS['plugin']->getTable("newsmanager_v") . "
        WHERE
            id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
            lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        ORDER BY
            rid DESC
        ",__FILE__,__LINE__);

    $data = array();
    while($row = $result->FetchRow()){
        if($row['image_version'] != ''){
            XT::assign("IMAGE_VERSION", '_' . $row['image_version']);
        }
        $data[] = $row;
    }
    XT::assign("NEWS", $data[0]);
    $article = $data[0];

    // Get the CHAPTERS out of the database
    $maxlevel = 0;
    $data = array();
    $chaptersthere = false;
    $result = XT::query("
        SELECT 
            id, 
            title, 
            subtitle, 
            maintext,
            image, 
            image_version, 
            image_link,
            image_link_target,
            image_zoom,
            active, 
            layout,
            level,
            lang 
        FROM 
            " . $GLOBALS['plugin']->getTable("newsmanager_chapters_v") . "
        WHERE 
            id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
            rid = " . $article['rid'] . " AND 
            lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        ORDER BY
            level"
    ,__FILE__,__LINE__);
    
    while($row = $result->FetchRow()){
        $maxlevel = $row['level'];
        $data[] = $row;
        $chaptersthere = true;
    }
    XT::assign("MAXLEVEL", $maxlevel);
    XT::assign("CHAPTERSTHERE", $chaptersthere);
    XT::assign("NEWSCHAPTER", $data);

    // Images
    XT::assign("IMAGE_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_picker_tpl"));
    XT::assign("IMAGE_PICKER_BASE_ID", $GLOBALS['plugin']->getConfig("image_picker_base_id"));
    
    // Get version history
    $result = XT::query("
        SELECT
            rid,
            title,
            creation_date,
            creation_user
        FROM
            " . $GLOBALS['plugin']->getTable("newsmanager_v") . "
        WHERE
            id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
            lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        ORDER BY
            rid DESC
        LIMIT 3
    ",__FILE__,__LINE__);
    
    $data = array();
    while($row = $result->FetchRow()){
        $row['creation_user'] = XT::getUserName($row['creation_user']);
        $data[] = $row;
    }
    XT::assign("HISTORY", $data);

    $content = XT::build('edit.tpl');
    
} else {
    XT::log("No User ID set!",__FILE__,__LINE__);
}
?>