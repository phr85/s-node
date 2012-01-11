<?php

$tpl->register_function("get_image_version_info","get_image_version_info");
$tpl->register_function("thickbox_get_image_version_info","get_image_version_info");
function get_image_version_info($param) {
    include(PLUGIN_DIR . "ch.iframe.snode.filemanager/includes/config.version.inc.php");
    if(isset($image_versions[$param['version']])) {
        if ($param['assign'] == ""){
            $GLOBALS['tpl']->assign("IMAGEVERSIONINFO", $image_versions[$param['version']]);
        } else {
            $GLOBALS['tpl']->assign($param['assign'], $image_versions[$param['version']]);
        }
    }
}

$tpl->register_function("thickbox_build_javascript_array","thickbox_build_javascript_array");
function thickbox_build_javascript_array ($param) {
    $return = '<script type="text/javascript">' . "\n";
    $return .= "//<![CDATA[\n";
    $return .= "if(typeof(galleries) === 'undefined') { var galleries = new Object(); }\n";
    $return .= "\ngalleries[" . $param['gallery']['id'] . "] = new Object();\n";
    $return .= "\ngalleries[" . $param['gallery']['id'] . "]['activeelement'] = '" .$param['activeclass'] . "';";
    $return .= "\ngalleries[" . $param['gallery']['id'] . "]['inactiveelement'] = '" .$param['inactiveclass'] . "';";
    $return .= "\ngalleries[" . $param['gallery']['id'] . "]['activeimage'] = 0;";
    $return .= "\ngalleries[" . $param['gallery']['id'] . "]['imageversion'] = '" .$param['imageversion'] . "';";
    $return .= "\ngalleries[" . $param['gallery']['id'] . "]['diashow'] = true;";
    $return .= "\ngalleries[" . $param['gallery']['id'] . "]['diashow_status'] = '';";
    $return .= "\ngalleries[" . $param['gallery']['id'] . "]['images'] = new Array();";
    if(isset($param['gallery']['images']) && is_array($param['gallery']['images'])) {
        foreach($param['gallery']['images'] as $imagevalues) {
            $return .= "\n\nimage = new Object();\n";
            foreach($imagevalues as $key => $value) {
                $return .= "image['" . $key . "'] = '" . str_replace(array("\r\n", "\r", "\n", "\t", "'"),array(" "," "," "," ","\'"),$value) . "';\n";
            }
            $return .= "\ngalleries[" . $param['gallery']['id'] . "]['images'].push(image);";
        }
    }
    $return .= "\n//]]>\n";
    $return .= "</script>";
    return($return);
}

?>