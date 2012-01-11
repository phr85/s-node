<?php

class XT_WidgetTree {

    var $_detail_fields = array();
    var $_start_node = 0;
    var $_data = array();
    var $_open_field = 'open';
    var $way = array();
    var $exclude_trees = array();
    var $fix_tree = array();

    function addDetails(){
        $this->_detail_fields = func_get_args();
    }

    function setStartNode($id){
        $this->_start_node = $id;
    }

    function setOpenField($open = 'open'){
        $this->_open_field = $open;
    }

    function buildTree($table = "tree", $detailtable = "nodes", $title_format = "%s", $lang = ""){

        // Get active folder
        $active = 1;
        if($GLOBALS['plugin']->getSessionValue($this->_open_field) != ''){
            $active = $GLOBALS['plugin']->getSessionValue($this->_open_field);
        }
        if($GLOBALS['plugin']->getValue($this->_open_field) != ''){
            $active = $GLOBALS['plugin']->getValue($this->_open_field);
        }
        $GLOBALS['plugin']->setSessionValue($this->_open_field, $active);


        // Get the way
        $result = XT::query("SELECT n1.id, COUNT(n1.id) AS level
        FROM
            " . $GLOBALS['plugin']->getTable($table) . " AS n1,
            " . $GLOBALS['plugin']->getTable($table) . " AS n3
        WHERE
            n3.id = " . $GLOBALS['plugin']->getSessionValue($this->_open_field) . "
            AND n1.l <= n3.l
            AND n1.r >= n3.r
            AND n1.tree_id = n3.tree_id
        GROUP BY
            n1.ID
        ORDER BY
            n1.l
        ",__FILE__,__LINE__);

        // Empty in that results as e.g. 1,2,23,54

        $way = array();
        $way[0]=0;

        while ($row = $result->FetchRow()){
           $way[] = $row['id'];
        }
        $this->way = $way;
        // Strip away first comma

        // Prepare detail fields
        $detail_fields = '';
        foreach($this->_detail_fields as $value){
            $detail_fields .= ",d." . $value;
        }
        $detail_fields = @substr($detail_fields, 1);

        // wenn tree fixiert wurde
        if(count($this->fix_tree) > 0){
						if(is_array($this->fix_tree)){
            		$fixtree_sql = " AND a.tree_id IN (" . implode(",", $this->fix_tree) . ")";
						}else{
            		$fixtree_sql = " AND a.tree_id IN (" . $this->fix_tree . ")";
						}
        }else {
        	$fixtree_sql = null;
        }

        // wenn tree nicht dargestellt werden darf
        if(count($this->exclude_trees) > 0){
            $excludetree_sql = " AND a.tree_id not IN (" . implode(",",$this->exclude_trees) . ")";
        }else {
        	$excludetree_sql = null;
        }

        // Get the folders
        $result = XT::query("
            SELECT
                a.id, a.l, a.r, a.level, a.pid, floor((a.r-a.l-1)/2) as subs,d2.node_id,d2.public as opt_public, d2.title as opt_title, a.tree_id, " . $detail_fields . "
            FROM
                " . $GLOBALS['plugin']->getTable($table) . " as a
                LEFT JOIN
                    " . $GLOBALS['plugin']->getTable($detailtable) . " as d
                    ON (d.node_id = a.id AND d.lang = '" . ($lang != '' ? $lang : $GLOBALS['plugin']->getActiveLang()) . "')
                LEFT JOIN
                    " . $GLOBALS['plugin']->getTable($detailtable) . " as d2
                    ON (d2.node_id = a.id)
            WHERE
                a.pid IN (" . implode(",",$way) . ")"
                . $fixtree_sql
                . $excludetree_sql . "
            GROUP BY
                a.id
            ORDER BY
                a.tree_id ASC, a.l ASC
            ",__FILE__,__LINE__);


        $GLOBALS['plugin']->setNodePerms($_SESSION['user']['node_perms']);
        $GLOBALS['plugin']->setTreeWay($way);

        $this->_data = array();

        while($row = $result->FetchRow()){

            // Check for existing title in active lang
            if($row['title'] == ''){
                $row['title'] = '<span style="color: red;">' . $row['opt_title'] . '</span>';
                $row['lang_na'] = true;
            } else {
                $row['lang_na'] = false;
            }
            if($row['id'] == $GLOBALS['plugin']->getSessionValue($this->_open_field)){
                $GLOBALS['plugin']->setSessionValue($this->_open_field . "title", $row['title']);
                $row['selected'] = true;
            } else {
                $row['selected'] = false;
            }
            $row['itw'] = in_array($row['id'],$way);

            $replace_fields = array();
            foreach($this->_detail_fields as $value){
                if($value == 'node_id' && $row[$value] == ''){
                    $row[$value] = '<span style="color: red;">' . $row['id'] . '</span>';
                }
                $replace_fields[] = $row[$value];
            }
            $row['title'] = vsprintf($title_format,$replace_fields);
            $row['allowed'] = array(
                'view' => XT::getNodePermission($row['node_id'],'view',$row['pid'],true) || $row['public'] || $row['opt_public'],
            );

            $this->_data[$row['id']] = $row;
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