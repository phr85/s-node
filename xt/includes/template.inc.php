<?php
/**
 * include smarty template engine class
 */
require(CLASS_DIR . 'smarty/Smarty.class.php');

/**
 * include plugin handler class
 */
require(CLASS_DIR . 'plugin.class.php');
require(CLASS_DIR . 'pluginhandler.class.php');

class Template extends Smarty {

    function Template(){
        $this->Smarty();
        $this->caching = 0;
        $this->debugging = false;

        /**
         * smarty configuration
         * TODO: configurable with main config file
         */
        $this->theme_template_dir = ROOT_DIR . 'templates/' . @$_SESSION['theme'] . '/';
        $this->template_dir = TEMPLATE_DIR . '/default/';
        $this->default_template_dir = TEMPLATE_DIR . '/default/';
        $this->compile_dir = COMPILE_DIR;
        $this->config_dir = ROOT_DIR . 'configs/';
        $this->cache_dir = ROOT_DIR . 'cache/';
        $this->security = $GLOBALS['cfg']->get("system", "template_security");
        $this->secure_dir[0] = $this->theme_template_dir;
        $this->secure_dir[1] = $this->default_template_dir;
        $this->trusted_dir[0] = PLUGIN_DIR;
    }

    function fetch($resource_name, $cache_id = null, $compile_id = null, $display = false){

        if($_SESSION['theme'] != 'default'){
            if(is_file(str_replace('default/',$_SESSION['theme'] . '/',$resource_name)) || is_file($this->theme_template_dir . $resource_name)){
                $resource_name = str_replace('default/',$_SESSION['theme'] . '/',$resource_name);
                $this->template_dir = $this->theme_template_dir;
            } else {
                $this->template_dir = $this->default_template_dir;
            }
        }
        $fetched = &parent::fetch($resource_name,$cache_id,$compile_id,$display);
        $this->template_dir = $this->default_template_dir;
        return $fetched;
    }

    function fetchPage($resource_name, $cache_id = null, $compile_id = null, $display = false){
        $this->template_dir = PAGES_DIR;
        $fetched = &parent::fetch($resource_name,$cache_id,$compile_id,$display);
        $this->template_dir = $this->default_template_dir;
        return $fetched;
    }
}

/**
 * create global template object
 */
global $tpl;
$tpl = new Template;

global $pluginhandler;
$pluginhandler = new XT_PluginHandler();

$GLOBALS['tpl']->assign("ICONSPACER", '<img src="images/spacer.gif" alt="" width="20" height="16" />');

/**
 * register plugin load functionality
 */
$tpl->register_function("plugin", "load_plugin");
$tpl->register_function("subplugin", "load_subplugin");

global $plugin_params_stack;
$plugin_params_stack = array();

global $preplugin_content;
$preplugin_content = '';

global $postplugin_content;
$postplugin_content = '';

global $plugin_index;
$GLOBALS['plugin_index'] = 0;

/**
 * loads a plugin
 */
function load_plugin($params){

    // Empty content
    $content = '';

    if(function_exists("zend_loader_install_license")){
        @zend_loader_install_license(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . '_' . $params['package'] . ".zl",1);
    }

    // Get plugin priority
    $priority = @$params['priority'] != '' ? $params['priority'] : 10;
    $params['index'] = $GLOBALS['plugin_index'];

    // Add params into plugin stack
    $GLOBALS['plugin_params_stack'][$priority][] = $params;

    // Load plugin
    if($params['plugin_zone']!=""){
        $GLOBALS['XT_content_zone'][$params['plugin_zone']] .= '%%PLUGIN' . $GLOBALS['plugin_index'] . '%% ';
    }else {
        $content = '%%PLUGIN' . $GLOBALS['plugin_index'] . '%%';
    }


    $GLOBALS['plugin_index']++;

    // return plugin output
    return $content;

}

function load_subplugin($params){
    // Empty content
    $content = '';


    if(function_exists("zend_loader_install_license")){
        @zend_loader_install_license(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . '_' . $params['package'] . ".zl",1);
    }

    // Load subplugin in zone
    if($params['plugin_zone']!=""){
         $GLOBALS['XT_content_subzone'][$params['plugin_zone']] .= $GLOBALS['pluginhandler']->load($params) ;
    }else {
     // Load subplugin
    $content = $GLOBALS['preplugin_content'] . $GLOBALS['pluginhandler']->load($params) . $GLOBALS['postplugin_content'];

    }

    $GLOBALS['preplugin_content'] = '';
    $GLOBALS['postplugin_content'] = '';

    // return plugin output
    return $content;

}
/**
 * prepares the content for output
 */
function processContent($template_buffer){

    //Zonen
    if(is_array($GLOBALS['XT_content_zone'])){
        foreach ($GLOBALS['XT_content_zone'] as $zone => $zcontent) {
            $template_buffer = str_replace('<!--%%XT_ZONE_' . $zone . '%%-->',$zcontent . '<!--%%XT_ZONE_' . $zone . '%%-->',$template_buffer);
        }
    }

    $count = 0;
    ksort($GLOBALS['plugin_params_stack']);
    while(list($priority,$plugins) = each($GLOBALS['plugin_params_stack'])) {
        while(list($key,$params) = each($plugins)) {
            $template_buffer = str_replace('%%PLUGIN' . $params['index'] . '%%', $GLOBALS['preplugin_content'] . $GLOBALS['pluginhandler']->load($params),$template_buffer) . $GLOBALS['postplugin_content'];
            $count++;
        }
    }

    //subzonen
    if(is_array($GLOBALS['XT_content_subzone'])){
        foreach ($GLOBALS['XT_content_subzone'] as $zone => $zcontent) {
            $template_buffer = str_replace('<!--%%XT_ZONE_' . $zone . '%%-->',$zcontent,$template_buffer);
        }
    }


    $XTSCRIPTLOADER = null;
    if(is_array($GLOBALS['loadedscripts'])){
        $XTSCRIPTLOADER = implode("",$GLOBALS['loadedscripts']);

    }
    $XTCSSLOADER = null;
    if(is_array($GLOBALS['loadedcss'])){
        $XTCSSLOADER = implode("\n ",$GLOBALS['loadedcss']);

    }
    // %%XXX%% Werte austauschen
    $search = array("%%TITLE%%","%%DESCRIPTION%%","%%KEYWORDS%%","<!--%%XTCSSLOADER%%-->","<!--%%XTSCRIPTLOADER%%-->","<!--%%METATAGS%%-->");
    $replace = array($GLOBALS['pagetitle'],$GLOBALS['pagedescription'],$GLOBALS['pagekeywords'],$XTCSSLOADER,$XTSCRIPTLOADER,$GLOBALS['metatags']);
    $template_buffer = str_replace($search, $replace, $template_buffer);

    $GLOBALS['preplugin_content'] = '';
    $GLOBALS['postplugin_content'] = '';

    return $template_buffer;
}
// include template modifiers and functions
require(INCLUDE_DIR . 'template_functions.inc.php');
require(INCLUDE_DIR . 'template_modifiers.inc.php');

// include template modifiers and functions for each plugin if it's set
foreach (glob(INCLUDE_DIR . "/template/*.inc.php") as $plugin_template_code) {
    require($plugin_template_code);
}
?>