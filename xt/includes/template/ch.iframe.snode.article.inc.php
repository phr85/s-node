<?php
// Register our function
$tpl->register_function("xt_get_category_from_article","xt_get_category_from_article");
/**
 * Get the data of the parent category for an article
 * @param array $params $params['id'] is the id of the child article and $params['assign'] is the assign variable. If no assign is given the function stores the result in CATEGORY_FROM_ARTICLE.
 *
 * i.e:
 * {xt_get_category_from_article id=$ARTICLE.id}
 * {$CATEGORY_FROM_ARTICLE.title}
 */
function xt_get_category_from_article($params)
{
    // get the article id
    $article_id = $params['id'];

    if ($params['assign'] == "") {
        $assign = "CATEGORY_FROM_ARTICLE";
    } else {
        $assign = $params['assign'];
    }
    // Check if the id is numeric
    if (is_numeric($article_id)) {
	    // Get all data
	    $sql = "SELECT det.* FROM  " . XT::getDatabasePrefix()  . "articles_tree_rel as rel, " . XT::getDatabasePrefix()  . "articles_tree_details as det  WHERE rel.article_id = " . $article_id ." AND rel.node_id = det.node_id";
	    $result = XT::query($sql,__FILE__,__LINE__);
	    $data  = XT::getQueryData($result);
    } else {
    	 $data[0] = "No id set!";
    }
    XT::assign($assign,$data[0]);
}

// Register our modifier
$tpl->register_modifier("xt_is_article_active","xt_is_article_active");

/**
 * Determin wheter an article is activated or deactivated
 * @param int $value article id.
 * @return boolen True if the article is active
 * 
 * i.e:
 * {xt_get_category_from_article id=$ARTICLE.id}
 * {$CATEGORY_FROM_ARTICLE.title}
 */
function xt_is_article_active($value)
{
   	$return = false;
   	if (is_numeric($value)){
	    // Get all data
	    $sql = "SELECT * FROM  " . XT::getDatabasePrefix()  . "articles WHERE active=1 AND id = " . $value;
	    $result = XT::query($sql,__FILE__,__LINE__,0);
	    $row = $result->fetchRow();
	    if (is_array($row)) {
	    	$return = true;
	    }
   	}
	return $return;
}

?>