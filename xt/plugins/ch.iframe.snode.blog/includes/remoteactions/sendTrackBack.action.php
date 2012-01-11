<?php
// Send a trackback request if some urls are given
if (XT::getValue('XT_TB_send') != "") {
	// Make an array of urls seperated by spaces
	$target_urls = explode(" ",trim(XT::getValue('XT_TB_send')));
	if (!is_array($target_urls)) {
		$target_urls[] = XT::getValue('XT_TB_send');
	}
	foreach ($target_urls as $target_url) {
		// Send it by default
		$send = true;
		/*
		// Query all outgoing trackbacks for this target and source url
		$result = XT::query("
	    SELECT * FROM
	        " . XT::getDatabasePrefix() . "comments_trackback_outgoing
	    WHERE
			target_url='" . $target_url . "' AND
			source_url='" . XT::getValue('XT_TB_source_url') . "'
		",__FILE__,__LINE__);
		while($row = $result->FetchRow()){
			// If the latest request was gone  less than 24 hours. Keep the request
			if ((time() - $row['date']) < (60*60*24)) {
				$send = false;
			}
		}*/
		if ($send == true) {
			sendTrackback($target_url,XT::getValue('XT_TB_title'),XT::getValue('XT_TB_excerpt'),XT::getValue('XT_TB_source_url'));
		}
	}
}


function sendTrackback($trackback_url, $title, $excerpt, $url) {

		if ( empty($trackback_url)){
			return;
		} else {
			// Title
			$title = urlencode($title);

			// Excerpt
			$excerpt = urlencode($excerpt);

			// Set the blog name. Here we take the base_meta_title.
			$blog_name = urlencode($GLOBALS['cfg']->get("system", "base_meta_title"));
			$tb_url = $trackback_url;

			// Set the url of our comment
			$url = str_replace("&","&amp;",$url);
			$url_encoded = urlencode($url);
			$query_string = "title=$title&url=$url_encoded&blog_name=$blog_name&excerpt=$excerpt";

			// Parse the target url
			$trackback_url = parse_url($trackback_url);

			// Create the httprequest
			$http_request = 'POST ' . $trackback_url['path'] . ($trackback_url['query'] ? '?'.$trackback_url['query'] : '') . " HTTP/1.0\r\n";
			$http_request .= 'Host: '.$trackback_url['host']."\r\n";
			// We usually use utf-8
			$http_request .= 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8'."\r\n";
			$http_request .= 'Content-Length: '.strlen($query_string)."\r\n";
			$http_request .= "User-Agent: s-node";
			$http_request .= "\r\n\r\n";

			// Add the query string
			$http_request .= $query_string;

			if ( '' == $trackback_url['port'] ){
				$trackback_url['port'] = 80;
			}

			// Write debug informations
			if ($GLOBALS['cfg']->get("system", "debug") == true) {
				// Open the socket and make the request
				$fs = @fsockopen($trackback_url['host'], $trackback_url['port'], $errno, $errstr, 4);
				@fputs($fs, $http_request);

				$debug_file = 'trackback.log';
				$fp = fopen($debug_file, 'a');
				fwrite($fp, "\n*****\nRequest:\n\n$http_request\n\nResponse:\n\n");
				while(!@feof($fs)) {
					fwrite($fp, @fgets($fs, 4096));
				}
				fwrite($fp, "\n\n");
				fclose($fp);
			}
			@fclose($fs);

			// Insert the entry to mark the tackback as sent
            XT::query("
			    INSERT INTO
			        " . XT::getDatabasePrefix() . "comments_trackback_outgoing
			    (
			        target_url,
			        source_url,
					date
			    ) VALUES (
					'" . $tb_url . "',
			        '" . $url . "',
			        " . time(). "
			    )
			",__FILE__,__LINE__);
		}
    }
?>