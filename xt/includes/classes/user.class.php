<?php
/**
 * User class
 *
 * @package Core
 * @author Roger Dudler <rdudler@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: user.class.php 2344 2005-12-02 14:57:47Z vzaech $
 */
class XT_User {
    var $user_table = 'xt_user';

    function XT_User() {
        $this->user_table = $GLOBALS['cfg']->get("database","prefix") . "user";
    }
    function getUsername($id){
        if(is_numeric($id)){
            $result = XT::query("SELECT username FROM " . $this->user_table . " WHERE id = " . $id,__FILE__,__LINE__);
            $row = $result->FetchRow();
            return $row['username'];
        }
    }

    function getUserID($username){
        $result = XT::query("SELECT id FROM " . $this->user_table . " WHERE username = '" . $username . "'",__FILE__,__LINE__);
        while($row = $result->FetchRow()){
           return $row['id'];
        }
    }

    function getUserString($id){
        if(is_numeric($id) && $id != 0){
            $result = $GLOBALS['db']->query("SELECT username, firstName, lastName FROM " . $this->user_table . " WHERE id = " . $id,__FILE__,__LINE__);
            while($row = $result->FetchRow()){
                return $row['firstName'] . " " . $row['lastName'] . " (" . $row['username'] . ")";
            }
        }
    }

    function formatLongDate($date){
        return date($_SESSION['user']['date_long'],$date);
    }

    function userexist($username){
        $result = $GLOBALS['db']->query("SELECT id FROM " . $this->user_table . " WHERE username = '" . $username . "'",__FILE__,__LINE__);
        $id = $result->FetchRow();
        if($id){
            return true;
        }else{
            return false;
        }
    }
}
?>