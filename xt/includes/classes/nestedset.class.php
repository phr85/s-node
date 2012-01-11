<?php
class nestedset {

    var $table;
    var $plugin;

    function nestedset(&$plugin){
        $this->plugin = &$plugin;
    }

    function setTable($table){
        $this->table = $this->plugin->getTable($table);
        $this->checkTable();
    }

    function checkTable(){

        // check if root node already exists
        $result = $GLOBALS['db']->query("SELECT id FROM " . $this->table,__FILE__,__LINE__);

        if($result->RecordCount() == 0){

            // create root node
            $GLOBALS['db']->query("INSERT INTO " . $this->table . " (id,l,r,level,pid,title) VALUES (1,1,2,1,0,'root')",__FILE__,__LINE__);

            $GLOBALS['error_msg'] = "There was no root node in \"" . $this->table . "\", the system has created one for you.";
        }
    }

    function insertRootNode($title){
        XT::query("INSERT INTO " . $this->table . " (l,r,pid,level,tree_id,title) VALUES (1,2,0,1,id,'" . $title . "')");
        $result = XT::query("SELECT LAST_INSERT_ID() FROM " . $this->table . "");
        $row = $result->fetch_row();

        XT::query("UPDATE " . $this->table . " SET tree_id = id WHERE id = " . $row[0] . "");

        return $row[0];
    }

    function insertNodeAtBeginning($target_node_id, $title = "New element"){

        // Lock table for edit
        $GLOBALS['db']->query("LOCK TABLES " . $this->table . " WRITE",__FILE__,__LINE__);

        // Select data from target node
        $result = $GLOBALS['db']->query("SELECT id, l, r, pid, level, tree_id  FROM " . $this->table . " WHERE id = " . $target_node_id,__FILE__,__LINE__);

        // Hold data in temporary vars
        $row = $result->FetchRow();

        if($result->RecordCount() != 0){

            // Update target node
            $GLOBALS['db']->query("UPDATE " . $this->table . " SET r = r + 2 WHERE l <= " . $row['l'] . " AND r >= " . $row['r'] . " AND tree_id=" . $row['tree_id']);

            // Send following elements backwards
            $GLOBALS['db']->query("UPDATE " . $this->table . " SET l = l + 2, r = r + 2 WHERE l > " . $row['l'] . " AND tree_id=" . $row['tree_id']);

            // Set data for the new node
            $l = $row['l'] + 1;
            $r = $l + 1;
            $level = $row['level'] + 1;
            $pid = $row['id'];
            $tree_id = $row['tree_id'];

            // Insert new node
            $GLOBALS['db']->query("INSERT INTO " . $this->table . " (
                l,
                r,
                pid,
                level,
                title,
                creation_date,
                creation_user,
                mod_date,
                mod_user,
                tree_id
            ) VALUES (
                " . $l . ",
                " . $r . ",
                " . $pid . ",
                " . $level . ",
                '" . $title . "',
                " . time() . ",
                " . $_SESSION['user']['id'] . ",
                " . time() . ",
                " . $_SESSION['user']['id'] . ",
                " . $tree_id . "
            )",__FILE__,__LINE__);

        } else {

            // Set error message
            $GLOBALS['error_msg'] = "Target node \"" . $target_node_id . "\" doesn't exist";

        }

        // Unlock tables
        $GLOBALS['db']->query("UNLOCK TABLES",__FILE__,__LINE__);

        return $this->getLastInsertID();
    }

    function insertNodeAtEnd($target_node_id, $title = ""){

        // Lock table for edit
        $GLOBALS['db']->query("LOCK TABLES " . $this->table . " WRITE",__FILE__,__LINE__);

        // Select data from target node
        $result = $GLOBALS['db']->query("SELECT id, l, r, pid, level, tree_id  FROM " . $this->table . " WHERE id = " . $target_node_id,__FILE__,__LINE__,1);

        // Hold data in temporary vars
        $row = $result->FetchRow();

        if($result->RecordCount() != 0){

            // Update target node
            $GLOBALS['db']->query("UPDATE " . $this->table . " SET r = r + 2 WHERE (l <= " . $row['l'] . " AND r >= " . $row['r'] . ") OR l = 1 AND tree_id=" . $row['tree_id'],__FILE__,__LINE__,1);

            // Send following elements backwards
            $GLOBALS['db']->query("UPDATE " . $this->table . " SET l = l + 2, r = r + 2 WHERE l > " . $row['r'] . " AND tree_id=" . $row['tree_id'],__FILE__,__LINE__,1);

            // Set data for the new node
            $l = $row['r'];
            $r = $l + 1;
            $level = $row['level'] + 1;
            $pid = $row['id'];
            $tree_id = $row['tree_id'];

            // Insert new node
            $GLOBALS['db']->query("INSERT INTO " . $this->table . " (
                l,
                r,
                pid,
                level,
                title,
                creation_date,
                creation_user,
                mod_date,
                mod_user,
                tree_id
            ) VALUES (
                " . $l . ",
                " . $r . ",
                " . $pid . ",
                " . $level . ",
                '" . $title . "',
                " . time() . ",
                " . $_SESSION['user']['id'] . ",
                " . time() . ",
                " . $_SESSION['user']['id'] . ",
                " . $tree_id . "
            )",__FILE__,__LINE__);

        } else {

            // Set error message
            $GLOBALS['error_msg'] = "Target node \"" . $target_node_id . "\" doesn't exist";

        }

        // Unlock tables
        $GLOBALS['db']->query("UNLOCK TABLES",__FILE__,__LINE__);

        return $this->getLastInsertID();
    }

    function insertAfter($target_node_id, $title = ""){

        // Lock table for edit
        $GLOBALS['db']->query("LOCK TABLES " . $this->table . " WRITE",__FILE__,__LINE__);

        // Select data from target node
        $result = $GLOBALS['db']->query("SELECT id, l, r, pid, level, tree_id  FROM " . $this->table . " WHERE id = " . $target_node_id,__FILE__,__LINE__);

        // Hold data in temporary vars
        $row = $result->FetchRow();

        if($result->RecordCount() != 0){

            // Update root node
            $GLOBALS['db']->query("UPDATE " . $this->table . " SET r = r + 2 WHERE (l < " . $row['l'] . " AND r > " . $row['r'] . ") OR l = 1");

            // Send following elements backwards
            $GLOBALS['db']->query("UPDATE " . $this->table . " SET l = l + 2, r = r + 2 WHERE l > " . $row['r']);

            // Set data for the new node
            $l = $row['r'] + 1;
            $r = $l + 1;
            $level = $row['level'];
            $pid = $row['pid'];

            // Insert new node
            $GLOBALS['db']->query("INSERT INTO " . $this->table . " (
                l,
                r,
                pid,
                level,
                title,
                creation_date,
                creation_user,
                mod_date,
                mod_user
            ) VALUES (
                " . $l . ",
                " . $r . ",
                " . $pid . ",
                " . $level . ",
                '" . $title . "',
                " . time() . ",
                " . $_SESSION['user']['id'] . ",
                " . time() . ",
                " . $_SESSION['user']['id'] . "
            )",__FILE__,__LINE__);

        } else {

            // Set error message
            $GLOBALS['error_msg'] = "Target node \"" . $target_node_id . "\" doesn't exist";

        }

        // Unlock tables
        $GLOBALS['db']->query("UNLOCK TABLES",__FILE__,__LINE__);

        return $this->getLastInsertID();
    }

    function insertBefore($target_node_id, $title = ""){

        // Lock table for edit
        $GLOBALS['db']->query("LOCK TABLES " . $this->table . " WRITE",__FILE__,__LINE__);

        // Select data from target node
        $result = $GLOBALS['db']->query("SELECT id, l, r, pid, level, tree_id  FROM " . $this->table . " WHERE id = " . $target_node_id,__FILE__,__LINE__);

        // Hold data in temporary vars
        $row = $result->FetchRow();

        if($result->RecordCount() != 0){

            // Update root node
            $GLOBALS['db']->query("UPDATE " . $this->table . " SET r = r + 2 WHERE (l < " . $row['l'] . " AND r > " . $row['r'] . ") OR l = 1");

            // Send following elements backwards
            $GLOBALS['db']->query("UPDATE " . $this->table . " SET l = l + 2, r = r + 2 WHERE l >= " . $row['l']);

            // Set data for the new node
            $l = $row['l'];
            $r = $l + 1;
            $level = $row['level'];
            $pid = $row['pid'];

            // Insert new node
            $GLOBALS['db']->query("INSERT INTO " . $this->table . " (
                l,
                r,
                pid,
                level,
                title,
                creation_date,
                creation_user,
                mod_date,
                mod_user
            ) VALUES (
                " . $l . ",
                " . $r . ",
                " . $pid . ",
                " . $level . ",
                '" . $title . "',
                " . time() . ",
                " . $_SESSION['user']['id'] . ",
                " . time() . ",
                " . $_SESSION['user']['id'] . "
            )",__FILE__,__LINE__);

        } else {

            // Set error message
            $GLOBALS['error_msg'] = "Target node \"" . $target_node_id . "\" doesn't exist";

        }

        // Unlock tables
        $GLOBALS['db']->query("UNLOCK TABLES",__FILE__,__LINE__);

        return $this->getLastInsertID();
    }

    function updateNode($id, $data){

        $fields = "";
        $first = true;
        foreach($data as $key => $value){
            if($first){
                $fields .= $key . " = '" . $value . "'";
                $first = false;
            } else {
                $fields .= "," . $key . " = '" . $value . "'";
            }
        }

        $fields .=
            " , mod_date = " . time() . "," .
            " mod_user = " . $_SESSION['user']['id'];

        $GLOBALS['db']->query("UPDATE " . $this->table . " SET
        " . $fields . "
        WHERE id = " . $id,__FILE__,__LINE__,1);
    }

    function getLastInsertID(){
        $result = $GLOBALS['db']->query("SELECT id FROM " . $this->table . " ORDER BY id DESC",__FILE__,__LINE__);

        $row = $result->FetchRow();
        return $row['id'];
    }

    function deleteNode($node_id){

        // Lock table for edit
        $GLOBALS['db']->query("LOCK TABLES " . $this->table . " WRITE",__FILE__,__LINE__);

        // Select data from target node
        $result = $GLOBALS['db']->query("SELECT id, l, r, pid, level, tree_id  FROM " . $this->table . " WHERE id = " . $node_id,__FILE__,__LINE__);

        if($result->RecordCount() != 0){

            // Hold data in temporary vars
            $row = $result->FetchRow();

            // Set data for the new node
            $l = $row['l'];
            $r = $row['r'];
            $level = $row['level'];
            $id = $row['id'];
            $diff = $r - $l + 1;

            // Delete node recursive
            $GLOBALS['db']->query("DELETE FROM " . $this->table . " WHERE l >= " . $l . " AND r <= " . $r);

            // Update root node
            $GLOBALS['db']->query("UPDATE " . $this->table . " SET r = r - " . $diff . " WHERE r > " . $r);

            // Update other nodes
            $GLOBALS['db']->query("UPDATE " . $this->table . " SET l = l - " . $diff . " WHERE l > " . $r);

            // Unlock tables
            $GLOBALS['db']->query("UNLOCK TABLES",__FILE__,__LINE__);

            return true;
        } else {

            // Unlock tables
            $GLOBALS['db']->query("UNLOCK TABLES",__FILE__,__LINE__);

            // Set error message
            XT::log("Selected node doesn't exist",__FILE__,__LINE__,XT_ERROR);
            return false;

        }
    }
}

?>