<?php
require_once(FUNC_DIR . 'basic.functions.php');
// Create theme folder
if(XT::getValue('theme_title')){
    if(!is_dir(TEMPLATE_DIR . XT::getValue('theme_title')) && !mkdir(TEMPLATE_DIR . XT::getValue('theme_title'),0777)){
        XT::log("Could not create template directory",__FILE__,__LINE__,XT_ERROR);
    }
    if(!is_dir(BASE_DIR . "/images/" . XT::getValue('theme_title')) && !mkdir(BASE_DIR . "/images/" . XT::getValue('theme_title'),0777)){
        XT::log("Could not create IMAGE directory",__FILE__,__LINE__,XT_ERROR);
    }
    if(!is_dir(BASE_DIR . "/fonts/" . XT::getValue('theme_title')) && !mkdir(BASE_DIR . "/fonts/" . XT::getValue('theme_title'),0777)){
        XT::log("Could not create FONTS directory",__FILE__,__LINE__,XT_ERROR);
    }
    if(!is_dir(BASE_DIR . "/scripts/" . XT::getValue('theme_title')) && !mkdir(BASE_DIR . "/scripts/" . XT::getValue('theme_title'),0777)){
        XT::log("Could not create SCRIPTS directory",__FILE__,__LINE__,XT_ERROR);
    }

}

// Activate theme
if(XT::getValue('switch') == 1){

    $_SESSION['theme'] = XT::getValue('theme_title');
    $file = file_get_contents(INCLUDE_DIR . 'config.inc.php');
    $file = preg_replace('\'"theme",\s+"' . $GLOBALS['cfg']->get("system","theme") . '"\'',  '"theme", "' . $_SESSION['theme'] . '"',$file);
    file_put_contents(getcwd() . '/xt/includes/config.inc.php',$file);

    // Clean up compiled templates
    XT::call('cleanUp');

}

unset($file);

// Create header & footer
if(!is_dir(TEMPLATE_DIR . XT::getValue('theme_title') . '/includes') && !mkdir(TEMPLATE_DIR . XT::getValue('theme_title') . '/includes', 0777)){
    XT::log("Could not create template includes directory",__FILE__,__LINE__,XT_ERROR);
}
if(!is_dir(TEMPLATE_DIR . XT::getValue('theme_title') . '/includes/header') && !mkdir(TEMPLATE_DIR . XT::getValue('theme_title') . '/includes/header', 0777)){
    XT::log("Could not create template includes/header directory",__FILE__,__LINE__,XT_ERROR);
}
if(!is_dir(TEMPLATE_DIR . XT::getValue('theme_title') . '/includes/footer') && !mkdir(TEMPLATE_DIR . XT::getValue('theme_title') . '/includes/footer', 0777)){
    XT::log("Could not create template includes/footer directory",__FILE__,__LINE__,XT_ERROR);
}

// Include doctypes
include(INCLUDE_DIR . 'doctypes.inc.php');

// Create header file
$file = file_get_contents(TEMPLATE_DIR . 'default/includes/header/skeleton.tpl');
$file = str_replace('%%DOCTYPE%%', $doctypes[XT::getValue('doctype')],$file);
$file = str_replace('%%THEME%%', XT::getValue('theme_title'),$file);
$file = str_replace('%%CSS%%', XT::getValue('css'),$file);
file_put_contents(TEMPLATE_DIR . XT::getValue('theme_title') . '/includes/header/header.tpl', $file);
@chmod(TEMPLATE_DIR . XT::getValue('theme_title') . '/includes/header/header.tpl',0777);
unset($file);

// Create footer file
$file = file_get_contents(TEMPLATE_DIR . 'default/includes/footer/skeleton.tpl');
file_put_contents(TEMPLATE_DIR . XT::getValue('theme_title') . '/includes/footer/footer.tpl', $file);
@chmod(TEMPLATE_DIR . XT::getValue('theme_title') . '/includes/footer/footer.tpl',0777);

unset($file);

// Create CSS
if(XT::getValue('create_css') == 1){
    if(!is_dir(getcwd() . '/styles/live/' . XT::getValue('theme_title')) && !mkdir(getcwd() . '/styles/live/' . XT::getValue('theme_title'), 0777)){
        XT::log("Could not create style directory",__FILE__,__LINE__,XT_ERROR);
    }
    $file = file_get_contents(getcwd() . '/styles/live/skeleton.css');
    file_put_contents(getcwd() . '/styles/live/' . XT::getValue('theme_title') . '/' . XT::getValue('css'), $file);
    @chmod(getcwd() . '/styles/live/' . XT::getValue('theme_title') . '/' . XT::getValue('css'),0777);

    $file = file_get_contents(getcwd() . '/styles/live/skeleton_print.css');

    $file = str_replace('[THEME]',XT::getValue('theme_title'),$file);

    file_put_contents(getcwd() . '/styles/live/' . XT::getValue('theme_title') . '/print.css', $file);
    @chmod(getcwd() . '/styles/live/' . XT::getValue('theme_title') . '/print.css',0777);


}

XT::setAdminModule('slave1');

?>