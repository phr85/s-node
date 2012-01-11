<?php
class XT_Search {
    // ID
    var $_keywords_table;
    var $_nonwords_table;
    var $_notfound_table;
    var $_assoc_table;
    var $_infos_table;
	var $_content_types_table;

    var $_nonwords = array();
    var $_wordcounts = 0;
    var $_in = array();
    var $_details_in = 0;
    var $_wordcount = 0;
    var $_profile;
    var $_soundexEnabled = false;
    var $soundexed = array();
    var $resultPosition;
    var $resultLimiter;
    var $searchTerm;
    var $usedTerm;
    var $searchResults = array();
    var $totalResults;
    var $_lang;
    var $_contentType;
    var $_contentDateFrom;
    var $_contentDateTo;
    var $_words;
    var $_content_in;


    // constructor needs content id AND type  AND profile is optional
    function XT_Search($page = 1, $limit = 10, $profile = 'global'){
        $this->resultPosition  = ($page * $limit) - $limit;
        $this->resultLimiter   = $limit;
        $this->_profile = $profile;
        $this->_lang = $GLOBALS['cfg']->get("lang", "default");
        $this->setLang($this->_lang);
        // in array setzen
        $this->_in[] = 0;
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
        $this->_contentType =" AND content_type IN(" . $type . ")";
    }

    function setContentDateFrom($date){
        $this->_contentDateFrom =" AND mod_date>" . $date;
    }

    function setContentDateTo($date){
        $this->_contentDateTo =" AND mod_date<" . $date;
    }

    function search($words, $mode=-1){  //mode 0 = any words, mode 1 = all words must match
        $this->searchTerm = stripslashes($words);
        if ($mode == -1 && substr_count($words, "+") >= 1){
            $mode = 1;
        }else{
            $mode = 0;
        }

        // count searched words
        $this->_wordcount = count( preg_split("/[\W]+/", $words));

        $this->_words = explode (" ", $words);

        // get the ids for the searched words
        $words = $this->_prepareText($words);
        $searcharray = explode (" ", $words);
        foreach ($searcharray as $word){
            $this->_getWordId($word);
        }

        // eingeloggte user sollen auch nicht Public elemente finden dürfen
        if (!empty($_SESSION['user']['auth'])){
            // eingeloggte user ohne limitierung
            $publicsearch = "";
        }else {
            // nicht pulic user
        	$publicsearch = "AND info.public= 1";
        }

        // get the results (IDs)
        $result = XT::query("SET OPTION SQL_BIG_SELECTS = 1");
        $result = XT::query("SELECT info.id ,sum(weight) as weight, count(DISTINCT assoc.kw_id) AS cnt, info.public
        FROM " . $this->_assoc_table . " as assoc , " . $this->_infos_table . " as info
        WHERE assoc.kw_id IN (" . implode(",",$this->_in ) . ")
        AND assoc.info_id = info.id
        AND info.active= 1
        " . $publicsearch . "
        AND (info.valid_from < " . time() . " OR info.valid_from=0)
        AND (info.valid_until > " . time() . " OR info.valid_until=0)
        "  .
        $this->_contentType .
        $this->_contentDateFrom .
        $this->_contentDateTo . "
        GROUP BY info.id ORDER BY cnt desc, weight desc",__FILE__,__LINE__);

        $i=0;
        while($row = $result->FetchRow()){
            $found[$i]['id']     = $row['id'];
            $found[$i]['weight'] = $row['weight'];
            $found[$i]['count']  = $row['cnt'];
            $found[$i]['public'] = $row['public'];
            $i++;
            $this->totalResults ++;
        }


        $preresults = $i;

        if(count($found) > 0){
            if($preresults > $this->resultLimiter){
                $found = array_slice ($found, $this->resultPosition, $this->resultLimiter);
            }

            foreach ($found as $i => $val){
                if(!($mode == 1 && $val['count'] < $this->_wordcount)){
                    $this->_details_in .= ', ' . $val['id'];
                    $this->searchResults[$i]['id'] = $val['id'];
                    $this->searchResults[$i]['weight'] = $val['weight'];
                    $this->searchResults[$i]['count'] = $val['count'];
                    $this->searchResults[$i]['public'] = $val['public'];
                    $hash[$val['id']] = $i;
                }

            }
            $result = XT::query("SELECT si.id, si.title, si.description, si.ext_link, si.content_id, si.content_type, si.mod_date, si.image, ct.open_url, si.public
                                            FROM " . $this->_infos_table . " as si
                                            LEFT JOIN " . $this->_content_types_table . " as ct ON (ct.id = si.content_type)
                                            WHERE si.id IN(" . $this->_details_in . ")",__FILE__,__LINE__);
            while($row = $result->FetchRow()){

                $repl_words = array();
                foreach($this->_words as $key => $value){
                    $repl_words[] = '<span class="sh">' . $value . '</span>';
                }

                $row['title'] = strip_tags($row['title']);
                $row['description'] = strip_tags($row['description']);

                /*
                $row['title'] = str_ireplace($this->_words,$repl_words,$row['title']);
                $row['description'] = str_ireplace($this->_words,$repl_words,$row['description']);
                */

                $this->searchResults[$hash[$row['id']]]['title']        = $row['title'];
                $this->searchResults[$hash[$row['id']]]['description']  = $row['description'];
                $this->searchResults[$hash[$row['id']]]['ext_link']     = $row['ext_link'];
                $this->searchResults[$hash[$row['id']]]['content_id']   = $row['content_id'];
                $this->searchResults[$hash[$row['id']]]['content_type'] = $row['content_type'];
                $this->searchResults[$hash[$row['id']]]['mod_date']     = $row['mod_date'];
                $this->searchResults[$hash[$row['id']]]['open_url']     = $row['open_url'];
                $this->searchResults[$hash[$row['id']]]['image']        = $row['image'];
                $this->searchResults[$hash[$row['id']]]['public']        = $row['public'];

                $this->_content_in .= $row['content_id'] . ',';

                if($row['ext_link'] == NULL){
                    $this->searchResults[$hash[$row['id']]]['url']      = str_replace('%id%',$row['content_id'],$row['open_url']);
                }else{
                    $this->searchResults[$hash[$row['id']]]['url']      = $row['ext_link'];
                }
            }

            $this->_content_in = substr($this->_content_in,0,-1);
        }
    }



        function search_id($words, $mode=-1){  //mode 0 = any words, mode 1 = all words must match
        $this->searchTerm = stripslashes($words);
        if ($mode == -1 && substr_count($words, "+") >= 1){
            $mode = 1;
        }else{
            $mode = 0;
        }

       // count searched words
        $this->_wordcount = count( preg_split("/[\W]+/", $words));

        $this->_words = explode (" ", $words);

        // get the ids for the searched words
        $words = $this->_prepareText($words);
        $searcharray = explode (" ", $words);
        foreach ($searcharray as $word){
            $this->_getWordId($word);
        }

        // eingeloggte user sollen auch nicht Public elemente finden dürfen
        if (!empty($_SESSION['user']['auth'])){
            // eingeloggte user ohne limitierung
            $publicsearch = "";
        }else {
            // nicht pulic user
        	$publicsearch = "AND info.public= 1";
        }

        // get the results (IDs)
        $result = XT::query("SET OPTION SQL_BIG_SELECTS = 1");
        $result = XT::query("SELECT info.id ,sum(weight) as weight, count(DISTINCT assoc.kw_id) AS cnt
        FROM " . $this->_assoc_table . " as assoc , " . $this->_infos_table . " as info
        WHERE assoc.kw_id IN (" . implode(",",$this->_in) . ")
        AND assoc.info_id = info.id
        AND info.active= 1
        AND info.public= 1
        AND (info.valid_from < " . time() . " OR info.valid_from=0)
        AND (info.valid_until > " . time() . " OR info.valid_until=0)
        "  .
        $this->_contentType .
        $this->_contentDateFrom .
        $this->_contentDateTo . "
        GROUP BY info.id ORDER BY cnt desc, weight desc",__FILE__,__LINE__);

        $i=0;
        while($row = $result->FetchRow()){
            $found[$i]     = $row['id'];
            $i++;
            $this->totalResults ++;
        }

        if($this->totalResults > 0){
         $result = XT::query("SELECT si.content_id
                            FROM " . $this->_infos_table . " as si
                            LEFT JOIN " . $this->_content_types_table . " as ct ON (ct.id = si.content_type)
                            WHERE si.id IN(" . implode(",",$found) . ")",__FILE__,__LINE__);

        while($row = $result->FetchRow()){
            $returndata[] = $row['content_id'];
        }
        return $returndata;
        }else {
            return false;
        }
    }

    function _getWordId($word){
        $this->_wordcounts ++;

        $word = trim($word);
        if(strlen($word) < 2){
            return false;
        }
        //make two letters
        $two = (mb_substr($word, 0, 2,"utf-8"));
        // get word from table
        $result = XT::query("SELECT id FROM " . $this->_keywords_table . " WHERE two='" . $two . "' AND kw like '" . $word . "%'",__FILE__,__LINE__);
		 while($row = $result->FetchRow()){
            $this->_in[] = $row['id'];
            XT::query("INSERT INTO " . $this->_found_table . " (id, kw_id, search_date, profile, session_id) VALUES (NULL, '" . $row['id'] . "', '" . TIME . "', '" . $this->_profile . "', '" . session_id() . "')",__FILE__,__LINE__);
            $idfound = true;
        }
        if(!$idfound){
            // if no word found add word to table
            XT::query("INSERT INTO " . $this->_notfound_table . " (id, kw, search_date, profile, session_id) VALUES (NULL, '" . $word . "', '" . TIME . "', '" . $this->_profile . "', '" . session_id() . "')",__FILE__,__LINE__);

            if($this->_soundexEnabled == true){
                $result = XT::query("SELECT id, kw FROM " . $this->_keywords_table . " WHERE two like '" . mb_substr($two, 0, 1,"utf-8") . "%' AND soundex='" . soundex($word) . "'",__FILE__,__LINE__);
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
                    $this->usedTerm = $repl;
                    return $id;

                }
            }else{
                return false;
            }
        }else{
            return true;
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
    //removes special chars from text
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