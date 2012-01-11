<?php

class XT_Story {
    
    /**
     * ID of the article
     *
     * @var int
     */
    var $_id = 0;
    
    /**
     * Has the address entry changed
     *
     * @var boolean
     */
    var $_updated = false;
    
    /**
     * Is this a new address entry
     *
     * @var boolean
     */
    var $_new = true;
    
    /**
     * Is this a deleted address entry
     *
     * @var boolean
     */
    var $_deleted = false;
    
    /**
     * Has data been loaded
     *
     * @var boolean
     */
    var $_dataLoaded = false;
    
    /**
     * Current language
     *
     * @var string
     */
    var $_lang = 'de';
    
    /**
     * Is this article published or not
     *
     * @var boolean
     */
    var $_published = false;
    
    /**
     * Constructor
     *
     * @param int $article_id Article ID
     * @return XT_Article
     */
    function XT_Article($article_id = 0){
        $this->_id = $article_id;
        $this->_lang = XT::getPluginLang();
        if($this->_id > 0){
            $this->_new = false;
        }
        $this->getData();
    }
    
    /**
     * Sets current language
     *
     * @param string $lang
     */
    function setLang($lang){
        $this->_lang = $lang;
    }
    
    /**
     * Get the current language
     *
     * @return string
     */
    function getLang(){
        return $this->_lang;
    }
    
    /**
     * Get ID of the article
     *
     * @return int
     */
    function getID(){
        return $this->_id;
    }
    
    /**
     * Gets the revision history for this article
     *
     * @param int $limit
     * @param string $order
     * @return array Revision history
     */
    function getRevisionHistory($limit = 0, $order = 'DESC'){
        
        $limit_sql = '';
        if($limit > 0){
            $limit_sql = 'LIMIT ' . $limit;
        }
        
        // Get revision history
        $result = XT::query("
            SELECT
                a.rid,
                a.title,
                a.creation_date,
                a.creation_user as creator_id,
                a.mod_date,
                a.mod_user as modifier_id,
                u.username as creator,
                m.username as modifier
            FROM
                " . XT::getDatabasePrefix() . "articles_v as a LEFT JOIN
                " . XT::getDatabasePrefix() . "user as u ON (u.id = a.creation_user) LEFT JOIN
                " . XT::getDatabasePrefix() . "user as m ON (m.id = a.mod_user)
            WHERE
                a.id = " . $this->getID() . " AND
                a.lang = '" . $this->getLang() . "'
            ORDER BY
                a.rid " . $order . "
            " . $limit_sql . "
        ",__FILE__,__LINE__);
        
        $this->_revision_history = array();
        while($row = $result->FetchRow()){
            $this->_revision_history[] = $row;
        }
        
        return $this->_revision_history;
        
    }
    
    /**
     * Get article data
     */
    function getData(){
        
        // Check if data was already loaded or ID is not set
        if(!$this->_dataLoaded && $this->getID() > 0){
            
            // Get data
            $result = XT::query("
                SELECT
                    a.id,
                    a.title,
                    a.subtitle,
                    a.autor,
                    a.introduction,
                    a.maintext,
                    a.creation_date,
                    a.image,
                    a.image_version,
                    a.image_link,
                    a.image_link_target,
                    a.image_zoom,
                    a.rid,
                    a.published,
                    a.active,
                    a.lang,
                    b.type as image_type,
                    b.width,
                    b.height
                FROM
                    " . $GLOBALS['plugin']->getTable("articles_v") . " as a LEFT JOIN 
                    " . XT::getTable('files') . " as b ON (b.id = a.image)
                WHERE
                    a.id = " . $this->getID() . " AND
                    a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
                ORDER BY
                    a.rid DESC
                LIMIT 1
                ",__FILE__,__LINE__);
            
            while($row = $result->FetchRow()){
                $this->_data = $row;
            }
        }
        $this->_dataLoaded = true;
        return $this->_data;
    }
    
    function publish(){
        
    }
    
}

?>