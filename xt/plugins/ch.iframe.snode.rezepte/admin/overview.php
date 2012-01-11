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

// Count recipe (recipes)
$result = XT::query("SELECT count(id) as cnt FROM " . XT::getTable('rezepte'), __FILE__,__LINE__);
$count = XT::getQueryData($result);
$stats['products'] = $count[0]['cnt'];

// Count categories
$result = XT::query("SELECT count(id) as cnt FROM " . XT::getTable("tree"), __FILE__,__LINE__);
$count = XT::getQueryData($result);
$stats['categories'] = $count[0]['cnt'];

foreach ($GLOBALS['cfg']->getLangs() as $lang => $name){
    // Count active recipe in lang
    $result = XT::query("SELECT count(id) as cnt FROM " . XT::getTable("r_details") . " WHERE
                        lang = '" . $lang . "' AND active=1"
                        , __FILE__,__LINE__);
    $count = XT::getQueryData($result);
    $stats[$lang]['products'] = $count[0]['cnt'];
}

XT::assign("STATS", $stats);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
$content = XT::build('overview.tpl');
?>
