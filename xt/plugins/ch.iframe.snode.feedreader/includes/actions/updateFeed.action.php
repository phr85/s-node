<?php
$result = XT::query("
            SELECT
                id,
                url,
                last_update,
                refresh_interval,
                creation_date,
                entries,
                protocol
            FROM
                " . $GLOBALS['plugin']->getTable('feedreader_feeds') . "
            WHERE
                ID=" . XT::getValue('feed_id') . "
        ", __FILE__, __LINE__);
$data = $result->FetchRow();

// letztes update + intervall > als jetzt ==> nichts machen
if ((($data['last_update'] + ($data['refresh_interval'] * 60)) < time()) || XT::getValue('action') == 'updateFeed') {

    XT::loadClass('http.class.php','ch.iframe.snode.core');
    XT::loadClass('feeds/rss.class.php');
    XT::loadClass('feeds/rss_parser.class.php');
    XT::loadClass('feeds/atom_03.class.php');

    // update datum aktualisieren
    XT::query("UPDATE " . XT::getTable('feedreader_feeds') . " SET last_update=" . time() . " WHERE id=" . XT::getValue('feed_id'),__FILE__,__LINE__);

    // feed auslesen und Eintrï¿½ge die nicht vorhanden sind in DB einfï¿½gen und suchindex erstellen
    switch ($data['protocol']) {
        case 'rss_091':
            $XT_RSS = new XT_RSS_PARSER($data['url']);
            break;
        case 'rss_20':
            $XT_RSS = new XT_RSS_PARSER($data['url']);
            break;
        case 'atom_03':
            $XT_RSS = new XT_ATOM_03($data['url']);
            break;
        default:
            $XT_RSS = new XT_RSS_PARSER($data['url']);
            break;
    }



    if (is_array($XT_RSS->items)) {

        krsort($XT_RSS->items);

        foreach ($XT_RSS->items as $key => $item){


            $md5 = md5($item['title'] . $item['pubdate']);
            if(!empty($item['pubdate'])){
                $pubdate = strtotime($item['pubdate']);
            }else {
            	$pubdate = "";
            }

            XT::query("DELETE FROM " . XT::getTable('feedreader_feedcontainer') . " WHERE feed_id=" . XT::getValue('feed_id') . " AND md5='" . $md5 . "'",__FILE__,__LINE__);

            XT::query("INSERT INTO " . XT::getTable('feedreader_feedcontainer') . " SET
            feed_id=" . XT::getValue('feed_id') . ",
            title ='" . addslashes($item['title']) . "',
            updated = " . time() . ",
            author_name='" . addslashes($item['author']) . "',
            comments='" . addslashes($item['comments']) . "',
            link='" . addslashes($item['link']) . "',
            summary='" . addslashes($item['description']) . "',
            enclosure_url='" . addslashes($XT_RSS->items_attributes[$key]['enclosure']['url']) . "',
            enclosure_length='" . addslashes($XT_RSS->items_attributes[$key]['enclosure']['length']) . "',
            enclosure_type='" . addslashes($XT_RSS->items_attributes[$key]['enclosure']['type']) . "',
            published='" . $pubdate . "',
            md5='" . $md5 . "'",__FILE__,__LINE__);
        }
    }



    // ï¿½ltere elemente (entries) entfernen und aus der suchmaschine entfernen
    $result = XT::query("SELECT position_id FROM " . XT::getTable('feedreader_feedcontainer') . " WHERE feed_id=" . XT::getValue('feed_id') . " ORDER BY position_id DESC LIMIT " . ($data['entries'] - 1) . ",1",__FILE__ ,__LINE__) ;
    $position_id= XT::getQueryData($result);

    if($position_id[0]['position_id'] > 0){
        XT::query("DELETE FROM
        " . XT::getTable('feedreader_feedcontainer') . "
    WHERE
        feed_id = " . XT::getValue('feed_id') . "
    AND
        position_id < " . $position_id[0]['position_id']
        ,__FILE__,__LINE__);
    }
}

?>