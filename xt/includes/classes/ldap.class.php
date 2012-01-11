<?php
class XT_LDAP {
    
    var $_connection;
    var $_bind;
    var $_host = "localhost";
    var $_port = 389;
    
    function connect($host = "localhost", $port = 389){
        
        $this->_host = $host;
        $this->_port = $port;
        $this->_connection = ldap_connect($this->_host, $this->_port);
        
        // Windows 2003 Server Active Directory fix
        ldap_set_option($this->_connection, LDAP_OPT_REFERRALS, 0);
        
    }
    
    function search($search){
        $sr = ldap_search($this->_connection,"dc=test,dc=iframe,dc=ch", $search);
        $entries = ldap_get_entries($this->_connection, $sr);
        return $entries;
    }
    
    function bind($user = "", $password = ""){
        if($user == "" && $password == ""){
            return $this->_bind = ldap_bind($this->_connection);
        } else {
            return $this->_bind = ldap_bind($this->_connection, $user, $password);
        }
    }
    
    function close(){
        ldap_close($this->_connection);
    }
    
    /**
     * $info["cn"]="Roger Dudler";
     * $info["sn"]="Dudler";
     * $info["mail"]="rdudler@iframe.ch";
     * $info["objectclass"]="person";
     */
    function add($info){
        $r = ldap_add($this->_connection, "cn=" . $info["cn"] . ",dc=test,dc=iframe,dc=ch", $info);
    }
}

?>