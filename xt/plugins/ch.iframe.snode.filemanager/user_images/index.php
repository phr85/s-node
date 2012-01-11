<?PHP

if(XT::getPermission("userperm")){
$result = XT::query("SELECT fi.*
from
xt_files as fi
where fi.upload_user=" . $_SESSION['user']['id'] . " AND fi.type = 1 GROUP by fi.id ORDER by fi.id DESC
" ,__FILE__,__LINE__);
XT::assign("DATA",XT::getqueryData($result));

$req['form'] = $_REQUEST['form'];
$req['field'] =  $_REQUEST['field'];
$req['titlefield'] =  $_REQUEST['titlefield'];

XT::assign("REQ",$req);

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