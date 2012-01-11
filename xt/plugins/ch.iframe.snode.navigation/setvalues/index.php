<?PHP
if(is_string($_REQUEST['form'])){
    $GLOBALS['plugin']->setSessionValue("form",$_REQUEST['form']);
}
if(is_string($_REQUEST['field'])){
    $GLOBALS['plugin']->setSessionValue("field",$_REQUEST['field']);
}
if(is_string($_REQUEST['titlefield'])){
    $GLOBALS['plugin']->setSessionValue("titlefield",$_REQUEST['titlefield']);
}
if(is_string($_REQUEST['mode'])){
    $GLOBALS['plugin']->setSessionValue("mode",$_REQUEST['mode']);
}


?>