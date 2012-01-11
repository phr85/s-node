<?php
//$nestedset->insertNodeAtBeginning(159, 'Unterpunkt');
/*
$id = $nestedset->insertNodeAtBeginning(237, 'About');
$id = $nestedset->insertNodeAtBeginning($id, 'Team');
$nestedset->insertNodeAtBeginning($id, 'Development');
*/

/*
$id = $nestedset->insertNodeAtBeginning(120, 'About');
$nestedset->insertNodeAtBeginning($id, 'Company');
$nestedset->insertNodeAtBeginning($id, 'Team');
*/
/*
$navigation->addProfile('Default');
$navigation->addProfile('Toolbox');
$navigation->addProfile('S-Node');
*/

class navigation {

    var $plugin;
    var $nestedSet;
    var $in = '';
    var $pages_in = '';


    function navigation(&$plugin){
    //    $GLOBALS['plugin']-> = &$plugin;
    }

    function setNestedSet(&$nestedSet){
        $this->nestedSet = &$nestedSet;
    }
    function addProfile($title){
        $id = $this->nestedSet->insertNodeAtEnd(1, $title);

        // build data
        $data = array(
            'isProfile' => 1
        );

        $this->nestedSet->updateNode($id, $data);
        return $id;
    }

    function getProfiles(){
        $result = $GLOBALS['db']->query("SELECT id, title FROM " . $GLOBALS['plugin']->getTable("navigation") . " WHERE level = 2 ORDER BY title ASC",__FILE__,__LINE__);

        $data = array();
        while($row = $result->FetchRow()){
            $data[] = $row;
        }

        return $data;
    }

    function getTree($active = ''){

        if($GLOBALS['plugin']->getValue("profile") != '' && ($GLOBALS['plugin']->getValue("profile") != $GLOBALS['plugin']->getSessionValue('profile'))){
            $active = $GLOBALS['plugin']->getValue("profile");
            $GLOBALS['plugin']->setSessionValue('profile', $active);
            $GLOBALS['plugin']->setSessionValue('open', $active);
        }
        if($active == ''){
            if($GLOBALS['plugin']->getSessionValue('profile') != ''){
                $active = $GLOBALS['plugin']->getSessionValue('profile');
            } else {
                $active = $this->getDefaultProfile();  // ID of the default profile
                $GLOBALS['plugin']->setSessionValue('profile', $active);
            }
            $GLOBALS['plugin']->setSessionValue('open', $active);
        }

        // Get the way
        $result = XT::query("SELECT n1.id, COUNT(n1.id) AS level
        FROM
            " . $GLOBALS['plugin']->getTable("navigation") . " AS n1,
            " . $GLOBALS['plugin']->getTable("navigation") . " AS n3
        WHERE
            n3.id = " . $active . "
            AND n1.l <= n3.l
            AND n1.r >= n3.r
            AND n1.level > 1
            AND (n1.level <= n3.level OR (n1.l > n3.l && n1.r < n3.r))
        GROUP BY
            n1.ID
        ORDER BY
            n1.l
        ",__FILE__,__LINE__);

        // Empty in that results as e.g. 1,2,23,54
        $this->in = '';
        $way = array();
        while ($row = $result->FetchRow()){
           $this->in .= ', ' . $row['id'] ;
           $way[] = $row['id'];
        }

        // Strip away first comma
        $this->in = @substr($this->in, 1);

        // Empty data array
        $data = array();

        // Check for a lang filter
        $lang_filter = "";
        if($GLOBALS['plugin']->getValue("lang_filter") != ''){
            if($GLOBALS['plugin']->getValue("lang_filter") == 'none'){
                $GLOBALS['plugin']->unsetSessionValue("lang_filter");
            } else {
                $GLOBALS['plugin']->setSessionValue("lang_filter", $GLOBALS['plugin']->getValue("lang_filter"));
            }
        }
        if($GLOBALS['plugin']->getSessionValue("lang_filter") != ''){
            $lang_filter = $GLOBALS['plugin']->getSessionValue("lang_filter");
        }

        // Are there parent elements ?
        if($this->in != ''){

            // Get tree
            $result = XT::query("SELECT main.id, main.pid, details.title, details_opt.title as title_opt, details_opt.ext_link, details_opt.target, floor(( main.r - main.l) / 2) AS subs, main.level, main.active, main.l, main.r, details_opt.public
                FROM
                    " . $GLOBALS['plugin']->getTable("navigation") . " AS main LEFT JOIN
                    " . $GLOBALS['plugin']->getTable("navigation_details") . " AS details ON (details.nav_id = main.ID AND details.lang = '" . $GLOBALS['cfg']->get("lang", "default") . "'),

                    " . $GLOBALS['plugin']->getTable("navigation") . " AS main_opt LEFT JOIN
                    " . $GLOBALS['plugin']->getTable("navigation_details") . " AS details_opt ON (details_opt.nav_id = main.ID AND details_opt.lang = '" . $lang_filter . "')

                WHERE
                    main.pid in (" . $this->in . ")
                    AND main.level > 2
                GROUP BY
                    main.l
                ORDER BY main.l
            ",__FILE__,__LINE__);

            // Fill tree data
            $i = 0;
            while ($row = $result->FetchRow()){
                $data[$i]['title'] = &$row['title'];
                if($row['title_opt'] != ''){
                    $data[$i]['title'] = &$row['title_opt'];
                    $data[$i]['isFilter'] = true;
                    $data[$i]['class'] = 'filter';
                } else {
                    $data[$i]['isFilter'] = false;
                }
                if($data[$i]['title'] == ''){
                    $data[$i]['title'] = "<i>[ NA ]</i>";
                }
                $data[$i]['public'] = &$row['public'];
                $data[$i]['id'] = &$row['id'];
                $data[$i]['pid'] = &$row['pid'];
                $data[$i]['subs'] = &$row['subs'];
                $data[$i]['level'] = &$row['level'];
                $data[$i]['active'] = &$row['active'];
                $data[$i]['ext_link'] = &$row['ext_link'];
                $data[$i]['target'] = &$row['target'];
                $data[$i]['itw'] = in_array($row['id'], $way);
                if($data[$i]['itw']){
                    if($data[$i]['isFilter']){
                        $data[$i]['class'] = 'filter_itw';
                    } else {
                        $data[$i]['class'] = 'itw';
                    }
                }
                $data[$i]['activenode'] = $row['id'] == $active;
                $data[$i]['ext_link'] = &$row['ext_link'];
                $this->pages_in .= ', ' . $row['id'];
                $i++;
            }
            // Strip away first comma
            $this->pages_in = @substr($this->pages_in, 1);
        }

        return $data;
    }

    function getLangsAvailable(){
        $langs = array();
        foreach($GLOBALS['cfg']->getLangs() as $key => $value){
            $langs[$key] = array();
        }
        if($this->pages_in != ''){
            $result = $GLOBALS['db']->query("SELECT nav_id, lang, active FROM " . $GLOBALS['plugin']->getTable("navigation_details") . " as a
            WHERE nav_id IN (" . $this->pages_in . ")
            ",__FILE__,__LINE__);
            while($row = $result->FetchRow()){
                if($row['active']){
                    $langs[$row['lang']][$row['nav_id']] = 1;
                } else {
                    $langs[$row['lang']][$row['nav_id']] = 2;
                }
            }
        }
        return $langs;
    }

    function getLangsAvailableById($id){
        $langs = array();
        $result = $GLOBALS['db']->query("SELECT nav_id, lang, active FROM " . $GLOBALS['plugin']->getTable("navigation_details") . " as a
        WHERE nav_id = " . $id . "
        ",__FILE__,__LINE__);
        while($row = $result->FetchRow()){
            if(!array_key_exists($row['lang'], $langs)){
                $langs[$row['lang']] = array();
            }
            if($row['active']){
                $langs[$row['lang']][$row['nav_id']] = 1;
            } else {
                $langs[$row['lang']][$row['nav_id']] = 2;
            }
        }
        return $langs;
    }

    function getDefaultProfile(){
        // Get the id for defined default profile (from plugin config)
        $result = $GLOBALS['db']->query("
            SELECT
                id
            FROM
                " . $GLOBALS['plugin']->getTable("navigation") . " as a
            WHERE
                title = '" . $GLOBALS['plugin']->getConfig("default_profile") . "'
        ",__FILE__,__LINE__);
        $row = $result->FetchRow();
        return $row['id'];
    }

    function getProfileId($profile){
        if($profile != ''){
            // Get the id for defined default profile (from plugin config)
            $result = $GLOBALS['db']->query("
                SELECT
                    id
                FROM
                    " . $GLOBALS['plugin']->getTable("navigation") . " as a
                WHERE
                    title = '" . $profile . "'
            ",__FILE__,__LINE__);
            $row = $result->FetchRow();
            return $row['id'];
        } else {
            return $this->getDefaultProfile();
        }
    }
}

?>