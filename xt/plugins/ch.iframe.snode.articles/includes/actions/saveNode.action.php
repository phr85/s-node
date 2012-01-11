<?php

$title = $GLOBALS['plugin']->getValue("title");

// public_flag switch
if(XT::getValue("public")=="on"){
    $public = 1;
}else{
    $public = 0;
}

// gibt es den node?
$res = XT::query("SELECT count(*) as cnt from " . XT::getTable("articles_tree_details") . " WHERE
            node_id = " . $GLOBALS['plugin']->getValue("node_id") . "
        AND
            lang =  '" . $GLOBALS['plugin']->getValue("save_lang") . "'" ,__FILE__,__LINE__);
$cnt = XT::getQueryData($res);

// wenn nicht wird er hier erstellt
if($cnt[0]['cnt']==0){
    XT::query("INSERT INTO " . XT::getTable("articles_tree_details") . " set node_id = " . $GLOBALS['plugin']->getValue("node_id") . ",
    lang =  '" . $GLOBALS['plugin']->getValue("save_lang") . "'",__FILE__,__LINE__);
}


XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable("articles_tree_details") . " set
            title =  '" . $title . "',
            description =  '" . $GLOBALS['plugin']->getValue('description') . "',
            image = '" . XT::getValue('image') . "',
            image_version = '" . XT::getValue('image_version') . "',
            public = '" . $public . "'

        WHERE
            node_id = " . $GLOBALS['plugin']->getValue("node_id") . "
        AND
            lang =  '" . $GLOBALS['plugin']->getValue("save_lang") . "'",__FILE__,__LINE__);

// Instantiate indexing object and index main fields
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex($GLOBALS['plugin']->getValue('node_id'),$GLOBALS['plugin']->getContentType("Article Category"),0);
$search->setLang($GLOBALS['plugin']->getActiveLang());
$searchimage = XT::getValue('image') > 0 ? XT::getValue('image') : 0;
$search->build($title, $GLOBALS['plugin']->getValue('description'),$searchimage);


?>