<?php

// Profile
if($GLOBALS['plugin']->getParam("profile") != ''){
    $profile = $GLOBALS['plugin']->getParam("profile");
}else{
    $profile = "global";
}
// Results per Page
if(is_numeric($GLOBALS['plugin']->getParam("results"))){
    $results_per_page = $GLOBALS['plugin']->getParam("results");
}else{
    $results_per_page = 10;
}

require_once(CLASS_DIR . "search.sys.class.php");
$search = new XT_Search_Sys($GLOBALS['plugin']->getValue("page"),$results_per_page,$profile);

// Handle Parameters needed by object

// Similar
if(is_null($GLOBALS['plugin']->getParam("similar"))){
    $search->enableSoundex(true);
}else{
    $search->enableSoundex($GLOBALS['plugin']->getParam("similar"));
}


//Content type
if($GLOBALS['plugin']->getValue('content_type') !=""){
    $search->setContentType($GLOBALS['plugin']->getValue('term'));
}
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
$PAGES=array();
for ($i = 1; $i < $pages; $i++) {
    $PAGES[$i] = $i;
}

XT::assign("SIMILAR", $search->soundexed);
XT::assign("SEARCHTERM", $search->searchTerm);
XT::assign("RESULTS", $search->searchResults);
XT::assign("TOTAL", $search->totalResults);
XT::assign("PAGES", $PAGES);
XT::assign("AKTUALPAGE", $GLOBALS['plugin']->getValue("page"));

//XT::printArray($search->details_in);


// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);
?>
