<?php
/**
 * Function that returns the image information like the php function getimagesize.
 * @param  string value The id of the image or the id and the version of the image seperated with a comma. Default version is 1
 * @return array the output from getimagsize for the specified image id and version.
 */
function xt_getImageSize($value) {
	// Define all vars
    (int) $imageid = 0;
    (int) $imageversion = 1;

    // If the value is just a numeric value, then it's just the image id
    if (is_numeric($value)) {
    	$imageid = $value;
    }

    // If the imageid and the imageversion are set seperated with a comma,
    // extract the id and the version
    if (strstr($value,',')) {
    	(string) $tmp = explode(',',$value);
    	$imageversion = $tmp[1];
    	$imageid = $tmp[0];
    }

    return @getimagesize(DATA_DIR . 'files/' . $imageid . "_" .  $imageversion);
}

$tpl->register_modifier("xt_imagewidth","xt_imagewidth");
/**
 * Smarty modifier to return the with of an image in the filemanager
 * @param  string value The id of the image or the id and the version of the image seperated with a comma. Default version is 1
 * @return int width of the image or the version of the image
 * Example: width: {"`$CHAPTER.image`,`$CHAPTER.image_version`"|xt_imagewidth}px;
 */
function xt_imagewidth($value){
    (array) $return = xt_getImageSize($value);

    // return 1 if an error occur. That prevent us from math errors.
    if(!is_numeric($return[0]) || !is_array($return)) {
    	return 1;
    } else {
    	return $return[0];
    }
}

$tpl->register_modifier("xt_imageheight","xt_imageheight");
/**
 * Smarty modifier to return the height of an image in the filemanager
 * @param  string value The id of the image or the id and the version of the image seperated with a comma. Default version is 1
 * @return int height of the image or the version of the image
 * Example: height: {"`$CHAPTER.image`,`$CHAPTER.image_version`"|xt_imagewidth}px;
 */
function xt_imageheight($value){
    (array) $return = xt_getImageSize($value);

     // return 1 if an error occur. That prevent us from math errors.
    if(!is_numeric($return[1]) || !is_array($return)) {
    	return 1;
    } else {
    	return $return[1];
    }
}

// Bildseitenverhältnis zurückgeben
$tpl->register_function("xt_imageratio","xt_imageratio");
function xt_imageRatio($params){
    $ratio = ($params['width'] / $params['height']);

    if($params['session'] != ""){
        XT::setSessionValue($params['session'],$ratio);
    }
    if($params['assign'] != ""){
        XT::assign($params['assign'],$ratio);
    }else {
    	return $ratio;
    }
}

$tpl->register_modifier("xt_calcImgHeightByRatio","xt_calcImgHeightByRatio");
function xt_calcImgHeightByRatio($width,$ratio){
    return intval($width / $ratio);
}
?>