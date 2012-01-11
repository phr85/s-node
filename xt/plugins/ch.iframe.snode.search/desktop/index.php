<?php
// Handle Parameters needed by constructor
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

require_once(CLASS_DIR . "search.class.php");
$search = new XT_Search($GLOBALS['plugin']->getValue("page"),$results_per_page,$profile);

// Handle Parameters needed by object

// Similar
if(is_null($GLOBALS['plugin']->getParam("similar"))){
    $search->enableSoundex(true);
}else{
    $search->enableSoundex($GLOBALS['plugin']->getParam("similar"));
}

// Language
if($GLOBALS['plugin']->getParam("lang") != ''){
    $search->setLang($GLOBALS['plugin']->getParam("lang"));
}else{
    $search->setLang($GLOBALS["lang"]->getLang());
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
$GLOBALS['tpl']->assign("AKTUALPAGE", $GLOBALS['plugin']->getValue("page"));
$content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'default.tpl');
?>
