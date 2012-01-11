<?PHP

if(XT::getPermission("userperm")){
$result = XT::query("SELECT *
from
xt_files
where upload_user=" . $_SESSION['user']['id'] . " ORDER by id DESC
" ,__FILE__,__LINE__);
XT::assign("DATA",XT::getqueryData($result));

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