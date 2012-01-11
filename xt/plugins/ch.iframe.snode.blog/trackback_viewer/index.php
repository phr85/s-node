<?php

$data = array();
$noinsert = false;

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Parameter :: content_type
$content_type = XT::getParam('content_type') != '' ? XT::getParam('content_type') : 60;
$data['metadata']['content_type'] = $content_type;

// Parameter :: content_id
$content_id = XT::getParam('content_id') != '' ? XT::getParam('content_id') : null;

$data['metadata']['comment_id'] = XT::getValue('comment_id');

// wenn weder content_type noch content_id gesetzt wurden TPL als content_id verwenden
if($content_type == 60 && is_null($content_id)){
    $content_id = $GLOBALS['tpl_id'] ;
}

// wenn content_type gesetzt wurde, jedoch keine content_id versuche die content_id anhand GLOBALS['relations'][$content_type] zu ermitteln
if(is_null($content_id)){
    if(is_array($GLOBALS['relations'][$content_type])){
        foreach ($GLOBALS['relations'][$content_type] as $key => $value) {
            $content_id = $key;
        }

    }
}

$data['metadata']['content_id'] = $content_id;

// Aktion erst ausführen wenn cid und ctype bekannt sind
XT::setValue("content_type",$content_type);
XT::setValue("content_id",$content_id);

if(!is_null($content_id)){
	
	if(XT::getPermission("moderate")){
	    $data['is_moderator'] = 1;
	} else {
		$data['is_moderator'] = 0;
		$activeItemsOnly = "AND active=1";
	}

	// parameter reverseorder (umgekehrte sortierung) macht nur bei Flat sinn
	$order = XT::getParam('reverseorder') != '' ? 'date DESC' : 'date ASC';
	
	$result = XT::query("
	    SELECT
	        *
	    FROM
	        " . XT::getTable("comments_trackback_incomming") . "
	    WHERE
	        content_type=" . XT::getValue("content_type") . "
	    AND
	        content_id=" . XT::getValue("content_id") . "
	    " . $activeItemsOnly . "
	    ORDER by
	    " . $order ,__FILE__,__LINE__);
	
	$data = XT::getQueryData($result,'id');
	
	XT::assign("xt" . XT::getBaseID() . "_trackback_viewer", $data);
	
	// build content
	$content = XT::build($style);
}else {
	$content = XT::translate("no content_id");
}

if(!XT::getParam("keepassignment")){
    XT::clear_assign("xt" . XT::getBaseID() . "_viewer");
}

?>