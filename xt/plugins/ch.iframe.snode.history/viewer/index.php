<?PHP
XT::assign("DATA",XT::getSessionValue("history"));
XT::assign("TITLE",XT::getParam("title"));
// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);
?>