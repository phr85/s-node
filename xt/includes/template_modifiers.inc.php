<?php


$tpl->register_modifier("md5","md5");


$tpl->register_modifier("utf8enc","utf8_encode");



$tpl->register_modifier("bbdecode","bbdecode");
/**
 * return bbdecode string
 */
function bbdecode($value){
    if($value !=""){
        // load abbc class
        XT::loadClass("abbc/abbc.lib.php");
        return abbc_proc(stripslashes($value));
    }else {
    	return false;
    }
}

$tpl->register_modifier("rfc2822","rfc2822");
/**
 * return RFC 2822 formatted date
 */
function rfc2822($value){
    return date("r",$value);

}

$tpl->register_modifier("in_array","in_array");

/**
 * Permission check
 */
$tpl->register_modifier("permcheck", "permcheck");
function permcheck($value){
    if(XT::getPermission($value)){
        return true;
    }else{
        return false;
    }
}

/**
 * Return a get or post or session Value
 */
$tpl->register_modifier("getBaseidValue", "getBaseidValue");
function getBaseidValue($value){
    $parts=explode("_",$value);
    if($_GET[$value]){
        return $_GET[$value];
    }
    if($_POST[$value]){
        return $_POST[$value];
    }
    return $_SESSION[$parts[0]][$parts[1]];
}


/**
 * cleanlink bereinigt einen Text so dass er in einer url verwendet werden kann.
 */
$tpl->register_modifier("cleanlink", "cleanlink");
function cleanlink($url){
    $url = strip_tags($url);
    $dirty   = array(" ", "ä", "ü","ö","Ä","Ü","Ö","é","è","à","&","/","?","#34;","#39;","'",'"',";","#", "%");
    $clean   = array("-", "ae", "ue","oe","Ae","Ue","Oe","e","e","a","-","-","","","","","","","","");
    $url = str_replace('&amp;','&',$url);
    $url = str_replace($dirty,$clean,$url);
    // $url = str_replace('&','&amp;',$url);
    return $url; 
}

/**
 * stripquotes
 */
$tpl->register_modifier("stripquotes", "stripquotes");
function stripquotes($value){
    return str_replace(array('"',"'")," ", $value);
}
/**
 * htmlspecialchars
 */
$tpl->register_modifier("htmlspecialchars", "xt_htmlspecialchars");
function xt_htmlspecialchars($value){
    $value = str_replace('\'','&#39;',$value);
    $value = str_replace('"','&#34;',$value);
    $value = str_replace('>','&gt;',$value);
    $value = str_replace('<','&lt;',$value);
    $value = str_replace('&','&amp;',$value);
    // return htmlspecialchars($value, ENT_QUOTES);
    return $value;
}

/**
 * addslashes
 */
$tpl->register_modifier("addslashes", "xt_addslashes");
function xt_addslashes($value){
    return addslashes($value);
}

/**
 * addslashes
 */
$tpl->register_modifier("stripslashes", "xt_stripslashes");
function xt_stripslashes($value){
    return stripslashes($value);
}

/**
 * get Config Value
 */
$tpl->register_modifier("getConfigValue", "getConfigValue");
function getConfigValue($value){
    return XT::getConfig($value);
}


// Stripslashes
$tpl->register_modifier("sslash", "stripslashes");


/**
 * rounds to swiss currency values
 */
$tpl->register_modifier("round5", "round5");
function round5($value){
    return number_format(round(20 * $value)/20,2,'.',"'");
}

/**
 * rounds to full values
 */
$tpl->register_modifier("round0", "round0");
function round0($value){
    return number_format(round(20 * $value)/20,0,'.',"'");
}

$tpl->register_modifier("tausender", "tausender");
function tausender($value){
    return number_format($value,0,'.',"'");
}

$tpl->register_modifier("meterkilo", "meterkilo");
function meterkilo($value){
    if($value < 501){
        return $value . " m";
    }else {
        return round(($value/1000),2) . " km";
    }
}

$tpl->register_modifier("round", "round_default");
function round_default($value,$format="%.2f"){
    return sprintf($format,$value);
}



/**
 * register language functionality
 */
$tpl->register_modifier("translate", "translate");

/**
 * loads a plugin
 */
function translate($word){

    return $GLOBALS['lang']->msg($word);

}

/**
 * register language functionality
 */
$tpl->register_modifier("livetranslate", "livetranslate");

/**
 * loads a plugin
 */
function livetranslate($word){

    return $GLOBALS['lang']->msg($word,true);

}

/**
 * register perm modifier
 */
$tpl->register_modifier("allowed", "allowed");

/**
 * loads a plugin
 */
function allowed($perm){
    return XT::getPermission($perm);
}


/**
 * register language functionality
 */
$tpl->register_modifier("format_filesize", "format_filesize");

/**
 * loads a plugin
 */
function format_filesize($filesize){

    if($filesize < 1024){
        return round($filesize, 2) . " Bytes";
    }
    if($filesize < 1024000 && $filesize >= 1024){
        return round($filesize/1024,2) . " KB";
    }
    if($filesize < 1024000000){
        return round($filesize/1024/1024, 2) . " MB";
    }
    if($filesize >= 1024000000){
        return round($filesize/1024/1024/1024, 2) . " GB";
    }
}

/**
 * check for content icon
 */
$tpl->register_modifier("contenticon", "contenticon");

/**
 * loads a plugin
 */
function contenticon($contenttype){

    if(is_file(IMAGE_DIR . "icons/content_types/" . $contenttype . ".png")){
        return "" . IMAGE_DIR . "icons/content_types/" . $contenttype . ".png";
    } else {
        return "" . IMAGE_DIR . "icons/content_types/0.png";
    }
}

/**
 * check for browser icon
 */
$tpl->register_modifier("browsericon", "browsericon");

/**
 * loads a plugin
 */
function browsericon($browserstring){

    if($browserstring == 'Mozilla'){
        return "<img src=\"" . IMAGE_DIR . "icons/browsers/browser_mozilla.png\" alt=\"\">";
    }
    if($browserstring == 'Internet Explorer'){
        return "<img src=\"" . IMAGE_DIR . "icons/browsers/browser_explorer.png\" alt=\"\">";
    }
    if($browserstring == 'Firefox'){
        return "<img src=\"" . IMAGE_DIR . "icons/browsers/browser_firefox.png\" alt=\"\">";
    }
    if($browserstring == 'Safari'){
        return "<img src=\"" . IMAGE_DIR . "icons/browsers/browser_safari.png\" alt=\"\">";
    }
    if($browserstring == 'Opera'){
        return "<img src=\"" . IMAGE_DIR . "icons/browsers/browser_opera.png\" alt=\"\">";
    }
    if($browserstring == 'AOL'){
        return "<img src=\"" . IMAGE_DIR . "icons/browsers/browser_aol.png\" alt=\"\">";
    }
    return "<img src=\"" . IMAGE_DIR . "icons/help.png\" alt=\"\">";
}

/**
 * emoticons
 */
$tpl->register_modifier("emoticons", "emoticons");

/**
 * loads a plugin
 */
function emoticons($emoticonsstring,$emoticonpath,$emoticonslist,$emoticons = 0){

    if($emoticons == 1){

        foreach($emoticonslist as $key=>$value){
            $emoticonsstring = str_replace($key,'<img src="' . $emoticonpath  . $value . '" alt="' . $key . '">',$emoticonsstring);
        }
    }

    return $emoticonsstring;
}

/**
 * bad words
 */
$tpl->register_modifier("badwords", "badwords");

/**
 * loads a plugin
 */
function badwords($badwordstring,$badwordreplace,$badwordlist,$badwords = 0){

    if($badwords == 1){
        $abadwordlist = array();
        $abadwordlist = split(';',$badwordlist);

        foreach($abadwordlist as $key=>$value){
            $badwordstring = str_replace($value,$badwordreplace,$badwordstring);
        }
    }

    return $badwordstring;
}

/**
 * email
 */
$tpl->register_modifier("email", "email");

/**
 * loads a plugin
 */
function email($email,$class = ''){

    if($class != ''){
        $shwoclass = 'class="' . $class . '"';
    }

    return '<a href="mailto:' . $email . '" ' . $showclass . '>' . $email . '</a>';

}

/**
 * website
 */
$tpl->register_modifier("website", "website");

/**
 * loads a plugin
 */
function website($website,$class = ''){
    if($class != ''){
        $shwoclass = 'class="' . $class . '"';
    }

    $website = str_replace('http://','',$website);

    if ($target !=  '') {
        $target = "target='" . $target . "'";
    }

    return '<a href="http://' . $website . '" ' . $showclass . $target . '>' . $website . '</a>';
}

/**
 * Makes the alt and title tag for images
 */
$tpl->register_modifier("alttag","alttag");

function alttag($alttag){
    $txt = $GLOBALS['lang']->msg($alttag);
    return 'alt="' . $txt . '" title="' . $txt . '"';
}

/**
 * Shows Icons based on Filetypes
 */
$tpl->register_modifier("icon","icon");

function icon($filename,$class= ''){
    $ext = strrchr($filename,'.');
    $ext = strtolower(substr($ext,1));

    switch($ext){
        case 'pdf':
            $path = 'icons/filetypes/pdf.gif';
            break;
        case 'doc':
            $path = 'icons/filetypes/doc.gif';
            break;
        case 'zip':
            $path = 'icons/filetypes/zip.gif';
            break;
        case 'gz':
            $path = 'icons/filetypes/zip.gif';
            break;
        case 'rar':
            $path = 'icons/filetypes/zip.gif';
            break;
        case 'xls':
            $path = 'icons/filetypes/xls.gif';
            break;
        case 'gif':
            $path = 'icons/filetypes/image.png';
            break;
        case 'jpg':
            $path = 'icons/filetypes/image.png';
            break;
        case 'jpeg':
            $path = 'icons/filetypes/image.png';
            break;
        case 'tiff':
            $path = 'icons/filetypes/image.png';
            break;
        case 'png':
            $path = 'icons/filetypes/image.png';
            break;
        default:
            $path = 'icons/document.png';
            break;
    }
    
    if($class != "") {
        return '<img class="' . $class . '" src="' . IMAGE_DIR . $path . '" alt="" width="16" height="16" />';
    }
    else {
        return '<img src="' . IMAGE_DIR . $path . '" alt="" width="16" height="16" />';
    }
}

$tpl->register_modifier("htmlentities","htmlentities");

?>