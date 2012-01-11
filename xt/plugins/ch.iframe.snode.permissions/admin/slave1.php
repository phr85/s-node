<?PHP




// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "slave1.tpl";
}
$content = XT::build($style);
?>