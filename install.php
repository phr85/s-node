<?php

session_start();

@set_time_limit(0);

include(getcwd() . '/xt/includes/config.inc.php');
if(function_exists("zend_loader_install_license")){
    @zend_loader_install_license(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . "_ch.iframe.snode.core.zl");
}

// include smarty template engine class
require(CLASS_DIR . 'smarty/Smarty.class.php');

class Template extends Smarty {

    function Template(){
        $this->Smarty();
        $this->caching = 0;
        $this->debugging = false;
        $this->template_dir = ROOT_DIR . 'templates/default/includes/installer/';
        $this->compile_dir = ROOT_DIR . 'templates_c/';
        $this->config_dir = ROOT_DIR . 'configs/';
        $this->cache_dir = ROOT_DIR . 'cache/';
        $this->security = true;
    }
}

// create global template object
global $tpl;
$tpl = new Template;

$tpl->assign("XT_IMAGES", IMAGE_DIR);
$tpl->assign("XT_STYLES", STYLES_DIR);

if(is_file('install/' . $_POST['step'] . '.php')){
    include('install/' . $_POST['step'] . '.php');
} else {
    $tpl->display('start.tpl');
}

?>