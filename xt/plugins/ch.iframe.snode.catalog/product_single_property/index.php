<?php
if(!$GLOBALS['plugin']->getValue('article_id')){
    $GLOBALS['plugin']->setValue('article_id', $GLOBALS['plugin']->getSessionValue('article_id'));
}else{
    $GLOBALS['plugin']->setSessionValue('article_id',$GLOBALS['plugin']->getValue('article_id'));
}

// Parameter :: property
$property = $GLOBALS['plugin']->getParam('property') != '' ? $GLOBALS['plugin']->getParam('property') : false;

// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

$property = trim($property);


// Parameter :: $title
$title = $GLOBALS['plugin']->getParam('title') != '' ? $GLOBALS['plugin']->getParam('title') : $title;

// values
$result = XT::query("
		  SELECT
		      article_id,
		      field_id,
		      position,
              value,
              label
              
          FROM
            	" . XT::getTable("fields_values") . "
          WHERE
            	article_id = " . XT::getSessionValue('article_id') . " 
          AND
        	    field_id = " . $property . "
          AND
            	lang = '" . XT::getLang() . "'
          ORDER BY
            	article_id
          ASC
		",__FILE__,__LINE__);

$props =  XT::getQueryData($result);
if(count($props) == 1){
    XT::assign('PROPERTY', $props[0]);
}else {
    XT::assign('PROPERTY',$props);
}

XT::assign("TITLE", $title);



$content = XT::build($style);
?>