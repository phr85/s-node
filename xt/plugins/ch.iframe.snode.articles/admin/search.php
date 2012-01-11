<?php

if(XT::getValue('term') != ''){
XT::loadClass('search.class.php','ch.iframe.snode.search');
    $search = new XT_Search();
    $search->setContentType(270);
    $search->enableSoundex(true);
    $search->setLang(XT::getValue('lang_filter'));
    $search->search(XT::getValue('term'));
    XT::assign("SEARCHTERM",XT::getValue('term'));
    
    // Get results
    if($search->_content_in != ''){
        $result = XT::query("
            SELECT
                title,
                id
            FROM
                " . XT::getTable('articles_v') . "
            WHERE
                latest = 1 AND
                lang = '" . XT::getPluginLang() . "' AND
                id IN (" . $search->_content_in . ")
            GROUP BY
                id
        ",__FILE__,__LINE__,0);
        
        $results = array();
        while($row = $result->FetchRow()){
            $results[] = $row;
        }
        
        XT::assign("ARTICLES", $results);
    }
}

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build('search.tpl');

?>
