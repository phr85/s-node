<?php
/**
 * USAGE:
 * $object = new XT_SearchIndex(int id,int type,[profile as string]);
 * // add texts
 * $object->add(string ad string, weight as int)
 * // if document links to an external page
 * $object->link(link as string);
 * // finaly build the index
 * $object->build(title as string, lead as string);
 * Attention: make a new object for every search content_type:content_id pair
 *
 * Other functions:
 * // delete completly from index
 * $object->delete();
 * // activate for searching
 * $object->enable();
 * // remove from search
 * $object->disable();
 * TODO: Find links function
 *
 * @package Search
 * @author Veith Zäch <vzaech@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: searchindex.class.php 4806 2008-04-07 14:25:33Z vzaech $
 */

class XT_SearchIndex {
    var $content_id;
    var $content_type;
    var $content_link = '';
    var $_keywords_table;
    var $_nonwords_table;
    var $_nonwords = array();
    var $textblob = array();
    var $_replacements = array();
    var $_assoc_table;
    var $_infos_table;
    var $_info_id = 0;
    var $_fillerArray = array();
    var $_lang;
    var $_profile;
    var $_is_public = 0;
    var $_valid_from = 0;
    var $_valid_until = 0;
    var $_manual_date = 0;


    // constructor needs content id AND type  AND profile is optional
    function XT_SearchIndex($content_id, $content_type, $is_public=0, $profile = 'global'){
        $this->content_id      = $content_id;
        $this->content_type    = $content_type;
        $this->_profile        = $profile;
        $this->setLang($GLOBALS['cfg']->get("lang", "default"));
        if($is_public ==1){
            $this->_setPublic();
        }
    }

    function _setPublic(){
        $this->_is_public = 1;
    }

    function _unSetPublic(){
        $this->_is_public = 0;
    }

    function _initTables(){
        $this->_assoc_table    = $GLOBALS['cfg']->get("database", "prefix") . 'search_assoc_' . $this->_profile . "_" . $this->_lang;
        $this->_infos_table    = $GLOBALS['cfg']->get("database", "prefix") . 'search_infos_' . $this->_profile . "_" . $this->_lang;
        $this->_nonwords_table = $GLOBALS['cfg']->get("database", "prefix") . 'search_nonwords' . "_" . $this->_lang;
        $this->_keywords_table = $GLOBALS['cfg']->get("database", "prefix") . 'search_keywords' . "_" . $this->_lang;
        $this->_initNonwords();
    }

    function setSys(){
        $this->setLang('sys');
    }

    function setTime($valid_from,$valid_until){
        $this->_valid_from = $valid_from;
        $this->_valid_until = $valid_until;
    }

    function setManualDate($date){
        if(is_numeric($date)){
            $this->_manual_date = $date;
        }
    }

    // Set Language
    function setLang($lang){
        $this->_lang = $lang;
        $this->_initTables();

    }

    // adds more keywords to an existing Index
    // use $this->add() for adding
    function pushToIndex(){
        $this->_setInfoID();
        // build fillerarray, weights
        foreach ($this->textblob as $weight => $textblob){
            $wordlist = explode (" ", $textblob);
            foreach ($wordlist as $word) {
                // skip if entry is asci 0
                if (ord($word) == 0) {
                    continue;
                }
                $word_id = $this->_getWordId($word);
                if($word_id > 0){
                    $this->_fillerArray[$word_id] += $weight;
                }
            }
        }

        // insert data
        foreach ($this->_fillerArray as $word_id => $weight) {
            // get assoc
            $assoc = $this->_getAssoc($word_id);
            // adds existing assoc weight
            $weight += $assoc;
            // update existing or insert new assoc
            if($assoc == 0){
                $this->_setAssoc($word_id , $weight);
            }
            else{
                // $this->_updateAssoc($word_id , $weight);
            }
        }

    }


    function _getAssoc($word_id){
        $result = XT::query("SELECT weight FROM " . $this->_assoc_table . "
                              WHERE
                                  info_id=" . $this->_info_id . "
                              AND
                                  kw_id=" . $word_id,__FILE__,__LINE__);
        $weight = $result->FetchRow();
        return $weight['weight'];
    }


    function _updateAssoc($word_id, $weight){
        XT::query("UPDATE " . $this->_assoc_table . "
                              SET
                                  weight=" . $weight . "
                              WHERE
                                  info_id=" . $this->_info_id . "
                              AND
                                  kw_id=" . $word_id
        ,__FILE__,__LINE__);
    }


    // for a new document IN the same profile use this function
    function nextDocument($content_id, $content_type){
        $this->content_id      = $content_id;
        $this->content_type    = $content_type;
        $this->_info_id = 0;
        $this->content_link = '';
        $this->textblob = array();
        $this->_replacements = array();
        $this->_fillerArray = array();
    }
    // if document links to somethin other then content ID AND Type set link
    function link($link){
        $this->content_link = $link;
    }

    // add text AND giv weight, default weight is 1, max value of weight is 5
    function add($text, $weight=1){
        if ($weight > 5){
            $weight = 5;
        }
        $this->textblob[$weight] .= " " . $this->_prepareText($text);
    }

    function addSuperIndex($text, $weight=100){
        if ($weight > 500){
            $weight = 500;
        }
        if ($weight < 100){
            $weight = 100;
        }
        $this->textblob[$weight] .= $this->_prepareText($text);
    }

    // delete entries IN assoc AND info table
    function delete(){
        $this->_setInfoID();
        if($this->_info_id > 0){
            //DELETE FROM infos
            XT::query("DELETE FROM " . $this->_infos_table . " WHERE id=" . $this->_info_id,__FILE__,__LINE__);
            //DELETE FROM assoc
            XT::query("DELETE FROM " . $this->_assoc_table . " WHERE info_id=" . $this->_info_id,__FILE__,__LINE__);
            XT::query("DELETE FROM " . XT::getDatabasePrefix() . "relations
            WHERE (content_id=" . $this->content_id . " AND content_type=" . $this->content_type . ") OR (target_content_type=" . $this->content_type . " AND target_content_id=" . $this->content_id . ")"
            ,__FILE__,__LINE__);
        }
    }

    // activate entry IN info table
    function enable(){
        XT::query("UPDATE " . $this->_infos_table . " SET active= 1 WHERE content_id=" . $this->content_id . " AND content_type=" . $this->content_type,__FILE__,__LINE__);

    }

    // deactivate entry IN info table
    function disable(){
        XT::query("UPDATE " . $this->_infos_table . " SET active= 0 WHERE content_id=" . $this->content_id . " AND content_type=" . $this->content_type,__FILE__,__LINE__);
    }

    function setImage($image){
        // update existing info entry
        $this->_setInfoID();
        XT::query("UPDATE " . $this->_infos_table . " SET image='" . $image . "' WHERE id=" . $this->_info_id,__FILE__,__LINE__);

    }

    // AND finaly build the index
    function build($title, $lead, $image = 0){
        $this->textblob[10] = $this->_prepareText($title);
        $this->textblob[6] = $this->_prepareText($lead);

        $this->_setInfoID();
        if($this->_info_id > 0){
            // update existing info entry
            $image = $image + 0;
            XT::query("UPDATE " . $this->_infos_table . " SET title='" . $title . "', description='" . $lead . "', active= 1, image=" . $image . ", ext_link= '" . $this->content_link . "' , mod_date=" . TIME . ", mod_user=" . XT::getUserID() . ", public = " . $this->_is_public . " , valid_from = " . $this->_valid_from . " , valid_until = " . $this->_valid_until . " , manual_date = " . $this->_manual_date . "  WHERE id=" . $this->_info_id,__FILE__,__LINE__);
        }else{
            // Insert new info entry
            XT::query("INSERT INTO " . $this->_infos_table . " (id, title, description, active, ext_link, content_id, content_type, mod_date, mod_user, creation_date, creation_user, image, public, valid_from, valid_until, manual_date)
                                  VALUES (NULL, '" . addslashes($title) . "', '" . addslashes($lead) . "', 1, '" . $this->content_link . "', " . $this->content_id . ", " . $this->content_type . ", " . TIME . ", " . XT::getUserID() . ", " . TIME . ", " . XT::getUserID() . ", " . $image . "," . $this->_is_public  . "," . $this->_valid_from  . "," . $this->_valid_until . "," . $this->_manual_date . ")",__FILE__,__LINE__);
            $this->_setInfoID();
        }

        $this->_clearAssoc();
        // build fillerArray for each weight value
        foreach ($this->textblob as $weight => $textblob){
            $wordlist = explode (" ", $textblob);
            foreach ($wordlist as $word) {
                // skip if entry is asci 0
                if (ord($word) == 0) {
                    continue;
                }
                $word_id = $this->_getWordId($word);
                if($word_id > 0){
                    $this->_fillerArray[$word_id] += $weight;
                }
            }
        }
        // insert data
        foreach ($this->_fillerArray as $word_id => $weight) {
            $this->_setAssoc($word_id , $weight);
        }

    }

    function _setAssoc($word_id, $weight){
        XT::query("INSERT INTO " . $this->_assoc_table . " (info_id, kw_id, weight)
                              VALUES (" . $this->_info_id . ", " . $word_id . ", " . $weight . ")",__FILE__,__LINE__);
    }

    function _setInfoID(){
        //Get info_id
        $result = XT::query("SELECT id from " . $this->_infos_table . " WHERE content_id=" . $this->content_id . " AND content_type=" . $this->content_type,__FILE__,__LINE__);
        while($id = $result->FetchRow()){
            $this->_info_id = $id['id'];
        }
    }


    function _clearAssoc(){
        if($this->_info_id > 0){
            XT::query("DELETE FROM " . $this->_assoc_table . " WHERE info_id=" . $this->_info_id,__FILE__,__LINE__);
            return true;
        }else{
            return false;
        }
    }

    function _getWordId($word){
        $word = $this->_prepareText($word);
        if(strlen($word) < 2){
            return false;
        }
        //make two letters
        $two = (mb_substr($word, 0, 2,'UTF-8'));
        // get word from table
        $result = XT::query("SELECT id FROM " . $this->_keywords_table . " WHERE two='" . $two . "' AND kw='" . $word . "'",__FILE__,__LINE__);
        $id = $result->FetchRow();

        if(!$id){
            // if no word found add word to table
            XT::query("INSERT INTO " . $this->_keywords_table . " (id, two, kw, soundex) VALUES (NULL, '" . $two . "', '" . $word . "', '" . soundex($word) . "')",__FILE__,__LINE__);
            $result = XT::query("SELECT id FROM " . $this->_keywords_table . " ORDER BY id DESC LIMIT 1");
            $data = array();
            while($row = $result->fetchrow()){
                $data[] = $row;
            }
            return $data[0]['id'];
        }else{
            // return Word ID
            return $id['id'];
        }
    }

    // build the nonwords array
    function _initNonwords(){
        $result = XT::query("SELECT kw FROM " . $this->_nonwords_table,__FILE__,__LINE__);
        if($result){
            while($word = $result->FetchRow()){
                $this->_nonwords = $word['kw'];
            }
        }

    }

    //removes special chars from text
    function _prepareText($text){
        // extract links from text
        $text = $this->_findLinks($text);
        $this->_replacements = array('[', ']','/','<', '>', '{',  '}', "\n", "\t", "\r", "\s", "\x0B", '(', ')', '-', '_', '=', '"', '.', ',', '!', '?', ':', "\\\'","\'","'",'\'',"\\",
        "&quot;");

        $text = trim ($text);
        $text = str_replace(">","> ",$text);
        $text = strip_tags($text);
        $text = str_replace ($this->_nonwords, ' ', $text);
        $text = str_replace ($this->_replacements, ' ', $text);
        $text = mb_strtolower($text,"utf-8");
        $text = html_entity_decode($text);
        return $text;
    }


    function _findLinks($text){
        $text = stripslashes($text);
        // find links IN text
        $aMatches = array();

        preg_match_all('/<a[^>]+href\s*=\s*\"([^\"]+)\"\s*>([^\<]+)<\/a>/i',$text,$aMatches,PREG_SET_ORDER);

        foreach( $aMatches as $link ) {
            $text = str_replace($link[1],'',$text);
            //echo "<b>Text:</b> " . $link[2] . "<br /><b>Link:</b> " . $link[1] . "<br /><br />";

            $GLOBALS['db']->query("INSERT INTO " . XT::getDatabasePrefix() . "links SET link= '" . addslashes($link[1]) . "', status= 0, link_title= '" . addslashes($link[2]) . "'");
            $result = XT::query("SELECT id from " . XT::getDatabasePrefix() . "links WHERE link= '" . addslashes($link[1]) . "'", __FILE__, __LINE__);
            $link_id = $result->FetchRow();
            $GLOBALS['db']->query("INSERT INTO " . XT::getDatabasePrefix() . "links_rel SET link_id=" .  $link_id['id'] . ", content_type=" . $this->content_type . " , content_id=" . $this->content_id);

        }
        // remove mail addresses
        return $text;
    }

}
?>