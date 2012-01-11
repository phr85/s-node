<?PHP
if(XT::getPermission("userperm")){
// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);
}else {
	$content = XT::translate("Permission denied");
}
?>