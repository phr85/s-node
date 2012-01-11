<?php
// Register our function
$tpl->register_function("xt_get_trackback","xt_get_trackback");
/**
 * Get all trackbacks sent for  specific source url
 * @param array $params $params['url'] is the source url and $params['assign'] is the assign variable. If no assign is given the function stores the result in PINGED_TRACKBACKS.
 */
function xt_get_trackback($params){

	$source_url = $params['url'];
	$source_url = str_replace("&","&amp;",$source_url);
	if ($params['assign'] == "") {
		$assign = "PINGED_TRACKBACKS";
	} else {
		$assign = $params['assign'];
	}
	// Get all sent trackbacks for an url
	$sql = "SELECT * FROM  " . XT::getDatabasePrefix()  . "comments_trackback_outgoing  WHERE source_url = '" . $source_url . "' ORDER BY  date DESC ";
	$result = XT::query($sql,__FILE__,__LINE__);
	$data  = XT::getQueryData($result);
	XT::assign($assign,$data);
}

// Register our function
$tpl->register_function("xt_count_comments","xt_count_comments");
/**
 * Make a count over all comments and store it as array to chart it later
 *  @param array $params $params['assign'] is the assign variable. If no assign is given the function stores the result in COUNT_COMMENTS.
 *
 * Example to get the number of posts for an article list (270 Contenttype of an article)
 * {xt_count_comments assign="COMMENTS_COUNT" content_type=int [content_ids=array] [assign=string]}
 * {foreach from=$DATA item=NEWS}
 * ...
 * 		{$COMMENTS_COUNT[$NEWS.id]}
 * ...
 * {/foreach}
 */
function xt_count_comments($params){
     $ctype = $params['content_type'];
     // wenn ein array mit den content ids gegeben wird filter setzen
     if (is_array($params['content_ids'])) {
        $in = " AND content_id in (" . implode(",",$params['content_ids']) . ") ";
     }

     if ($ctype == "") { $ctype = 0;}
	// Get all comments for a content_type
	$result = XT::query("SELECT content_id,  count(content_id) as cnt FROM " . XT::getDatabasePrefix()  . "comments  WHERE active=1 AND content_type=" . $ctype . $in .  " group by content_id",__FILE__,__LINE__);
	while($row = $result->FetchRow()){
		$counter[$row['content_id']] = $row['cnt'];
	}
	if ($params['assign'] == "") {
		$assign = "COUNT_COMMENTS";
	} else {
		$assign = $params['assign'];
	}
	XT::assign($assign,$counter);
}

/**
 * Get last comments
 *  @param array $params $params['assign'] is the assign variable. If no assign is given the function stores the result in LAST_COMMENTS.
 *  @param array $params $params['content_type'] get just comments from a specified content type.
 *	@param array $params $params['limit'] Set the ammount of returned comments. Default is one.
 *
 */
$tpl->register_function("xt_last_comments","xt_last_comments");
function xt_last_comments($params){
     // Content type
     $ctype = $params['content_type'];
     if (is_numeric($ctype)) { $ctype = " AND content_type=" . $ctype ;}
     $limit = $params['limit'];
     if ($limit == "") { $limit = 1;}

    // Get last comments
    $sql = "SELECT * FROM  " . XT::getDatabasePrefix()  . "comments  WHERE active=1 " . $ctype . " ORDER BY id DESC LIMIT " . $limit ;
	$result = XT::query($sql,__FILE__,__LINE__);
    $data  = XT::getQueryData($result);

    if ($params['assign'] == "") {
        $assign = "LAST_COMMENTS";
    } else {
        $assign = $params['assign'];
    }
    XT::assign($assign,$data);
}

/*
 * -------------------------------------------------------------
 * File:     	function.gravatar.php
 * Type:     	function
 * Name:     	gravatar
 * Description: This TAG creates a valid URL to a Gravatar.
 *
 * See http://en.gravatar.com/ for further information.
 * -------------------------------------------------------------
 * @copyright Copyright (C) 2008 Kevin Papst
 * @see http://www.kevinpapst.de/
 * @license GNU Public License (GPL)
 *
 * -------------------------------------------------------------
 * Parameter:
 * - email      = the email to fetch the gravatar for (required)
 * - default    = full url to the default image in case of none existing OR
 *                invalid rating (required, only if "email" is not set)
 * - width      = the images width
 * - rating     = the highest possible rating displayed image [ G | PG | R | X ]
 * - assign     = if you want to assign the URL to a template variable instead
 *                of returning it directly
 * -------------------------------------------------------------
 * Example usage:
 *
 * <img src="{gravatar email="example@example.com"}">
 * <img src="{gravatar email="example@example.com" rating="PG" size="40" default="http://www.example.com/gravatar.gif"}">
 *
 * {gravatar email="example@example.com" size="40" assign="gravatarUrl"}
 * <img src="{$gravatarUrl}">
 */
$tpl->register_function("xt_gravatar","xt_gravatar");
function xt_gravatar($params, &$smarty) {
	// check for email adress
	if(!isset($params['email']) && !isset($params['default'])) {
		$smarty->trigger_error("gravatar: neither 'email' nor 'default' attribute passed");
		return;
	}

	$email = (isset($params['email']) ? trim(strtolower($params['email'])) : '');
	$rating = (isset($params['rating']) ? $params['rating'] : 'R');
	$url = "http://www.gravatar.com/avatar/".md5($email) . "?r=".$rating;

	if(isset($params['default']))
		$url .= "&d=".urlencode($params['default']);
	if(isset($params['size']))
		$url .= "&s=".$params['size'];

	if(isset($params['assign'])) {
		$smarty->assign($params['assign'], $url);
		return;
	}

	return $url;
}

?>