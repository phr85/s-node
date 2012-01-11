<?php
class XT_Application {

    var $_in = '';
    var $_way = array();
    var $_active_level = 0;

    function XT_Application(){
        // Get the way
        $result = XT::query("
            SELECT
                n1.id,
                n3.title,
                n3.image
            FROM
            " . $GLOBALS['cfg']->get("database","prefix") . "navigation AS n2,
            " . $GLOBALS['cfg']->get("database","prefix") . "navigation AS n1
            LEFT JOIN " . $GLOBALS['cfg']->get("database","prefix") . "navigation_details AS n3 ON (n3.node_id = n1.id AND n3.lang = '" . $GLOBALS['lang']->getLang() . "')
            WHERE
                n2.id ='" . $GLOBALS['tpl_id'] . "'
                AND n1.l <= n2.l
                AND n1.r >= n2.r
            GROUP BY
                n1.ID
            ORDER BY
                n1.l ASC
        ",__FILE__,__LINE__,0);

        $level = 1;
        while ($row = $result->FetchRow()){
           $this->_way[] = $row['id'];
           $this->_way_titles[$row['id']] = $row['title'];
           $this->_way_headimage[$row['id']] = $row['image'];
           $this->_in .= ',' . $row['id'];
           $this->_active_level = $level;
           $level++;
        }
        $this->_in = substr($this->_in, 1);
    }

    function rebuildWay($id){

        $this->_way = array();
        $this->_way_titles = array();

        // Get the way
        $result = XT::query("
            SELECT
                n1.id,
                n3.title,
                n3.image
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "navigation AS n2,
                " . $GLOBALS['cfg']->get("database","prefix") . "navigation AS n1 LEFT JOIN
                " . $GLOBALS['cfg']->get("database","prefix") . "navigation_details AS n3 ON (n3.node_id = n1.id AND n3.lang = '" . $GLOBALS['lang']->getLang() . "')
            WHERE
                n2.id ='" . $id . "'
                AND n1.l <= n2.l
                AND n1.r >= n2.r
            GROUP BY
                n1.ID
            ORDER BY
                n1.l
        ",__FILE__,__LINE__,0);

        $level = 1;
        while ($row = $result->FetchRow()){
           $this->_way[] = $row['id'];
           $this->_way_titles[$row['id']] = $row['title'];
           $this->_way_headimage[$row['id']] = $row['image'];
           $this->_in .= ',' . $row['id'];
           $this->_active_level = $level;
           $level++;
        }

        $this->_in = substr($this->_in, 1);
    }

    function getWay(){
        return $this->_way;
    }

    function getWayInfo(){
        $count = 0;
        foreach($this->_way as $element){
            $way[$count]['id'] = $element;
            $way[$count]['title'] = $this->_way_titles[$element];
            $way[$count]['headimage'] = $this->_way_headimage[$element];;
            $count++;
        }
        return $way;
    }

    function setIn($in){
        $this->_in = $in;
        $this->rebuildWay($in);
        return true;
    }

    function getIn($level = ''){
        if(is_numeric($level)){
            return $this->_way[$level];
        }
        return $this->_in;
    }

    function getActiveLevel(){
        return $this->_active_level;
    }

    function getParentID(){
        return $this->_way[$this->_active_level-1];
    }
}
?>