<?php

// Get content
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable("articles_v") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND
        rid = " . XT::getValue('reuse_rid') . "
    ",__FILE__,__LINE__);

$data = XT::getQueryData($result);
$article = $data[0];
foreach ($article as $key => $value) {
	if($key != 'rid'){
		$set[] = $key . " = '" . $value . "'";
	}
}


// Transfer content to new revision
XT::query("
    INSERT into
        " . XT::getTable('articles_v') . "
    SET
    	" . implode(", ", $set) . ",
        rid = '" . (XT::getValue('rid') + 1) . "'
",__FILE__,__LINE__);


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
        " . XT::getTable("articles_chapters_v") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        rid = " . $article['rid'] . " AND
        lang = '" . $article['lang'] . "'
",__FILE__,__LINE__);


// Insert new version into live table

$data = array();
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
            '" . (XT::getValue('rid') + 1) . "',
            '" . $GLOBALS['plugin']->getActiveLang() . "'
        )
    ",__FILE__,__LINE__);
}
?>