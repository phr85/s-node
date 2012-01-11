<?php

XT::lock($GLOBALS['plugin']->getSessionValue('id'), $GLOBALS['plugin']->getContentType('News'));

// Save a News
$GLOBALS['plugin']->setAdminModule('e');

if(XT::getValue("rid") == ''){
    $GLOBALS['plugin']->setValue("rid", 1);
}

if (XT::getValue('exclude_from_feed') == '') {
	$exclude_from_feed = 0;
}
else {
	$exclude_from_feed = 1;
}

// Add a new revision
if(XT::getValue('published') == 1){
    
    XT::query("
        INSERT INTO 
            " . $GLOBALS['plugin']->getTable('newsmanager_v') . " 
        (
            id,
            creation_date,
            creation_user,
            lang,
            latest,
            locked,
            locked_user,
            locked_date
        ) VALUES (
            " . $GLOBALS['plugin']->getSessionValue('id') . ",
            " . time() . ",
            " . XT::getUserID() . ",
            '" . $GLOBALS['plugin']->getActiveLang() . "',
            1,
            1,
            " . XT::getUserID() . ",
            " . time() . "
        )
    ",__FILE__,__LINE__);
    
    $result = XT::query("
        SELECT 
            rid 
        FROM 
            " . $GLOBALS['plugin']->getTable('newsmanager_v') . " 
        WHERE 
            id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
            lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        ORDER BY 
            rid DESC 
        LIMIT 
            1
     ",__FILE__,__LINE__);
    
    $row = $result->FetchRow();
    $old_rid = XT::getValue("rid");
    $GLOBALS['plugin']->setValue("rid", $row['rid']);
    
    // Copy chapters
    $result_chapter = XT::query("
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
            level,
            layout,
            lang 
        FROM 
            " . XT::getTable("newsmanager_chapters_v") . "
        WHERE
            id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
            rid = " . $old_rid . " AND
            lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    ",__FILE__,__LINE__);
    
    // Insert new version
    $i = 0;
    while($row = $result_chapter->FetchRow()){
        
        $chapter = $row;
        XT::query("
            INSERT INTO
                " . XT::getTable('newsmanager_chapters_v') . "
            (
                id,
                level,
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
                rid,
                lang
            ) VALUES (
                '" . $GLOBALS['plugin']->getSessionValue('id') . "', 
                '" . $chapter['level'] . "',
                '" . addslashes($chapter['title']) . "',
                '" . addslashes($chapter['subtitle']) . "',
                '" . addslashes($chapter['maintext']) . "',
                '" . $chapter['image'] . "',
                '" . $chapter['image_version'] . "',
                '" . $chapter['image_link'] . "',
                '" . $chapter['image_link_target'] . "',
                '" . $chapter['image_zoom'] . "',
                1,
                '" . $chapter['layout'] . "',
                '" . XT::getValue('rid') . "',
                '" . $GLOBALS['plugin']->getActiveLang() . "'
            )
        ",__FILE__,__LINE__);
        
    }
}

XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable('newsmanager_v') . "
    SET 
        latest = 0
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);

// perform MAIN-News save operation
XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable('newsmanager_v') . "
    SET
        title = '" . XT::getValue('title') . "',
        subtitle = '" . XT::getValue('subtitle') . "',
        autor = '" . XT::getValue('autor') . "',
        introduction = '" . XT::getValue('introduction') . "',
        maintext = '" . XT::getValue('maintext') . "',
        image = '" . XT::getValue('image') . "',
        image_version = '" . XT::getValue('image_version') . "',
        image_link = '" . XT::getValue('image_link') . "',
        image_link_target = '" . XT::getValue('image_link_target') . "',
        image_zoom = '" . XT::getValue('image_zoom') . "',
        published = 0,
        active = " . XT::getValue('active') . ",
        mod_date = " . time() . ",
        mod_user = " . XT::getUserID() . ",
        latest = 1,
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "',
        exclude_from_feed = " . $exclude_from_feed . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        rid = " . XT::getValue('rid') . " AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'"
,__FILE__,__LINE__,0);

// perform CHAPTER-News save operation
for ($i = 0; $i < XT::getValue('maxlevel'); $i++) {
    XT::query("
        UPDATE
            " . $GLOBALS['plugin']->getTable('newsmanager_chapters_v') . "
        SET
            title = '" . XT::getValue('title'. $i) . "',
            subtitle = '" . XT::getValue('subtitle'. $i) . "',
            maintext = '" . XT::getValue('maintext'. $i) . "',
            image = '" . XT::getValue('image'. $i) . "',
            image_version = '" . XT::getValue('image' . $i . '_version') . "',
            image_link = '" . XT::getValue('image' . $i . '_link') . "',
            image_link_target = '" . XT::getValue('image' . $i . '_link_target') . "',
            image_zoom = '" . XT::getValue('image' . $i . '_zoom') . "',
            layout = '" . XT::getValue('layout' . $i) . "',
            published = 0,
            rid = " . XT::getValue('rid') . ",
            lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        WHERE
            id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND 
            level=" . ($i+1) . " AND
            rid = " . XT::getValue('rid') . " AND
            lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    ",__FILE__,__LINE__,0);
}
?>