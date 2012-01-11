<?php
require_once('xt/includes/config.inc.php');

$file_name = addslashes($_GET['file_name']);
$file_id = addslashes($_GET['file_id']);
$file_version = addslashes($_GET['file_version']);

$version = '';
if($file_version != '' && $file_version != 'orig'){
	$version = '_' . $file_version;
}

if(!is_file(DATA_DIR . 'files/' . $file_id . $version)){
	header("HTTP/1.0 404 Not Found");
	exit();
} else {
	$filename = DATA_DIR . 'files/' . $file_id . $version;
}

$file = @fopen($filename, 'rb');
$fstat = @fstat($file);


// wenn der browser weiss wann die letzt änderung war einfach einen 304 senden
$if_modified_since =  strtotime(preg_replace('/;.*$/','',$_SERVER["HTTP_IF_MODIFIED_SINCE"]));

if($_SERVER["HTTP_IF_MODIFIED_SINCE"] != "" && $fstat['mtime'] <= $if_modified_since){
	header("HTTP/1.0 304 Not Modified");
	exit();
}
// wenn der browser einen etag sendet und wir den selben haben einen 304 senden.
$etag = md5(serialize($fstat));
if( $_SERVER["HTTP_IF_ETAG"] != "" && $etag == $_SERVER["HTTP_IF_ETAG"]){
	header("HTTP/1.0 304 Not Modified");
	exit();
}
header('Etag: "'. $etag . '"');

if($fstat['size'] == 0){
	header("HTTP/1.0 404 Not Found");
	exit();
}

/**
 * load core license
 */
if(function_exists("zend_loader_install_license")){
	@zend_loader_install_license(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . "_ch.iframe.snode.core.zl",1);
}

require_once('xt/includes/db.inc.php');
require_once(CLASS_DIR . 'xt.class.php');               // load core api class
include_once(CLASS_DIR . 'plugin.class.php');


/**
        * load language stuff
        */
require_once(INCLUDE_DIR . "lang.inc.php");             // multilanguage

@ignore_user_abort();
@set_time_limit(0);


/**
 * set error reporting
 */
error_reporting($GLOBALS['cfg']->get("system", "error_reporting"));

// do not check permissions in this mode
$unsecure = $GLOBALS['cfg']->get("system", "disable_file_security");

if(is_numeric($file_id)){
	// Ordner der datei für die Rechteüberprüfung ermitteln
	$result = $GLOBALS['db']->query(" SELECT n1.id,n1.pid,dets.public
    FROM 
    xt_files_tree AS n1, xt_files_rel as frel
    INNER JOIN xt_files_tree AS n2 on frel.node_id = n2.id
    LEFT JOIN xt_files_tree_details as dets on(dets.node_id = n2.id)
    WHERE
    frel.file_id =" . $file_id . "
    AND n1.l <= n2.l
    AND n1.r >= n2.r
    AND n1.tree_id = n2.tree_id
    GROUP BY
    n1.ID
    ORDER BY
    n1.l ASC");
	$count = 0;
	while ($row = $result->FetchRow()){
		$way[$count] = $row['id'];
		$count++;
		$ispublic = $row['public'];
		$thepid = $row['pid'];
		$thenode = $row['id'];
	}

	if($ispublic == 1 || $unsecure == 1 || getNodePermission($thenode,'viewFiles',$thepid,$way)){

		$result = $GLOBALS['db']->query("SELECT filename,count_downloads FROM " . $GLOBALS['cfg']->get("database","prefix") . "files WHERE id = " . $file_id . " LIMIT 1");
		$row = $result->FetchRow();
		if(is_array($row)){
			if($row['count_downloads'] == 1){
				$GLOBALS['db']->query("UPDATE " . $GLOBALS['cfg']->get("database","prefix") . "files SET downloads = downloads + 1 WHERE id = " . $file_id . "");
			}

			$filesize = $fstat['size'];

			// mimetype nur senden wenn das original verlangt wird

			if(!is_numeric($file_version)){
				$mime = mime_content_type_xt($row['filename']);
				if ($mime){
					header('Content-Type: ' . $mime);
				}
			}else{
				header('Content-Type: image/png');
			}

			header('Content-Length: ' . $filesize);

			if ($_GET['download']){
				if(!is_numeric($file_version)){
					header('Content-Disposition: attachment; filename="' . utf8_decode($row['filename']) . '"');
				}else {
					header('Content-Disposition: attachment; filename="' . utf8_decode($row['filename']) . '.png"');
				}
			}else {
				header('Content-Disposition: inline; filename="' . utf8_decode($row['filename']) . '";');
			}

			header('Cache-Control: max-age=15555000, must-revalidate');

			if($filesize < 204800){
				header("Last-Modified: " . gmdate("D, d M Y H:i:s",$fstat['mtime']) . " GMT");
				header("Expires: " . gmdate("D, d M Y H:i:s",$fstat['atime'] + 432000) . " GMT");
				fpassthru($file);
			} else {

				if(function_exists('apache_request_headers')){
					$headers = apache_request_headers();
					if(isset($headers['Range'])){
						$range = substr($headers['Range'],6);
						$range = substr($range,0,-1);
						//more infos bei http://www.html-world.de/program/http_6.php#range
						$parts=explode(',',$range);
						fseek($file,$parts[0],SEEK_SET);
					}
				}


				header("Last-Modified: " . gmdate("D, d M Y H:i:s",$fstat['mtime']) . " GMT");
				//header("Expires: " . gmdate("D, d M Y H:i:s",$fstat['mtime'] + 15555000) . " GMT");
				while(!feof($file)) {
					print(fread($file, 65500));

				}
			}
		}
	}

}else {
	$GLOBALS['db']->close();
	header("HTTP/1.0 404 Not Found");
	exit();
}
$GLOBALS['db']->close();

function mime_content_type_xt($filename){
	include_once("xt/includes/mimetypes.inc.php");
	if (isset($GLOBALS['mimetypes'][substr(strrchr(strtolower($filename), '.'),1)])){

		return $GLOBALS['mimetypes'][substr(strrchr(strtolower($filename), '.'),1)];
	}else {
		return false;
	}

}

function getSingleNodePermission($node_id){
	return $GLOBALS['perm']->getNodePerm($node_id, 11, 240, $GLOBALS['lang']->getLang());
}

function getNodePermission($node_id, $perm, $node_pid, $way){
	require(CLASS_DIR . 'pluginhandler.class.php');

	global $pluginhandler;
	$pluginhandler = new XT_PluginHandler();

	global $perm;
	require_once(INCLUDE_DIR . "auth.inc.php");
	// wenn user nicht eingeloggt ist und dokument geschützt ist sende 403

	if(($_SESSION['user']['roles'])){

		/**
        * load permission class
        */
		require(CLASS_DIR . 'perm.class.php');

		/**
        * Create permission object
        */
		$GLOBALS['perm'] = new XT_Perm();

	}else {
		$GLOBALS['db']->close();
		header("HTTP/1.0 403 Forbidden");
		echo  '403 Forbidden ';
		return false;
	}


	if(!is_array(@$_SESSION['user']['groups'])){
		$_SESSION['user']['groups'] = array();
	}
	if(in_array(1,@$_SESSION['user']['groups']) ||  $_SESSION['user']['id'] == 1){
		return true;
	}

	// Check if this node has set permissions

	if(getSingleNodePermission($node_id) != NULL){
		if(getSingleNodePermission($node_id) == 0){
			return false;
		} else {
			return true;
		}
	} else {
		$keys = array_keys($way,$node_pid);
		if(count($keys) > 0){
			for($i = $keys[0]; $i >= 0; $i--){
				if(getSingleNodePermission($way[$i]) != NULL){
					if(getSingleNodePermission($way[$i]) == 0){
						return false;
					} else {
						return true;
					}
				}
				if(!isset($way[$i])){
					break;
				}
			}
		}
	}
	return false;
}