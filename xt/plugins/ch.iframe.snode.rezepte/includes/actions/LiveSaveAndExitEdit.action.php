<?php
XT::call("LiveSaveRecipe");

if(LANGFILE !='LANGFILE'){
    $indexfile = LANGFILE;
}else{
    $indexfile = "index.php";
}


header("Location: http://" . $_SERVER['HTTP_HOST'] . "/" . $indexfile . "?TPL=" . XT::getParam("overview_tpl"));

?>