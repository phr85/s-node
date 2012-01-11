<?php
/**
 * This is a wrapper class for most of the S-Node functionality
 * Always use these functions, do not directly call the other class
 * functions
 *
 * @package S-Node
 * @subpackage Core
 * @author Veith Zäch <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: xt.class.php 6044 2009-10-02 14:34:28Z vzaech $
 */

class XT {

    /**
     * Assigns a variable to the template.
     *
     * @param string target variable to assign value to, all letters should be uppercase e.g. BUTTONS or DATA
     */
    function assign($var, $value){
        $GLOBALS['tpl']->assign($var, $value);
    }
    /**
     * clear the given assigned template variable.
     *
     * @param string $tpl_var the template variable to clear
     */
    function clear_assign($var){
        $GLOBALS['tpl']->clear_assign($var);
    }

    /**
     * Lock a content element
     *
     * @param int $content_id
     * @param int $content_type
     */
    function lock($content_id, $content_type){

        XT::query("DELETE FROM " . $GLOBALS['cfg']->get("database","prefix") . "locks WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND content_type = " . $content_type . " AND content_id = " . $content_id . "",__FILE__,__LINE__);
        XT::query("INSERT INTO " . $GLOBALS['cfg']->get("database","prefix") . "locks (content_type,content_id,user_id,lock_date,lang) VALUES (" . $content_type . "," . $content_id . "," . XT::getUserID() . "," . time() . ",'" . $GLOBALS['plugin']->getActiveLang() . "')",__FILE__,__LINE__);

        // Get main table for this content type
        $result = XT::query("SELECT content_table, id_field FROM " . $GLOBALS['cfg']->get("database","prefix") . "content_types WHERE id = " . $content_type . "",__FILE__,__LINE__);
        $data = array();
        while($row = $result->FetchRow()){
            $data[] = $row;
        }

        XT::query("UPDATE " . $GLOBALS['cfg']->get("database","prefix") . "" . $data[0]['content_table'] . "_v SET locked_user = " . XT::getUserID() . ", locked_date = " . time() . ", locked = 1 WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND " . $data[0]['id_field'] . " = '" . $content_id . "'",__FILE__,__LINE__);
    }

    /**
     * Unlock a content element
     *
     * @param int $content_id
     * @param int $content_type
     */
    function unlock($content_id, $content_type){

        // Get main table for this content type
        $result = XT::query("SELECT content_table, id_field FROM " . $GLOBALS['cfg']->get("database","prefix") . "content_types WHERE id = " . $content_type . "",__FILE__,__LINE__);
        $data = array();
        while($row = $result->FetchRow()){
            $data[] = $row;
        }
        XT::query("DELETE FROM " . $GLOBALS['cfg']->get("database","prefix") . "locks WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND content_type = " . $content_type . " AND content_id = " . $content_id . "",__FILE__,__LINE__);
        XT::query("UPDATE " . $GLOBALS['cfg']->get("database","prefix") . "" . $data[0]['content_table'] . "_v SET locked_user = '', locked_date = '', locked = 0 WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND " . $data[0]['id_field'] . " = '" . $content_id . "'",__FILE__,__LINE__);
    }

    /**
     * Round a float number by 0,05
     *
     * @param float $value
     * @return Formatted String (e.g 7.65)
     */
    function round5($value){
        return sprintf("%.2f",round(20 * $value)/20);
    }

    /**
     * Assign a global template variable
     *
     * @param String $var
     * @param mixed $value
     */
    function assign_global($var, $value){
        $GLOBALS['ASSIGN'][$var] = $value;
    }

    /**
     * Assign a permanent template variable
     *
     * @param String $var
     * @param mixed $value
     */
    function assign_permanent($var, $value){
        $_SESSION['ASSIGN'][$var] = $value;
    }

    /**
     * Destroy a previously permanent assigned template variable
     *
     * @param unknown_type $var
     */
    function assign_permanent_destroy($var){
        unset($_SESSION['ASSIGN'][$var]);
    }

    /**
     * Translate a given expression
     *
     * @param String $string
     * @return Translated expression
     */
    function translate($string){
        return $GLOBALS['lang']->msg($string);
    }

    /**
     * Translate a given expression, with support for replacements
     *
     * e.g. Today is %1
     *
     * @param String $string
     * @param String $replace
     * @return Translated expression
     */
    function translate_replace($string,$replace){
        $replacements = count($replace) -1;
        $string = $GLOBALS['lang']->msg($string);
        $trans = array();
        for($i = 0; $i <= $replacements; $i++){
            $trans['%' . ($i+1)] = $replace[$i];
        }
        return strtr($string, $trans);
    }

    /**
     * Builds a module and fetches the given template file
     *
     * @param String $tpl_file
     * @return Fetched content
     */
    function build($tpl_file){
        XT::assign("BUTTONS", $GLOBALS['plugin']->getButtons());
        @$GLOBALS['plugin']->buildExtensions();
        XT::assign("XT_ERROR_LOGS",$GLOBALS['logger']->getErrors());
        return $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . $tpl_file);
    }

    /**
     * Get all defined buttons for this admin module
     */
    function getButtons($set = "default", $assignment = "BUTTONS"){
        XT::assign($assignment, $GLOBALS['plugin']->getButtons($set));
    }

    /**
     * Builds a contribution and returns their content
     *
     * @param String $tpl_file
     * @return Fetched contribution content
     */
    function buildContribution($tpl_file){
        return $GLOBALS['tpl']->fetch($GLOBALS['tpl']->template_dir . $GLOBALS['plugin']->contributingPackage . "/includes/contributions/" . $tpl_file);
    }


    /**
     * Performs a database query
     *
     * @param String $sql
     * @param String $file
     * @param String $line
     * @param boolean $debug
     * @return Resultset
     */
    function query($sql, $file = '', $line = '', $debug = false){
        if($debug){
            // TODO: Should be a fetched template not echo's
            echo $sql;
        }
        $result = $GLOBALS['db']->Execute($sql);
        if(!$result){
            // TODO: Should be a fetched template not echo's
            $msg = $GLOBALS['db']->ErrorMsg() . "<br><br>";
            $msg .=  $sql . "<br><br>";
            $msg .= 'In File: <span style="color:red;">' .$file . '</span><br />On Line: <span style="color:red;">' . $line . '</span>';
            echo $msg;
            // $GLOBALS['logger']->reportError("SQL ERROR",$msg);
        }
        return $result;
    }



    /**
     * returns the number of affected rows from the last insert, update, delete query (returns 0 if no data changed in update)
     *
     * @return Affected rows count
     */
    function queryRowsAffected(){
        return $GLOBALS['db']->Affected_Rows();
    }

    /**
     * Get the active user's group memberships
     *
     * @return Array with group ID's
     */
    function getGroups(){
        if(@$_SESSION['user']['groups']){
            return @$_SESSION['user']['groups'];
        } else {
            return array();
        }
    }

    /**
     * Get the active user's role memberships
     *
     * @return Array with role ID's
     */
    function getRoles(){
        if(@$_SESSION['user']['roles']){
            return @$_SESSION['user']['roles'];
        } else {
            return array();
        }
    }

    /**
     * Get permission for a given permission set
     *
     * @param String $perm
     * @return True = Allowed / False = Denied
     */
    function getPermission($perm){
        if(!is_array(@$_SESSION['user']['groups'])){
            $_SESSION['user']['groups'] = array();
        }
        if(in_array(1,@$_SESSION['user']['groups']) || XT::getUserID() == 1){
            return true;
        }
        return $GLOBALS['perm']->getPermission($perm);
    }

    /**
     * Get permission for a given single node
     *
     * @param int $node_id
     * @param String $perm
     * @return True = Allowed / False = Denied
     */
    function getSingleNodePermission($node_id, $perm){
        if(array_key_exists('plugin', $GLOBALS) && is_object($GLOBALS['plugin'])){
            $perm = $GLOBALS['plugin']->getPermissionID($perm);
            $lang = $GLOBALS['plugin']->getActiveLang();
            $base_id = $GLOBALS['plugin']->getBaseID();
        } else {
            $lang = $GLOBALS['lang']->getLang();
            $base_id = 60; // TODO: Dynamically assign this base_id (Base ID from the site structure
        }
        return $GLOBALS['perm']->getNodePerm($node_id, $perm, $base_id, $lang);
    }


    function setTreeWay($way){
        if(is_array($way)){
            $GLOBALS['plugin']->_tree_way = $way;
        }
    }


    /**
     * Get permission for a given node (with inheritance)
     *
     * @param int $node_id
     * @param String $perm
     * @param int $node_pid The given node's parent ID
     * @param boolean $use_plugin_perms
     * @return True = Allowed / False = Denied
     */
    function getNodePermission($node_id, $perm, $node_pid, $use_plugin_perms = false){

        if(!is_array(@$_SESSION['user']['groups'])){
            $_SESSION['user']['groups'] = array();
        }
        if(in_array(1,@$_SESSION['user']['groups']) || XT::getUserID() == 1){
            return true;
        }


        // Check if this node has set permissions
        if(XT::getSingleNodePermission($node_id, $perm) != NULL){
            if(XT::getSingleNodePermission($node_id, $perm) == 0){
                return false;
            } else {
                return true;
            }
        } else {
            $way = array();
            // Walk through the way to check parent permissions
            if(!$use_plugin_perms){
                $way = $GLOBALS['application']->getWay();
            } else {
                $way = $GLOBALS['plugin']->getTreeWay();
            }
            $keys = array_keys($way, $node_pid);

            if(count($keys) > 0){
                for($i = $keys[0]; $i >= 0; $i--){
                    if(XT::getSingleNodePermission($way[$i], $perm) != NULL){
                        if(XT::getSingleNodePermission($way[$i], $perm) == 0){
                            return false;
                        } else {
                            return true;
                        }
                    }
                    if(!isset($way[$i])){
                        break;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Get available permission sets for a given base ID
     *
     * @param int $base_id
     * @return Array with Permission Set's
     */
    function getPermissions($base_id = ''){
        if(!is_array(@$_SESSION['user']['groups'])){
            $_SESSION['user']['groups'] = array();
        }
        if(in_array(1,@$_SESSION['user']['groups']) || XT::getUserID() == 1){
            return true;
        }
        if($base_id != ''){
            return $GLOBALS['plugins'][$base_id]->getPermissions();
        } else {
            return $GLOBALS['plugin']->getPermissions();
        }
    }

    /**
     * Check if a given bit is set in a given value
     *
     * @param int $value
     * @param int $bit
     * @return True = Bit is set (1) / False = Bit is not set (0)
     */
    function getBit($value, $bit){
        return $GLOBALS['perm']->getPerm($value, $bit);
    }

    /**
     * Get permission for a given action
     *
     * @param String $action
     * @return True = Allowed / False = Denied
     */
    function getActionPermission($action){
        if(!is_array(@$_SESSION['user']['groups'])){
            $_SESSION['user']['groups'] = array();
        }

        if(in_array(1,@$_SESSION['user']['groups']) || XT::getUserID() == 1){
            return true;
        }

        return $GLOBALS['perm']->getPermissionByID($GLOBALS['plugin']->getActionPermission($action));
    }

    /**
     * Adds a button in the administration
     *
     * @deprecated Use addImageButton instead
     */
    function addButton($label, $action, $set="default", $accesskey = ""){
        $GLOBALS['plugin']->addButton($label, $action,$set, $accesskey);
    }

    /**
     * Adds an button in the administration
     *
     * @param String $label Label that should be displayed near icon
     * @param String $action Action that should be called when pressed
     * @param String $set Button set (Default is "default")
     * @param String $icon Icon
     * @param String $form Target frame's form
     * @param String $target Target frame
     * @param String $accesskey Accesskey for this button
     * @param String $focus
     * @param String $script
     */
    function addImageButton($label, $action, $set="default", $icon, $form="", $target="", $accesskey ="", $focus="", $script=""){
        $GLOBALS['plugin']->addImageButton($label, $action, $set, $icon, $form, $target, $accesskey, $focus, $script);
    }

    /**
     * Gets a database table's real name (with prefix)
     *
     * @param String $table
     * @return Table's real name
     */
    function getTable($table){
        return $GLOBALS['plugin']->getTable($table);
    }

    /**
     * Enable a character filter for an administration table
     *
     * @param String $field Filtered field
     */
    function enableAdminCharFilter($field){
        $GLOBALS['plugin']->enableCharFilter($field);
    }

    /**
     * Enable a page navigator for an administration table
     *
     * @param String $table Table to navigate
     * @param String $field ID Field (Default is = "id")
     * @param String $sql Customized query to get entry count (Entry count field must be called count_id)
     */
    function enableAdminNavigator($table, $field = 'id', $sql = ''){
        $GLOBALS['plugin']->enableNavigator($table, $field, $sql);
    }

    /**
     * Enable a page navigator for a live table
     *
     * @see enableAdminNavigator
     */
    function enableLiveNavigator($table, $field = 'id', $sql = ''){
        $GLOBALS['plugin']->enableNavigator($table, $field, $sql);
    }

    /**
     * Get data of a result set (simplified)
     *
     * @param object $result
     * @return Data array
     */
    function getQueryData($result,$key=null){
        $data = array();
        if(is_null($key)){
            while($row = $result->FetchRow()){
                $data[] = $row;
            }
        }else {
            while($row = $result->FetchRow()){
                $data[$row[$key]] = $row;
            }
        }
        return $data;
    }

    /**
     * Get fieldvalue of a result (count)
     *
     * @param object $result
     * @return Data array
     */
    function getCountQuery($result,$key){
        $data = array();
        $row = $result->FetchRow();
        return $row[$key];
    }

    /**
     * Gets query addition for the administration character filter
     *
     * @param String $mode Default is = "WHERE" (Possible is also "AND")
     * @see enableAdminCharFilter
     * @return Query addition
     */
    function getAdminCharFilter($mode = 'WHERE'){
        return $GLOBALS['plugin']->getCharFilter($mode);
    }

    /**
     * Gets the query addition for the administration navigator
     *
     * @see enableAdminNavigator
     * @return Query (LIMIT) Addition (e.g. 0,30)
     */
    function getAdminNavigatorLimit(){
        return $GLOBALS['plugin']->getLimiter();
    }

    /**
     * Gets the query addition for the live navigator
     *
     * @see enableLiveNavigator
     * @return Query (LIMIT) Addition (e.g. 0,30)
     */
    function getLiveNavigatorLimit(){
        return $GLOBALS['plugin']->getLimiter();
    }

    /**
     * Checks if the active user is logged in
     *
     * @return True = Logged in / False = Not logged in
     */
    function isLoggedIn(){
        return $GLOBALS['auth']->isAuth();
    }

    /**
     * Log an event
     *
     * @param String $msg Additional log description
     * @param String $file __FILE__
     * @param String $line __LINE__
     * @param int $severity Log level (XT_ERROR | XT_WARNING | XT_INFO)
     * @param int $content_type Content type of the element according to this log message
     * @param int $content_id Content id of the element according to this log message
     * @param String $content_action (add|edit|delete|move|copy|activate|deactivate|lock|unlock|publish)
     */
    function log($msg, $file, $line, $severity, $content_type = 0, $content_id = 0, $content_action = ''){
        $GLOBALS['logger']->add($msg, $file, $line, $severity, $content_type, $content_id, $content_action);
    }

    /**
     * Check if there were errors in the current system call
     *
     * @return True = There were errors / False = No errors
     */
    function hasErrors(){
        if($GLOBALS['logger']->getErrors() == array()){
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the ID of the active or the given user (by name)
     *
     * @param String $username
     * @return User ID
     */
    function getUserID($username = ''){
        if($username == ''){
            return $GLOBALS['auth']->getUserId();
        }
        return $GLOBALS['usr']->getUserId($username);
    }

    /**
     * Get the name of the active or the given user (by id)
     *
     * @param int $userid
     * @return Name of the user
     */
    function getUserName($userid = ''){
        if($userid == ''){
            return $GLOBALS['auth']->getUsername();
        }else{
            return $GLOBALS['usr']->getUsername($userid);
        }

    }

    /**
     * Validate an email address
     *
     * @param String $email
     * @return True = Valid address / False = Invalid address
     */
    function checkEmail($email){
        if (!ereg("^[a-zA-Z0-9_\.-]+@[a-zA-Z0-9\.-]+\.[a-zA-Z]{2,4}$",$email)) {
            return false;
        }else{
            return true;
        }
    }

    /**
     * Prints a given array (Formatted with <pre></pre>)
     *
     * @param Array $array
     */
    function printArray($array,$return = false){
        if($return){
            return "<pre>" . print_r($array,1) . "</pre>";
        }else{
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }
    }

    /**
     * Prints a given String with a line break
     *
     * @param String $line
     */
    function printLine($line){
        echo $line . "<br>";
    }

    /**
     * Get allowed functions for a given base id
     *
     * @param int $base_id
     * @return Array with allowed functions (permission sets)
     */
    function getAllowedFunctions($base_id = ''){
        if($base_id != ''){
            return $GLOBALS['plugins'][$base_id]->getAllowedFunctions();
        } else {
            return $GLOBALS['plugin']->getAllowedFunctions();
        }
    }

    /**
     * Get denied functions for a given base id
     *
     * @param int $base_id
     * @return Array with denied functions (permission sets)
     */
    function getDeniedFunctions($base_id = ''){
        if($base_id != ''){
            return $GLOBALS['plugins'][$base_id]->getDeniedFunctions();
        } else {
            return $GLOBALS['plugin']->getDeniedFunctions();
        }
    }

    /**
     * Get the current page ID
     *
     * @deprecated Use getPageID() instead
     * @see getPageID
     * @return Current Page (Template) ID
     */
    function getTemplateID(){
        return $GLOBALS['tpl_id'];
    }

    /**
     * Get the current page ID
     *
     * @return Current Page (Template) ID
     */
    function getPageID(){
        return $GLOBALS['tpl_id'];
    }

    /**
     * Get current language
     *
     * @return Language code (e.g 'de' or 'en')
     */
    function getLang(){
        return $GLOBALS['lang']->getLang();
    }

    /**
     * Get current language for the active plugin
     *
     * @return Language code (e.g 'de' or 'en')
     */
    function getPluginLang(){
        return $GLOBALS['plugin']->getActiveLang();
    }

    /**
     * Load the extended configuration for a given file
     *
     * @param String $filename
     */
    function getExtendedConfig($filename){
        $p = array_slice(explode(".",basename($filename)), 1, -3);;
        foreach ($p as $part){$incfile .=$part . ".";}
        include(PLUGIN_DIR . substr($incfile,0, -1) . "/includes/config.ext.inc.php");
    }

    /**
     * Load a system class
     *
     * This function is needed because of the license which is required by some classes
     * Usage:
     * XT::loadClass('searchindex.class.php','ch.iframe.snode.search');
     *
     * @param String $classname
     * @param String $packagename
     */
    function loadClass($classname, $packagename = ''){
        if ($packagename == '') {
            $packagename = $GLOBALS['plugin']->getPackage();
        }
        // preload license
        if(function_exists("zend_loader_install_license")){
            @zend_loader_install_license(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . "_" . $packagename . ".zl",1);
        }
        require_once(CLASS_DIR . $classname);
    }

    /**
     * Contribute functionality to the active plugin
     *
     * @param String $filename Contribution file
     */
    function contribute($filename){
        $p = explode(".",basename($filename));
        $file = $p[0] ."." . implode(".",array_slice($p,-3));
        $p = array_slice($p, 1, -3);
        $GLOBALS['plugin']->contributingPackage = implode(".",$p);

        // preload license
        if(function_exists("zend_loader_install_license")){
            @zend_loader_install_license(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . "_" . implode(".",$p) . ".zl",1);
        }

        include(PLUGIN_DIR . implode(".",$p) . "/includes/contributions/"  . $file);
    }

    /**
     * Contribute an action to the active plugin
     *
     * @param String $filename Contribution action file
     */
    function contributeAction($filename){
        $p = explode(".",basename($filename));
        $file = $p[0] ."." . implode(".",array_slice($p,-3));
        $p = array_slice($p, 1, -3);
        $GLOBALS['plugin']->contributingPackage = implode(".",$p);

        // preload license
        if(function_exists("zend_loader_install_license")){
            @zend_loader_install_license(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . "_" . implode(".",$p) . ".zl",1);
        }

        include(PLUGIN_DIR . implode(".",$p) . "/includes/contributions/"  . $file);
    }

    /**
     * Get the way for a given node in a given tree
     *
     * @param String $table
     * @param int $active_id
     * @return Array with indexes "way" => With id's of the way & "in" => For usage directly in a query
     */
    function getTreeWay($table, $active_id){
        $result = XT::query("
            SELECT
                n1.id,
                COUNT(n1.id) AS level
            FROM
                " . $GLOBALS['plugin']->getTable($table) . " AS n1,
                " . $GLOBALS['plugin']->getTable($table) . " AS n2
            WHERE
                n2.id ='" . $active_id . "'
                AND n1.l <= n2.l
                AND n1.r >= n2.r
            GROUP BY
                n1.id
            ORDER BY
                n1.l
            ",__FILE__,__LINE__,0);

        $way = array();
        while ($row = $result->FetchRow()){
            $way[] = $row['id'];
        }

        $in = implode(',',$way);
        return array("way" => $way, "in" => $in);
    }

    /**
     * Get tree data
     *
     * @param String $table
     * @param String $table_details
     * @param Array $tree_way
     * @param int $active_id
     * @param String $detail_fields
     * @see getTreeWay
     * @return unknown
     */
    function getTreeData($table,$table_details,$tree_way,$active_id,$detail_fields = array()){

        if(sizeof($detail_fields) > 0){
            $detail_fields = "," . implode(',', $detail_fields);
        } else {
            $detail_fields = "";
        }

        $result = XT::query("
            SELECT
                main.id,
                main.pid,
                floor(( main.r - main.l) / 2) AS subs,
                main.level,
                main.l,
                main.r
                " . $detail_fields . "
            FROM
                " . $GLOBALS['plugin']->getTable($table) . " AS main LEFT JOIN
                " . $GLOBALS['plugin']->getTable($table_details) . " AS d ON (d.node_id = main.ID AND d.lang = '" . $GLOBALS['lang']->getLang() . "')
            WHERE
                main.pid in (" . $tree_way['in'] . ")
            GROUP BY
                main.l
            ORDER BY main.l
        ",__FILE__,__LINE__);

        $data = array();
        while ($row = $result->FetchRow()){
            $row['itw'] = in_array($row["id"], $tree_way['way']);
            $row['selected'] = $row['id'] == $active_id;
            $data[] = $row;
        }

        return $data;

    }

    /**
     * Get a tree completely with way and data
     *
     * @param String $table
     * @param String $table_details
     * @param String $detail_fields
     * @return Array with Data
     */
    function getTree($table,$table_details, $detail_fields){
        if(is_numeric($GLOBALS['plugin']->getValue("node_id"))){
            $GLOBALS['plugin']->setSessionValue("node_id", $GLOBALS['plugin']->getValue("node_id"));
        }
        $active_id = $GLOBALS['plugin']->getSessionValue("node_id") > 0 ? $GLOBALS['plugin']->getSessionValue("node_id") : 1;
        $tree_way = XT::getTreeWay($table,$active_id);
        return XT::getTreeData($table,$table_details,$tree_way,$active_id,$detail_fields);
    }

    /**
     * Check if a given style (template file) exists for the active plugin
     *
     * @param String $style (e.g. "default" for "default.tpl")
     * @return True = Style exists / False = Style doesn't exist
     */
    function styleIsAvailable($style){
        return is_file($GLOBALS['plugin']->tpl_location . $style . ".tpl");
    }

    function getValue($var,$baseid = 0){
        if($baseid > 0){
            return $GLOBALS['plugin']->getValue($var,0,$baseid);
        } else {
            return $GLOBALS['plugin']->getValue($var);
        }
    }

    /**
      * Get all values from a request as array
      * @return array Request values for a plugin
      */
    function getValues()
    {
        $baseid = $GLOBALS['plugin']->getBaseID();
        $vars = '';
        $pattern = 'x' . $baseid;
        $len = strlen($pattern);

        foreach ($_REQUEST as $key => $value) {
            if (substr($key, 0, $len) == $pattern) {
                $vars[substr($key, $len +1)] =  $value;
            }
        }

        return $vars;
    }
    /**
     * Gives back the parameter setted or the session value overwritten by post or get
     * If you set the param name_is_fixed only the Param value will be used. i.e. (id_is_fixed=true)
     * If you set the param name_no_session only the request value or the param  will be used. i.e. (id_no_session=true)
     * If you set the param modname you will generate an "instance" of the module resp. the autovalues of the module
     *
     * @param String $name (e.g. "id", "level")
     * @param String $main "R" (Request) is default, "r" (Request) or default, "P" for Parameter as dominant value, "S" for session as dominant value
     * @return value of param / session / or request
     */

    function autoval($name,$main = "R",$default=false,$nosession = false,$baseid = 0){

        $param = XT::getParam($name);
        $modname = XT::getParam("modname");
        if(!empty($modname)){
            $name .= "_" .  $modname;
        }
        
        $get = XT::getValue($name,$baseid);
        $sess = XT::getSessionValue($name);
		
        if (!empty($param) && ($main == "P" || $GLOBALS['plugin']->getParam($name . "_is_fixed"))){
            return $param;
        }else {
            if((!empty($get) && ($main =="R" || $main =="r" || $main =="P"))|| $nosession){
                if(!$GLOBALS['plugin']->getParam($name . "_no_session")){
                    XT::setSessionValue($name,$get);
                }
                return $get;
            }else {
                if($main == "S" || !empty($sess) && !$GLOBALS['plugin']->getParam($name . "_no_session") && $main != "r"){
                    return $sess;
                }else {
                    if (!empty($param) && $main != "r"){
                        return $param;
                    }else {
                        return $default;
                    }
                }
            }
        }
    }

    function setValue($var, $value){
        $GLOBALS['plugin']->setValue($var, $value);
    }

    function setParam($var, $value){
        $GLOBALS['plugin']->setParam($var, $value);
    }

    function setSessionValue($var, $value){
        $GLOBALS['plugin']->setSessionValue($var, $value);
    }

    function getSessionValue($var,$baesid=0){
        if($baesid > 0){
            return $GLOBALS['plugin']->getSessionValue($var,$baesid);
        }else{
            return $GLOBALS['plugin']->getSessionValue($var);
        }

    }

    function unsetSessionValue($var){
        $GLOBALS['plugin']->unsetSessionValue($var);
    }

    function setBaseID($baseid){
        $GLOBALS['plugin']->setBaseID($baseid);
    }

    function addConfig($var,$value){
        $GLOBALS['plugin']->addConfig($var,$value,'');
    }

    function getConfig($var){
        return $GLOBALS['plugin']->getConfig($var);
    }

    function addTable($table,$prefix = true){
        return $GLOBALS['plugin']->addTable($table,$table,'',false,$prefix);

    }

    function addTab($shortcut, $title, $file, $default, $visible){
        $GLOBALS['plugin']->addTab($shortcut,$title,$file,$default,$visible);
    }

    function enablePermissions(){
        $GLOBALS['plugin']->enablePermissions();
    }

    function setAdminModule($mod){
        $GLOBALS['plugin']->setAdminModule($mod);
    }

    function call($action){
        $GLOBALS['plugin']->call($action);
    }

    function getParam($param){
        return $GLOBALS['plugin']->getParam($param);
    }

    function addContentType($id, $title){
        return $GLOBALS['plugin']->addContentType($id, $title);
    }

    function checkDomain($lic_info){
        if($lic_info['Domain'] != ''){

            $domain_parts = split('\.',$_SERVER['HTTP_HOST']);
            $domain_parts = array_reverse($domain_parts);
            $domainname = $domain_parts[1] . '.' . $domain_parts[0];
            $lic_domain_parts = split('\.',$lic_info['Domain']);
            $lic_domain_parts = array_reverse($lic_domain_parts);
            $lic_domainname = $lic_domain_parts[1] . '.' . $lic_domain_parts[0];
            if($domainname != $lic_domainname && $domainname != '.localhost' && $domainname != '127.0.0.1'){
                die('Ihre S-Node XT Lizenz ist nicht f&uuml;r diese Domain (' . $domainname . ') registriert, sondern f&uuml;r ' . $lic_domainname . '');
            }

        }
    }


    /**
     * Get database prefix
     *
     * @return String
     */
    function getDatabasePrefix(){
        return $GLOBALS['cfg']->get("database","prefix");
    }

    /**
     * Get a content type for a given title
     *
     * @param String $title
     * @return Content ID
     */
    function getContentType($title){
        return $GLOBALS['plugin']->getContentType($title);
    }

    /**
     * Get the current plugin's base ID
     *
     * @return int The base id of the plugin or 0 if the plugin instance not exists
     */
    function getBaseID(){

        if ($GLOBALS['plugin'] != "") {
            return $GLOBALS['plugin']->getBaseID();
        } else {
            return 0;
        }
    }

    /**
     * Add your own title to the document title
     *
     * @param String $title
     * @param String $separator
     */
    function addToTitle($title, $separator = ', '){
        if($title != ''){
            $GLOBALS['pagetitle'] .= $separator . $title;
        }
    }

    /**
     * Add your own description to the meta description
     *
     * @param String $description
     * @param String $separator
     */
    function addToDescription($description, $separator = ', '){
        $GLOBALS['pagedescription'] .= $separator . $description;
    }

    /**
     * Add your own keywords to the meta keywords
     *
     * @param String $keywords
     * @param String $separator
     */
    function addToKeywords($keywords, $separator = ', '){
        $GLOBALS['pagekeywords'] .= $separator . $keywords;
    }

    /**
     * Overwrite document title
     *
     * @param String $title
     */
    function setTitle($title){
        $GLOBALS['pagetitle'] = $title;
    }

    /**
     * Overwrite meta description
     *
     * @param String $description
     */
    function setDescription($description){
        $GLOBALS['pagedescription'] = $description;
    }

    /**
     * Overwrite meta keywords
     *
     * @param String $keywords
     */
    function setKeywords($keywords){
        $GLOBALS['pagekeywords'] = $keywords;
    }

    /**
     * Add a content element to the current content stack
     *
     * @param int $content_type Content Type
     * @param int $id Content ID
     * @param String $title Content Title
     */
    function addToContentStack($content_type,$id,$title = ''){
        if($id > 0){
            if(!@array_key_exists($content_type, $GLOBALS['pagecontents'])){
                $GLOBALS['pagecontents'][$content_type] = array();
            }
            $GLOBALS['pagecontents'][$content_type][$id] = $title;
        }
    }

    /**
     * Replaces xml entities
     *
     * @param string $data
     * @return string Escaped data
     */
    function replaceXMLEntities($data){
        $position = 0;
        $length = strlen($data);
        $escapeddata = "";
        for(;$position<$length;) {
            $character = substr($data, $position, 1);
            $code = Ord($character);
            switch($code) {
                case 34:
                    $character = '"';
                    break;

                case 38:
                    $character = "&";
                    break;

                case 39:
                    $character = "'";
                    break;

                case 60:
                    $character = "<";
                    break;

                case 62:
                    $character = ">";
                    break;

                default:
                    if ($code<32)
                    $character = ("&#".strval($code).";");
                    break;
            }
            $escapeddata .= $character;
            $position++;
        }
        return $escapeddata;
    }

    /**
     * Prints all post values
     */
    function printPostValues()
    {
        $baseid = XT::getBaseID();
        $vars = '';
        $pattern = 'x' . $baseid;
        $len = strlen($pattern);

        foreach ($_POST as $key => $value) {
            if (substr($key, 0, $len) == $pattern) {
                $vars .= '<b>' . substr($key, $len +1) . '</b>: ' . $spacer . $value . '<br />';
            }
        }

        echo $vars;
    }

    /**
     * Prints all get values
     */
    function printGetValues()
    {
        $baseid = XT::getBaseID();
        $vars = '';
        $pattern = 'x' . $baseid;
        $len = strlen($pattern);

        foreach ($_GET as $key => $value) {
            if (substr($key, 0, $len) == $pattern) {
                $vars .= '<b>' . substr($key, $len +1) . '</b>: ' . $spacer . $value . '<br />';
            }
        }

        echo $vars;
    }

    /**
     * Prints all Session values
     */
    function printSessionValues()
    {
        $baseid = XT::getBaseID();
        $vars = '';
        $pattern = 'x' . $baseid;
        $len = strlen($pattern);

        foreach ($_SESSION as $key => $value) {
            if (substr($key, 0, $len) == $pattern) {
                $vars .= '<b>' . substr($key, $len +1) . '</b>: ' . $spacer . $value . '<br />';
            }
        }

        echo $vars;
    }

    function errormessages($tplvar="ERRORMSG"){
        // Show error messages
        if(isset($GLOBALS['logger']) && sizeof($GLOBALS['logger']->getErrors()) > 0){
            $GLOBALS['tpl']->assign("ERRORS", $GLOBALS['logger']->getErrors());
            XT::assign($tplvar,$GLOBALS['tpl']->fetch('includes/msg.tpl'));
        }
    }

    // returns an array with startpoint (0) and endpoint(1) for a given "day,week, month or year";

    function getDateRange($date,$range="day"){
        switch ($range) {
            case "day":
                $datearr[0]= mktime(0,0,0,date("m",$date),date("d",$date),date("Y",$date));
                $datearr[1]= mktime(0,0,0,date("m",$date),date("d",$date) +1,date("Y",$date));
                break;
            case "week":
                $datearr[0] = mktime(0,0,0,1,(date("W",$date)*7)-5,date("Y",$date));
                $datearr[1] = mktime(23,59,59,1,(date("W",$date)*7)+1,date("Y",$date));
                break;
            case "month":
                $datearr[0] = mktime(0,0,0,date("m",$date),1,date("Y",$date));
                $datearr[1] = mktime(23,59,59,date("m",$date)+1,0,date("Y",$date));
                break;
            case "year":
                $datearr[0] = mktime(0,0,0,1,1,date("Y",$date));
                $datearr[1] = mktime(0,0,0,13,1,date("Y",$date));
                break;
        }
        return $datearr;
    }

    /**
     * Get the title of an entry by the content type
     * @param int $content_type Content Type of the requested entry
     * @param multi_int $content_id One or more ids for entries. If you use more than one entry, seperate it with commas i.e: 8,2,33
     * @param string $lang Requested language. The method checks if the language field "lang" exits in the source table. If it not exists, the lang option will be ignored.
     * @return mixed Return false, if no title found. Otherwise it returns the title or an array if you use multible content_id
     */

    function getTitleByContentType($content_type,$content_id, $lang = null) {

        if($content_type=="" || $content_id==""){
            return 0;
        }

        // werte aus content_types tabelle füllen (einmal pro session)
        if(!is_array($_SESSION['s-node']['content_types'])){
            $result = XT::query("
	            SELECT id as content_type,content_table,title_field,id_field FROM
	                " . XT::getDatabasePrefix() . "content_types",__FILE__,__LINE__);
            while ($row = $result->FetchRow()){
                $_SESSION['s-node']['content_types'][$row['content_type']]['table'] = $row['content_table'];
                $_SESSION['s-node']['content_types'][$row['content_type']]['title_field'] = $row['title_field'];
                $_SESSION['s-node']['content_types'][$row['content_type']]['id_field'] = $row['id_field'];
            }
        }
        if ($lang != "") {
            // Check if the lang field exists
            $result = XT::query("DESCRIBE " . XT::getDatabasePrefix() . $_SESSION['s-node']['content_types'][$content_type]['table'],__FILE__,__LINE__);
            $languageAvailable = false;
            while($row = $result->FetchRow()){
                if ($row['Field'] == "lang") {
                    $languageAvailable = true;
                }
            }
            // Add language where
            if ($languageAvailable == true) {
                $lang = " AND lang='" . $lang . "'";
            } else {
                $lang = "";
            }
        }

        // Build the select to get the title
        $sql = "SELECT " .
        $_SESSION['s-node']['content_types'][$content_type]['title_field']  . " as title, " .
        $_SESSION['s-node']['content_types'][$content_type]['id_field'] . " as id
        FROM " .  XT::getDatabasePrefix() . $_SESSION['s-node']['content_types'][$content_type]['table'] . "
        WHERE " .
        $_SESSION['s-node']['content_types'][$content_type]['id_field'] . " in ( " . $content_id . ") " . $lang;
        $result = XT::query($sql,__FILE__,__LINE__);
        $i = 0;
        while($row = $result->FetchRow()){
            $return[$row['id']] = $row['title'];
            $i++;
        }
        // Prepare the return value
        switch($i) {
            // Return false if no record found
            case 0:
                return false;
                break;
                // Return the name if one record found
            case 1:
                return $return[$content_id];
                break;
                // Return the whole array by multible content_types
            default:
                return $return;
                break;
        }

    }

    /**
      * Stop an action
      * @param string $message Error message
      */
    function actionStop($message,$fieldlabel="",$translate = true) {
        $GLOBALS['plugin']->actionStop($message,$fieldlabel,$translate);
    }

    function actionIsStopped(){
        return 	$GLOBALS['plugin']->actionIsStopped();
    }

    function getActionStopped($action = ""){
        return 	$GLOBALS['plugin']->getActionStopped($action);
    }
    
    /*
    * Get the active language of a plugin
    */
    function getActiveLang() {
        return $GLOBALS['plugin']->getActiveLang();
    }

    /**
	 * Get the propertie from a user
	 * @param  string property The database field
	 * @param  string userid The user id
	 * @return string the property from the database of a user
	 * Example: getUserProperties("firstName",$someid);
	 */
    function getUserProperties($property,$userid=""){
        if ($userid == "") {
            $userid = XT::getUserId();
        }
        if (is_array($_SESSION['userproperties'][$userid]) ) {
            return $_SESSION['userproperties'][$userid][$property];
        } else {
            $result = XT::query("SELECT * FROM " . $GLOBALS['cfg']->get("database","prefix") . "user as usr LEFT JOIN " . $GLOBALS['cfg']->get("database","prefix") . "addresses as addr on addr.user_id = usr.id AND addr.is_primary_user_address=1 WHERE usr.id = " . $userid,__FILE__,__LINE__);
            if ($_SESSION['userproperties'][$userid] = $result->FetchRow()){
                return $_SESSION['userproperties'][$userid][$property];
            } else {
                return false;
            }
        }
    }
    
    function loadJS($file){
        $GLOBALS['loadedscripts'][$file] = '<script type="text/javascript" src="' . SCRIPTS_DIR . $file . '"></script>';
    }
    
}


?>