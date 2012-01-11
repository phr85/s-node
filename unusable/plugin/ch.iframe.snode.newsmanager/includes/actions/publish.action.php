    <?php

if(is_numeric($GLOBALS['plugin']->getValue('id'))){
    $GLOBALS['plugin']->setSessionValue("id", $GLOBALS['plugin']->getValue('id'));
}

XT::unlock($GLOBALS['plugin']->getSessionValue('id'), $GLOBALS['plugin']->getContentType('News'));

// Get content
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
        lang,
        exclude_from_feed
    FROM
        " . XT::getTable("newsmanager_v") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    ORDER BY
        rid DESC
    LIMIT 1
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}
$article = $data[0];

// Set this revision as published
XT::query("
    UPDATE
        " . XT::getTable('newsmanager_v') . "
    SET
        published = 1
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND
        rid = " . $article['rid'] . "
",__FILE__,__LINE__);

// Transfer content to live system
XT::query("
    UPDATE
        " . XT::getTable('newsmanager') . "
    SET
        title = '" . addslashes($article['title']) . "',
        subtitle = '" . addslashes($article['subtitle']) . "',
        autor = '" . $article['autor'] . "',
        introduction = '" . addslashes($article['introduction']) . "',
        maintext = '" . addslashes($article['maintext']) . "',
        image = '" . $article['image'] . "',
        image_version = '" . $article['image_version'] . "',
        image_link = '" . $article['image_link'] . "',
        image_link_target = '" . $article['image_link_target'] . "',
        image_zoom = '" . $article['image_zoom'] . "',
        rid = '" . $article['rid'] . "',
        lang = '" . $article['lang'] . "',
        exclude_from_feed = " . $article['exclude_from_feed'] . "
        
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);

// Instantiate indexing object and index main fields
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex($GLOBALS['plugin']->getSessionValue('id'),$GLOBALS['plugin']->getContentType("News"),1);
$search->setLang($GLOBALS['plugin']->getActiveLang());

// Transfer chapters to live system
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
        rid = " . $article['rid'] . " AND 
        lang = '" . $article['lang'] . "'
",__FILE__,__LINE__);

// Delete existing published versions
XT::query("
    DELETE FROM
        " . XT::getTable('newsmanager_chapters') . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);

// Insert new version into live table

$data = array();
$i = 0;
while($row = $result_chapter->FetchRow()){
    
    $chapter = $row;
    
    XT::query("
        INSERT INTO
            " . XT::getTable('newsmanager_chapters') . "
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
            '" . $chapter['active'] . "',
            '" . $chapter['layout'] . "',
            '" . $article['rid'] . "',
            '" . $GLOBALS['plugin']->getActiveLang() . "'
        )
    ",__FILE__,__LINE__);
    
    if($chapter['active'] == 1){
        $search->add(addslashes($chapter['title']), 3);
        $search->add(addslashes($chapter['subtitle']), 2);
        $search->add(addslashes($chapter['maintext']), 1);
    }
    
}

// Set all those chapter as published
XT::query("
    UPDATE
        " . XT::getTable('newsmanager_chapters_v') . "
    SET
        published = 1
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        rid = " . $article['rid'] . " AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);

$search->add($GLOBALS['plugin']->getValue('subtitle'), 3);
$search->add($GLOBALS['plugin']->getValue('author'), 2);
$search->add($GLOBALS['plugin']->getValue('maintext'), 1);
$searchimage = $article['image'] != "" ? $article['image'] : 0;
$search->build($GLOBALS['plugin']->getValue('title'), $GLOBALS['plugin']->getValue('introduction'),$searchimage);

// XT::call('generateFeeds');

// $GLOBALS['plugin']->setAdminModule("o");

?>