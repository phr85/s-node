<?php
/**
 * Tree manipulation class
 *
 * @package S-Node
 * @subpackage Core
 * @author Veith Zaech <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: tree.class.php 5822 2009-04-29 12:25:59Z vzaech $
 */

class XT_Tree {

    var $table;

    /**
    * Constructor for the tree class
    *
    * @param string $table table to use for the tree (without suffix & prefix)
    *
    */
    function XT_Tree($table, $suffix = true){
        if($suffix == true){
            if($GLOBALS['plugin']->getTable($table) == ''){
                $this->table = $GLOBALS['cfg']->get("database","prefix") . $table;
            } else {
                $this->table = $GLOBALS['plugin']->getTable($table);
            }
        }else{
            $this->table = $table;
        }
    }

    function getPath($node_id){
        $result = XT::query("
            SELECT
                n1.id,
                n3.title
            FROM
                " . $this->table . " AS n1
            LEFT JOIN
                " . $this->table . "_details AS n3 ON (n3.node_id = n1.id AND n3.lang = '" . $GLOBALS['lang']->getLang() . "')
                , " . $this->table . " AS n2
            WHERE
                n2.id ='" . $node_id . "'
                AND n1.l <= n2.l
                AND n1.r >= n2.r
            GROUP BY
                n1.ID
            ORDER BY
                n1.l ASC
        ",__FILE__,__LINE__,0);

        $level = 1;
        $this->_in = "";
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



    /**
    * Adds tree to table
    *
    * @return int                   ID of the new tree
    */
    function addTree(){

        // Insert root node
        XT::query("INSERT INTO " . $this->table . " (ID, l, r, pid, level,tree_id) VALUES (NULL, 1, 2, 0, 0, 0)", __FILE__, __LINE__);

        // Get the last insert id
        $result = XT::query("SELECT id FROM " . $this->table . " ORDER BY id DESC LIMIT 1");
        while($row = $result->FetchRow()){
            $tree_id = $row['id'];
        }

        // Update tree id
        XT::query("UPDATE " . $this->table . " SET tree_id=" . $tree_id . " WHERE id=" . $tree_id , __FILE__, __LINE__);
        return $tree_id;
    }

    /**
    * Adds node to tree
    *
    * @param int    $target_node_id Id of the target node
    * @param string $position       Where to insert (before, after)  default is after
    *
    * @return int                   ID of the new Node
    * @return 0                     Error while adding the node
    */
    function addNode($target_node_id, $position = 'after'){
        $node_info = $this->_nodeInfo($target_node_id);
        if($node_info['pid'] != 0){
            $parent_node = $this->_nodeInfo($node_info['pid']);
        }else{
            $parent_node = $node_info;
        }
        // add node
        $tsql[1] = "LOCK TABLES " . $this->table . " WRITE";
        // All Lx > Rvater auf (Lx + 2 setzen)
        $tsql[2] = "UPDATE " . $this->table . " SET l= l+2 WHERE l > " . $parent_node['r']. " AND tree_id = " . $node_info['tree_id'];
        //Alle R gr&ouml;sser gleich Rvater auf Rx +2 setzen
        $tsql[3] = "UPDATE " . $this->table . " SET r= r+2 WHERE r >= " . ($parent_node['r']. " AND tree_id = " . $node_info['tree_id']);
        // neues element mit Lneu = Rvater und Rneu = Rvater + 1 und PID = ID vom Vater und Level = level Vater+1
        $tsql[4] = "INSERT INTO " . $this->table . "
        (ID, l, r, pid, level,tree_id) VALUES
        (NULL, " . ($parent_node['r']) . ", " . ($parent_node['r'] + 1) . ", " . $parent_node['id'] . ", " . ($parent_node['level'] + 1) . ", " . $parent_node['tree_id'] .")";
        // Schreibzugriff f�r andere wieder entfernen
        $tsql[5] = "UNLOCK TABLES";
        reset($tsql);
        $count = 1;
        foreach ($tsql as $sql) {
            if($count == 1 || $count == 5){
                XT::query($sql, __FILE__,__LINE__);
            } else {
                $GLOBALS['db']->query($sql);
            }
            $count++;
        }

        // Get the last insert id
        $result = XT::query("SELECT id FROM " . $this->table . " ORDER BY id DESC LIMIT 1");
        while($row = $result->FetchRow()){
            $new_node_id = $row['id'];
        }

        switch ($position) {
            case "after":
                $this->moveNode($new_node_id, $target_node_id, 'after');
                break;
            case "before":
                $this->moveNode($new_node_id, $target_node_id, 'before');
                break;
            case "last":
                $this->moveNode($new_node_id, $target_node_id, 'last');
                break;
            case "first":
                $this->moveNode($new_node_id, $target_node_id, 'first');
                break;
        }
        return $new_node_id;

    }

    /**
    * Adds child node
    *
    * @param int    $target_node_id Id of the target node
    * @param string $position       Where to insert (first, last) default is last
    *
    * @return int                   ID of the new Node
    * @return 0                     Error while adding the node
    */
    function addChildNode($target_node_id, $position = 'last'){
        switch ($position) {
            case "last":
                return $this->addNode($target_node_id, $position = 'last');
                break;
            case "first":
                return $this->addNode($target_node_id, $position = 'first');
                break;
        }
    }

    /**
    * Moves a node
    *
    * @param int    $source_node_id Id of the source node
    * @param int    $target_node_id Id of the target node
    * @param string $position       Where to insert (before, after, first (as childnode), last (as childnode)) default is after
    *
    * @return int                   ID of the new Node
    * @return 0                     Error while adding the node
    */
    function moveNode($source_node_id, $target_node_id, $position = 'before'){

        $ctrlx = $this->_nodeInfo($source_node_id);
        $ctrlv = $this->_nodeInfo($target_node_id);

        // nur verschieben wenn man sich im gleichen baum befindet !!!
        if($ctrlv['tree_id'] == $ctrlx['tree_id']){
            switch ($position) {
                case "before":
                    $this->moveNodeBefore($source_node_id, $target_node_id);
                    break;
                case "after":
                    $this->moveNodeAfter($source_node_id, $target_node_id);
                    return true;
                    break;

                case "last":
                    $diff = $ctrlx['r'] - $ctrlx['l'] + 1;
                    if ($ctrlx['r'] > $ctrlv['r']){
                        $distance = $ctrlx['l'] - $ctrlv['r'];
                        // Schreibzugriff f�r andere sperren
                        $tsql[1] = "LOCK TABLES " . $this->table . " WRITE";
                        // alle l vom ziel her erh�hen
                        $tsql[2] = "UPDATE " . $this->table . " SET l = l + " . $diff . " WHERE l > " . $ctrlv['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // alle r vom ziel her erh�hen
                        $tsql[3] = "UPDATE " . $this->table . " SET r = r + " . $diff . " WHERE r >= " . $ctrlv['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // kopiertes element an seine platz setzen und l, r richtigsetzen
                        $tsql[4] = "UPDATE " . $this->table . " SET l = l - " . ($distance  + $diff) . ", r = r - " . ($distance  + $diff) . " WHERE l >= " . ($ctrlx['l'] + $diff) . " AND r <= " . ($ctrlx['r'] + $diff) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // richtige pid setzen
                        $tsql[5] = "UPDATE " . $this->table . " SET pid = " . $ctrlv['id'] . " WHERE l = " . (($ctrlx['l'] + $diff) - ($distance  + $diff)) . " AND r = " . (($ctrlx['r'] + $diff) - ($distance  + $diff)) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // richtige level setzen
                        $tsql[6] = "UPDATE " . $this->table . " SET level = level - " . ($ctrlx['level'] - $ctrlv['level']) . " + 1 WHERE l >= " . (($ctrlx['l'] + $diff) - ($distance  + $diff)) . " AND r <= " . (($ctrlx['r'] + $diff) - ($distance  + $diff)) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // alle l vom start her verkleinern
                        $tsql[7] = "UPDATE " . $this->table . " SET l = l - " . $diff . " WHERE r > " . ($ctrlx['r'] + $diff) . " AND l > " . $ctrlx['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // alle l vom start her verkleinern
                        $tsql[8] = "UPDATE " . $this->table . " SET r = r - " . $diff . " WHERE r > " . ($ctrlx['r'] + $diff) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // Schreibzugriff f�r andere wieder &ouml;ffnen
                        $tsql[9] = "UNLOCK TABLES";
                    }else{
                        $distance = $ctrlv['r'] - $ctrlx['r'] + $diff;
                        // Schreibzugriff f�r andere sperren
                        $tsql[1] = "LOCK TABLES " . $this->table . " WRITE";
                        // alle l vom ziel her erh�hen
                        $tsql[2] = "UPDATE " . $this->table . " SET l = l + " . $diff . " WHERE l > " . $ctrlv['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // alle r vom ziel her erh�hen
                        $tsql[3] = "UPDATE " . $this->table . " SET r = r + " . $diff . " WHERE r >= " . $ctrlv['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // kopiertes element an seine platz setzen und l, r richtigsetzen
                        $tsql[4] = "UPDATE " . $this->table . " SET l = l + " . $distance . "- 1 , r = r + " . $distance . "- 1 WHERE l >= " . $ctrlx['l'] . " AND r <= " . $ctrlx['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // richtige pid setzen
                        $tsql[5] = "UPDATE " . $this->table . " SET pid = " . $ctrlv['id'] . " WHERE l = " . (($ctrlx['l'] + $distance) - 1) . " AND r = " . (($ctrlx['r'] + $distance) - 1) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // richtige level setzen
                        $tsql[6] = "UPDATE " . $this->table . " SET level = level - " . ($ctrlx['level'] - $ctrlv['level']) . " + 1 WHERE l >= " . (($ctrlx['l'] + $distance) - 1) . " AND r <= " . (($ctrlx['r'] + $distance) - 1) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // alle l vom start her verkleinern
                        $tsql[7] = "UPDATE " . $this->table . " SET l = l - " . $diff . " WHERE r > " . $ctrlx['r'] . " AND l > " . $ctrlx['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // alle l vom start her verkleinern
                        $tsql[8] = "UPDATE " . $this->table . " SET r = r - " . $diff . " WHERE r > " . $ctrlx['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // Schreibzugriff f�r andere wieder &ouml;ffnen
                        $tsql[9] = "UNLOCK TABLES";
                    }
                    $count = 1;
                    foreach ($tsql as $sql) {
                        if($count == 1 || $count == 9){
                            XT::query($sql, __FILE__,__LINE__);
                        } else {
                            XT::query($sql,__FILE__,__LINE__);
                        }
                        $count++;
                    }
                    return true;
                    break;

                case "first":
                    // An die unterste Stelle schieben
                    $diff = $ctrlx['r'] - $ctrlx['l'] + 1;
                    if ($ctrlx['r'] > $ctrlv['r']){
                        $distance = $ctrlx['l'] - $ctrlv['r'];
                        // Schreibzugriff f�r andere sperren
                        $tsql[1] = "LOCK TABLES " . $this->table . " WRITE";
                        // alle l vom ziel her erh�hen
                        $tsql[2] = "UPDATE " . $this->table . " SET l = l + " . $diff . " WHERE l > " . $ctrlv['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // alle r vom ziel her erh�hen
                        $tsql[3] = "UPDATE " . $this->table . " SET r = r + " . $diff . " WHERE r >= " . $ctrlv['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // kopiertes element an seine platz setzen und l, r richtigsetzen
                        $tsql[4] = "UPDATE " . $this->table . " SET l = l - " . ($distance  + $diff) . ", r = r - " . ($distance  + $diff) . " WHERE l >= " . ($ctrlx['l'] + $diff) . " AND r <= " . ($ctrlx['r'] + $diff) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // richtige pid setzen
                        $tsql[5] = "UPDATE " . $this->table . " SET pid = " . $ctrlv['id'] . " WHERE l = " . (($ctrlx['l'] + $diff) - ($distance  + $diff)) . " AND r = " . (($ctrlx['r'] + $diff) - ($distance  + $diff)) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // richtige level setzen
                        $tsql[6] = "UPDATE " . $this->table . " SET level = level - " . ($ctrlx['level'] - $ctrlv['level']) . " + 1 WHERE l >= " . (($ctrlx['l'] + $diff) - ($distance  + $diff)) . " AND r <= " . (($ctrlx['r'] + $diff) - ($distance  + $diff)) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // alle l vom start her verkleinern
                        $tsql[7] = "UPDATE " . $this->table . " SET l = l - " . $diff . " WHERE r > " . ($ctrlx['r'] + $diff) . " AND l > " . $ctrlx['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // alle l vom start her verkleinern
                        $tsql[8] = "UPDATE " . $this->table . " SET r = r - " . $diff . " WHERE r > " . ($ctrlx['r'] + $diff) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // Schreibzugriff f�r andere wieder &ouml;ffnen
                        $tsql[9] = "UNLOCK TABLES";
                    }else{
                        $distance = $ctrlv['r'] - $ctrlx['r'] + $diff;
                        // Schreibzugriff f�r andere sperren
                        $tsql[1] = "LOCK TABLES " . $this->table . " WRITE";
                        // alle l vom ziel her erh�hen
                        $tsql[2] = "UPDATE " . $this->table . " SET l = l + " . $diff . " WHERE l > " . $ctrlv['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // alle r vom ziel her erh�hen
                        $tsql[3] = "UPDATE " . $this->table . " SET r = r + " . $diff . " WHERE r >= " . $ctrlv['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // kopiertes element an seine platz setzen und l, r richtigsetzen
                        $tsql[4] = "UPDATE " . $this->table . " SET l = l + " . $distance . "- 1 , r = r + " . $distance . "- 1 WHERE l >= " . $ctrlx['l'] . " AND r <= " . $ctrlx['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // richtige pid setzen
                        $tsql[5] = "UPDATE " . $this->table . " SET pid = " . $ctrlv['id'] . " WHERE l = " . (($ctrlx['l'] + $distance) - 1) . " AND r = " . (($ctrlx['r'] + $distance) - 1) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // richtige level setzen
                        $tsql[6] = "UPDATE " . $this->table . " SET level = level - " . ($ctrlx['level'] - $ctrlv['level']) . " + 1 WHERE l >= " . (($ctrlx['l'] + $distance) - 1) . " AND r <= " . (($ctrlx['r'] + $distance) - 1) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // alle l vom start her verkleinern
                        $tsql[7] = "UPDATE " . $this->table . " SET l = l - " . $diff . " WHERE r > " . $ctrlx['r'] . " AND l > " . $ctrlx['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // alle l vom start her verkleinern
                        $tsql[8] = "UPDATE " . $this->table . " SET r = r - " . $diff . " WHERE r > " . $ctrlx['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                        // Schreibzugriff f�r andere wieder &ouml;ffnen
                        $tsql[9] = "UNLOCK TABLES";
                    }
                    reset($tsql);
                    $count = 1;
                    foreach ($tsql as $sql) {
                        if($count == 1 || $count == 9){
                            XT::query($sql, __FILE__,__LINE__);
                        } else {
                            $GLOBALS['db']->query($sql);
                        }
                        $count++;
                    }

                    $tsql = array();
                    // nun an die oberste stelle schieben
                    $diff = $ctrlx['r'] - $ctrlx['l'] + 1;
                    $distance = $ctrlx['l'] - $ctrlv['l'] + $diff - 1;
                    // Schreibzugriff f�r andere sperren
                    $tsql[1] = "LOCK TABLES " . $this->table . " WRITE";
                    // alle l vom ziel her erh�hen
                    $tsql[2] = "UPDATE " . $this->table . " SET l = l + " . $diff . " WHERE l > " . $ctrlv['l'] . " AND r < " . $ctrlv['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                    // alle r vom ziel her erh�hen
                    $tsql[3] = "UPDATE " . $this->table . " SET r = r + " . $diff . " WHERE l > " . $ctrlv['l'] . " AND r < " . $ctrlv['r'] . "  AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                    // kopiertes element an seine platz setzen und l, r richtigsetzen
                    $tsql[4] = "UPDATE " . $this->table . " SET l = l - " . $distance . ", r = r - " . $distance . " WHERE l >= " . ($ctrlx['l'] + $diff) . " AND r <= " . ($ctrlx['r'] + $diff) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
                    // Schreibzugriff f�r andere wieder &ouml;ffnen
                    $tsql[5] = "UNLOCK TABLES";

                    reset($tsql);
                    $count = 1;
                    foreach ($tsql as $sql) {
                        if($count == 1 || $count == 5){
                            XT::query($sql, __FILE__,__LINE__);
                        } else {
                            $GLOBALS['db']->query($sql);
                        }
                        $count++;
                    }
                    return true;
                    break;

                default:
                    return false;
            }
        }
    }

    function moveNodeAfter($source_node_id, $target_node_id){
        $ctrlx = $this->_nodeInfo($source_node_id);
        $ctrlv = $this->_nodeInfo($target_node_id);
        if ($ctrlv['level'] < $ctrlx['level']){
            $level = "- 1";
        }elseif ($ctrlv['level'] > $ctrlx['level']){
            $level = "+ 1";
        }else{
            $level = "";
        }
        $diff = $ctrlx['r'] - $ctrlx['l'] + 1;
        if ($ctrlx['r'] > $ctrlv['r']){
            $distance = $ctrlx['l'] - $ctrlv['r'] + $diff;
            // Schreibzugriff f�r andere sperren
            $tsql[1] = "LOCK TABLES " . $this->table . " WRITE";
            // alle l vom ziel her erh�hen
            $tsql[2] = "UPDATE " . $this->table . " SET l = l + " . $diff . " WHERE l > " . $ctrlv['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // alle r vom ziel her erh�hen
            $tsql[3] = "UPDATE " . $this->table . " SET r = r + " . $diff . " WHERE r > " . $ctrlv['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // kopiertes element an seine platz setzen und l, r richtigsetzen
            $tsql[4] = "UPDATE " . $this->table . " SET l = l - " . $distance . " + 1 , r = r - " . $distance . " + 1 WHERE l >= " . ($ctrlx['l'] + $diff) . " AND r <= " . ($ctrlx['r'] + $diff) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // richtige pid setzen
            $tsql[5] = "UPDATE " . $this->table . " SET pid = " . $ctrlv['pid'] . " WHERE l = " . ($ctrlx['l'] + $diff - $distance) . "+ 1 AND r = " . ($ctrlx['r'] + $diff - $distance) . "+ 1 AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // richtige level setzen
            $tsql[6] = "UPDATE " . $this->table . " SET level = level - " . ($ctrlx['level'] - $ctrlv['level']) . " WHERE l >= " . ($ctrlx['l'] + $diff - $distance) . "+ 1 AND r <= " . ($ctrlx['r'] + $diff - $distance) . "+ 1 AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // alle l vom start her verkleinern
            $tsql[7] = "UPDATE " . $this->table . " SET l = l - " . $diff . " WHERE l > " . ($ctrlx['r']) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // alle l vom start her verkleinern
            $tsql[8] = "UPDATE " . $this->table . " SET r = r - " . $diff . " WHERE r > " . ($ctrlx['r']) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // Schreibzugriff f�r andere wieder &ouml;ffnen
            $tsql[9] = "UNLOCK TABLES";
        }else{
            $distance = $ctrlv['r'] - $ctrlx['r'] + $diff;
            // Schreibzugriff f�r andere sperren
            $tsql[1] = "LOCK TABLES " . $this->table . " WRITE";
            // alle l vom ziel her erh�hen
            $tsql[2] = "UPDATE " . $this->table . " SET l = l + " . $diff . " WHERE l > " . $ctrlv['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // alle r vom ziel her erh�hen
            $tsql[3] = "UPDATE " . $this->table . " SET r = r + " . $diff . " WHERE r > " . $ctrlv['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // kopiertes element an seine platz setzen und l, r richtigsetzen
            $tsql[4] = "UPDATE " . $this->table . " SET l = l + " . $distance . ", r = r + " . $distance . " WHERE l >= " . $ctrlx['l'] . " AND r <= " . $ctrlx['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // richtige pid setzen
            $tsql[5] = "UPDATE " . $this->table . " SET pid = " . $ctrlv['pid'] . " WHERE l = " . ($ctrlx['l'] + $distance) . " AND r = " . ($ctrlx['r'] + $distance) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // richtige level setzen
            $tsql[6] = "UPDATE " . $this->table . " SET level = level - " . ($ctrlx['level'] - $ctrlv['level']) . " WHERE l >= " . ($ctrlx['l'] + $distance) . " AND r <= " . ($ctrlx['r'] + $distance) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // alle l vom start her verkleinern
            $tsql[7] = "UPDATE " . $this->table . " SET l = l - " . $diff . " WHERE l >= " . $ctrlx['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // alle l vom start her verkleinern
            $tsql[8] = "UPDATE " . $this->table . " SET r = r - " . $diff . " WHERE r >= " . $ctrlx['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // Schreibzugriff f�r andere wieder &ouml;ffnen
            $tsql[9] = "UNLOCK TABLES";
        }
        reset($tsql);
        $count = 1;
        foreach ($tsql as $sql) {
            if($count == 1 || $count == 9){
                XT::query($sql, __FILE__,__LINE__);
            } else {
                $GLOBALS['db']->query($sql);
            }
            $count++;
        }
    }

    function moveNodeBefore($source_node_id, $target_node_id){
        $ctrlx = $this->_nodeInfo($source_node_id);
        $ctrlv = $this->_nodeInfo($target_node_id);
        $diff = $ctrlx['r'] - $ctrlx['l'] + 1;
        if ($ctrlx['l'] > $ctrlv['l']){
            $distance = $ctrlx['l'] - $ctrlv['l'] + $diff;
            // Schreibzugriff f�r andere sperren
            $tsql[1] = "LOCK TABLES " . $this->table . " WRITE";
            // alle l vom ziel her erh�hen
            $tsql[2] = "UPDATE " . $this->table . " SET l = l + " . $diff . " WHERE l >= " . $ctrlv['l'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // alle r vom ziel her erh�hen
            $tsql[3] = "UPDATE " . $this->table . " SET r = r + " . $diff . " WHERE r >= " . $ctrlv['l'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // element an seinen platz setzen und l, r richtigsetzen
            $tsql[4] = "UPDATE " . $this->table . " SET l = l - " . $distance . ", r = r - " . $distance . " WHERE l >= " . ($ctrlx['l'] + $diff) . " AND r <= " . ($ctrlx['r'] + $diff) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // richtige pid setzen
            $tsql[5] = "UPDATE " . $this->table . " SET pid = " . $ctrlv['pid'] . " WHERE l = " . ($ctrlx['l'] + $diff - $distance) . " AND r = " . ($ctrlx['r'] + $diff - $distance) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // richtige level setzen
            $tsql[6] = "UPDATE " . $this->table . " SET level = level - " . ($ctrlx['level'] - $ctrlv['level']) . " WHERE l >= " . ($ctrlx['l'] + $diff - $distance) . " AND r <= " . ($ctrlx['r'] + $diff - $distance) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // alle l vom ziel her verkleinern
            $tsql[7] = "UPDATE " . $this->table . " SET l = l - " . $diff . " WHERE l > " . ($ctrlx['l'] + $diff) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // alle l vom ziel her verkleinern
            $tsql[8] = "UPDATE " . $this->table . " SET r = r - " . $diff . " WHERE r > " . ($ctrlx['l'] + $diff + $diff - 1) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // Schreibzugriff f�r andere wieder &ouml;ffnen
            $tsql[9] = "UNLOCK TABLES";
        }else{
            $distance = $ctrlv['l'] - $ctrlx['l'];
            // Schreibzugriff f�r andere sperren
            $tsql[1] = "LOCK TABLES " . $this->table . " WRITE";
            // alle l vom ziel her erh�hen
            $tsql[2] = "UPDATE " . $this->table . " SET l = l + " . $diff . " WHERE l >= " . $ctrlv['l'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // alle r vom ziel her erh�hen
            $tsql[3] = "UPDATE " . $this->table . " SET r = r + " . $diff . " WHERE r >= " . $ctrlv['l'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // kopiertes element an seine platz setzen und l, r richtigsetzen
            $tsql[4] = "UPDATE " . $this->table . " SET l = l + " . $distance . ", r = r + " . $distance . " WHERE l >= " . $ctrlx['l']. " AND r <= " . $ctrlx['r'] . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // richtige pid setzen
            $tsql[5] = "UPDATE " . $this->table . " SET pid = " . $ctrlv['pid'] . " WHERE l = " . ($ctrlx['l'] + $distance) . " AND r = " . ($ctrlx['r'] + $distance) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // richtige level setzen
            $tsql[6] = "UPDATE " . $this->table . " SET level = level - " . ($ctrlx['level'] - $ctrlv['level']) . " WHERE l >= " . ($ctrlx['l'] + $distance) . " AND r <= " . ($ctrlx['r'] + $distance) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // alle l vom ziel her verkleinern
            $tsql[7] = "UPDATE " . $this->table . " SET l = l - " . $diff . " WHERE l > " . ($ctrlx['r']) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // alle l vom ziel her verkleinern
            $tsql[8] = "UPDATE " . $this->table . " SET r = r - " . $diff . " WHERE r > " . ($ctrlx['r']) . " AND l != 1 AND tree_id = " . $ctrlv['tree_id'];
            // Schreibzugriff f�r andere wieder &ouml;ffnen
            $tsql[9] = "UNLOCK TABLES";
        }
        reset($tsql);
        $count = 1;
        foreach ($tsql as $sql) {
            if($count == 1 || $count == 9){
                XT::query($sql, __FILE__,__LINE__);
            } else {
                $GLOBALS['db']->query($sql);
            }
            $count++;
        }
        return true;
    }

    /**
    * Show affected nodes which where affected by nodeDelete()
    *
    * @param int    $node_id        Id of the node to delete
    *
    * @return array                 IDs of the affected Nodes
    * @return 0                     No node affected
    */
    function showDelete($node_id){
        $node_info = $this->_nodeInfo($node_id);
        $sql = "SELECT n1.id, floor(( n1.r - n1.l) / 2) AS subs
        FROM " . $this->table . " AS n1, " . $this->table . " AS n2
        WHERE n2.id = " . $node_id . "
        AND n1.l BETWEEN n2.l AND n2.r
        AND n1.tree_id = " . $node_info['tree_id'] . "
        GROUP BY n1.ID";
        return XT::getQueryData(XT::query($sql, __FILE__,__LINE__));
    }

    /**
    * Delete node and return array with the deleted nodes
    * If recursive is not set and childs available this fucntion moves the childs one level up
    *
    * @param int    $node_id        Id of the node to delete
    * @param bool   $recursive      Delete recursive or not, default is true
    *
    * @return array                 IDs of the deleted Nodes
    * @return 0                     No node affected
    */
    function nodeDelete($node_id, $recursive = true){
        if($recursive == true){
            $deleted_nodes = $this->showDelete($node_id);
            $node_info = $this->_nodeInfo($node_id);
            foreach ($deleted_nodes as $row) {
                $in .= ", " . $row['id'];
            }
            $diff = $node_info['r'] - $node_info['l'] + 1;
            // Schreibzugriff f&uuml;r andere sperren
            $tsql[1] = "LOCK TABLES " . $this->table . " WRITE";
            // L&ouml;schen von allen Elementen
            $tsql[2] = "DELETE FROM " . $this->table . " WHERE id IN (" . $node_id . $in . ") AND tree_id = " . $node_info['tree_id'];
            // alle L gr�sser R Lochgr�sse abz�hlen um L�cke wieder zu schliessen
            $tsql[3] = "UPDATE " . $this->table . " SET l = l - " . $diff . " Where l > " . $node_info['r'] . " AND r > " . $node_info['r'] . " AND tree_id = " . $node_info['tree_id'];
            // alle R gr�sser R Abstand abz�hlen um L�cke wieder zu schliessen
            $tsql[4] = "UPDATE " . $this->table . " SET r = r - " . $diff . " Where r > " . $node_info['r']. " AND tree_id = " . $node_info['tree_id'];
            // Schreibzugriff f&uuml;r andere wieder entfernen
            $tsql[5] = "UNLOCK TABLES";
            reset($tsql);
            $count = 1;
            foreach ($tsql as $sql) {
                if($count == 1 || $count == 5){
                    XT::query($sql, __FILE__,__LINE__);
                } else {
                    $GLOBALS['db']->query($sql);
                }
                $count++;
            }
            return $deleted_nodes;
        }else{
            $node_info = $this->_nodeInfo($node_id);
            // Schreibzugriff f&uuml;r andere sperren
            $tsql[1] = "LOCK TABLES " . $this->table . " WRITE";
            // L&ouml;schen von Element
            $tsql[2] = "DELETE FROM " . $this->table . " Where id=" . $node_id;
            //alle mit (L groesser Le und L kleiner Re) Lx  auf Lx-1 und R auf Rx-1 und die pid auf El[pid] und den level auf level -1 setzen
            $tsql[3] = "UPDATE " . $this->table . " SET l= l-1, r= r-1, pid=" . $node_info['pid'] . ", level = (level-1) Where l > " . $node_info['l'] . " AND l < " . $node_info['r']. " AND tree_id = " . $node_info['tree_id'];
            //alle mit L gr&ouml;sser Re    L auf Lx -2
            $tsql[4] = "UPDATE " . $this->table . " SET l= l -2 Where l > " . $node_info['r']. " AND tree_id = " . $node_info['tree_id'];
            //alle mit R gr&ouml;sser Re    R auf Rx-2 Setzen
            $tsql[5] = "UPDATE " . $this->table . " SET r = r-2 Where r > " . $node_info['r']. " AND tree_id = " . $node_info['tree_id'];
            // Schreibzugriff f&uuml;r andere wieder entfernen
            $tsql[6] = "UNLOCK TABLES";
            reset($tsql);
            $count = 1;
            foreach ($tsql as $sql) {
                if($count == 1 || $count == 5){
                    XT::query($sql, __FILE__,__LINE__);
                } else {
                    $GLOBALS['db']->query($sql);
                }
                $count++;
            }
            return $node_info['id'];
        }
    }

    /**
    * Copy node recursive AND returns an array with [][original_id], [][copy_id]
    *
    * @param int    $node_id        Id of the node to delete
    * @param int    $target_id      Id of the target node
    $ @param string $position       position of the copied node
    *
    * @return array                 IDs of the affected Nodes default is after
    */
    function copyNode($node_id, $target_id, $position = 'last'){
        $node_info = $this->_nodeInfo($node_id);

        $sql = "SELECT n1.id, n1.l, n1.r, n1.pid, n1.level, n1.tree_id
        FROM " . $this->table . " AS n1, " . $this->table . " AS n2
        WHERE n2.id = " . $node_id . "
        AND n1.l BETWEEN n2.l AND n2.r
        AND n1.tree_id = " . $node_info['tree_id'] . "
        GROUP BY n1.ID";
        $result =XT::query($sql, __FILE__,__LINE__);
        $i = 0;
        $target[0] = $target_id;
        $sourceinfo[$i] = $this->_nodeInfo($node_id);
        while($row = $result->FetchRow()){
            $return_ids[$i]['original'] = $row['id'];
            if($sourceinfo[$i]['pid'] != $row['pid']){
                $return_ids[$i]['copy'] = $this->addNode($target[$i], 'last');
            }else{
                $return_ids[$i]['copy'] = $this->addNode($target[$i], 'after');
            }
            $sourceinfo[$i +1] = $this->_nodeInfo($return_ids[$i]['original']);

            $target[($i + 1)] = $return_ids[$i]['copy'];

            $i++;
        }
        $this->moveNode($return_ids[0]['copy'],$target_id, $position);
        return $return_ids;
    }

    /**
    * Get all informations from the node (id, l, r, pid, level, tree_id, childs, )
    *
    * @param int    $node_id         Id of the node
    *
    * @return array                 informations of the node
    * @return 0                     Error
    */
    function _nodeInfo($node_id){
        $result = XT::query("SELECT id, l, r, pid, level, ((r - l -1) / 2) as childs, tree_id FROM " . $this->table . " WHERE id = " . $node_id,__FILE__,__LINE__);
        return $result->FetchRow();
    }

    function addNodeWithID($target_node_id, $given_id){
        $node_info = $this->_nodeInfo($target_node_id);
        if($node_info['pid'] != 0){
            $parent_node = $this->_nodeInfo($node_info['pid']);
        }else{
            $parent_node = $node_info;
        }
        // add node
        $tsql[1] = "LOCK TABLES " . $this->table . " WRITE";
        // All Lx > Rvater auf (Lx + 2 setzen)
        $tsql[2] = "UPDATE " . $this->table . " SET l= l+2 WHERE l > " . $parent_node['r']. " AND tree_id = " . $node_info['tree_id'];
        //Alle R gr&ouml;sser gleich Rvater auf Rx +2 setzen
        $tsql[3] = "UPDATE " . $this->table . " SET r= r+2 WHERE r >= " . ($parent_node['r']. " AND tree_id = " . $node_info['tree_id']);
        // neues element mit Lneu = Rvater und Rneu = Rvater + 1 und PID = ID vom Vater und Level = level Vater+1
        $tsql[4] = "INSERT INTO " . $this->table . "
        (ID, l, r, pid, level,tree_id) VALUES
        (" . $given_id . ", " . ($parent_node['r']) . ", " . ($parent_node['r'] + 1) . ", " . $parent_node['id'] . ", " . ($parent_node['level'] + 1) . ", " . $parent_node['tree_id'] .")";
        // Schreibzugriff f�r andere wieder entfernen
        $tsql[5] = "UNLOCK TABLES";
        reset($tsql);
        $count = 1;
        foreach ($tsql as $sql) {
            if($count == 1 || $count == 5){
                XT::query($sql, __FILE__,__LINE__);
            } else {
                $GLOBALS['db']->query($sql);
            }
            $count++;
        }

        $this->moveNode($given_id, $target_node_id, 'last');

    }

}


?>