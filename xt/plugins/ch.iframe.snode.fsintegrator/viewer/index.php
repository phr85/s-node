<?php
// get the style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// get the directory
$dir = XT::getParam('dir') != '' ? XT::getParam('dir') : 'xt/tmp/';

// get the filter
$filter = XT::getParam('filter') != "" ? XT::getParam('filter'): "";

// get the sort
$sort = XT::getParam('sort') != "" ? XT::getParam('sort'): "";

$It =  @opendir($dir);
if ($It == ""){
	$error = XT::translate('Cannot list files for') . " ". $dir;
 }
function LoadFiles($dir,$filter="",$basedir ="")
{
	 $Files = array();
	 $It =  @opendir($dir);
	 if ($basedir == "") {
	 	$basedir = $dir;
	 }
	 
	 while ($Filename = @readdir($It)){
		if ($Filename != '.' && $Filename != '..' && !ereg("^\..*",$Filename)){
	  		if(is_dir($dir . $Filename)){
	  			$Files[] = array("dir"=> 1, "location" => $dir .$Filename, "filename" => $Filename,"depth" => count(explode("/",str_replace($basedir,"",$dir))) - 1,"lastmodified" => $LastModified);
	   			$Files = array_merge($Files, LoadFiles($dir . $Filename.'/',$filter,$basedir));
	   		}elseif ($filter=="" || preg_match( $filter, $Filename ) ){
	   				$LastModified = filemtime($dir . $Filename);
	   				$Files[] = array("dir"=> 0, "location" => $dir .$Filename, "filename" => $Filename,"depth" => count(explode("/",str_replace($basedir,"",$dir))) - 1,"lastmodified" => $LastModified);
	  		}else{
	   			continue;
	 	}
	}
}
  return $Files;
}
function DateCmp($a, $b)
{
  return  strnatcasecmp($a[1] , $b[1]) ;
}

function NameCmp($a, $b)
{
  return  strnatcasecmp($a["filename"] , $b["filename"]) ;
}



$Files = LoadFiles($dir, $filter);

switch($sort){
	
	case "filename":
		usort($Files, 'NameCmp');
	break;
	
	case "lastmodified":
		usort($Files, 'DateCmp');
	break;
}


XT::assign("FILES",$Files);
// build finaly the whole content
if ($error == "") {
	$content = XT::build($style);
}else{
	$content = $error;
}
?>