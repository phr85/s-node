<?PHP

$input = strtolower( utf8_encode($_GET['input'] ));

$len = strlen($input);
if ($len){
    $result = XT::query("
	    SELECT idet.* , ing.kcal, ing.usda_id, ing.default_unit_id as unit_id
	    FROM 
	       " . XT::getTable("i_details") . " as idet
	    LEFT JOIN
	          " . XT::getTable("ingridients") . " as ing on (ing.id = idet.id)
	    WHERE 
	       idet.lang='" . XT::getPluginLang() . "' 
	    AND 
	       idet.name like '%" . $input . "%'"
    ,__FILE__,__LINE__);
    XT::assign("DATA",XT::getQueryData($result));
}

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0




if (isset($_REQUEST['json']))
{
    header("Content-Type: application/json");
    $style = "json.tpl";
}
else
{
    header("Content-Type: text/xml");
    $style = "xml.tpl";
}

$content = XT::build($style);
?>