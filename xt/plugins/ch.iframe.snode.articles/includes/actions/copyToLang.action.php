<?php
XT::call("saveArticle");

// Copy main article
$result = XT::query("
    SELECT count(rid) as counter
    FROM
        " . XT::getTable("articles_v") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        lang = '" . $GLOBALS['plugin']->getValue('copyToLang') . "'
    ",__FILE__,__LINE__);

$row = $result->FetchRow();

if($row['counter'] == 0){
	// Copy main article
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
	        lang
	    FROM
	        " . XT::getTable("articles_v") . "
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
	
	// Create live entry
	XT::query("
	    INSERT INTO 
	        " . $GLOBALS['plugin']->getTable('articles') . " 
	    (
	        id,
	        creation_date,
	        creation_user,
	        lang
	    ) VALUES (
	        " . $GLOBALS['plugin']->getSessionValue('id') . ",
	        " . time() . ",
	        " . XT::getUserID() . ",
	        '" . $GLOBALS['plugin']->getValue('copyToLang') . "'
	    )
	",__FILE__,__LINE__);
	
	// Create revision entry
	XT::query("
	    INSERT INTO 
	        " . $GLOBALS['plugin']->getTable('articles_v') . " 
	    (
	        id,
	        creation_date,
	        creation_user,
	        lang,
	        latest
	    ) VALUES (
	        " . $GLOBALS['plugin']->getSessionValue('id') . ",
	        " . time() . ",
	        " . XT::getUserID() . ",
	        '" . $GLOBALS['plugin']->getValue('copyToLang') . "',
	        1
	    )
	",__FILE__,__LINE__);
	
	XT::query("
	    UPDATE
	        " . XT::getTable('articles_v') . "
	    SET
	        title = '" . addslashes($article['title']) . "',
	        subtitle = '" . addslashes($article['subtitle']) . "',
	        autor = '" . addslashes($article['autor']) . "',
	        introduction = '" . addslashes($article['introduction']) . "',
	        maintext = '" . addslashes($article['maintext']) . "',
	        image = '" . $article['image'] . "',
	        image_version = '" . $article['image_version'] . "',
	        image_link = '" . $article['image_link'] . "',
	        image_link_target = '" . $article['image_link_target'] . "',
	        image_zoom = '" . $article['image_zoom'] . "',
	        rid = 1
	    WHERE
	        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
	        lang = '" . $GLOBALS['plugin']->getValue('copyToLang') . "'
	",__FILE__,__LINE__);
	
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
			layout, 
	        active, 
	        level,
	        lang 
	    FROM 
	        " . XT::getTable("articles_chapters_v") . "
	    WHERE
	        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
	        rid = " . $article['rid'] . " AND
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
				layout,
	            active,
	            rid,
	            lang
	        ) VALUES (
	            '" . $GLOBALS['plugin']->getSessionValue('id') . "', 
	            '" . $chapter['level'] . "',
	            '" . addslashes($chapter['title']) . "',
	            '" . addslashes($chapter['subtitle']) . "',
	            '" . addslashes($chapter['maintext']) . "',
	            '" . addslashes($chapter['image']) . "',
	            '" . addslashes($chapter['image_version']) . "',
	            '" . addslashes($chapter['image_link']) . "',
	            '" . addslashes($chapter['image_link_target']) . "',
	            '" . addslashes($chapter['image_zoom']) . "',
				'" . addslashes($chapter['layout']) . "',
	            1,
	            1,
	            '" . $GLOBALS['plugin']->getValue('copyToLang') . "'
	        )
	    ",__FILE__,__LINE__);
	    
	}
	
	$GLOBALS['plugin']->setValue('lang_filter', $GLOBALS['plugin']->getValue('copyToLang'));
	$GLOBALS['plugin']->setAdminModule('e');
}else{
    XT::log('Article already exists',__FILE__,__LINE__,XT_WARNING);
    $GLOBALS['plugin']->setAdminModule('e');
}
?>