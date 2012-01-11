<?php

$time_start = microtime_float();

// Profile
if($GLOBALS['plugin']->getParam("profile") != ''){
    $profile = $GLOBALS['plugin']->getParam("profile");
}else{
    $profile = XT::getConfig('searchengine');
}
// Results per Page
if(is_numeric($GLOBALS['plugin']->getParam("results"))){
    $results_per_page = $GLOBALS['plugin']->getParam("results");
}else{
    $results_per_page = 10;
}
if(is_numeric($GLOBALS['plugin']->getValue("page"))){
    $show_page = $GLOBALS['plugin']->getValue("page");
}else{
    $show_page = 1;
}

XT::loadClass("search.class.php","ch.iframe.snode.search");

$search = new XT_Search($show_page,$results_per_page,$profile);

// Handle Parameters needed by object

// Similar
if(is_null($GLOBALS['plugin']->getParam("similar"))){
    $search->enableSoundex(true);
}else{
    $search->enableSoundex($GLOBALS['plugin']->getParam("similar"));
}


// Language
$search->setLang('sys');

//Content type
if(XT::getValue('content_type') != ""){
    $search->setContentType(XT::getValue('content_type'));
}
XT::assign('CONTENT_TYPE',XT::getValue('content_type'));

if($GLOBALS['plugin']->getParam("content_type") != ''){
    $search->setContentType($GLOBALS['plugin']->getParam("content_type"));
}

// Search
$search->search($GLOBALS['plugin']->getValue('term'));

// Pages
$pages = $search->totalResults / $results_per_page;
if ($search->totalResults % $results_per_page > 0){
    $pages++;
}
for ($i = 1; $i < $pages; $i++) {
    $PAGES[$i] = $i;
}

$GLOBALS['tpl']->assign("SIMILAR", $search->soundexed);
$GLOBALS['tpl']->assign("SEARCHTERM", $search->searchTerm);
$GLOBALS['tpl']->assign("RESULTS", $search->searchResults);
$GLOBALS['tpl']->assign("TOTAL", $search->totalResults);
$GLOBALS['tpl']->assign("PAGES", $PAGES);
if($GLOBALS['plugin']->getValue("page")>0){
    $GLOBALS['tpl']->assign("AKTUALPAGE", $GLOBALS['plugin']->getValue("page"));
}else {
    $GLOBALS['tpl']->assign("AKTUALPAGE", 1);
}

// Get content types
$result = XT::query("
    SELECT
        id,
        title
    FROM
        " . XT::getDatabasePrefix() . "content_types
    ORDER BY title
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[$row['id']] = $row;
}

XT::assign("CONTENT_TYPES", $data);

// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}

$time_end = microtime_float();
$time = round($time_end - $time_start,5);

XT::assign("ELAPSED_TIME", $time);
$content = XT::build($style);

function microtime_float()
{
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
}
?>
