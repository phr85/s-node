<?php
class XT_Chapter {

    var $plugin;
    var $table;

    function XT_Chapter(&$plugin, $table){
        $this->plugin = &$plugin;
        $this->table = $table;
    }

    // Adds a chapter
    function addChapter($id, $maxlevel=0){
        if($maxlevel == 0){
            $result = XT::query("SELECT MAX(level) as level FROM " . $this->plugin->getTable($this->table) . " WHERE id =" . $id,__FILE__,__LINE__);
            if($result){
                $row = $result->FetchRow();
                $maxlevel = $row['level'];
            }
        }
        $result = XT::query("INSERT INTO " . $this->plugin->getTable($this->table) .
                  " (id, level, active) VALUES (" . $id . ", " . ($maxlevel+1) . ", 1" . ")",__FILE__,__LINE__);
        return true;
    }

    // Activates/Deactivates the chapter
    function deactivateChapter($id, $level){
        $result = XT::query("UPDATE " . $this->plugin->getTable($this->table) . " SET active=0 where id =" . $id . " AND level=" . $level,__FILE__,__LINE__);
        return true;
    }

    // Activates/Deactivates the chapter
    function activateChapter($id, $level){
        $result = XT::query("UPDATE " . $this->plugin->getTable($this->table) . " SET active=1 where id =" . $id . " AND level=" . $level,__FILE__,__LINE__);
        return true;
    }

    // Deletes the chapter
    function deleteChapter($id, $level) {
        // Lock table for edit
        XT::query("LOCK TABLES " . $this->plugin->getTable($this->table) . " WRITE",__FILE__,__LINE__);

        //Delete a chapter
        $result = XT::query("DELETE FROM " . $this->plugin->getTable($this->table) .
                  " WHERE id= " . $id . " AND level= " . $level,__FILE__,__LINE__);
        //Set chapterlevel in right order
        $result = XT::query("UPDATE " . $this->plugin->getTable($this->table) . " SET level = (level-1) WHERE level > " . $level . " AND id=" . $id . " order by level desc",__FILE__,__LINE__);

        // Unlock tables
        XT::query("UNLOCK TABLES",__FILE__,__LINE__);
        return true;
    }

    // Copy a chapter on a set level
    function copyChapter($id, $newlevel, $origlevel){
        $result = XT::query("SELECT active, title, subtitle, maintext FROM " . $this->plugin->getTable($this->table) . " WHERE id =" . $id . " AND level=" . $origlevel,__FILE__,__LINE__);
        $row = $result->FetchRow();

        // Lock table for edit
        XT::query("LOCK TABLES " . $this->plugin->getTable($this->table) . " WRITE",__FILE__,__LINE__);
        // Edit
        $result = XT::query("UPDATE " . $this->plugin->getTable($this->table) . " SET level = (level+1) WHERE level > " . $newlevel . " AND id=" . $id . " order by level desc",__FILE__,__LINE__);
        $result = XT::query("INSERT INTO " . $this->plugin->getTable($this->table) .
                  " (id, level, active, title, subtitle, maintext) VALUES (" . $id . ", " . ($newlevel+1) . ", " . $row['active'] . ", '" . $row['title']. "', '" . $row['subtitle']. "', '" . $row['maintext'] . "')",__FILE__,__LINE__);

        // Unlock tables
        XT::query("UNLOCK TABLES",__FILE__,__LINE__);
        return true;
    }
    // Paste a cutted chapter on a set level
    function cuttedChapter($id, $newlevel, $origlevel){
        // Lock table for edit
        XT::query("LOCK TABLES " . $this->plugin->getTable($this->table) . " WRITE",__FILE__,__LINE__);

        $result = XT::query("UPDATE " . $this->plugin->getTable($this->table) . " SET level = (level+1) WHERE level > " . $newlevel . " AND id=" . $id . " order by level desc",__FILE__,__LINE__);
        if($newlevel < $origlevel){
            $result = XT::query("UPDATE " . $this->plugin->getTable($this->table) . " SET level = " . ($newlevel+1) . " WHERE level = " . ($origlevel+1) . " AND id=" . $id,__FILE__,__LINE__);
        }else{
            $result = XT::query("UPDATE " . $this->plugin->getTable($this->table) . " SET level = " . ($newlevel+1) . " WHERE level = " . $origlevel . " AND id=" . $id,__FILE__,__LINE__);
        }
        $result = XT::query("UPDATE " . $this->plugin->getTable($this->table) . " SET level = (level-1) WHERE level > " . $origlevel . " AND id=" . $id . " order by level asc",__FILE__,__LINE__);

        // Unlock tables
        XT::query("UNLOCK TABLES",__FILE__,__LINE__);
        return true;
    }
}

?>