<?php
XT::lock($GLOBALS['plugin']->getSessionValue('id'), $GLOBALS['plugin']->getContentType('Article'));

// Save a Articles
$GLOBALS['plugin']->setAdminModule('e');

if(XT::getValue("rid") == ''){
    $GLOBALS['plugin']->setValue("rid", 1);
}

// Add a new revision
if(XT::getValue('published') == 1){

    XT::query("
        INSERT INTO
            " . $GLOBALS['plugin']->getTable('articles_v') . "
        (
            id,
            creation_date,
            creation_user,
            lang,
            latest,
            locked,
            locked_user,
            locked_date,
            rid
        ) VALUES (
            " . $GLOBALS['plugin']->getSessionValue('id') . ",
            " . time() . ",
            " . XT::getUserID() . ",
            '" . $GLOBALS['plugin']->getActiveLang() . "',
            1,
            1,
            " . XT::getUserID() . ",
            " . time() . ",
            " . (XT::getValue("rid") + 1) . "
        )
    ",__FILE__,__LINE__);

    $old_rid = XT::getValue("rid");
    $GLOBALS['plugin']->setValue("rid", ($old_rid + 1));

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
            " . XT::getTable("articles_chapters_v") . "
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
                " . XT::getTable('articles_chapters_v') . "
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
                '" . addslashes($chapter['image_link']) . "',
                '" . $chapter['image_link_target'] . "',
                '" . $chapter['image_zoom'] . "',
                '" . $chapter['active'] . "',
                '" . $chapter['layout'] . "',
                '" . XT::getValue('rid') . "',
                '" . $GLOBALS['plugin']->getActiveLang() . "'
            )
        ",__FILE__,__LINE__);

    }
}

XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable('articles_v') . "
    SET
        latest = 0
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);

// timer

if(XT::getValue('sdate_str')!=""){
    $sdate_pre = explode(".",XT::getValue('sdate_str'));
    $sdate = mktime(0,0,0,$sdate_pre[1],$sdate_pre[0],$sdate_pre[2]);
}else{
    $sdate = 'NULL';
}
if($sdate > 0){
    XT::setValue('sdate',mktime(XT::getValue('hstart') ,XT::getValue('mstart'),0,date('m',$sdate),date('d',$sdate),date('y',$sdate)));
}

if(XT::getValue('edate_str')!=""){
    $edate_pre = explode(".",XT::getValue('edate_str'));
    $edate = mktime(0,0,0,$edate_pre[1],$edate_pre[0],$edate_pre[2]);
}else{
    $edate = 'NULL';
}
if ($edate > 0){
    XT::setValue('edate',mktime(XT::getValue('hend') ,XT::getValue('mend'),0,date('m',$edate),date('d',$edate),date('y',$edate)));
}

// hide title switch
if(XT::getValue("hide_title")=="on"){
    $hide_title = 1;
}else{
    $hide_title = 0;
}

if(XT::getValue('articledate_str')!=""){
    $date_pre = explode(".",XT::getValue('articledate_str'));
    $articledate = mktime(0,0,0,$date_pre[1],$date_pre[0],$date_pre[2]);
}else{
    $articledate = 'NULL';
}

// perform MAIN-Articles save operation
XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable('articles_v') . "
    SET
        title = '" . XT::getValue('title') . "',
        hide_title = '" . $hide_title . "',
        subtitle = '" . XT::getValue('subtitle') . "',
        autor = '" . XT::getValue('autor') . "',
        date = " . $articledate . ",
        introduction = '" . XT::getValue('introduction') . "',
        maintext = '" . XT::getValue('maintext') . "',
        image = '" . XT::getValue('image') . "',
        image_version = '" . XT::getValue('image_version') . "',
        image_link = '" . XT::getValue('image_link') . "',
        image_link_target = '" . XT::getValue('image_link_target') . "',
        image_zoom = '" . XT::getValue('image_zoom') . "',
        published = 0,
        active = '" . XT::getValue('active') . "',
        mod_date = " . time() . ",
        mod_user = " . XT::getUserID() . ",
        latest = 1,
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "',
        display_time_type ='" . XT::getValue('time_type') . "',
        display_time_start ='" . XT::getValue('sdate') . "',
        display_time_end ='" . XT::getValue('edate') . "'

    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        rid = " . XT::getValue('rid') . " AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'"
,__FILE__,__LINE__);


// perform CHAPTER-Articles save operation
for ($i = 0; $i < XT::getValue('maxlevel'); $i++) {
    XT::query("
        UPDATE
            " . $GLOBALS['plugin']->getTable('articles_chapters_v') . "
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
    ",__FILE__,__LINE__);
}

?>