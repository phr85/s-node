<?php
class XT_Nodeperms {
    
    var $_table = "";
    var $_user_table = "";
    var $_group_ass_table = "";
    var $_role_ass_table = "";
    
    function XT_Nodeperms($table){
        $this->_table = $GLOBALS['plugin']->getTable($table);
        $this->_group_ass_table = $GLOBALS['cfg']->get("database","prefix") . "user_groups";
        $this->_role_ass_table = $GLOBALS['cfg']->get("database","prefix") . "user_roles";
        $this->_user_table = $GLOBALS['cfg']->get("database","prefix") . "user";
        
        // Get users permissions
        $result = XT::query("
            SELECT * 
            FROM 
                " . $GLOBALS['cfg']->get("database","prefix") . "node_perms as user LEFT JOIN " . $this->_user_table . " as u ON (user.principal_id = " . XT::getUserID() . "),
                " . $GLOBALS['cfg']->get("database","prefix") . "node_perms as group LEFT JOIN " . $this->_group_ass_table . " as g ON (g.user_id = " . XT::getUserID() . " AND group.principal_id = g.group_id AND group.principal_type = 2),
                " . $GLOBALS['cfg']->get("database","prefix") . "node_perms as role LEFT JOIN " . $this->_role_ass_table . " as r ON (r.user_id = " . XT::getUserID() . " AND role.principal_id = r.group_id AND role.principal_type = 2)
            WHERE
                user.user_id = " . XT::getUserID() . "
            ",__FILE__,__LINE__,1);
            
    }
    
    
}

?>