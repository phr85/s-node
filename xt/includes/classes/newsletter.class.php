<?php

class XT_Newsletter {
    
    var $_id = 0;
    
    function XT_Newsletter($id = 0){
        
        if($id > 0){
            $this->_id = $id;
        }
        
    }
    
    function create(){
        include_once(PLUGIN_DIR . "ch.iframe.snode.newsletter/includes/headerconfig.inc.php");
        XT::query("
            INSERT INTO
                " . XT::getDatabasePrefix() . "newsletter
            (
                creation_date,
                creation_user,
                header,
                header_plain,
                footer,
                footer_plain,
				lang
            ) VALUES (
                " . time() . ",
                " . XT::getUserID() . ",
                '" . addslashes($header['html']) . "',
                '" . addslashes($header['plain']) . "',
                '" . addslashes($footer['html']) . "',
                '" . addslashes($footer['plain']) . "',
				'" . $GLOBALS['cfg']->get('lang','default') . "'
                
            )
        ",__FILE__,__LINE__);
        
        $result = XT::query("
            SELECT
                id
            FROM
                " . XT::getDatabasePrefix() . "newsletter
            ORDER BY
                id DESC
        ",__FILE__,__LINE__);
        
        while($row = $result->FetchRow()){
            return $row['id'];
        }
    }
    
    function delete(){
        XT::query("
            DELETE FROM
                " . XT::getDatabasePrefix() . "newsletter
            WHERE
                id = " . $this->_id . "
        ",__FILE__,__LINE__);
    }
    
    function send(){
        
        
        
    }
    
}

?>