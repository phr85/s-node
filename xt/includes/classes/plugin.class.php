<?php
class XT_Plugin {

    // NEW

    var $_baseid = 0;
    var $_package = "";
    var $_node_perms = array();
    var $permission_file = "";
    var $contributingPackage = "";
    var $_tree_way = array();

    // OLD

    var $location = '';
    var $tpl_location = '';
    var $package = '';
    var $adminModule = '';
    var $params = array();
    var $tables = array();
    var $base_id = '';
    var $action = '';
    var $actions = array();
    var $tabRelations = array();
    var $tabs = array();
    var $buttons = array();
    var $contentTypes = array();
    var $module = '';

    var $row_count = 0;
    var $page_count = 0;
    var $per_page = 20;
    var $active_page = 1;

    var $char_filter_field = '';
    var $char_filter_mode = '';
    var $char_filter_enabled = false;

    var $perms = array();
    var $not_single_perms = array();
    var $_extension_points = array();
    var $_pre_calls = array();
    var $_post_calls = array();

    /**
     * Set base ID of this plugin
     *
     * @param int Base ID
     */
    function setBaseID($baseid){
        $this->_baseid = $baseid;
        $this->base_id = $baseid;
    }

    /**
     * Get the base ID ot this plugin
     *
     * @return int Base ID
     */
    function getBaseID(){
        return $this->_baseid;
    }

    function setPackage($package){
        $this->_package = $package;
    }

    function getPackage(){
        return $this->_package;
    }

    function XT_Plugin($params){
        $this->setParams($params);
    }

    function setNodePerms($perms){
        $this->_node_perms = $perms;
    }

    function setTreeWay($way){
        $this->_tree_way = $way;
    }

    function getTreeWay(){
        return $this->_tree_way;
    }

    function getNodePerm($node_id, $perm){
        if(!isset($this->_node_perms[$node_id])){
            return null;
        }
        return $GLOBALS['perm']->getPerm($this->_node_perms[$node_id],$this->getPermissionID($perm));
    }

    function setParams($params){
        $this->params = $params;
        $this->package = $this->params['package'];
        $this->module = $this->params['module'];

        $this->tpl_location = $GLOBALS['tpl']->template_dir . $this->package . "/" . $this->module . "/";
        $this->location = PLUGIN_DIR . $this->package . "/" . $this->module . "/";
    }

    function addExtensionPoint($module,$extensionpoint){
        if(!is_array($this->_extension_points[$module])){
            $this->_extension_points[$module] = array();
        }
        array_push($this->_extension_points[$module],$extensionpoint);
    }

    var $_contributions = array();

    function contribute(){
        $args = func_get_args();
        $extensionpoint = $args[0];
        array_shift($args);
        if(is_file(PLUGIN_DIR . $this->getPackageName() . '/includes/extensionpoints/' . $extensionpoint . '.extensionpoint.php')){
            include_once(PLUGIN_DIR . $this->getPackageName() . '/includes/extensionpoints/' . $extensionpoint . '.extensionpoint.php');
            if(!in_array($extensionpoint, $this->_extension_points)){
                array_push($this->_extension_points,$extensionpoint);
            }
            return call_user_func('xt_' . str_replace(".", "_", $this->getPackageName()) . '_contribute_' . $extensionpoint, $args);
        } else {
            XT::log('Extensionpoint ' . PLUGIN_DIR . $this->getPackageName() . '/includes/extensionpoints/' . $extensionpoint . '.extensionpoint.php not found',__FILE__,__LINE__,XT_ERROR);
        }
    }

    function buildExtensions(){
        foreach($this->_extension_points as $point){
            call_user_func('xt_' . str_replace(".", "_", $this->getPackageName()) . '_build_' . $point);
        }
    }

    function contributePre($extensionpoint,$content){
        if(!is_array($this->_contributions[$extensionpoint])){
            $this->_contributions[$extensionpoint] = array();
        }
        array_unshift($this->_contributions[$extensionpoint],$content);
    }

    function getContributions($extensionpoint){
        return $this->_contributions[$extensionpoint];
    }

    function enablePermissions(){
        if(is_file(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . "_ch.iframe.snode.permissions.zl")){
            $last_perm = end($this->perms);

            //$this->permission_file = "01.managePermissions.permission.php";
            $this->perms['managePermissions']['actions'] = array("");
            $this->perms['managePermissions']['description'] = 'managePermissions';
            $this->perms['managePermissions']['name'] = 'managePermissions';
            $this->perms['managePermissions']['id'] = 1;

            //$this->permission_file = "02.manageNodePermissions.permission.php";
            $this->actions['editNodePerms']['perm_id'] = 2;
            $this->perms['manageNodePermissions']['actions'] = array("editNodePerms");
            $this->perms['manageNodePermissions']['description'] = 'manageNodePermissions';
            $this->perms['manageNodePermissions']['name'] = 'manageNodePermissions';
            $this->perms['manageNodePermissions']['id'] = 2;

            if(XT::getPermission('managePermissions')){

                $this->addTab('p','Permissions','perms.php',false,true);
            }
        }
    }

    function getPackageName(){
        return $this->package;
    }

    function getModuleName(){
        return $this->module;
    }

    /**
     * Adds a permission
     */
    function addPermission($description, $actions = array()){
        $perm = explode("." , $this->permission_file);
        if (is_array($actions)){
            foreach($actions as $key => $value){
                $this->actions[$value]['perm_id'] = $perm[0];
            }
        }else{
            XT::log('Permission / action: <i>' . $this->permission_file . " - " . $description . " " .  $actions . "</i> command malformed",__FILE__,__LINE__,XT_ERROR);
        }
        $this->perms[$perm[1]]['actions'] = $actions;
        $this->perms[$perm[1]]['description'] = $description;
        $this->perms[$perm[1]]['name'] = $perm[1];
        $this->perms[$perm[1]]['id'] = $perm[0];
    }

    function contributePermission($identifier, $action){
        $this->actions[$action]['perm_id'] = $this->getPermissionID($identifier);
        array_push($this->perms[$identifier]['actions'], $action);
    }

    function getPermissionID($perm){
        return $this->perms[$perm]['id'];
    }

    function getPermissions(){
        return $this->perms;
    }

    function removePermissionsOnSingleContent($perms){
        $this->not_single_perms = $perms;
    }

    function getActionPermission($action){
        return $this->actions[$action]['perm_id'];
    }

    /**
     * Get all allowed functions
     */
    function getAllowedFunctions(){
        $allowed = array();
        foreach($this->perms as $key => $value){
            if($GLOBALS['perm']->getPermissionByID($value['id'],$this->getBaseID())){
                array_push($allowed,$value);
            }
        }
        return $allowed;
    }

    /**
     * Get denied functions
     */
    function getDeniedFunctions(){
        $denied = array();
        foreach($this->perms as $key => $value){
            if(!$GLOBALS['perm']->getPermissionByID($value['id'],$this->getBaseID())){
                array_push($denied,$value);
            }
        }
        return $denied;
    }

    /**
     * Adds a tab into plugin administration
     */
    function addTab($shortcut, $name, $file, $default, $visible){
        $this->tabs[$shortcut]['title'] = $name;
        $this->tabs[$shortcut]['file'] = $file;
        $this->tabs[$shortcut]['default'] = $default;
        $this->tabs[$shortcut]['visible'] = $visible;
    }

    /**
     * Adds a one-way relation between one and another tab
     */
    function addTabRelation($shortcut, $second_shortcut){
        $this->tabRelations[$shortcut][$second_shortcut] = true;
    }

    /**
     * Adds a double relation between one and another tab
     */
    function addTabDoubleRelation($shortcut, $second_shortcut){
        $this->tabRelations[$shortcut][$second_shortcut] = true;
        $this->tabRelations[$second_shortcut][$shortcut] = true;
    }

    function setTabs($tabs){
        $this->tabs = $tabs;
    }

    /**
     * Get all tabs for this plugin
     */
    function getTabs(){
        if(array_key_exists($this->getAdminModule(), $this->tabRelations)){
            foreach($this->tabRelations[$this->getAdminModule()] as $key => $value){
                $this->tabs[$key]['visible'] = true;
            }
            $this->tabs[$this->getAdminModule()]['visible'] = true;
        }
        return $this->tabs;
    }

    /**
     * Get all tabs for this plugin
     */
    function getVisibleTabs(){
        if(array_key_exists($this->getAdminModule(), $this->tabRelations)){
            foreach($this->tabRelations[$this->getAdminModule()] as $key => $value){
                $this->tabs[$key]['visible'] = true;
            }
            $this->tabs[$this->getAdminModule()]['visible'] = true;
        }
        return $this->tabs;
    }

    /**
     * Set visibility of a tab to hidden or visible
     */
    function setTabVisibility($shortcut, $visibility){
        $this->tabs[$shortcut]['visible'] = $visibility;
    }

    /**
     * Get the visibility of a given tab
     */
    function getTabVisibility($shortcut){
        return $this->tabs[$shortcut]['visible'];
    }

    /**
     * Add a configuration variable with a value and a description
     */
    function addConfig($name, $value, $desc = ''){
        $this->config[$name]['value'] = $value;
        $this->config[$name]['desc'] = $GLOBALS['lang']->msg($desc);
    }

    /**
     * Get the value of a given configuration variable
     */
    function getConfig($name){
        return $this->config[$name]['value'];
    }

    /**
     * Get all configuration variables
     */
    function getConfigs(){
        return $this->config;
    }

    /**
     * Get the description of a given configuration variable
     */
    function getConfigDescription($name){
        return $this->config[$name]['desc'];
    }

    /**
     * Get a parameter given by the plugin call
     *
     * @param var Variable name
     * @return The variables value
     */
    function getParam($var){

        if(array_key_exists($var, $this->params)){
            return $this->params[$var];
        } else {
            return NULL;
        }

    }
    /**
     * Set a parameter
     *
     * @param var Variable name
     * @param val Variable Value
     * @return NULL
     */
    function setParam($var,$val){
        $this->params[$var] = $val;
        return NULL;
    }


    /**
     * Get all parameters
     */
    function getParams(){
        return $this->params;
    }

    /**
     * Add a table which is used by the plugin
     */
    function addTable($key, $name, $desc, $use_lang = false, $prefix = true){
        if($prefix){
            if($use_lang){
                $this->tables[$key]['name'] = $GLOBALS['cfg']->get("database", "prefix") . $name . "_" . $this->getActiveLang();
            } else {
                $this->tables[$key]['name'] = $GLOBALS['cfg']->get("database", "prefix") . $name;
            }
        }else{
            if($use_lang){
                $this->tables[$key]['name'] = $name . "_" . $this->getActiveLang();
            } else {
                $this->tables[$key]['name'] = $name;
            }
        }

        $this->tables[$key]['desc'] = $GLOBALS['lang']->msg($desc);
        $this->tables[$key]['uselang'] = $use_lang;
    }

    /**
     * Get the real table name of a used table
     */
    function getTable($key){
        return $this->tables[$key]['name'];
    }

    /**
     * Get all tables used by this plugin
     */
    function getTables(){
        return $this->tables;
    }


    function addActionSet($name, $file){
        $this->actionSets[$name]['file'] = $file;
        return $name;
    }
    function getActions(){
        return $this->actions;
    }

    /**
     * Register an action
     *
     * @param index Index of this action
     * @param command Short form command of this action (used for action call)
     * @param actionSet The action set where this action should be placed
     * @param desc A short description of what this action is for
     */
    function registerAction($index, $command, $actionSet, $desc = ""){
        $this->actions[$command]['actionSet'] = $actionSet;
        $this->actions[$command]['index'] = $index;
        $this->actionDescriptions[$command] = $GLOBALS['lang']->msg($desc);
    }

    /**
     * Get the permissions for each action
     *
     * @param rights The permission checksum from the db
     * @return An array with all the permissions for each action
     */
    function getActionPerms($rights){
        foreach($this->actions as $key => $value){
            $this->perms[$value['index']] = $GLOBALS['perm']->getPerm($rights, $value['index']);
        }
        return $this->perms;
    }

    /**
     * Get the description for given action
     *
     * @param command Action command
     * @return The description for the given action
     */
    function getActionDescription($command){
        return $this->actionDescriptions[$command];
    }

    /**
     * Get all action descriptions
     *
     * @return An array with all action descriptions
     */
    function getActionDescriptions(){
        return $this->actionDescriptions;
    }

    /**
     * Get the file for a given action set
     */
    function getActionSetFile($actionSet){
        $this->actionSets[$actionSet]['file'];
    }

    /**
     * Perform all called actions
     */
    function performActions(){

        if(!isset($GLOBALS['performedActions'])){
            global $performedActions;
        }

        // Be sure that no previous action is set
        unset($this->action);

        $this->action = '';

        // Get action from url
        if(isset($_GET['x' . $this->_baseid . '_action'])){
            $this->action = addslashes($_GET['x' . $this->_baseid . '_action']);
        }

        // Get action from Post
        if(isset($_POST['x' . $this->_baseid . '_action'])){
            $this->action = addslashes($_POST['x' . $this->_baseid . '_action']);
        }


        if(!$GLOBALS['performedActions'][$this->getBaseID()][$this->action]){

            // Push performed action
            $GLOBALS['performedActions'][$this->getBaseID()][$this->action] = true;

            // Get requested action
            if($this->action != ''){
                $isremoteaction = explode(".",$this->action);
                if(XT::getActionPermission($this->action) || count($isremoteaction) > 1){
                    // Call this action
                    $this->call($this->action);
                } else {
                    XT::log("Keine Berechtigung diese Aktion auszuführen (" . $this->action . ")",__FILE__,__LINE__,XT_ERROR);
                }

            }
        }

        // Get XT autoaction from Post and execute if no remoteaction is given
        if(isset($_POST['x' . $this->_baseid . '_XT_autoaction']) && count($isremoteaction) < 2){
            foreach ($_POST['x' . $this->_baseid . '_XT_autoaction'] as $autoaction) {
             	$this->call($autoaction);
             }
        }

    }

    function call(){
        if (!$this->actionIsStopped()){
	        $args = func_get_args();
	        $action = $args[0];
	        array_shift($args);
	        // remote action handler
	        $extendedargs = explode(".",$action);

	        // default action if count = 1
	        if(count($extendedargs) < 2){
	            // load plugin action
	            if(is_file(PLUGIN_DIR . $this->getPackageName() . '/includes/actions/' . $action . '.action.php')){
	                $this->_pre_calls[$action] = array();
	                $this->_post_calls[$action] = array();
	                /**
	             * get all pre and post codes
	             */
	                $codes = glob(PLUGIN_DIR . $this->getPackageName() . '/includes/actions/' . $action . '.*.*action.php');

	                if(is_array($codes)){
	                    foreach($codes as $file){
	                        if(substr($file,-13) == "preaction.php"){
	                            array_push($this->_pre_calls[$action],$file);
	                        } else {
	                            array_push($this->_post_calls[$action],$file);
	                        }
	                    }
	                }

	                // Execute pre code
	                if(is_array($this->_pre_calls[$action])){
	                    foreach($this->_pre_calls[$action] as $file){
	                        if (!$this->actionIsStopped()){
	                        	@include($file);
	                        }
	                    }
	                }
					if (!$this->actionIsStopped()){
		                // Execute main action
		                include(PLUGIN_DIR . $this->getPackageName() . '/includes/actions/' . $action . '.action.php');
					}
	                // Execute post code
	                if(is_array($this->_post_calls[$action])){
	                    foreach($this->_post_calls[$action] as $file){
	                        if (!$this->actionIsStopped()){
	                        	@include($file);
	                        }
	                    }
	                }
	            } else {
	                $contrib_actions = glob(PLUGIN_DIR . $this->getPackageName() . '/includes/actions/' . $action . '.*.action.php');
	                if(is_file($contrib_actions[0])){
	                    if (!$this->actionIsStopped()){
	                    	@include($contrib_actions[0]);
	                    }
	                }else{
	                    XT::log('Action file ' . PLUGIN_DIR . $this->getPackageName() . '/includes/actions/' . $action . '.action.php not found',__FILE__,__LINE__,XT_ERROR);
	                    $handle = fopen(PLUGIN_DIR . $this->getPackageName() . '/includes/actions/' . $action . '.action.php', "w");
	                    fwrite($handle, '<?php
	                XT::log(\'' . PLUGIN_DIR . $this->getPackageName() . '/includes/actions/' . $action . '.action.php not yet edited\',__FILE__,__LINE__,XT_WARNING);
	                ?>');
	                }
	            }
	        }else{
	            // remote action handler
	            $extpackagename = $extendedargs[0] . "." . $extendedargs[1] . "." . $extendedargs[2] . "." . $extendedargs[3];
	            // check if action exists and licence exists
	            if(is_file(PLUGIN_DIR . $extpackagename . '/includes/remoteactions/' . $extendedargs[4] . '.action.php') && is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_" . $extpackagename . '.zl')){
	                $this->_pre_calls[$extendedargs[4]] = array();
	                $this->_post_calls[$extendedargs[4]] = array();
	                /**
	             * get all pre and post codes
	             */
	                $codes = glob(PLUGIN_DIR . $extpackagename . '/includes/remoteactions/' . $extendedargs[4] . '.*.*action.php');

	                if(is_array($codes)){
	                    foreach($codes as $file){
	                        if(substr($file,-13) == "preaction.php"){
	                            array_push($this->_pre_calls[$extendedargs[4]],$file);
	                        } else {
	                            array_push($this->_post_calls[$extendedargs[4]],$file);
	                        }
	                    }
	                }

	                // lade lizenz voraus
	                if(function_exists("zend_loader_install_license")){
	                    @zend_loader_install_license(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . "_" . $extpackagename . ".zl",1);
	                }

	                // Execute pre code
	                if(is_array($this->_pre_calls[$extendedargs[4]]) && !$this->actionIsStopped()){
	                    foreach($this->_pre_calls[$extendedargs[4]] as $file){
	                       if (!$this->actionIsStopped()){
	                        	@include($file);
	                        }
	                    }
	                }

	                // Execute main action
	                if (!$this->actionIsStopped()){
	                	include(PLUGIN_DIR . $extpackagename . '/includes/remoteactions/' . $extendedargs[4] . '.action.php');
	                }
	                // Execute post code
	                if(is_array($this->_post_calls[$extendedargs[4]]) && !$this->actionIsStopped()){
	                    foreach($this->_post_calls[$extendedargs[4]] as $file){
	                       if (!$this->actionIsStopped()){
	                        	@include($file);
	                        }
	                    }
	                }
	            }else{
	            	XT::log($GLOBALS["cfg"]->get("system","order_nr") . "_" . $extpackagename . '.zl no licence, or ' . $extpackagename . "." . $extendedargs[4] . " no file",__FILE__,__LINE__,XT_ERROR);
	            }
	        } // eof remote action handler
        }
    }

    function setAdminModule($module){
        $_GET['module'] = $module;
        $this->adminModule = $module;
        //$this->setSessionValue('adminModule', $module);

        $this->tabs[$module]['visible'] = true;
    }

    function getAdminModule(){
        return $this->adminModule;
    }

    // return session value from actual plugin or if baseid is given from an other package
    function getSessionValue($var, $baseid = 0){
        if($baseid > 0){
            if(isset($_SESSION['x' . $baseid][$var])){
                if(!is_array($_SESSION['x' . $baseid][$var])){
                    return addslashes($_SESSION['x' . $baseid][$var]);
                } else {
                    return $_SESSION['x' . $baseid][$var];
                }
            } else {
                return false;
            }
        }else{
            if(isset($_SESSION['x' . $this->_baseid][$var])){
                if(!is_array($_SESSION['x' . $this->_baseid][$var])){
                    return addslashes($_SESSION['x' . $this->_baseid][$var]);
                } else {
                    return $_SESSION['x' . $this->_baseid][$var];
                }
            } else {
                return false;
            }
        }
    }

    function setSessionValue($var, $value, $baseid = ''){
        if($baseid==''){
            $_SESSION['x' . $this->_baseid][$var] = $value;
        }else{
            $_SESSION['x' . $baseid][$var] = $value;
        }
    }

    function getPostValue($var,$escape=true,$baseid=0){
        if($baseid==0){
            if(isset($_POST['x' . $this->_baseid . '_' . $var])){
                if(is_array($_POST['x' . $this->_baseid . '_' . $var])){
                    return $_POST['x' . $this->_baseid . '_' . $var];
                }
                if($escape){
                    return addslashes($_POST['x' . $this->_baseid . '_' . $var]);
                } else {
                    return stripslashes($_POST['x' . $this->_baseid . '_' . $var]);
                }
            }
            return false;
        }else{
            if(isset($_POST['x' . $baseid . '_' . $var])){
                if(is_array($_POST['x' . $baseid . '_' . $var])){
                    return $_POST['x' . $baseid . '_' . $var];
                }
                if($escape){
                    return addslashes($_POST['x' . $baseid . '_' . $var]);
                } else {
                    return stripslashes($_POST['x' . $baseid . '_' . $var]);
                }
            }
            return false;
        }
    }

    function getUrlValue($var, $baseid=0){
        if($baseid==0){
            if(isset($_GET['x' . $this->_baseid . '_' . $var])){
            	if(is_array($_GET['x' . $this->_baseid . '_' . $var])){
                    return $_GET['x' . $this->_baseid . '_' . $var];
                }
                return addslashes($_GET['x' . $this->_baseid . '_' . $var]);
            } else {
                return false;
            }
        }else{
            if(isset($_GET['x' . $baseid . '_' . $var])){
            	if(is_array($_GET['x' . $baseid . '_' . $var])){
                    return $_GET['x' . $baseid . '_' . $var];
                }
                return addslashes($_GET['x' . $baseid . '_' . $var]);
            } else {
                return false;
            }
        }
    }

    function setValue($var,$value,$baseid=0){
        if($baseid==0){
            $_GET['x' . $this->_baseid . '_' . $var] = $value;
            $_POST['x' . $this->_baseid . '_' . $var] = $value;
        }else {
            $_GET['x' . $baseid . '_' . $var] = $value;
            $_POST['x' . $baseid . '_' . $var] = $value;
        }
    }

    function setPostValue($var,$value){
        $_POST['x' . $this->_baseid . '_' . $var] = $value;
    }

    function unsetSessionValue($var){
        unset($_SESSION['x' . $this->_baseid][$var]);
    }

    /**
     * Returns the post or get value for a plugin variable
     * if a post and a get value is available this function will return the post value
     * Returns false if no variable with requested name available
     *
     * @param string $var name of the variable
     * @param bool $stripslashes stripslashes the return value
     * @param int $baseid if baseid isset, the value of this baseid will be returned otherwise the value of the current plugin
     * @return the post or get value for a plugin variable or false
     */
    function getValue($var,$stripslashes=1, $baseid=0){
        if($baseid==0){
            if($this->getPostValue($var) != ''){
                if($stripslashes==0){
                    return $this->getPostValue($var);
                }else{
                    if(!is_array($this->getPostValue($var))){
                        return stripslashes($this->getPostValue($var));
                    }else{
                        return $this->getPostValue($var);
                    }
                }
            }
            if($this->getUrlValue($var) != ''){
                if($stripslashes==0){
                    return $this->getUrlValue($var);
                }else{
                	if(!is_array($this->getUrlValue($var))){
                        return stripslashes($this->getUrlValue($var));
                    }else{

                        return $this->getUrlValue($var);
                    }
                }
            }
            return false;
        }else{
            if($this->getPostValue($var,true,$baseid) != ''){
                if($stripslashes==0){
                    return $this->getPostValue($var,true,$baseid);
                }else{
                    return stripslashes($this->getPostValue($var,true,$baseid));
                }
            }
            if($this->getUrlValue($var,$baseid) != ''){
                if($stripslashes==0){
                    return $this->getUrlValue($var,$baseid);
                }else{
                    return stripslashes($this->getUrlValue($var,$baseid));
                }
            }
            return false;
        }
    }



    /**
     * Add a button to an admin module
     */
    function addButton($label, $action, $set="default", $accesskey="",  $class="button", $disabled=''){
        $this->buttons[$set][$action]['action'] = $action;
        $this->buttons[$set][$action]['label'] = $GLOBALS['lang']->msg($label);
        $this->buttons[$set][$action]['class'] = $class;
        $this->buttons[$set][$action]['icon'] = "window.png";
        $this->buttons[$set][$action]['disabled'] = $disabled;
        if($accesskey !=""){
            $this->buttons[$set][$action]['accesskey'] = $accesskey;
        }
    }

    function addImageButton($label, $action, $set="default", $icon="", $form="", $target="", $accesskey="", $focus ="", $script ="", $class="button", $disabled=''){
        $this->buttons[$set][$action]['action'] = $action;
        if($icon != ""){
            $this->buttons[$set][$action]['icon'] = $icon;
        } else {
            $this->buttons[$set][$action]['icon'] = "window.png";
        }
        $this->buttons[$set][$action]['form'] = $form;

        if($target != ''){
            $this->buttons[$set][$action]['target'] = "window.parent.frames['" . $target . "'].";
        }
        $this->buttons[$set][$action]['focus'] = '';
        if($focus != ''){
            $this->buttons[$set][$action]['focus'] = "window.parent.frames['" . $focus . "'].focus();";
        }
        if($script != ''){
            $this->buttons[$set][$action]['script'] = $script;
        }
        $this->buttons[$set][$action]['label'] = $GLOBALS['lang']->msg($label);
        $this->buttons[$set][$action]['class'] = $class;
        $this->buttons[$set][$action]['disabled'] = $disabled;
        if($accesskey !=""){
            $this->buttons[$set][$action]['accesskey'] = $accesskey;
        }
    }

    /**
     * Get all defined buttons for this admin module
     */
    function getButtons($set = "default"){
        return @$this->buttons[$set];
    }

    /**
     * Updates a data row
     */
    function updateItem($id, $data, $table){
        $fields = "";
        $first = true;
        foreach($data as $key => $value){
            if($first){
                $fields .= $key . " = '" . $value . "'";
                $first = false;
            } else {
                $fields .= "," . $key . " = '" . $value . "'";
            }
        }

        $fields .=
        " , mod_date = " . time() . "," .
        " mod_user = " . $_SESSION['user']['id'];

        $GLOBALS['db']->query("UPDATE " . $this->getTable($table) . " SET
        " . $fields . "
        WHERE id = " . $id);
    }

    function redirect($link){
        header("Location: " . $link);
    }

    function enableCharFilter($field, $mode = 'WHERE'){
        $this->char_filter_enabled = true;
        $this->char_filter_field = $field;
        $this->char_filter_mode = $mode;
    }

    function getCharFilter($mode = 'WHERE'){

        $this->char_filter_mode = $mode;

        /**
         * look for a character filter
         */
        if($this->getValue("char_filter") != ''){
            if($this->getValue("char_filter") == 'all'){
                $this->unsetSessionValue("char_filter");
            } else {
                //$this->active_page = 1;
                $this->setSessionValue('char_filter', $this->getValue("char_filter"));
            }
        }

        $charfilter = '';
        if($this->getSessionValue("char_filter") != ''){
            if($this->getSessionValue("char_filter") == 'num'){
                $charfilter = " " . $this->char_filter_mode . " SUBSTRING(" . $this->char_filter_field . ",1,1) IN (0,1,2,3,4,5,6,7,8,9)";
            } else {
                if($this->getSessionValue("char_filter") == 'special'){
                    $charfilter = " " . $this->char_filter_mode . " SUBSTRING(" . $this->char_filter_field . ",1,1) NOT IN (0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z')";
                } else {
                    $charfilter = " " . $this->char_filter_mode . " LOWER(" . $this->char_filter_field . ") LIKE LOWER('" . $this->getSessionValue("char_filter") . "%')";
                }
            }
            $GLOBALS['tpl']->assign("CHAR_FILTER", $this->getSessionValue("char_filter"));
        }
        return $charfilter;
    }

    function enableNavigator($table, $field = 'id', $query = ''){

        /**
         * look for a character filter
         */
        if($this->getValue("page") != ''){
            $this->setSessionValue('page', $this->getValue("page"));
        }
        // Check if char filter is enabled
        if($this->char_filter_enabled){
            if($query != ''){
                $result = XT::query($query);
            } else {
                // query the number of entries with the charfilter
                $result = XT::query("SELECT count(" . $field . ") as count_id FROM " . $this->getTable($table) . " " . $this->getCharFilter());
            }
        } else {
            if($query != ''){
                $result = XT::query($query);
            } else {
                // query the number of entries without the charfilter
                $result = XT::query("SELECT count(" . $field . ") as count_id FROM " . $this->getTable($table));
            }
        }

        while($row = $result->FetchRow()){
            // divide the number of entries with 20 and store the next higher integer value
            $this->per_page = ceil($row['count_id'] / 20);
            // if the number is less than 20 set it to 20
            if($this->per_page < 20){
                $this->per_page =20;
            }
            if($this->per_page > 500){
            	$this->per_page =500;
            }
            // divide the number of entries with $this->per_page and store the next higher integer value
            $this->row_count = $row['count_id'];
            $this->page_count = ceil($this->row_count/$this->per_page);
        }

        for($i=1; $i<=$this->page_count;$i++){
            // add an array element for each page
            $this->pages[$i] = 1;
        }

        if($this->getSessionValue("page") != ''){
            // set the session value as active page
            $this->active_page = $this->getSessionValue("page");
            if($this->active_page > $this->page_count){
                // set the highest page as active if the active is higher then the pagecount
                $this->active_page = $this->page_count;
                $this->setSessionValue("page", $this->active_page);
            } else {
                if($this->active_page < 1 || $this->active_page == ""){
                    // set the first page as active page if the active page is less than 1
                    $this->setSessionValue("page", 1);
                } else {
                    $this->setSessionValue("page", $this->active_page);
                }
            }
        }
        $GLOBALS['tpl']->assign("TOTAL_COUNT", $this->row_count);   // Total entry count
        $GLOBALS['tpl']->assign("ACTIVE_PAGE", $this->active_page); // Active page
        $GLOBALS['tpl']->assign("PAGES", $this->pages);             // All the pages
        $GLOBALS['tpl']->assign("PAGE_COUNT", $this->page_count);   // Total page count
        if (($this->active_page-1)*$this->per_page+1<=0) {
            $GLOBALS['tpl']->assign("PAGE_START",1);
        } else {
            $GLOBALS['tpl']->assign("PAGE_START", ($this->active_page-1)*$this->per_page+1);
        }
        if(($this->active_page-1)*$this->per_page+$this->per_page <= $this->row_count){
            if (($this->active_page-1)*$this->per_page+$this->per_page > 0){
                $GLOBALS['tpl']->assign("PAGE_END", ($this->active_page-1)*$this->per_page+$this->per_page);
            } else {
                $GLOBALS['tpl']->assign("PAGE_END", 19);
            }
        } else {
            //$GLOBALS['tpl']->assign("PAGE_END", ($this->active_page-1)*$this->per_page+$this->per_page);
            $GLOBALS['tpl']->assign("PAGE_END", ($this->active_page-1)*$this->per_page+$this->per_page);

        }
    }

    function getLimiter(){
        if(($this->active_page-1)*$this->per_page-1 >= 0){
            return ($this->active_page-1)*$this->per_page-1 . "," . $this->per_page;
        } else {
            return "0," . ($this->per_page);
        }
    }

    function addContentType($id, $ct){
        $this->contentTypes[$ct] = $id;
    }

    function getContentType($ct){
        return $this->contentTypes[$ct];
    }

    function enableMultiLang($table, $field, $in = "0"){

        // Set language filter
        if($this->getSessionValue("lang_filter") == ''){
            $this->setSessionValue("lang_filter", $GLOBALS['cfg']->get("lang", "default"));
        }
        // Check for a lang filter
        $lang_filter = "";
        if($this->getValue("lang_filter") != ''){
            if($this->getValue("lang_filter") == 'none'){
                $this->unsetSessionValue("lang_filter");
            } else {
                $this->setSessionValue("lang_filter", $this->getValue("lang_filter"));
            }
        }

        if($this->getSessionValue("lang_filter") != ''){
            $lang_filter = $this->getSessionValue("lang_filter");
        }

        $GLOBALS['tpl']->assign("LANGS", $GLOBALS['cfg']->getLangs());
        $GLOBALS['tpl']->assign("LANG_FILTER", $lang_filter);
        $GLOBALS['tpl']->assign("ACTIVE_LANG", $lang_filter);
        if(is_numeric($in)){
            $GLOBALS['tpl']->assign("ITEM_LANGS", $this->getLangsAvailableById($table,$field,$in));
        } else {
            $GLOBALS['tpl']->assign("ITEM_LANGS", $this->getLangsAvailable($table,$field,$in));
        }
    }

    function getActiveLang(){
        // Set language filter
        if($this->getSessionValue("lang_filter") == ''){
            $this->setSessionValue("lang_filter", $GLOBALS['cfg']->get("lang", "default"));
        }
        // Check for a lang filter
        $lang_filter = "";
        if($this->getValue("lang_filter") != ''){
            if($this->getValue("lang_filter") == 'none'){
                $this->unsetSessionValue("lang_filter");
            } else {
                $this->setSessionValue("lang_filter", $this->getValue("lang_filter"));
            }
        }

        if($this->getSessionValue("lang_filter") != ''){
            $lang_filter = $this->getSessionValue("lang_filter");
        }
        return $lang_filter;
    }

    function getLangsAvailable($table, $field, $in){
        $langs = array();
        foreach($GLOBALS['cfg']->getLangs() as $key => $value){
            $langs[$key] = array();
        }
        if($in != ''){
            $result = $GLOBALS['db']->query("SELECT " . $field . ", lang, active FROM " . $this->getTable($table) . " as a
            WHERE " . $field . " IN (" . $in . ")
            ",__FILE__,__LINE__);
            while($row = $result->FetchRow()){
                if($row['active']){
                    $langs[$row['lang']][$row[$field]] = 1;
                } else {
                    $langs[$row['lang']][$row[$field]] = 2;
                }
            }
        }
        return $langs;
    }

    function getLangsAvailableById($table,$field,$id){
        $langs = array();
        $result = $GLOBALS['db']->query("SELECT " . $field . ", lang, active FROM " . $this->getTable($table) . " as a
        WHERE " . $field . " = " . $id . "
        ",__FILE__,__LINE__);
        while($row = $result->FetchRow()){
            if(!array_key_exists($row['lang'], $langs)){
                $langs[$row['lang']] = array();
            }
            if($row['active']){
                $langs[$row['lang']][$row[$field]] = 1;
            } else {
                $langs[$row['lang']][$row[$field]] = 2;
            }
        }
        return $langs;
    }

    function jumpTo($shortcut){
        header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . XT::getTemplateID() . "&module=" . $shortcut);
    }

    /**
      * Stop an action
      * @param string $message Error message
      */
      function actionStop($message,$fieldlabel,$translate) {
      	if($translate){
      		$GLOBALS['actionstop'][$this->action][$fieldlabel] = XT::translate($message);
      	}else {
      		$GLOBALS['actionstop'][$this->action][$fieldlabel] = $message;
      	}
      }

      /**
      * check if action is stopped
      */
      function actionIsStopped(){
      	if (count($GLOBALS['actionstop'][$this->action]) > 0) {
      		return true;
      	} else {
      		return false;
      	}
      }

      function getActionStopped($action = ""){
      	if ($action != "" && is_array($GLOBALS['actionstop'][$action])) {
      		return $GLOBALS['actionstop'][$action];
      	} else {
      		return $GLOBALS['actionstop'][$this->action];
      	}
      }
}
?>