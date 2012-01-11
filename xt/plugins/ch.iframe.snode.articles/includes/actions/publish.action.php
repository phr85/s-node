<?php

if(is_numeric($GLOBALS['plugin']->getValue('id'))){
	$GLOBALS['plugin']->setSessionValue("id", $GLOBALS['plugin']->getValue('id'));
}

XT::unlock($GLOBALS['plugin']->getSessionValue('id'), $GLOBALS['plugin']->getContentType('Article'));

// Get content
$result = XT::query("
    SELECT
        id,
        title,
        hide_title,
        subtitle,
        date,
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
        display_time_type,
        display_time_start,
        display_time_end
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

// Set this revision as published
XT::query("
    UPDATE
        " . XT::getTable('articles_v') . "
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
        " . XT::getTable('articles') . "
    SET
        title = '" . addslashes($article['title']) . "',
        hide_title = '" . $article['hide_title'] . "',
        subtitle = '" . addslashes($article['subtitle']) . "',
        autor = '" . $article['autor'] . "',
        date = '" . $article['date'] . "',
        introduction = '" . addslashes($article['introduction']) . "',
        maintext = '" . addslashes($article['maintext']) . "',
        image = '" . $article['image'] . "',
        image_version = '" . $article['image_version'] . "',
        image_link = '" . addslashes($article['image_link']) . "',
        image_link_target = '" . $article['image_link_target'] . "',
        image_zoom = '" . $article['image_zoom'] . "',
        rid = '" . $article['rid'] . "',
        lang = '" . $article['lang'] . "',
	    mod_date = '" . time() . "',
	    mod_user = '" . XT::getUserID() . "',
	    display_time_type = '" . $article['display_time_type'] . "',
	    display_time_start = '" . $article['display_time_start'] . "',
        display_time_end = '" . $article['display_time_end'] . "'
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);

// neue methode um zu prüfen ob ein artikel public ist oder nicht.
// Ordner info holen
$is_public = 0;
$result_node = XT::query("SELECT nodeinfo.public FROM " . XT::getTable('articles_tree_details') . " as nodeinfo LEFT JOIN " . XT::getTable('articles_tree_rel') . " as rel ON (nodeinfo.node_id = rel.node_id) WHERE nodeinfo.lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND rel.article_id=" . $GLOBALS['plugin']->getSessionValue('id'),__FILE__,__LINE__);
while($permrow = $result_node->FetchRow()){
	$is_public = $permrow['public'];
}

/* alte methode, TODO: muss noch abgecheckt werden
// Get node perms
$is_public = 1;
// init tree
XT::loadClass("tree.class.php","ch.iframe.snode.core");
$tree = new XT_Tree('articles_tree');

// get node_id
$result_node = XT::query("SELECT node_id FROM " . XT::getTable('articles_tree_rel') . " WHERE article_id=" . $GLOBALS['plugin']->getSessionValue('id'),__FILE__,__LINE__,0);
while($row = $result_node->FetchRow()){
$tree->getPath($row['node_id']);
$result = XT::query("SELECT count(*) as cnt FROM " . $GLOBALS['cfg']->get("database","prefix") . "node_perms WHERE base_id=" . XT::getBaseID() . " AND node_id in(" . $tree->_in . ")",__FILE__,__LINE__,1);
while($permrow = $result->FetchRow()){
if ($permrow['cnt'] > 0){
$is_public = 0;
}
}
}
*/

// Instantiate indexing object and index main fields
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex($GLOBALS['plugin']->getSessionValue('id'),$GLOBALS['plugin']->getContentType("Article"),$is_public);
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
        " . XT::getTable("articles_chapters_v") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        rid = " . $article['rid'] . " AND
        lang = '" . $article['lang'] . "'
",__FILE__,__LINE__);

// Delete existing published versions
XT::query("
    DELETE FROM
        " . XT::getTable('articles_chapters') . "
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
            " . XT::getTable('articles_chapters') . "
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
        " . XT::getTable('articles_chapters_v') . "
    SET
        published = 1
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        rid = " . $article['rid'] . " AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);
$search->setTime($article['display_time_start'],$article['display_time_end']);
$search->setManualDate($article['date']);
$search->add(addslashes($article['subtitle']), 3);
$search->add(addslashes($article['autor']), 2);
$search->add(addslashes($article['maintext']), 1);
$searchimage = $article['image'] != "" ? $article['image'] : 0;

$search->build(addslashes($article['title']), addslashes($article['introduction']),$searchimage);

// $GLOBALS['plugin']->setAdminModule("o");

?>