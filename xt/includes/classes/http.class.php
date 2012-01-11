<?php
/**
 * This class manages http connections
 *
 * @author Haydar Ciftci, iframe AG <hciftci@iframe.ch>
 * @version 1.0
 * @package ch.iframe.snode.core
 */
class XT_HTTP {
    /**
     * HTTP Status codes
     *
     * @var array
     * @access private
     */
    var $httpStates = array(
    '100' => 'httpContinue',
    '101' => 'httpSwitchingProtocols',
    '200' => 'httpOK',
    '201' => 'httpCreated',
    '202' => 'httpAccepted',
    '203' => 'httpNonAuthoritativeInformation',
    '204' => 'httpNoContent',
    '205' => 'httpResetContent',
    '206' => 'httpPartialContent',
    '300' => 'httpMultipleChoices',
    '301' => 'httpMovedPermanently',
    '302' => 'httpFound',
    '303' => 'httpSeeOther',
    '304' => 'httpNotModified',
    '305' => 'httpUseProxy',
    '307' => 'httpTemporaryRedirect',
    '400' => 'httpBadRequest',
    '401' => 'httpUnauthorized',
    '402' => 'httpPaymentRequired',
    '403' => 'httpForbidden',
    '404' => 'httpNotFound',
    '405' => 'httpMethodNotAllowed',
    '406' => 'httpNotAcceptable',
    '407' => 'httpProxyAuthenticationRequired',
    '408' => 'httpRequestTimeOut',
    '409' => 'httpConflict',
    '410' => 'httpGone',
    '411' => 'httpLengthRequired',
    '412' => 'httpPreconditionFailed',
    '413' => 'httpRequestEntityTooLarge',
    '414' => 'httpRequestURITooLarge',
    '415' => 'httpUnsupportedMediaType',
    '416' => 'RequestedRangeNotSatisfiable',
    '417' => 'httpExpectationFailed',
    '500' => 'httpInternalServerError',
    '501' => 'httpNotImplemented',
    '502' => 'httpBadGateway',
    '503' => 'httpServiceUnavailable',
    '504' => 'httpGatewayTimeOut',
    '505' => 'httpVersionNotSupported'
    );

    /**
     * Current http status code
     *
     * @var integer
     * @access private
     */
    var $status = 0;

    /**
     * Hostname to connect
     *
     * @var string
     * @access private
     */
    var $host = '';

    /**
     * Port to connect
     *
     * @var integer
     * @access private
     */
    var $port = '';

    /**
     * Timeout for socket connection
     *
     * @var integer
     * @access private
     */
    var $timeout = 30;

    /**
     * Handle of socket
     *
     * @var resource
     * @access private
     */
    var $handle = null;

    /**
     * Handle of file
     *
     * @var resource
     * @access private
     */
    var $fhandle = null;

    /**
     * Default user agent
     *
     * @var string
     * @access private
     */
    var $useragent = 'S-Node XT HTTP class - www.s-node.com';

    /**
     * The url
     *
     * @var string
     * @access private
     */
    var $url = '';

    /**
     * Contains the path if data should be wrote into a file
     *
     * @var mixed
     * @access private
     */
    var $toFile = false;

    /**
     * File to send with the request
     *
     * @var string
     * @access private
     */
    var $file = '/';

    /**
     * HTTP version to use
     *
     * @var string
     * @access private
     */
    var $httpVersion = '1.1';

    /**
     * Error code of socket if connection failed
     *
     * @var integer
     * @access private
     */
    var $error_code = 0;

    /**
     * Error string of socket if connection failed
     *
     * @var string
     * @access private
     */
    var $error_string = '';

    /**
     * Will contain the downloaded data
     *
     * @var $data
     * @access private
     */
    var $data;

    /**
     * List of headers which are allready received
     *
     * @var string
     * @access private
     */
    var $recvHeaders = '';

    /**
     * Max follows of redirect headers
     *
     * @var integer
     * @access private
     */
    var $maxRedirects = 5;

    /**
     * Max follows of redirect headers
     *
     * @var integer
     * @access private
     */
    var $redirects = 1;

    /**
     * Initializes the class
     *
     * @param integer $timeout Default timeout
     * @return object Instance of this class
     * @access public
     */
    function XT_HTTP($timeout = 30)
    {
        $this->timeout = $timeout;
    }

    /**
     * Connects to the socket
     *
     * @return boolean False if failed to connect
     * @access public
     */
    function connect()
    {
        @fclose($fp);
        $this->handle = @fsockopen(
        $this->host,
        $this->port,
        $this->error_code,
        $this->error_string,
        $this->timeout
        );

        if (!$this->handle) {
            return false;
        }

        return true;
    }

    function parseURL()
    {
    	$parsed_url = @parse_url($this->url);

        if (!@key_exists('scheme', $parsed_url)) {
            $parsed_url = @parse_url('http://' . $this->url);
        }

        $this->host = $parsed_url['host'];

        if (@key_exists('port', $parsed_url)) {
            $this->port = $parsed_url['port'];
        }
        else {
            $this->port = getservbyname($parsed_url['scheme'], 'tcp');
        }

        $file = $parsed_url['path'];

        if ($parsed_url['query'] != '') {
            $file .= '?' . $parsed_url['query'];
        }

        $file .= $parsed_url['fragment'];

        if (trim($file) == '') {
        	$file = '/';
        }

        $this->file = $file;
    }

    /**
     * Returns the status and reads headers
     *
     * @param string $url URL of resource
     * @return integer The http status
     * @access public
     */
    function getHeaders($url, $httpVersion = '1.1')
    {

        $this->url = $url;
        $this->toFile = $toFile;
        $this->httpVersion = $httpVersion;

        /**
         * Parse URL
         */
        $this->parseURL();

        /**
         * Build request
         */
        $request  = sprintf("GET %s HTTP/%s\r\n", $this->file, $httpVersion);
        $request .= sprintf("Host: %s\r\n", $this->host);
        $request .= sprintf("User-Agent: %s\r\n", $this->useragent);

        if ($httpVersion == '1.1') {
        	$request .= "Accept-Encoding: gzip,deflate\r\n";
        }

        $request .= "Connection: Close\r\n";
        $request .= "\r\n";

        /**
         * Check for connection
         */
        if(!$this->connect()){
            return false;
        }

        /**
         * Send request
         */
        fputs($this->handle, $request);

        /**
         * Init vars for response handling
         */
        $bodyBegins = false;
        $lines = 1;
        $this->recvHeaders = '';
        $this->data = '';

        /**
         * Get response
         */
        while(!feof($this->handle)) {
            $data = fgets($this->handle, 1024);

            /*
             * If received data is only a line with \r\n
             * it means that the following data is part of body
             */
            if ($data == "\r\n") {
                $bodyBegins = true;
                break;
            }

            /**
             * If this is the first line, get the status code
             */
            if ($lines == 1) {
                $this->status = $this->getStatusCode($data);
            }

            /**
             * If bodyBegins is false, received data contains headers
             */
            $this->recvHeaders .= $data;
            $lines++;
        }

        fclose($this->handle);

        return $this->status;
    }

    /**
     * Sends a get request
     *
     * @param string $url The url of file
     * @param string $destionation Where to save the result
     * @return boolean Returns false if failed or file is not avaible
     * @access public
     */
    function get($url, $toFile = false, $httpVersion = '1.1')
    {

        $this->url = $url;
        $this->toFile = $toFile;
        $this->httpVersion = $httpVersion;

        if ($this->redirects == $this->maxRedirects) {
        	return false;
        }

        /**
         * Parse URL
         */
        $this->parseURL();

        /**
         * Build request
         */
        $request  = sprintf("GET %s HTTP/%s\r\n", $this->file, $httpVersion);
        $request .= sprintf("Host: %s\r\n", $this->host);
        $request .= sprintf("User-Agent: %s\r\n", $this->useragent);

        if ($httpVersion == '1.1') {
        	$request .= "Accept-Encoding: gzip,deflate\r\n";
        }

        $request .= "Connection: Close\r\n";
        $request .= "\r\n";

        /**
         * Check for connection
         */
        if(!$this->connect()){
            return false;
        }

        /**
         * Check for content to file
         */
        if ($toFile != false) {
            $this->openFile($toFile);
        }

        /**
         * Send request
         */
        fputs($this->handle, $request);

        /**
         * Init vars for response handling
         */
        $bodyBegins = false;
        $firstBodyLine = true;
        $lines = 1;
        $chunked = false;
        $this->recvHeaders = '';
        $this->data = '';

        /**
         * Get response
         */
        while(!feof($this->handle)) {
            $data = fgets($this->handle, 1024);

            /*
             * If received data is only a line with \r\n
             * it means that the following data is part of body
             */
            if ($data == "\r\n") {
                $bodyBegins = true;
                continue;
            }

            /**
             * If this is the first line, get the status code
             */

            if ($lines == 1) {
                $this->status = $this->getStatusCode($data);
                $function = $this->httpStates[$this->status];
                $getBody = @$this->$function();

            }

            /**
             * If bodyBegins allready set to true, the received data is part of body
             */
            if ($bodyBegins) {

                if (!$getBody) {
                	break;
                }

                /**
                 * If Transfer-Encoding is chunked, skip the first line of body
                 */
                if ($firstBodyLine && $chunked) {
                    $firstBodyLine = false;
                    continue;
                }

                /**
                 * If toFile is false, save data in a variable instead of a file
                 */
                if (!$toFile) {
                    $this->data .= $data;
                }
                else {
                    $this->appendToFile($data);
                }
            }
            else {

                /**
                 * If bodyBegins is false, received data contains headers
                 */
                $this->recvHeaders .= $data;

                if (strstr($data, 'chunked')) {
                    $chunked = true;
                }
            }

            $lines++;
        }

        fclose($this->handle);

        if (strstr(strtolower($this->recvHeaders), 'content-encoding: gzip') ||
            strstr(strtolower($this->recvHeaders), 'content-encoding: deflate')) {
            $this->data = gzinflate(substr($this->data, 10));
        }

        $function = $this->httpStates[$this->status];

        $this->$function(true);

        //return $this->status;
    }

    /**
     * Return the http status code
     *
     * @param
     * @return
     * @access public
     */
    function getStatusCode($data)
    {
        $status = explode(' ', $data);
        $this->status = $status[1];
        return $status[1];
    }

    /**
     * Prints the given data
     *
     * @param mixed $data The data to print
     * @return null
     * @access public
     */
    function debug($data)
    {
        echo '<pre>' . $data . '</pre>';
    }

    /**
     * Parses all headers
     *
     * @return array Array of all headers received
     * @access public
     */
    function parseHeaders()
    {
        $headers = explode("\r\n", $this->recvHeaders);
        $headers_clean = array();

        foreach ($headers as $header) {
            if (trim($header) != '') {
                array_push($headers_clean, $header);
            }
        }

        return $headers_clean;
    }

    /**
     * Opens a file for appending
     *
     * @param string $filename The filename
     * @return boolean Returns true if file could be opened
     * @access private
     */
    function openFile($filename)
    {

        $this->fhandle = fopen($filename, "a");

        if (!$this->fhandle) {
            return false;
        }
        else {
            return true;
        }
    }

    /**
     * Closes the open file
     *
     * @return null
     * @access private
     */
    function closeFile()
    {
        @fclose($this->fhandle);
    }

    /**
     * Appends given data to the open file
     *
     * @param string $data The data to append to file
     * @return null
     * @access public
     */
    function appendToFile($data)
    {
        fwrite($this->fhandle, $data);
        fflush($this->fhandle);
    }

    /**
     * 200 OK
     */
    function httpOK($handle = false)
    {
    	return true;
    }

    function httpMovedPermanently($handle = false)
    {
        if($handle == false) {
    	   return false;
        }
        else {

            if ($this->redirects == $this->maxRedirects) {
            	break;
            }
        	$headers = $this->parseHeaders();

        	foreach ($headers as $header) {
        		$header = trim($header);

        		if (strpos($header, 'Location:') !== false) {
        			$data = explode(': ', $header);
        			$this->get(trim($data[1]), $this->toFile, $this->httpVersion);
        			$this->redirects++;
        			break;
        		}
        	}
        }
    }

    function httpFound($handle = false)
    {
        if($handle == false) {
    	   return false;
        }
        else {


            if ($this->redirects == $this->maxRedirects) {
            	break;
            }
        	$headers = $this->parseHeaders();

        	foreach ($headers as $header) {
        		$header = trim($header);

        		if (strpos($header, 'Location:') !== false) {
        			$data = explode(': ', $header);



        			$this->get(trim($data[1]), $this->toFile, $this->httpVersion);
        			$this->redirects++;
        			break;
        		}
        	}
        }

    }

    function httpNotFound($handle = false)
    {
    	return false;
    }

    function httpContinue($handle = false)
    {
        return true;
    }

    function httpSwitchingProtocols($handle = false)
    {
        return true;
    }

    function httpCreated($handle = false)
    {
        return true;
    }

    function httpAccepted($handle = false)
    {
        return true;
    }

    function httpNonAuthoritativeInformation($handle = false)
    {
        return true;
    }

    function httpNoContent($handle = false)
    {
        return true;
    }

    function httpResetContent($handle = false)
    {
        return true;
    }

    function httpPartialContent($handle = false)
    {
        return true;
    }

    function httpMultipleChoices($handle = false)
    {
        return true;
    }

    function httpSeeOther($handle = false)
    {
        return true;
    }

    function httpNotModified($handle = false)
    {
        return true;
    }

    function httpUseProxy($handle = false)
    {
        return true;
    }

    function httpTemporaryRedirect($handle = false)
    {
        return true;
    }

    function httpBadRequest($handle = false)
    {
        return true;
    }

    function httpUnauthorized($handle = false)
    {
        return true;
    }

    function httpPaymentRequired($handle = false)
    {
        return true;
    }

    function httpForbidden($handle = false)
    {
        return true;
    }

    function httpMethodNotAllowed($handle = false)
    {
        return true;
    }

    function httpNotAcceptable($handle = false)
    {
        return true;
    }

    function httpProxyAuthenticationRequired($handle = false)
    {
        return true;
    }

    function httpRequestTimeOut($handle = false)
    {
        return true;
    }

    function httpConflict($handle = false)
    {
        return true;
    }

    function httpGone($handle = false)
    {
        return true;
    }

    function httpLengthRequired($handle = false)
    {
        return true;
    }

    function httpPreconditionFailed($handle = false)
    {
        return true;
    }

    function httpRequestEntityTooLarge($handle = false)
    {
        return true;
    }

    function httpRequestURITooLarge($handle = false)
    {
        return true;
    }

    function httpUnsupportedMediaType($handle = false)
    {
        return true;
    }

    function RequestedRangeNotSatisfiable($handle = false)
    {
        return true;
    }

    function httpExpectationFailed($handle = false)
    {
        return true;
    }

    function httpInternalServerError($handle = false)
    {
        return true;
    }

    function httpNotImplemented($handle = false)
    {
        return true;
    }

    function httpBadGateway($handle = false)
    {
        return true;
    }

    function httpServiceUnavailable($handle = false)
    {
        return true;
    }

    function httpGatewayTimeOut($handle = false)
    {
        return true;
    }

    function httpVersionNotSupported($handle = false)
    {
        return true;
    }


}
?>