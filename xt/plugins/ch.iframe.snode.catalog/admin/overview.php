<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

/**
 * addUser
 *
 * @package S-node
 * @subpackage Catalog
 * @author Veith Zaech <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: overview.php 1341 2005-08-08 10:50:49Z vzaech $
 */

// Count articles (products)
$result = XT::query("SELECT count(id) as cnt FROM " . $GLOBALS['plugin']->getTable("articles"), __FILE__,__LINE__);
$count = XT::getQueryData($result);
$stats['products'] = $count[0]['cnt'];

// Count categories
$result = XT::query("SELECT count(id) as cnt FROM " . $GLOBALS['plugin']->getTable("tree"), __FILE__,__LINE__);
$count = XT::getQueryData($result);
$stats['categories'] = $count[0]['cnt'];

foreach ($GLOBALS['cfg']->getLangs() as $lang => $name){
    // Count active articles in lang
    $result = XT::query("SELECT count(id) as cnt FROM " . $GLOBALS['plugin']->getTable("articles_details") . " WHERE
                        lang = '" . $lang . "' AND active=1"
                        , __FILE__,__LINE__);
    $count = XT::getQueryData($result);
    $stats[$lang]['products'] = $count[0]['cnt'];
}

XT::assign("STATS", $stats);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
$content = XT::build('overview.tpl');
?>
