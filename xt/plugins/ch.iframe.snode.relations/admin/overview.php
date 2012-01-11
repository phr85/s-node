<?php
$GLOBALS['plugin']->contribute('overview_buttons','Add relation', 'addRelation','document_new.png','0','slave1');
$GLOBALS['plugin']->contribute('overview_buttons','reindex', 'reindexRelations','refresh.png','0','master');

// Get open content type
if (XT::getValue("open_ct")) {
    // If other content type selected, reset open article
    if (XT::getSessionValue("open_ct") != XT::getValue("open_ct")) {
        XT::setSessionValue("open_element", 0);
    }
    XT::setSessionValue("open_ct", XT::getValue("open_ct"));
}

// Get open article
if (XT::getValue("open_element")) {
    XT::setSessionValue("open_element", XT::getValue("open_element"));
}

// Get the data
$result = XT::query("SELECT
re.id as relation_id, re.title as relation_title,
re.content_type as source_content_type,si_source.title as source_title,re.content_id as source_content_id,
re.target_content_type as target_content_type, si_target.title as target_title ,re.target_content_id as  target_content_id,
source_ct.title as source_ct_title, source_ct.open_url as source_open_url, source_ct.id_field as source_open_url_id,
target_ct.title as target_ct_title, target_ct.open_url as target_open_url, target_ct.id_field as target_open_url_id, re.position as relation_position
FROM " . XT::getTable("relations") . " as re
LEFT JOIN " . XT::getTable("content_types") . " as source_ct ON (re.content_type = source_ct.id)
LEFT JOIN " . XT::getTable("content_types") . " as target_ct ON (re.target_content_type = target_ct.id)
LEFT JOIN " . XT::getDatabasePrefix() . "search_infos_global_" .  $GLOBALS['plugin']->getActiveLang(). " as si_source on (si_source.content_type = re.content_type AND si_source.content_id=re.content_id)
LEFT JOIN " . XT::getDatabasePrefix() . "search_infos_global_" .  $GLOBALS['plugin']->getActiveLang() . " as si_target on (si_target.content_type = re.target_content_type AND si_target.content_id=re.target_content_id)
WHERE re.lang='" . $GLOBALS['plugin']->getActiveLang(). "' ORDER by re.position ASC
",__FILE__,__LINE__);

while ($row = $result->fetchRow()) {
    if($row['source_content_type'] != 0){
        $relations[$row['source_content_type']]['title'] = $row['source_ct_title'];
        $relations[$row['source_content_type']]['open_url'] = $row['source_open_url'];
        $relations[$row['source_content_type']]['open_url_id'] = $row['source_open_url_id'];
        $relations[$row['source_content_type']]['relation'][$row['source_content_id']]['title'] = $row['source_title'];
        $relations[$row['source_content_type']]['relation'][$row['source_content_id']]['elements'][$row['target_content_id']]['relation_id'] = $row['relation_id'];
        $relations[$row['source_content_type']]['relation'][$row['source_content_id']]['elements'][$row['target_content_id']]['relation_title'] = $row['relation_title'];
        $relations[$row['source_content_type']]['relation'][$row['source_content_id']]['elements'][$row['target_content_id']]['relation_position'] = $row['relation_position'];
        $relations[$row['source_content_type']]['relation'][$row['source_content_id']]['elements'][$row['target_content_id']]['opponent_content_id'] = $row['target_content_id'];
        $relations[$row['source_content_type']]['relation'][$row['source_content_id']]['elements'][$row['target_content_id']]['opponent_content_type'] = $row['target_content_type'];
        $relations[$row['source_content_type']]['relation'][$row['source_content_id']]['elements'][$row['target_content_id']]['opponent_content_title'] = $row['target_title'];
        $relations[$row['source_content_type']]['relation'][$row['source_content_id']]['elements'][$row['target_content_id']]['opponent_content_type_title'] = $row['target_ct_title'];
        $relations[$row['source_content_type']]['relation'][$row['source_content_id']]['elements'][$row['target_content_id']]['relation_type'] = 'source';
    }

    if($relations[$row['target_content_type']]['relation'][$row['target_content_id']]['elements'][$row['source_content_id']]['opponent_content_id'] == $row['source_content_id']){
        $relations[$row['target_content_type']]['relation'][$row['target_content_id']]['elements'][$row['source_content_id']]['doublerelation'] = '1';
        $relations[$row['source_content_type']]['relation'][$row['source_content_id']]['elements'][$row['target_content_id']]['doublerelation'] = '1';
    }
    if($row['target_content_type'] != 0){
        $relations[$row['target_content_type']]['title'] = $row['target_ct_title'];
        $relations[$row['target_content_type']]['open_url'] = $row['target_open_url'];
        $relations[$row['target_content_type']]['open_url_id'] = $row['target_open_url_id'];
        $relations[$row['target_content_type']]['relation'][$row['target_content_id']]['title'] = $row['target_title'];
        $relations[$row['target_content_type']]['relation'][$row['target_content_id']]['elements'][$row['source_content_id']]['relation_id'] = $row['relation_id'];
        $relations[$row['target_content_type']]['relation'][$row['target_content_id']]['elements'][$row['source_content_id']]['relation_title'] = $row['relation_title'];
        $relations[$row['target_content_type']]['relation'][$row['target_content_id']]['elements'][$row['source_content_id']]['relation_position'] = $row['relation_position'];
        $relations[$row['target_content_type']]['relation'][$row['target_content_id']]['elements'][$row['source_content_id']]['opponent_content_id'] = $row['source_content_id'];
        $relations[$row['target_content_type']]['relation'][$row['target_content_id']]['elements'][$row['source_content_id']]['opponent_content_type'] = $row['source_content_type'];
        $relations[$row['target_content_type']]['relation'][$row['target_content_id']]['elements'][$row['source_content_id']]['opponent_content_title'] = XT::getTitleByContentType($row['source_content_type'],$row['source_content_id'], $GLOBALS['plugin']->getActiveLang() );
        $relations[$row['target_content_type']]['relation'][$row['target_content_id']]['elements'][$row['source_content_id']]['opponent_content_type_title'] = $row['source_ct_title'];
        $relations[$row['target_content_type']]['relation'][$row['target_content_id']]['elements'][$row['source_content_id']]['relation_type'] = 'target';
    }
}
XT::assign('RELATIONS', $relations);
XT::assign("OPEN_CT", XT::getSessionValue("open_ct"));
XT::assign("OPEN_ELEMENT", XT::getSessionValue("open_element"));
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());
$content = XT::build("overview.tpl");
?>