<?php
// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

if(!$GLOBALS['plugin']->getValue('article_id')){
    $GLOBALS['plugin']->setValue('article_id', $GLOBALS['plugin']->getSessionValue('article_id'));
}else{
    $GLOBALS['plugin']->setSessionValue('article_id',$GLOBALS['plugin']->getValue('article_id'));
}

if($GLOBALS['plugin']->getSessionValue('article_id') != '') {
    $result = XT::query("
        SELECT 
            tn.title
        FROM
            " . $GLOBALS['plugin']->getTable('tree2articles') . " as ta
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('nodes') . " as tn
        ON 
            (ta.node_id=tn.node_id)
        
        WHERE 
            ta.article_id=" . $GLOBALS['plugin']->getSessionValue('article_id')
        ,__FILE__, __LINE__);
        
    $row = $result->fetchRow();
    XT::assign('TITLE', $row['title']);
}
$content = XT::build($style);
?>