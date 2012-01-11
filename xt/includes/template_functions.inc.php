<?php

/**
 * Additional smarty template functions
 *
 * @package S-Node
 * @subpackage Core
 * @author Veith Zäch <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: template_functions.inc.php 6517 2011-02-22 08:07:45Z dzogg $
 */

$tpl->register_function("XT_load_js", "XT_load_js");
$tpl->register_function("XT_load_css", "XT_load_css");
$tpl->register_function("print_data", "print_data");
$tpl->register_function("prepare_url", "prepare_url");
$tpl->register_function("yearselector", "yearselector");
$tpl->register_function("dayselector", "dayselector");
$tpl->register_function("allowed", "node_allowed");
$tpl->register_function("tree","tree");
$tpl->register_function("actionIcon","actionIcon");
$tpl->register_function("actionPopUp","actionPopUp");
$tpl->register_function("actionLink","actionLink");
$tpl->register_function("actionIconAjaxForm","actionIconAjaxForm");
$tpl->register_function("extensionpoint","extensionpoint");
$tpl->register_function("inline_navigator","inline_navigator");
$tpl->register_function("inline_navigator_top","inline_navigator_top");
$tpl->register_function("get_value","get_value");
$tpl->register_function("get_session_value","get_session_value");
$tpl->register_function("unset_session_value","unset_session_value");
$tpl->register_function("get_param","get_param");
$tpl->register_function("XT_get_axparam","XT_get_axparam");
$tpl->register_function("get_getvalue","get_getvalue");
$tpl->register_function("get_postvalue","get_postvalue");
$tpl->register_function("yoffset","yoffset");
$tpl->register_function("image","image");
$tpl->register_function("iframe_paper","iframe_paper");
$tpl->register_function("translate_replace","translate_replace");
$tpl->register_function("filepath","filepath");
$tpl->register_function("filetype","file_type");
$tpl->register_function("node_perm","node_perm");
$tpl->register_function("LiveActionIcon","LiveActionIcon");
$tpl->register_function("toggle_editor","toggle_editor");
$tpl->register_function("get_config","get_config");
$tpl->register_function("get_request","get_request");
$tpl->register_function("assign_value","assign_value");
$tpl->register_function("set_value","set_value");
$tpl->register_function("text2image","text2image");
$tpl->register_function("text2backgroundimage","text2backgroundimage");
$tpl->register_function("systemtime","systemtime");
$tpl->register_function("set_session_value","set_session_value");
$tpl->register_function("replace","replace");
$tpl->register_function("is_file","smarty_is_file");



/**
 * form must have same id and name and use jquery.form.js
 */
function actionIconAjaxForm($params){
    if($params['action'] == 'editNodePerms'){
        if(!is_file(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . "_ch.iframe.snode.nodepermissions.zl")){
            return '';
        }
    }
    if(isset($params['baseid'])){
        $baseid = $params['baseid'];
    }else{
        $baseid = $GLOBALS['plugin']->getBaseID();
    }
    $target = "";
    if($params['target'] != ''){
        $target = "window.parent.frames['" . $params['target'] . "'].";
        $setfocus = $target . 'focus();';
    }

    if(isset($params['node_perm'])){

        if($params['node_perm_pid'] != ''){
            if(!XT::getNodePermission($params['node_perm_id'], $params['node_perm'],$params['node_perm_pid'],true)){
                return '<img src="' . IMAGE_DIR . 'spacer.gif" alt="" class="icon" width="16" />';
            }
        } else {
            if(!XT::getNodePermission($params['node_id'], $params['node_perm'],$params['node_pid'],true)){
                return '<img src="' . IMAGE_DIR . 'spacer.gif" alt="" class="icon" width="16" />';
            }
        }
    }
    if(isset($params['perm'])){
        if(!XT::getPermission($params['perm'])){
            if(isset($params['nopermicon'])){
                return '<img src="' . IMAGE_DIR . 'icons/' . $params['nopermicon'] . '" alt="' . $GLOBALS['lang']->msg($params['nopermtitle']) . '" title="' . $GLOBALS['lang']->msg($params['nopermtitle']) . '" class="icon" width="16" />';
            }else{
                return '<img src="' . IMAGE_DIR . 'spacer.gif" alt="" class="icon" width="16" />';
            }
        }
    }

    if($params['action'] && !isset($params['link'])){

        if($params['action']=="NULL"){
            $params['action']="";
        }
        if($params['title'] != ''){
            $params['title'] = $GLOBALS['lang']->msg($params['title']);
        }
        if($params['label'] != ''){
            $params['label'] = " " .$GLOBALS['lang']->msg($params['label']);
        }
        $vars = '';
        foreach($params as $key => $value){
            /*
            echo '
            <script language="JavaScript"><!--
            if(document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_' . $key .'){
            var input = document.createElement(\'input\');
            input.setAttribute(\'type\',\'hidden\');
            input.setAttribute(\'name\',\'x' . $baseid . '_' . $key .'\');
            document.forms[\'' . $params['form'] . '\'].appendChild(input);
            }
            //-->
            </script>
            ';
            */
            if(!in_array($key,array("rollover", "target_tpl", "action","form","icon","ask","title","node_perm","perm", "nopermicon", "nopermtitle", "yoffset", "target", "baseid", "label"))){
                $vars .= $target . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_' . $key . '.value=\'' . $value . '\';';
            }
        }
        if(isset($params['target_tpl'])){
            $vars .= $target . 'document.forms[\'' . $params['form'] . '\'].TPL.value=\'' . $params['target_tpl'] . '\';';
        }
        if($params['yoffset'] == 1){
            $vars .= $target . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_yoffset.value=window.pageYOffset;';
        }
        if($params['rollover'] != ''){
            $rollover = ' onmouseover="this.src=\'' . IMAGE_DIR . 'icons/' . $params['rollover'] . '\'" onmouseout="this.src=\'' . IMAGE_DIR . 'icons/' . $params['icon'] . '\'"';
        }
        if($params['ask'] != ''){
            return '<a href="#" onclick="if(confirm(\'' . $GLOBALS['lang']->msg($params['ask']) . '\')){'
            . $params['pre_script'] . $vars . $target . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_action.value=\'' . $params['action'] . '\';'
            . $setfocus
            . $target . '$(\'#' . $params['form'] . '\').submit();return false;}"><img class="icon" src="' . IMAGE_DIR . 'icons/' . $params['icon']
            . '" alt="' . $params['title']
            . '" title="' . $params['title'] . '" ' . $rollover . ' />' . $params['label'] . '</a>';
        } else {
            return '<a href="#" onclick="'
            . $params['pre_script'] . $vars . $target . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_action.value=\'' . $params['action'] . '\';'
            . $setfocus
            . $target . '$(\'#' . $params['form'] . '\').submit();return false;' . $params['post_script'] . '"><img class="icon" src="' . IMAGE_DIR . 'icons/' . $params['icon']
            . '" alt="' . $params['title']
            . '" title="' . $params['title'] . '" ' . $rollover . ' />' . $params['label'] . '</a>';
        }
    } else {
        return '<a href="' . $params['link'] . '"><img class="icon" src="' . IMAGE_DIR . 'icons/' . $params['icon'] . '" alt="' . $params['title'] . '" title="' . $params['title'] . '" />' . $params['label'] . '</a>';
    }
}



/**
 * is_file function
 */
function smarty_is_file($params){
    if(empty($params['file'])) {
        return false;
    } else {
        return is_file($params['file']);
    }

}


/**
 * Load a js file just once
 */
function XT_load_js($params){
    if(empty($params['file'])) {
        return false;
    } else {
        if(empty($GLOBALS['loadedscripts'][$params['file']])){
            // js ausgeben und als geladen merken
            $GLOBALS['loadedscripts'][$params['file']] = '<script type="text/javascript" src="' . SCRIPTS_DIR . $params['file'] . '"></script>';
            return NULL;
        }else{
            return false;
        }
    }
}

/**
 * Load a css file just once set media screen as default
 */
function XT_load_css($params){
    if($params['media'] == ""){
        $params['media']= "screen";
    }
    if(empty($params['file'])) {
        return false;
    } else {
        if(empty($GLOBALS['loadedcss'][$params['file']])){
            // js ausgeben und als geladen merken
            $GLOBALS['loadedcss'][$params['file']] = '<link rel="stylesheet" type="text/css" href="' . STYLES_DIR . 'live/' . $params['file'] . '" media="' . $params['media'] . '" />';
            return NULL;
        }else{
            return false;
        }
    }
}


/**
 * replace a value
 */
function replace($params){
    return str_replace($params['search'],$params['replace'],$params['subject']);
}

/**
 * Set a Session value
 */
function set_session_value($params){
    if($params['name'] && $params['value']){
        $_SESSION[$params['name']] = $params['value'];
    }
}


function unset_session_value($params){
    unset($_SESSION['x' . $params['baseid']][$params['value']]);

}
function systemtime(){
    return TIME;
}

function text2image($params){
    XT::loadclass('text2image.class.php','ch.iframe.snode.filemanager');
    $text = new text2image;

    if (isset($params['uppercase'])) $params['text'] = mb_convert_case($params['text'],MB_CASE_UPPER, "UTF-8"); // text to display


    if (isset($params['font'])) $text->font = $params['font']; // font to use
    if (isset($params['size'])) $text->size = $params['size']; // size in points
    if (isset($params['rot'])) $text->rot = $params['rot']; // rotation
    if (isset($params['pad'])) $text->pad = $params['pad']; // padding in pixels around text.
    if (isset($params['letterspace'])) $text->letterspace = $params['letterspace']; // Letterspacing in percent, default is 100%
    if (isset($params['pad_ver'])) $text->pad_ver = $params['pad_ver']; // padding in pixels around text.
    if (isset($params['pad_hor'])) $text->pad_hor = $params['pad_hor']; // padding in pixels around text.
    if (isset($params['pad_top'])) $text->pad_top = $params['pad_top']; // padding in pixels around text.
    if (isset($params['pad_right'])) $text->pad_right = $params['pad_right']; // padding in pixels around text.
    if (isset($params['pad_bottom'])) $text->pad_bottom = $params['pad_bottom']; // padding in pixels around text.
    if (isset($params['pad_left'])) $text->pad_left = $params['pad_left']; // padding in pixels around text.
    if (isset($params['transparent'])) $text->transparent = $params['transparent']; // transparency flag (boolean).
    if (isset($params['cache'])) $text->cache = $params['cache'];
    if (isset($params['color'])) { // text colour
        $text->red = hexdec(substr($params['color'], 0, 2));
        $text->grn = hexdec(substr($params['color'], 2, 2));
        $text->blu = hexdec(substr($params['color'], 4, 2));
    }
    if (isset($params['bgcolor'])) { // background colour
        $text->bg_red = hexdec(substr($params['bgcolor'], 0, 2));
        $text->bg_grn = hexdec(substr($params['bgcolor'], 2, 2));
        $text->bg_blu = hexdec(substr($params['bgcolor'], 4, 2));
    }

    if (isset($params['text'])) $text->msg = $params['text']; // text to display

    $text->draw();

    $img = '<img width="' . $text->image_width . '" height="' . $text->image_height .'" src="' . IMAGE_DIR . 'txt/' . $text->filename . '"';
    if(!isset($params['alt'])){
        $img .= ' alt=""';
    }else{
        $img .= ' alt="' . str_replace(array("\n", "\r", '"') ," ", $params['alt']) . '"';
    }
    if(isset($params['title'])){
        $img .= ' title="' . str_replace(array("\n", "\r", '"')," ", $params['title']) . '"';
    }else{
        $img .= ' title="' . str_replace(array("\n", "\r", '"')," ", $params['alt']) . '"';
    }
    $vars = '';
    foreach($params as $key => $value){
        if(!in_array($key,array("title", "alt", "bgcolor", "color", "transparent", "pad", "rot", "size", "font", "uppercase", "text", "src", "pad_ver", "pad_hor", "pad_top", "pad_right", "pad_bottom", "pad_left"))){
            $vars .= ' ' . $key . '="' . $value . '"';
        }
    }
    $img .= $vars;
    $img .=" />";
    if($params['src']==true){
        return IMAGE_DIR . 'txt/' . $text->filename;
    }else{
        return $img;
    }

}

function text2backgroundimage($params){
    XT::loadclass('text2image.class.php','ch.iframe.snode.filemanager');
    $text = new text2image;
    if (isset($params['uppercase'])) $params['text'] = mb_convert_case($params['text'],MB_CASE_UPPER, "UTF-8"); // text to display
    if (isset($params['font'])) $text->font = $params['font']; // font to use
    if (isset($params['size'])) $text->size = $params['size']; // size in points
    if (isset($params['rot'])) $text->rot = $params['rot']; // rotation
    if (isset($params['pad'])) $text->pad = $params['pad']; // padding in pixels around text.
    if (isset($params['letterspace'])) $text->letterspace = $params['letterspace']; // Letterspacing in percent, default is 100%
    if (isset($params['pad_ver'])) $text->pad_ver = $params['pad_ver']; // padding in pixels around text.
    if (isset($params['pad_hor'])) $text->pad_hor = $params['pad_hor']; // padding in pixels around text.
    if (isset($params['pad_top'])) $text->pad_top = $params['pad_top']; // padding in pixels around text.
    if (isset($params['pad_right'])) $text->pad_right = $params['pad_right']; // padding in pixels around text.
    if (isset($params['pad_bottom'])) $text->pad_bottom = $params['pad_bottom']; // padding in pixels around text.
    if (isset($params['pad_left'])) $text->pad_left = $params['pad_left']; // padding in pixels around text.
    if (isset($params['transparent'])) $text->transparent = $params['transparent']; // transparency flag (boolean).
    if (isset($params['cache'])) $text->cache = $params['cache'];
    if (isset($params['color'])) { // text colour
        $text->red = hexdec(substr($params['color'], 0, 2));
        $text->grn = hexdec(substr($params['color'], 2, 2));
        $text->blu = hexdec(substr($params['color'], 4, 2));
    }
    if (isset($params['bgcolor'])) { // background colour
        $text->bg_red = hexdec(substr($params['bgcolor'], 0, 2));
        $text->bg_grn = hexdec(substr($params['bgcolor'], 2, 2));
        $text->bg_blu = hexdec(substr($params['bgcolor'], 4, 2));
    }
    if (isset($params['text'])) $text->msg = $params['text']; // text to display
    $text->draw();
    return(IMAGE_DIR . 'txt/' . $text->filename);
}

/**
 * Set a value
 */
function set_value($params){
    if($params['baseid'] && $params['name'] && $params['value']){
        $GLOBALS['plugin']->setValue($params['name'],$params['value'], $params['baseid']) ;
    }
}


/**
 * Assign a value
 */
function assign_value($params){
    XT::assign($params['assign'],$params['value']);
}

/**
 * Get config value
 */
function get_config($params)
{
    if($params['assign']!=""){
        XT::assign($params['assign'], $GLOBALS['plugin']->getConfig($params['name']));
    }else{
        return $GLOBALS['plugin']->getParam($params['name']);
    }
}

/**
 * Print full array
 */
function print_data($params){
    return XT::printArray($params['array'],1);
}

function toggle_editor($params){
    $baseid = '';
    if($params['nobaseid'] != 1){
        $baseid = 'x' . $GLOBALS['plugin']->getBaseID() . '_';
    }
    return '<a href="javascript:toggleEditorMode(\'' . $baseid . $params['id'] . $params['suffix'] . '\');"><img src="' . IMAGE_DIR . 'icons/pencil.png" alt="' . $GLOBALS['lang']->msg('Toggle HTML Editor') . '" title="' . $GLOBALS['lang']->msg('Toggle HTML Editor') . '" /></a><br />';
}
function LiveActionIcon($params){

    if(isset($params['baseid'])){
        $baseid = $params['baseid'];
    }else{
        $baseid = $GLOBALS['plugin']->getBaseID();
    }

    $target = "";
    if($params['target'] != ''){
        $target = "window.parent.frames['" . $params['target'] . "'].";
        $setfocus = $target . 'focus();';
    }

    if(isset($params['node_perm'])){
        if(!XT::getNodePermission($params['node_id'], $params['node_perm'],$params['node_pid'],true)){
            return '<img src="' . IMAGE_DIR . 'spacer.gif" alt="" width="1" />';
        }
    }
    if(isset($params['perm'])){
        if(!XT::getPermission($params['perm'])){
            if(isset($params['nopermicon'])){
                return '<img src="' . IMAGE_DIR . 'icons/' . $params['nopermicon'] . '" alt="' . $GLOBALS['lang']->msg($params['nopermtitle']) . '" title="' . $GLOBALS['lang']->msg($params['nopermtitle']) . '" class="icon" width="16" />';
            }else{
                return '<img src="' . IMAGE_DIR . 'spacer.gif" alt="" width="1" />';
            }
        }
    }

    if($params['action']){
        if($params['title'] != ''){
            $params['title'] = $GLOBALS['lang']->msg($params['title']);
        }
        $vars = '';
        foreach($params as $key => $value){
            if(!in_array($key,array("rollover", "action","form","icon","ask","title","node_perm","perm", "nopermicon", "nopermtitle", "yoffset", "target", "baseid"))){
                $vars .= $target . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_' . $key . '.value=\'' . $value . '\';';
            }
        }
        if($params['yoffset'] == 1){
            $vars .= $target . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_yoffset.value=window.pageYOffset;';
        }
        if($params['rollover'] != ''){
            $rollover = ' onmouseover="this.src=\'' . IMAGE_DIR . 'icons/' . $params['rollover'] . '\'" onmouseout="this.src=\'' . IMAGE_DIR . 'icons/' . $params['icon'] . '\'"';
        }

        return '<a href="javascript:'
        . $params['pre_script'] . $vars . $target . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_action.value=\'' . $params['action'] . '\';'
        . $setfocus
        . $target . 'document.forms[\'' . $params['form'] . '\'].submit();' . $params['post_script'] . '"><img class="icon" src="' . IMAGE_DIR . 'icons/' . $params['icon']
        . '" alt="' . $params['title']
        . '" title="' . $params['title'] . '" ' . $rollover . ' /></a>';

    } else {
        // build link
        if($params['link1']!=""){
            do{
                $linkcout++;
                if($params['link' . $linkcout]!=""){
                    $trans['%' . ($linkcout)] = $params['link' . $linkcout];
                }
            }while ($params['link' . $linkcout]!="");

            $link =  strtr($params['link'], $trans);
        }else {

        }
        return '<a href="' . $link . '"><img class="icon" src="' . IMAGE_DIR . 'icons/' . $params['icon'] . '" alt="' . $params['title'] . '" title="' . $params['title'] . '"></a>';
    }
}

function filepath($params){
    if($params['version'] == 'embed'){
        return $_SERVER['PHP_SELF'] . "?TPL=658&amp;x6000_file_id=" . $params['id'] . "&amp;x" . 6000 . "_file_name=movie_" . time . ".swf";
    } else {
        return $_SERVER['PHP_SELF'] . "?TPL=658&amp;x6000_file_id=" . $params['id'] . "&amp;x" . 6000 . "_file_name=" . $params['name'] . "&amp;x" . 6000 . "_file_version=" . $params['version'];
    }
}

function actionLink($params){
    if(isset($params['baseid'])){
        $baseid = $params['baseid'];
    }else{
        $baseid = $GLOBALS['plugin']->getBaseID();
    }
    $target = "";
    if($params['target'] != ''){
        $target = "window.parent.frames['" . $params['target'] . "'].";
        $setfocus = $target . 'focus();';
    }
    if($params['target2'] != ''){
        $target2 = "window.parent.frames['" . $params['target2'] . "'].";
    }
    if($params['style'] != ''){
        $style = ' style="' . $params['style'] . '"';
    }
    if($params['class'] != ''){
        $style = ' class="' . $params['class'] . '"';
    }
    if(isset($params['node_perm'])){
        if(!XT::getNodePermission($params['node_id'], $params['node_perm'],$params['node_pid'],true)){
            return $params['text'];
        }
    }
    if(isset($params['perm'])){
        if(!XT::getPermission($params['perm'])){
            if(isset($params['nopermicon'])){
                return '<span title="' . $params['nopermtitle'] . $params['text'] . '</span>';
            }else{
                return $params['text'];
            }
        }
    }
    $vars = '';
    foreach($params as $key => $value){
        if(!in_array($key,array("action","form","ask","title","node_perm","perm", "nopermtitle", "yoffset", "target", "target2", "baseid", "text","style","class"))){
            $vars .= $target . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_' . $key . '.value=\'' . $value . '\';';
            if($params['target2'] != ''){
                $vars .= $target2 . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_' . $key . '.value=\'' . $value . '\';';
            }
        }
    }
    if($params['yoffset'] == 1){
        $vars .= $target . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_yoffset.value=window.pageYOffset;';
        if($params['target2'] != ''){
            $vars .= $target2 . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_yoffset.value=window.pageYOffset;';
        }
    }
    if($params['target2'] != ''){
        $vars .= $target2 . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_action.value=\'' . $params['action'] . '\';' . $target2 . 'document.forms[\'' . $params['form'] . '\'].submit();';
    }
    return '<a '
    . $style
    . $class
    . ' href="javascript:'
    . $params['pre_script'] . $vars . $target . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_action.value=\'' . $params['action'] . '\';'
    . $setfocus
    . $target . 'document.forms[\'' . $params['form'] . '\'].submit();' . $params['post_script'] . '" title="' . $GLOBALS['lang']->msg($params['title']) . '">'
    . $params['text'] . '</a>';
}

// returns a translation with replaced values: string="i have %1 friends%2" t1="22" t2="?"
function translate_replace($params){
    $string = array_shift($params);
    foreach ($params as $value){
        $replace[] = $value;
    }
    return XT::translate_replace($string, $replace);
}

function image($params) {
	if ($params['id'] > 0) {
		if (XT::isLoggedIn()) {

			include(PLUGIN_DIR . 'ch.iframe.snode.filemanager/includes/config.version.inc.php');

			$img = '<div class="versiontrigger"><img src="';
			if ($params['hostname'] == true) {
				$img .= 'http://' . $_SERVER['SERVER_NAME'];
			}
			$img .= REL_ROOT . 'download.php?file_id=' . $params['id'];
			if (isset($params['version'])) {
				$img .= "&amp;file_version=" . $params['version'];
			} else {
				$img .= "&amp;file_version=1";
			}

			if (isset($params['date'])) {
				$img .= "&amp;date=" . $params['date'];
			}
			$img .= '"';

			if (isset($params['title'])) {
				$img .= ' title="' . str_replace(array("\n", "\r", '"'), " ", $params['title']) . '"';
			}

			foreach ($params as $key => $value) {
				if (!in_array($key, array("id", "version", "original", "alt", "title", "hostname"))) {
					$img .= ' ' . $key . '="' . $value . '"';
				}
			}
			if (!isset($params['alt'])) {
				$img .= ' alt=""';
			} else {
				$img .= ' alt="' . str_replace(array("\n", "\r", '"'), " ", $params['alt']) . '"';
			}
			$img .= ' /><div class="versioninfo">Bild-Version: ';
			$img .= $params['version'] . ' (' . $image_versions[$params['version']]['name'] . ')';
			$img .= '</div></div>';
			return $img;
		}
		else {
			$img = '<img src="';
			if ($params['hostname'] == true) {
				$img .= 'http://' . $_SERVER['SERVER_NAME'];
			}
			$img .= REL_ROOT . 'download.php?file_id=' . $params['id'];
			if (isset($params['version'])) {
				$img .= "&amp;file_version=" . $params['version'];
			} else {
				$img .= "&amp;file_version=1";
			}

			if (isset($params['date'])) {
				$img .= "&amp;date=" . $params['date'];
			}
			$img .= '"';

			if (!isset($params['alt'])) {
				$img .= ' alt=""';
			} else {
				$img .= ' alt="' . str_replace(array("\n", "\r", '"'), " ", $params['alt']) . '"';
			}
			if (isset($params['title'])) {
				$img .= ' title="' . str_replace(array("\n", "\r", '"'), " ", $params['title']) . '"';
			}
			foreach ($params as $key => $value) {
				if (!in_array($key, array("id", "version", "original", "alt", "title", "hostname"))) {
					$img .= ' ' . $key . '="' . $value . '"';
				}
			}
			$img .= " />";
			return $img;
		}
	}
	else {
		return "";
	}
}

function get_param($params){
    if($params['assign']!=""){
        XT::assign($params['assign'],$GLOBALS['plugin']->getParam($params['param']));
    }else{
        return $GLOBALS['plugin']->getParam($params['param']);
    }
}


function get_request($params){

    $url = '?TPL=' . $_GET['TPL'];
    foreach ($_GET as $key => $value){
        if($key != 'TPL'){
            $url .= '&amp;' . $key . '=' . $value;
        }
    }
    if($params['assign']!=""){
        XT::assign($params['assign'],$url);
    }else {
        return $url;
    }
}

function get_value($params){
    if($params['assign']!=""){
        XT::assign($params['assign'],XT::getValue($params['param']));
    }else{
        return XT::getValue($params['param']);
    }
}

function get_session_value($params){
    if($params['assign']!=""){
        if($params['baseid']){
            XT::assign($params['assign'], $_SESSION['x' . $params['baseid']][$params['value']]);
        }else {
            XT::assign($params['assign'], $_SESSION[$params['value']]);
        }
    }else{
        return $_SESSION['x' . $params['baseid']][$params['value']];
    }
}

function get_getvalue($params){
    if($params['assign']!=""){
        XT::assign($params['assign'],$_GET[$params['param']]);
    }else{
        return $_GET[$params['param']];
    }
}

function get_postvalue($params){
    if($params['assign']!=""){
        XT::assign($params['assign'],$_POST[$params['param']]);
    }else{
        return $_POST[$params['param']];
    }
}

function inline_navigator_top($params){
    $nav = '<a href="#top"><img src="' . IMAGE_DIR . 'icons/arrow_up.gif" alt="top" title="top" /></a>';
    if($params['anchor'] !=""){
        $nav .= '<a name="' . $params['anchor'] . '">&nbsp;</a>';
    }
    return $nav;
}

function yoffset(){
    if($GLOBALS['plugin']->getValue('yoffset') > 0){
        return '<input type="hidden" name="x' . $GLOBALS['plugin']->getBaseId() . '_yoffset" value="">
        <img src="' . IMAGE_DIR . 'spacer.gif" onload="window.scrollTo(0,' . $GLOBALS['plugin']->getValue('yoffset') . ');" alt="" />';
    }else{
        return '<input type="hidden" name="x' . $GLOBALS['plugin']->getBaseId() . '_yoffset" value="" />';
    }
}

function inline_navigator($params){
    $cont =' <script src="/scripts/scroll.js" type="text/javascript"></script>';
    if($params['top'] == 1){
        $cont .='<a name="top">&nbsp;</a>';
    }
    ksort($params['data']);
    foreach ($params['data'] as $element){
        $cont .='<a href="#' . $element['anchor'] .'"';
        if($element['accesskey']){
            $cont .= ' accesskey="' . $element['accesskey'] . '"';
        }
        $cont .='> <img src="' . IMAGE_DIR . 'icons/arrow_down.gif" alt="" border="0" />' .  $GLOBALS['lang']->msg($element['title']) . ' </a> ';
    }
    return $cont;
}


function actionIcon($params){
    if($params['action'] == 'editNodePerms'){
        if(!is_file(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . "_ch.iframe.snode.nodepermissions.zl")){
            return '';
        }
    }
    if(isset($params['baseid'])){
        $baseid = $params['baseid'];
    }else{
        $baseid = $GLOBALS['plugin']->getBaseID();
    }
    $target = "";
    if($params['target'] != ''){
        $target = "window.parent.frames['" . $params['target'] . "'].";
        $setfocus = $target . 'focus();';
    }
    if($params['target2'] != ''){
        $target2 = "window.parent.frames['" . $params['target2'] . "'].";
    }

    if(isset($params['node_perm'])){

        if($params['node_perm_pid'] != ''){
            if(!XT::getNodePermission($params['node_perm_id'], $params['node_perm'],$params['node_perm_pid'],true)){
                return '<img src="' . IMAGE_DIR . 'spacer.gif" alt="" class="icon" width="16" />';
            }
        } else {
            if(!XT::getNodePermission($params['node_id'], $params['node_perm'],$params['node_pid'],true)){
                return '<img src="' . IMAGE_DIR . 'spacer.gif" alt="" class="icon" width="16" />';
            }
        }
    }
    if(isset($params['perm'])){
        if(!XT::getPermission($params['perm'])){
            if(isset($params['nopermicon'])){
                return '<img src="' . IMAGE_DIR . 'icons/' . $params['nopermicon'] . '" alt="' . $GLOBALS['lang']->msg($params['nopermtitle']) . '" title="' . $GLOBALS['lang']->msg($params['nopermtitle']) . '" class="icon" width="16" />';
            }else{
                return '<img src="' . IMAGE_DIR . 'spacer.gif" alt="" class="icon" width="16" />';
            }
        }
    }

    if($params['action'] && !isset($params['link'])){

        if($params['action']=="NULL"){
            $params['action']="";
        }
        if($params['title'] != ''){
            $params['title'] = $GLOBALS['lang']->msg($params['title']);
        }
        if($params['label'] != ''){
            $params['label'] = " " .$GLOBALS['lang']->msg($params['label']);
        }
        $vars = '';
        foreach($params as $key => $value){
            /*
            echo '
            <script language="JavaScript"><!--
            if(document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_' . $key .'){
            var input = document.createElement(\'input\');
            input.setAttribute(\'type\',\'hidden\');
            input.setAttribute(\'name\',\'x' . $baseid . '_' . $key .'\');
            document.forms[\'' . $params['form'] . '\'].appendChild(input);
            }
            //-->
            </script>
            ';
            */
            if(!in_array($key,array("rollover", "target_tpl", "action","form","icon","ask","title","node_perm","perm", "nopermicon", "nopermtitle", "yoffset", "target", "target2", "baseid", "label"))){
                $vars .= $target . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_' . $key . '.value=\'' . $value . '\';';
                if($params['target2'] != ''){
                    $vars .= $target2 . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_' . $key . '.value=\'' . $value . '\';';
                }
            }
        }
        if(isset($params['target_tpl'])){
            $vars .= $target . 'document.forms[\'' . $params['form'] . '\'].TPL.value=\'' . $params['target_tpl'] . '\';';
        }
        if($params['yoffset'] == 1){
            $vars .= $target . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_yoffset.value=window.pageYOffset;';
            if($params['target2'] != ''){
                $vars .= $target . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_yoffset.value=window.pageYOffset;';
            }
        }
        if($params['rollover'] != ''){
            $rollover = ' onmouseover="this.src=\'' . IMAGE_DIR . 'icons/' . $params['rollover'] . '\'" onmouseout="this.src=\'' . IMAGE_DIR . 'icons/' . $params['icon'] . '\'"';
        }
        if($params['ask'] != ''){
            return '<a href="#" onclick="if(confirm(\'' . $GLOBALS['lang']->msg($params['ask']) . '\')){'
            . $params['pre_script'] . $vars . $target . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_action.value=\'' . $params['action'] . '\';'
            . $setfocus
            . $target . 'document.forms[\'' . $params['form'] . '\'].submit();}"><img class="icon" src="' . IMAGE_DIR . 'icons/' . $params['icon']
            . '" alt="' . $params['title']
            . '" title="' . $params['title'] . '" ' . $rollover . ' />' . $params['label'] . '</a>';
        } else {
            if($params['target2'] != ''){
                $vars .= $target2 . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_action.value=\'' . $params['action'] . '\';' . $target2 . 'document.forms[\'' . $params['form'] . '\'].submit();';
            }

            return '<a href="javascript:'
            . $params['pre_script'] . $vars
            . $target . 'document.forms[\'' . $params['form'] . '\'].x' . $baseid . '_action.value=\'' . $params['action'] . '\';'
            . $setfocus
            . $target . 'document.forms[\'' . $params['form'] . '\'].submit();' . $params['post_script'] . '"><img class="icon" src="' . IMAGE_DIR . 'icons/' . $params['icon']
            . '" alt="' . $params['title']
            . '" title="' . $params['title'] . '" ' . $rollover . ' />' . $params['label'] . '</a>';
        }
    } else {
        return '<a href="' . $params['link'] . '"><img class="icon" src="' . IMAGE_DIR . 'icons/' . $params['icon'] . '" alt="' . $params['title'] . '" title="' . $params['title'] . '" />' . $params['label'] . '</a>';
    }
}

function actionPopUp($params){

    if(isset($params['node_perm'])){
        if($params['node_perm_pid'] != ''){
            if(!XT::getNodePermission($params['node_perm_id'], $params['node_perm'],$params['node_perm_pid'],true)){
                return '<img src="' . IMAGE_DIR . 'spacer.gif" alt="" class="icon" width="16" />';
            }
        } else {
            if(!XT::getNodePermission($params['node_id'], $params['node_perm'],$params['node_pid'],true)){
                return '<img src="' . IMAGE_DIR . 'spacer.gif" alt="" class="icon" width="16" />';
            }
        }
    }
    if(isset($params['perm'])){
        if(!XT::getPermission($params['perm'])){
            if(isset($params['nopermicon'])){
                return '<img onmouseover="return overlib(\'' . $params['title'] . '\');" onmouseout="nd();" src="' . IMAGE_DIR . 'icons/' . $params['nopermicon'] . '" alt="' . $GLOBALS['lang']->msg($params['nopermtitle']) . '" title="' . $GLOBALS['lang']->msg($params['nopermtitle']) . '" class="icon" width="16" />';
            }else{
                return '<img src="' . IMAGE_DIR . 'spacer.gif" alt="" class="icon" width="16" />';
            }
        }
    }


    if(is_numeric($params['width'])){
        $width = $params['width'];
    }else {
        $width = 770;
    }

    if(is_numeric($params['height'])){
        $height = $params['height'];
    }else {
        $height = 540;
    }

    return '<a href="#' . $params['anker'] . '" onclick="popup(\'' . $_SERVER['PHP_SELF'] . '?TPL=' . $params['TPL'] . '&amp;x' . $params['BASEID'] .'_field=x' . $params['fieldBaseId'] . '_' . $params['fieldName'] . '&amp;x' . $params['BASEID'] .'_form=' . $params['form'] . '&' . session_name() . '=' . session_id() . '\',' . $width . ',' . $height . ',\'' . $name .'\');' . $params['script'] . '"><img class="icon" src="'. IMAGE_DIR . 'icons/' . $params['icon'] . '" alt="' . $params['title'] . '" title="' . $params['title'] . '" /></a>';
}


function tree($params){
    return $GLOBALS['tpl']->fetch("includes/widgets/admin_tree.tpl");
}


function extensionpoint($params){

    return $GLOBALS['tpl']->fetch($GLOBALS['plugin']->package . "/includes/extensionpoints/" . $params['name'] . ".tpl");
}

function prepare_url($params){
    return str_replace('%id%',$params['id'],$params['url']);
}

function node_perm($params){
    $GLOBALS['tpl']->assign($params['assign'],XT::getNodePermission($params['node_id'],$params['perm'],$params['node_pid'],true));
}

function node_allowed($node_id,$perm){
    return XT::getNodePermission($node_id,$perm);
}

function yearselector($params){
    $options = '';
    for($i = date('Y');$i <= date('Y')+10;$i++){
        $options .= '<option>' . $i . '</option>';
    }
    return $options;
}

function dayselector($params){
    return '<option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
    <option>9</option>
    <option>10</option>
    <option>11</option>
    <option>11</option>
    <option>12</option>
    <option>13</option>
    <option>14</option>
    <option>15</option>
    <option>16</option>
    <option>17</option>
    <option>18</option>
    <option>19</option>
    <option>20</option>
    <option>21</option>
    <option>22</option>
    <option>23</option>
    <option>24</option>
    <option>25</option>
    <option>26</option>
    <option>27</option>
    <option>28</option>
    <option>29</option>
    <option>30</option>
    <option>31</option>
    ';
}


function posted_form_value($element_id, $value){
    return $_POST['x' . $GLOBALS['plugin']->getBaseID() . '_formfields'][$element_id] == $value;
}

function iframe_paper($params){
    $params['url'] = $_SERVER['PHP_SELF'] . $params['url'];
    $params['url'] = str_replace('%TPL%',$params['template'],$params['url']);
    $params['url'] = str_replace('%MODULE%',$params['s1_tab'],$params['url']);

    $GLOBALS['tpl']->assign("NAME",$params['name']);
    $GLOBALS['tpl']->assign("URL",$params['url']);

    return $GLOBALS['tpl']->fetch(TEMPLATE_DIR . 'default/includes/widgets/paper.tpl');
}

/*
* Get links
* @param content content with the links
* @param assign vaiable to assign
* @return array with all links.
*/
$tpl->register_function("getlinks","getlinks");
function getlinks($param) {
    $return  = array();

    if ($param['content'] != "") {
        //delete all newlines because users are stupid enough tu linebreak in links!
        $example = nl2br($param['content']);
        $example = str_replace("\r","",$param['content']);
        $example = str_replace("\n","",$param['content']);
        //set a linebreak before each link because i can't preg_match_all on one line. Dirty but it works at the moment.
        $param['content'] = str_replace("<a","\n<a",$param['content']);
        preg_match_all ( '/<a.*href="([^"]*)".*>(.*)<\/a>/i'  , $param['content']  ,$Treffer);
        $i = 0;
        if (is_array($Treffer[0])) {
            foreach($Treffer[0] as $match){
                $return[$i]['allowed'] = abs(preg_match("/^javascript|^#/is",trim($Treffer[1][$i])) - 1); // HaHa what a cool code ;-)
                $return[$i]['content'] = $match;
                $return[$i]['link'] = $Treffer[1][$i];
                $return[$i]['name'] = $Treffer[2][$i];


                $i++;
            }
        }
    }
    if ($param['assign'] == ""){
        $GLOBALS['tpl']->assign("getlinks",$return);
    } else {
        $GLOBALS['tpl']->assign($param['assign'],$return);
    }
}
?>