<?php
if(XT::getValue('term') != ''){
XT::loadClass('search.class.php','ch.iframe.snode.search');
    
// EXTEnd search class and overwrite the search function
class CATALOG_SEARCH extends XT_Search {
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
        AND assoc.info_id = info.id" .
        $this->_contentType .
        $this->_contentDateFrom .
        $this->_contentDateTo . "
        GROUP BY info.id ORDER BY cnt desc, weight desc",__FILE__,__LINE__);

        $i=0;
        while($row = $result->FetchRow()){
            $found[$i]['id']     = $row['id'];
            $found[$i]['weight'] = $row['weight'];
            $found[$i]['count']  = $row['cnt'];
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
                    $hash[$val['id']] = $i;
                }

            }
            $result = XT::query("SELECT si.id, si.title, si.description, si.ext_link, si.content_id, si.content_type, si.mod_date, si.image, ct.open_url
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
}



$search = new CATALOG_SEARCH();
    
    $search->setContentType(XT::getContentType("Recipe"));
    $search->enableSoundex(true);
    $search->setLang(XT::getValue('lang_filter'));
    $search->search(XT::getValue('term'));
    XT::assign("SEARCHTERM",XT::getValue('term'));
    
    // Get results
    if($search->_content_in != ''){
        $result = XT::query("
            SELECT
                r.title,
                i.image_id,
                r.id
            FROM
                " . XT::getTable('r_details') . " as r
                LEFT JOIN
                 " . XT::getTable('images') . "  as i on (i.recipe_id = r.id AND i.is_main_image = 1)
                 
            WHERE
                lang = '" . XT::getPluginLang() . "' AND
                id IN (" . $search->_content_in . ")
            GROUP BY
                id
        ",__FILE__,__LINE__);
        
        $results = array();
        while($row = $result->FetchRow()){
            $results[] = $row;
        }
        
        XT::assign("RECIPE", $results);
    }
}

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build('search_recipes.tpl');

?>