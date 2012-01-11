<?php

class XT_Feedmanager {
    
    /**
     * Notifies the Feedmanager that some content has been changed
     *
     * @param integer $baseID The baseid of the plugin
     * @param integer $entryID The ID of the content which has been changed
     * @param integer $content_type The content type id of the plugin
     * @param array $info Additional info for the aggregator and checkfile
     * @access public
     * @return null
     */
    function notify($baseID, $entryID, $content_type, $info = array())
    {
        $feeds_table = "feedmanager_feeds";
        $rels_table  =  "feedmanager_feeds_rel";
        $params_table = "feedmanager_params";
        $feeds_params_table = "feedmanager_feeds_params";
        $protocol = XT::getValue('protocol');
        
        if ($protocol == '') {
        	$protocol = 'RSS_091';
        }
        
        if($content_type > 0) {
        	$result = XT::query("
        	   SELECT
        	       feeds.id,
        	       feeds.profile,
        	       feeds.checkfile,
        	       feeds.generator
    	       FROM
    	           " . XT::getDatabasePrefix() . "feedmanager_feeds as feeds,
    	           " . XT::getDatabasePrefix() . "feedmanager_feeds_rel as feeds_rel
    	       WHERE
    	           feeds_rel.content_type = " . $content_type . "
    	       AND 
    	           feeds.profile = feeds_rel.profile
        	", __FILE__, __LINE__);
    	
        	$data = XT::getQueryData($result);
        	
        	
        	foreach ($data as $entry) {
        	    $profile = $entry['profile'];
        		include_once($entry['checkfile']);
        	}
        	$profile = 1;
        	$entry['id'] = 1;
        	include_once(PLUGIN_DIR . 'ch.iframe.snode.feedmanager/includes/feeds/checkfile.php');
    	}
    }
}
?>