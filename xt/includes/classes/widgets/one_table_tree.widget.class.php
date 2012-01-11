<?php
// give the tree_id in SessionValue TreeID
class XT_WidgetTreeWithTreeId {

    var $_detail_fields = array();
    var $_start_node = 0;
    var $_data = array();

    function addDetails(){
        $this->_detail_fields = func_get_args();
    }

    function setStartNode($id){
        $this->_start_node = $id;
    }

    function buildTree($table = "tree", $detailtable = "nodes", $title_format = "%s", &$in){

        // Get active folder
        $active = 1;
        if($GLOBALS['plugin']->getSessionValue("open") != ''){
            $active = $GLOBALS['plugin']->getSessionValue("open");
        }
        if($GLOBALS['plugin']->getValue('open') != ''){
            $active = $GLOBALS['plugin']->getValue('open');
        }
        $GLOBALS['plugin']->setSessionValue("open", $active);
        
        // Get the way
        $result = XT::query("SELECT n1.id, COUNT(n1.id) AS level
        FROM
            " . $GLOBALS['plugin']->getTable($table) . " AS n1,
            " . $GLOBALS['plugin']->getTable($table) . " AS n3
        WHERE
            n3.id = " . $GLOBALS['plugin']->getSessionValue("open") . "
            AND n1.l <= n3.l
            AND n1.r >= n3.r
        GROUP BY
            n1.ID
        ORDER BY
            n1.l
        ",__FILE__,__LINE__);

        // Empty in that results as e.g. 1,2,23,54
        $in = '';
        $way = array();
        while ($row = $result->FetchRow()){
           $in .= ', ' . $row['id'] ;
           $way[] = $row['id'];
        }

        // Strip away first comma
        $in = $in != '' ? @substr($in, 1) : 1;

        // Prepare detail fields
        $detail_fields = '';
        foreach($this->_detail_fields as $value){
            $detail_fields .= ",a." . $value;
        }
        $detail_fields = @substr($detail_fields, 1);

        // Get the folders
        $result = XT::query("
            SELECT
                a.id, a.l, a.r, a.level, a.pid, floor((a.r-a.l-1)/2) as subs, " . $detail_fields . "
            FROM
                " . $GLOBALS['plugin']->getTable($table) . " as a
            WHERE
                a.pid IN (0," . $in . ")
            AND 
                a.tree_id = " . XT::getSessionValue('tree_id') . "
            GROUP BY
                a.id
            ORDER BY
                a.l ASC
            ",__FILE__,__LINE__,0);

        
        $GLOBALS['plugin']->setNodePerms($_SESSION['user']['node_perms']);
        $GLOBALS['plugin']->setTreeWay($way);
        
        $this->_data = array();
        
        while($row = $result->FetchRow()){

            
            if($row['id'] == $GLOBALS['plugin']->getSessionValue("open")){
                $GLOBALS['plugin']->setSessionValue("opentitle", $row['title']);
                $row['selected'] = true;
            } else {
                $row['selected'] = false;
            }
            $row['itw'] = in_array($row['id'],$way);

            $replace_fields = array();
            foreach($this->_detail_fields as $value){
                if($value == 'id' && $row[$value] == ''){
                    $row[$value] = '<span style="color: red;">' . $row['id'] . '</span>';
                }
                $replace_fields[] = $row[$value];
            }
            $row['title'] = vsprintf($title_format,$replace_fields);
            $row['allowed'] = array(
                'view' => XT::getNodePermission($row['id'],'view',$row['pid'],true)
            );

            $this->_data[] = $row;
        }
        
        // Assign folder tree
        XT::assign("NODES", $this->_data);
        XT::assign("NODE_MANAGER_TPL", $GLOBALS['plugin']->getConfig('node_manager_tpl'));
        XT::assign("NODE_MANAGER_BASE_ID", $GLOBALS['plugin']->getConfig('node_manager_base_id'));
        XT::assign("PACKAGE", $GLOBALS['plugin']->package);

        return sizeof($this->_data);
    }
    
    function &getData(){
        return $this->_data;
    }
}

?>
