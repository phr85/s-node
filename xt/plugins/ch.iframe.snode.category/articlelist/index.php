<?php

/**
 * input, parameter...
 */
$data = array();
$data['metadata']['style'] = XT::autoval("style", "P", "default.tpl");
$data['metadata']['node'] = XT::autoval("node", "R", "1");
$data['metadata']['order'] = XT::autoval("order", "P", "rel.position");
$data['metadata']['orderdir'] = XT::autoval("orderdir", "P", 1);
$data['metadata']['ordername'] = XT::autoval("ordername", "P", "articlelist");
$data['metadata']['detailtpl'] = XT::autoval("detailtpl", "P", 113);

/**
 * order
 */
XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order("article.id,article.title,article.date,article.creation_date", $data['metadata']['order'], $data['metadata']['orderdir'], $data['metadata']['ordername']);
$order->setListener("order","orderdir");

/**
 * data
 */
$result = XT::query("
    SELECT
        cat.title AS node_title,
        article.id,
        article.title,
        article.subtitle,
        article.date,
        article.autor,
        article.introduction,
        article.image,
        article.image_version,
        article.image_link,
        article.image_link_target,
        article.image_zoom,
        chapter.level AS chapter_level,
        chapter.title AS chapter_title,
        chapter.subtitle AS chapter_subtitle,
        chapter.maintext AS chapter_maintext,
        chapter.image AS chapter_image,
        chapter.image_version AS chapter_image_version,
        chapter.image_link AS chapter_image_link,
        chapter.image_link_target AS chapter_image_link_target,
        chapter.image_zoom AS chapter_image_zoom,
        chapter.layout AS chapter_layout
    FROM
        " . XT::getTable("nodes") . " AS cat
    LEFT JOIN
        " . XT::getTable("relations") . " AS rel ON (
            rel.content_id = cat.node_id AND
            rel.content_type = " . XT::getBaseID() . " AND
            rel.target_content_type = 270 AND
            rel.lang = '" . XT::getLang() . "'
        )
    LEFT JOIN
        " . XT::getTable("articles") . " AS article ON (
            article.id = rel.target_content_id AND
            article.lang = '" . XT::getLang() . "' AND
            article.active = 1 AND
            (article.display_time_start = 0 OR article.display_time_start < " . TIME . ") AND
            (article.display_time_end = 0 OR article.display_time_end > " . TIME . ")
        )
    LEFT JOIN
        " . XT::getTable("articles_chapters") . " AS chapter ON (
            chapter.id = article.id AND
            chapter.lang = '" . XT::getLang() . "' AND
            chapter.active = 1
        )
    WHERE
        cat.node_id = {$data['metadata']['node']} AND
        cat.lang = '" . XT::getLang() . "' AND
        cat.active = 1
        {$order->get()},
        chapter.level
",__FILE__,__LINE__);

while($row = $result->fetchRow()) {
    $data['metadata']['node_title'] = $row['node_title'];
    $data['data'][$row['id']]['id'] = $row['id'];
    $data['data'][$row['id']]['title'] = $row['title'];
    $data['data'][$row['id']]['subtitle'] = $row['subtitle'];
    $data['data'][$row['id']]['date'] = $row['date'];
    $data['data'][$row['id']]['autor'] = $row['autor'];
    $data['data'][$row['id']]['introduction'] = $row['introduction'];
    $data['data'][$row['id']]['image'] = $row['image'];
    $data['data'][$row['id']]['image_version'] = $row['image_version'];
    $data['data'][$row['id']]['image_link'] = $row['image_link'];
    $data['data'][$row['id']]['image_link_target'] = $row['image_link_target'];
    $data['data'][$row['id']]['image_zoom'] = $row['image_zoom'];
    $data['data'][$row['id']]['chapters'][$row['chapter_level']]['title'] = $row['chapter_title'];
    $data['data'][$row['id']]['chapters'][$row['chapter_level']]['subtitle'] = $row['chapter_subtitle'];
    $data['data'][$row['id']]['chapters'][$row['chapter_level']]['maintext'] = $row['chapter_maintext'];
    $data['data'][$row['id']]['chapters'][$row['chapter_level']]['image'] = $row['chapter_image'];
    $data['data'][$row['id']]['chapters'][$row['chapter_level']]['image_version'] = $row['chapter_image_version'];
    $data['data'][$row['id']]['chapters'][$row['chapter_level']]['image_link'] = $row['chapter_image_link'];
    $data['data'][$row['id']]['chapters'][$row['chapter_level']]['image_link_target'] = $row['chapter_image_link_target'];
    $data['data'][$row['id']]['chapters'][$row['chapter_level']]['image_zoom'] = $row['chapter_image_zoom'];
    $data['data'][$row['id']]['chapters'][$row['chapter_level']]['layout'] = $row['chapter_layout'];
}

/**
 * Template aufbauen
 */
XT::assign("xt" . XT::getBaseID() . "_articlelist", $data);
$content = XT::build($data['metadata']['style'] );