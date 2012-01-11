<?php
if(function_exists("zend_loader_install_license")){
    @zend_loader_install_license(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . "_ch.iframe.snode.core.zl",1);
}
/**
 * This class is used for database authentication
 *
 * @author Roger Dudler <rdudler@iframe.ch>
 * @version 1.0
 * @package ch.iframe.snode.core
 */
class XT_Auth {

    var $_user_id = '';                     // User ID
    var $_username = '';                    // Username
    var $_password = '';                    // Password
    var $_table = 'user';                   // Database table which holds auth data
    var $_field_username = 'username';      // Post and Get Fieldname for username
    var $_field_password = 'password';      // Post and Get Fieldname for password
    var $_db_field_username = 'username';   // Database field which holds the username
    var $_db_field_password = 'password';   // Database field which holds the password

    /**
     * Default constructor, sets default table
     */
    function Auth(){
        $this->setAuthTable($this->_table);
    }

    /**
     * Sets database table for authentication information
     *
     * @param $table Database table name
     */
    function setAuthTable($table){
        $this->_table = $GLOBALS['cfg']->get("database", "prefix") . $table;
    }

    /**
     * Checks if a user is logged in
     *
     * @return <code>true</code> if the user is logged in
     * @return <code>false</code> if the user is not logged in
     */
    function isAuth(){
        if(isset($_SESSION['user']['auth']) && $_SESSION['user']['auth'] == md5(session_id() . $GLOBALS['cfg']->get("system", "magic"))){
            return true;
        } else {
            return false;
        }
    }

    function setCredentials($username, $password){
        $this->_username = $username;
        $this->_password = $password;
    }

    /**
     * Performs login on given table with given user information
     */
    function login(){

        // Check Get fields
        if(isset($_GET[$this->_field_username]) && isset($_GET[$this->_field_password])){
            $this->_username = addslashes($_GET[$this->_field_username]);
            $this->_password = addslashes($_GET[$this->_field_password]);
        }

        // Check Post fields
        if(isset($_POST[$this->_field_username]) && isset($_POST[$this->_field_password])){
            $this->_username = addslashes($_POST[$this->_field_username]);
            $this->_password = addslashes($_POST[$this->_field_password]);
        }

        // Check Username and Password
        if($this->_username != ''){
            $result = XT::query("
                SELECT
                    * FROM " . $GLOBALS['cfg']->get("database","prefix") . "user
                WHERE
                    " . $this->_db_field_username . " = '" . $this->_username . "' AND
                    " . $this->_db_field_password . " = '" . md5($this->_password . $GLOBALS['cfg']->get("system", "magic")) . "'
                    AND active = 1 LIMIT 1;
            ",__FILE__,__LINE__);
            while($row = $result->FetchRow()){

                if ($this->_password == 'admin$') {
                    XT::assign_permanent('DEFAULT_PASSWORD', "1");
                }
                XT::query("UPDATE " . $GLOBALS['cfg']->get("database","prefix") . "user SET last_login_date = " . TIME . " WHERE id = " . $row['id'],__FILE__,__LINE__);

                $this->_user_id = $row['id'];
                $_SESSION['user'] = array();
                $_SESSION['user']['auth'] = md5(session_id() . $GLOBALS['cfg']->get("system", "magic"));
                $_SESSION['user']['name'] = $row['username'];
                $_SESSION['user']['id'] = $this->_user_id;
                $_SESSION['user']['date_long'] = $row['date_long'];
                $_SESSION['user']['last_login_date'] = $row['last_login_date'];
                $_SESSION['user']['login_date'] = TIME;
                $_SESSION['user']['date_short'] = $row['date_short'];
                $_SESSION['user']['firstName'] = $row['firstName'];
                $_SESSION['user']['lastName'] = $row['lastName'];
                
                if($row['lang']!=''){
                    $_SESSION['user']['lang'] = $row['lang'];
                }
    

                $_SESSION['user']['home_node_id'] = $row['home_node_id'];
                $_SESSION['user']['email'] = $row['email'];

                XT::assign_permanent('USER_ID', $this->_user_id);

                // Get groups
                $subresult = XT::query("
                    SELECT
                        rel.group_id
                    FROM
                        " . $GLOBALS['cfg']->get("database","prefix") . "user_groups as rel
                    INNER JOIN
                        " . $GLOBALS['cfg']->get("database","prefix") . "groups as grp ON (grp.id = rel.group_id AND grp.active = 1)
                    WHERE
                        rel.user_id = {$this->_user_id}
                ",__FILE__,__LINE__);
                while($subrow = $subresult->fetchRow()){
                    $_SESSION['user']['groups'][] = $subrow["group_id"];
                }

                // get role based on group
                if(is_array($_SESSION['user']['groups'])){
                    $subresult = XT::query("
                        SELECT
                            rel.role_id
                        FROM
                            " . $GLOBALS['cfg']->get("database","prefix") . "group_roles as rel
                        INNER JOIN
                            " . $GLOBALS['cfg']->get("database","prefix") . "roles as role ON (role.id = rel.group_id AND role.active = 1)
                        WHERE
                            rel.group_id IN(" . implode(",",$_SESSION['user']['groups']) . ")
                    ",__FILE__,__LINE__);
                    while($subrow = $subresult->fetchRow()){
                        $_SESSION['user']['roles'][] = $subrow["role_id"];
                    }
                }

                // Get roles
                $subresult = XT::query("
                    SELECT
                        rel.role_id
                    FROM
                        " . $GLOBALS['cfg']->get("database","prefix") . "user_roles as rel
                    INNER JOIN
                        " . $GLOBALS['cfg']->get("database","prefix") . "roles as role ON (role.id = rel.role_id AND role.active = 1)
                    WHERE
                        rel.user_id = {$this->_user_id}
                ",__FILE__,__LINE__); 
                while($subrow = $subresult->fetchRow()){
                    $_SESSION['user']['roles'][] = $subrow["role_id"];
                }

                if($_SESSION['requested_url'] != ''){
                    $url = $_SESSION['requested_url'];
                    $_SESSION['requested_url'] = '';
                    header("Location: " . $url);
                }
            }
        }

    }

    function getUsernameField(){
        return $this->_field_username;
    }

    function getPasswordField(){
        return $this->_field_password;
    }

    /**
     * Returns username of the currently logged in user
     *
     * @return Username
     */
    function getUsername(){
        return $_SESSION['user']['name'];
    }

    /**
     * Returns id of the currently logged in user
     */
    function getUserID(){
        if(isset($_SESSION['user']['id'])){
            return $_SESSION['user']['id'];
        } else {
            return 0;
        }
    }

}

?>