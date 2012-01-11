<?php

$result = XT::query("
    SELECT count(id) as anz FROM  
        " . $GLOBALS['plugin']->getTable('files_details') . "
	WHERE
        id = " . XT::getValue("file_id") . " AND
        lang = '" . XT::getValue("save_lang") . "'
    ",__FILE__,__LINE__,0);
$row = $result->FetchRow();
// Touch to get a new record. It will update later.
if ($row['anz'] == 0) {
	XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable('files_details') . "
    (id,lang) VALUES (" . XT::getValue("file_id") . ",'" . XT::getValue("save_lang")  . "'); 
    ",__FILE__,__LINE__,0);
}
XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable('files_details') . "
    SET
        title = '" . XT::getValue("Ftitle") . "',
        description = '" . XT::getValue("Fdescription") . "',
        keywords = '" . XT::getValue("Fkeywords") . "'
	WHERE
        id = " . XT::getValue("file_id") . " AND
        lang = '" . XT::getValue("save_lang") . "'
    ",__FILE__,__LINE__,0);

require_once(CLASS_DIR . "fileindexer.class.php");
$fileindexer = new XT_FileIndexer();
$filecontent = $fileindexer->index($GLOBALS['plugin']->getConfig('file_upload_dir') . XT::getValue("file_id"), XT::getValue("filename"));


XT::loadClass('searchindex.class.php','ch.iframe.snode.search');
$search = new XT_SearchIndex(XT::getValue("file_id"),$GLOBALS['plugin']->getContentType("File"),XT::getValue('Fpublic'));
$search->setLang(XT::getPluginLang());
$search->add(XT::getValue("Fkeywords"), 1);
$search->add($filecontent, 1);
$search->add(XT::getValue('filename'), 1);
$search->build(XT::getValue("Ftitle"), XT::getValue("Fdescription"));

if(XT::getValue('Fimage') > 0){
    $search->setImage(XT::getValue("Fimage"));
} else {
    if(XT::getValue("Ftype") == 1){
        $search->setImage(XT::getValue("file_id"));
    }
}
?>