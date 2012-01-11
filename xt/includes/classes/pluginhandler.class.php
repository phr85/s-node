<?php

class XT_PluginHandler {

    var $_params = array();
    var $_plugins = array();
    var $_performedActions = array();

    function _setParams($params){
        $this->_params = $params;
    }

    function load($params){
	
    	$content = "";    

        $this->_setParams($params);
        if(!isset($GLOBALS['plugins'])){
            global $plugin;
            $GLOBALS['plugins'] = array();
            $this->_plugins = &$GLOBALS['plugins'];
        }
        if(!isset($GLOBALS['plugin'])){
            global $plugin;
            $GLOBALS['plugin'] = null;
        }

        // Create plugin object
        $GLOBALS['plugin'] = new XT_Plugin($this->_params);

        // Load translations
        $GLOBALS['lang']->loadPlugin($GLOBALS['plugin']->location);


        // load plugin permissions
        $ext_perms = glob(PLUGIN_DIR . $this->_params['package'] . '/includes/permissions/*.permission.php');
        if(is_array($ext_perms)){
            foreach($ext_perms as $perm_file){
                $GLOBALS['plugin']->permission_file = basename($perm_file);
                include_once($perm_file);
            }
        }

        // include plugin confguration if there is one
        if(is_file(PLUGIN_DIR . $this->_params['package'] . "/includes/config.inc.php")){
            include(PLUGIN_DIR . $this->_params['package'] . "/includes/config.inc.php");
        }


        if(!is_object(@$this->_plugins[$GLOBALS['plugin']->getBaseID()])){
            $this->_plugins[$GLOBALS['plugin']->getBaseID()] = $GLOBALS['plugin'];
        } else {
            // Add plugin to plugins stack
            $GLOBALS['plugin'] = $this->_plugins[$GLOBALS['plugin']->getBaseID()];
            $GLOBALS['plugin']->setParams($this->_params);
        }

        // load additional config vars for this plugin
        if(is_file(PLUGIN_DIR . $this->_params['package'] . "/includes/config_settings.inc.php")){
            include(PLUGIN_DIR . $this->_params['package'] . "/includes/config_settings.inc.php");
        }

        // Perform actions if requested
        if(is_file($GLOBALS['plugin']->performActions())){
            $GLOBALS['plugin']->performActions();
        }

        // Assign temporary template variables
        XT::assign("BASEID", $GLOBALS['plugin']->getBaseID());
        XT::assign("TPL", $GLOBALS['tpl_id']);
        XT::assign("SHOWTABS", $GLOBALS['plugin']->getParam("tabs") || @$_POST["adminmode"] || @$_POST["showtabs"]);

        // Assign permanent assigns
        if(is_array(@$_SESSION['ASSIGN'])){
            foreach ($_SESSION['ASSIGN'] as $key => $value){
                XT::assign($key, $value);
            }
        }



        if(substr($params['module'],-5) == 'admin'){
        // Check if this plugin has administration tabs
            if(is_array($GLOBALS['plugin']->getTabs()) && sizeof($GLOBALS['plugin']->getTabs()) > 0){

                // Unset previously defined tabs
                $tabs = array();

                // Reset module
                $module = '';

                if($GLOBALS['plugin']->getValue('module') != ''){
                    $module = $GLOBALS['plugin']->getValue('module');
                }
                // if a module is especially requested by a plugin, set it as module to load
                if($GLOBALS['plugin']->getAdminModule() != ''){
                    $module = $GLOBALS['plugin']->getAdminModule();
                }

                // Set module to URL var if is set
                if(isset($_REQUEST['module']) && $module == ''){
                    $module = addslashes($_REQUEST['module']);
                    $GLOBALS['plugin']->setAdminModule($module);
                }

                // Get Tab from session
                if($module == '' && $GLOBALS['plugin']->getSessionValue('adminModule') !=''){
                    $module = $GLOBALS['plugin']->getSessionValue('adminModule');
                    $GLOBALS['plugin']->setTabVisibility($module, true);
                }

                // Get each tab and his settings, define default tab
                foreach($GLOBALS['plugin']->getTabs() as $key => $value){
                    $tabs[$key]['title'] = $GLOBALS['lang']->msg($value['title']);
                    $tabs[$key]['file'] = $value['file'];
                    $tabs[$key]['visible'] = $value['visible'];
                    if($value['default'] && $module == ''){
                        $module = $key;
                    }
                }

                XT::assign("ADMINMODULE", $module);

                // load plugin extensions
                $ext = glob(PLUGIN_DIR . $this->_params['package'] . '/includes/extensions/*.' . $module . '.extension.php');
                if(is_array($ext)){
                    foreach($ext as $extension){
                        // name des packages aus array aufbauen
                        $extension_package_array = explode(".",basename($extension));
                        $extension_package_name = $extension_package_array[1] . "." .  $extension_package_array[2] . "." . $extension_package_array[3] . "." . $extension_package_array[4];
                        //Preload License
                        if(function_exists("zend_loader_install_license")){
                            @zend_loader_install_license(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . "_" . $extension_package_name . ".zl",1);
                        }

                        include($extension);
                    }
                }

                // Load Plugin Module with tabs
                switch($module){

                    // Load plugin part
                    default:
                        if(is_file($GLOBALS['plugin']->location . $tabs[$module]['file'])){
                            include($GLOBALS['plugin']->location . $tabs[$module]['file']);
                        } else {
                            XT::log("Module File \"" . $GLOBALS['plugin']->location . $tabs[$module]['file'] . "\" not found",__FILE__,__LINE__,XT_ERROR);
                            $handle = fopen($GLOBALS['plugin']->location . $tabs[$module]['file'], "w");
                            fwrite($handle, '<?php  XT::log(\'' . $GLOBALS['plugin']->location . $tabs[$module]['file'] . ' autocreated\',__FILE__,__LINE__,XT_WARNING); ?>');
                        }
                        break;
                }


                // Output Tabs
                XT::assign("TABS", $tabs);
                XT::assign("MODULE", $module);

                // Show error messages
                $msg_content = '';
                if(isset($GLOBALS['logger']) && sizeof($GLOBALS['logger']->getErrors()) > 0){
                    $GLOBALS['tpl']->assign("ERRORS", $GLOBALS['logger']->getErrors());
                    $msg_content = $GLOBALS['tpl']->fetch('includes/msg.tpl');
                }

                // Put tab code in front of the content
                if(substr($params['module'],-5) == "admin"){
                    return $content = $GLOBALS['tpl']->fetch('includes/tabs.tpl') . $msg_content . $content;
                }



            }
        }

        // Include plugin core
        if(is_file($GLOBALS['plugin']->location . "index.php")){
            require($GLOBALS['plugin']->location . "index.php");
        } else {
            XT::log("Plugin \"" . $GLOBALS['plugin']->location . "index.php" . "\" not found",__FILE__,__LINE__,XT_ERROR);
        }
		
		// Add the documentation help icons if a tpldoc is true
		if ($_REQUEST['outline_plugins']) {
			$content .= '<br/><a href="documentation.php?plugin=' . $this->_params['package'] .'&module=' . $this->_params['module']  . '" target="_blank"><img src="images/icons/text_find.png" alt="' . $this->_params['package']  . ' ' . $this->_params['module']  . '"/> <span style="font-size:8px;"> ' . $this->_params['package']  . ' ' . $this->_params['module']  . '</span></a></div>';
		}
		
        if ($_REQUEST['outline_plugins']) {
			$content_start = '<div style="border: 1px solid #' . sprintf("%02X%02X%02X", mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255)) . ';">';
		} else {
			$content_start = "";
		}
		
        return $content_start . $content;
    }

}

?>