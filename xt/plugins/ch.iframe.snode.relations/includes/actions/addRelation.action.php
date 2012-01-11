<?php
// clean up
XT::query("DELETE FROM " . XT::getTable('relations') . " WHERE lang='" . XT::getLang() . "' AND content_id=0 AND content_type=0 AND target_content_id=0 AND target_content_type=0",__FILE__,__LINE__);
// create new element
XT::query("INSERT INTO " . XT::getTable('relations') . " (id,lang) VALUES (NULL,'" . XT::getLang() . "')",__FILE__,__LINE__,0);

$result = XT::query("SELECT id FROM " . XT::getTable('relations') . " WHERE  lang='" . XT::getLang() . "' AND content_id=0 AND content_type=0 AND target_content_id =0 AND target_content_type=0 ORDER by id DESC LIMIT 1",__FILE__,__LINE__);
$data = XT::getQueryData($result);
XT::setValue('relation_id', $data[0]['id']);
XT::setAdminModule("e");
?>