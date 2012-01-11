<?php
class XT_Search_Sys {
    // ID
    var $_keywords_table;
    var $_nonwords_table;
    var $_notfound_table;
    var $_assoc_table;
    var $_infos_table;
	var $_content_types_table;

    var $_nonwords = array();
    var $_wordcounts = 0;
    var $_in = 0;
    var $details_in = 0;
    var $_wordcount = 0;
    var $_profile;
    var $_soundexEnabled = false;
    var $soundexed = array();
    var $resultPosition;
    var $resultLimiter;
    var $searchTerm;
    var $searchResults = array();
    var $totalResults;
    var $_lang;
    var $_contentType;
    var $_contentDateFrom;
    var $_contentDateTo;

    // constructor needs content id AND type  AND profile is optional
    function XT_Search_Sys($page = 1, $limit = 10, $profile = 'global'){
        $this->resultPosition  = ($page * $limit) - $limit;
        $this->resultLimiter   = $limit;
        $this->_profile = $profile;
        $this->_lang = 'sys';
        $this->setLang($this->_lang);
    }

    function setLang($lang){
        $this->_lang = $lang;
        $this->_initTables();
    }

    function _initTables(){
        $this->_assoc_table    = $GLOBALS['cfg']->get("database", "prefix") . 'search_assoc_' . $this->_profile . "_" . $this->_lang;
        $this->_infos_table    = $GLOBALS['cfg']->get("database", "prefix") . 'search_infos_' . $this->_profile . "_" . $this->_lang;
        $this->_content_types_table    = $GLOBALS['cfg']->get("database", "prefix") . 'content_types';
        $this->_nonwords_table = $GLOBALS['cfg']->get("database", "prefix") . 'search_nonwords' . "_" . $this->_lang;
        $this->_keywords_table = $GLOBALS['cfg']->get("database", "prefix") . 'search_keywords' . "_" . $this->_lang;
        $this->_notfound_table = $GLOBALS['cfg']->get("database", "prefix") . 'search_notfound' . "_" . $this->_lang;
        $this->_found_table    = $GLOBALS['cfg']->get("database", "prefix") . 'search_found' . "_" . $this->_lang;
        $this->_initNonwords();
    }

    function enableSoundex($bool){
        $this->_soundexEnabled = $bool;
    }

    function setContentType($type){
        $this->_contentType ="AND content_type IN(" . $type . ")";
    }

    function setContentDateFrom($date){
        $this->_contentDateFrom ="AND mod_date>" . $date;
    }

    function setContentDateTo($date){
        $this->_contentDateTo ="AND mod_date<" . $date;
    }

    function search($words, $mode=-1){  //mode 0 is with at least 1 hit, mode 1 is restricted, all words must match
        $this->searchTerm = stripslashes($words);
        if ($mode == -1 && substr_count($words, "+") >= 1){
            $mode = 1;
        }else{
            $mode = 0;
        }

        // count searched words
        $this->_wordcount = count( preg_split("/[\W]+/", $words));

        // get the ids for the searched words
        $words = $this->_prepareText($words);
        $searcharray = explode (" ", $words);
        foreach ($searcharray as $word){
            $word_id = $this->_getWordId($word);
            if($word_id){
                $this->_in .= ', ' . $word_id;
            }
        }
        // get the results (IDs)
        $result = XT::query("SET OPTION SQL_BIG_SELECTS = 1");
        $result = XT::query("SELECT info.id ,sum(weight) as weight, count(DISTINCT assoc.kw_id) AS cnt
        FROM " . $this->_assoc_table . " as assoc , " . $this->_infos_table . " as info
        WHERE assoc.kw_id IN (" . $this->_in . ")
        AND assoc.info_id = info.id
        AND info.active= 1
        AND info.public= 1" .
        $this->_contentType .
        $this->_contentDateFrom .
        $this->_contentDateTo . "
        GROUP BY info.id ORDER BY cnt desc, weight desc",__FILE__,__LINE__);
		$found=array();
        $i=0;
	        while($row = $result->FetchRow()){
	            $found[$i]['id']     = $row['id'];
	            $found[$i]['weight'] = $row['weight'];
	            $found[$i]['count']  = $row['cnt'];
	            $i++;
	        }
        $preresults = $i;

        if(count($found) > 0){
            if($preresults > $this->resultLimiter){
                $found = array_slice ($found, $this->resultPosition, $this->resultLimiter);
            }

            foreach ($found as $i => $val){
                if(!($mode == 1 && $val['count'] < $this->_wordcount)){
                    $this->details_in .= ', ' . $val['id'];
                    $this->searchResults[$i]['id'] = $val['id'];
                    $this->searchResults[$i]['weight'] = $val['weight'];
                    $this->searchResults[$i]['count'] = $val['count'];
                    $hash[$val['id']] = $i;
                    $this->totalResults ++;
                }

            }
            $result = XT::query("SELECT si.id, si.title, si.description, si.ext_link, si.content_id, si.content_type, si.mod_date, si.image, ct.open_url
                                            FROM " . $this->_infos_table . " as si
                                            LEFT JOIN " . $this->_content_types_table . " as ct ON (ct.id = si.content_type)
                                            WHERE si.id IN(" . $this->_details_in . ")",__FILE__,__LINE__);
            while($row = $result->FetchRow()){
                $this->searchResults[$hash[$row['id']]]['title']        = $row['title'];
                $this->searchResults[$hash[$row['id']]]['description']  = $row['description'];
                $this->searchResults[$hash[$row['id']]]['ext_link']     = $row['ext_link'];
                $this->searchResults[$hash[$row['id']]]['content_id']   = $row['content_id'];
                $this->searchResults[$hash[$row['id']]]['content_type'] = $row['content_type'];
                $this->searchResults[$hash[$row['id']]]['mod_date']     = $row['mod_date'];
                $this->searchResults[$hash[$row['id']]]['open_url']     = $row['open_url'];
                $this->searchResults[$hash[$row['id']]]['image']        = $row['image'];

                if($row['ext_link'] == NULL){
                    $this->searchResults[$hash[$row['id']]]['url']      = str_replace('%id%',$row['content_id'],$row['open_url']);
                }else{
                    $this->searchResults[$hash[$row['id']]]['url']      = $row['ext_link'];
                }
            }
        }
    }

    function _getWordId($word){
        $this->_wordcounts ++;

        $word = trim($word);
        if(strlen($word) < 2){
            return false;
        }
        //make two letters
        $two = (substr($word, 0, 2));
        // get word from table
        $result = XT::query("SELECT id FROM " . $this->_keywords_table . " WHERE two='" . $two . "' AND kw='" . $word . "'",__FILE__,__LINE__);
		$id = $result->FetchRow();

        if(!$id){
            // if no word found add word to table
            XT::query("INSERT INTO " . $this->_notfound_table . " (id, kw, search_date, profile, session_id) VALUES (NULL, '" . $word . "', '" . TIME . "', '" . $this->_profile . "', '" . session_id() . "')",__FILE__,__LINE__);

            if($this->_soundexEnabled == true){
                $result = XT::query("SELECT id, kw FROM " . $this->_keywords_table . " WHERE two like '" . $two[0] . "%' AND soundex='" . soundex($word) . "'");
                $row = $result->FetchRow();
                if(!$row){
                    return false;
                }else{
                    $minval = 10000;
                    $val = levenshtein($word, $row['kw']);
                    if($val < $minval){
                        $repl = $row['kw'];
                        $id   = $row['id'];
                        $minval = $val;
                    }
                    $this->soundexed[$this->_wordcounts]["alternatives"][] = array("word" => $row['kw'], "distance" => $val);
                    $this->soundexed[$this->_wordcounts]["original"] = $word;
                    $this->soundexed[$this->_wordcounts]["value"] = soundex($word);
                    $this->soundexed[$this->_wordcounts]["replacement"] = $repl;

                    return $id;
                }
            }else{
                return false;
            }
        }else{
        // return Word ID

        // if no word found add word to table
        XT::query("INSERT INTO " . $this->_found_table . " (id, kw_id, search_date, profile, session_id) VALUES (NULL, '" . $id['id'] . "', '" . TIME . "', '" . $this->_profile . "', '" . session_id() . "')",__FILE__,__LINE__);

        return $id['id'];
        }
    }

    // build the nonwords array
    function _initNonwords(){
        $result = XT::query("SELECT kw FROM " . $this->_nonwords_table,__FILE__,__LINE__);

        if($result){
            $fcontents = array();
            while($word = $result->FetchRow()){
                $this->_nonwords = $word['kw'];
            }
        }
    }
   function _prepareText($text){
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
}
?>