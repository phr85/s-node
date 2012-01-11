<?php
/**
 * Permission handling class
 *
 * @package Core
 * @author Roger Dudler <rdudler@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: perm.class.php 6099 2009-10-28 11:03:34Z dzogg $
 */
class XT_Perm {

    /**
     * holds all the permissions for this user
     */
    var $_perms = array();
    var $_node_perms = array();

    /**
     * gets all the permission for logged in user
     */
    function XT_Perm(){
        if(!isset($_SESSION['user']['perms'])){
            if(is_array(XT::getGroups()) && is_array(XT::getRoles())){
                // Get permissions for visible nodes
                $groups = implode(',', XT::getGroups());
                $roles = implode(',', XT::getRoles());

            }
            if($groups == ''){
                $groups = '0';
            }
            if($roles == ''){
                $roles = '0';
            }
            // Get plugin permissions
            $result = XT::query("SELECT perms, base_id, principal_type, lang FROM " . $GLOBALS['cfg']->get("database","prefix") . "perms
            WHERE
                (
                    (principal_id = '" . XT::getUserID() . "' AND principal_type = 1)
                OR
                    (principal_id IN (" . $groups . ") AND principal_type = 2)
                OR
                    (principal_id IN (" . $roles . ") AND principal_type = 3)
                )
            ",__FILE__,__LINE__);
            while($row = $result->FetchRow()){
                if(isset($this->_perms[$row['lang']][$row['base_id']])){
                    $this->_perms[$row['lang']][$row['base_id']] = $this->_perms[$row['lang']][$row['base_id']] | intval($row['perms']);
                }else{
                    $this->_perms[$row['lang']][$row['base_id']] = intval($row['perms']);
                }
            }
            $_SESSION['user']['perms'] = $this->_perms;
        }

        if(!isset($_SESSION['user']['node_perms'])){

            if(is_array(XT::getGroups()) && is_array(XT::getRoles())){

                // Get permissions for visible nodes
                $groups = implode(',', XT::getGroups());
                $roles = implode(',', XT::getRoles());

            }
            if($groups == ''){
                $groups = '0';
            }
            if($roles == ''){
                $roles = '0';
            }

            // Get node permissions
            $result = XT::query("
            SELECT
                perms,
                base_id,
                node_id,
                lang
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "node_perms
            WHERE
                (
                    (principal_id = '" . XT::getUserID() . "' AND principal_type = 1)
                OR
                    (principal_id IN (" . $groups . ") AND principal_type = 2)
                OR
                    (principal_id IN (" . $roles . ") AND principal_type = 3)
                )
            ",__FILE__,__LINE__,0);

            $this->_node_perms = array();
            if($result){
                while($row = $result->FetchRow()){
                    if(!isset($this->_node_perms[$row['lang']][$row['base_id']][$row["node_id"]])){
                        $this->_node_perms[$row['lang']][$row['base_id']][$row["node_id"]] = 0;
                    }
                    $this->_node_perms[$row['lang']][$row['base_id']][$row["node_id"]] |= $row["perms"];
                }
            }

            $_SESSION['user']['node_perms'] = $this->_node_perms;

        }
        $this->_perms = &$_SESSION['user']['perms'];
        $this->_node_perms = &$_SESSION['user']['node_perms'];
    }

    /**
     * Get permissions for a given permission set name
     *
     * @param $perm Permission set e.g. "edit" or "addPages" as defined in the plugin
     * @return 1 User is allowed to do all actions who are defined in this permission set
     * @return 0 User is not allowed to do all actions who are defined in this permission set
     */
    function getPermission($perm,$base_id = ''){
        if($base_id != ''){
            return $this->getperm($this->_perms[$GLOBALS['plugin']->getActiveLang()][$base_id],$GLOBALS['plugin']->getPermissionID($perm));
        }else{
            return $this->getperm($this->_perms[$GLOBALS['plugin']->getActiveLang()][$GLOBALS['plugin']->getBaseID()],$GLOBALS['plugin']->getPermissionID($perm));
        }
    }

    /**
     * Get permissions for a given permission set id
     * @param $perm_id Permission set id as defined in the plugin
     * @return 1 User is allowed to do all actions who are defined in this permission set
     * @return 0 User is not allowed to do all actions who are defined in this permission set
     */
    function getPermissionByID($perm_id,$base_id = ''){
        if($base_id != ''){
            return $this->getperm($this->_perms[$GLOBALS['plugin']->getActiveLang()][$base_id],$perm_id);
        }else{
            return $this->getperm($this->_perms[$GLOBALS['plugin']->getActiveLang()][$GLOBALS['plugin']->getBaseID()],$perm_id);
        }
    }

    /**
     * Set a given bit in a given value
     *
     * @return int the new calculated value
     */
    function addperm($val, $bit) {
        if ($this->getperm($val, $bit)) return $val;
        return $val += '0x'.dechex(1<<($bit-1));
    }

    /**
     * Checks if a given bit is set in a given value
     *
     * @return 0 the bit is not set
     * @return 1 the bit is set
     */
    function getperm($val, $bit) {
        return ($val&(0+('0x'.dechex(1<<($bit-1)))))?'1':'0';
    }

    /**
     * Removes a given bit from a given value
     *
     * @return int the new calculated value
     */
    function removeperm($val, $bit) {
        if (!$this->getperm($val, $bit)) return $val;
        return $val^(0+('0x'.dechex(1<<($bit-1))));
    }

    /**
     * Get template node perm
     */
    function getNodePerm($node_id, $perm, $base_id, $lang){
        if(!isset($this->_node_perms[$lang][$base_id][$node_id])){
            return null;
        }
        return $GLOBALS['perm']->getPerm($this->_node_perms[$lang][$base_id][$node_id],$perm);
    }
}
?>