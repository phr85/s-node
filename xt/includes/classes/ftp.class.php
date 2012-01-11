<?php

/**
 * ftp.class.php
 *
 * Distributed under the GNU Lesser General Public License (LGPL v3)
 * (http://www.gnu.org/licenses/lgpl.html)
 * This program is distributed in the hope that it will be useful -
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @author Dominik Zogg <dominik.zogg@gmail.com
 * @copyright Copyright (c) 2011, iframe AG
 *
 */

class ftp {
    
    /**
     * @var array connectioninfo
     */
    var $_connectioninfo = array(
        "server" => "",
        "username" => "",
        "password" => "",
        "encoding" => "",
        "port" => 0,
        "timeout" => 0,
    );
    
    /**
     * @var null connection
     */
    var $_connection = null;
    
    /**
     * construct
     * 
     * @param string $server server must be a valid domain or ip
     * @param string $username username of the ftp user
     * @param string $password password of the ftp user
     * @param int $port port of the ftp server
     * @param int $timeout connection timeout time in seconds
     */
    public function __construct($server, $username, $password, $encoding = "UTF-8", $port = 21, $timeout = 120) {
        if(!preg_match("/^([a-zA-Z0-9\-\_\.\:]*)$/", trim($server))) {
            throw new Exception("Please enter a valid Domain or IP!");
        }
        if(!is_int($port)) {
            throw new Exception("Port must be a number!");
        }
        if(!is_int($timeout)) {
            throw new Exception("Timeout must be a number!");
        }
        $this->_connectioninfo['server'] = trim($server);
        $this->_connectioninfo['username'] = trim($username);
        $this->_connectioninfo['password'] = trim($password);
        $this->_connectioninfo['encoding'] = trim($encoding);
        $this->_connectioninfo['port'] = $port;
        $this->_connectioninfo['timeout'] = $timeout;
        $this->_connect();
    }
    
    /**
     * destruct
     */
    public function __destruct() {
        @ftp_close($this->_connection);
    }
    
    /**
     * _connect
     */
    private function _connect() {
        if($this->_connection = @ftp_connect($this->_connectioninfo['server'], $this->_connectioninfo['port'], $this->_connectioninfo['timeout'])) {
            if(!@ftp_login($this->_connection, $this->_connectioninfo['username'], $this->_connectioninfo['password'])) {
                throw new Exception("Can't login to ftp server!");
            }
            if(!@ftp_pasv($this->_connection, true)) {
                throw new Exception("Can't force passiv mode!");
            }
        }
        else {
            throw new Exception("Can't login to ftp server!");
        }
    }
    
    /**
     * filelist
     * 
     * @param string $path path must be a valid unix path
     * @return array filelist, each file is an array element
     */
    public function filelist($path = "") {
        $return = array();
        $elements = $this->_rawlist($path);
        if(is_array($elements)) {
            foreach($elements as $elementkey => $element) {
                if($element['type'] !== 1) {
                    $return[$elementkey] = $element;
                }
            }
        }
        return($return);
    }
    
    /**
     * folderlist
     * 
     * @param string $path path must be a valid unix path
     * @return array folderlist, each file is an array element
     */
    public function folderlist($path = "") {
        $return = array();
        $elements = $this->_rawlist($path);
        if(is_array($elements)) {
            foreach($elements as $elementkey => $element) {
                if($element['type'] === 1) {
                    $return[$elementkey] = $element;
                }
            }
        }
        return($return);
    }
    
    /**
     * downloadfile
     * 
     * @param string $remotepath filepath on remotehost
     * @param string $localpath filepath on localhost
     */
    public function downloadfile($remotepath, $localpath, $overwrite = false) {
        $this->_resetremotepath();
        if(@is_file($localpath) && !$overwrite) {
            throw new Exception("Localfile '{$localpath}' allready exists! Force overwrite by calling with option overwrite = true!");
        }
        if(!@ftp_get($this->_connection, $localpath, iconv("UTF-8", $this->_connectioninfo['encoding'], $remotepath), FTP_BINARY)) {
            //reconnect if download failed
            $this->_connect();
            if(!@ftp_get($this->_connection, $localpath, iconv("UTF-8", $this->_connectioninfo['encoding'], $remotepath), FTP_BINARY)) {
                throw new Exception("Remotefile is not downloadable: {$remotepath}");
            }
        }
    }
    
    /**
     * downloadfolder
     *
     * @param string $remotepath filepath on remotehost
     * @param string $localpath filepath on localhost
     */
    public function downloadfolder($remotepath, $localpath, $overwrite = false) {
        $this->_resetremotepath();
        if(@is_dir($localpath) && !$overwrite) {
            throw new Exception("Localfolder '{$localpath}' allready exists! Force overwrite by calling with option overwrite = true!");
        }
        // build local path
        $folders = explode("/", $localpath);
        if(is_array($folders)) {
            $folderpath = ".";
            foreach($folders as $folder) {
                $folderpath = $folderpath . "/" . $folder;
                if(!@is_dir($folderpath)) {
                    if(!mkdir($folderpath)) {
                        throw new Exception("Can't create localfolder: {$folderpath}!");
                    }
                }

            }
        }
        // run through remotefolder
        $elements = $this->_rawlist($remotepath);
        if(is_array($elements)) {
            foreach($elements as $element) {
                // paths
                $localpathfile = $localpath . "/". $element['path'];
                $remotepathfile = $remotepath . "/". $element['path'];
                // directory
                if($element['type'] === 1) {
                    if(!@is_dir($localpathfile)) {
                        if(!@mkdir($localpathfile)) {
                            throw new Exception("Can't create sublocalfolder: {$localpathfile}!");
                        }
                    }
                    $this->downloadfolder($remotepathfile, $localpathfile, $overwrite);
                }
                // file
                else {
                    $this->downloadfile($remotepathfile, $localpathfile, $overwrite);
                }
            }
        }
    }
    
    /**
     * uploadfile
     *
     * @param string $localpath filepath on localhost
     * @param string $remotepath filepath on remotehost
     */
    public function uploadfile($localpath, $remotepath, $overwrite = false) {
        $this->_resetremotepath();
        if(@ftp_size($this->_connection, iconv("UTF-8", $this->_connectioninfo['encoding'], $remotepath)) !== -1 && !$overwrite) {
            throw new Exception("Remotefile '{$remotepath}' allready exists! Force overwrite by calling with option overwrite = true!");
        }
        if(!@ftp_put($this->_connection, iconv("UTF-8", $this->_connectioninfo['encoding'], $remotepath), $localpath, FTP_BINARY)) {
            //reconnect if upload failed
            $this->_connect();
            if(!@ftp_put($this->_connection, iconv("UTF-8", $this->_connectioninfo['encoding'], $remotepath), $localpath, FTP_BINARY)) {
                throw new Exception("Localfile is not uploadable: {$localpath}");
            }
        }
    }
    
    /**
     * uploadfolder
     *
     * @param string $localpath filepath on localhost
     * @param string $remotepath filepath on remotehost
     */
    public function uploadfolder($localpath, $remotepath, $overwrite = false) {
        $this->_resetremotepath();
        if(@ftp_chdir($remotepath) && !$overwrite) {
            throw new Exception("Remotefolder '{$remotepath}' allready exists! Force overwrite by calling with option overwrite = true!");
        }
        // build remote path
        $folders = explode("/", $remotepath);
        if(is_array($folders)) {
            $folderpath = "";
            foreach($folders as $folder) {
                if(!empty($folder)) {
                    $folderpath = $folderpath . "/" . $folder;
                    if(!@ftp_chdir($this->_connection, $folderpath)) {
                        if(!@ftp_mkdir($this->_connection, $folderpath)) {
                            throw new Exception("Can't create remotefolder: {$folder}!");
                        }
                    }
                }
                $this->_resetremotepath();
            }
        }
        // run through localfolder
        $elements = @glob($localpath . "/*");
        if(is_array($elements)) {
            foreach($elements as $element) {
                // paths
                $this->_resetremotepath();
                $element = substr($element, strrpos($element, "/")+1);
                $localpathfile = $localpath . "/". $element;
                $remotepathfile = $remotepath . "/". $element;
                // directory
                if(@is_dir($localpathfile)) {
                    if(!@ftp_chdir($this->_connection, $remotepathfile)) {
                        if(@!ftp_mkdir($this->_connection, $remotepathfile)) {
                            throw new Exception("Can't create subremotefolder: {$remotepathfile}!");
                        }
                    }
                    $this->uploadfolder($localpathfile, $remotepathfile, $overwrite);
                }
                // file
                else {
                    $this->uploadfile($localpathfile, $remotepathfile, $overwrite);
                }
            }
        }
    }
    
    /**
     * _rawlist
     * 
     * @param string $path path must be a valid unix path
     * @return array file and folderlist, each element is an array element
     */
    private function _rawlist($path) {
        $this->_resetremotepath();
        $return = array();
        $i = 1;
        $elements = ftp_rawlist($this->_connection, $path);
        foreach($elements as $element) {
            $element = iconv($this->_connectioninfo['encoding'], "UTF-8", $element);
            // windows
            if(preg_match("/^([-0-9]+) *([0-9:]+[PA]?M?) +(<DIR>|[0-9]+) *(.*)$/", $element, $elementinfo)) {
                $return[$i]['type'] = $elementinfo[3] == "<DIR>" ? 1 : 0;
                $return[$i]['path'] = $elementinfo[4];
                $return[$i]['size']['int'] = $elementinfo[3] != "<DIR>" ? $elementinfo[3] : 0;
                $return[$i]['size']['string'] = ftp::_byteconvert($return[$i]['size']['int']);
                $return[$i]['date']['int'] =  ftp::_generatewindowsdate($elementinfo[1], $elementinfo[2]);
                $return[$i]['date']['string'] = date("d.m.Y H:i", $return[$i]['date']['int']);
            }
            // unix
            elseif(preg_match("/^([-d])[rwxst-]{9}.* ([0-9]*) ([a-zA-Z]+ [0-9: ]*[0-9]) (.+)$/", $element, $elementinfo)) {
                $return[$i]['type'] = $elementinfo[1] == "d" ? 1 : 0;
                $return[$i]['path'] = $elementinfo[4];
                $return[$i]['size']['int'] = $elementinfo[2];
                $return[$i]['size']['string'] = ftp::_byteconvert($return[$i]['size']['int']);
                $return[$i]['date']['int'] = strtotime($elementinfo[3]);
                $return[$i]['date']['string'] = date("d.m.Y H:i", $return[$i]['date']['int']);
            }
            $i++;
        }
        return($return);
    }
    
    /**
     * _generatewindowsdate
     *
     * @param string $date date
     * @param string $time time
     * @return int timestamp
     */
    static private function _generatewindowsdate($date, $time) {
        $dateparts = explode("-", $date);
        $timestamp = mktime
        (
            substr($time, 5, 2) === "PM" ? substr($time, 0, 2)+12 : substr($time, 0, 2),
            substr($time, 3, 2),
            0,
            $dateparts[0],
            $dateparts[1],
            $dateparts[2]
        );
        return($timestamp);
    }
    
    /**
     * _byteconvert
     *
     * @author <tmp@gmx.de>
     * @copyright Copyright (c) 2009, <tmp@gmx.de>, (http://de.php.net/manual/de/function.ftp-rawlist.php)
     * @param string $bytes bytenumber
     * @return string size in optimal represantation
     */
    static private function _byteconvert($bytes) {
        if($bytes > 0) {
            $symbol = array(
                "B",
                "KB",
                "MB",
                "GB",
                "TB",
                "PB",
                "EB",
                "ZB",
                "YB",
            );
            $exp = floor(log($bytes) / log(1024));
            return(sprintf('%.2f ' . $symbol[ $exp ], ($bytes / pow(1024, floor($exp)))));
        }
        else {
            return('0 B');
        }
    }
    
    /**
     * _resetremotepath
     */
    private function _resetremotepath() {
        @ftp_chdir($this->_connection, "/");
    }
}