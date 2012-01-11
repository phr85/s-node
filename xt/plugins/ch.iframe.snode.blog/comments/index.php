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

// Parameter :: captcha
$captcha = XT::getParam('captcha')=="true" && $_SESSION['user']['id'] == "" ? true : false; // disable captcha with captcha="false" otherwise it will always be displayed.
$data['captcha'] = $captcha;


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
if(XT::getValue("pseudoaction")=='user_postComment'){
    if ($captcha == false || $_SESSION['captcha_comment_' . XT::getValue("content_type") . '_' . XT::getValue("content_id")] == md5(strtoupper($_REQUEST['captcha_comment_' . XT::getValue("content_type") . '_' . XT::getValue("content_id")]))) {
    	XT::call('user_postComment');
    } else {
    	$noinsert = true;
    }
}

if(!is_null($content_id)){

if(XT::getPermission("moderate")){
    $data['is_moderator'] = 1;
}else {
	$data['is_moderator'] = 0;
	$activeItemsOnly = "AND active=1";
}

// parameter reverseorder (umgekehrte sortierung) macht nur bei Flat sinn
$order = XT::getParam('reverseorder') != 'true' ? 'l DESC' : 'l ASC';

$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable("comments") . "
    WHERE
        content_type=" . XT::getValue("content_type") . "
    AND
        content_id=" . XT::getValue("content_id") . "
    " . $activeItemsOnly . "
    ORDER by
    " . $order ,__FILE__,__LINE__);

$data['data'] = XT::getQueryData($result,'id');

$data['user']['name']           = $_SESSION['user']['name'];
$data['user']['id']             = $_SESSION['user']['id'];
$data['user']['firstName']      = $_SESSION['user']['firstName'];
$data['user']['lastName']       = $_SESSION['user']['lastName'];
$data['user']['lang']           = $_SESSION['user']['lang'];
$data['user']['email']          = $_SESSION['user']['email'];
$data['user']['website']        = $_SESSION['user']['website'];

if ($noinsert) {
	$data['user']['name']           = XT::getValue('name');
	$data['comment']                = XT::getValue('comment');
	$data['user']['email']          = XT::getValue('email');
	$data['user']['website']        = XT::getValue('website');
}

if(is_array(XT::getSessionValue("user"))){
    $data['user'] = XT::getSessionValue("user");
}


// Assign this to display errors
$data['noinsert']= $noinsert;

XT::assign("xt" . XT::getBaseID() . "_comments", $data);

// build content
$content = XT::build($style);
}else {
	$content = XT::translate("no content_id");
}

if(!XT::getParam("keepassignment")){
    XT::clear_assign("xt" . XT::getBaseID() . "_viewer");
}

?>